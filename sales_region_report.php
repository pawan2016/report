<style>
.srClass, #printby{display:none;}
.printby{display:none;}
</style>
<style type="text/css" media="print">
#reset_button{display:none;}
.btn-primary, .breadcrumb, .breadcrumb-my-toggle, .my-hide-div {display : none;}
.showmyprint{width:50%; float:left;}
.box-header>h2{text-align:center;}
#printby, .printby{display:block !important; font-weight:bold; padding:15px;}
.myheader{width:33%; float:left;}
.box, .box-content, .well{padding:0px !important;}
@page { size: landscape; }
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
					<?php 
					$disp_office_name=$office_data->office_name;
					if(!empty($office_data)){
						$regionalStoreData_res = $this->db->select('*')->from('regional_store_master')->where(array('regional_store_id'=>$regional_store_id))->get()->row();
						if(!empty($regionalStoreData_res))
						{
							$disp_office_name=$regionalStoreData_res->regional_store_name;;
						}
						?>
					<div class="center text-center" style="font-size:13px; font-weight:bold;"><?php echo strtoupper($disp_office_name.'-'.$office_data->office_operation_type.', '.getCityName($office_data->city_id).', '.getStateName($office_data->state_id));?></div>
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
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">Sales Report</div>
				</div>
			</div>
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-4 col-sm-4 col-xs-4">
					<label class="control-label">From Date :&nbsp;</label><?php echo $fromDate; ?>
				</div>
				<div class="col-lg-4 col-sm-4 col-xs-4">
					<label class="control-label">To Date :&nbsp;</label><?php echo $toDate;?>
				</div>
				<div class="col-lg-4 col-sm-4 col-xs-4">
					<label class="control-label">Region Type :&nbsp;</label><?php echo $printRegionType;?>
				</div>
			</div>
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">Region :&nbsp;</label><?php echo $printRegion; ?>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">Office Location :&nbsp;</label><?php echo $printOffice;?>
				</div>
			</div>
			<div class="row" style="margin-top:-20px;">
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-inner">
						<div class="box-header well my-hide-div">
							<h2>Sales Report</h2>
						</div>
						<div class="box-content">
						<form method="post" id='form' action="<?php echo base_url('Report/salesReport'); ?>" autcomplete="off"/>
							<div class="row my-hide-div">
								<div class="form-group col-lg-2 showmyprint">
									<label class="control-label">From Date</label>
									<input type="text" class="form-control" id="right_from" name="right_from" value="<?php echo $fromDate; ?>" />
								</div>
								
								<div class="form-group col-lg-2 showmyprint">
									<label class="control-label">To Date</label>
									<input type="text" class="form-control" id="right_to" name="right_to" value="<?php echo $toDate;?>" />
								</div>
								<div class="control-group col-lg-2 showmyprint">
									<label class="control-label">Region Type</label><?php // print_r($selectedProduct); ?>
									<div class="controls">
										<select name="region_type" id="region_type" data-rel="chosen" class="form-control" onChange="getRegionLocation();">
											<option value="others" <?php echo  set_select('region_type','others'); ?> >Others</option>
										</select>
									</div>
								</div>
								<div class="control-group col-lg-2 showmyprint" id="regions">
									<label class="control-label">Region Location</label>
									<div class="controls">
									
										<select name="region_id[]" id="region_id" data-rel="chosen" class="form-control" onChange="getOfficeLocations();" >
											<?php 
										
											foreach($regionLists as $region){?>
											<option value="<?php echo $region->regional_store_id;?>" <?php echo  set_select('region_id', $region->regional_store_id ); ?> ><?php echo $region->regional_store_name;?>(<?php echo $region->regional_store_type;?>)</option>
										<?php } ?>
										</select>
									</div>
								</div>
								<div class="control-group col-lg-3 showmyprint" id="locations">
									<label class="control-label">Office Location</label><?php // print_r($selectedProduct); ?>
									<div class="controls">
										<select name="office_location[]" id="office_location" multiple data-rel="chosen" class="form-control">
										<option value="">Select Office Location</option>
										<?php foreach($transfer_to as $Transfer_to){?>
											<option value="<?php echo $Transfer_to->office_id;?>" <?php echo  set_select('office_location', $Transfer_to->office_id ); if(isset($user_master_data->office_id) && $user_master_data->office_id == $Transfer_to->office_id){ echo 'selected';} ?>><?php echo $Transfer_to->office_name;?>-<?php echo $Transfer_to->office_operation_type;?>(<?php echo $Transfer_to->regional_store_type;?>)</option>
										<?php } ?>
										</select>
									</div>
									<?php echo form_error('office_location'); ?>
								</div>
							</div>
							<div class="row my-hide-div">
								<div class="form-group col-lg-6">
									<button type="submit" name="submit" id="back_to_search"  class="btn btn-primary" style="margin-left:1%;margin-bottom:15px;">Submit</button>
									<a style="margin-left:1%;margin-bottom:15px;" id="reset_button" href="<?php echo base_url('Report/salesReport'); ?>" class='btn btn-primary' >Reset</a>
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
											<th class="text-center" colspan="4"><?php echo $product->product_weight.'g'; ?> Nos</th>
										<?php 
										}
										?>
											<th class="text-center" colspan="2">Total</th>
											<th class="text-center" >TurnOver</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="center text-center srClass"></td>
											<td class="center text-center"></td>
										<?php foreach($all_products as $product)
										{
										?>
											<td class="center text-center">Opening Stock</td>
											<td class="center text-center">Sales (Nos)</td>
											<td class="center text-center">Weight(gm)</td>
											<td class="center text-center">Closing Stock</td>
										<?php 
										}
										?>
											<td class="center text-center">Sales (Nos)</td>
											<td class="center text-center">Weight(gm)</td>
											<td class="center text-center">(In Rs.)</td>
										</tr>
									<?php
									$grossNmArray = array();
									$grossWtArray = array();
									$grossWeight = array();
									$grossNumber = array();
									$sum_opening_stock=array();
										$sum_closing_stock=array();
									foreach($get_all_record as $ofkey=>$record)
									{
										$testgrossNmArray = array();
										$testgrossWtArray = array();
										$testgrossOsArray = array();
										$testgrossCsArray = array();
										
										foreach($all_products as $pkey=>$product)
										{
											$testgrossNmArray[] = $record[$product->product_id]['sales_stock'];
											$testgrossWtArray[] = $record[$product->product_id]['totalWeight'];
											$testgrossOsArray[] = $record[$product->product_id]['opening_stock'];
											$testgrossCsArray[] = $record[$product->product_id]['closing_stock'];
										}
										if(array_sum($testgrossNmArray) == '0' && array_sum($testgrossWtArray) == '0' && array_sum($testgrossOsArray) == '0' && array_sum($testgrossCsArray) == '0'){
											
										}
										else{
									?>
									
										<tr>
											<td class="center text-center srClass"><?php echo ++$i; ?></td>
											<td class="center text-left"><?php echo getOfficeLocation($record[1]['officeId']); ?></td>
										<?php foreach($all_products as $pkey=>$product)
										{
											$grossNmArray[$product->product_id][] = $record[$product->product_id]['sales_stock'];
											$grossWtArray[$product->product_id][] = $record[$product->product_id]['totalWeight'];
											$sum_opening_stock[$product->product_id][]=$record[$product->product_id]['opening_stock'];
											$sum_closing_stock[$product->product_id][]=$record[$product->product_id]['closing_stock'];
										?>
											<td class="center text-center"><?php echo $record[$product->product_id]['opening_stock']; ?></td>
											<td class="center text-center"><?php echo $record[$product->product_id]['sales_stock']; ?></td>
											<td class="center text-center"><?php echo $record[$product->product_id]['totalWeight']; ?></td>
											<td class="center text-center"><?php echo $record[$product->product_id]['closing_stock']; ?></td>
											
										<?php 
										}
										?>
											<td class="center text-center"><?php echo array_sum($testgrossNmArray); ?></td>
											<td class="center text-center"><?php echo array_sum($testgrossWtArray); ?></td>
											<td class="center text-center"><?php setlocale(LC_MONETARY, 'en_IN'); echo money_format('%!i',$record['turnover']); ?></td>
										</tr>
									<?php
										 }
									}
									?>
									
										<tr>
											<td class="center text-center srClass"><?php echo ++$i; ?></td>
											<td class="center text-left"><strong>Total</strong></td>
										<?php foreach($all_products as $pkey=>$product){
											$grossWeight[] = array_sum($grossWtArray[$product->product_id]);
											$grossNumber[] = array_sum($grossNmArray[$product->product_id]);
										?>
											<td class="center text-center"><strong><?php echo array_sum($sum_opening_stock[$product->product_id]);?></strong></td>
											<td class="center text-center"><strong><?php echo array_sum($grossNmArray[$product->product_id]); ?></strong></td>
											<td class="center text-center"><strong><?php echo array_sum($grossWtArray[$product->product_id]); ?></strong></td>
											<td class="center text-center"><strong><?php echo array_sum($sum_closing_stock[$product->product_id]);?></strong></td>
										<?php 
										}
										$tamount = $get_all_record['totalCost'];
										setlocale(LC_MONETARY, 'en_IN');
										$tamount = money_format('%!i', $tamount);
										?>
											<td class="center text-center"><strong></strong></td>
											<td class="center text-center"><strong></strong></td>
											<td class="center text-center"><strong></strong></td>
										</tr>
										<tr>
											<td class="center text-center srClass"><?php echo ++$i; ?></td>
											<td class="center text-right" colspan="16"><strong>Turn over: <?php echo "₹".$tamount; ?> </strong></td>
										</tr>
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
	<div id="printby">
		Printed By :  <?php echo ucwords($this->session->userdata('user_username')); ?>&nbsp;,&nbsp;Date :   <?php echo date('d-m-Y H:i:s',strtotime('now')).'<br/>'.str_repeat('*',215); ?>
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

function getRegionLocation()
{
	var region_type = $('#region_type').val();
	$('#office_location').val('');
	$.ajax({
			url : "<?php echo base_url('report/getRegionList'); ?>",
			type: "POST",
			data: {region_type:region_type},
			success:function(res){
				//console.log(res);
				$('#regions').html(res);
			}
	});
}

</script>