<style>
div#example1_filter {
    float: right;
}
/*managePurchaseCoinHistory*/
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
			<li><a href="<?php echo site_url();?>/User/manage"> Manage User</a></li>
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
					</div>
					<div class="main-data">
						<div class="row">
                  <div class = "col-md-12" style="margin-left:60px;margin-top:10px;margin-bottom:20px">

								<div class="col-md-5">
                	<div class="main-data-single-field">
										<div class="col-md-6">
                    	<span style="font-size: 20px;">Total Amount</span>
										</div>
										<div class="col-md-6">
                        <span style="font-size: 20px;"><?php echo $totalCoin['totalCoinPrice']; ?></span>
											</div>
                    </div>
                </div>
                  <div class="col-md-5">
										<div class="main-data-single-field">
											<div class="col-md-6">
                      	<span style="font-size: 20px;">Total Coin</span>
											</div>
											<div class="col-md-6">
                          <span style="font-size: 20px;"><?php echo $totalCoin['totalCoin']; ?></span>
												</div>
                      </div>
                  </div>
                  <div class="col-md-2">
                    <button type="button" style="background-color: #3caea3;border-color: #00acd6;font-size: 14px;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Coin</button>
                  </div>
                </div>

						</div>
					</div>

          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
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
								<th>Coin</th>
								<th>Coin Price</th>
								<th>Transaction Id</th>
								<th>Date/Time</th>
							</tr>
							</thead>
							<tbody id = "ts">
							<?php $i = 1; foreach($details as $data){ ?>
								<tr>
									<td><?= $i;?></td>
									<td><?php  echo $data['coin'];?></td>
									<td><?php  echo $data['coinPrice'];?></td>
									<td><?php  echo $data['transactionId'];?></td>
									<td><?php  echo $data['created'];?></td>
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
