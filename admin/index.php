<?php
include('../config.php'); 

// Check if user is logged in
if (User::is_logged_in()){
  URL::redirect(User::dashboard());
}


if (Form::is_posted()){

  if (User::login()){
    URL::redirect(User::dashboard());
  } else {
    $errors['error'] = "Invalid Username or Password";
  }
}


# -- Page Configuration ########################################################################################
$title = "Login Page";
$page_title = "Login";

$register_footer = false;

//Check if the user clicks on the submit button
include(SERVER_DIR.'lib/functions/login.inc.php'); 


if (!isset($errors)){ //No error exists
  
  
  if (isset($_GET['err']) && ($_GET['err'] = 1)){
      $errors['error'] = 'Kindly login to access page';
  }
  else if (isset($_GET['logout']) && ($_GET['logout'] = 1)){
      $info = 'You have been successfully logged out';
  }

}

include(SERVER_DIR.'inc/header.php');
?>


    <section class="inner-page">
      <div class="container">

        <div class="row">
            <div class="col-xs-12">

              <div class="row">
                <div class="center-block col-sm-6 col-md-5 col-xs-12">
               

                  <div class="log-in">
                    
                    <h3>Login</h3>
                    <div class="clearfix"></div>
                    <form id="login_form" action="#" role="form" method="post">
                      <div class="input-group">
                        <span class="input-group-addon"><label for="email" class="control-label icon-label"><i class="fa fa-user"></i></label></span>
                        <?php Form::email('email','',array('class' => "form-control",  'placeholder' => "Your Email")) ?>
                      </div>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <?php Form::password('password','',array('class' => "form-control",  'placeholder' => 'Password' )) ?>
                      </div>
                      <?php Alert::display() ?>
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="reset" class="btn btn-gray">Reset</button>
                    </form>
                  </div>
                </div>
              </div>
           
            </div>
        </div>


      </div>
      <!-- /container -->  
    </section>

<?php
  include(SERVER_DIR.'inc/footer.php'); 
?>

