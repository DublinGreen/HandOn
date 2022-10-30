<?php include('includes/header.php'); ?>
<div id="carouselExampleInterval" class="carousel slide banner1" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-interval="5000">
            <img src="img/banner.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-interval="5000">
            <img src="img/banner1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/banner.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <div class="setbnner d-flex justify-content-center align-items-center banner1 text-center">
        <div class="col-md-8 m-auto">
            <h2 class="font-weight-bolder animate__animated animate__backInLeft">This is the heading for <span>
                    Lexi
                </span>
            </h2>
            <p>Some representative placeholder content for the first slide.
                Some representative placeholder content for the first slide.
                representative placeholder content for the first slide.
            </p>
            <button class="btn cfb" style="border-radius: 24px 0px 0px 0px;">
                Explore More
            </button>
        </div>
    </div>
</div>
<div class="container mt-5 pt-5">
    <div class="card_sec">
    
	<div class="card">
		<div class="box1">
			<div class="content headd">
            <img src="img/taxi.png" class="" alt="">
            <h3 class="font-weight-bold mt-2">
                    Heading one
                </h3>
                <p>
                    Lexi ipsum dolor sit amet consectetur adipisicing elit. Similique, perferendis accusamus? Quis
                </p>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="box1">
			<div class="content headd">
            <img src="img/briefcase.svg" class="" alt="">
            <h3 class="font-weight-bold mt-2">
                Heading one
            </h3>
            <p>
                Lexi ipsum dolor sit amet consectetur adipisicing elit. Similique, perferendis accusamus? Quis
            </p>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="box1">
			<div class="content headd">
            <img src="img/map.png" class="" alt="">
                <h3 class="font-weight-bold mt-2">
                    Heading one
                </h3>
                <p>
                    Lexi ipsum dolor sit amet consectetur adipisicing elit. Similique, perferendis accusamus? Quis
                </p>
			</div>
		</div>
	</div>
    <div class="card">
		<div class="box1">
			<div class="content headd">
            <img src="img/open-24-hours.svg" class="w-25" alt="">
                <h3 class="font-weight-bold mt-2">
                    Heading one
                </h3>
                <p>
                    Lexi ipsum dolor sit amet consectetur adipisicing elit. Similique, perferendis accusamus? Quis
                </p>
			</div>
		</div>
	</div>

    </div>
    <!-- <div class="row">
        <div class="col-md-6 col-lg-3 text-center carding">
            <div class="headd border py-3 rounded">
                <img src="img/taxi.png" class="" alt="">
                <h4 class="font-weight-bold mt-2">
                    Heading one
                </h4>
                <p>
                    Lexi ipsum dolor sit amet consectetur adipisicing elit. Similique, perferendis accusamus? Quis
                </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 text-center carding">
            <div class="headd border py-3 rounded">
            <img src="img/briefcase.svg" class="" alt="">
            <h4 class="font-weight-bold mt-2">
                Heading one
            </h4>
            <p>
                Lexi ipsum dolor sit amet consectetur adipisicing elit. Similique, perferendis accusamus? Quis
            </p>
        </div>
        </div>
        <div class="col-md-6 col-lg-3 text-center carding">
            <div class="headd border rounded py-3">
                <img src="img/map.png" class="" alt="">
                <h4 class="font-weight-bold mt-2">
                    Heading one
                </h4>
                <p>
                    Lexi ipsum dolor sit amet consectetur adipisicing elit. Similique, perferendis accusamus? Quis
                </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 text-center carding">
            <div class="headd border rounded py-3">
                <img src="img/open-24-hours.svg" class="w-25" alt="">
                <h4 class="font-weight-bold mt-2">
                    Heading one
                </h4>
                <p>
                    Lexi ipsum dolor sit amet consectetur adipisicing elit. Similique, perferendis accusamus? Quis
                </p>
            </div>
        </div>
    </div> -->
</div>
<!-- Form section  -->
<div class="container-fluid mt-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- <img src="img/booking_car12.png" data-aos="fade-right" class="w-100"> -->
            </div>
            <div class="col-md-6 borderr py-2">
                <form>
                    <div class="row mt-3">
                        <div class="col-md-6 col-12">
                            <input type="text" class="form-control form-set " placeholder=" Your Name">
                        </div>
                        <div class="col-md-6 col-12">
                            <input type="text" class="form-control form-set" placeholder="Phone">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 col-12">
                            <input type="text" class="form-control form-set" placeholder="Start Destination">
                        </div>
                        <div class="col-md-6 col-12">
                            <input type="text" class="form-control form-set" placeholder="End Destination">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 col-12">
                            <input type="date" class="form-control form-set" placeholder="">
                        </div>
                        
                    </div>

                    <div id="reveal-wrap">

                        <button type="button" class="btn cfb mt-3 reveal-click" name="answer"
                            onclick="showDiv()">Car Type</button>
                        <div id="welcomeDiv" style="display:none;" class="answer_list">
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="seclect_dr">
                                 <i class="fa fa-car" aria-hidden="true"></i>
                                    <h3>Moto</h3>
                                    <p>₹43.76</p>
                                 </div>
                              </div>
                              <div class="col-md-4">
                              <div class="seclect_dr">
                              <i class="fa fa-car" aria-hidden="true"></i>
                              <h3>Sedan car</h3>
                                    <p>₹43.76</p>
                                 </div>
                              </div>
                              <div class="col-md-4">
                              <div class="seclect_dr">
                                 <i class="fa fa-car" aria-hidden="true"></i>
                                 <h3>Premium</h3>
                                    <p>₹43.76</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form section  -->
<div class="container-fluid mt-5 pt-5" style="background:#f3e7f2c7;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <h3 class="font-weight-bolder">
                        Search Lexi APP
                    </h3>
                    <p class="h1 font-weight-bolder">
                        Get PickMe APP Now
                    </p>
                    <p class="text-dark">
                        Why I say old chap that is spiffing in my flat a blinding shot, Elizabeth blow off arse ummm
                        I'm telling sloshed smashing .!
                    </p>
                    <div class="row">
                        <img src="img/googleplay.svg" class="w mr-2" alt="" style="max-width: 200px;">
                        <img src="img/appstore.svg" class="w" alt="" style="max-width: 200px;">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 pt-5 mb-5">
                <div class="row">
                    <img src="img/02 (1).png" class="  w-100 vert-move" alt="">
                    <!-- <div class="col-md-6 col-6"><img src="img/phone_two(2).png" class=" w-100 vert-movet1" alt=""></div> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<section class="bgslider pt-5 pb-5 mt-5">
    <div class="container1 mt-5 ">
        <div class="box">
            <div class=" text-center">
                <div class="col-md-6 m-auto">
                    <div class="m-auto text-center">
                        <img src="img/radius-img.png" alt="" class="m-auto text-center">
                    </div>
                    <div>
                        <h3>
                            Rajat
                        </h3>
                        <p>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            Lexi ipsum dolor sit amet consectetur adipisicing elit. Voluptas cum fugit id. Amet
                            doloribus doLexi, autem fugit officiis tenetur vel? Magni omnis repellat ducimus quos nihil
                            facilis aperiam perspiciatis reiciendis!<i class="fa fa-quote-right" aria-hidden="true"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class=" text-center">
                <div class="col-md-6 m-auto">
                    <div class="m-auto text-center">
                        <img src="img/radius-img.png" alt="" class="m-auto text-center">
                    </div>
                    <div>
                        <h3>
                            Rajat
                        </h3>
                        <p>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            Lexi ipsum dolor sit amet consectetur adipisicing elit. Voluptas cum fugit id. Amet
                            doloribus doLexi, autem fugit officiis tenetur vel? Magni omnis repellat ducimus quos nihil
                            facilis aperiam perspiciatis reiciendis!<i class="fa fa-quote-right" aria-hidden="true"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class=" text-center">
                <div class="col-md-6 m-auto">
                    <div class="m-auto text-center">
                        <img src="img/radius-img.png" alt="" class="m-auto text-center">
                    </div>
                    <div>
                        <h3>
                            Rajat
                        </h3>
                        <p>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            Lexi ipsum dolor sit amet consectetur adipisicing elit. Voluptas cum fugit id. Amet
                            doloribus doLexi, autem fugit officiis tenetur vel? Magni omnis repellat ducimus quos nihil
                            facilis aperiam perspiciatis reiciendis!<i class="fa fa-quote-right" aria-hidden="true"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class=" text-center">
                <div class="col-md-6 m-auto">
                    <div class="m-auto text-center">
                        <img src="img/radius-img.png" alt="" class="m-auto text-center">
                    </div>
                    <div>
                        <h3>
                            Rajat
                        </h3>
                        <p>
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            Lexi ipsum dolor sit amet consectetur adipisicing elit. Voluptas cum fugit id. Amet
                            doloribus doLexi, autem fugit officiis tenetur vel? Magni omnis repellat ducimus quos nihil
                            facilis aperiam perspiciatis reiciendis!<i class="fa fa-quote-right" aria-hidden="true"></i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="slick-next">Next</button>
    </div>
</section>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 pt-5 seth2">
            <h2 data-aos="fade-right">
                <span class="font-weight-bolder"> Who We are</span>
            </h2>
            <p>
                Lexi Ipsum passages, and more recently with desktop publishing software like aldus pageMaker including
                versions of all the Lexi Ipsum generators on thet Internet tends to repeat predefined chunks as
                necessary, making this an web evolved over the years, sometimes by accident.
            </p>
            <span>
                <a href="#" class="btn cfb">Details</a>
            </span>
        </div>
        <div class="col-md-6">
            <div class="m-auto text-center">
                <img data-aos="fade-up" data-aos-anchor-placement="top-bottom" src="img/about-img.png" alt=""
                    class="w-50">
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php')?>