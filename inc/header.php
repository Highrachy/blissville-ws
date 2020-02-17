<?php
    // $is_christmas_time = true; // comment out to disable

    // Redirect People that are not logged in
    if (isset($dashboard)) {
        User::redirect_invalid_admin();
    }

    # -- Retrieve options from the database ########################################################################################
    require_once(INCLUDE_DIR.'options.function.php');
    $options = get_options();

    # -- Remove Regiter Footer from dashboard ########################################################################################
    if (isset($dashboard) && ($dashboard)) {
        $register_footer = false;
    }
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Lagos, Condos">
  <meta name="author" content="Haruna Popoola">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#446cb3">
  <!-- Windows -->
  <meta name="msapplication-navbutton-color" content="#446cb3">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#446cb3">

  <title><?php echo ucfirst($page_title); ?> | Get efficient,
    luxurious and affordable Condominiums</title>

  <!-- Description -->
  <?php if (isset($description)) { ?>
  <meta name="description" content="<?php echo $description ?>">
  <?php } else { ?>
  <meta name="description"
    content="Our projects strategically aim at providing energy efficient luxurious condominiums for the ever growing middle class within the Lekki suburbs. We aim to continually avail this market segment with unique edifices that are affordable to acquire and convenient manage, while they enjoy the luxuries available in today’s real estate industry.">
  <?php } ?>
  <!-- /.Description -->

  <!-- Keywords -->
  <meta name="keywords"
    content="Blissville, Blissville Condos, Blissville Condominiums, Apartments, Blissville Uno, Maisonnettes, Lekki, Lagos, Apartments in Lagos, Affordable Apartments Lekki <?php echo $page_title ?>">

  <!-- /.Keywords-->

  <!-- For IE 9 and below. ICO should be 32x32 pixels in size -->
  <!--[if IE]><link rel="shortcut icon" href="<?php URL::display('favicon.ico') ?>">
  <![endif]-->

        <!-- Touch Icons - iOS and Android 2.1+ 180x180 pixels in size. -->
        <link rel="apple-touch-icon" href="<?php URL::display('apple-touch-icon.png') ?>">

        <!-- Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size. -->
        <link rel="apple-touch-icon" href="<?php URL::display('favicon.png') ?>">
        <!-- Android Mobile -->
        <link rel="icon" sizes="192x192" href="<?php URL::display('favicon.png') ?>">


        <!-- CSS file links -->
        <?php if (!isset($dashboard)) : ?>
        <link href="<?php URL::display('assets/css/main.css') ?>" rel="stylesheet" media="screen">
        <?php else: // DASHBOARD CSS?>
        <link href="<?php URL::display('assets/css/dashboard_main.css') ?>" rel="stylesheet" media="screen">
        <?php endif ?>

        <style>
            .property-box figure img {
                height: 245px;
            }
        </style>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
  <script
    src="<?php URL::display('assets/js/html5/html5shiv.min.js') ?>">
  </script>
  <script
    src="<?php URL::display('assets/js/html5/respond.min.js') ?>">
  </script>
  <![endif]-->

        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700,900" rel="stylesheet" type="text/css">

    </head>

    <body>
        <!-- Start Header -->
        <header class="navbar yamm navbar-default navbar-fixed-top<?php if (isset($dashboard)) {
    echo " dashboard";
} ?>">
            <div class="topBar">
                <div class="container<?php if (isset($dashboard)) {
    echo "-fluid";
} ?>">
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="topBarText">Blissville is an initiative of <a href="http://www.highrachy.com"><img src="<?php URL::display('assets/img/highrachy_logo.png') ?>" alt="Highrachy Logo" height="15" style="opacity:0.7"></a></p>
                            <p class="topBarText right hidden-small"><span class="fa fa-user"></span>&nbsp;&nbsp;<a href="<?php URL::display('admin') ?>">Sign into your account</a></p>
                            <p class="topBarText right hidden-tiny"><span class="fa fa-envelope"></span>&nbsp;&nbsp;<a href="mailto:<?php echo $options['email'] ?>"><?php echo $options['email'] ?></a></p>
                            <p class="topBarText right"><span class="fa fa-phone-square"></span>&nbsp;&nbsp;<?php echo $options['phone'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container<?php if (isset($dashboard)) {
    echo "-fluid";
} ?>">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><img src="<?php URL::display('assets/img/logo.png') ?>" alt="Blissville Logo"  class="img-responsive" /></a>

                    <!-- Christmas Time -->
                    <?php if (isset($is_christmas_time)) : ?>
                      <a class="navbar-brand" href="index.php"><img src="<?php URL::display('assets/img/xmas.png') ?>" alt="Blissville Father Chrismas"  class="img-responsive" /></a>
                    <?php endif ?>

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="fa fa-bars"></span>
                    </button>
                </div>

                <?php if (!isset($dashboard)) : ?>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?php URL::display() ?>" <?php Page::active_menu('home', 'current') ?>>HOME</a>
                        </li>
                        <li>
                            <a href="<?php URL::display("about-us.php") ?>" <?php Page::active_menu('about-us', 'current') ?>>ABOUT US</a>
                        </li>
                        <li class="dropdown">
                            <a href="<?php URL::display("our-portfolio.php") ?>" class="dropdown-toggle <?php Page::active_menu('our-portfolio', 'current', false) ?>" data-toggle="dropdown">PORTFOLIO <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <!-- <li><a href="#">Portfolio</a></li>
                                <li><a href="our-portfolio.php">Blissville Uno</a></li> -->
                                <li class="dropdown-submenu"><a href="our-portfolio.php" data-toggle="dropdown">Blissville Uno</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php URL::display('our-portfolio.php') ?>">View Blissville Uno</a></li>
                                        <li><a href="<?php URL::display('property.php?p=3-bedroom-apartments') ?>"><span class="fa fa-angle-right"></span> &nbsp; 3 Bedroom Apartments</a></li>
                                        <li><a href="<?php URL::display('property.php?p=4-bedroom-maisonettes') ?>"> <span class="fa fa-angle-right"></span> &nbsp; 4 Bedroom Maisonettes</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php URL::display("faqs.php") ?>" <?php Page::active_menu('faqs', 'current') ?>>FAQS</a>
                        </li>
                        <li>
                            <a href="<?php URL::display("investors.php") ?>" <?php Page::active_menu('investors', 'current') ?>>INVESTORS</a>
                        </li>
                        <li>
                            <a href="<?php URL::display("contact-us.php") ?>" <?php Page::active_menu('contact-us', 'current') ?>>CONTACT US</a>
                        </li>
                    </ul>
                </div><!--/.navbar-collapse -->

                <?php else: ?>

                <ul class="nav navbar-nav navbar-right hidden-xs pull-right dashboard-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" aria-expanded="true" data-toggle="dropdown"><i class="fa fa-user"></i></a>
                        <!-- <ul class="dropdown-menu">
                            <li>
                                <a href="">Content 1</a>
                                <a href="">Content 2</a>
                                <a href="">Content 3</a>
                            </li>
                        </ul> -->
                    </li>
                    <!-- li.dropdown>a.dropdown-toggle[aria-expanded="true" data-toggle="dropdown"]>i.fa.fa-2x.fa-^ul.dropdown-menu>li>a{Content
  $}*3 -->

  <li><a href="#"><i class="fa fa-bell"></i> <!-- <span class="badge badge-danger">3</span> --></a></li>

  <li class="dropdown">
    <a href="#" data-toggle="dropdown" aria-expanded="true" class="dropdown-toggle">
      <img
        src="<?php URL::display('assets/img/profile/user1.jpg') ?>"
        alt="user-image" class="img-circle" height="30">
      <span><?php echo ' '.Session::get('name'); ?>
        <i class="fa fa-angle-down"></i></span>
    </a>
    <ul class="dropdown-menu">
      <li>

        <a
          href="<?php URL::display('admin/users/logout.php') ?>">Logout</a>
        <!-- <a href="">Content 1</a>
                                    <a href="">Content 2</a>
                                    <a href="">Content 3</a> -->
      </li>
    </ul>
  </li>
  </ul>
  <?php endif ?>


  </div><!-- end header container -->
  </header><!-- End Header -->


  <?php if (!isset($subheader) && (!isset($dashboard))) { //if subheader/dashboard is not set.?>

  <section class="top-page-title">

    <!-- Parallax -->
    <div class="top-page-title_parallax"
      style="background-image: url('<?php echo BASE_URL ?>assets/uploads/slideshow/slide-3.jpg');background-position: 50% 0px;">
    </div>

    <!-- Overlay -->
    <div class="top-page-title_overlay"></div>

    <?php if (!isset($page_title)) {
    $page_title = $title;
} ?>
    <?php if (!isset($page_title)) {
    $title = "blissville";
} ?>
    <?php if (!isset($page_desc)) {
    $page_desc = 'Future Ready Real Estate';
} ?>

    <!-- Content -->
    <div class="top-page-title_content">
      <div class="container">
        <div class="top-page-title_content-text">
          <div class="top-page-title_shadow-title"><?php echo $title ?>
          </div>
          <h3><?php echo $page_title ?>
          </h3>
          <p><?php echo $page_desc ?>
          </p>
        </div>
      </div>
    </div>

  </section>
  <?php } ?>

  <?php if (isset($dashboard)) {
    include(SERVER_DIR.'inc/admin-sidebar.php');
}
