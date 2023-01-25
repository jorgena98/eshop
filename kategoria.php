<?php include 'header.php'; ?>
<?php

include "login/includes/connect.php";

if(isset($_GET['cat'])){
 
    $id = $_GET['cat'];

    $sql1="SELECT * FROM category";
    $sql= "SELECT p.product_id,p.name , p.quantity, p.price , p.description , p.image, p.cat_id ,c.name AS category_name FROM products p,category c
WHERE category_id = $id AND p.cat_id= c.category_id ";
           
        }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/shop.css">
   
</head>
<body>


<div class="container-fluid aboutT">
<div>
            <nav class="pt-5" aria-label="breadcrumb">
              <ol class="breadcrumb pt-4 d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                 <?php 
                     $sql4="SELECT * FROM category where category_id=$id ";
                    if($result1 = mysqli_query($conn, $sql4)){
                        if(mysqli_num_rows($result1) > 0)
                        { while($row = mysqli_fetch_array($result1)){ ?>

                       <li class="breadcrumb-item active" aria-current="page">
                           
                            <?php
                           echo $row['name']  ;
                          
                            }}}   ?>
                     </a>
                </li>
              </ol>
            </nav>
        </div>
</div>

<div class="container mt-4">
 <div class="row">

  <div class="col-lg-2 col-3 mx-lg-auto cat" >          
  <h4><a href="shop.php">Categories</a></h4>

    <?php
        if($result2 = mysqli_query($conn, $sql1)){
        if(mysqli_num_rows($result2) > 0)
        echo'<ul class="list-group list-group-flush">'; 
        { while($row = mysqli_fetch_array($result2)){
                echo '<li class="list-group-item">
                <a href="kategoria.php?cat='. $row['category_id'] . '" >
                '. $row['name'] . '</a></li>';     
        }
        echo '</ul>';
        }} ?>
</div>

<div class="col-lg-9 col-9 px-lg-2 mx-lg-auto">
<div class="row  d-flex justify-content-center">

<?php

if($result1 = mysqli_query($conn, $sql)){
if(mysqli_num_rows($result1) > 0)
{ while($row = mysqli_fetch_array($result1)){
    echo"<div class='col-lg-4  col-6 gy-3'>
        <div class='card'>
        <img src='login/admin/uploaded_img/". $row['image'] . "' />
         <div class='card-body'>
             <h5 class='card-title'>" . $row['name'] . "</h5>
              <p class='card-text'>". $row['price'] ." $</p>
          </div>";?>
         <a href="product.php?product=<?php echo $row['product_id']; ?>" class="btn">View</a>
       </div>
    </div>
 <?php  }
}} ?>

</div>

</div>
</div>
</div>

<?php include 'footer.php';?>

    <script src="js/scroll.js"></script>
    <script src="js/index.js"></script>

</body>
</html>