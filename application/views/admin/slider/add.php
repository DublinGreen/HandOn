<div class="content-wrapper">

	<section class="content-header">

		<h1>

			<?= $title;?>

		</h1>

		<ol class="breadcrumb">

			<li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

			<li><a href="<?php echo site_url();?>/Slider/manage">Manage Sliders</a></li>

			<li class="active"><?= $title;?></li>

		</ol>

	</section>

	<section class="content">

		<div class="row">

			<div class="col-md-10">

				<form role="form" method="post" id="specialitiesForm" enctype="multipart/form-data">

					<div class="box box-warning">

						<div class="box-header with-border">

							<h3 class="box-title"><?= $title;?></h3>

						</div>

						<div class="box-body">

							<div class="form-group">

								<label>Title*</label>

								<input type="text" class="form-control" value="<?= set_value('title');?>" name="title" placeholder="Name">

								<div class="form-error1"><?= form_error('title');?></div>

							</div>

							<div class="form-group">

								<label>URl*</label>

								<input type="text" class="form-control" value="<?= set_value('description');?>" name="description" placeholder="Enter Url" onblur="checkURL(this)">

								<div class="form-error1"><?= form_error('description');?></div>

							</div>

							<div class="form-group">

								<label>Banner*</label>

								<input type="file" class="form-control file_upload1" id="filePHOTO" name="image" >
								<span id="file_error"></span>
								<div class="form-error1"><?= form_error('image');?></div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>


$(document).ready(function(){
	$("#filePHOTO").change(function(){
		$("#file_error").html("");
		$(".file_upload1").css("border-color","#F0F0F0");
		var file_size = $('#filePHOTO')[0].files[0].size;
		if(file_size > 400000  ) {
			$("#file_error").html("<p style='color:#FF0000'>File size is Less than 400kb</p>");
			$(".file_upload1").css("border-color","#FF0000");
			return false;
		}
		else if(file_size < 100000){
			$("#file_error").html("<p style='color:#FF0000'>File  size is greater than 100kb</p>");
			$(".file_upload1").css("border-color","#FF0000");
			return false;
		}
		return true;
	});
});

function checkURL(url) {
		var string = url.value;

		if (!~string.indexOf("http")) {
				string = "http://" + string;
		}

		url.value = string;
		return url;
}
</script>
