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
					</div>
     <?php
        if($admin['role'] == 0){

     ?>
          <div class="main-data">
              <div class="row">
                  <form method="post"  action="<?= site_url()."/Payment/getSubdminPayment";?>"  id="getPdf">
                    <div class = "col-md-12" style="margin-left:60px;margin-top:10px;margin-bottom:20px">


                        <div class="col-md-3">
                            <div class="main-data-single-field">
                                <span style="font-weight: bold;">Search</span>
                                  <span><input type="text" id="pname" name="pname" style="border-radius: 4px;border-style: groove;width: 111px;"></span>
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="main-data-single-field">
                                  <span style="font-weight: bold;">Start Date</span>
                                  <span><input type="date" id="sdate" name="sdate" style="border-radius: 4px;border-style: groove;"></span>
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="main-data-single-field">
                                <span style="font-weight: bold;">End Date</span>
                                  <span><input type="date" id="edate" name="edate" style="border-radius: 4px;border-style: groove;"></span>
                                  <span><button type="submit" id="search"style="background-color: #d9a944;color: #FFFFFF;border-radius:6px;border:1px solid #33cccc;box-shadow: 0 4px 5px 0 rgba(156, 39, 176, 0.14), 0 1px 10px 0 rgba(156, 39, 176, 0.12), 0 2px 4px -1px rgba(156, 39, 176, 0.2);">Search</button></span>
                              </div>
                          </div>
                      </div>
                  </form>
                </div>
             </div>
           <?php  } ?>

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
                <th>Sender</th>
								<th>Name</th>
								<th>Payment Id</th>
								<th>Price</th>
								<th>Coin</th>
								<th>Date/Time</th>
                <?php if($admin['role'] == 0) { ?><th>Action</th> <?php } ?>
							</tr>
							</thead>
							<tbody>

							<?php $i = 1; foreach($details as $data){ ?>
								<tr>
									<td><?= $i;?></td>
                  <td><img src="<?php echo $data['image'];?>" style="width: 50px;height: 50px;"></td>
									<td><?php  echo $data['username'];?></td>
                  <td><?php   if(!empty($data['adminName'])){ echo $data['adminName'];}else{ echo "Super Admin"; }?></td>
									<td><?php  echo $data['name'];?></td>
									<td><?php  echo $data['transactionId'];?></td>
									<td><?php  echo $data['coinPrice'];?></td>
                  <td><?php  echo $data['coin'];?></td>
									<td><?php  echo $data['created'];?></td>
                  <?php if($admin['role'] == 0) { ?><td><button class="btn btn-danger" onclick="undoCoins(<?php echo $data['id']; ?>)">Undo</button></td><?php } ?>
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
	<script>
	$(document).ready(function() {
	  $(".popup_image").on('click', function() {
		w2popup.open({
		  title: 'Payment Image',
		  height : 1000,
		  width : 1000,
		  showMax : true,
		  body: '<div class="w2ui-centered"><img src="' + $(this).attr('src') + '"></img></div>'
		});
	  });

	});
</script>
<script>
  function undoCoins(id){
    var id = id;

    $.ajax({
      url:"<?php echo site_url(); ?>/Payment/resetCoins",
      type:"post",
      data:{id:id},
       success: function(data){
         alert(data);
         location.reload();
       }
    });
  }
</script>
