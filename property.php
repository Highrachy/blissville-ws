<?php
include('config.php');
include('inc/functions.php');


# -- Get Property

//Check for the id
if (isset($_GET['p'])) {
    $url_name = $_GET['p'];

    //If the property url_name is set but it is not defined
    if ($url_name == "") {
        URL::redirect('our-portfolio.php');
        exit();
    } else {
        //The property id is defined

        //Display information to the user.
        $property = Property::get_one("Where url_name = '$url_name'");
        $other_propertys = Property::get_all("Where url_name <> '$url_name'");


        //Check if the total_rows is less than 1
        if (empty($property)) {
            URL::redirect('our-portfolio.php');
            exit();
        } else {

          //Get All the information from the database.
            extract($property);

            $property_id = $id;
            // $property_type_id = $property_type_id;

          // $slideshows = get_property_slideshow(); // $limit = 0, $order_by_random= false, $show_picture -> yes = false
          // $gallerys = get_property_gallery(0,false,true); //$limit = 0, $start=0,$show_all = false
        }
    }
} else {
    redirect('our-portfolio.php');
    exit();
}


# -- Page Configuration ########################################################################################
$title = "our-portfolio";
$page_title = $name;
$page_desc = "We don't just sell homes, We guarantee your future";
$slider = true;
$lightbox = true;
$register_footer = false;
include('inc/header.php');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for the Users Name
    if (preg_match('/^[A-Z0-9 \'.-]{2,60}$/i', $_POST['name'])) {
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

    // Check for the Location
    $data['location'] = $_POST['location'];

    // Check for the message
    if (!(empty($_POST['message']))) {
        $data['message'] = $_POST['message'];
    } else {
        $errors['message'] = 'Please enter your message';
    }

    //Optional Fields

    # -- Phone Number
    if (isset($_POST['phone']) && (!empty($_POST['phone']))) {
        $data['phone'] = Form::validate('phone', array('minlen=7'=>'Please enter a valid Phone Number'));
    } else {
        $errors['phone'] = 'Please enter a valid Phone Number';
    }


    if (empty($errors)) {
        extract($data);

        $page_name = ucfirst($property['name']);
        $ourEmail = "nnamdi@highrachy.com";
        $ourName = "Highrachy Investment and Technology";


        //Compulsory Variables
        //1. $name   2. $email  3.subject   4. $message
        // $message = $comments; Message is alreadey set in the code

        $details = "";

        $details .= "<br><br><strong>Name :</strong> ".$name. "<br>";
        $details .= "<strong>Email  :</strong> ".$email. "<br>";
        $details .= "<strong>Phone  :</strong> ".$phone . "<br>";
        $details .= "<strong>Location  :</strong> ".$location . "<br>";
        $details .= "<strong>Payment Plan  :</strong> ".$payment_plan . "<br>";

        $subject = "Request for Invoice from $name ($page_name)";
        //End of Compulsory


        if (Email::send_mail($email, $subject, $message, $details)) {
            $autoreply = Email::autoreply($email);
            $success = "Your message has been successfully received. We will get back to you within 24 hours";
            $_POST = array();
        }
    }
    // End empty errors
}// End $_POST errors


?>

<style>
  @media only screen and (min-width: 870px) {
    #cd-table .cd-table-column {
      width: 33.34%;
      float: left;
    }
  }
</style>

<!-- Page content -->
<div class="property-content">

  <section class="mt-80">
    <div class="container">

      <?php Alert::display(); //Necessary for get_action to work effectively?>

      <div class="row">

        <!-- Rent property -->
        <div class="property-details">
          <div class="col-md-5">
            <div class="normal-header">
              <h3><?php echo $property['name'] ?>
              </h3>
            </div>
            <div class="lead"><?php echo $property['content'] ?>
            </div>

            <p>
              <br>
              <a href="#payment_plan" class="btn btn-primary btn-lg mr-15">Payment Plans</a><a href="#buy-property"
                class="btn btn-default btn-lg">Buy Property</a>
            </p>


          </div>
          <div class="col-md-6 col-md-offset-1 p-0">
            <div class="col-sm-6 text-center">
              <div class="feature-box">
                <h2><?php echo $property['living_room'] ?>
                </h2>
                <h5><?php echo Text::plural($property['living_room'], 'Living Room', 'Living Rooms', 'Living Room', false) ?>
                </h5>
              </div>
            </div>
            <!--end 6 col-->
            <div class="col-sm-6 text-center">
              <div class="feature-box">
                <h2><?php echo $property['bedroom'] ?>
                </h2>
                <h5><?php echo Text::plural($property['bedroom'], 'Bedroom', 'Bedrooms', 'Bedroom', false) ?>
                </h5>
              </div>
            </div>
            <!--end 6 col-->
            <div class="col-sm-6 text-center">
              <div class="feature-box">
                <h2><?php echo $property['bathroom'] ?>
                </h2>
                <h5><?php echo Text::plural($property['bathroom'], 'Bathroom', 'Bathrooms', 'Bathroom', false) ?>
                </h5>
              </div>
            </div>
            <!--end 6 col-->
            <div class="col-sm-6 text-center">
              <div class="feature-box">

                <h2><?php echo $property['toilet'] ?>
                </h2>
                <h5><?php echo Text::plural($property['toilet'], 'Toilet', 'Toilets', 'Toilet', false) ?>
                </h5>
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
          <img src="assets/images/slider/banner6.jpg" alt="Slide 1">
        </div>

        <div class="item">
          <img src="assets/images/slider/banner5.jpg" alt="Slide 2">

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
          <h3 class="text-danger">OUTRIGHT PAYMENT :
            <?php
                                // Enter sold out for Maisonettes
                                if ($property['id'] == 2): // 4 Bedroom maisonettes
                                    echo '<strike>&#8358; '. number_format($property['price']). '</strike> SOLD OUT';
                                else:
                                    echo '&#8358; '. number_format($property['price']);
                                endif;
                            ?>
          </h3>
          <span>Payment plans: Customized. Mortgage with attractive rates also available.</span>

        </div>
        <a href="#buy-property" class="btn btn-default btn-lg pull-right">Buy Property</a>
      </div>
    </div>
  </section>


  <section class="mt-80">
    <div class="container">

      <?php if ($property['id'] == 2): // 4 Bedroom maisonettes?>
      <div class="normal-header">
        <h3>MAISONETTES FlOOR PLANS</h3>
        <p>&nbsp;</p>
      </div>

      <div class="row">
        <div class="col-sm-6">

          <a rel="floor-plans"
            href="<?php URL::display('assets/images/1-units-ground-floor.jpg') ?>"
            class="fancybox">
            <img
              src="<?php URL::display('assets/images/1-units-ground-floor.jpg') ?>"
              alt="1 Units Ground Floor" class="img-responsive img-thumbnail">
          </a>
          <div>
            <h4 class="text-center">Ground Floor</h4>
          </div>

        </div>
        <div class="col-sm-6">
          <a rel="floor-plans"
            href="<?php URL::display('assets/images/1-units-first-floor.jpg') ?>"
            class="fancybox">
            <img
              src="<?php URL::display('assets/images/1-units-first-floor.jpg') ?>"
              alt="1 Units First Floor" class="img-responsive img-thumbnail">
          </a>
          <div>
            <h4 class="text-center">First Floor</h4>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <?php else: // 3 bedroom apartments?>

      <div class="normal-header">
        <h3>APARTMENTS FlOOR PLANS</h3>
        <p>&nbsp;</p>
        <a rel="floor-plans"
          href="<?php URL::display('assets/images/1-units-apartments.jpg') ?>"
          class="fancybox">
          <img
            src="<?php URL::display('assets/images/1-units-apartments.jpg') ?>"
            alt="1 Units Apartments" class="img-responsive img-thumbnail">
        </a>
        <div>
          <h4 class="text-center">2nd and 3rd Floor</h4>
        </div>
      </div>
      <?php endif ?>
    </div>
  </section>


  <section class="mt-80 mb-50">
    <div class="container">

      <div class="row">
        <div class="col-md-5">


          <div class="normal-header">
            <h3>Overview</h3>
          </div>
          <ul class="property-overview list-unstyled">
            <li>Property Type <span><?php echo $property['property_type'] ?></span>
            </li>
            <li>Floor <span><?php echo $property['floor'] ?></span>
            </li>
            <li>Location <span><?php echo $property['location'] ?></span>
            </li>
            <li>Size <span><?php echo $property['size'] ?></span>
            </li>
            <li>Bedrooms <span><?php echo $property['bedroom'] ?></span>
            </li>
            <li>Bathrooms <span><?php echo $property['bathroom'] ?></span>
            </li>
            <!-- <li>Parking Lot <span><?php echo $property['parking_lots'] ?></span>
            </li> -->
            <li>&nbsp;</li>
          </ul>
        </div>
        <div class="col-md-6 col-md-offset-1">


          <div class="normal-header">
            <h3>Property Details</h3>
          </div>

          <ul class="property-overview list-unstyled">

            <?php
              Property::available_feature($property['cable_tv'], 'Cable TV Distribution');
              // Property::available_feature($property['core_fibre'], 'Core Internet');
              Property::available_feature($property['intercom'], 'Intercom System');
              Property::available_feature($property['security_fence'], 'Security Fence');
              // Property::available_feature($property['parking_lots'], 'Parking Lot');
              Property::available_feature($property['kitchen'], 'Spacious Kitchen');
              Property::available_feature($property['guest_toilet'], 'Guest Toilet');
              Property::available_feature($property['maid_room'], 'Maids Room');
              // TODO: ADD DEDICATED PARKING TO BACKEND
              Property::available_feature($property['intercom'], 'Dedicated Parking');
              Property::available_feature($property['car_port'], 'Car Port');
              Property::available_feature($property['surveillance'], 'Surveillance System');
              Property::available_feature($property['rooftop_gym'], 'Gym');
              Property::available_feature($property['inverter'], 'Inverter System');
              Property::available_feature($property['swimming_pool'], 'Water Treatment System');
              Property::available_feature($property['video_door'], 'Video Door');
              Property::available_feature($property['fire_detection'], 'Fire Detection');
            ?>

            <!-- <li class="col-sm-6">&nbsp;</li> -->
            <br class="clearfix" />
            <div class="clearfix mt-50">&nbsp;</div>
          </ul>
          <p class="clearfix">Note: Items in <strong><span class="text-success">green</span></strong> comes with the
            <strong>Grand Package</strong></p>
        </div>

      </div>
      <!-- /.row -->
    </div>
  </section>

  <section class="mt-80">
    <div class="container">
      <div class="normal-header">
        <h3>Other Properties</h3>
      </div>
      <div class="row">
        <br>

        <?php
                    foreach ($other_propertys as $other_property) { ?>
        <div class="col-md-4 col-sm-6">
          <?php echo Property::box($other_property) ?>
        </div>
        <?php } //endforeach?>

      </div>
    </div>
  </section>



  <a id="buy-property"></a>
  <section class="mt-80 bg-gray">
    <div class="container">
      <div class="row">

        <div class="col-sm-12 text-center">
          <h2 class="text-uppercase">Buy Property : <?php echo $property['name'] ?>
          </h2>
          <p class="lead">We will update you within the next 24 hours</p>
        </div>
      </div>
      <!--end of row-->
      <div class="row">
        <div class="col-md-8 col-sm-10 col-md-offset-2 col-sm-offset-1">

          <?php Alert::display(); //Necessary for get_action to work effectively?>

          <form action="#buy-property" method="post" enctype="multipart/form-data">

            <div class="form-group col-md-6">
              <label class="control-label">Name <span class="mandatory">*</span></label>
              <div>
                <?php Form::text('name', '', array("class" => "form-control", "placeholder" => "Enter your name here")) ?>
                <?php Form::show_info('name') ?>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Email <span class="mandatory">*</span></label>
              <div>
                <?php Form::email('email', '', array("class" => "form-control", "placeholder" => "Enter your Email Address")) ?>
                <?php Form::show_info('email') ?>
              </div>
            </div>


            <div class="form-group col-md-6">
              <label class="control-label">Phone <span class="mandatory">*</span></label>
              <div>
                <?php Form::text('phone', '', array("class" => "form-control", "placeholder" => "Enter your Phone No")) ?>
                <?php Form::show_info('phone') ?>
              </div>
            </div>


            <div class="form-group col-md-6">
              <label class="control-label">Your Location <span class="mandatory">*</span></label>
              <div>
                <?php Form::text('location', '', array("class" => "form-control", "placeholder" => "Enter your location")) ?>
                <?php Form::show_info('location') ?>
              </div>
            </div>

            <div class="form-group col-md-12">
              <label class="control-label">Message <span class="mandatory">*</span></label>
              <div>
                <?php Form::textarea('message', '', array("class" => "form-control", "placeholder" => "Enter your message here", 'rows'=> 7)) ?>
                <?php Form::show_info('message') ?>
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
