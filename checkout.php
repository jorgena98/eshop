<?php 
include('header.php');
 
    if(!isset($_SESSION['cart_items']) || empty($_SESSION['cart_items']))
    {
        header('location:index.php');
        exit();
    }
    require_once('include/config.php');    
    require_once('include/helpers.php');  

    $cartItemCount = count($_SESSION['cart_items']);


    if(isset($_POST['submit']))
    {
        if(isset($_POST['first_name'],$_POST['email'],$_POST['address']) && !empty($_POST['first_name']) && !empty($_POST['email']) && !empty($_POST['address']))
        {
           $firstName = $_POST['first_name'];

           if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false)
           {
                 $errorMsg[] = 'Please enter valid email address';
           }
           else
           {
                $firstName  = validate_input($_POST['first_name']);
                $email      = validate_input($_POST['email']);
                $address    = validate_input($_POST['address']);
                

                $sql = 'insert into orders (name, email, address,order_status,created_at) values (:name, :email, :address, :order_status,:created_at)';
                $statement = $db->prepare($sql);
                $params = [
                    'name' => $firstName,
                    'email' => $email,
                    'address' => $address,
                    'order_status' => 'confirmed',
                    'created_at'=> date('Y-m-d H:i:s')
                ];

                $statement->execute($params);
                if($statement->rowCount() == 1)
                {
                    
                    $getOrderID = $db->lastInsertId();

                    if(isset($_SESSION['cart_items']) || !empty($_SESSION['cart_items']))
                    {  
                        $sqlDetails = 'insert into order_details (order_id, product_id, product_name, product_price, qty, total_price) values(:order_id,:product_id,:product_name,:product_price,:qty,:total_price)';
                        $orderDetailStmt = $db->prepare($sqlDetails);

                        $totalPrice = 0;
                        foreach($_SESSION['cart_items'] as $item)
                        {
                            $totalPrice+=$item['total_price'];
                           
                            $paramOrderDetails = [
                                'order_id' =>  $getOrderID,
                                'product_id' =>  $item['product_id'],
                                'product_name' =>  $item['product_name'],
                                'product_price' =>  $item['product_price'],
                                'qty' =>  $item['qty'],
                                'total_price' =>  $item['total_price']
                            ];

                            $orderDetailStmt->execute($paramOrderDetails);

                        }
                        
                        $updateSql = 'update orders set total_price = :total where id = :id';

                        $rs = $db->prepare($updateSql);
                        $prepareUpdate = [
                            'total' => $totalPrice,
                            'id' =>$getOrderID
                        ];

                        $rs->execute($prepareUpdate);
                        
                        unset($_SESSION['cart_items']);
                        $_SESSION['confirm_order'] = true;
                        header('location:thank-you.php');
                        exit();
                    }
                }
                else
                {
                    $errorMsg[] = 'Unable to save your order. Please try again';
                }
           }
        }
        else
        {
            $errorMsg = [];

            if(!isset($_POST['first_name']) || empty($_POST['first_name']))
            {
                $errorMsg[] = 'First name is required';
            }
            else
            {
                $fnameValue = $_POST['first_name'];
            }


            if(!isset($_POST['email']) || empty($_POST['email']))
            {
                $errorMsg[] = 'Email is required';
            }
            else
            {
                $emailValue = $_POST['email'];
            }

            if(!isset($_POST['address']) || empty($_POST['address']))
            {
                $errorMsg[] = 'Address is required';
            }
            else
            {
                $addressValue = $_POST['address'];
            }
    

        }
    }
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<div class="container mt-lg-5 mt-5 pt-5">
    <div class="text-center">
       <h2>Checkout form</h2>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-lg-4 col-10 order-lg-last">
        <h4 class="d-flex justify-content-between mb-lg-3 mb-1" >
          <span class="text-primary">Your cart</span> 
          <span class="badge bg-primary rounded-pill"><?php echo $cartItemCount;?></span>
        </h4>
        <ul class="list-group mb-3">
        <?php
                $total = 0;
                foreach($_SESSION['cart_items'] as $cartItem)
                {
                    $total+=$cartItem['total_price'];
                ?>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?php echo $cartItem['product_name'] ?></h6>
              <small class="text-muted">Quantity: <?php echo $cartItem['qty'] ?> x Price: <?php echo $cartItem['product_price'] ?></small>
            </div>
            <span class="text-muted">$<?php echo $cartItem['total_price'] ?></span>
          </li>
          <?php
                }
            ?>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>$<?php echo number_format($total,2);?></strong>
          </li>
        </ul>
      </div>
              
      <div class="col-lg-8 col-10">
        <h4 class="mb-3">Billing address</h4>
          <?php 
            if(isset($errorMsg) && count($errorMsg) > 0)
            {
                foreach($errorMsg as $error)
                {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }
            }
          ?>
          <form  id="contactForm1"  class="needs-validation" novalidate method="POST">
         
          <div class="mb-3">
              <label class="form-label"  for="firstName" >First name</label>
              <input class="form-control" type="text" id="firstName" required name="first_name" placeholder="First Name" value="" >
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>


            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com" name="email" placeholder="you@example.com" value="">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St"  value="" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
           
            <div class="d-grid">
              <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="submit">Continue to checkout</button>
            </div>   
          </form>
      </div>
    </div>

</div>

<script src="js/form-validation.js"></script>
</body>
</html>
