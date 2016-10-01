<style type="text/css" media="print">
#reset_button{display:none;}
.btn-primary, .dataTables_filter, .dataTables_paginate, .breadcrumb, .breadcrumb-my-toggle, .my-hide-div {display : none;}
.showmyprint{width:50%; float:left;}
#printby, .printby{display:block !important; font-weight:bold; padding:15px;}
.myheader{width:33%; float:left;}
</style>
<style>
.srClass{display:none;}
.printby{display:none;}
</style>
<div class="ch-container">
    <div class="row my-container-class">
        <div id="content" class="col-lg-12 col-sm-12">
            <!-- content starts -->
            <div>
				<ul class="breadcrumb col-lg-9 col-sm-9">
					<li>
						<a href="#">Home</a>
					</li>
					<li>
						<a href="#">Report</a>
					</li>
					
				</ul>
				<ul class="breadcrumb-my-toggle text-right  col-lg-3 col-sm-3">
					<li>
						
					</li>
				</ul>
				
			</div>
			<?php if($this->session->flashdata('SuccessMessage')){ ?>
				<span class="alert alert-success col-lg-12">
				 <button type="button" class="close" data-dismiss="alert">x</button>
                    <?php echo $this->session->flashdata('SuccessMessage'); ?>
                </span>
			<?php } 
				$office_id = $this->session->userdata('office_id');
				$office_data = $this->db->get_where('office_master',array('office_id'=>$office_id))->row();

			?>
			<div class="row printby">
				<div class="col-lg-3 col-sm-3 col-xs-3">
					<img src="<?php echo base_url('files/img/index.png'); ?>" />
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">MMTC-Indian Gold Coin</div>
					<?php if(!empty($office_data)){?>
					<div class="center text-center" style="font-size:13px; font-weight:bold;"><?php echo strtoupper($office_data->office_name.'-'.$office_data->office_operation_type.', '.getCityName($office_data->city_id).', '.getStateName($office_data->state_id));?></div>
					<?php } else {?>
					<div class="center text-center" style="font-size:13px; font-weight:bold;">HEADOFFICE - MMTC LIMITED, SCOPE COMPLEX LODHI ROAD NEW DELHI</div>
				<?php } ?>
				</div>
				<div class="col-lg-3 col-sm-3 col-xs-3">
					<div class="pull-right">
					<img height="77" width="77" src="<?php echo base_url('files/img/igc10.png'); ?>" />
					</div>
				</div>
			</div>
			<div class="row printby">
				<div class="col-lg-12 col-sm-12">
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">Sales Report</div>
				</div>
			</div>
			<div class="row printby">
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">From Date :&nbsp;</label><?php echo $fromDate; ?>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">To Date :&nbsp;</label><?php echo $toDate;?>
				</div>
			</div>
			<div class="row">
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-inner">
						<div class="box-header well my-hide-div">
							<h2>Sales Report</h2>
						</div>
						<div class="box-content">
						<form method="post" id='form' action="<?php echo base_url('Report/officeSalesReport'); ?>" autcomplete="off"/>
							<div class="row my-hide-div">
								<div class="form-group col-lg-2 showmyprint">
									<label class="control-label">From Date</label>
									<input type="text" class="form-control" id="right_from" name="right_from" value="<?php echo $fromDate; ?>" />
								</div>
								
								<div class="form-group col-lg-2 showmyprint">
									<label class="control-label">To Date</label>
									<input type="text" class="form-control" id="right_to" name="right_to" value="<?php echo $toDate;?>" />
								</div>
								<input type="hidden" value="" name="region_id" />
								<input type="hidden" value="<?php echo $this->session->userdata('office_id'); ?>" name="office_location[]" />
							</div>
							<div class="row my-hide-div">
								<div class="form-group col-lg-6">
									<button type="submit" name="submit" id="back_to_search"  class="btn btn-primary" style="margin-left:1%;margin-bottom:15px;">Submit</button>
									<a style="margin-left:1%;margin-bottom:15px;" id="reset_button" href="<?php echo base_url('Report/officeSalesReport'); ?>" class='btn btn-primary' >Reset</a>
									<a style="margin-left:1%;margin-bottom:15px;" href="javascript:void(0);" onClick="javascript:window.print();" class='btn btn-primary' >Print</a>
								</div>
							</div>
						</form>
							<div id="stockReciptTable">
								<table  class="table table-striped table-bordered responsive">
									<thead>
										<tr>
											<th class="text-center srClass">Sr. No.</th>
											<th class="text-left">Show Room Name</th>
										<?php foreach($all_products as $product)
										{
										?>
											<th class="text-center" colspan="2"><?php echo $product->product_weight.'g'; ?> Nos</th>
										<?php 
										}
										?>
											<!-- <th class="text-center" colspan="2">Total</th> -->
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="center text-center srClass"></td>
											<td class="center text-center"></td>
										<?php foreach($all_products as $product)
										{
										?>
											<td class="center text-center">In Nos</td>
											<td class="center text-center">Weight(gm)</td>
										<?php 
										}
										/*
										?>
											<td class="center text-center">In Nos</td>
											<td class="center text-center">Weight(gm)</td>
										</tr>
									<?php
										*/
									$grossNmArray = array();
									$grossWtArray = array();
									$grossWeight = array();
									$grossNumber = array();
									$record = $get_all_record[0];
									//foreach($get_all_record as $ofkey=>$record)
									//{
										// $testgrossNmArray = array();
										// $testgrossWtArray = array();
										
										// foreach($all_products as $pkey=>$product)
										// {
											// $testgrossNmArray[] = $record[$product->product_id]['sales_stock'];
											// $testgrossWtArray[] = $record[$product->product_id]['totalWeight'];
										// }
										// if(array_sum($testgrossNmArray) == '0' && array_sum($testgrossWtArray) == '0'){
											
										// }
										// else{
									//if($ofkey == $this->session->userdata('office_id')){
									?>
									
										<tr>
											<td class="center text-center srClass"><?php echo ++$i; ?></td>
											<td class="center text-left"><?php echo getOfficeLocation($office_id); ?></td>
										<?php foreach($all_products as $pkey=>$product)
										{
											$grossNmArray[$product->product_id][] = $record[$product->product_id]['sales_stock'];
											$grossWtArray[$product->product_id][] = $record[$product->product_id]['totalWeight'];
										?>
											<td class="center text-center"><?php echo $record[$product->product_id]['sales_stock']; ?></td>
											<td class="center text-center"><?php echo $record[$product->product_id]['totalWeight']; ?></td>
										<?php 
										}
										/*
										?>
											<td class="center text-center"><?php echo array_sum($testgrossNmArray); ?></td>
											<td class="center text-center"><?php echo array_sum($testgrossWtArray); ?></td>
										</tr>
									<?php
									*/
										// }
										//}
									//}
									?>
									
										<tr>
											<td class="center text-center srClass"><?php echo ++$i; ?></td>
											<td class="center text-center"><strong>Total</strong></td>
											
										<?php foreach($all_products as $pkey=>$product){
											$grossWeight[] = array_sum($grossWtArray[$product->product_id]);
											$grossNumber[] = array_sum($grossNmArray[$product->product_id]);
										?>
											<td class="center text-center"><strong><?php echo array_sum($grossNmArray[$product->product_id]); ?></strong></td>
											<td class="center text-center"><strong><?php echo array_sum($grossWtArray[$product->product_id]); ?></strong></td>
										<?php 
										}
										$tamount = $get_all_record['totalCost'];
										setlocale(LC_MONETARY, 'en_IN');
										$tamount = money_format('%!i', $tamount);
										?>
										
										</tr>
										<tr><td class="center text-center"><strong>TurnOver</strong></td><td colspan="6" class="center text-right"><strong>Turn over: <?php echo "₹".$tamount; ?> </strong></td></tr>
									</tbody>
								</table>
							</div>
							<div>
							<p class="text-center">
								<strong>
								Gross Weight : <?php echo array_sum($grossWeight).'gm | '; ?>
								Gross Quantity : <?php echo array_sum($grossNumber); ?>
								</strong>
							</p>
							</div>
						</div>
					</div>
				</div>
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
	<div id="printby" class="printby">
		Printed By :  <?php echo ucwords($this->session->userdata('user_username')); ?>&nbsp;,&nbsp;Date :   <?php echo date('d-m-Y H:i:s',strtotime('now')).'<br/>'.str_repeat('*',185); ?>
	</div>
	<script type="text/javascript">
$(function() {
    $( "#right_from" ).datepicker({
	  dateFormat: "d/mm/yy",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
      $( "#right_to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
	$( "#right_from" ).datepicker({ defaultDate: new Date() });
    $( "#right_to" ).datepicker({
	  dateFormat: "d/mm/yy",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#right_from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
	// $('#right_from').datepicker('setDate', new Date());
	// $('#right_to').datepicker('setDate', new Date());
	
	
$("#form #reset_form_report").click(function (){
	$('#right_from').remove();
	$('#right_to').remove();
	//location.reload(); 
	
	});
	
});


function getOfficeLocations()
{
	var regionvalue = $('#region_id').val();
	
	$.ajax({
			url : "<?php echo base_url('report/getRegionShowroom'); ?>",
			type: "POST",
			data: {resionvalue:regionvalue},
			success:function(res){
				//console.log(res);
				$('#locations').html(res);
			}
	});
}

</script>
