<?php 
 
     if(!isset($_SESSION['confirm_order']) || empty($_SESSION['confirm_order']))
     {
         header('location:checkout.php');
         exit();
     }

    require_once('include/config.php');    
    require_once('include/helpers.php');  
    include('header.php');
?>
<div class="row">
    <div class="col-md-12">
        <h1>Thank you!</h1>
        <p>
            Your order has been placed.
            <?php unset($_SESSION['confirm_order']);?>
        </p>
    </div>
</div>
</div>
