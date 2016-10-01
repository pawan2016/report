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
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-12 col-sm-12">
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">Sale & Inventory Detail</div>
				</div>
			</div>
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">From Date :&nbsp;</label><?php echo $fromDate; ?>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">To Date :&nbsp;</label><?php echo $tbreportDate; ?>
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
							<h2>Sale & Inventory Detail Report</h2>
						</div>
						<div class="box-content">
						<form method="post" id='form' action="<?php echo base_url('Report/saleInventoryReportdetail'); ?>" autcomplete="off"/>
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
											<option value="all" <?php echo  set_select('region_type','all'); ?> >Select All</option>
											<option value="mmtc" <?php echo  set_select('region_type','mmtc'); ?> >MMTC</option>
											<option value="others" <?php echo  set_select('region_type','others'); ?> >Others</option>
										</select>
									</div>
								</div>
								<div class="control-group col-lg-2" id="regions">
									<label class="control-label">Region Location</label>
									<div class="controls">
										<select name="region_id[]" id="region_id" data-rel="chosen" class="form-control" onChange="getOfficeLocations();" multiple >
											<?php foreach($regionLists as $region){?>
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
									<a style="margin-left:1%;margin-bottom:15px;" href="<?php echo base_url('Report/saleInventoryReportnew'); ?>" class='btn btn-primary' >Reset</a>
									<a style="margin-left:1%;margin-bottom:15px;" href="javascript:void(0);" onclick="javascript:window.print();" class='btn btn-primary' >Print</a>
								</div>
							</div>
						</form>
						<?php $j= 0; foreach($all_products as $pkey=>$product)
						{
							$j++;
						}
						?>
							<div id="stockReciptTable" style="width:1250px;overflow-x:auto;">
								<table  class="table table-striped table-bordered responsive">
									<thead>
										<tr>
											<th class="text-center srClass">Sr. No.</th>
											<th class="text-center" style="width:10%;" ></th>
											<th class="text-center" style="width:70%;" colspan="<?php echo count($all_products) * 7; ?>" >Coin Sales</th>
											<th class="text-center" style="width:20%;" colspan="4" >Inventory in KGs</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th class="text-center srClass">Sr. No.</th>
											<th class="text-left" rowspan="2">Showroom</th>
											<?php foreach($all_products as $pkey=>$product)
										{
										?>
											<th class="center text-center" colspan="7" style="border-left:2px solid #dddddd;"><?php echo $product->product_weight; ?>g</th>
										<?php 
										}
										?>
											<td class="text-center" colspan="4"></td>
										</tr>
										<tr class="my-heading">
											<td class="center text-center srClass"></td>
										<?php
										
										foreach($all_products as $pkey=>$product)
										{
										?>
											<td class="center text-center" style="border-left:2px solid #dddddd;">Opening Stock</td>
											
											<td class="center text-center">Stock In (+)</td>
											<td class="center text-center">Buy Back (+)</td>
											
											<td class="center text-center">Sale (-)</td>
											<td class="center text-center">Stock out (-)</td>
											<td class="center text-center">Closing Stock</td>
											<td class="center text-center">In transit Stock</td>
											
										<?php 
										}
										?>
											<td class="text-center" style="border-left:2px solid #dddddd;">Total Qty in KG</td>
											<td class="text-center">Total Sold Qty in KG</td>
											<td class="text-center">Total Balance Qty in KG</td>
											<td class="text-center">Total In transit Qty in KG</td>
										</tr>
									<?php 
										$totalSuppliedArray = array();
										$previousSaleArray = array();
										$cumulativeSaleArray = array();
										$balanceQtyArray = array();
										$totalSuppliedWtArray = array();
										$totalSaleWtArray = array();
										$totalBalWtArray = array();
										
										foreach($get_all_record as $officeId=>$record){
										
										if($record[$product->product_id]['status_disp']=='')
										{
											
										
										?>
										<tr style=" border-bottom: 2px solid #ccc;">
											<td class="center text-center srClass"></td>
											<td class="center text-left region-class"><?php echo getOfficeLocation($officeId); ?></td>
											
										<?php
										$totalWeight = 0;
										$soldWeight = 0;
										$balanceWeight = 0;
										$intransitWeight = 0;
											foreach($all_products as $pkey=>$product)
											{
											$totalSuppliedArray[$product->product_id][] = $record[$product->product_id]['opening_stock'];
											$stockinArray[$product->product_id][] = $record[$product->product_id]['stock_in'];
											$cumulativeSaleArray[$product->product_id][] = $record[$product->product_id]['sales_stock_all'];
											$deletedSaleArray[$product->product_id][] = $record[$product->product_id]['deleted_sales'];
											$buybackSaleArray[$product->product_id][] = $record[$product->product_id]['buyback'];
											$balanceQtyArray[$product->product_id][] = $record[$product->product_id]['closing_stock'];
											$stockoutArray[$product->product_id][] = $record[$product->product_id]['stock_out'];
											$intransitArray[$product->product_id][] = $record[$product->product_id]['in_transit_product'];
											
											$my_percentage = 0;
											$my_percentage = round(($record[$product->product_id]['closing_stock'] * 100) / $record[$product->product_id]['opening_stock'],2);
										//	$totalWeight = $totalWeight + ($record[$product->product_id]['mint_stock_all'] * $product->product_weight);
											if(getOfficeOperationType($officeId) == 'showroom')
											{
												$totalWeight = $totalWeight + ($record[$product->product_id]['mint_stock_all'] * $product->product_weight);
											}
											if(getOfficeOperationType($officeId) == 'store')
											{
												$totalWeight = $totalWeight + ($record[$product->product_id]['closing_stock'] * $product->product_weight);
											}
											// - $record[$product->product_id]['deleted_sales']
											$soldWeight = $soldWeight + (($record[$product->product_id]['sales_stock_all'])* $product->product_weight);
											$balanceWeight = $balanceWeight + ($record[$product->product_id]['closing_stock'] * $product->product_weight);
											$intransitWeight = $intransitWeight + ($record[$product->product_id]['in_transit_product'] * $product->product_weight);
											
										?>
											<td class="center text-center" style="border-left:2px solid #dddddd;"><?php echo ($record[$product->product_id]['opening_stock']) ? $record[$product->product_id]['opening_stock'] : "0"; ?></td>
											<td class="center text-center"><?php echo ($record[$product->product_id]['stock_in']) ? $record[$product->product_id]['stock_in'] : "0"; ?></td>
											<td class="center text-center"><?php echo ($record[$product->product_id]['buyback']) ? $record[$product->product_id]['buyback'] : "0"; ?></td>
											<?php /*<td class="center text-center"><?php echo ($record[$product->product_id]['deleted_sales']) ? 0 : 0; ?></td>*/?>
											<td class="center text-center"><?php echo ($record[$product->product_id]['sales_stock_all']) ? $record[$product->product_id]['sales_stock_all'] : "0"; ?></td>
											<td class="center text-center"><?php echo ($record[$product->product_id]['stock_out']) ? $record[$product->product_id]['stock_out'] : "0"; ?></td>
											<td class="center text-center"><?php echo ($record[$product->product_id]['closing_stock']) ? $record[$product->product_id]['closing_stock'] : "0"; ?></td>
											<td class="center text-center"><?php echo ($record[$product->product_id]['in_transit_product']) ? $record[$product->product_id]['in_transit_product'] : "0"; ?></td>
											
										<?php 
											}
											
											$totalSuppliedWtArray[] = $totalWeight;
											$totalSaleWtArray[] = $soldWeight;
											$totalBalWtArray[] = $balanceWeight;
											$totalintransWtArray[] = $intransitWeight;
										?>
											<td class="center text-center" style="border-left:2px solid #dddddd;"><?php echo round($totalWeight/1000,3); ?></td>
											<td class="center text-center"><?php echo round($soldWeight/1000,3); ?></td>
											<td class="center text-center"><?php echo round($balanceWeight/1000,3); ?></td>
											<td class="center text-center"><?php echo round($intransitWeight/1000,3); ?></td>
										</tr>
									<?php
									}									
									} ?>
										<tr class="my-heading2">
											<td class="center text-center srClass"></td>
											<th class="center text-left">Total</th>
										<?php
										$total_summary_stockin=0;
										$total_summary_stockout=0;
										foreach($all_products as $pkey=>$product)
										{
											$total_percentage = 0;
											$total_summary_stockin=$total_summary_stockin+(array_sum($stockinArray[$product->product_id])*$product->product_weight);
											$total_summary_stockout=$total_summary_stockout+(array_sum($stockoutArray[$product->product_id])*$product->product_weight);
											
											$total_percentage = round((array_sum($balanceQtyArray[$product->product_id]) * 100) / array_sum($totalSuppliedArray[$product->product_id]),2);
										?>
											<td class="center text-center" style="border-left:2px solid #dddddd;"><?php echo array_sum($totalSuppliedArray[$product->product_id]); ?></td>
											<td class="center text-center"><?php if(($region_type_post=='all' || $region_type_post=='mmtc') && $region_id_post=='' && $office_location_post=='') { echo ''; } else { echo array_sum($stockinArray[$product->product_id]); } ?></td>
											<td class="center text-center"><?php echo array_sum($buybackSaleArray[$product->product_id]); ?></td>
											<?php /*<td class="center text-center"><?php echo array_sum($deletedSaleArray[$product->product_id]); ?></td>*/?>
											<td class="center text-center"><?php echo array_sum($cumulativeSaleArray[$product->product_id]); ?></td>
											<td class="center text-center"><?php if(($region_type_post=='all' || $region_type_post=='mmtc')  && $region_id_post=='' && $office_location_post=='') { echo ''; } else { echo array_sum($stockoutArray[$product->product_id]); } ?></td>
											<td class="center text-center"><?php echo array_sum($balanceQtyArray[$product->product_id]); ?></td>
											<td class="center text-center"><?php echo array_sum($intransitArray[$product->product_id]); ?></td>
											
										<?php 
										}
										?>
											<td class="text-center" style="border-left:2px solid #dddddd;"><?php echo round(array_sum($totalSuppliedWtArray)/1000,3); ?></td>
											<td class="text-center"><?php echo round(array_sum($totalSaleWtArray)/1000,3); ?></td>
											<td class="text-center"><?php echo round(array_sum($totalBalWtArray)/1000,3); ?></td>
											<td class="text-center"><?php echo round(array_sum($totalintransWtArray)/1000,3); ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<div id="stockReciptTable_12" style="margin-top:20px;" >
								<table  class="table table-striped table-bordered responsive">
									
										<tr>
											<th class="text-center srClass">Sr. No.</th>
											<th class="text-center" style="width:10%;" ></th>
											<th class="text-center" style="width:70%;" colspan="<?php echo count($all_products) * 1; ?>" >Coin Received</th>
											<th class="text-center" style="width:20%;"  >Inventory in KGs</th>
										</tr>
									
									<tbody>
										<tr>
											<th class="text-center srClass">Sr. No.</th>
											<th class="text-left" rowspan="2">Store</th>
											<?php foreach($all_products as $pkey=>$product)
										{
										?>
											<th class="center text-center" style="border-left:2px solid #dddddd;"><?php echo $product->product_weight; ?>g</th>
										<?php 
										}
										?>
										<th class="text-center"></th>	
										</tr>
										<tr class="my-heading">
											<td class="center text-center srClass"></td>
										<?php
										
										foreach($all_products as $pkey=>$product)
										{
										?>
											<td class="center text-center" style="border-left:2px solid #dddddd;">Reciept from Fabricator</td>
											
											
											
										<?php 
										}
										?>
											<td class="text-center" style="border-left:2px solid #dddddd;">Total Reciept in KG</td>
											
										</tr>
									<?php 
										$totalRecieptArray = array();
										
										
										foreach($get_all_record_vendor as $officeId=>$record)
										{ 
										$flag_display_row=0;
										foreach($all_products as $pkey=>$product)
											{
												if($record[$product->product_id]['stockInData_vendor']>0)
												{
													$flag_display_row=1;
												}
											}
										if($flag_display_row==1)
										{
											
										
										?>
										<tr style=" border-bottom: 2px solid #ccc;">
											<td class="center text-center srClass"></td>
											<td class="center text-left region-class"><?php echo getOfficeLocation($officeId); ?></td>
											
										<?php
										//$totalWeight = 0;
										$totalReciept = 0;
										$balanceWeight = 0;
										$intransitWeight = 0;
											foreach($all_products as $pkey=>$product)
											{
											$totalRecieptArray[$product->product_id][] = $record[$product->product_id]['stockInData_vendor'];
											
											
											
											// - $record[$product->product_id]['deleted_sales']
											$totalReciept = $totalReciept + (($record[$product->product_id]['stockInData_vendor'])* $product->product_weight);
										
											
										?>
											<td class="center text-center" style="border-left:2px solid #dddddd;"><?php echo ($record[$product->product_id]['stockInData_vendor']) ? $record[$product->product_id]['stockInData_vendor'] : "0"; ?></td>
											
											
										<?php 
											}
											
											
											$totalRecieptWtArray[] = $totalReciept;
											
										?>
											<td class="center text-center" style="border-left:2px solid #dddddd;"><?php echo round($totalReciept/1000,3); ?></td>
											
										</tr>
									<?php
										}
									} ?>
										<tr class="my-heading2">
											<td class="center text-center srClass"></td>
											<th class="center text-left">Total</th>
										<?php
										
										foreach($all_products as $pkey=>$product)
										{
											
										?>
											
											<td class="center text-center"><?php echo array_sum($totalRecieptArray[$product->product_id]); ?></td>
										
											
										<?php 
										}
										?>
											<td class="text-center" style="border-left:2px solid #dddddd;"><?php echo round(array_sum($totalRecieptWtArray)/1000,3); ?></td>
											
										</tr>
									</tbody>
								</table>
							</div>
						
						
						
						
						<div id="stockReciptTable_13" style="margin-top:20px;" >
						<table width="100%">
						<tr><td width="50%">
								<table  class="table table-striped table-bordered responsive">
										
										<tr>
											<th class="text-center" colspan="2">Summary in KGs</th>
											
										</tr>
									
									<tbody>
										
										<tr style=" border-bottom: 2px solid #ccc;">
										
											<td class="center text-left region-class">Opening Stock</td>
											<td class="center text-center"><?php
											
											$opening_stock_summary=array_sum($totalSuppliedWtArray)-($total_summary_stockin-array_sum($totalRecieptWtArray))-array_sum($totalRecieptWtArray)+$total_summary_stockout;
											echo round($opening_stock_summary/1000,3); ?></td>
										</tr>
										<?php
										$stockin_summary=($total_summary_stockin-array_sum($totalRecieptWtArray));
										//if(($region_type_post=='all' || $region_type_post=='mmtc') && $region_id_post=='' && $office_location_post=='') {  } else {
											?>
										<tr style=" border-bottom: 2px solid #ccc;">
										
											<td class="center text-left region-class">Stock In</td>
											<td class="center text-center"><?php  echo round($stockin_summary/1000,3); ?></td>
										</tr>
										<?php
										//}
										?>
										<tr style=" border-bottom: 2px solid #ccc;">
										
											<td class="center text-left region-class">Minted Coins</td>
											<td class="center text-center"><?php echo round(array_sum($totalRecieptWtArray)/1000,3); ?></td>
										</tr>
										<?php
										//if(($region_type_post=='all' || $region_type_post=='mmtc') && $region_id_post=='' && $office_location_post=='') {  } else {
											?>
										<tr style=" border-bottom: 2px solid #ccc;">
										
											<td class="center text-left region-class">Stock Out</td>
											<td class="center text-center"><?php echo round($total_summary_stockout/1000,3); ?></td>
										</tr>
										<?php
										//}
										?>
										<tr style=" border-bottom: 2px solid #ccc;">
										
											<td class="center text-left region-class">Sales</td>
											<td class="center text-center"><?php echo round(array_sum($totalSaleWtArray)/1000,3); ?></td>
										</tr>
										<tr style=" border-bottom: 2px solid #ccc;">
										
											<td class="center text-left region-class">Closing Stock</td>
											<td class="center text-center"><?php 
											
											$balance_summary=$opening_stock_summary+$stockin_summary+array_sum($totalRecieptWtArray)-$total_summary_stockout-array_sum($totalSaleWtArray);
											echo round($balance_summary/1000,3); ?></td>
										</tr>
										<tr style=" border-bottom: 2px solid #ccc;">
										
											<td class="center text-left region-class">Stock In Transit</td>
											<td class="center text-center"><?php echo round(array_sum($totalintransWtArray)/1000,3); ?></td>
										</tr>
									</tbody>
								</table>
							
							</td>
							<td width="50%" valign="top">
							<table  class="table table-striped table-bordered responsive">
									
										<tr>
											<th class="text-center" >Physical Stock in Kg: <?php
											$py_stock=$balance_summary+array_sum($totalintransWtArray);
											echo round($py_stock/1000,3);?></th>
											
										</tr>
									
									
								</table>
							</td>
							</tr></table>
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