<?php
include 'headers.php';
include "../includes/connect.php";

if(isset($_GET['view'])){
 
    $id = $_GET['view'];

    
    $sql= "SELECT p.product_id,p.name , p.quantity, p.price , p.description , p.image, p.cat_id ,c.name AS category_name FROM products p,category c
WHERE product_id = $id AND p.cat_id= c.category_id ";
    $result =  mysqli_query($conn,$sql);
    
            if(mysqli_num_rows($result) == 1){
             
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $name = $row["name"];
                $price = $row["price"];
                $url = $row["image"];
            }      
        }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shiko Rekordet</title>
</head>
<body>


<div class="container-fluid">
  <div class="row d-flex justify-content-center mb-3 mt-4">
    <?php include 'sidebars.php';?>

     <div class="col-lg-7 col-12">
        <h4 class="mb-4">Te dhena te detajuara mbi produktin</h4>
        <div class="row">

             <div class="col-lg-6"> 
                <img class="img-fluid " src="uploaded_img/<?php echo $row['image']; ?>" alt="">
            </div>

            <div class="col-lg-6">
                    <p class="lead"><span><?php echo   $row['name'] ; ?></span></p>
                    <p><span class="text-muted">Kategoria:</span> <?php echo  $row['category_name'] ; ?></p>
                    <p><span class="text-muted">Sasia:</span> <?php echo $row['quantity'] ; ?> cope</p>
                    <p><span class="text-muted">Cmimi:</span><?php echo  $row['price'] ; ?> $ </p>
                    <p class="lead font-weight-bold">Description</p>
                    <p><?php echo $row['description'] ; ?></p>
                     <a href="products.php" class="btn btn-secondary px-5">Kthehu</a>
            </div>

        </div> 
    </div> 
</div>   
</div>

<script src="../../js/bootstrap.bundle.min.js"></script> 

</body>
</html>