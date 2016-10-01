
<style>
.srClass, #printby{display:none;}
.printby{display:none;}
</style>
<style type="text/css" media="print">
thead { display: table-header-group; }
#reset_button{display:none;}
.btn-primary, .dataTables_filter, .dataTables_length, .dataTables_info, .dataTables_paginate, .breadcrumb, .breadcrumb-my-toggle, .my-hide-div {display : none;}
.showmyprint{width:50%; float:left;}
.box-header>h2{text-align:center;}
#printby, .printby{display:block !important; font-weight:bold; padding:15px;}
.myheader{width:33%; float:left;}
.box, .box-content, .well{padding:0px !important;}
</style>
<?php
// if($this->session->userdata('role_id')==0 && $this->session->userdata('office_id')==0)
// {
	// $add_value = 1;
    // $edit_value = 2;
    // $view_value = 3;
// }else
// {

	// $page_id = 15;
	// $page_permission_array = $this->role_model->get_page_permission($page_id);
	// //print_r($page_permission_array);die;
	// $add_value = $page_permission_array->add_value;
	// $edit_value = $page_permission_array->edit_value;
	// $view_value = $page_permission_array->view_value;
// }

// $countData = $this->db->select('*')->from('price_master')->where(array('price_date'=>date('d/m/Y')))->get()->result();

?>
<div class="ch-container">
    <div class="row my-container-class">
        <div id="content" class="col-lg-12 col-sm-12">
            <!-- content starts -->
            <div>
				<ul class="breadcrumb col-lg-12 col-sm-12">
					<li>
						<a href="<?php echo base_url('user/dashboard'); ?>">Home</a>
					</li>
					<li>
						<a href="#">Report</a>
					</li>
				</ul>
			</div>
			<?php if($this->session->flashdata('success_message')){ ?>
				<span class="alert alert-success col-lg-12">
					<button class="close" data-dismiss="alert" type="button">×</button>
                    <?php echo $this->session->flashdata('success_message'); ?>
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
					<div class="center text-center text-uppercase" style="font-size:16px; font-weight:bold;">Sales & BuyBack Price Report</div>
				</div>
			</div>
			<div class="row printby" style="margin-top:-20px;">
				<div class="col-lg-6 col-sm-6 col-xs-6">
					<label class="control-label">Search By Date :&nbsp;</label><span id="Search_Date"></span>
				</div>
				
			</div>
			<div class="row">
				<div class="box col-lg-12 col-md-12 col-xs-12" style="margin-top:-10px;">
					<div class="box-inner">
						<div class="box-header well my-hide-div">
							<h2>Sales & BuyBack Price Report</h2>
						</div>
						<div class="box-content">
							<div class="row my-hide-div">
								<div class="form-group col-lg-4">
									<label class="control-label">Search By Date</label>
									<input type="text" class="form-control" id="price_date_search" name="price_date_search" onchange="loadPriceTableList();" />
								</div>
							</div>
							
							<div class="row my-hide-div">
								<div class="form-group col-lg-6">
									<a style="margin-left:1%;margin-bottom:15px;" href="javascript:void(0);" onClick="javascript:window.print();" class='btn btn-primary' >Print</a>
								</div>
							</div>
							
							<div id="priceTableList">
								<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
									<thead>
										<tr>
											<th class="text-center">Sr. No.</th>
											<th class="text-center">Product Name</th>
											<th class="text-center">Price( Selling )</th>
											<th class="text-center">Price( BuyBack )</th>
											<th class="text-center">Actions</th>
										</tr>
									</thead>
										<tbody>
										<tr>
											<td class="text-center"></td>
											<td class="center text-center"></td>
											<td class="center text-center">₹</td>
											<td class="center text-center">₹</td>
											<td class="center text-center">
												<a class="btn my-btn-class btn-info" href="#" title="Edit">
													<i class="glyphicon glyphicon-edit icon-white"></i>
													Edit
												</a><!--
												<a class="btn btn-danger" href="#" title="Delete">
													<i class="glyphicon glyphicon-trash icon-white"></i>
													Delete
												</a> -->
											</td>
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
<script>
$(document).ready(function(){
	$('#Search_Date').html("");
	$('#price_date_search').datepicker({
		dateFormat:"dd/mm/yy"
	});
	$('#price_date_search').datepicker('setDate', new Date());
	loadPriceTableList();
});

function loadPriceTableList()
{
	var searchDate = $('#price_date_search').val();
	$.ajax({
			url : "<?php echo base_url('report/loadPriceTableList');?>",
			type : "POST",
			data : {searchDate:searchDate},
			success: function(res){
				$('#priceTableList').html(res);
				$('#Search_Date').html(searchDate);
			}
	});
}
</script>