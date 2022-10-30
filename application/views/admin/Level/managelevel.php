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
                        <h3 class="box-title"><a href="<?= site_url();?>/Level/addLevel" style="font-size: 14px;" class="btn btn-block btn-success btn-xs">Add New</a></h3>
                    </div>

                    <div class="main-data">
                        <div class="row">
                            <form method="post" id="getPdf">
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
                                            <span><button type="button" id="search"style="background-color: #d9a944;color: #FFFFFF;border-radius:6px;border:1px solid #33cccc;box-shadow: 0 4px 5px 0 rgba(156, 39, 176, 0.14), 0 1px 10px 0 rgba(156, 39, 176, 0.12), 0 2px 4px -1px rgba(156, 39, 176, 0.2);">Search</button></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                                <th>Level</th>
                                <th>ExpCount</th>
                                <th>Image</th>
                                <th >Sound</th>
                                <th> Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id = "ts">
                            <?php $i = 1; foreach($details as $data){ ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <td><?php  echo $data['leval'];?></td>
                                    <td><?php  echo $data['expCount'];?></td>

                                    <td><?php
                                        if (empty($data['image'])) {?>
                                            <img src="<?php echo base_url()."uploads/no_image_available.png";?>" style="width: 50px;height: 50px;">
                                        <?php } else{ ?>
                                            <img src="<?php echo base_url().$data['image'];?>" style="width: 50px;height: 50px;">
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php
                                        if (empty($data['sound'])) {?>
                                            <audio controls src="<?php echo base_url()."uploads/no_available.mp3";?>"  type="audio/ogg" ></audio>
                                        <?php } else{ ?>
                                            <audio controls src="<?php echo base_url().$data['sound'];?>" type="audio/ogg"></audio>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($data['status'] == '1'){?>
                                            <span class="label label-success"><?php  echo Approved;?></span>
                                        <?php } else{?>
                                            <span class="label label-warning"><?php  echo Decline; ?></span>
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
                                                        <a role="menuitem" tabindex="-1" href="<?= site_url()?>/Level/editLevel/<?= $data['id'];?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure you want to delete?');" href="<?= site_url()?>/Level/delete/<?= $data['id'];?>">Delete
                                                        </a>
                                                    </li>
                                                    <li role="presentation" class="divider"></li>
                                                    <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="<?= site_url()?>/Level/status/<?= $data['id'];?>">
                                                            <?php if($data['status'] == '1'){ echo "Decline"; } else{ echo "Approved";}?>

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
    $("#pname").keyup(function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            $("#search").click();
        }
    });
    $(document).ready(function(){
        $("#search").click(function(){
            var start = $("#sdate").val();
            var end = $("#edate").val();
            var name = $("#pname").val();
            $.ajax({
                type:"post",
                url:"<?= site_url()?>/gift/getResult",
                data:{s:start,e:end,p:name},
                dataType: 'json',                //data format
                success: function(data){
                    if(data ==''){
                        $('#ts').html('<tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr>');
                    }
                    else{
                        var html, comment;
                        for(var i = 0; i < data.length; i++) {
                            comment = data[i];
                            if(comment.image == ""){
                                var img = '<img src="<?php echo base_url()."uploads/no_image_available.png";?>" style="width: 50px;height: 50px;">';
                            }
                            else{
                                var img = '<img src="<?php echo $data['image'];?>" style="width: 50px;height: 50px;">';
                            }
                            html += '<tr><td>' + (i+1) + '</td><td>' + comment.title + '</td><td>' + img + '</td><td>' + comment.primeAccount +
                                '</td><td>' + comment.nonPrimeAccount + '</td><td><span class="label label-success">' + comment.status +
                                '</span></td><td><ul class="admin-action btn btn-default" style="background-color: #f4f4f4;color: #fff !important;"><li class="dropdown"><a class="dropdown-toggle" style="color: black;" data-toggle="dropdown" href="#" aria-expanded="false">' + "Action " + '<span class="caret"></span></a></li></ul></td></tr>';
                        }

                        $('#ts').html(html);
                    }
                }
            });
        });
    });
    $(function(){
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear()+1;
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;
        $('#sdate').attr('max', maxDate);
        $('#edate').attr('max', maxDate);
    });
</script>
