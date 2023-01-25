<?php
include 'header.php'; 

require_once('include/config.php');    
require_once('include/helpers.php'); 
require_once "login/includes/connect.php";

if(isset($_GET['page'])){
  $page=$_GET['page'];
}

else{$page=1;}
$num_per_page=6;
$start_from=($page-1)*$num_per_page;

$query="SELECT * FROM products limit $start_from,$num_per_page";
$result=mysqli_query($conn,$query);

$sql="SELECT * FROM category";

    $handle = $db->prepare($query);
    $handle->execute();
    $getAllProducts = $handle->fetchAll(PDO::FETCH_ASSOC);

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
                <li class="breadcrumb-item active" aria-current="page">Shop</li>
              </ol>
            </nav>
        </div>
</div>


<div class="container mt-lg-5 mt-4" >

 <div class="row mx-auto">

<div class="col-lg-2 col-3 mx-lg-auto cat " >          
    <h4><a href="shop.php">Categories</a></h4>

    <?php
        if($result2 = mysqli_query($conn, $sql)){
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
       
<div class="col-lg-9  col-9 px-lg-2 mx-lg-auto ">
<div class="row  d-flex justify-content-center">
<?php

foreach($getAllProducts as $product)
{   echo'<div class="col-lg-4  col-6 gy-3">'; 
        echo "<div class='card'>";
          echo "<img src='login/admin/uploaded_img/". $product['image'] . "' />";
          echo "<div class='card-body'>";
             echo "<h5 class='card-title'>" . $product['name'] . "</h5>";
             echo" <p class='card-text'>". $product['price'] ." $</p>";
          echo "</div>";?>
         <a href="product.php?product=<?php echo $product['product_id']; ?>" class="btn btn-lg btn-sm ">View</a>
        </div>
   </div>
<?php 
} ?>

</div>

<div class="d-flex justify-content-end mt-3 me-3">
<?php 
    $pr_query="SELECT * FROM products";
    $pr_result=mysqli_query($conn,$pr_query);
    $total_record=mysqli_num_rows($pr_result); 

    $total_page=ceil($total_record/$num_per_page);
    echo "";
    if($page>1 ){
        echo"<a href='shop.php?page=".($page-1)."' class='btn btn-outline-secondary'>Previous</a>&nbsp;" ;
   
    }

    for($i=1;$i<$total_page;$i++){
       echo"<a href='shop.php?page=".$i."' class='btn btn-outline-secondary'>$i</a>&nbsp;" ;
    }


    if($i>$page ){
        echo"<a href='shop.php?page=".($page+1)."' class='btn btn-outline-secondary'>Next</a>&nbsp;" ;
   
    }


    ?>
</div>
</div>
</div>
</div>


<?php include 'footer.php';?>

    <script src="js/scroll.js"></script>
    <script src="js/index.js"></script>
    <script src="js/cart.js"></script>
</body>
</html>


 