<?php 
include('config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 

# -- Get Portfolio ########################################################################################
require_once(INCLUDE_DIR.'portfolio.function.php');
//Check for the id
if (isset($_GET['p'])){
  $url_name = $_GET['p'];
  
  //If the portfolio url_name is set but it is not defined
if ($url_name == ""){
    redirect('portfolio');
    exit();
  }  else {
    //The portfolio id is defined
    
    //Display information to the user.
    $portfolio = get_portfolio_content($url_name);


    //Check if the total_rows is less than 1
    if (get_total_portfolios() < 1) {
          redirect('portfolio');
          exit();
    } else {
          
          //Get All the information from the database.
          extract($portfolio);

          $portfolio_id = $id;
          // $portfolio_type_id = $portfolio_type_id;

          // $slideshows = get_portfolio_slideshow(); // $limit = 0, $order_by_random= false, $show_picture -> yes = false
          // $gallerys = get_portfolio_gallery(0,false,true); //$limit = 0, $start=0,$show_all = false

    }
  }
} else {
  redirect('our-portfolio.php');
  exit();
}


# -- Page Configuration ########################################################################################
$title = "our-portfolio";
$page_title = "Our Portfolio";
$page_desc = "We don't just sell homes, We guarantee your future";
$breadcrumb = array('Our Portfolio'=> 'our-portfolio.php','4 Bedroom Apartments' => '#');
$slider = true;
include('inc/header.php'); 

?>
        
    <!-- Page content -->
    <div class="portfolio-content">

        <section class="mt-80">
            <div class="container">
            <div class="row">
                
                <!-- Rent Portfolio -->
                <div class="portfolio-details">
                    <div class="col-md-5 mt-80">
                        <div class="normal-header">
                            <h3><?php echo $portfolio['url_name'] ?></h3>
                            <p class="lead"><?php echo $portfolio['content'] ?></p>
                            
                            <p> <br> <a href="contact-us.php" class="btn btn-default btn-lg">Contact Us</a></p>
                           

                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-1 p-0">
                        <h2>Payment Plan</h2>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>Packages</td>
                                <td>One-Off</td>
                                <td>12 Months</td>
                                <td>18 Months</td>
                                <td>24 Months</td>
                            </tr>
                            <tr>
                                <td>Quarter 0 <br>(Initial Payment)</td>
                                <td>27,500,000</td>
                                <td>10,000,000</td>
                                <td>8,500,000</td>
                                <td>8,000,000</td>
                            </tr>
                            <tr>
                                <td>Quarter 1</td>
                                <td>&nbsp;</td>
                                <td>5,000,000</td>
                                <td>3,840,000</td>
                                <td>3,250,000</td>
                            </tr>
                            <tr>
                                <td>Quarter 2</td>
                                <td>&nbsp;</td>
                                <td>5,000,000</td>
                                <td>3,840,000</td>
                                <td>3,250,000</td>
                            </tr>
                            <tr>
                                <td>Quarter 3</td>
                                <td>&nbsp;</td>
                                <td>5,000,000</td>
                                <td>3,830,000</td>
                                <td>3,250,000</td>
                            </tr>
                            <tr>
                                <td>Quarter 4</td>
                                <td>&nbsp;</td>
                                <td>5,000,000</td>
                                <td>3,830,000</td>
                                <td>3,250,000</td>
                            </tr>
                            <tr>
                                <td>Quarter 5</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>3,830,000</td>
                                <td>3,000,000</td>
                            </tr>
                            <tr>
                                <td>Quarter 6</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>3,830,000</td>
                                <td>3,000,000</td>
                            </tr>
                            <tr>
                                <td>Quarter 7</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>3,000,000</td>
                            </tr>
                            <tr>
                                <td>Quarter 8</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>3,000,000</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>27,500,000</td>
                                <td>30,000,000</td>
                                <td>31,500,000</td>
                                <td>33,000,000</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            </div>
        </section>

        <section class="slider-block container-fluid p-0 mt-80">
            <!-- Slider Section -->
            <div id="portfolio-slider" class="carousel slider-section" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img src="assets/images/slider/banner6.jpg" alt="Slide 1">
                    </div>

                    <div class="item">
                        <img src="assets/images/slider/banner5.jpg" alt="Slide 2">

                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#portfolio-slider" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#portfolio-slider" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><!-- Slider Section /- -->
        </section><!-- Slider Block /- -->

        <section>
            <div class="promo">
                <div class="container">
                    <div class="content">
                        <h3>PRICE (TOTAL PACKAGE) : &#8358; <?php echo get_price($portfolio['price']) ?></h3>
                        <span>We don't just sell homes, we guarantee your future</span>
                    </div>
                    <a href="contact-us.php" class="btn btn-default btn-lg pull-right">Contact Us</a>
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
                            <li>Property Type <span><?php echo $portfolio['property_type'] ?></span></li>
                            <li>Floor <span><?php echo $portfolio['floor'] ?></span></li>
                            <li>Location <span><?php echo $portfolio['location'] ?></span></li>
                            <li>Size <span><?php echo $portfolio['size'] ?></span></li>
                            <li>Bedrooms <span><?php echo $portfolio['bedroom'] ?></span></li>
                            <li>Bathrooms <span><?php echo $portfolio['bathroom'] ?></span></li>
                            <li>Parking Lot <span><?php echo $portfolio['parking_lots'] ?></span></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sm-offset-1">

                        
                        <div class="normal-header">
                            <h3>Property Details</h3>
                        </div>
                        <table class="table property-table">
                            <tr>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['cable_tv']) ?>" alt="<?php echo $portfolio['cable_tv'] ?>" />Cable TV Distibution</td>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['core_fibre']) ?>" alt="<?php echo $portfolio['core_fibre'] ?>" />Core Internet</td>
                            </tr>

                            <tr>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['intercom']) ?>" alt="<?php echo $portfolio['intercom'] ?>" /> Intercom System</td>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['security_fence']) ?>" alt="<?php echo $portfolio['security_fence'] ?>" />Security Fence</td>
                            </tr>

                            <tr>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['parking_lots']) ?>" alt="<?php echo $portfolio['parking_lots'] ?>" />Parking Lot</td>
                                
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['kitchen']) ?>" alt="<?php echo $portfolio['kitchen'] ?>" />Spacious Kitchen</td>
                            </tr>

                            <tr>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['guest_toilet']) ?>" alt="<?php echo $portfolio['guest_toilet'] ?>" />Guest Toilet</td>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['maid_room']) ?>" alt="<?php echo $portfolio['maid_room'] ?>" />Maid Room</td>
                            </tr>
                            
                            <tr>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['car_port']) ?>" alt="<?php echo $portfolio['car_port'] ?>" />Dedicated Parking</td>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['guest_room']) ?>" alt="<?php echo $portfolio['guest_room'] ?>" />Car Port</td>
                            </tr>

                            <tr>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['surveillance']) ?>" alt="<?php echo $portfolio['surveillance'] ?>" />Surveillance System</td>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['rooftop_gym']) ?>" alt="<?php echo $portfolio['rooftop_gym'] ?>" />Rooftop Gym</td>

                            </tr>

                            <tr>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['inverter']) ?>" alt="<?php echo $portfolio['inverter'] ?>" />Inverter System (Shared Services)</td>

                                <!-- TODO: UPDATE THIS TO WATER TREATMENT SERVICE -->
                                <td><img class="icon" src="assets/images/icon-check.png" alt="Water Treatment Service" />Water Treatment Service</td>

                            </tr>

                            <tr>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['video_door']) ?>" alt="<?php echo $portfolio['video_door'] ?>" />Video Phone</td>
                                
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['fire_detection']) ?>" alt="<?php echo $portfolio['fire_detection'] ?>" />Fire detection</td>
                            </tr>
                            <tr>
                                <td colspan="2"> <strong>Note:</strong> Some of items are marked in green. They come with the grand package.</td>
                            </tr>
                           <!--  <tr>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['smart_solar']) ?>" alt="<?php echo $portfolio['smart_solar'] ?>" />Smart Solar System</td>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['fire_detection']) ?>" alt="<?php echo $portfolio['fire_detection'] ?>" />Fire detection</td>
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['video_door']) ?>" alt="<?php echo $portfolio['video_door'] ?>" />Video door phone</td>
                                
                            </tr>
                            <tr>
                                
                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['swimming_pool']) ?>" alt="<?php echo $portfolio['swimming_pool'] ?>" />Swimming Pool</td>

                                <td><img class="icon" src="assets/images/<?php is_feature_available($portfolio['panic_alarm']) ?>" alt="<?php echo $portfolio['panic_alarm'] ?>" />Panic Alarm</td>
                            </tr> -->
                        </table><br/>
                    </div>

                </div>
                <!-- /.row -->
            </div>
        </section>

        
    </div><!-- Page Content -->

  <?php include('inc/footer.php');