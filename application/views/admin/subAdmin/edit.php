<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?= $title;?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo site_url();?>/SubAdmin/manage">Manage Sub Admin</a></li>
			<li class="active"><?= $title;?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-10">
				<form role="form" method="post" id="specialitiesForm" enctype="multipart/form-data">
					<div class="box box-warning">
						<div class="box-header with-border">
							<h3 class="box-title"><?= $title;?></h3>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label>Name*</label>
								<input type="text" class="form-control" value="<?php echo $details['name']?>" name="username" placeholder="Name">
								<div class="form-error1"><?= form_error('username');?></div>
							</div>
							<div class="form-group">
								<label>Email*</label>
								<input type="text" class="form-control" value="<?php echo $details['email']?>" name="email" placeholder="Email">
								<div class="form-error1"><?= form_error('email');?></div>
							</div>
							<div class="form-group">
								<label>Mobile*</label>
								<input type="number" class="form-control" value="<?php echo $details['phone']?>" name="phone" placeholder="Mobile">
								<div class="form-error1"><?= form_error('phone');?></div>
							</div>
							<div class="form-group">

								<label>Assign Role*</label>

								<select class="form-control" id="sel1" name="assignRole">
							    <option value="">Select Role</option>
							    <option <?php if($details['assignRole'] == 'SUBADMIN'){ echo "selected"; }?> value="SUBADMIN">SUBADMIN</option>
							    <option <?php if($details['assignRole'] == 'ADMIN'){ echo "selected"; }?> value="ADMIN">ADMIN</option>
         <!--         <option <?php if($details['assignRole'] == 'VIDEO MANAGEMENT'){ echo "selected"; }?> value="VIDEO MANAGEMENT">VIDEO MANAGEMENT</option>-->
									<!--<option <?php if($details['assignRole'] == 'REPORTS MANAGEMENT'){ echo "selected"; }?> value="REPORTS MANAGEMENT">REPORTS MANAGEMENT</option>-->
							  <!--  <option <?php if($details['assignRole'] == 'PAYMENT MANAGEMENT'){ echo "selected"; }?> value="PAYMENT MANAGEMENT">PAYMENT MANAGEMENT</option>-->
									<!--<option <?php if($details['assignRole'] == 'OFFLINE PAYMENT MANAGEMENT'){ echo "selected"; }?> value="OFFLINE PAYMENT MANAGEMENT">OFFLINE PAYMENT MANAGEMENT</option>-->

							  </select>

								<div class="form-error1"><?= form_error('assignRole');?></div>

							</div>
							<div class="form-group">
								<label>Picture*</label>
								<input type="file" class="form-control" name="image"> <br><br>
						  <img src="<?php echo base_url().$details['image'] ?>" style="width: 280px;height: 280px"><br>
								<div class="form-error1"><?= form_error('image');?></div>
							</div>
							<input type="hidden" value="<?php echo $details['id']?>" name="id">
							<div class="form-group">
								<button type="reset" class="btn btn-danger">Cancel</button>
								<input type="submit" class="btn btn-success pull-right" name="submit" value="Submit">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
