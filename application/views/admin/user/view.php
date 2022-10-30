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

    <?php if($this->session->flashdata('success')){ ?>
      <div class="success-message">
        <script> swal("Good job!", "<?= $this->session->flashdata('success')?>!", "success") </script>
      </div>

    <?php }?>

    <?php if($this->session->flashdata('error')){ ?>
      <div class="success-message">
        <script> swal("Oops!", "<?= $this->session->flashdata('error')?>!", "error") </script>
      </div>

    <?php }?>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo site_url();?>/User/manage">Manage User</a></li>
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
											<a href="#">Username</a>
											<span><?php echo $details['username']?></span>
										</li>
										<li>
											<a href="#">Email</a>
											<span><?php echo $details['email']?></span>
										</li>
										<li>
											<a href="#">Mobile</a>
											<span><?php echo $details['phone']?></span>
										</li>
										<li>
											<a href="#">Status</a>
											<?php if($details['status'] == 'Approved'){?>
												<span class="label label-success" ><?php  echo $details['status'];?></span>
											<?php } else{?>
												<span class="label label-warning"><?php  echo $details['status'];?></span>
											<?php }?>
										</li>
										<li>
											<a href="#">Is Email Verified</a>
											<span class="label label-success">Yes</span>
										</li>
										<li>
											<a href="#">User Type</a>
											<span class="label label-warning">Normal User</span>
										</li>
										<li>
											<a href="#">Device Type</a>
											<span>Android </span>
										</li>
										<li>
											<a href="#">Login by</a>
											<span>Manual </span>
										</li>
										<li>
											<a href="#">Social Unique Id</a>
											<span><?php  echo $details['social_id'];?></span>
										</li>
										<li>
											<a href="#">Created at</a>
											<span><?php  echo $details['created'];?></span>
										</li>
										<li style="border-bottom: none;">
											<a href="#" style="color: #f39b12;font-size: 15px;">Badges</a>
                                        </li>
                                        <li style="border-bottom: none;padding-top: 0px;">
											<select name="status" class="col-md-12 form-control" id="pp" style="border: 2px solid #f39b127a;" onchange="popular(<?php  echo $details['id'];?>)">
												<option disabled selected>Select Badge</option>
                                                    <?php if(!empty($details['badge'])){?>
                                                <option value="">Remove Badge</option>
                                                        <?php }?>
                                                        <?php foreach($badgesList as $blist){?>
                                                <option value="<?php echo $blist['id']?>" <?php if($blist['id'] == $details['badge']){echo "selected";}?>><?php echo $blist['title']?></option>
                                                    <?php }?>
											</select>
										</li>


                    <li style="border-bottom: none; margin-top: 50px;">
                      <a href="#" style="color: #f39b12;font-size: 15px;">Crown</a>
                    </li>
                    <li style="border-bottom: none;padding-top: 0px;">
                      <select name="status" class="col-md-12 form-control" id="crownStatusUpdate" style="border: 2px solid #f39b127a;" onchange="crownUpdate(<?php  echo $details['id'];?>)">
                        <option disabled selected>Select Crown</option>
                            <?php if(!empty($details['badge'])){?>
                        <option value="">Remove Crown</option>
                            <?php }?>
                            <?php foreach($corwnList as $corwnLists){?>
                        <option value="<?php echo $corwnLists['id']?>" <?php if($corwnLists['id'] == $details['crown']){echo "selected";}?>><?php echo $corwnLists['title']?></option>
                            <?php }?>
                      </select>
                    </li>



                    <li style="border-bottom: none;     margin-top: 50px;">
                        <a href="#" style="color: #f39b12;font-size: 15px;">UserId(Ban/ Unban)</a>
                    </li>
                    <li style="border-bottom: none;padding-top: 0px;">
                        <select name="status" class="col-md-12 form-control" id="userIdBanUnbanData" style="border: 2px solid #f39b127a;" onchange="userIdBanUnban(<?php  echo $details['id'];?>)">
                            <option disabled selected>Select User Status</option>
                                <option value="0" <?php if($details['liveStatus'] == 0){ echo "selected"; } ?>>Unban Id</option>
                                <option value="1" <?php if($details['liveStatus'] == 1){ echo "selected"; } ?> >Ban Id</option>

                        </select>
                    </li>


                    <li style="border-bottom: none;     margin-top: 50px;">
                        <a href="#" style="color: #f39b12;font-size: 15px;">Live Hotlist(Add/ Remove)</a>
                    </li>
                    <li style="border-bottom: none;padding-top: 0px;">
                        <select name="status" class="col-md-12 form-control" id="liveHotlistAddRemoveData" style="border: 2px solid #f39b127a;" onchange="liveHotlistAddRemove(<?php  echo $details['id'];?>)">
                            <option disabled selected>Select User Status</option>
                                <option value="1" <?php if($details['liveHotlist'] == '1'){ echo "selected"; } ?>>Add</option>
                                <option value="0" <?php if($details['liveHotlist'] == '0'){ echo "selected"; } ?> >Remove</option>

                        </select>
                    </li>


									</div>
									<div class="col-md-6">
										<li>
											<?php if(!empty($followList)){?>
												<a href="<?php echo site_url()?>/User/follwoList/<?php echo $details['id']?>/follower">No of Followers
													<span class="label label-success"><?php  echo $followList;?> </span>
												</a>
											<?php } else{?>
												<a href="#">No of Followers
													<span class="label label-warning">0</span>
												</a>
											<?php } ?>
										</li>
										<li>
											<?php if(!empty($followingList)){?>
												<a href="<?php echo site_url()?>/User/follwoList/<?php echo $details['id']?>/following">No of Follwing
													<span class="label label-success"><?php  echo $followingList;?> </span>
												</a>
											<?php } else{?>
												<a href="#">No of Following
													<span class="label label-warning">0</span>
												</a>
											<?php } ?>
										</li>
										<li>
											<?php if(!empty($countVideoComLike['totalVideos'])){?>
												<a href="<?php echo site_url()?>/User/videoList/<?php echo $details['id']?>">No of Video
													<span class="label label-success"><?php  echo $countVideoComLike['totalVideos'];?> </span>
												</a>
											<?php } else{?>
												<a href="#">No of Video
													<span class="label label-warning">0</span>
												</a>
											<?php } ?>
										</li>
										<li>
											<a href="#">No of Likes</a>
											<span><?php  echo $countVideoComLike['totalLikeCount'];?> </span>
										</li>
										<li>
											<a href="#">No of Comments</a>
											<span><?php  echo $countVideoComLike['totalCommentCount'];?> </span>
										</li>
										<li>
											<a href="#">No of Views</a>
											<span><?php  echo $countVideoComLike['totalViewCount'];?> </span>
										</li>

										<li>
											<?php if(!empty($blockUserCount['blockUserCount'])){?>
												<a href="<?php echo site_url()?>/User/blockUserList/<?php echo $details['id']?>">No of Block User
													<span class="label label-success"><?php  echo $blockUserCount['blockUserCount'];?>  </span>
												</a>
											<?php } else{?>
												<a href="#">No of Block User
													<span class="label label-warning">0</span>
												</a>
											<?php } ?>
										</li>

										<li>
											<?php if(!empty($hastTagCount['idCount'])){?>
												<a href="<?php echo site_url()?>/User/favHashTag/<?php echo $details['id']?>">No of Fav. Hastag
													<span class="label label-success"><?php  echo $hastTagCount['idCount'];?>  </span>
												</a>
											<?php } else{?>
												<a href="#">No of Fav. Hashtag
													<span class="label label-warning">0</span>
												</a>
											<?php } ?>
										</li>

										<li>
											<?php if(!empty($soundCount['idCount'])){?>
												<a href="<?php echo site_url()?>/User/favSound/<?php echo $details['id']?>">No of Fav. Sound
													<span class="label label-success"><?php  echo $soundCount['idCount'];?>  </span>
												</a>
											<?php } else{?>
												<a href="#">No of Fav. Sound
													<span class="label label-warning">0</span>
												</a>
											<?php } ?>
										</li>



										<li>
											<a href="#">No of account</a>
											<span>1 </span>
										</li>

                <li style="border-bottom: none;">
                    <a href="#" style="color: #f39b12;font-size: 15px;">Live(Ban/ Unban)</a>
                </li>
                <li style="border-bottom: none;padding-top: 0px;">
                    <select name="status" class="col-md-12 form-control" id="ban" style="border: 2px solid #f39b127a;" onchange="edit(<?php  echo $details['id'];?>)">
                        <option disabled selected>Select User Status</option>
                            <option value="1" <?php if($details['liveStatus'] == '1'){ echo "selected"; } ?>>Unban User</option>
                            <option value="0" <?php if($details['liveStatus'] == '0'){ echo "selected"; } ?> >Ban User</option>

                    </select>
                </li>

              <li style="border-bottom: none;     margin-top: 50px;">
                  <a href="#" style="color: #f39b12;font-size: 15px;">Device Id(Ban/ Unban)</a>
              </li>
              <li style="border-bottom: none;padding-top: 0px;">
                  <select name="status" class="col-md-12 form-control" id="deviceBlockUnBlockData" style="border: 2px solid #f39b127a;" onchange="deviceBlockUnBlock(<?php  echo $details['id'];?>)">
                          <option disabled selected>Select User Status</option>
                          <option value="0" <?php if($deviceBlockStatus == 0){ echo "selected"; } ?>>Unban Id</option>
                          <option value="1" <?php if($deviceBlockStatus == 1){ echo "selected"; } ?> >Ban Id</option>
                  </select>
              </li>


              <li style="border-bottom: none;     margin-top: 50px;">
                  <a href="#" style="color: #f39b12;font-size: 15px;">Video Hotlist(Add/ Remove)</a>
              </li>
              <li style="border-bottom: none;padding-top: 0px;">
                  <select name="status" class="col-md-12 form-control" id="hotlistAddRemoveData" style="border: 2px solid #f39b127a;" onchange="hotlistAddRemove(<?php  echo $details['id'];?>)">
                          <option disabled selected>Select User Status</option>
                          <option value="1" <?php if($details['hotlist'] == '1'){ echo "selected"; } ?>>Add</option>
                          <option value="0" <?php if($details['hotlist'] == '0'){ echo "selected"; } ?> >Remove</option>
                  </select>
              </li>
                  <a href="<?php echo site_url(); ?>/User/removeDp/<?php echo $details['id']?>" class="btn btn-info" style="margin-top:81px;width:95%; margin-left: 6%">Remove Dp</a>
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

  function liveHotlistAddRemove(id){
    var userId = id;
    var status = $("#liveHotlistAddRemoveData").val();
    $.ajax({
      type: 'post',
      url: "<?php echo site_url();?>/User/updateLiveHotlistStatus",
      data:{userId:userId,status:status},
      success: function(result){
        if(result == 1){
          swal({
            title: "Good job!",
            text: "Live Hotlist Add/Remove status updated successfully!",
            icon: "success",
          });
        }
        else
        {
          swal({
            title: "OOPS!",
            text: "Please try after some time!",
            icon: "error",
          });
        }
       }
    });
  }

  function hotlistAddRemove(id){
    var userId = id;
    var status = $("#hotlistAddRemoveData").val();
    $.ajax({
      type: 'post',
      url: "<?php echo site_url();?>/User/updateHotlistStatus",
      data:{userId:userId,status:status},
      success: function(result){
        if(result == 1){
          swal({
            title: "Good job!",
            text: "Video Hotlist Add/Remove status updated successfully!",
            icon: "success",
          });
        }
        else
        {
          swal({
            title: "OOPS!",
            text: "Please try after some time!",
            icon: "error",
          });
        }
       }
    });
  }

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

<script type="text/javascript">

    function deviceBlockUnBlock(id){
      var userId = id;
      var status = $("#deviceBlockUnBlockData").val();
      var deviceId = '<?php echo $details['deviceId']?>';
      $.ajax({
          type: 'post',
          url: "<?php echo site_url();?>/User/banDeviceId",
          data:{userId:userId,status:status,deviceId:deviceId},
          success: function(result){
              if(result == 1){
                swal({
                  title: "Good job!",
                  text: "DeviceId Ban/Unban status updated successfully!",
                  icon: "success",
                });
              }
              else
              {
                swal({
                  title: "OOPS!",
                  text: "Please try after some time!",
                  icon: "error",
                });
              }
          }
      });
    }

    function crownUpdate(id){
      var userId = id;
      var status = $("#crownStatusUpdate").val();
      $.ajax({
          type: 'post',
          url: "<?php echo site_url();?>/User/crownStatusUpdate",
          data:{userId:userId,status:status},
          success: function(result){
              if(result == 1){
                swal({
                  title: "Good job!",
                  text: "Crown status updated successfully!",
                  icon: "success",
                });
              }
              else
              {
                swal({
                  title: "OOPS!",
                  text: "Please try after some time!",
                  icon: "error",
                });
              }
          }
      });
    }


    function userIdBanUnban(id){
      var userId = id;
      var status = $("#userIdBanUnbanData").val();
      $.ajax({
          type: 'post',
          url: "<?php echo site_url();?>/User/updateUserIdBanUnbanStatus",
          data:{userId:userId,status:status},
          success: function(result){
              if(result == 1){
                swal({
                  title: "Good job!",
                  text: "UserId Ban/Unban status updated successfully!",
                  icon: "success",
                });
              }
              else
              {
                swal({
                  title: "OOPS!",
                  text: "Please try after some time!",
                  icon: "error",
                });
              }
          }
      });
    }


    function edit(id)
    {
        var userId = id;
        var status = $("#ban").val();


        $.ajax({
            type: 'post',
            url: "<?php echo site_url();?>/User/userCondition",
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
