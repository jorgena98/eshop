<?php
include 'login/includes/functions.php';
include 'login/includes/connect.php';
$ufunc = new UserFunctions;
$chss = new Login;
$chss->SessionCheck();
if (!isset($_SESSION['login']) || $_SESSION['role'] != "0") {
  header("Location:login/includes/logout.php");
}
?>
