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

			<div class="col-md-12">

				<form role="form" method="post" id="specialitiesForm" enctype="multipart/form-data">

					<div class="box box-warning">

						<div class="box-header with-border">

							<h3 class="box-title"><?= $title;?></h3>

						</div>

						<div class="box-body">

							<div class="form-group">

								<label>SubAdmin*</label>
								<select class="form-control" id="sendType" name="subadmin12" required>
								    <option value="">Select </option>
										<option value="1">Sub Admin </option>
										<option value="2">User</option>
							  </select>
								<div class="form-error1"><?= form_error('subadmin12');?></div>

							</div>

							<div id = "subadmin" style="display:none">
									 <div class="form-group">

											<label>SubAdmin*</label>

										 <select class="form-control" id="sel1" name="subadmin">
											 <option value="">Select SubAdmin</option>
											 <?php
												 foreach ($admin1 as $admin2) { ?>
														<option value="<?php echo $admin2['id']; ?>"><?php echo $admin2['name']; ?></option>
										 <?php  } ?>
										 </select>

										 <div class="form-error1"><?= form_error('subadmin');?></div>

									 </div>

									 <div class="form-group">

										 <label>Coins*</label>

										 <input type="text" class="form-control" value="<?= set_value('coins');?>" name="coins" placeholder="Coins">

										 <div class="form-error1"><?= form_error('coins');?></div>

									 </div>

								 </div>

				        <div id="hide" style="display:none">
											<div class="form-group">

												<label>Username*</label>

												<input type="text" class="form-control" id="username" value="<?= set_value('username');?>" name="username" placeholder="username">

												<div class="form-error1"><?= form_error('username');?></div>

											</div>

											<div class="form-group">

				                <label>Coins*</label>

				                <input type="text" class="form-control" value="<?= set_value('coins1');?>" name="coins1" placeholder="Coins">

				                <div class="form-error1"><?= form_error('coins1');?></div>

				              </div>

										<div class="form-group">

											<label>Price*</label>

											<input type="number" class="form-control" value="<?= set_value('price');?>" name="price" placeholder="Price">

											<div class="form-error1"><?= form_error('price');?></div>

										</div>

			              <div class="form-group">

											<label>Transaction Id </label>

											<input type="number" class="form-control" value="<?= set_value('transactionId');?>" name="transactionId" placeholder="Transaction Id ">

											<div class="form-error1"><?= form_error('transactionId');?></div>

										</div>

			              <div class="form-group">

			                <label>Order Id </label>

			                <input type="number" class="form-control" value="<?= set_value('orderId');?>" name="orderId" placeholder="Order Id">

			                <div class="form-error1"><?= form_error('orderId');?></div>

			              </div>

			              <div class="form-group">

			                  <label>Payment Type *</label>

			                  <input type="text" class="form-control" value="<?= set_value('paymentType');?>" name="paymentType" placeholder="Payment Type">

			                  <div class="form-error1"><?= form_error('paymentType');?></div>

			              </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $("#sendType").change(function(){
	var status = 	$("#sendType").val();
	  if(status == 1){
			$("#subadmin").show(1000);
			$("#hide").hide(1000);
		}
		else if(status == 2){
			$("#subadmin").hide(1000);
			$("#hide").show(1000);
		}
		else{
			$("#subadmin").hide(1000);
			$("#hide").hide(1000);
		}

	});
</script>
