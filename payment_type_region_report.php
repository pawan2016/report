<style type="text/css" media="print">
#reset_button{display:none;}
.btn-primary, .dataTables_filter, .dataTables_paginate, .breadcrumb, .breadcrumb-my-toggle, .my-hide-div {display : none;}
.showmyprint{width:50%; float:left;}
#printby, .printby{display:block !important; font-weight:bold; padding:15px;}
.myheader{width:33%; float:left;}
.box, .box-content, .well{padding:0px !important;}
</style>
<style>
.srClass{display:none;}
#printby, .printby{display:none;}
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
					<?php if(!empty($office_data)){
						$disp_office_name=$office_data->office_name;
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
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">Payment Mode Report</div>
				</div>
			</div>
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">From Date :&nbsp;</label><?php echo $fromDate; ?>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">To Date :&nbsp;</label><?php echo $toDate;?>
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
			<div class="row">
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-inner">
						<div class="box-header well my-hide-div">
							<h2>Payment Mode Report</h2>
						</div>
						<div class="box-content">
						<form method="post" id='form' action="<?php echo base_url('Report/paymentModeReport'); ?>" autcomplete="off"/>
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
									<label class="control-label">Region Location</label>
									<div class="controls">
										<select name="region_id" id="region_id" data-rel="chosen" class="form-control" onChange="getOfficeLocations();">
											<?php foreach($regionLists as $region){?>
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
									<a style="margin-left:1%;margin-bottom:15px;" id="reset_button" href="<?php echo base_url('Report/paymentModeReport'); ?>" class='btn btn-primary' >Reset</a>
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
											<th class="text-center">Total Sale</th>
											<th class="text-center">Card Payment</th>
											<th class="text-center">Cash Payment</th>
											<th class="text-center">DD/Cheque Payment</th>
											<th class="text-center">Other Payment</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$totalValueArray = 0;
									$cardValueArray = 0;
									$cashValueArray = 0;
									$chequeValueArray = 0;
									$otherValueArray = 0;
									foreach($get_all_record as $key=>$record){
										$totalValueArray = $totalValueArray + $record['totalValue'];;
										$cardValueArray = $cardValueArray + $record['cardValue'];;
										$cashValueArray = $cashValueArray + $record['cashValue'];;
										$chequeValueArray = $chequeValueArray + $record['chequeValue'];;
										$otherValueArray = $otherValueArray + $record['otherValue'];;
									?>
										<tr>
											<td class="center text-center srClass"></td>
											<td class="center text-left"><?php echo getOfficeLocation($record['officeId']); ?></td>
											<td class="center text-center">₹<?php echo $record['totalValue']; ?></td>
											<td class="center text-center">₹<?php echo $record['cardValue']; ?></td>
											<td class="center text-center">₹<?php echo $record['cashValue']; ?></td>
											<td class="center text-center">₹<?php echo $record['chequeValue']; ?></td>
											<td class="center text-center">₹<?php echo $record['otherValue']; ?></td>
										</tr>
									<?php
									}
									?>
										<tr>
											<td class="center text-center srClass"></td>
											<td class="center text-left"><strong>Total</strong></td>
											<td class="center text-center"><strong>₹<?php echo $totalValueArray; ?></strong></td>
											<td class="center text-center"><strong>₹<?php echo $cardValueArray; ?></strong></td>
											<td class="center text-center"><strong>₹<?php echo $cashValueArray; ?></strong></td>
											<td class="center text-center"><strong>₹<?php echo $chequeValueArray; ?></strong></td>
											<td class="center text-center"><strong>₹<?php echo $otherValueArray; ?></strong></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
	<div id="printby">
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