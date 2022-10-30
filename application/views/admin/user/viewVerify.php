<style>
.label-success {
  animation: blinker 3s linear infinite;
}

@keyframes blinker {
  30% { opacity: 0; }
}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?= $title;?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo site_url();?>/User/verifyAccount">Manage Verify Request</a></li>
			<li class="active"><?= $title;?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-10">
				<form role="form" method="post" id="specialitiesForm" enctype="multipart/form-data">
					<div class="box box-warning">
						<div class="box-header with-border" style="display: flex;">
							<?php if(!empty($userInfo['image'])){?>
								<img src="<?php echo $userInfo['image'];?>" style="width: 60px;height: 60px;border-radius: 50%;">
							<?php } else{ ?>
									<img src="<?php echo base_url()?>uploads/no_image_available.png" style="width: 60px;height: 60px;border-radius: 50%;">
							<?php } ?>
							<span>
								<div style="margin-left: 15px;font-size: 20px;"><?php echo $userInfo['username']?></div>
								<div style="margin-left: 15px;font-size: 20px;"><?php echo $userInfo['phone']?></div>
							</span>
						</div>
						<div class="box-body">

							<div role="tabpanel" style="background-color: #fff;" class="tab-pane active" id="track">
								 <ul style="padding: 0;margin: 0;">
									<div class="col-md-6">
										<li>
											<a href="#">Username</a>
											<span><?php echo $details['username']?></span>
										</li>
										<li>
											<a href="#">Email</a>
											<span><?php echo $details['email']?></span>
										</li>
										<li>
											<a href="#">Contact Number</a>
											<span><?php echo $details['contactNumber']?></span>
										</li>
                    <li>
                      <a href="#">Account Number</a>
                      <span><?php echo $details['accountNumber']?></span>
                    </li>
										<li>
											<a href="#">IFSC</a>
											<span><?php echo $details['ifsc']?></span>
										</li>
										<li>
											<a href="#">Agency Code</a>
												<span><?php echo $details['agencyCode']?></span>
										</li>
										<li>
											<a href="#">Created</a>
												<span><?php echo $details['created']?></span>
										</li>
									</div>
									<div class="col-md-6">

										<li style="display: flow-root;">
											<a href="#">Selfie</a>
											<span>
												<?php
												$url = $details['selfie'];
												if (filter_var($url, FILTER_VALIDATE_URL)) { ?>
												    <img style="width: 250px;" src="<?php echo $url?>">
												<?php } else { ?>
												    <img style="width: 250px;" src="<?php echo base_url().$url?>">
												<?php }
												?>
											 </span>
										</li>
										<li style="display: flow-root;">
											<a href="#">Aadhar Card</a>
											<span>
												<?php
												$url1 = $details['addharCard'];
												if (filter_var($url1, FILTER_VALIDATE_URL)) { ?>
														<img style="width: 400px;" src="<?php echo $url1?>">
												<?php } else { ?>
														<img style="width: 400px;" src="<?php echo base_url().$url1?>">
												<?php }
												?>
											 </span>
										</li>
										<li style="display: flow-root;">
											<a href="#">Pan Card</a>
											<span>
												<?php
												$url12 = $details['panCard'];
												if (filter_var($url1, FILTER_VALIDATE_URL)) { ?>
														<img style="width: 400px;" src="<?php echo $url12?>">
												<?php } else { ?>
														<img style="width: 400px;" src="<?php echo base_url().$url12?>">
												<?php }
												?>
											 </span>
										</li>
									</div>
								</ul>
							</div>



						</div>
					</div>
				</form>
			</div>
			<div class="col-md-1">
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">
	function popular(id)
	{
		var userId = id;
		var status = $("#pp").val();
		$.ajax({
	      type: 'post',
	      url: "<?php echo site_url();?>/User/userStatus",
	      data:{userId:userId,status:status},
	      success: function(result){

	      	 if(result == 1){
	      	 	alert("status updated successfully");
	      	 }
	      	 else
	      	 {
	      	 	alert("status not updated");
	      	 }
	       }
	    });
	}

</script>
