<div class="content-wrapper">

	<section class="content-header">

		<h1>

			<?= $title;?>

		</h1>

		<ol class="breadcrumb">

			<li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

			<li><a href="<?php echo site_url();?>/LiveViews/dummyView">Manage Dummy View</a></li>

			<li class="active"><?= $title;?></li>

		</ol>

	</section>

	<section class="content">

		<div class="row">
			<?php if($this->session->flashdata('error')){ ?>
				<div class="success-message">
					<script> swal("OOPS!", "<?= $this->session->flashdata('error')?>!", "error") </script>
				</div>

			<?php }?>

			<div class="col-md-10">

				<form role="form" method="post" id="specialitiesForm" enctype="multipart/form-data">

					<div class="box box-warning">

						<div class="box-header with-border">

							<h3 class="box-title"><?= $title;?></h3>

						</div>

						<div class="box-body">

							<div class="form-group">

								<label>Username*</label>

								<input type="text" class="form-control" value="<?= set_value('username');?>" name="username" placeholder="Name">

								<div class="form-error1"><?= form_error('username');?></div>

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
