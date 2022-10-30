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
			<li><a href="<?php echo site_url();?>/AgencyPanel/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
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
					<div class="box-body" style="font-size: 15px;">
						<?php if($this->session->flashdata('success')){ ?>
							<div class="success-message">
								<script> swal("Good job!", "<?= $this->session->flashdata('success')?>!", "success") </script>
							</div>

						<?php }?>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>Sr.</th>
                <th>Username</th>
								<th>Name</th>
								<th>Actual Earning</th>
								<th>Live Duration</th>
                <th>Valid Days</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody id = "ts">
							<?php $i = 1; foreach($details as $data){ ?>
								<tr>
                  <?php
                      $mainUserId = $data['userId'];
                      $liveDuration = $this->db->query("SELECT sum((TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created)))/60 as spendTime FROM `userLive` left join agencyUsers on agencyUsers.userId = userLive.userId where agencyUsers.agencyId = $agencyId and DATE_FORMAT(userLive.created ,'%Y-%m') = '$todaySearch' and userLive.archivedDate != '' and userLive.userId = $mainUserId ")->row_array();
                      $validDays = $this->db->query("SELECT *,(TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created))/60 as spendTime FROM `userLive` left join agencyUsers on agencyUsers.userId = userLive.userId where (TO_SECONDS(userLive.archivedDate ) - TO_SECONDS(userLive.created))/60 >= 60 and agencyUsers.agencyId = $agencyId and DATE_FORMAT(userLive.created ,'%Y-%m') = '$todaySearch' and userLive.userId = $mainUserId ")->num_rows();


                  ?>
									<td><?= $i;?></td>
									<td><?php  echo $data['username'];?></td>
									<td><?php  echo $data['name'];?></td>
                  <td><?php  echo $data['totalCoin'];?></td>
                  <td>

                      <?php
                      $hours =  floor($liveDuration['spendTime']/60); // No. of mins/60 to get the hours and round down
                        $mins =   $liveDuration['spendTime'] % 60; // No. of mins/60 - remainder (modulus) is the minutes
                        echo $hours . " h " . $mins . " m ";


                      ?>

                  <td><?php echo $validDays;?></td>
                  <!--td><a href="<?php echo site_url()?>/Talent/viewTalent/<?php echo $data['userId']?>" class="btn btn-simple btn-icon edit" id="1" style="font-size: 25px;color: #7ae0ec;"><i class="fa fa-eye"></i><div class="ripple-container"></div></a></td-->
                  <td>
										<ul class="admin-action btn btn-default" style="background-color: #f4f4f4;color: #fff !important;">
											<li class="dropdown">
											    <a class="dropdown-toggle" style="color: black;" data-toggle="dropdown" href="#" aria-expanded="false">
												  Action <span class="caret"></span>
												</a>
												<ul class="dropdown-menu dropdown-menu-right">

                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="<?php echo site_url()?>/Talent/viewTalent/<?php echo $data['userId']?>">View</a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="<?php echo site_url()?>/Talent/Info/<?php echo $data['userId']?>">Info</a>
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

<!--excel script    -->
<script>
    $(document).ready(function() {
        $('#getexcel').on('click', function() {
            var action = '<?php echo site_url();?>/user/getexcel';
            $('#getform').attr('action', action);
            $('#getform').submit();

        });
    });

</script>


<!--pdf script  -->
<script>
     $("#getpdf").click(function() {
        var action = '<?php echo site_url();?>/user/getpdf';
        $('#getform').attr('action', action);
        $('#getform').attr('target', "_blank");
        $('#getform').submit();
    });
</script>
