<?php include('includes/header.php')?>




    <div class="container-fluid helpbanner pt-5 pb-5">
        <div class="container text-light pt-5 pb-5 text-center">
            <h2 class="h1 pt-2 pb-2 font-weight-bolder"> Have enquiries ? </h2>
            <h3 class="font-weight-bolder">We are here to help!</h3>
            <button type="button" class="btn btn-info mt-3 mb-4 cfb">Reach Us</button>
            <h5><a href="#" class="font-weight-bolder">Click here to join <span class="font-weight-bolder">LEXI</span></a></h5>

        </div>
    </div>
    <div class="container pt-5 pb-5">

        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="nav flex-column nav-pills helpnav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active helppills" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">For Riders</a>
                    <a class="nav-link  helppills" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">For Drivers</a>
                    <a class="nav-link  helppills" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Emergency</a>
                </div>
            </div>
            <div class="col-md-9 col-lg-9 col-sm-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="accordion pb-5" id="Passenger">
                            <div class="card">
                                <div class="card-header" id="PheadingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link hbtn btn-block text-left" type="button" data-toggle="collapse" data-target="#PcollapseOne" aria-expanded="true" aria-controls="PcollapseOne">
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>First Query?
                                  </button>
                                    </h2>
                                </div>

                                <div id="PcollapseOne" class="collapse show" aria-labelledby="PheadingOne" data-parent="#Passenger">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta dolores quod magnam, saepe velit impedit voluptate eum omnis laboriosam cumque iure veritatis aperiam hic nihil, temporibus repellendus assumenda dolorum facere?
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="PheadingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed hbtn" type="button" data-toggle="collapse" data-target="#PcollapseTwo" aria-expanded="false" aria-controls="PcollapseTwo">
                                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>Second query ?
                                  </button>
                                        </h2>
                                    </div>
                                    <div id="PcollapseTwo" class="collapse" aria-labelledby="PheadingTwo" data-parent="#Passenger">
                                        <div class="card-body">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro neque praesentium nesciunt facere provident natus dolor impedit sint a placeat laboriosam nisi voluptas aspernatur ratione, quod quam aut totam suscipit.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="PheadingThree">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link hbtn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#PcollapseThree" aria-expanded="false" aria-controls="PcollapseThree">
                                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>Third query?
                                  </button>
                                        </h2>
                                    </div>
                                    <div id="PcollapseThree" class="collapse" aria-labelledby="PheadingThree" data-parent="#Passenger">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum dolor animi quisquam eum neque cum sed et odio, temporibus itaque perspiciatis placeat accusantium laboriosam tempore quidem? Nisi praesentium ut illum?
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="accordion" id="Drivers">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn hbtn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="DcollapseOne">
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>First query?
                                  </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#Drivers">
                                    <div class="card-body">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero quam sint modi officiis quasi dolorum reprehenderit ipsa tempora veritatis delectus, praesentium architecto, ullam minus culpa repellendus? Libero neque reiciendis adipisci.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link hbtn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Second Query?
                                  </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#Drivers">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci magnam illo nobis delectus, et, sapiente perferendis placeat voluptates voluptatum error reprehenderit architecto recusandae. Commodi maxime iure, ea ratione maiores minima.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link hbtn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>Third Query?
                                  </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#Drivers">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente alias, vel iste et esse ullam veritatis blanditiis labore amet cupiditate aliquam voluptatibus natus eius, quidem sint cumque recusandae minus fugit?.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <h4 class="text-center pt-2">For Emergency call press below!</h4>
                        <div class="row mt-5">

                            <button type="button" class="btn btn-danger btn-lg m-auto rounded-pill">Emergency</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container-fluid callsupport">
        <div class="container pt-5 pb-5">
            <div class="row text-center">
                <div class="col-md-6">
                    <img src="img/call-support.jpg" alt="call-support" class="w-100">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div>
                        <h3 class="mt-2">We are happy to help!</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur minima dolores iure illum quas facere nobis ut eveniet enim hic quibusdam placeat voluptatibus, magnam numquam architecto ratione dignissimos amet quaerat! Nisi,
                            ad quis. Dolore reprehenderit numquam libero autem nulla ipsum! Error doloremque quam, ea molestias iure magnam similique. Voluptatem ab debitis incidunt ad inventore dolor iure non sed enim quasi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

   



<?php include('includes/footer.php')?>
    