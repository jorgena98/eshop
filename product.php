<?php
include 'header.php'; 
require_once('include/config.php');    
require_once('include/helpers.php'); 
require_once "login/includes/connect.php";

if(isset($_GET['product'])&& !empty($_GET['product']) && is_numeric($_GET['product'])){
 
    $id = $_GET['product'];


    $sql= "SELECT p.product_id,p.name , p.quantity, p.price , p.description , p.image, p.cat_id ,c.name AS category_name FROM products p,category c
WHERE product_id = :productID AND p.cat_id= c.category_id ";

			$handle = $db->prepare($sql);
			$params = [
					':productID' =>$_GET['product'],
				];
			$handle->execute($params);
			if($handle->rowCount() == 1 )
			{
				$getProductData = $handle->fetch(PDO::FETCH_ASSOC);
			}
			else
			{
				$error = 'No record found';
			}
	
		}
		else
		{
			$error = 'No record found';
		}
	
		if(isset($_POST['add_to_cart']) && $_POST['add_to_cart'] == 'add to cart')
		{
			$productID = intval($_POST['product_id']);
			$productQty = intval($_POST['product_qty']);
			
			$sql = "SELECT * from products  WHERE product_id =:productID";
	
			$prepare = $db->prepare($sql);
			
			$params = [
					':productID' =>$productID,
				];
			
			$prepare->execute($params);
			$fetchProduct = $prepare->fetch(PDO::FETCH_ASSOC);
	
			$calculateTotalPrice = number_format($productQty * $fetchProduct['price'],2);
			
			$cartArray = [
				'product_id' =>$productID,
				'qty' => $productQty,
				'product_name' =>$fetchProduct['name'],
				'product_price' => $fetchProduct['price'],
				'total_price' => $calculateTotalPrice,
				'product_img' =>$fetchProduct['image']
			];
			
			if(isset($_SESSION['cart_items']) && !empty($_SESSION['cart_items']))
			{
				$productIDs = [];
				foreach($_SESSION['cart_items'] as $cartKey => $cartItem)
				{
					$productIDs[] = $cartItem['product_id'];
					if($cartItem['product_id'] == $productID)
					{
						$_SESSION['cart_items'][$cartKey]['qty'] = $productQty;
						$_SESSION['cart_items'][$cartKey]['total_price'] = $calculateTotalPrice;
						break;
					}
				}
	
				if(!in_array($productID,$productIDs))
				{
					$_SESSION['cart_items'][]= $cartArray;
				}
	
				$successMsg = true;
				
			}
			else
			{
				$_SESSION['cart_items'][]= $cartArray;
				$successMsg = true;
			}
	
		}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
 		<link  rel="stylesheet" href="css/products.css">

    </head>
	<body>


    <div class="container-fluid aboutT">
	<div>
            <nav class="pt-5" aria-label="breadcrumb">
              <ol class="breadcrumb pt-4 d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="shop.php">Shop</a></li>
				<?php
				if(isset($_GET['product'])&& !empty($_GET['product']) && is_numeric($_GET['product'])){
                $id = $_GET['product']; 
				
				$sql2= "SELECT p.product_id,p.name,p.cat_id ,c.name AS category_name FROM products p,category c
				 WHERE product_id = $id AND p.cat_id= c.category_id ";

				if($result1 = mysqli_query($conn, $sql2)){
					if(mysqli_num_rows($result1) > 0)
					{ while($row = mysqli_fetch_array($result1)){ 
						echo '<li class="breadcrumb-item"><a href="kategoria.php?cat='. $row['cat_id'] .'">'. $row['category_name'] .'</a></li>';
                        echo '<li class="breadcrumb-item active" aria-current="page">'. $row['name'] .'</li>';
			     }}}}?>

              </ol>
            </nav>
        </div>
	</div>

  <div class="container products mt-lg-5 mt-4">
  <?php
  
  if(isset($getProductData) && is_array($getProductData)){
	  if(isset($successMsg) && $successMsg == true){ ?>
		 <div class="row mb-lg-5 mb-4  d-flex justify-content-center">
				 <div class="col-lg-11">
					 <div class="alert alert-success alert-dismissible">
						 <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						 This product is added to cart. <a href="cart.php" class="alert-link">View Cart</a>
					 </div>
				 </div>
			 </div>
		  <?php }
 
				 echo'<div class="row mt-2 d-flex justify-content-around">
					    <div class="col-lg-4 col-12 px-lg-0 px-4">
							   <img class="img-fluid  w-100" src="login/admin/uploaded_img/'. $getProductData['image'] .'" alt="">
					    </div>
					 <div class="col-lg-6 col-12 mt-lg-0 pt-3 mx-lg-0 px-4">
						 <div class="product-details">
								 <h2 class="product-name">'. $getProductData['name'] .'</h2>
							 <div>
								 <h3 class="product-price">$'. $getProductData['price'] .'</h3>';
								 if ($getProductData['quantity']>0)
								 {echo'<span class="product-available">In Stock</span>';}
								 else echo'<span class="product-unavailable">Out of stock</span>';	 
							 echo'</div>
							 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

						 <form class="form-inline" method="POST">
							 <div class="form-group mb-2">
								<div class="add-to-cart">
									 <div class="qty-label">Qty
									 <div class="input-number">
										 <input type="number" name="product_qty" id="productQty" placeholder="Quantity" min="1" max="1000" value="1">'; ?>
										 <input type="hidden" name="product_id" value=" <?php echo $getProductData['product_id']?>">
								     </div>
								     </div>
								 <button type="submit" class="add-to-cart-btn" name="add_to_cart" value="add to cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							 </div>
						 </form>

						<?php echo' <ul class="product-links">
								 <li>Category:</li>
								 <li><a href="kategoria.php?cat='. $getProductData['cat_id'] . '" >'. $getProductData['category_name'] .'</a></li>
							 </ul>
							 
						 </div>
					 </div>					
				 </div>';
		 } ?>
 </div>
 </div>


 <div class="section5">

<div class="d-flex justify-content-center">
  <p id="textC">Trending now</p>
</div>

<?php
$nr=30;
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

<script src="js/cart.js"></script>
<?php include 'footer.php' ?>

	</body>
</html>
