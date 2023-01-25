
<?php
include 'settings.php'; 
include "../includes/connect.php";
if(isset($_GET['page'])){
  $page=$_GET['page'];
}

else{$page=1;}

$num_per_page=5;
$start_from=($page-1)*$num_per_page;

$query="SELECT * from message limit $start_from,$num_per_page";
$result=mysqli_query($conn,$query);



?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    

    <?php include 'headers.php'?>

<div class="container-fluid">
  <div class="row">
    <?php include 'sidebars.php'?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>



      <h2>Section title</h2>
      <div class="table-responsive">   
      <table class="table table-bordered">
   <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($result)){ ?>
    <tr>
            <td>#<?php echo $row['contact_id']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo substr($row['user_message'],0,80); ?></td>
            <td> 
              <a href="deleteM.php?delete=<?php echo $row['contact_id']; ?>">
                <span class="fa fa-trash text-secondary fa-sm"></span>
              </a>
          </td> 
          </tr>
     <?php } ?>
  </tbody>
</table>
</div>   
<?php 
    $pr_query="SELECT * FROM message";
    $pr_result=mysqli_query($conn,$pr_query);
    $total_record=mysqli_num_rows($pr_result); 

    $total_page=ceil($total_record/$num_per_page);

    if($page>1 ){
        echo"<a href='messages.php?page=".($page-1)."' class='btn btn-outline-secondary'>Previous</a>&nbsp;" ;
   
    }

    for($i=1;$i<$total_page;$i++){
       echo"<a href='messages.php?page=".$i."' class='btn btn-outline-secondary'>$i</a>&nbsp;" ;
    }


    if($i>$page ){
        echo"<a href='messages.php?page=".($page+1)."' class='btn btn-outline-secondary'>Next</a>&nbsp;" ;
   
    }


    ?>



    </main>
  </div>
</div>
<script src="../../js/bootstrap.bundle.min.js"></script> 
</body>
</html>
