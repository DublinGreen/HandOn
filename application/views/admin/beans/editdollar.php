<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title;?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo site_url();?>/Beans/dollarExchange ">Dollar Exchange </a></li>

            <li class="active"><?= $title;?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <?php if($this->session->flashdata('success')){ ?>
                <div class="success-message">
                    <script> swal("Good job!", "<?= $this->session->flashdata('success')?>!", "success") </script>
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

                                <label>Beans*</label>

                                <input type="number" class="form-control" value="<?php echo $details['beans']?>" name="beans" placeholder="Beans">

                                <div class="form-error1"><?= form_error('beans');?></div>

                            </div>

                            <div class="form-group">

                                <label>Dollar*</label>

                                <input type="number" class="form-control" value="<?php echo $details['dollar']?>" name="dollar" placeholder="Dollar">

                                <div class="form-error1"><?= form_error('dollar');?></div>

                            </div>

                            <div class="form-group">

                                <label>Minimum Beans*</label>

                                <input type="number" class="form-control" value="<?php echo $details['minimumBeans']?>" name="minimumBeans" placeholder="minimumBeans">

                                <div class="form-error1"><?= form_error('minimumBeans');?></div>

                            </div>

                            <input type="hidden" value="<?php echo $details['id']?>" name="id">
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
