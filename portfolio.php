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
    $other_portfolios = get_other_portfolio_content($url_name);


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
$register_footer = false;
include('inc/header.php'); 
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  // Check for the Users Name
  if (preg_match ('/^[A-Z0-9 \'.-]{2,60}$/i', $_POST['name'])) {
    $data['name'] = $_POST['name'];
  } else {
    $errors['name'] = 'Please enter a valid Name!';
  }


  // Check for an email address:
  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $data['email'] = $_POST['email'];
  } else {
    $errors['email'] = 'Please enter a valid email address!';
  }

  // Check for the Address
  $data['address'] = assign('address', 'minlen=20','Please enter a valid Address');

  // Check for the message
  if (!(empty($_POST['message']))) {
    $data['message'] = $_POST['message'];
  } else {
    $errors['message'] = 'Please enter your message';
  }

  //Optional Fields

  # -- Phone Number
  if (isset($_POST['phone']) && (!empty($_POST['phone'])))
    $data['phone'] = assign('phone', 'minlen=7','Please enter a valid Phone Number');
  else $errors['phone'] = 'Please enter a valid Phone Number';

  # -- Payment Plan
  $data['payment_plan'] = $_POST['payment_plan'];


  if (empty($errors)){
    extract($data);

    $page_name = ucfirst($portfolio['name']);
    $ourEmail = "nnamdi@highrachy.com";
    $ourName = "Highrachy Investment and Technology";

    
    //Compulsory Variables
    //1. $name   2. $email  3.subject   4. $message
    // $message = $comments; Message is alreadey set in the code

    $details = "";

    $details .= "<br><br><strong>Name :</strong> ".$name. "<br>";
    $details .= "<strong>Email  :</strong> ".$email. "<br>";
    $details .= "<strong>Phone  :</strong> ".$phone . "<br>";
    $details .= "<strong>Address  :</strong> ".$address . "<br>";
    $details .= "<strong>Payment Plan  :</strong> ".$payment_plan . "<br>";

    $subject = "Request for Invoice from $name ($page_name)";
    //End of Compulsory 
    
    
    if (Email::send_mail($email,$subject,$message,$details)){
      $autoreply = Email::autoreply($email);
      $success = "Your message has been successfully received. We will get back to you within 24 hours";      
      $_POST = array();
    }


  }
  // End empty errors

}// End $_POST errors

     
?>
        
    <!-- Page content -->
    <div class="portfolio-content">

        <section class="mt-80">
            <div class="container">

            <?php display_alert(); //Necessary for get_action to work effectively ?>
            
            <div class="row">
                
                <!-- Rent Portfolio -->
                <div class="portfolio-details">
                    <div class="col-md-5">
                        <div class="normal-header">
                            <h3><?php echo $portfolio['name'] ?></h3>
                        </div>
                            <div class="lead"><?php echo $portfolio['content'] ?></div>
                            
                            <p> <br> <a href="#buy-property" class="btn btn-default btn-lg">Buy Property</a></p>
                           

                    </div>
                    <div class="col-md-6 col-md-offset-1 p-0">
                        <div class="col-sm-6 text-center">
                            <div class="feature-box">
                                <h2><?php echo $portfolio['living_room'] ?></h2>
                                <h5><?php echo get_only_plural($portfolio['living_room'],'Living Room') ?></h5>
                            </div>
                        </div>
                        <!--end 6 col-->
                        <div class="col-sm-6 text-center">
                            <div class="feature-box">
                                <h2><?php echo $portfolio['bedroom'] ?></h2>
                                <h5><?php echo get_only_plural($portfolio['bedroom'],'Bedroom') ?></h5>
                            </div>
                        </div>
                        <!--end 6 col-->
                        <div class="col-sm-6 text-center">
                            <div class="feature-box">
                                <h2><?php echo $portfolio['bathroom'] ?></h2>
                                <h5><?php echo get_only_plural($portfolio['bathroom'],'Bathroom') ?></h5>
                            </div>
                        </div>
                        <!--end 6 col-->
                        <div class="col-sm-6 text-center">
                            <div class="feature-box">
                                
                                <h2><?php echo $portfolio['toilet'] ?></h2>
                                <h5><?php echo get_only_plural($portfolio['toilet'],'Toilet') ?></h5>
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
                    <a href="#buy-property" class="btn btn-default btn-lg pull-right">Buy Property</a>
                </div>
            </div>
        </section>

        
        <section class="mt-80">
            <div class="container">

            <?php if ($portfolio['id'] == 2): // 4 Bedroom maisonettes?>
                <div class="normal-header">
                    <h3>MAISONETTES FlOOR PLANS</h3>
                    <p>&nbsp;</p>
                </div>

                <div class="row">
                    <div class="col-sm-6">

                        <img src="assets/images/1-units-ground-floor" alt="1 Units Ground Floor" class="img-responsive img-thumbnail">
                        <div>
                            <h4 class="text-center">Ground Floor</h4>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <img src="assets/images/1-units-first-floor" alt="1 Units First Floor" class="img-responsive img-thumbnail">
                        <div>
                            <h4 class="text-center">First Floor</h4>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            <?php else: // 3 bedroom apartments ?>

                <div class="normal-header">
                    <h3>APARTMENTS FlOOR PLANS</h3>
                    <p>&nbsp;</p>

                        <img src="assets/images/1-units-apartments" alt="1 Units Apartments" class="img-responsive img-thumbnail">
                        <div>
                            <h4 class="text-center">2nd and 3rd Floor</h4>
                        </div>
                </div>
            <?php endif ?>
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
                            <!-- <li>Parking Lot <span><?php echo $portfolio['parking_lots'] ?></span></li> -->
                            <li>&nbsp;</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sm-offset-1">

                        
                        <div class="normal-header">
                            <h3>Property Details</h3>
                        </div>

                        <ul class="property-overview list-unstyled">

                                <?php 
                                    available_feature($portfolio['cable_tv'],'Cable TV Distibution');
                                    available_feature($portfolio['core_fibre'],'Core Internet');
                                    available_feature($portfolio['intercom'],'Intercom System');
                                    available_feature($portfolio['security_fence'],'Security Fence');
                                    available_feature($portfolio['parking_lots'],'Parking Lot');
                                    available_feature($portfolio['kitchen'],'Spacious Kitchen');
                                    available_feature($portfolio['guest_toilet'],'Guest Toilet');
                                    available_feature($portfolio['maid_room'],'Maids Room');
                                    // TODO: ADD DEDICATED PARKING TO BACKEND
                                    available_feature($portfolio['intercom'],'Dedicated Parking');
                                    available_feature($portfolio['car_port'],'Car Port');
                                    available_feature($portfolio['surveillance'],'Surveillance System');
                                    available_feature($portfolio['rooftop_gym'],'Rooftop Gym');
                                    available_feature($portfolio['inverter'],'Inverter System');
                                    available_feature($portfolio['swimming_pool'],'Water Treatment Service');
                                    available_feature($portfolio['video_door'],'Video Door');
                                    available_feature($portfolio['fire_detection'],'Fire Detection');
                                ?>

                                <li></li>
                        </ul>
                        <p>Note: Items in <strong><span class="text-success">green</span></strong> comes with the <strong>Grand Package</strong></p>
                    </div>

                </div>
                <!-- /.row -->
            </div>
        </section>


        <section class="container">

        <?php if ($portfolio['id'] == 2): // 4 Bedroom maisonettes?>
        

            <div class="normal-header">
                <h3>Payment Plan</h3>
            </div>

            <div id="cd-table">
                
            <header class="cd-table-column">
                <h2>Packages</h2>
                <ul class="list-unstyled">
                    <li>Initial Payment</li>
                    <li>Quarter 1</li>
                    <li>Quarter 2</li>
                    <li>Quarter 3</li>
                    <li>Quarter 4</li>
                    <li>Quarter 5</li>
                    <li>Quarter 6</li>
                    <li>Quarter 7</li>
                    <li>Quarter 8</li>
                    <li>Total</li>
                </ul>
            </header>

            <div class="cd-table-container">
                <div class="cd-table-wrapper">

                    <div class="cd-table-column">
                        <h2>One-Off</h2>
                        <ul class="list-unstyled">
                            <li>36,000,000</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>₦ 36,000,000</li>

                        </ul>
                    </div> <!-- cd-table-column -->

                    <div class="cd-table-column">
                        <h2>12 Months</h2>
                        <ul class="list-unstyled">
                            <li>11,600,000</li>
                            <li>7,000,000</li>
                            <li>7,000,000</li>
                            <li>7,000,000</li>
                            <li><strong class="text-success">7,000,000</strong></li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>₦ 39,600,000</li>
                        </ul>
                    </div> <!-- cd-table-column -->

                    <div class="cd-table-column">
                        <h2>18 Months</h2>
                        <ul class="list-unstyled">
                            <li>9,900,000</li>
                            <li>5,250,000</li>
                            <li>5,250,000</li>
                            <li>5,250,000</li>
                            <li>5,250,000</li>
                            <li>5,250,000</li>
                            <li><strong class="text-success">5,250,000</strong></li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>₦ 41,400,000</li>
                        </ul>
                    </div> <!-- cd-table-column -->

                    <div class="cd-table-column">
                        <h2>24 Months</h2>
                        <ul class="list-unstyled">
                            <li>9,000,000</li>
                            <li>4,275,000</li>
                            <li>4,275,000</li>
                            <li>4,275,000</li>
                            <li>4,275,000</li>
                            <li>4,275,000</li>
                            <li>4,275,000</li>
                            <li>4,275,000</li>
                            <li><strong class="text-success">4,275,000</strong></li>
                            <li>₦ 43,200,000</li>
                        </ul>
                    </div> <!-- cd-table-column -->

                </div> <!-- cd-table-wrapper -->
            </div> <!-- cd-table-container -->

            <em class="cd-scroll-right"></em>
            </div>

        <?php else: ?>

            <div class="normal-header">
                <h3>Payment Plan</h3>
            </div>

            <div id="cd-table">
                
            <header class="cd-table-column">
                <h2>Packages</h2>
                <ul class="list-unstyled">
                    <li>Initial Payment</li>
                    <li>Quarter 1</li>
                    <li>Quarter 2</li>
                    <li>Quarter 3</li>
                    <li>Quarter 4</li>
                    <li>Quarter 5</li>
                    <li>Quarter 6</li>
                    <li>Quarter 7</li>
                    <li>Quarter 8</li>
                    <li>Total</li>
                </ul>
            </header>

            <div class="cd-table-container">
                <div class="cd-table-wrapper">

                    <div class="cd-table-column">
                        <h2>One-Off</h2>
                        <ul class="list-unstyled">
                            <li>27,500,000</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>₦ 27,500,000</li>

                        </ul>
                    </div> <!-- cd-table-column -->

                    <div class="cd-table-column">
                        <h2>12 Months</h2>
                        <ul class="list-unstyled">
                            <li>10,000,000</li>
                            <li>5,000,000</li>
                            <li>5,000,000</li>
                            <li>5,000,000</li>
                            <li><strong class="text-success">5,000,000</strong></li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>₦ 30,000,000</li>
                        </ul>
                    </div> <!-- cd-table-column -->

                    <div class="cd-table-column">
                        <h2>18 Months</h2>
                        <ul class="list-unstyled">
                            <li>8,500,000</li>
                            <li>3,840,000</li>
                            <li>3,840,000</li>
                            <li>3,830,000</li>
                            <li>3,830,000</li>
                            <li>3,830,000</li>
                            <li><strong class="text-success">3,830,000</strong></li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>₦ 31,500,000</li>
                        </ul>
                    </div> <!-- cd-table-column -->

                    <div class="cd-table-column">
                        <h2>24 Months</h2>
                        <ul class="list-unstyled">
                            <li>8,000,000</li>
                            <li>3,250,000</li>
                            <li>3,250,000</li>
                            <li>3,250,000</li>
                            <li>3,250,000</li>
                            <li>3,000,000</li>
                            <li>3,000,000</li>
                            <li>3,000,000</li>
                            <li><strong class="text-success">3,000,000</strong></li>
                            <li>₦ 33,000,000</li>
                        </ul>
                    </div> <!-- cd-table-column -->

                </div> <!-- cd-table-wrapper -->
            </div> <!-- cd-table-container -->

            <em class="cd-scroll-right"></em>
            </div>

        <?php endif ?>

            <div class="row" style="font-size: 12px;">
                <div class="text-danger  col-sm-4"><strong>* Customized payments available</strong></div> 
                <div class="text-success text-center-md text-center-lg col-sm-4"><strong>* Final Payment  per package</strong></div>
                <div class="text-danger text-right-md text-right-lg col-sm-4"><strong>* Prices are valid till March 2017</strong></div>
            </div>
            
        </section> <!-- cd-table -->



        <section class="mt-80">
            <div class="container">
                 <div class="normal-header">
                    <h3>Other Properties</h3>
                 </div>
                <div class="row">
                    <br>

                    <?php $i = 0;
                    foreach($other_portfolios as $other_portfolio) { ?>
                    <div class="col-sm-4">
                        <!-- Rent Block-->
                        <div class="rent-block">
                            <!-- Property Main Box -->
                            <div class="property-main-box">
                                <div class="property-images-box">
                                    <a href="property.php?p=<?php echo $other_portfolio['url_name'] ?>">
                                    <img src="assets/img/<?php echo $other_portfolio['picture'] ?>" alt="<?php echo $other_portfolio['name'] ?> image" class="img-responsive" /></a>
                                    <h4>&#8358; <?php echo get_number_words($other_portfolio['price']) ?></h4>
                                </div>
                                <div class="clearfix"></div>
                                <div class="property-details">
                                    <a class="link" title="<?php echo $other_portfolio['name'] ?>" href="property.php?p=<?php echo $other_portfolio['url_name'] ?>"><strong><?php echo $other_portfolio['name'] ?></strong></a>
                                    <ul>
                                        <li><i class="fa fa-expand"></i><?php echo $other_portfolio['size'] ?></li>
                                        <li><i><img src="assets/images/icon/bed-icon.png" alt="bed-icon" /></i><?php echo $other_portfolio['bedroom'] ?></li>
                                        <li><i><img src="assets/images/icon/bath-icon.png" alt="bath-icon" /></i><?php echo $other_portfolio['bathroom'] ?></li>
                                    </ul>

                                        <br>
                                    <div> <a href="<?php get_url('property.php?p='.$other_portfolio['url_name']) ?>" class="btn btn-primary btn-xs">Learn More</a> &nbsp;&nbsp;&nbsp;<a href="<?php get_url('property.php?p='.$other_portfolio['url_name'].'#buy-property') ?>" class="btn btn-default btn-xs">Buy Property</a></div>
                                </div>
                            </div><!-- Property Main Box /- -->
                        </div><!-- Rent Block/- -->
                    </div>
                    <?php } //endforeach ?>
                                            
                </div>
            </div>
        </section>

        <a id="buy-property"></a>
        <section class="mt-80 bg-gray">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 text-center">
                        <h2 class="text-uppercase">Buy Property : <?php echo $portfolio['name'] ?></h2>
                        <p class="lead">We will update you within the next 24 hours</p>
                    </div>                                        
                </div> 
                <!--end of row-->
                <div class="row">
                    <div class="col-md-8 col-sm-10 col-md-offset-2 col-sm-offset-1">

                     <?php display_alert(); //Necessary for get_action to work effectively ?>
                                       
                        <form action="#buy-property" method="post" enctype="multipart/form-data">
                                
                                <div class="form-group col-md-6">
                                  <label class="control-label">Name <span class="mandatory">*</span></label>
                                  <div>
                                    <?php Text('name','','class="form-control" placeholder="Enter your name here"') ?>
                                    <?php show_errors('name') ?>
                                  </div>
                                </div>
                                
                                <div class="form-group col-md-6">
                                  <label class="control-label">Email <span class="mandatory">*</span></label>
                                  <div>
                                    <?php Email('email','','class="form-control" placeholder="Enter your Email Address"') ?>
                                    <?php show_errors('email') ?>
                                  </div>
                                </div>


                                <div class="form-group col-md-6">
                                  <label class="control-label">Phone <span class="mandatory">*</span></label>
                                  <div>
                                    <?php Text('phone','','class="form-control" placeholder="Enter your Phone No"') ?>
                                    <?php show_errors('phone') ?>
                                  </div>
                                </div>

                                
                                <div class="form-group col-md-6">
                                  <label class="control-label">Payment Package <span class="mandatory">*</span></label>
                                  <div>
                                    <?php 
                                      $payment_plan_value = array();
                                      $payment_plan_value['One-Off'] = "One-Off Payment";
                                      $payment_plan_value['12 Months'] = "12 Months Payment";
                                      $payment_plan_value['18 Months'] = "18 Months Payment";
                                      $payment_plan_value['24 Months'] = "24 Months Payment";

                                      Select('payment_plan',$payment_plan_value,'','class="form-control"') ;
                                      ?>
                                  </div>
                                </div>
                                
                                

                                <div class="form-group col-md-12">
                                  <label class="control-label">Address <span class="mandatory">*</span></label>
                                  <div>
                                    <?php Textarea('address','','class="form-control" placeholder="Enter your address"',3) ?>
                                    <?php show_errors('address') ?>
                                  </div>
                                </div>

                                <div class="form-group col-md-12">
                                  <label class="control-label">Message <span class="mandatory">*</span></label>
                                  <div>
                                    <?php Textarea('message','','class="form-control" placeholder="Enter your message here"',7) ?>
                                    <?php show_errors('message') ?>
                                  </div>
                                </div>
                                    



                            <div class="form-group col-md-12">
                                <div>
                                    <button type="submit" class="btn btn-primary btn-lg">Buy Property</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div><!-- Page Content -->

  <?php include('inc/footer.php');