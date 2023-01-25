<?php
include 'headers.php';
include 'settings.php'; 
include "../includes/connect.php";
if(isset($_POST['add_product'])){
    $product_name = $_POST['product_name'];
    $product_category = filter_input(INPUT_POST, 'product_category', FILTER_SANITIZE_STRING);
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_description = $_POST['product_description'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/'.$product_image;
 
    if(empty($product_name) || empty($product_price) || empty($product_image) || empty($product_quantity) || empty($product_description) || empty($product_image_folder) ){
      $message[] = 'Please fill out all';
   }else{  
  
   $sql = "SELECT  category_id FROM category where name='$product_category'";
   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
       $insert_cat= $row["category_id"] ;
     }
   }
 

   $insert = "INSERT INTO products(name, price, image,description,quantity,cat_id) VALUES('$product_name', '$product_price', '$product_image', '$product_description' , '$product_quantity' ,'$insert_cat')";
   $upload = mysqli_query($conn,$insert);
   if($upload){
      move_uploaded_file($product_image_tmp_name, $product_image_folder);
      $message[] = 'New product added successfully';
      header("location: products.php");
     exit();
   }else{
      $message[] = 'Could not add the product';
   }

   }
   
}

if(isset($_GET['page'])){
  $page=$_GET['page'];
}

else{$page=1;}

$num_per_page=5;
$start_from=($page-1)*$num_per_page;
$query="SELECT * FROM products limit $start_from,$num_per_page";
$result=mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Krijo rekord</title>
    </head>
<body>

        <div class="container-fluid">
            <div class="row d-flex justify-content-center mb-3 mt-4">
             <?php include 'sidebars.php';?>
                <div class="col-lg-7 col-12">
                <?php 
                  if(isset($message)){
                     foreach($message as $message){
                        echo '<div class="col-lg-12 col-12 alert alert-danger"><i class="fa fa-exclamation-circle"></i> '.$message.'</div>';
                        }}
                ?>
                    <h2>Shto nje produkt te ri</h2>
                    <p class="mb-4">Per te shtuar nje produkt ne databaze, plotesoni te dhenat e meposhtme:</p>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                        
                        <div class="row mb-3">
                            <label for="emri" class="col-sm-2 col-form-label">Emri</label>
                               <div class="col-sm-10">
                                 <input type="text" class="form-control" id="emri" name="product_name">
                               </div>
                        </div>

                        <div class="row mb-3">
                        <label for="sel1" class="col-sm-2 col-form-label">Kategoria</label>
                         <div class="col-sm-10">
                           <select class="form-control" id="sel1" name="product_category">
                              <?php 
                                 $query ="SELECT name FROM category";
                                 $result = $conn->query($query);
                                 if($result->num_rows> 0){
                                 while($optionData=$result->fetch_assoc()){
                                    echo '<option>'. $optionData['name'] .'<option>';   }}
                              ?>
                           </select> 
                         </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cmimi" class="col-sm-2 col-form-label">Cmimi</label>
                               <div class="col-sm-10">
                                  <div class="input-group">
                                     <input type="number" class="form-control"  id="cmimi" name="product_price" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                         <span class="input-group-text">$</span>
                                        </div>
                                  </div>
                               </div>    
                        </div>

                        <div class="row mb-3">
                            <label for="cmimi" class="col-sm-2 col-form-label">Sasia</label>
                               <div class="col-sm-10">
                               <div class="input-group">
                                     <input type="number" class="form-control" id="cmimi" name="product_quantity">
                                        <div class="input-group-append">
                                         <span class="input-group-text">cope</span>
                                        </div>
                                  </div>
                               </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pershkrimi" class="col-sm-2 col-form-label">Pershkrimi</label>
                               <div class="col-sm-10">
                                 <textarea class="form-control" id="pershkrimi" name="product_description" rows="3"></textarea>
                               </div>
                        </div>

                        <div class="row mb-4">
                            <label for="pershkrimi" class="col-sm-2 col-form-label">Imazhi</label>
                               <div class="col-sm-10">
                                 <input class="form-control" type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="custom-file-input" id="choose">          
                               </div>
                        </div>
                   
                        <input type="submit" class="btn btn-primary px-5" value="Shto" name="add_product">
                        <a href="products.php" class="btn btn-secondary px-5 ml-2">Anullo</a>
                    </form>
                </div>
      

</div>    
</div>

<script src="../../js/bootstrap.bundle.min.js"></script> 

</body>
</html>





