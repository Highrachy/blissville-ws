<?php 
include('config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 

# -- Page Configuration ########################################################################################
$title = "our-portfolio";
$page_title = "Our Portfolio";
$page_desc = "We don't just sell homes, We guarantee your future";
$breadcrumb = array('Our Portfolio'=> 'our-portfolio.php','5 Bedroom Terraces' => '#');
$slider = true;
include('inc/header.php'); 

?>
        
    <!-- Page content -->
    <div class="portfolio-content">

        <section class="mt-80">
            <div class="container">
            <div class="row">
                
                <!-- Rent Property -->
                <div class="portfolio-details">
                    <div class="col-md-5 mt-80">
                        <div class="normal-header">
                            <h3><span> 5 Bedroom</span> Terraces</h3>
                            <p class="lead">5 bedroom Semi – Detached Terrace houses (a guest room and a maids room inclusive) with five and a half bathrooms, Living room, dining room, entry foyer, guest toilet, personal yard and a dedicated carport. </p>

                            <p> <br> <a href="<?php echo FOUR_BEDROOM_PAYMENT ?>" class="btn btn-default btn-lg">Buy Now</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-1 p-0">
                        <div class="col-sm-6 text-center">
                            <div class="feature-box">
                                <h2>5</h1>
                                <h5>Bedrooms</h5>
                            </div>
                        </div>
                        <!--end 6 col-->
                        <div class="col-sm-6 text-center">
                            <div class="feature-box">
                                <h2>1</h1>
                                <h5>Living Room</h5>
                            </div>
                        </div>
                        <!--end 6 col-->
                        <div class="col-sm-6 text-center">
                            <div class="feature-box">
                                <h2>5</h1>
                                <h5>Washrooms</h5>
                            </div>
                        </div>
                        <!--end 6 col-->
                        <div class="col-sm-6 text-center">
                            <div class="feature-box">
                                <h2>2</h1>
                                <h5>Parking Lot</h5>
                            </div>
                        </div>
                        <!--end 6 col-->
                    </div>
                </div>
            </div>

            </div>
        </section>

        <section class="slider-block container-fluid p-0 mt-80">
            <!-- Slider Section -->
            <div id="property-slider" class="carousel slider-section" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img src="assets/images/slider/banner7.jpg" alt="Slide 1">
                    </div>

                    <div class="item">
                        <img src="assets/images/slider/banner4.jpg" alt="Slide 2">

                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#property-slider" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#property-slider" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><!-- Slider Section /- -->
        </section><!-- Slider Block /- -->

        <section>
            <div class="promo">
                <div class="container">
                    <div class="content">
                        <h3>PRICE (TOTAL PACKAGE) : &#8358; 45,000,000</h3>
                        <span>We don't just sell homes, we guarantee your future</span>
                    </div>
                    <a href="<?php echo FOUR_BEDROOM_PAYMENT ?>" class="btn btn-default btn-lg pull-right">BUY NOW</a>
                </div>
            </div>
        </section>

        <section class="mt-80">
            <div class="container">

                <div class="row">
                    <div class="col-sm-5">

                        
                        <div class="normal-header">
                            <h3>Overview</h3>
                        </div>
                        <ul class="property-overview list-unstyled">
                             <li>Property Type <span>5 BEDROOM TERRACES</span></li>
                            <li>Floor <span>GROUND &amp; 1ST FLOOR</span></li>
                            <li>Location <span>ETI-OSA</span></li>
                            <li>Size <span>255 Msq</span></li>
                            <li>Bedrooms <span>5</span></li>
                            <li>Washrooms <span>5</span></li>
                            <li>Parking Lot <span>2</span></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sm-offset-1">

                        
                        <div class="normal-header">
                            <h3>Property Details</h3>
                        </div>
                        <table class="table property-table">
                            <tr>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Cable TV Distibution</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Core Fiber Internet</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Inverter System</td>
                            </tr>
                            <tr>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Security Fence</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Parking Lot</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Dedicated Car Port</td>
                            </tr>

                            <tr>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Guest Toilet</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Guest Room</td>

                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Maid Room</td>
                            </tr>
                            <tr>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Surveillance System</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Smart Solar System</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Panic Alarm</td>
                            </tr>
                            <tr>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" /> Intercom System</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Spacious Kitchen</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Video door phone</td>
                            </tr>
                            <tr>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Fire detection</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Swimming Pool</td>
                                <td><img class="icon" src="assets/images/icon-check.png" alt="" />Rooftop Gym</td>
                                
                            </tr>
                        </table><br/>
                    </div>

                </div>
                <!-- /.row -->
            </div>
        </section>

        
    </div><!-- Page Content -->

  <?php include('inc/footer.php');