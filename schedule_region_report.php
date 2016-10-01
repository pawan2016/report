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
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">Schedule Report</div>
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
			<div class="row printby">
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
							<h2>Schedule Report</h2>
						</div>
						<div class="box-content">
						<form method="post" id='form' action="<?php echo base_url('Report/scheduleReport'); ?>" autcomplete="off"/>
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
										<select name="region_type" id="region_type" data-rel="chosen" class="form-control" onChange="getOfficeLocation();">
											
											<option value="others" <?php echo  set_select('region_type','others'); ?> >Others</option>
										</select>
									</div>
								</div>
								<div class="control-group col-lg-3 showmyprint">
									<label class="control-label">Office Location</label><?php // print_r($selectedProduct); ?>
									<div class="controls" id="locations">
										<select name="office_location" id="office_location" data-rel="chosen" class="form-control">
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
									<a href="<?php echo base_url('Report/scheduleReport'); ?>" style="margin-left:1%;margin-bottom:15px;" class='btn btn-primary' />Reset</a>
									<a style="margin-left:1%;margin-bottom:15px;" href="javascript:void(0);" onClick="javascript:window.print();" class='btn btn-primary' >Print</a>
								</div>
							</div>
						</form>
							<div id="">
								<table  class="table table-striped table-bordered responsive">
									<thead>
										<tr>
											<th class="text-center srClass">Sr. No.</th>
											<th class="text-left">Item</th>
											<th class="text-center">Opening Stock</th>
											<th class="text-center">Stock-In </th>
											<th class="text-center">BuyBack</th>
											<th class="text-center">Stock-Out</th>
											<th class="text-center">Actual Value</th>
											<th class="text-center">Sales</th>
											<th class="text-center">Closing Stock</th>
											<th class="text-center">Stock In-transit</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$openStockArray = 0;
									$stockInArray = 0;
									$buybackStockArray = 0;
									$stockOutArray = 0;
									$salesStockArray = 0;
									$closingStockArray = 0;
									$intransitStockArray = 0;
									
									$sum_show_open = 0;
									$sum_show_close = 0;
									$sum_show_stock_in = 0;
									$sum_show_stock_out = 0;
									$sum_show_buyback_stock = 0;
									$sum_show_sales = 0;
									$sum_show_in_transit = 0;
									
									$sum_store_open = 0;
									$sum_store_close = 0;
									$sum_store_stock_in = 0;
									$sum_store_stock_out = 0;
									$sum_store_buyback_stock = 0;
									$sum_store_sales = 0;
									$sum_store_in_transit = 0;
										if(!empty($get_all_record)){
											// echo '<pre>';
											// print_r($get_all_record);
											// echo '</pre>';
											foreach($get_all_record as $record){
											$openStockArray = $openStockArray + $record['opening_stock'];
											$stockInArray = $stockInArray + $record['stock_in'];
											$buybackStockArray = $buybackStockArray + $record['buyback_stock'];
											$stockOutArray = $stockOutArray + $record['stock_out'];
											$salesStockArray = $salesStockArray + $record['sales_stock'];
											$closingStockArray = $closingStockArray + $record['closing_stock'];
											$intransitStockArray = $intransitStockArray + $record['in_transit_stock'];
											$actualValue = 0;
											
											$actualValue = $record['stock_in'] - $record['stock_out'];
											if($actualValue < 0)
											{
												$actualValue = $actualValue;
											}
											$actualValueArray = $actualValueArray + $actualValue;
											
										
											
											$sum_show_open=$sum_show_open+$record['sum_show_open'];
											$sum_show_close=$sum_show_close+$record['sum_show_close'];
											$sum_show_stock_in=$sum_show_stock_in+$record['sum_show_stock_in'];
											$sum_show_stock_out=$sum_show_stock_out+$record['sum_show_stock_out'];
											$sum_show_buyback_stock=$sum_show_buyback_stock+$record['sum_show_buyback_stock'];
											$sum_show_sales=$sum_show_sales+$record['sum_show_sales'];
											$sum_show_in_transit=$sum_show_in_transit+$record['sum_show_in_transit'];
											
											$sum_store_open=$sum_store_open+$record['sum_store_open'];
											$sum_store_close=$sum_store_close+$record['sum_store_close'];
											$sum_store_stock_in=$sum_store_stock_in+$record['sum_store_stock_in'];
											$sum_store_stock_out=$sum_show_stock_out+$record['sum_store_stock_out'];
											$sum_store_buyback_stock=$sum_store_buyback_stock+$record['sum_store_buyback_stock'];
											$sum_store_sales=$sum_store_sales+$record['sum_store_sales'];
											$sum_store_in_transit=$sum_store_in_transit+$record['sum_store_in_transit'];
									?>
										<tr>
											<td class="center text-center srClass"><?php echo ++$i; ?></td>
											<td class="center text-left"><strong><?php echo $record['product_name']; ?></strong></td>
											<td class="center text-center"><?php echo $record['opening_stock']; ?></td>
											<td class="center text-center"><?php echo $record['stock_in']; ?></td>
											<td class="center text-center"><?php echo $record['buyback_stock']; ?></td>
											<td class="center text-center"><?php echo $record['stock_out']; ?></td>
											<td class="center text-center"><?php echo $actualValue; ?></td>
											<td class="center text-center"><?php echo $record['sales_stock']; ?></td>
											<td class="center text-center"><?php echo $record['closing_stock']; ?></td>
											<td class="center text-center"><?php echo $record['in_transit_stock']; ?></td>
										</tr>
									<?php
									
											}
									?>
										<?php /*<tr>
											<td class="center text-center srClass"></td>
											<td class="center text-left"><strong>Total Showroom</strong></td>
											<td class="center text-center"><strong><?php echo $sum_show_open; ?></strong></td>
											<td class="center text-center"><strong><?php echo $sum_show_stock_in; ?></strong></td>
											
											<td class="center text-center"><strong><?php echo $sum_show_buyback_stock; ?></strong></td>
											<td class="center text-center"><strong><?php echo $sum_show_stock_out; ?></strong></td>
											<td class="center text-center"><strong>&nbsp;</strong></td>
											<td class="center text-center"><strong><?php echo $sum_show_sales; ?></strong></td>
											<td class="center text-center"><strong><?php echo $sum_show_close; ?></strong></td>
											
											<td class="center text-center"><strong><?php echo $sum_show_in_transit; ?></strong></td>
										</tr>
										<tr>
											<td class="center text-center srClass"></td>
											<td class="center text-left"><strong>Total Store</strong></td>
											<td class="center text-center"><strong><?php echo $sum_store_open; ?></strong></td>
											<td class="center text-center"><strong><?php echo $sum_store_close; ?></strong></td>
											
											<td class="center text-center"><strong><?php echo $sum_store_stock_in; ?></strong></td>
											<td class="center text-center"><strong><?php echo $sum_store_stock_out; ?></strong></td>
											<td class="center text-center"><strong>&nbsp;</strong></td>
											<td class="center text-center"><strong><?php echo $sum_store_buyback_stock; ?></strong></td>
											<td class="center text-center"><strong><?php echo $sum_store_sales; ?></strong></td>
											
											<td class="center text-center"><strong><?php echo $sum_store_in_transit; ?></strong></td>
										</tr>*/?>
										<tr>
											<td class="center text-center srClass"></td>
											<td class="center text-left"><strong>Total</strong></td>
											<td class="center text-center"><strong><?php echo $openStockArray; ?></strong></td>
											<td class="center text-center"><strong><?php echo $stockInArray; ?></strong></td>
											<td class="center text-center"><strong><?php echo $buybackStockArray; ?></strong></td>
											<td class="center text-center"><strong><?php echo $stockOutArray; ?></strong></td>
											<td class="center text-center"><strong><?php echo $actualValueArray; ?></strong></td>
											<td class="center text-center"><strong><?php echo $salesStockArray; ?></strong></td>
											<td class="center text-center"><strong><?php echo $closingStockArray; ?></strong></td>
											<td class="center text-center"><strong><?php echo $intransitStockArray; ?></strong></td>
										</tr>
									<?php
										}
									?>
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
	
});

$("#form #reset_form_report").click(function (){
	$('#right_from').remove();
	$('#right_to').remove();
	//location.reload(); 
	
	});
	
function region()
{
  resionvalue=$("#region_id").val();
  $.ajax({
				url : "<?php echo base_url('report/getRegionlocation');?>",
				type: "POST",
				data: {resionvalue:resionvalue},
				success:function(res){
					$('#product_sold_div').html(res);
				}
	});
  
}
// $("#back_to_search").click(function(){
	// region_id=$("#region_id").val();
	// office_location=$("#office_location").val();
	// transaction_name=$("#transaction_name").val();
	
	// $.ajax({
				// url : "<?php echo base_url('report/getsearchdata');?>",
				// type: "POST",
				// data: {office_location:office_location,region_id:region_id,transaction_name:transaction_name},
				// success:function(res){
					// $('#stockReciptTable').html(res);
				// }
	// });
	
// });
$(document).ready(function() {
    $('#DataTables_Table_0').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
} );

function getOfficeLocation()
{
	var region_type = $('#region_type').val();
	$.ajax({
			url : "<?php echo base_url('report/getOfficeLocationByRegionType'); ?>",
			type: "POST",
			data: {region_type:region_type},
			success:function(res){
				//console.log(res);
				$('#locations').html(res);
			}
	});
}

</script>