<?php
include 'settings.php'; 
include "../includes/connect.php";
if(isset($_GET['page'])){
  $page=$_GET['page'];
}

else{$page=1;}

$num_per_page=5;
$start_from=($page-1)*$num_per_page;

$query="SELECT * FROM orders limit $start_from,$num_per_page";
$result=mysqli_query($conn,$query);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    

    <?php include 'headers.php'?>

<div class="container-fluid">
  <div class="row">
    <?php include 'sidebars.php'?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Porosite</h1>
      </div>
    
 <div class="table-responsive">   
  <table class="table table-responsive">
   <thead  class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Te dhenat e klientit</th>
      <th scope="col">Detajet e porosise</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($result)){ 
      $id=$row['id'];?>
    <tr>
            <td>#<?php echo $id; ?></td>
            <td>
              Emri: <?php echo $row['name']; ?><br>
              Emaili: <?php echo $row['email']; ?><br>
              Adresa: <?php echo $row['address']; ?>
            </td>
            <td>
            <table class="table">
            <thead class="table-light">
              <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Product</th>
                  <th scope="col">Sasia</th>
                  <th scope="col">Cmimi</th>
                  <th scope="col">Totali</th>
              </tr>
            </thead>
            <tbody>
            <tbody>
            <?php  
            $query1="SELECT * FROM order_details where order_id=$id";
            $result1=mysqli_query($conn,$query1);
             while($row1 = mysqli_fetch_assoc($result1)){ ?>
             <tr>
             <td><?php echo $row1['product_id']; ?></td>
             <td><?php echo $row1['product_name']; ?></td>
             <td><?php echo $row1['qty']; ?></td>
             <td><?php echo $row1['product_price']; ?> $</td>
             <td><?php echo $row1['total_price']; ?> $</td>
             </tr>
            <?php  }?>
            <tr class="table-light">
            <td colspan="4" >Totali i porosise</td>
            <td><?php echo $row['total_price'];?> $</td>
            <tr>
             </tbody>
             </table>
          </td>
            
    </tr>
     <?php } ?>
  </tbody>
</table>
</div> 
<?php 
    $pr_query="SELECT * FROM orders";
    $pr_result=mysqli_query($conn,$pr_query);
    $total_record=mysqli_num_rows($pr_result); 

    $total_page=ceil($total_record/$num_per_page);

    if($page>1 ){
        echo"<a href='orders.php?page=".($page-1)."' class='btn btn-outline-secondary'>Previous</a>&nbsp;" ;
   
    }

    for($i=1;$i<$total_page;$i++){
       echo"<a href='orders.php?page=".$i."' class='btn btn-outline-secondary'>$i</a>&nbsp;" ;
    }


    if($i>$page ){
        echo"<a href='orders.php?page=".($page+1)."' class='btn btn-outline-secondary'>Next</a>&nbsp;" ;
   
    }


    ?>
      


    </main>
  </div>
</div>


    

<script src="../../js/bootstrap.bundle.min.js"></script> 
  </body>
</html>
