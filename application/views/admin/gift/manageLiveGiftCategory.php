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
					<div class="box-header">
						<h3 class="box-title"><a href="<?= site_url();?>/Gift/addliveGiftCategory" style="font-size: 14px;" class="btn btn-block btn-success btn-xs">Add Live Gift Category</a></h3>
					</div>



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
								<th>Title</th>
                <th>Status</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody id = "ts">
							<?php $i = 1; foreach($details as $data){ ?>
								<tr>
									<td><?= $i;?></td>
									<td><?php  echo $data['title'];?></td>
                  <td>
										<?php if($data['status'] == 'Approved'){?>
											<span class="label label-success"><?php  echo $data['status'];?></span>
										<?php } else{?>
											<span class="label label-warning"><?php  echo $data['status'];?></span>
										<?php }?>
									</td>
									<td>
										<ul class="admin-action btn btn-default" style="background-color: #f4f4f4;color: #fff !important;">
											<li class="dropdown">
											    <a class="dropdown-toggle" style="color: black;" data-toggle="dropdown" href="#" aria-expanded="false">
												  Action <span class="caret"></span>
												</a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li role="presentation">
														<a role="menuitem" tabindex="-1" href="<?= site_url()?>/Gift/editLiveGiftCategory/<?= $data['id'];?>">Edit</a>
													</li>
													<li role="presentation" class="divider"></li>
											        <li role="presentation">
														<a role="menuitem" onclick="return confirm(<?php  echo $data['title'];?> - Do you want <?php if($data['status'] == 'Approved'){ echo "Decline"; } else{ echo "Approve";}?> this gift&quot;);" tabindex="-1" href="<?= site_url()?>/Gift/liveGiftCategorystatus/<?= $data['id'];?>">
														<?php if($data['status'] == 'Approved'){ echo "Decline"; } else{ echo "Approve";}?>

														</a>
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
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript" src="http://w2ui.com/src/w2ui-1.4.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://w2ui.com/src/w2ui-1.4.2.min.css" />
