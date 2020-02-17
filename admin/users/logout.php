<?php
require ('../../config.php');
// Destroy the session:
$_SESSION = array(); // Destroy the variables.
session_destroy(); // Destroy the session itself.
setcookie(session_name(), '', time()-300); // Destroy the cookie.

URL::redirect(User::login_page().'?logout=1');
?>