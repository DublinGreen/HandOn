<style>
div#example1_filter {
    float: right;
}

.paging_simple_numbers{
    float: right;
}
.dataTables_empty{
  text-align: center;
}
span.link {
    padding: 5px;
    border: 1px solid gray;
    margin: 2px;
    border-radius: 10px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title;?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"><?= $title?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
		   <!-- /.box -->
				<div class="box">


					<!-- /.box-header -->
					<div class="box-body">
						<?php if($this->session->flashdata('success')){ ?>
							<div class="success-message">
								<script> swal("Good job!", "<?= $this->session->flashdata('success')?>!", "success") </script>
							</div>

						<?php }?>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>Sr.</th>
                <th>Image</th>
								<th>Username</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Request</th>
								<th <?php if($admin['role'] == 'subAdmin'){?> style="display:none" <?php } ?>>Action</th>
							</tr>
							</thead>
							<tbody id = "ts">
							<?php $i = $segmentCount; foreach($details as $data){ ?>
								<tr>
									<td><?= $i;?></td>
                  <td>
                    <?php if(!empty($data['image'])){?>
                      <img src="<?php echo $data['image']?>" style="width:80px">
                    <?php } else{?>
                      <img src="<?php echo base_url().'uploads/no_image_available.png' ?>" style="width:80px">
                    <?php } ?>
                  </td>
                  <td><?php  echo $data['username'];?></td>
									<td><?php  echo $data['name'];?></td>
                  <td><?php  echo $data['phone'];?></td>
									<td><?php  echo $data['request'];?></td>

									<td>
										<ul class="admin-action btn btn-default" style="background-color: #f4f4f4;color: #fff !important;">
											<li class="dropdown">
											    <a class="dropdown-toggle" style="color: black;" data-toggle="dropdown" href="#" aria-expanded="false">
												  Action <span class="caret"></span>
												</a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li role="presentation">
                            <a role="menuitem" tabindex="-1" href="<?= site_url()?>/user/approveLiveRequest/<?= $data['userId'];?>">Approve</a>
														<a role="menuitem" tabindex="-1" href="<?= site_url()?>/user/rejectLiveRequest/<?= $data['userId'];?>">Reject</a>
													</li>

												</ul>
											</li>
										</ul>
									</td>
								</tr>
							<?php $i++; } ?>
							</tbody>
						</table>
						<?php echo $links;?>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
