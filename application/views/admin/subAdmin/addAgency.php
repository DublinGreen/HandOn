<div class="content-wrapper">

	<section class="content-header">

		<h1>

			<?= $title;?>

		</h1>

		<ol class="breadcrumb">

			<li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

			<li><a href="<?php echo site_url();?>/subAdmin/manage">Manage Agency</a></li>

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

								<label>Username*</label>

								<input type="text" class="form-control" value="<?= set_value('username');?>" name="username" placeholder="Username">

								<div class="form-error1"><?= form_error('username');?></div>

							</div>

							<div class="form-group">

								<label>Email*</label>

								<input type="text" class="form-control" value="<?= set_value('email');?>" name="email" placeholder="Email">

								<div class="form-error1"><?= form_error('email');?></div>

							</div>
							
							<div class="form-group">

								<label>Special Approval Name*</label>

								<input type="text" class="form-control" value="<?= set_value('special_approval_name');?>" name="special_approval_name" placeholder="special_approval_name">

								<div class="form-error1"><?= form_error('special_approval_name');?></div>

							</div>
							
							<div class="form-group">

								<label>Deposit Amount*</label>

								<input type="text" class="form-control" value="<?= set_value('deposit_amount');?>" name="deposit_amount" placeholder="deposit_amount">

								<div class="form-error1"><?= form_error('deposit_amount');?></div>

							</div>
							
							<div class="form-group">

								<label>Bank Name*</label>

								<input type="text" class="form-control" value="<?= set_value('bank_name');?>" name="bank_name" placeholder="bank_name">

								<div class="form-error1"><?= form_error('bank_name');?></div>

							</div>
							
							<div class="form-group">

								<label>Account Number*</label>

								<input type="text" class="form-control" value="<?= set_value('account_num');?>" name="account_num" placeholder="account_num">

								<div class="form-error1"><?= form_error('account_num');?></div>

							</div>
							
							<div class="form-group">

								<label>IFSC Code*</label>

								<input type="text" class="form-control" value="<?= set_value('IFCS_code');?>" name="IFCS_code" placeholder="IFCS_code">

								<div class="form-error1"><?= form_error('IFCS_code');?></div>

							</div>
							
							<div class="form-group">

								<label>Payment Method*</label>

								<input type="text" class="form-control" value="<?= set_value('payment_method');?>" name="payment_method" placeholder="payment_method">

								<div class="form-error1"><?= form_error('payment_method');?></div>

							</div>
							
							<div class="form-group">

								<label>Agency Code*</label>

								<input type="text" class="form-control" value ="<?= set_value('agencyCode');?>" name="agencyCode" placeholder="agencyCode">

								<div class = "form-error1"><?= form_error('agencyCode')?></div>

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
							
							<div class="form-group">

								<label>Image*</label>

								<input type="file" class="form-control" name="image">

								<div class="form-error1"><?= form_error('image');?></div>

							</div>
							
							<div class="form-group">

								<label>AadharCardFront*</label>

								<input type="file" class="form-control" name="aadharCardFront">

								<div class="form-error1"><?= form_error('aadharCardFront');?></div>

							</div>
							
							<div class="form-group">

								<label>AadharCardBack*</label>

								<input type="file" class="form-control" name="aadharCardBack">

								<div class="form-error1"><?= form_error('aadharCardBack');?></div>

							</div>
							
							<div class="form-group">

								<label>PanCardFrontPhoto*</label>

								<input type="file" class="form-control" name="panCardFrontPhoto">

								<div class="form-error1"><?= form_error('panCardFrontPhoto');?></div>

							</div>
							
							<div class="form-group">

								<label>Govt PhotoId Proof*</label>

								<input type="file" class="form-control" name="govt_photoId_proof">

								<div class="form-error1"><?= form_error('govt_photoId_proof');?></div>

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
