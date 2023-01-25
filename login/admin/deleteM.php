<?php

include "../includes/connect.php";

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   
   mysqli_query($conn, "DELETE FROM message WHERE contact_id = $id");
   header('location:messages.php');
};

?>