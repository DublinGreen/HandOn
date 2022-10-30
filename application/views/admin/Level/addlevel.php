<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <?= $title;?>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="<?php echo site_url();?>/Gift/liveGift">Manage Live Gift</a></li>

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

                                <label>Level*</label>

                                <input type="number" class="form-control" value="<?= set_value('leval');?>" name="level" placeholder="level">

                                <div class="form-error1"><?= form_error('level');?></div>

                            </div>

                            <div class="form-group">

                                <label>	ExpCount*</label>

                                <input type="number" class="form-control" value="<?= set_value('expCount');?>" name="expCount" placeholder="ExpCount">

                                <div class="form-error1"><?= form_error('expCount');?></div>

                            </div>

                            <div class="form-group">

                                <label>Color*</label>

                                <input type="color" class="form-control" value="" name="color">

                                <div class="form-error1"></div>

                            </div>


                            <div class="form-group">

                                <label>Icon*</label>

                                <input type="file" class="form-control" name="image">

                                <div class="form-error1"><?= form_error('image');?></div>

                            </div>

                            <div class="form-group">

                                <label>Sound*</label>

                                <input type="file" class="form-control" name="sound">

                                <div class="form-error1"><?= form_error('sound');?></div>

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
