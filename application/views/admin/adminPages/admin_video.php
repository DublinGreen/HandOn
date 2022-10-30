<div class="content-wrapper">

    <section class="content-header">

        <h1>

            <?= $title;?>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo site_url();?>/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

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

                                <label>Video Title*</label>

                                <input type="text" class="form-control" value="<?= set_value('video_title');?>" name="video_title" placeholder="Title">

                                <div class="form-error1"><?= form_error('video_title');?></div>

                            </div>

                            <div class="form-group">

                                <label>Url*</label>

                                <input type="url" class="form-control" value="<?= set_value('url');?>" name="url" placeholder="Video Url">

                                <div class="form-error1"><?= form_error('url');?></div>

                            </div>

                            <div class="form-group">

                                <label>Select Video File*</label>

                                <input type="file" class="form-control" name="file">

                                <div class="form-error1"><?= form_error('file');?></div>

                            </div>


                            <div class="form-group">

                                <label>Button Name*</label>

                                <input type="text" class="form-control" value="<?= set_value('btn_name');?>" name="btn_name" placeholder="Button Name">

                                <div class="form-error1"><?= form_error('btn_name');?></div>

                            </div>

                            <div class="form-group">

                                <label>Sponsored By*</label>

                                <input type="text" class="form-control" value="<?= set_value('sponsored_by');?>" name="sponsored_by" placeholder="Sponsored By">

                                <div class="form-error1"><?= form_error('sponsored_by');?></div>

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