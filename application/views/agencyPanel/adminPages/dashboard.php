<style>
  .dummyImage {
    width: 128px !important;
    height: 128px !important;
}

    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: 1px solid #7ae0ec !important;
    background: #7ae0ec !important;
    font-weight: normal !important;
    color: #201804 !important;
}

.ui-widget-header {
  border: 1px solid #7ae0ec !important;
  background: #7ae0ec !important;
  color: #201804 !important;
  font-weight: bold !important;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1 style="margin-top: 12px;font-family: auto;text-align: center;">
        Agency Portal
      </h1>
    </section>

    <section class="content">
      <!-- Info boxes -->
      <div class="row">
          <?php
          if($admin['role'] == '0'){ ?>
          <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box" style="background: #06690d;color: #fff;">
            <span class="info-box-icon"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><b>Total User</b></span>
              <span class="info-box-number"><?php echo $user; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <?php
        }?>
        <div class="col-md-3 col-sm-6 col-xs-12">
               <div class="info-box" style="background: #06690d;color: #fff;">
            <span class="info-box-icon"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text"><b>Total Pending Host</b></span>
              <span class="info-box-number"><?php echo $pending_host; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          
            
                <div class="info-box" style="background: #058d9e;color: #fff;">
            <span class="info-box-icon"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><b>Total Approved Host</b></span>
              <span class="info-box-number"><?php echo $approved_host; ?></span> 
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
  
        
    
        <!-- /.col -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          
            <div class="info-box" style="background: #c72a16;color: #fff;">
            <span class="info-box-icon"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><b>Total Rejected Host</b></span>
              <span class="info-box-number"><?php echo $rejected_host; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
 
 
         

       



        <!-- /.col -->
      <!--   <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div> -->
            <!-- /.info-box-content -->
          <!-- </div> -->
          <!-- /.info-box -->
        <!-- </div> -->
        <!-- /.col -->

        <!-- fix for small devices only -->

        <!-- /.col -->

      </div>
      <!-- /.row -->







                          <!--graphs-->

      <div class="row"  <?php if($admin['role'] == 'subAdmin'){ ?> style="display:none"   <?php } ?>>
               <!--Left col-->
    <section class="col-lg-12" style="padding-bottom: 10px">
        <div style="padding-right: 2em">

            <canvas id="myChart"  height="120"></canvas>

        </div>

        <div style="display: flex;flex-wrap: wrap">
            <div style="width: 50%">

                <div>
                    <canvas id="follow_chart"  height="150"></canvas>
                </div>


            </div>
             <div style="width: 50%">

                <div>
                    <canvas id="block_chart"  height="150"></canvas>
                </div>


            </div>

           <!-- <div style="width: 50%;margin-top: 2em;">

                <div>
                    <canvas id="view_video"  height="150"></canvas>
                </div>


            </div> -->
              <div style="width: 50%;margin-top: 2em;">

                <div>
                    <canvas id="like_video"  height="150"></canvas>
                </div>

            </div>
          <div style="width: 50%;margin-top: 2em;">

                <div>
                    <canvas id="comment_video"  height="150"></canvas>
                </div>


            </div>

            <div style="width: 50%;margin-top: 2em;">

               <div>
                   <canvas id="upload_video"  height="150"></canvas>
               </div>


           </div>

        </div>

    </section>


      </div>
      <!-- /.row (main row) -->



      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->

          

          <!-- TABLE: LATEST ORDERS -->
          <!--div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Popularity</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="label label-success">Shipped</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-warning">Pending</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="label label-danger">Delivered</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-info">Processing</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="label label-warning">Pending</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="label label-danger">Delivered</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Call of Duty IV</td>
                    <td><span class="label label-success">Shipped</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
            <!--div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
          <!-- PRODUCT LIST -->
          <!--div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added Products</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <img src="<?php echo base_url();?>assets/dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Samsung TV
                      <span class="label label-warning pull-right">$1800</span></a>
                    <span class="product-description">
                          Samsung 32" 1080p 60Hz LED Smart HDTV.
                        </span>
                  </div>
                </li>
                <li class="item">
                  <div class="product-img">
                    <img src="<?php echo base_url();?>assets/dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Bicycle
                      <span class="label label-info pull-right">$700</span></a>
                    <span class="product-description">
                          26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                        </span>
                  </div>
                </li>
                <li class="item">
                  <div class="product-img">
                    <img src="<?php echo base_url();?>assets/dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Xbox One <span
                        class="label label-danger pull-right">$350</span></a>
                    <span class="product-description">
                          Xbox One Console Bundle with Halo Master Chief Collection.
                        </span>
                  </div>
                </li>
                <li class="item">
                  <div class="product-img">
                    <img src="<?php echo base_url();?>assets/dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">PlayStation 4
                      <span class="label label-success pull-right">$399</span></a>
                    <span class="product-description">
                          PlayStation 4 500GB Console (PS4)
                        </span>
                  </div>
                </li>
              </ul>
            </div>
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase">View All Products</a>
            </div>
          </div-->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"
				type="text/javascript"></script>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css"
			rel="Stylesheet" type="text/css" />
<script type="text/javascript">

    $("#searchDate").click(function(){
        var searchDate = $("#startdate").val();
        $.ajax({
      		method:"post",
     			url:"<?php echo site_url()?>/AgencyPanel/searhAgencyPortalWithDate",
      		data:{searchDate:searchDate},
      		//dataType: "json",                //data format
          success: function(result){
            $("#track").replaceWith(result);
         	}
      	});
    });

		$(function () {
				$("#startdate").datepicker({
				    dateFormat: "yy/mm/dd" ,
						numberOfMonths: 1,
						maxDate:0,
						onSelect: function (selected) {
								var dt = new Date(selected);
								dt.setDate(dt.getDate() + 1);
								$("#enddate").datepicker("option", "minDate", dt);
						}
				});
				$("#enddate").datepicker({
				    dateFormat: "yy/mm/dd" ,
						numberOfMonths: 1,
					maxDate:0,
						onSelect: function (selected) {
								var dt = new Date(selected);
								dt.setDate(dt.getDate() - 1);
								$("#startdate").datepicker("option", "maxDate", dt);
						}
				});
		});

</script>
