  <style>
    hr {
      margin-top: 5px;
      margin-bottom: 5px;
    }
    .side_box_wrapp strong, .side_box_wrapp p {
    display: inline-block;
}
.image_wrapp img {
    display: block;
    width: 100%;
    max-width: 500px;
    height: 190px;
}
.image_wrapp label {
    display: block;
    text-align: center!important;
    margin-bottom: 16px!important;
}
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>/agencyPanel/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php if(!empty($admin['image'])){?>
              	<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(). $admin['image'];?>" alt="User profile picture">
							<?php } else{ ?>
								<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
							<?php }?>


              <h3 class="profile-username text-center"><?php echo $admin['agencyName']?></h3>

              <p class="text-muted text-center"><?php echo $admin['agencyCode']?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body side_box_wrapp">
              <strong><i class="fa fa-user margin-r-5"></i> Name : </strong>

              <p class="text-muted">
                <?php echo $admin['personName']?>
              </p>

              <hr>

              <strong><i class="fa fa-file-text margin-r-5"></i> Agency Code : </strong>

              <p class="text-muted">
                <?php echo $admin['agencyCode']?>
              </p>

              <hr>

               <strong><i class="fa fa-phone margin-r-5"></i> Phone : </strong>

              <p class="text-muted">
                <?php echo $admin['phone']?>
              </p>

              <hr>

              <strong><i class="fa fa-envelope margin-r-5"></i> Email : </strong>

              <p class="text-muted">
                <?php echo $admin['email']?>
              </p>

              <hr>



            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="<?php if($activeTab == 'profile'){ echo "active"; }?>"><a href="#settings" data-toggle="tab">Settings</a></li>
							<li class="<?php if($activeTab == 'changePass'){ echo "active"; }?>"><a href="#changePassword" data-toggle="tab">Images</a></li>
            </ul>
            <div class="tab-content">
							<?php if($this->session->flashdata('success')){ ?><div class="form-error">
								<script>
									swal("Good job!", "Profile Update Successfully!", "success")
								</script>
							</div><?php }?>
              <div class="<?php if($activeTab == 'profile'){ echo "active"; }?> tab-pane" id="settings">
                <form class="form-horizontal" method="post" enctype='multipart/form-data'>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Website Link</label>

                    <div class="col-sm-10">
                      <input type="text" name="webiteLink" value="<?php echo $admin['webiteLink']?>" class="form-control" id="inputwebiteLink" placeholder="webiteLink">
											<div class="form-error1"><?php echo form_error('webiteLink') ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Persone Name</label>

                    <div class="col-sm-10">
                      <input type="text" name="personName" value="<?php echo $admin['personName']?>" class="form-control" id="inputpersonName" placeholder="personName">
                      <div class="form-error1"><?php echo form_error('personName') ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Designation</label>

                    <div class="col-sm-10">
                      <input type="text" name="designation" value="<?php echo $admin['designation']?>" class="form-control" id="inputdesignation" placeholder="designation">
                      <div class="form-error1"><?php echo form_error('designation') ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Stream Id</label>

                    <div class="col-sm-10">
                      <input type="text" name="streamId" value="<?php echo $admin['streamId']?>" class="form-control" id="inputstreamId" placeholder="streamId">
                      <div class="form-error1"><?php echo form_error('streamId') ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">State</label>

                    <div class="col-sm-10">
                      <input type="text" name="state" value="<?php echo $admin['state']?>" class="form-control" id="inputstate" placeholder="state">
                      <div class="form-error1"><?php echo form_error('state') ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Number Of Stream</label>

                    <div class="col-sm-10">
                      <input type="text" name="numberOfStream" value="<?php echo $admin['numberOfStream']?>" class="form-control" id="inputnumberOfStream" placeholder="numberOfStream">
                      <div class="form-error1"><?php echo form_error('numberOfStream') ?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Work Experience</label>

                    <div class="col-sm-10">
                      <input type="text" name="workExperience" value="<?php echo $admin['workExperience']?>" class="form-control" id="inputworkExperience" placeholder="workExperience">
                      <div class="form-error1"><?php echo form_error('workExperience') ?></div>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Reperred By</label>

                    <div class="col-sm-10">
                      <input type="text" name="reperredBy" value="<?php echo $admin['reperredBy']?>" class="form-control" id="inputreperredBy" placeholder="reperredBy">
                      <div class="form-error1"><?php echo form_error('reperredBy') ?></div>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Instagram Id</label>

                    <div class="col-sm-10">
                      <input type="text" name="instagramId" value="<?php echo $admin['instagramId']?>" class="form-control" id="inputinstagramId" placeholder="instagramId">
                      <div class="form-error1"><?php echo form_error('instagramId') ?></div>
                    </div>
                  </div>

									<input type="hidden" value="profile" name="type">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" class="btn btn-success" name="submit" value="Edit Profile">
                    </div>
                  </div>

                </form>
              </div>

							<div class="<?php if($activeTab == 'changePass'){ echo "active"; }?> tab-pane" id="changePassword">
								<?php if($this->session->flashdata('oldPass')){ ?><div class="form-error">
									<script>
										swal("OOPS!", "Old Password Does't Match!", "error")
									</script>
								</div><?php }?>
								<?php if($this->session->flashdata('passSuccess')){ ?><div class="form-error">
									<script>
										swal("Good job!", "Password Update Successfully!", "success")
									</script>
								</div><?php }?>
                <form class="form-horizontal image_wrapp" method="post">
                  <div class="row">
                  <div class="form-group col-sm-6">
                    <label for="adharcard" class="col-md-12 control-label">Adhar Card Front</label>
                    <div class="col-md-12">
                      <img src="<?php echo base_url();?><?php echo $admin['aadharCardFront']?>">
                     
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="adharcard" class="col-md-12 control-label">Adhar Card Back</label>
                    <div class="col-md-12">
                      <img src="<?php echo base_url();?><?php echo $admin['aadharCardBack']?>">
                      
                    </div>
                  </div>                  
                </div>
                  <div class="form-group col-sm-6">
                    <label for="adharcard" class="col-md-12 control-label">Pan Card Front</label>
                    <div class="col-md-12">
                      <img src="<?php echo base_url();?><?php echo $admin['panCardFrontPhoto']?>">
                      
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="adharcard" class="col-md-12 control-label">Pan Card Back</label>
                    <div class="col-md-12">
                      <img src="<?php echo base_url();?><?php echo $admin['panCardBackPhoto']?>">
                      
                    </div>
                  </div>
									<input type="hidden" value="pass" name="type">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" class="btn btn-success" value="Update Images">
                    </div>
                  </div>
                </form>
              </div>

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
