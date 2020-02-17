        <?php if (!isset($register_footer)) { ?>

        <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for the Users Name
    if (preg_match('/^[A-Z0-9 \'.-]{2,60}$/i', $_POST['name'])) {
        $data['name'] = $_POST['name'];
    } else {
        $errors[] = 'Please enter a valid Name!';
    }


    // Check for an email address:
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $data['email'] = $_POST['email'];
    } else {
        $errors[] = 'Please enter a valid email address!';
    }

    // Check for the message
    if (!(empty($_POST['message']))) {
        $data['message'] = $_POST['message'];
    } else {
        $errors[] = 'Please enter your message';
    }

    //Optional Fields

    # -- Phone Number
    if (isset($_POST['phone']) && (!empty($_POST['phone']))) {
        $data['phone'] = Form::validate('phone', array('minlen=7'=>'Please enter a valid Phone Number'));
    } else {
        $data['phone'] = "";
    }

    # -- Interest
    $data['interest'] = $_POST['interest'];


    if (empty($errors)) {
        extract($data);

        $page_name = ucfirst($title)." Page ";
        $ourEmail = "nnamdi@highrachy.com";
        $ourName = "Highrachy Investment and Technology";


        //Compulsory Variables
        //1. $name   2. $email  3.subject   4. $message
        // $message = $comments; Message is alreadey set in the code

        $details = "";

        $details .= "<br><br><strong>Name :</strong> ".$name. "<br>";
        $details .= "<strong>Email  :</strong> ".$email. "<br>";
        $details .= "<strong>Phone  :</strong> ".$phone . "<br>";
        $details .= "<strong>Interest  :</strong> ".$interest . "<br>";

        $subject = "Message from $name (".ucfirst($title)." Page)";
        //End of Compulsory


        if (Email::send_mail($email, $subject, $message, $details)) {
            $autoreply = Email::autoreply($email);
            $success = "Your message has been successfully received. We will get back to you within 24 hours";
            $_POST = array();
            Form::clear_values();
        }
    }
    // End empty errors
}// End $_POST errors


?>

        <a id="register-interest"></a>
        <section class="mt-80 bg-gray">
          <div class="container">
            <div class="row">

              <div class="col-sm-12 text-center">
                <h2 class="text-uppercase">Register Interest</h2>
                <p class="lead">
                  We'll update you within the next 24 hours
                </p>
              </div>
            </div>
            <!--end of row-->
            <div class="row">
              <div class="col-md-8 col-sm-10 col-md-offset-2 col-sm-offset-1">

                <?php Alert::display(); //Necessary for get_action to work effectively?>

                <form action="#register-interest" method="post" enctype="multipart/form-data">

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
                      <?php Form::email('email', '', array("class" => "form-control", "placeholder" =>"Enter your Email Address")) ?>
                      <?php Form::show_info('email') ?>
                    </div>
                  </div>


                  <div class="form-group col-md-6">
                    <label class="control-label">Phone <span class="mandatory">*</span></label>
                    <div>
                      <?php Form::text('phone', '', array("class" => "form-control", "placeholder" =>"Enter your Phone No")) ?>
                      <?php Form::show_info('phone') ?>
                    </div>
                  </div>


                  <div class="form-group col-md-6">
                    <label class="control-label">Interest <span class="mandatory">*</span></label>
                    <div>
                      <?php
                                                          $interest_value = array();
                                                          $interest_value['Buy Property'] = "I want to buy Property";
                                                          $interest_value['Information'] = "I need more Information on Blissville Condominiums";
                                                          $interest_value['Subscriber'] = "I want to become a subscriber";
                                                          $interest_value['Investors'] = "I wish to become an investor";
                                                          $interest_value['Others'] = "Others";

                                                          Form::select('interest', $interest_value, array("class" => "form-control")) ;
                                                          ?>
                    </div>
                  </div>



                  <div class="form-group col-md-12">
                    <label class="control-label">Message <span class="mandatory">*</span></label>
                    <div>
                      <?php Form::textarea('message', '', array("class" => "form-control", "placeholder" => "Enter your message here", "rows" => 5)) ?>
                      <?php Form::show_info('message') ?>
                    </div>
                  </div>




                  <div class="form-group col-md-12">
                    <div>
                      <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
        <?php } ?>

        <?php if (!isset($dashboard)): ?>
        <!-- Footer Section -->
        <div id="footer-section" class="footer-section">
          <!-- container -->
          <div class="container">
            <!-- col-md-3 -->
            <div class="col-md-4 col-sm-6 col-sm-push-6 col-md-push-0">
              <!-- About Widget -->
              <aside class="widget widget_about">
                <h3 class="widget-title">About Us</h3>
                <p>Our homes are affordable and still have the perks that come with a healthy luxurious lifestyle, hence
                  property acquisition costs are low with juicy returns from rentals making Blissville the ideal
                  investors destination.</p>
              </aside>
              <!-- About Widget /- -->
            </div><!-- col-md-3 -->

            <!-- col-md-3 -->
            <div class="col-md-4 hidden-sm hidden-xs">
              <!-- Quick Link Widget -->
              <aside class="widget widget_quick_links">
                <h3 class="widget-title">Quick Links</h3>
                <ul class="p_l-0">
                  <li><a title="Quick Links"
                      href="http://blissville.highrachy.com/portfolio.php?p=3-bedroom-apartments">3 Bedroom
                      Apartments</a></li>
                  <li><a title="Quick Links"
                      href="http://blissville.highrachy.com/portfolio.php?p=4-bedroom-maisonettes">4 Bedroom
                      Maisonettes</a></li>
                  <li><a title="Quick Links" href="investors.php">Become an Investor</a></li>
                  <li><a title="Quick Links" href="our-portfolio.php">Our Portfolio</a></li>
                  <li><a title="Quick Links" href="contact-us.php">Contact Us</a></li>
                  <li><a title="Quick Links" href="contact-us.php#send-us-message">Send Us a Message</a></li>
                </ul>
              </aside>
              <!-- Quick Link Widget /- -->
            </div><!-- col-md-3 -->

            <!-- col-md-3 -->
            <div class="col-md-4 col-sm-6 col-sm-pull-6 col-md-pull-0">
              <!-- Address Widget -->
              <aside class="widget widget_address">
                <h3 class="widget-title">Address</h3>
                <p>5th Floor, Ibukun House,<br>
                  No.70 Adetokunbo Ademola Street,<br>
                  Victoria Island, Lagos.<br></p>
                <span>0802-833-7440</span>
                <a title="mailto" href="mailto:info@highrachy.com ">info@highrachy.com </a>
              </aside>
              <!-- Address Widget /- -->
            </div><!-- col-md-3 -->

          </div><!-- container /- -->
          <!-- Footer Bottom -->
          <div id="footer-bottom" class="footer-bottom footer-bottom2">
            <!-- container -->
            <div class="container">
              <p class="col-md-6 col-sm-8 col-xs-12">&copy; <?php echo date('Y') ?> Powered by <a
                  href="http://highrachy.com/" style="color:white">Highrachy Investments and Techonology</a></p>
              <div class="col-md-6 col-sm-4 col-xs-12 pull-right social hidden-xs hidden-sm">
                <ul class="footer_social mb-0">
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                  <!-- <li><a href="#"><i class="fa fa-rss"></i></a></li> -->
                </ul>
                <!-- <a href="#" title="back-to-top" id="back-to-top" class="back-to-top"><i class="fa fa-angle-up"></i> Top</a> -->
              </div>
            </div><!-- container /- -->
          </div><!-- Footer Bottom /- -->
        </diV><!-- Footer Section -->
        <?php else: ?>
        <footer class="container-fluid dashboard-footer right-panel">
          Copyright © <?php echo Date('Y') ?> <a
            href="#" target="_blank">Highrachy</a>
          <a href="#" class="pull-right scrollToTop"><i class="fa fa-chevron-up"></i></a>
        </footer>
        <?php endif ?>

        <!-- jQuery Include -->
        <script
          src="<?php URL::display('assets/js/jquery.min.js') ?>">
        </script>
        <script
          src="<?php URL::display('assets/js/jquery.easing.min.js') ?>">
        </script><!-- Easing Animation Effect -->
        <script
          src="<?php URL::display('assets/js/bootstrap/bootstrap.min.js') ?>">
        </script> <!-- Core Bootstrap v3.2.0 -->
        <script
          src="<?php URL::display('assets/js/modernizr/modernizr.custom.37829.js') ?>">
        </script> <!-- Modernizer -->
        <script
          src="<?php URL::display('assets/js/jquery.bootstrap.wizard.min.js') ?>">
        </script> <!-- It Loads jQuery when element is appears -->
        <!-- <script src="<?php URL::display('assets/js/jquery.waypoints.min.js') ?>">
        </script> -->
        <script
          src="<?php URL::display('assets/js/wow.min.js') ?>">
        </script>
        <script
          src="<?php URL::display('assets/js/image-picker.min.js') ?>">
        </script>

        <!-- Chrismas time -->
        <?php if (isset($is_christmas_time)) : ?>
        <script
          src="<?php URL::display('assets/js/snow.min.js') ?>">
        </script>
        <script>
          $(document).ready(function() {
            $.fn.snow({
              flakeColor: '#ffffff'
            });
          });
        </script>
        <style>
          .top-page-title_parallax {
            z-index: -1;
          }

          .top-page-title_overlay {
            z-index: 1;
          }
        </style>
        <?php endif ?>

        <?php if (isset($validator)) : ?>
        <script
          src="<?php URL::display('assets/js/validator.min.js') ?>">
        </script>
        <?php endif ?>


        <?php
      // Dashboard Script
      if (isset($dashboard) && ($dashboard)) { ?>


        <script
          src="<?php URL::display('assets/js/nicescroll/jquery.nicescroll.min.js') ?>">
        </script>

        <script>
          $(function() {


            /*$('.dropdown-menu').click(function(event){
              event.stopPropagation();
            });*/




            /********************************
            Toggle Aside Menu
            ********************************/

            $(document).on('click', '.navbar-toggle', function() {

              $('aside.left-panel').toggleClass('collapsed');

            });





            /********************************
            Aside Navigation Menu
            ********************************/

            $("aside.left-panel nav.navigation > ul > li:has(ul) > a").click(function() {

              if ($("aside.left-panel").hasClass('collapsed') == false || $(window).width() < 768) {



                $("aside.left-panel nav.navigation > ul > li > ul").slideUp(300);
                $("aside.left-panel nav.navigation > ul > li").removeClass('active');

                if (!$(this).next().is(":visible")) {

                  $(this).next().slideToggle(300, function() {
                    $("aside.left-panel:not(.collapsed)").getNiceScroll().resize();
                  });
                  $(this).closest('li').addClass('active');
                }

                return false;

              }

            });



            /********************************
            NanoScroll - fancy scroll bar
            ********************************/
            if ($.isFunction($.fn.niceScroll)) {
              $(".nicescroll").niceScroll({

                cursorcolor: '#9d9ea5',
                cursorborderradius: '0px'

              });

            }



            if ($.isFunction($.fn.niceScroll)) {
              $(".niceScroll").niceScroll({

                cursorcolor: '#9d9ea5',
                cursorborderradius: '0px'
              });
            }
            if ($.isFunction($.fn.niceScroll)) {
              $("aside.left-panel:not(.collapsed)").niceScroll({
                cursorcolor: '#8e909a',
                cursorborder: '0px solid #fff',
                cursoropacitymax: '0.5',
                cursorborderradius: '0px'
              });
            }


            /********************************
            Scroll To Top
            ********************************/
            $('.scrollToTop').click(function() {
              $('html, body').animate({
                scrollTop: 0
              }, 800);
              return false;
            });




          });
        </script>
        <?php } ?>


        <script>
          new WOW({
            offset: 100
          }).init();
          // data-wow-duration, data-wow-delay, data-wow-iteration, data-wow-offset
        </script>

        <?php
      // Google Map
      if (isset($map) && (!empty($map))) { ?>
        <script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmvSOAo4Wm5iHjlSCKvoNfvfOOg63wSag&sensor=false">
        </script><!-- google maps -->
        <script text="text/javascript">
          <?php include(INCLUDE_DIR.'map-location.php') ?>
        </script> <!-- map script -->
        <?php } ?>


        <?php
      // Date Time Picker
      if (isset($datetimepicker) && ($datetimepicker)) { ?>
        <!-- Date Time Picker -->
        <script
          src="<?php URL::display('assets/js/moment/moment.min.js') ?>">
        </script>
        <script
          src="<?php URL::display('assets/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') ?>">
        </script>
        <?php } ?>

        <?php
      // Lightbox
      if (isset($lightbox) && ($lightbox)) { ?>

        <link
          href="<?php echo BASE_URL ?>assets/js/lightbox/fancybox/jquery.fancybox.css"
          rel="stylesheet" media="screen">
        <script
          src="<?php URL::display('assets/js/lightbox/fancybox/jquery.fancybox.pack.js') ?>">
        </script>
        <?php } ?>

        <?php
      // Team Filter
      if (isset($filterable) && ($filterable)) { ?>
        <!-- Date Time Picker -->
        <script
          src="<?php URL::display('assets/js/plugins/filterable/filterable.pack.js') ?>">
        </script>
        <?php } ?>


        <script
          src="<?php URL::display('assets/js/plugins.js') ?>">
        </script>
        <script
          src="<?php URL::display('assets/js/main.js') ?>">
        </script>


        <?php
      // Editor
      if (isset($editor) && ($editor)) {
          include(INCLUDE_DIR.'froala.php');
      }
    ?>


        <?php if (!$local) { //if viewing from localhost, dont run this?>
        <script>
          (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
              (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
              m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
          })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

          ga('create', 'UA-89636421-1', 'auto');
          ga('send', 'pageview');
        </script>
        <?php } ?>

        </body>

        </html>
