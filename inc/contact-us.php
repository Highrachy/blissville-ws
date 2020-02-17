<?php 
include('config.php'); 
require_once(SERVER_DIR.'lib/functions/database.class.php');
$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

include(SERVER_DIR.'lib/functions/validation.php');
include(SERVER_DIR.'lib/functions/form.php'); 
# -- Page Configuration ########################################################################################
$title = "contact-us";
$page_title = "Contact Us";
$subheader = false;
$register_footer = false;
$page_desc = "Get in Touch with Us";
$breadcrumb = array();

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
    $data['phone'] = assign('phone', 'minlen=7','Please enter a valid Phone Number');
  else $data['phone'] = "";


  if (empty($errors)){
    extract($data);

    $page_name = "Contact Us Page";
    $ourEmail = "nnamdi@highrachy.com";
    $ourName = "Highrachy Investment and Technology";

    
    //Compulsory Variables
    //1. $name   2. $email  3.subject   4. $message
    // $message = $comments; Message is alreadey set in the code

    $details = "";

    $details .= "<br><br><strong>Name :</strong> ".$name. "<br>";
    $details .= "<strong>Email  :</strong> ".$email. "<br>";
    $details .= "<strong>Phone  :</strong> ".$phone . "<br>";

    $subject = "Message from $name ($page_name)";
    //End of Compulsory 


      $style =  '<style>
            </style>
          ';

      $html = '<p style="margin: 0;padding: 0;font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">'.$message.'</p>
            
            <!-- Callout Panel -->
            <p class="callout" style="margin: 0;font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom: 15px;font-weight: normal;font-size: 14px;line-height: 1.6;">
             '.$details.'
            </p><!-- /Callout Panel -->        
          ';
          
      
      // Build the mail
      //=====================================
      $custom_headers = "";
      $custom_headers .= "From: info@highrachy.com\r\n";
      $custom_headers .= "Reply-To: {$email}\r\n";
      $custom_headers .= "Return-Path: {$email} \r\n";


      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=utf-8\r\n";
      $headers .= $custom_headers;

      $message = $style.$html;


      //=====================================
      // End of Building the mail
      //=====================================

      @mail($ourEmail, $subject, $message, $headers);

      $success = "Your message has been successfully received. We will get back to you as soon as possible";      
      $_POST = array();

    }

  }
  // End empty errors

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

                    <address>
                        <strong>Office Address 1:</strong><br>
                        5th Floor, Ibukun House,<br>
                        No.70 Adetokunbo Ademola Street,<br>
                        Victoria Island,<br>
                         Lagos.<br>
                    </address>
                    
                    <address>
                        <strong>Office Address 2:</strong><br>
                        Suite 10C, Yomade Complex,<br>
                        Lekki-Epe Expressway,<br>
                        Awoyaya, Lagos.
                    </address>
                    
                    <abbr title="Phone Number"><strong>Phone:</strong></abbr> 0802-833-7440<br>
                    <abbr title="Email Address"><strong>Email:</strong></abbr> info@highrachy.com
                        
                    <p>&nbsp;</p>

                    <div class="clearfix">
                        
                        <a href="#" class="social-icon si-facebook">
                            <i class="fa fa-facebook"></i>
                            <i class="fa fa-facebook"></i>
                        </a>
                    
                        <a href="#" class="social-icon si-twitter">
                            <i class="fa fa-twitter"></i>
                            <i class="fa fa-twitter"></i>
                        </a>
                    
                        <a href="#" class="social-icon si-linkedin">
                            <i class="fa fa-linkedin"></i>
                            <i class="fa fa-linkedin"></i>
                        </a>
                    
                    
                        <a href="#" class="social-icon si-youtube">
                            <i class="fa fa-youtube"></i>
                            <i class="fa fa-youtube"></i>
                        </a>
                    </div>

                </div>
                <div class="col-md-9">

                    <?php display_alert(); //Necessary for get_action to work effectively ?>
                    <div class="normal-header">
                        <br>
                        <h3><span>Send Us</span> a Message</h3>
                    </div>
                    <div class="row">
                          <form action="#" method="post" enctype="multipart/form-data">
                            
                            
                            <div class="form-group col-md-4 col-sm-6">
                                <label class="control-label">Name <span class="mandatory">*</span></label>
                                <div>
                                    <?php Text('name','','class="form-control" placeholder="Enter your name here"') ?>
                                    <?php show_errors('name') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label class="control-label">Email <span class="mandatory">*</span></label>
                                <div>
                                <?php Email('email','','class="form-control" placeholder="Enter your Email Address"') ?>
                                <?php show_errors('name') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label class="control-label">Phone <span class="mandatory">*</span></label>
                                <div>
                                    <?php Text('phone','','class="form-control" placeholder="Enter your Phone No"') ?>
                                    <?php show_errors('phone') ?>
                                </div>
                            </div>
                            <div class="form-group  col-sm-12">
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