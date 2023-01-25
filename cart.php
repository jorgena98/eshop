<?php include 'header.php'; ?>
<?php 
 require_once('include/config.php');    
 require_once('include/helpers.php');  
 if(isset($_GET['action'],$_GET['item']) && $_GET['action'] == 'remove')
 {
     unset($_SESSION['cart_items'][$_GET['item']]);
     header('location:cart.php');
     exit();
 }
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body style="background-color:gray">

<div class="container">

 <div class="row d-flex justify-content-center align-items-center mt-5 pt-5">
         <div class="col-12">

         <?php if(empty($_SESSION['cart_items'])){?>
          <div class="row ">
             <div class="col-md-12">
               <div class="alert alert-secondary alert-dismissible">
                  Your cart is empty <a href="shop.php" class="alert-link"> SHOP</a>
               <div>
            <div>
          <div>
        <?php }?>



 
        <?php if(isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0){?>
            <?php echo '<div class="card mb-4 px-lg-4 px-2">
              <table class="table table-responsive align-text-bottom" style="text-align:center">
                 <thead class="align-middle">
                    <th class="one"><p class="small text-muted">Product</p></th>
                    <th><p class="small text-muted ">Name</p></th>
                    <th><p class="small text-muted">Quantity</p></th>
                    <th><p class="small text-muted">Price</p></th>
                    <th class="one"><p class="small text-muted">Total</p></th>
                    <th><p class="small text-muted">Delete</p></th>
                  </thead>
                <tbody class="align-text-bottom">';
                $totalCounter = 0;
                $itemCounter = 0;
                foreach($_SESSION['cart_items'] as $key => $item){
                $total = $item['product_price'] * $item['qty'];
                $totalCounter+= $total;
                $itemCounter+=$item['qty'];
             ?>

                <tr>     
                 <td class="one"><img src="login/admin/uploaded_img/<?php echo $item['product_img'];?>" class="img-fluid" alt="Generic placeholder image" style="height:90px;"></td>
                    <td class="align-baseline">  <p class="lead fw-normal"><?php echo $item['product_name']; ?></p></td>
                    <td><input type="number" name="" class="cart-qty-single" data-item-id="<?php echo $key?>" value="<?php echo $item['qty'];?>" min="1" max="1000" ></td>
                    <td> <p class="lead fw-normal"><?php echo $item['product_price']; ?>$</</td>
                    <td class="align-text-bottom one">   <p class="lead fw-normal"><?php echo  $total; ?>$</p></td>
                    <td><a href="cart.php?action=remove&item=<?php echo $key?>" class="text-danger">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>  
                </tr>  
            <?php
            }?>
                </tbody>
               </table>  
            </div>
            

           

            <div class="card mb-4 pe-lg-5 pe-2 d-flex align-items-end">
                <p><?php echo ($itemCounter==1)?$itemCounter.' item':$itemCounter.' items'; ?> </p>
                <p>
                  <span class="small text-muted me-2">Order total:</span> <span class="lead fw-normal"><?php echo $totalCounter;?> $</span>
                </p>
             
            </div>
  
          <div class="d-flex justify-content-end mb-4">
          <a class="btn btn-light btn-lg me-2 btn-sm" href="shop.php">Continue shopping</a>
          <a class="btn btn-primary btn-lg me-2 btn-sm"  href="checkout.php">Checkout</a>
          <button class="btn btn-danger btn-lg me-2 btn-sm" id="emptyCart">Clear Cart</button>    
          </div>
          <?php
             }
           
            ?>
         </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="js/cart.js"></script>


</body>
</html>



