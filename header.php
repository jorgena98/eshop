<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Decor</title>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/stilizimi1.css">
  <link rel="stylesheet" href="css/stilizim.css">

  <script src="js/bootstrap.bundle.min.js"></script>

 
</head>

<body>
  <?php include "login/includes/connect.php"; 
      $sql1="SELECT * FROM category";?>
  <nav class="navbar navbar-expand-lg w-100 position-absolute position-fixed top-0" id="navbar" >
<div class="container-fluid " >
  <a class="navbar-brand" href="index.php">  <img src="images/logo.svg"></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse navbar-light " id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-right">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="shop.php" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">SHOP</a>
          <ul class="dropdown-menu tekstiL" aria-labelledby="navbarDropdown">
          <?php
            if($result2 = mysqli_query($conn, $sql1)){
            if(mysqli_num_rows($result2) > 0)
            echo' <li><a class="dropdown-item" href="shop.php" >Te gjitha produktet</a></li>
            <div class="dropdown-divider"></div>' ;
            while($row = mysqli_fetch_array($result2)){
                 echo '<li><a class="dropdown-item" href="kategoria.php?cat='. $row['category_id'] . '" >
                    '. $row['name'] . '</a></li>';  }} 
                    ?>
       </ul>
      </li>
    
      <li class="nav-item">
        <a class="nav-link" href="about.php">ABOUT US</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contactUs.php">CONTACT US</a>
      </li>
      <li>
    </ul>

    <ul class="navbar-nav d-flex flex-row me-1">
   
    <li class="nav-item me-3 me-lg-0">
         <a class="nav-link" href="login/index.php"><i class="fas fa-user mx-1"></i> Login</a>
    </li> 
    <li class="nav-item me-3 me-lg-0">
        <a class="nav-link" href="cart.php">
        <?php 
        if (isset($_SESSION['cart_items']) && (count($_SESSION['cart_items'])> 0)) { 
         echo'<span class="badge bg-secondary">'.count($_SESSION['cart_items']).'</span>';
          }
         ?>
        <i class="fa-solid fa-cart-shopping mx-1"></i>
        Cart
      </a>

    </li>


    </ul>
  </div>
</div>
</nav>

</body>
</html>