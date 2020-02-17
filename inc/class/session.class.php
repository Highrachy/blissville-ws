<?php

class Session {

  private static $session_name = "blissville";

  public static function get_name($field){
    return self::$session_name . "_" . $field;
  }

  public static function get($field){
    $name = self::get_name($field);
    if (!empty($_SESSION[$name]))
      return $_SESSION[$name];
    else return;
  }

  public static function set($field, $value){
    $name = self::get_name($field);
    $_SESSION[$name] = $value;
  }

}
