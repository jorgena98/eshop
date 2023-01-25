<?php
 include 'headers.php';
include "../includes/connect.php";

$id = $_GET['edit'];

if(isset($_POST['update_product'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_category = filter_input(INPUT_POST, 'product_category', FILTER_SANITIZE_STRING);
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'Please fill out all!';    
   }else{

      $sql = "SELECT  category_id FROM category where name='$product_category'";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $insert_cat= $row["category_id"] ;
        }
      }

      $update_data = "UPDATE products SET name='$product_name', price='$product_price',cat_id='$insert_cat', image='$product_image'  WHERE product_id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:products.php');
      }else{
         $message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container-fluid">
<?php
     $select = mysqli_query($conn, "SELECT * FROM products WHERE product_id = '$id'");
     while($row = mysqli_fetch_assoc($select)){
  ?>
            <div class="row d-flex justify-content-center mb-3 mt-4">
            <?php include 'sidebars.php'?>
            <div class="col-lg-7 col-12">
                <?php 
                  if(isset($message)){
                     foreach($message as $message){
                        echo '<div class="col-lg-12 col-12 alert alert-danger"><i class="fa fa-exclamation-circle"></i> '.$message.'</div>';
                        }}
                ?>
                    <h2>Perditeso te dhenat e produktit</h2>
                    <p class="mb-4">Per te perditesuar te dhenat e produktit ne databaze, plotesoni te dhenat e meposhtme:</p>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

                        <div class="row mb-3">
                            <label for="emri" class="col-sm-2 col-form-label">Emri</label>
                               <div class="col-sm-10">
                                 <input type="text" class="form-control"   name="product_name" value="<?php echo $row['name']; ?>">
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
                                     <input type="number" class="form-control"  id="cmimi" name="product_price" value="<?php echo $row['price']; ?>">
                                        <div class="input-group-append">
                                         <span class="input-group-text">ALL</span>
                                        </div>
                                  </div>
                                </div>    
                        </div>

                        <div class="row mb-3">
                            <label for="cmimi" class="col-sm-2 col-form-label">Sasia</label>
                               <div class="col-sm-10">
                               <div class="input-group">
                                     <input type="number" class="form-control" id="cmimi" name="product_quantity" value="<?php echo $row['quantity']; ?>">
                                        <div class="input-group-append">
                                         <span class="input-group-text">cope</span>
                                        </div>
                                  </div>
                               </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pershkrimi" class="col-sm-2 col-form-label">Pershkrimi</label>
                               <div class="col-sm-10">
                                 <textarea class="form-control" id="pershkrimi" name="product_description" rows="3"><?php echo $row['description']; ?></textarea>
                               </div>
                        </div>

                        <div class="row mb-4">
                            <label for="pershkrimi" class="col-sm-2 col-form-label">Imazhi</label>
                               <div class="col-sm-10">
                                        <input class="form-control" type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="custom-file-input" id="choose">
                                        
                               </div>
                        </div>
                   
                        <input type="submit" class="btn btn-primary px-5" value="Update" name="update_product">
                        <a href="products.php" class="btn btn-secondary px-5 ml-2">Anullo</a>
                    
                    </form>
                </div>
      
<?php }?>

</div>    
</div>


<script src="../../js/bootstrap.bundle.min.js"></script> 

</body>
</html>