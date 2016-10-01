<style>
.srClass{display:none;}
.my-heading td{font-size:11px; font-weight:bold;}
.my-heading2 td{font-size:14px; font-weight:bold;}
.region-class{font-size:11px; font-weight:bold;}
#printby, .printby{display:none;}
</style>
<style type="text/css" media="print">
#reset_button{display:none;}
.btn-primary, .breadcrumb, .breadcrumb-my-toggle, .my-hide-div {display : none;}
.showmyprint{width:50%; float:left;}
.box-header>h2{text-align:center;}
#printby, .printby{display:block !important; font-weight:bold; padding:15px;}
.myheader{width:33%; float:left;}
.box, .box-content, .well{padding:0px !important;}
@page { size: landscape; margin-top:35px;}
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
				<div class="col-lg-12 col-sm-12">
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">Transfer Report</div>
				</div>
			</div>
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">From Date :&nbsp;</label><?php echo $fromDate; ?>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">To Date :&nbsp;</label><?php echo $toDate; ?>
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
							<h2>Transfer Report</h2>
						</div>
						<div class="box-content">
						<form method="post" id='form' action="<?php echo base_url('Report/stock_transfer_recieve_inventory'); ?>" autcomplete="off"/>
							<div class="row my-hide-div">
								<div class="form-group col-lg-2 showmyprint">
									<label class="control-label">From Date</label>
									<input type="text" class="form-control" id="fromDate" name="fromDate" value="<?php echo $fromDate; ?>" />
								</div>
								<div class="form-group col-lg-2 showmyprint">
									<label class="control-label">To Date</label>
									<input type="text" class="form-control" id="toDate" name="toDate" value="<?php echo $toDate; ?>" />
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
										<select name="office_location[]" id="office_location" data-rel="chosen" class="form-control" multiple >
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
									<a style="margin-left:1%;margin-bottom:15px;" href="<?php echo base_url('Report/saleInventoryReport'); ?>" class='btn btn-primary' >Reset</a>
									<a style="margin-left:1%;margin-bottom:15px;" href="javascript:void(0);" onclick="javascript:window.print();" class='btn btn-primary' >Print</a>
								</div>
							</div>
						</form>
						<?php $j= 0; foreach($all_products as $pkey=>$product)
						{
							$j++;
						}
						?>
							<div id="stockReciptTable">
								<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
									<thead>
										<tr>
											<th class="text-left">Sr. No.</th>
											<th class="text-left">Transfer from</th>
											<th class="text-left">Date of Transfer</th>
											<th class="text-left">Date of Reciept</th>
											<th class="text-left">Transfer To</th>
											<th class="text-left">Stock Transfer No.</th>
											<th class="text-left"><b>Products:</b> Qty</th>
											<!--<th class="text-left">Narration</th>
											<th class="text-center">Office Name</th>-->
											<th class="text-left">Status</th>
											
										</tr>
									</thead>
										<tbody>
									<?php 
									$i=1;
									foreach($ofcDatas as $ofc)
									{
										
								$transfer_product_table='inventory_'.$ofc->office_operation_type.'_stock_transfer_product_'.$ofc->office_id;
								
								
									if(!empty($stock_receipt_details[$ofc->office_id])){ 
									foreach($stock_receipt_details[$ofc->office_id] as $Stock_receipt_details){
										
								$recipet_table='inventory_'.$Stock_receipt_details->office_operation_type.'_stock_receipt_'.$Stock_receipt_details->stock_transfer_to_office_id;
								$receipt_data=$this->db->query("select * from ".$recipet_table." where stock_transfer_number='".$Stock_receipt_details->stock_transfer_number."' order by stock_receipt_id desc limit 1")->row();
								if(empty($receipt_data) || date('d/m/Y',strtotime($receipt_data->authorized_date)) != date('d/m/Y',strtotime($Stock_receipt_details->authorized_date)))
								{
									
									?>
										<tr>
											<td class="text-left"><?php echo $i++;?></td>
											<td class="center text-left"><?php echo $ofc->office_name;//." - ".$ofc->office_id ;?></td>
											<td class="center text-left"><?php echo date('d/m/Y H:i:s',strtotime($Stock_receipt_details->authorized_date));?></td>
											<td class="center text-center">
											<?php 
											if(!empty($receipt_data)) { if($receipt_data->authorized_date!='') { echo date('d/m/Y H:i:s',strtotime($receipt_data->authorized_date)); }
											else { echo ''; }
											} 
											else{
												
												echo 'Not Authorized';
											}?>
											</td>
											<td class="center text-left"><?php echo ucwords($Stock_receipt_details->office_name);/*.', '. $Stock_receipt_details->office_address.', '.getCityName($Stock_receipt_details->city_id).', '.getDistrictName($Stock_receipt_details->district_id).', '.getStateName($Stock_receipt_details->state_id))*/;?></td>
											<td class="center text-left"><?php echo $Stock_receipt_details->stock_transfer_number;?></td>
											<td class="center text-center"><?php 
$productList=$this->db->get_where($transfer_product_table,array('stock_transfer_id'=>$Stock_receipt_details->stock_transfer_id))->result();
											foreach($productList as $product)
											{
												$productName = getProductShortCode($product->product_id);
												echo '<b>'.ucwords($productName)."</b>: ".$product->stock_transfer_product_quantity.'<br/>';
												$totalProductArray[$product->product_id][] = $product->stock_transfer_product_quantity;
											}
											
												?>
											</td>
												<!--<td class="center text-left"><?php echo $Stock_receipt_details->stock_transfer_narration;?></td>
										<td class="center text-center"><?php //echo $Stock_receipt_details->stock_transfer_from;?></td>-->
											<td class="center text-left"><?php echo ($Stock_receipt_details->stock_transfer_status=='1')?'Received':'In-transit';?><?php echo ($Stock_receipt_details->access_level_status=='1')?'/Authorized':'';?></td>
											
										</tr>
									<?php
									}
									
									} } 
									
									} ?>
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
    $( "#fromDate" ).datepicker({
		  dateFormat: "dd/mm/yy",
		  changeMonth: true,
		  numberOfMonths: 1,
		  onClose: function( selectedDate ) {
		  $( "#toDate" ).datepicker( "option", "minDate", selectedDate );
		  }
		});
		$( "#toDate" ).datepicker({
		  dateFormat: "dd/mm/yy",
		  changeMonth: true,
		  numberOfMonths: 1,
		  maxDate :"-1",
		  onClose: function( selectedDate ) {
			$( "#fromDate" ).datepicker( "option", "maxDate", selectedDate );
		  }
		});
});

function getRegionLocation()
{
	var region_type = $('#region_type').val();
	$('#office_location').val('');
	$.ajax({
			url : "<?php echo base_url('report/getMultiRegionList'); ?>",
			type: "POST",
			data: {region_type:region_type},
			success:function(res){
				//console.log(res);
				$('#office_location').val('');
				$('#regions').html(res);
			}
	});
}

function getOfficeLocations()
{
	var regionvalue = $('#region_id').val();
	
	$.ajax({
			url : "<?php echo base_url('report/getRegionLocation'); ?>",
			type: "POST",
			data: {resionvalue:regionvalue},
			success:function(res){
				//console.log(res);
				$('#locations').html(res);
			}
	});
}

</script>