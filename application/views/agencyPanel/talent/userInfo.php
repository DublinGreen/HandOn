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
      <li><a href="<?php echo site_url();?>/AgencyPanel/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo site_url();?>/Talent/manage"> Manage Talent </a></li>
      <li class="active"><?= $title?></li>
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
							<?php if(!empty($details['image'])){?>
								<img src="<?php echo $details['image'];?>" style="width: 60px;height: 60px;border-radius: 50%;">
							<?php } else{ ?>
									<img src="<?php echo base_url()?>uploads/no_image_available.png" style="width: 60px;height: 60px;border-radius: 50%;">
							<?php } ?>

							<div style="margin-left: 15px;font-size: 20px;"><?php echo $details['username']?></div>
						</div>
						<div class="box-body">

							<div role="tabpanel" style="background-color: #fff;" class="tab-pane active" id="track">
								 <ul style="padding: 0;margin: 0;">
									<div class="col-md-6">
										<li>
											<a href="#">Agency Code</a>
											<span><?php echo $details['agencyCode']?></span>
										</li>
										<li>
											<a href="#">Username</a>
											<span><?php echo $details['username']?></span>
										</li>
                    <li>
											<a href="#">Name</a>
											<span><?php echo $details['name']?></span>
										</li>
                    <li>
											<a href="#">Gender</a>
											<span><?php echo $details['gender']?></span>
										</li>
                    <li>
											<a href="#">Country</a>
											<span><?php echo $details['country']?></span>
										</li>


									</div>
									<div class="col-md-6">
										<li>
											<a href="#">Talent Join Date</a>
											<span><?php  echo $details['talentJoinDate'];?> </span>
										</li>
										<li>
											<a href="#">Agency Join Date</a>
											<span><?php  echo $details['joinAgencyDate'];?> </span>
										</li>
										<li>
											<a href="#">Last Active Day</a>
											<span><?php  echo $details['activeDate'];?> </span>
										</li>
                    <li>
											<a href="#">Last Login Date</a>
											<span><?php  echo $details['lastLoinDate'];?> </span>
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
