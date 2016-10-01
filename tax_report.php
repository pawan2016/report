<div class="ch-container">
    <div class="row my-container-class">
        <div id="content" class="col-lg-12 col-sm-12">
            <!-- content starts -->
            <div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url('user/dashboard'); ?>">Home</a>
					</li>
					<li>
						<a href="#">Tax Report</a>
					</li>
				</ul>
			</div>
			<?php if($this->session->flashdata('success_message')){ ?>
				<span class="alert alert-success col-lg-12">
					<button class="close" data-dismiss="alert" type="button">×</button>
                    <?php echo $this->session->flashdata('success_message'); ?>
                </span>
			<?php } ?>
			<div class="row">
			<div class="col-md-8 col-md-push-2 half-md-div">
				<div class="box col-lg-12 col-md-12 col-xs-12">
					<div class="box-inner">
						<div class="box-header well">
							<h2>Tax Master Report</h2>
						</div>
						<div class="box-content">
							<div class="row">
								<div class="form-group col-lg-4">
									<label class="control-label">VAT for Unmounted Products </label>
								</div>
								<div class="form-group col-lg-6">
									<input type="text" class="form-control" readonly="readonly" id="vat_on_unmounted_products" name="vat_on_unmounted_products" value="<?php echo $tax_details->vat_on_unmounted_products; ?>" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-4">
									<label class="control-label">VAT for Mounted Products</label>
								</div>
								<div class="form-group col-lg-6">
									<input type="text" class="form-control" readonly="readonly" id="vat_on_mounted_products" name="vat_on_mounted_products" value="<?php echo $tax_details->vat_on_mounted_products; ?>" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-4">
									<label class="control-label">VAT for Medallions</label>
								</div>
								<div class="form-group col-lg-6">
									<input type="text" class="form-control" readonly="readonly" id="vat_on_medallions" name="vat_on_medallions" value="<?php echo $tax_details->vat_on_medallions; ?>" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-4">
									<label class="control-label">VAT for Bars</label>
								</div>
								<div class="form-group col-lg-6">
									<input type="text" class="form-control" readonly="readonly" id="vat_on_bars" name="vat_on_bars" value="<?php echo $tax_details->vat_on_bars; ?>" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-4">
									<label class="control-label">Surcharge on VAT</label>
								</div>
								<div class="form-group col-lg-6">
									<input type="text" class="form-control disabled" readonly="readonly" id="surcharge_on_vat" name="surcharge_on_vat" value="<?php echo $tax_details->surcharge_on_vat; ?>" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-4">
									<label class="control-label">Entry Tax</label>
								</div>
								<div class="form-group col-lg-6">
									<input type="text" class="form-control disabled" readonly="readonly" id="entry_tax" name="entry_tax" value="<?php echo $tax_details->entry_tax; ?>" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div><!--/row-->
    <!-- content ends -->
		</div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->