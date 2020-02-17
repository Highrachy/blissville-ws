<?php

class User {

  public static $login_table = "users";

  private static $dashboard = "admin/dashboard.php";
  private static $login_page = "admin/";

  public static function is_logged_in(){
    if (Session::get('id'))
      return true;
    else return false;
  }

  public static function dashboard(){
    return self::$dashboard;
  }
  public static function login_page(){
    return self::$login_page;
  }

  public static function redirect_invalid_admin() {
    // Check if the person is not the admin
    $destination = '?action=no-access';
    $redirect_to_URL = URL::current_page();

    $id = Session::get('id');
    //if the id is not set
    //redirect the user back to login page
    if (empty($id)){
      $url =  self::$login_page.$destination.'&continue='.$redirect_to_URL; // Define the URL.
      Url::redirect($url);
    }

  } // End of redirect_invalid_admin() function.

  // public static function get_accessed_page(){
  //   $destination = '?err=1';
  //   // Get protocol of webpage http or https
  //   $current_page_URL =(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
  //   // get the current website name and requested folder path
  //   $current_page_URL .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  //   //check if the $_SESSION client_type is set
  //   $accessed_page =  $destination.'&continue='.$current_page_URL; // Define the URL.
  //   return $accessed_page;
  // }

  public static function login(){

    global $db;
  
    $email = Form::assign('email','email','Invalid email address');
    $password = Form::assign('password','req','Enter your password'); 

    if (!Form::get_errors()){
      $query = "SELECT * FROM ".self::$login_table." WHERE (email ='$email' AND password ='"  . self::_hash_password($password) .  "')";

      $row = $db->fetch_first_row($query);
      if ($db->total_affected_rows() == 1){

        //Get the contact name
        Session::set('name',$row['name']);
        Session::set('id',$row['id']);

        return true;
      }
    }

    # -- Failed
    return false;

  }  
  
  public static function next_page(){
      //Check if the user has tried to access a page before
      if (isset($_GET['continue'])){
        return $_GET['continue'];
      } else {
        return self::$dashboard;
      }

  }

  private static function _hash_password($password){
    return md5($password);
  }



}
