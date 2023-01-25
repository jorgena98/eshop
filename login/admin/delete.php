<?php

include "../includes/connect.php";

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   
   mysqli_query($conn, "DELETE FROM products WHERE product_id = $id");
   header('location:products.php');
};

?>