<?php

class Alert {

  #-############################################
  # Alert for Errors
  #-############################################
  public static function errors($message){

    if (is_array($message)){
      $error = "<ul>";
      foreach($message as $value){
        $error .= "<li>$value</li>";
      }
      $error .= "</ul>";
    } else {
      $error = $message;
    }

    echo  '<div class="alert alert-danger alert-dismissable">
            <strong>The following errors occurred:</strong><br>'.$error.'</div>';
      return;

  }

  #-############################################
	# Alert to Display Error
	#-############################################
  public static function display_error(){

    global $errors;

    if (isset($errors['error']) && !(empty($errors['error']))){
      $error = $errors['error'];
      return self::errors($error);
    }
    
    return;

  }

  #-############################################
	# Success Alert
	#-############################################
  public static function success($message){

    if (!empty($message)){

      $success = $message;

  		echo	'<div class="alert alert-success alert-dismissable">
  					<i class="fa fa-check-circle"></i> '. $success . '
  				</div> ';
    }
    return;

  }

  #-############################################
	# Info Alert
	#-############################################
  public static function info($message){

    if (!empty($message)){

      $info = $message;

  		echo	'<div class="alert alert-info alert-dismissable">
  					<i class="fa fa-info-circle"></i> '. $info . '
  				</div> ';
    }
    return;

  }

  #-############################################
	# Warning
	#-############################################
  public static function warning($message){

    if (!empty($message)){

      $warning = $message;
      echo	'<div class="alert alert-warning alert-dismissable">
  					<i class="fa fa-warning"></i> '. $warning. '
  				</div> ';
    }
    return;

  }

  #-############################################
  # Display Necessary Alert
  #-############################################

  public static function display($action = "action"){

    global $errors, $success, $info, $warning, $error;

    $all_errors = true;

    #-############################################
    # Generate Action from the list below
    #-############################################
    if (isset($_GET['action']) && (!empty($_GET['action']))){

      $action_url = $_GET['action'];

      //if action is set, dont display all errors
      $all_errors = false;

      if ($action_url == 'add') $success = "Your $action has been successfully added";
      else if ($action_url == 'update') $success = "Your $action has been successfully updated";
      else if ($action_url == 'delete') $info = "Your $action has been successfully deleted";
      else if ($action_url == 'error') $error = "Invalid request";
      else if ($action_url == 'no-access') $error = "You need to login to access page";
      else if ($action_url == 'logout') $info = "You have successfully logged out";
      else if ($action_url == 'pause') $info = "Your $action has been successfully paused";
      else if ($action_url == 'resume') $info = "Your $action has been successfully resumed";
      else if ($action_url == 'invalid') $warning = "The selected $action is invalid";
      else if ($action_url == 'not-found') $warning = "The $action cannot be found in the database";
      else if ($action_url == 'save') $success = "Your campaign has been successfully saved";
      else if ($action_url == 'mail-sent') $info = "Your campaign has been successfully sent";
      else if ($action_url == 'mail-scheduled') $info = "Your campaign has been successfully scheduled";
    }

    //Errors All has the highest priority
    // Display All Errors
    if (!empty($errors)){
    	if ($all_errors){
        self::errors($errors);
    	} else {
        self::errors($errors['error']);
      }
    }

    // Display the Error saved in the Error Variable
    else if (!empty($error)){
      self::errors($error);
    }

    // Display the Warning saved in the Warning Variable
    else if (!empty($warning)){
      self::warning($warning);
    }

    // Display the info saved in the info Variable
    else if (!empty($info)){
      self::info($info);
    }

    // Display the success saved in the success Variable
    else if (!empty($success)){
      self::success($success);
    }

  }

}
