<?php
error_reporting(E_All);
?>
<style type="text/css" media="print">
#reset_button{display:none;}
.btn-primary, .dataTables_filter, .dataTables_paginate, .breadcrumb, .breadcrumb-my-toggle, .dataTables_info, .dataTables_length {display : none;}
.showmyprint{width:50%; float:left;}
</style>
<style type="text/css" media="print">
#reset_button{display:none;}
.btn-primary, .dataTables_filter, .dataTables_paginate, .breadcrumb, .breadcrumb-my-toggle, .my-hide-div {display : none;}
.showmyprint{width:50%; float:left;}
#printby, .printby{display:block !important; font-weight:bold; padding:15px;}
.myheader{width:33%; float:left;}
.box, .box-content, .well{padding:0px !important;}
@page { size: landscape; }
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
					<div class="center text-center text-uppercase" style="font-size:18px; font-weight:bold;">MMTC-Indian Gold Coin</div>
					<?php if(!empty($office_data)){
						$disp_office_name=$office_data->office_name;
						$regionalStoreData_res = $this->db->select('*')->from('regional_store_master')->where(array('regional_store_id'=>$regional_store_id))->get()->row();
						if(!empty($regionalStoreData_res))
						{
							$disp_office_name=$regionalStoreData_res->regional_store_name;;
						} ?>
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
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">Tax Transaction Report</div>
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
						<div class="box-header well  my-hide-div">
							<h2>Tax Transaction Report</h2>
						</div>
						<div class="box-content ">
						<form method="post" id='form' action="<?php echo base_url('Report/adminTransactionTaxReport'); ?>" autcomplete="off"/>
							<div class="row  my-hide-div" >
							
							<div class="form-group col-lg-2 showmyprint">
									<label class="control-label">From Date</label>
									<input type="text" class="form-control" id="access_right_from" name="access_right_from" value="<?php echo $fromDate; ?>" />
									<?php echo form_error('access_right_from'); ?>
								</div>
								
								<div class="form-group col-lg-2 showmyprint">
									<label class="control-label">To Date</label>
									<input type="text" class="form-control" id="access_right_to" name="access_right_to" value="<?php echo $toDate;?>" />
								</div>
							<div class="control-group col-lg-2 showmyprint" id="region_div">
									<label class="control-label">Region</label><?php // print_r($selectedProduct); ?>
									<div class="controls" id="regionList">
										<select onChange="region();" name="region_id[]" id="region_id"  data-rel="chosen" class="form-control">
										
										<?php foreach($region_master as $region) {  ?>
											<option value="<?php echo $region->regional_store_id;?>" <?php echo  set_select('region_id[]', $region->regional_store_id);
											if(in_array($product->product_id,$selectedProduct)){ echo 'selected'; } ?> ><?php echo $region->regional_store_name;?></option>
										<?php } ?>
										</select>
									</div>
									<?php echo form_error('region_id[]'); ?>
								</div>
								<div class="control-group col-lg-2 showmyprint" id="product_sold_div">
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
							<div class="row">
							<div class="form-group col-lg-6">
								
									<input type="submit" value="Submit" name="submit" id="back_to_search"  class="btn btn-primary" style="margin-left:1%;margin-bottom:15px;"></input>
									<a href="<?php echo base_url('Report/adminTransactionTaxReport'); ?>" style="margin-left:1%;margin-bottom:15px;" class='btn btn-primary' />Reset</a>
									<a style="margin-left:1%;margin-bottom:15px;" href="javascript:void(0);" onClick="javascript:window.print();" class='btn btn-primary' >Print</a>
							</div>
							</div>
							</form>
							<div id="stockReciptTable">
								<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
									<thead>
										<tr>
											<th style='width: 40px;' class="text-center">S.No</th>
											<th style='width: 153px;' class="text-center">Date</th>
											<th style='width: 153px;' class="text-center">Invoice #</th>
											<th style='width: 143px;' class="text-center">Customer Name</th>
											<th style='width: 143px;' class="text-center">Item Description</th>
											<?php /*<th style='width: 153px;' class="text-center">User Id </th>
											*/?>
											<th style='width: 200px;' class="text-center">Payment Mode</th>
											<th style='width: 143px;' class="text-center">Net Amount (Rs.)</th>
											<!--<th class="text-center">Office Name</th>-->
											<th style='width: 143px;' class="text-center">VAT %</th>
											<!--<th style='width: 143px;' class="text-center">Refunded Amount</th>-->
											<th style='width: 143px;' class="text-center">VAT (Rs.)</th>
											<?php /*<th style='width: 153px;' class="text-center">Remarks</th>*/?>
											<th style='width: 143px;' class="text-center">Entry Tax %</th>
											<!--<th style='width: 143px;' class="text-center">Refunded Amount</th>-->
											<th style='width: 143px;' class="text-center">Entry Tax (Rs.)</th>
											<?php /*<th style='width: 153px;' class="text-center">Remarks</th>*/?>
											
										</tr>
									</thead>
										<tbody>
									<?php 
								      $all_location=array();
									if($this->input->post('submit'))
									{																		
										$region_id=$_POST['region_id'];
										$office_location=$_POST['office_location'];
										
										$this->db->select("office_master.*,regional_store_master.regional_store_type");
										$this->db->from("office_master ","regional_store_master");
										$this->db->join('regional_store_master',"office_master.regional_store_id=regional_store_master.regional_store_id","LEFT");
										$this->db->where("office_master.office_id !=",1);
										$this->db->where("office_master.office_operation_type",'showroom');
										if(!empty($region_id))
										{
										  $this->db->where_in("office_master.regional_store_id",$region_id);
										}
										if(!empty($office_location) && isset($office_location))
										{
										  $this->db->where_in("office_master.office_id",$office_location);

										}
										$query = $this->db->get();
		                                $all_location=$query->result();
									}else{
								     $all_location=$this->db->where("office_id !=",1)->where('office_operation_type','showroom')->get('office_master')->result();
									}
									  $i=1;
									  $total_total_net_amount='0';
										$total_paid_amount='0';
										$total_due_amount='0';
										$total_mode='0';
										$total_amount_refunded='0';
										$mynewRecord = array();
									   foreach($all_location as $location)
									   {
										   $office_operation_type=$location->office_operation_type;
										   $office_id=$location->office_id;										   
								       $get_all_record=$this->Report_model->_get_transaction_tax_report_data($office_operation_type,$office_id);
										if(!empty($get_all_record['get_all_record'])){ 

										// testing coding by Sushant - Start
											foreach($get_all_record['get_all_record'] as $record){
											//	print_r($record); die;
												$mynewRecord[] = array('transaction_date'=>$record->transaction_date,'invoice_number'=>$record->invoice_number,'invoice_type'=>$record->invoice_type,'invoice_id'=>$record->invoice_id,'total_amount'=>$record->total_amount,'amount_received'=>$record->amount_received,'surcharge_on_vat'=>$record->surcharge_on_vat,'amount_refunded'=>$record->amount_refunded,'adjustment'=>$record->adjustment,'created_date'=>$record->created_date,'officeId'=>$location->office_id,'customer_id'=>$record->customer_id,'invoice_date'=>$record->invoice_date);
											}
										}
									   }
										function dateSort($a, $b) {
										  $a = $a['created_date'];
										  $b = $b['created_date'];
										  if ($a == $b)
											return 0;
										  return ($a > $b) ? -1 : 1;
										}

										usort($mynewRecord, "dateSort");
									   // testing by Sushant - end
									 // echo '<pre>';  
									   // print_r($mynewRecord);
									   // echo '</pre>';
									   
									 $j = 1;
									$totalVat = array();
									$entryTaxArray = array();
									foreach($mynewRecord as $newRecord) {
										$checkDateInvoice = explode("-",$newRecord['invoice_date']);										
										$myInvoiceDate = $checkDateInvoice[0].'/'.$checkDateInvoice[1].'/'.$checkDateInvoice[2];
										
										$transaction_date = ($newRecord['transaction_date'] !='') ? $newRecord['transaction_date'] : $myInvoiceDate;
										?>
										<tr>
										
											<td class="text-center"><?php echo $j++;?></td>
											<td class="center text-center"><?php echo $transaction_date; ?></td>
											<td class="center text-center"><?php echo $newRecord['invoice_number'];?></td>
											<td class="center text-center"><?php echo getCustomerName($newRecord['customer_id']); ?></td>
											<td class="center text-center">
											<?php $product_invoice_table= 'invoice_showroom_product_'.$newRecord['officeId'];
											
											$this->db->select('*')->from($product_invoice_table);
											$this->db->where('invoice_id',$newRecord['invoice_id']);
											$this->db->where_in('payment_type', $payment_mode);
											$arr_products=$this->db->get()->result();
											foreach($arr_products as $arr_product)
											{
												echo "<b>".getProductShortCode($arr_product->product_id)."</b>: ".$arr_product->qunatity.'<br/>';
											}?></td>
											<td class="center text-center"><?php 
											if($newRecord['invoice_type']!='' && strtolower($newRecord['invoice_type'])!='purchase')
											{
											$payment_mode_table='invoice_showroom_payment_mode_'.$newRecord['officeId'];
											$arr_where['invoice_id']=$newRecord['invoice_id'];
											
											$this->db->select('*')->from($payment_mode_table);
											$this->db->where('invoice_id',$newRecord['invoice_id']);
											$this->db->where_in('payment_type', $payment_mode);
											$arr_payments=$this->db->get()->result();
											
											foreach($arr_payments as $payment)
											{

												echo ucwords($payment->payment_type).": "."₹".$payment->payment_amount."<br/>";
												
												$total_mode=$total_mode+$payment->payment_amount;
											}
												echo ucwords('Refunded Amount').": "."₹".$newRecord['amount_refunded'];
												$total_mode=$total_mode - $newRecord['amount_refunded'];
											}
											else
											{
												echo 'Cash: '."₹".number_format($newRecord['total_amount'],'2','.','');
												$total_mode=$total_mode + $newRecord['total_amount'];
											}
											?></td>
											<td class="center text-center">
											<?php 
											$total_net_amount=number_format(($newRecord['total_amount']+$newRecord['surcharge_on_vat']+$newRecord['adjustment']),'2','.','');
											echo "₹".$total_net_amount;
											?>
											</td>
											<td class="center text-center">
											<?php 
											$this->db->select('*')->from($product_invoice_table);
											$this->db->where('invoice_id',$newRecord['invoice_id']);
											$this->db->where_in('payment_type', $payment_mode);
											$arr_products=$this->db->get()->result();
											foreach($arr_products as $arr_product)
											{
												echo "<b>".getProductShortCode($arr_product->product_id)."</b>: ".$arr_product->tax.'%<br/>';
											}
											?>
											</td>
											<td class="center text-center">
											<?php 
											$this->db->select('*')->from($product_invoice_table);
											$this->db->where('invoice_id',$newRecord['invoice_id']);
											$this->db->where_in('payment_type', $payment_mode);
											$arr_products=$this->db->get()->result();
											$vat_total = 0;
											foreach($arr_products as $arr_product)
											{
												echo "<b>".getProductShortCode($arr_product->product_id)."</b>: ". "₹".round(($arr_product->qunatity * $arr_product->rate * $arr_product->tax) / 100,0).'<br/>';
												$vat_total = $vat_total + round(($arr_product->qunatity * $arr_product->rate * $arr_product->tax) / 100,0);
											}
											$totalVat[] = $vat_total;
											echo "<b>Total</b>: ". "₹".$vat_total.'<br/>';
											?>
											</td>
											<td class="center text-center">
											<?php 
											$this->db->select('*')->from($product_invoice_table);
											$this->db->where('invoice_id',$newRecord['invoice_id']);
											$this->db->where_in('payment_type', $payment_mode);
											$arr_products=$this->db->get()->result();
											foreach($arr_products as $arr_product)
											{
												echo "<b>".getProductShortCode($arr_product->product_id)."</b>: ".$arr_product->entry_tax.'%<br/>';
											}
											?>
											</td>
											<td class="center text-center">
											<?php 
											$this->db->select('*')->from($product_invoice_table);
											$this->db->where('invoice_id',$newRecord['invoice_id']);
											$this->db->where_in('payment_type', $payment_mode);
											$arr_products=$this->db->get()->result();
											$entry_tax_total = 0;
											foreach($arr_products as $arr_product)
											{
												echo "<b>".getProductShortCode($arr_product->product_id)."</b>: ". "₹".round(($arr_product->qunatity * $arr_product->rate * $arr_product->entry_tax) / 100,0).'<br/>';
												$entry_tax_total = $entry_tax_total + round(($arr_product->qunatity * $arr_product->rate * $arr_product->entry_tax) / 100,0);
											}
											$entryTaxArray[] = $entry_tax_total;
											echo "<b>Total</b>: ". "₹".$entry_tax_total.'<br/>';
											?>
											</td>
										</tr>
										<?php
										$total_total_net_amount=$total_total_net_amount+$total_net_amount;
										$total_paid_amount=$total_paid_amount+$amount_paid;
										$total_due_amount=$total_due_amount+$amount_due;
										$total_amount_refunded=$total_amount_refunded+$amount_refunded;
									}
									   ?>
									
									</tbody>
									<tfoot><tr>
											<th class="text-center" colspan="5" align="right">Total (Rs.) : &nbsp;</th>
											
											<th class="center text-center"><?php 
											// echo number_format($total_mode,'2','.','');?></th>
											<th class="center text-center">
											<?php 
											
											echo "₹".number_format($total_total_net_amount,'2','.','');
											?>
											</th>
											<th class="center text-center">
											<?php 
										
											// echo number_format($total_paid_amount,'2','.','');
											?>
											</th>
											
											<?php /*<th class="center text-center">
											<?php 
										
											echo number_format($total_amount_refunded,'2','.','');
											?>
											</th>*/?>
											<th class="center text-center">
											<?php 
												echo "₹".number_format(array_sum($totalVat),'2','.','');
											?>
											</th>
											<th class="center text-center">
											</th>
											<th class="center text-center">
											<?php 
												echo "₹".number_format(array_sum($entryTaxArray),'2','.','');
											?>
											</th>
											
										</tr></tfoot>
								</table>
								<table>
								   
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
    $( "#access_right_from" ).datepicker({
	  dateFormat: "dd/mm/yy",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
      $( "#access_right_to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#access_right_to" ).datepicker({
	  dateFormat: "dd/mm/yy",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#access_right_from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
	// $('#access_right_from').datepicker('setDate', new Date());   // open to show the date
	// $('#access_right_to').datepicker('setDate', new Date());
	
});

$("#form #reset_form_report").click(function (){
	$('#access_right_from').remove();
	$('#access_right_to').remove();
	//location.reload(); 
	
	});
	
	//$("#form #reset_form_report").click(function(){
    //$("#access_right_from").val('');
    //$("#access_right_to").val('');
    //$("#transaction_name_chosen").removeAttr('selected');

 //});
 
function region()
{
  resionvalue=$("#region_id").val();
  $.ajax({
				url : "<?php echo base_url('report/getRegionShowroom');?>",
				type: "POST",
				data: {resionvalue:resionvalue},
				success:function(res){
					$('#product_sold_div').html(res);
				}
	});
  
}

function selectAllProducts()
{
	$('#product_id option').attr('selected', 'selected');
	$('#product_id option:first').attr('selected', false);
	$('#product_id').trigger('chosen:updated');
}

function downloadTransaction()
{
	var regionIds = $('#region_id').val();
	var type_transaction = $('#type_transaction').val();
	var date_from = $('#access_right_from').val();
	var date_to = $('#access_right_to').val();
	var officeIds = $('#office_location').val();
	var payment_mode = $('#payment_mode').val();
	
	$.ajax({
			url : "<?php echo base_url('report/downloadTransaction'); ?>",
			type : "POST",
			data : {regionIds:regionIds,type_transaction:type_transaction,date_from:date_from,date_to:date_to,officeIds:officeIds,payment_mode:payment_mode},
			success: function(res){
				alert(res);
			}
	});
}
</script>