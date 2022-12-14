<div class="content-wrapper">

	<section class="content-header">

		<h1>

			<?= $title;?>

		</h1>

		<ol class="breadcrumb">

			<li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

			<li><a href="<?php echo site_url();?>/subAdmin/manage">Manage Sub Admin</a></li>

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

								<input type="text" class="form-control" value="<?= set_value('username');?>" name="username" placeholder="Name">

								<div class="form-error1"><?= form_error('username');?></div>

							</div>

							<div class="form-group">

								<label>Email*</label>

								<input type="text" class="form-control" value="<?= set_value('email');?>" name="email" placeholder="Email">

								<div class="form-error1"><?= form_error('email');?></div>

							</div>

							<div class="form-group">

								<label>Mobile*</label>

								<input type="number" class="form-control" value="<?= set_value('phone');?>" name="phone" placeholder="Mobile">

								<div class="form-error1"><?= form_error('phone');?></div>

							</div>

							<div class="form-group">

								<label>Password*</label>

								<input type="password" class="form-control" value="<?= set_value('password');?>" name="password" placeholder="password">

								<div class="form-error1"><?= form_error('password');?></div>

							</div>

							<div class="form-group">

								<label>Confirm Password*</label>

								<input type="password" class="form-control" value="<?= set_value('cpassword');?>" name="cpassword" placeholder="password">

								<div class="form-error1"><?= form_error('cpassword');?></div>

							</div>
							
							<?php
							if($admin['role'] == '0'){?>

							 <div class="form-group">

								<label>Assign Role*</label>

								<select class="form-control" id="sel1" name="assignRole">
							    <option value="">Select Role</option>
							    <option value="ADMIN">ADMIN</option>
							    <option value="SUBADMIN">SUBADMIN</option>
                  <!--<option value="VIDEO MANAGEMENT">VIDEO MANAGEMENT</option>-->
									<!--<option value="REPORTS MANAGEMENT">REPORTS MANAGEMENT</option>-->
							    <!--<option value="PAYMENT MANAGEMENT">PAYMENT MANAGEMENT</option>-->
									<!--<option value="OFFLINE PAYMENT MANAGEMENT">OFFLINE PAYMENT MANAGEMENT</option>-->

							  </select>

								<div class="form-error1"><?= form_error('assignRole');?></div>

							</div>
							<?php
							}elseif($admin['assignRole'] == 'ADMIN'){?>
							
							 <div class="form-group">

								<label>Assign Role*</label>

								<select class="form-control" id="sel1" name="assignRole">
							    <option value="">Select Role</option>
							     
							    <option value="SUBADMIN">SUBADMIN</option>
                  <!--<option value="VIDEO MANAGEMENT">VIDEO MANAGEMENT</option>-->
									<!--<option value="REPORTS MANAGEMENT">REPORTS MANAGEMENT</option>-->
							    <!--<option value="PAYMENT MANAGEMENT">PAYMENT MANAGEMENT</option>-->
									<!--<option value="OFFLINE PAYMENT MANAGEMENT">OFFLINE PAYMENT MANAGEMENT</option>-->

							  </select>

								<div class="form-error1"><?= form_error('assignRole');?></div>

							</div>
							<?php
							}?>

							<div class="form-group">

								<label>Picture*</label>

								<input type="file" class="form-control" name="image">

								<div class="form-error1"><?= form_error('image');?></div>

							</div>

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
