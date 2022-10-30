1<style>
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
            <li><a href="<?php echo site_url();?>/User/view/<?php echo $mainId;?>"> View User</a></li>
            <li class="active"><?= $title?></li>
        </ol>

        <div style="float:right;padding: 10px;">
            <form id="getform" class="form-inline">
                <div class="form-group">
                    <label for="s_date">Start date:</label>
                    <input type="date" id="s_date" class="form-control">
                </div>
                <div class="form-group" style="padding-right: 5px">
                    <label for="e_date">End date:</label>
                    <input type="date" id="e_date" class="form-control">
                </div>
                <a href="javascript:void(0)" id="getexcel"><i class="fa fa-file-excel-o" style="font-size: 30px; color:green;" aria-hidden="true"></i></a>
            </form>
        </div>

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
                                <!--<th>Username</th>
                                <th>Name</th>
                                <th>Channel</th>
                                <th>Status</th>-->
                                <th>Last Login(Date/Time)</th>
                                <th>Live Time</th>
                                <!--<th>Action</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; foreach($details as $data){ ?>
                                <tr>
                                    <td><?= $i;?></td>
                                    <!--<td><?php // echo $data['name'];?></td>
                                    <td><?php // echo $data['username'];?></td>
                                    <td><?php // echo $data['channelName'];?></td>-->

                                    <td><?php  echo $data['created'];?></td>
                                    <td>
                                        <?php
                                        if(!empty($data['archivedDate']) || $data['archivedDate'] != ''){
                                            $date1 = new DateTime($data['created']);
                                            $date2 = $date1->diff(new DateTime($data['archivedDate']));
                                            $dayHour =  $date2->d * 60;

                                            $totalHour = $date2->h * 60;
                                            echo $finalMin = $date2->i + $totalHour + $dayHour;

                                            // echo $date2->h.' hours'."\n";
                                            // echo $date2->i.' minutes'."\n";
                                            // echo $date2->s.' seconds'."\n";

                                        }
                                        else{
                                            echo "00";
                                        }
                                        ?>
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
        $('#example1').DataTable();
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





<!--pdf script  -->



<script>
    $("#getpdf").click(function() {

        var action = '<?php echo site_url();?>/user/getpdf/';
        $('#getform').attr('action', action);
        $('#getform').attr('target', "_blank");
        $('#getform').submit();
    });


</script>

<!--excel script    -->

<script>
    $(document).ready(function() {
        $('#getexcel').on('click', function() {
            let s_date = $("#s_date").val();
            let e_date = $("#e_date").val();
            let page = '<?php echo $this->uri->segment(3);?>';
            if (page==""){
                page = 1;
            }

            if (s_date){
                if (e_date){
                    let search_date = s_date+'d'+e_date;
                    //var action = '<?php echo site_url();?>/user/get_live_excel';
                    window.location.href = '<?php echo site_url();?>/user/get_live_excel/'+page+'/'+search_date;

                }else {
                    e_date = s_date;
                    let search_date = s_date+'d'+e_date;
                    //var action = '<?php echo site_url();?>/user/get_live_excel';
                    window.location.href = '<?php echo site_url();?>/user/get_live_excel/'+page+'/'+search_date;
                }

            }else {
                alert("please provide start date..");

            }

        });
    });

</script>
