<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>

<body>
  <div class="header1 position-relative">
    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/silder1.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/slider2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="images/slider3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- Fund carousel -->
  </div>

<?php
require_once "login/includes/connect.php";
$sql="SELECT * FROM category";
?>

<!--section 2  carousel me multiple items-->
  <div class="section2">
    <div class="container text-center my-lg-5 mt-4">
      <div class="row d-flex justify-content-center">
        <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" role="listbox">
            
            <?php 
              if($result1 = mysqli_query($conn, $sql)){
                  if(mysqli_num_rows($result1) > 0)
                  { while($row = mysqli_fetch_array($result1)){
                    $myData[] = $row;}

                    for($i = 0; $i <count($myData); $i++) {
                        if($i == 0){
                          echo'<div class="carousel-item active">
                                  <div class="col-lg-2 col-md-4 col-6">
                                    <div class="card">
                                    <a href="kategoria.php?cat='.$myData[$i]['category_id'] . '">
                                        <div class="card-img-top"> <img src="images/icons/'.  $myData[$i]['image'] .' " class="img-fluid"></div>
                                          <div class="card-body">
                                            <p class="card-text">'.  $myData[$i]['name'] .'</p>
                                          </div>
                                    </a>
                                    </div>
                                  </div>
                                </div>';}
                        else{
                          echo'  <div class="carousel-item ">
                                  <div class="col-lg-2 col-md-4 col-6">
                                    <div class="card">
                                    <a href="kategoria.php?cat='.$myData[$i]['category_id'] . '">
                                        <div class="card-img-top"> <img src="images/icons/'.  $myData[$i]['image'] .' " class="img-fluid"> </div>
                                        <div class="card-body">
                                          <p class="card-text">'.  $myData[$i]['name'] .'</p>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                </div>'; }}}} ?>
          </div>
          <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button"
            data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span></a>
          <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button"
            data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span></a>
        </div>
      </div>
    </div>
  </div>



  <!--section 3 cards me kategorite e produkteve-->
<div class="container section3 my-lg-5">
  <div class="d-flex justify-content-center">
    <p id="textC">New Arrivals</p>
  </div>

    <div class="row mb-lg-3 mb-1">
  
      <?php

      if($result1 = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result1) > 0)
      { while($row = mysqli_fetch_array($result1)){
        echo' <div class="col-6 col-md-6 col-lg-4 my-lg-3 my-2">
              <div class="card">
                <img class="card-img" src="images/section3/'. $row['imageS3'] . '">
                <div class="card-img-overlay text-dark d-flex flex-column justify-content-end">
                  <a class="btn btn-lg btn-sm btn-light  btn-block" href="kategoria.php?cat='. $row['category_id'] . '" >'. $row['name'] .'</a>
                </div>
              </div>
            </div>'; }}} ?>
    </div>

    <div class="d-flex justify-content-center">
      <a class="btn btn-lg btn-sm btn-light  btn-block" href="shop.php">View More</a>
    </div>
</div>

<!--section 4 plus-->
  <div class="section4 my-lg-5 my-3">
    <div class="box">
      <div class="container">
        <div class="row d-flex  justify-content-center">

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="box-part text-center">
              <img src="images/icons8-tools-32.png">
              <div class="title">
                <h4>Free installation</h4>
              </div>
              <div class="text">
                <span>Lorem ipsum dolor sit amet </span>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="box-part text-center">
              <img src="images/icons8-in-transit-32.png">
              <div class="title">
                <h4>Free shipping</h4>
              </div>
              <div class="text">
                <span>Lorem ipsum dolor sit amet.</span>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="box-part text-center">
              <img src="images/icons8-expensive-price-32.png">
              <div class="title">
                <h4>Easy payment</h4>
              </div>
              <div class="text">
                <span>Lorem ipsum dolor sit amet. </span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  
  <!--section 5 Trending now-->
  <div class="section5">

    <div class="d-flex justify-content-center">
      <p id="textC">Trending now</p>
    </div>

    <?php
    $nr=36;
    $sql2="SELECT * FROM products limit $nr";
    ?>
    <div class="container mt-3 text-center ">
      <div class="row d-flex justify-content-evenly">
            <?php 
              if($result2 = mysqli_query($conn, $sql2)){
                  if(mysqli_num_rows($result2) > 0)
                  { while($row2 = mysqli_fetch_array($result2)){
                    $myData2[] = $row2;}

                    for($i = 0; $i <count($myData2); $i=$i+6) {                  
                          echo'<div class="col-lg-2 col-md-4 col-6">
                                <div class="card">
                                <a href="product.php?product='.$myData2[$i]['product_id'] . '">
                                  <div class="card-img-top"> <img src="login/admin/uploaded_img/'.  $myData2[$i]['image'] .' " class="img-fluid"> </div>
                                  <div class="card-body">
                                    <p class="card-text">'.  $myData2[$i]['name'] .'</p>
                                  </div>
                                  </a>
                                </div>
                              </div> '; }} } ?> 
      </div>
    </div>
  </div>
</div>




<!--section 6 parallax-->
  <div class="section6 my-lg-5">
    <div class="parallax">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
          <div class="card">
            <div class="text-center">
              <p id="tekstS">Special offers to our subcribers</p>
              <h3>Ten percent discount for our client</h3>
              <p id="tekstS">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae architecto
                impedit, eaque reiciendis nemo veritatis cumque</p>
              <div class="mx-5">

              <?php include 'subscribe.php';?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'footer.php' ?>
 
<script src="js/carousel.js"></script>

</body>

</html>