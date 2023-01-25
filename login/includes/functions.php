<?php
class Login {
  public function LoginSystem() {
    session_start(); 
    $error = ''; 
    if (!isset($_POST['submit'])) {
      if (empty($_POST['login']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
      }
    } else {
      include 'connect.php';
      $username = $_POST['login'];
      $password = md5($_POST['password']);
      $query = "SELECT login, password FROM users WHERE login=? AND password=? LIMIT 1";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $stmt->bind_result($username, $password);
      $stmt->store_result();
      if($stmt->fetch()) { 
        $_SESSION['login'] = $username; 
      }
      mysqli_close($conn); 
    }
      
  }

  public function SessionCheck() {
    global $conn;
    include_once 'connect.php';
    session_start();
    $user_check = $_SESSION['login'];
    $query = "SELECT * FROM users WHERE login = '$user_check'";
    $ses_sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($ses_sql);
    $_SESSION["id"] = $row["id"];
    $_SESSION["name"] = $row["name"];
    $_SESSION["role"] = $row["role"];
  }
  public function UserType() {
    if ($_SESSION["role"] == 1) {
      header("Location:../admin/orders.php");
    }
   else {
    header("Location:../index.php");
   }
  }
}

class UserFunctions{
  public function UserName() {
    $username = $_SESSION["name"];
    echo $username;
  }
}
