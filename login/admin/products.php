<?php
include 'settings.php'; 
include "../includes/connect.php";
if(isset($_GET['page'])){
  $page=$_GET['page'];
}

else{$page=1;}

$num_per_page=6;
$start_from=($page-1)*$num_per_page;

$query="SELECT p.product_id,p.name , p.quantity, p.price , p.description , p.image, p.cat_id ,c.name AS category_name FROM products p,category c
WHERE p.cat_id= c.category_id limit $start_from,$num_per_page";
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
        <h1 class="h2">Produktet</h1>
      </div>

      <div class="d-md-flex my-3">
          <a href="add.php">
            <button class="btn btn-success pe-4" type="button"><i class="fa-solid fa-plus"></i>&nbsp;Shto produkt</button>
          </a>
     </div>

    <div class="table-responsive">   
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
           <tr>
                <td>#<?php echo $row['product_id']; ?></td>
                <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="50px;" alt="">  <?php echo $row['name']; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['price']; ?> $</td> 
                <td><?php echo $row['quantity']; ?></td> 
                <td><?php echo substr($row['description'],0,20); ?></td>
                <td>
                <a href="view.php?view=<?php echo $row['product_id']; ?>" title="View Record" data-toggle="tooltip"><span class="fa fa-eye text-secondary fa-sm">&nbsp;&nbsp;</span></a>
                <a href="update.php?edit=<?php echo $row['product_id']; ?>" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil text-secondary fa-sm">&nbsp;&nbsp;</span></a>
                <a href="delete.php?delete=<?php echo $row['product_id']; ?>" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash text-secondary fa-sm"></span></a>
                </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>  

<?php 
    $pr_query="SELECT * FROM products";
    $pr_result=mysqli_query($conn,$pr_query);
    $total_record=mysqli_num_rows($pr_result); 
    $total_page=ceil($total_record/$num_per_page);

    if($page>1 ){
        echo"<a href='products.php?page=".($page-1)."' class='btn btn-outline-secondary'>Previous</a>&nbsp;" ;
   
    }

    for($i=1;$i<$total_page;$i++){
       echo"<a href='products.php?page=".$i."' class='btn btn-outline-secondary'>$i</a>&nbsp;" ;
    }


    if($i>$page ){
        echo"<a href='products.php?page=".($page+1)."' class='btn btn-outline-secondary'>Next</a>&nbsp;" ;
   
    }

    ?>
      


    </main>
  </div>
</div>

<script src="../../js/bootstrap.bundle.min.js"></script> 

</body>
</html>
