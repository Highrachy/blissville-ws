<?php
include('config.php');

include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php');
# -- Page Configuration ########################################################################################
$title = "contact-us";
$page_title = "Contact Us";
$subheader = false;
$register_footer = false;
$page_desc = "Get in Touch with Us";

$map['latitude'] = 6.428917;
$map['longitude'] = 3.429756;
$map['name'] = "Our Office";


# -- Send Contact us Message ###################################################################################

//Check if the user has posted the result
// if ($_SERVER['REQUEST_METHOD'] == 'POST')
//   include(INCLUDE_DIR.'contactus.inc.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  // Check for the Users Name
  if (preg_match ('/^[A-Z0-9 \'.-]{2,60}$/i', $_POST['name'])) {
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

  // Check for the subject
  if (!(empty($_POST['subject']))) {
    $data['subject'] = $_POST['subject'];
  } else {
    $errors[] = 'Please enter your subject';
  }

  // Check for the message
  if (!(empty($_POST['message']))) {
    $data['message'] = $_POST['message'];
  } else {
    $errors[] = 'Please enter your message';
  }

  //Optional Fields

  # -- Phone Number
  if (isset($_POST['phone']) && (!empty($_POST['phone'])))
    $data['phone'] = Form::validate('phone', array('minlen=7'=>'Please enter a valid Phone Number'));
  else $data['phone'] = "";


  if (empty($errors)){
    extract($data);

    $page_name = "Contact Us Page";
    // $ourEmail = "nnamdi@highrachy.com";
    // $ourName = "Highrachy Investment and Technology";


    //Compulsory Variables
    //1. $name   2. $email  3.subject   4. $message
    // $message = $comments; Message is alreadey set in the code

    $details = "";

    $details .= "<strong>Name :</strong> ".$name. "<br>";
    $details .= "<strong>Email  :</strong> ".$email. "<br>";
    $details .= "<strong>Phone  :</strong> ".$phone . "<br>";

    $subject = "Message from $name ($page_name)";
    //End of Compulsory

    if (Email::send_mail($email,$subject,$message,$details)){
      $autoreply = Email::autoreply($email);
      $success = "Your message has been successfully received. We will get back to you within 24 hours";
      $_POST = array();
    }


  }
  // End empty errors

}// End $_POST errors

include('inc/header.php');
?>


    <section class="map-section">
      <div id="map-location" style="height: 300px; width: 100%;"></div>
    </section>

    <section id="send-us-message" class="bg-gray">
      <div class="container">

          <div class="row">
              <div class="col-md-3">

                  <br><br>

                  <div class="row">

                      <address class="col-sm-6 col-md-12">
                          <strong>Office Address:</strong><br>
                          5th Floor, Ibukun House,<br>
                          No.70 Adetokunbo Ademola Street,<br>
                          Victoria Island,<br>
                            Lagos.<br>
                      </address>
                  </div>

                  <div class="row">

                      <div class="col-sm-6 col-sm-push-6 col-md-push-0 col-md-12">
                          <abbr title="Phone Number"><strong>Phone:</strong></abbr> 0802-833-7440, 0803-5053-278, 081-8125-2512<br>
                          <abbr title="Email Address"><strong>Email:</strong></abbr> info@highrachy.com

                          <p>&nbsp;</p>
                      </div>

                      <div class="col-sm-6  col-sm-pull-6 col-md-pull-0 col-md-12 mb-50">
                          <p>
                            <strong>Blissville is an initiative of </strong>
                            <br><img src="<?php URL::display('assets/img/highrachy_logo.png') ?>" alt="Highrachy Logo" height="45"><br>
                          </p>

                          <div class="clearfix">

                              <a href="https://www.facebook.com/Blissville-208150349675171/" class="social-icon si-facebook">
                                  <i class="fa fa-facebook"></i>
                                  <i class="fa fa-facebook"></i>
                              </a>

                              <a href="https://twitter.com/Highrachy" class="social-icon si-twitter">
                                  <i class="fa fa-twitter"></i>
                                  <i class="fa fa-twitter"></i>
                              </a>

                              <a href="https://www.linkedin.com/company-beta/18054260/" class="social-icon si-linkedin">
                                  <i class="fa fa-linkedin"></i>
                                  <i class="fa fa-linkedin"></i>
                              </a>


                              <!-- <a href="#" class="social-icon si-youtube">
                                  <i class="fa fa-youtube"></i>
                                  <i class="fa fa-youtube"></i>
                              </a> -->
                          </div>
                      </div>

                  </div>

              </div>


              <div class="col-md-9">

                  <?php Alert::display(); //Necessary for get_action to work effectively ?>
                  <div class="normal-header">
                      <br>
                      <h3><span>Send Us</span> a Message</h3>
                  </div>
                  <div class="row">
                        <form action="#" method="post" enctype="multipart/form-data">


                          <div class="form-group col-sm-6">
                              <label class="control-label">Name <span class="mandatory">*</span></label>
                              <div>
                                  <?php Text('name','','class="form-control" placeholder="Enter your name here"') ?>
                                  <?php show_errors('name') ?>
                              </div>
                          </div>
                          <div class="form-group col-sm-6">
                              <label class="control-label">Email <span class="mandatory">*</span></label>
                              <div>
                              <?php Email('email','','class="form-control" placeholder="Enter your Email Address"') ?>
                              <?php show_errors('name') ?>
                              </div>
                          </div>
                          <div class="form-group col-sm-6">
                              <label class="control-label">Phone <span class="mandatory">*</span></label>
                              <div>
                                  <?php Text('phone','','class="form-control" placeholder="Enter your Phone No"') ?>
                                  <?php show_errors('phone') ?>
                              </div>
                          </div>
                          <div class="form-group col-sm-6">
                              <label class="control-label">Subject<span class="mandatory">*</span></label>
                              <div>
                                  <?php Text('subject','','class="form-control" placeholder="Enter your Subject here"') ?>
                                  <?php show_errors('subject') ?>
                              </div>
                          </div>
                          <div class="form-group col-sm-12">
                              <label class="control-label">Message <span class="mandatory">*</span></label>
                              <div>
                                  <?php Textarea('message','','class="form-control" placeholder="Enter your Message"',8) ?>
                                  <?php show_errors('message') ?>
                              </div>
                          </div>
                          <div class="form-group col-sm-12">
                              <div>
                                  <button type="submit" class="btn btn-primary">Send Message</button>&nbsp;&nbsp;
                                  <button type="reset" class="btn btn-default">Clear</button>
                              </div>
                          </div>
                      </form>
                  </div>
                  <!-- /.row-->

              </div>
          </div>
      </div>
    </section>
<?php include('inc/footer.php');
