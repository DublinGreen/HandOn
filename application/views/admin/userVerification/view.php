<style>
	.info_wrapp img {
		width: 100%;
		max-width: 250px;
	}
		.info_wrapp .col-6 {
	    width: 50%;
	    float: left;
	    padding: 10px;
	}
	.info_wrapp a {
    color: #000;
    font-size: 18px;
    text-transform: capitalize;
    text-align: center;
    display: block;
    border-bottom: 2px solid #eeeeee;
	}
	.info_wrapp img {
	    width: 100%;
	    max-width: 300px;
	    margin: auto;
	    display: block;
	    margin-top: 20px;
			margin-bottom: 50px;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?= $title;?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo site_url().$backFunction;?>"><?php echo $backTitle?></a></li>
			<li class="active"><?= $title;?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-1">
			</div>
			<div class="col-md-10">

					<div class="box box-warning">
						<div class="box-header with-border" >


							<div style="margin-left: 15px;font-size: 20px;"><?php echo $details['name']?></div>
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
											<a href="#">Status</a>
											<?php if($details['host_status'] == '2'){?>
												<span class="label label-success" >Approved</span>
                      <?php } elseif($details['host_status'] == '1'){?>
                        <span class="label label-info" >Pending</span>
											<?php } else{?>
												<span class="label label-danger">Rejected</span>
											<?php }?>
										</li>




									</div>
									<div class="col-md-6">
											<li>
                      <a href="#">Email</a>
                      <span><?php  echo $details['email'];?></span>
                    </li>
                    <li>
                      <a href="#">Contact Number</a>
                      <span><?php  echo $details['phone'];?></span>
                    </li>
                    
											<!--<li>-->
	          <!--            <a href="#">Aadhar Number</a>-->
	          <!--            <span><?php  echo $details['aadharNumber'];?></span>-->
	          <!--          </li>-->
	                    <li>
	                      <a href="#">Created</a>
	                      <span><?php  echo $details['created'];?></span>
	                    </li>
	                    
	                    <?php
									if($admin['assignRole'] == 'SUBADMIN'){?>
									
									<li style="border-bottom: none;     margin-top: 50px;">
                                        <a href="#" style="color: #f39b12;font-size: 15px;">Host Request</a>
                                    </li>
                                    <li style="border-bottom: none;padding-top: 0px;">
                                        <select name="status" class="col-md-12 form-control" id="userIdBanUnbanData" style="border: 2px solid #f39b127a;" onchange="userIdBanUnban(<?php  echo $details['id'];?>)">
                                            <option disabled selected>Select User Status</option>
                                                <option value="1" <?php if($details['host_status'] == 1){ echo "selected"; } ?>>Pending</option>
                                                <option value="2" <?php if($details['host_status'] == 2){ echo "selected"; } ?> >Approve</option>
                                                <option value="3" <?php if($details['host_status'] == 3){ echo "selected"; } ?> >Reject</option>
                
                                        </select>
                                    </li>
									
									<?php
									}?>
									</div>
									
									
									<div class="col-md-12">
										<div class="row info_wrapp" style="margin-top: 50px;">
											<div class="col-md-4">
												<a href="#">Document</a>
                 				<img src="<?php echo $details['nationalId']?>">
											</div>
											<!--<div class="col-md-4">-->
											<!--	<a href="#">Aadhar Card</a>-->
           <!--      				<img src="<?php echo  base_url().$details['addharCard']?>">-->
											<!--</div>-->
											<!--<div class="col-md-4">-->
											<!--	<a href="#">Pan Card</a>-->
           <!--        			<img src="<?php echo  base_url().$details['panCard']?>">-->
											<!--</div>-->
										</div>
									</div>
									</div>

								</ul>
							</div>

						</div>
					</div>

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
    // alert(status);
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

  function popular1(id)
	{

		var userId = id;
		var status = $("#crown").val();
    // alert(status);
		$.ajax({
	      type: 'post',
	      url: "<?php echo site_url();?>/User/userStatus1",
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

  function popular2(id){
      var userId = id;
      var status = $('#live').val();
      // alert(status);
      $.ajax({
         type:'post',
         url:'<?php echo site_url();?>/User/userStatus2',
         data:{userId:userId,status:status},
         success: function (data){

           if(data == 1){
             alert("status updated successfully");
            }
            else
            {
             alert("status not updated");
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
                  text: "Host request Approve/Reject status updated successfully!",
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

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $("#approveUser").change(function(){
		var status = 	$("#approveUser").val();
//	  alert(status);
	  if(status == 2){
		    $("#AgnecyCode").show(1500);
			}
		else{
			$("#AgnecyCode").hide(1500);
		}


	});
</script>
