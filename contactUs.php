<?php include 'header.php' ?>
<?php 
require_once "login/includes/connect.php";

if(isset($_POST["send_message"])) {
	$fullname = $_POST["contact"];
	$email = $_POST["emaili"];
  $subject = $_POST["subject"];
	$user_message = $_POST["message"];


    $insert = "INSERT INTO message(fullname,email,user_message,subject) VALUES('$fullname', '$email', '$user_message','$subject')";
    $upload = mysqli_query($conn,$insert);
    if($upload){
      $_SESSION['status'] = ' New message added successfully';
      header("location: contactUs.php");
      exit(); }
    else{
      $_SESSION['error'] = ' Could not add the message';} 
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
<body>

<div class="container-fluid aboutT">
  <div>    
    <nav class="pt-5" aria-label="breadcrumb">
      <ol class="breadcrumb pt-4 d-flex justify-content-center">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Contact us</li>
      </ol>
    </nav>
  </div>
</div>


<div class="container mt-lg-5 mt-3 contactU">
    <div class="row mx-3">
        <div class="col-lg-4 mx-3  col-12">
            <h2>Contact us</h2>
             <div class="row borderi pt-3">
              <div class="row">
                <div class="col-lg-2">
                  <i class="fa fa-home fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-lg-8">
                   <h5>Address</h5>
                </div>
              </div>
              <div class="row">
              <p id="tekstC">123 Main Street, Anytown, CA 12345 – USA</p>
              </div>
            </div>
            <div class="row borderi pt-3">
              <div class="row">
                <div class="col-lg-2">
                  <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-lg-8">
                   <h5>Phone</h5>
                </div>
              </div>
              <div class="row">
              <p id="tekstC">Mobile: xxxx xxx xxx</p>
              <p id="tekstC">Mobile:  xxxx xxx xxx</p>
              </div>
            </div> 
            <div class="row borderi pt-3">
              <div class="row">
                <div class="col-lg-2">
                  <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                </div>
                <div class="col-lg-8">
                   <h5>Email</h5>
                </div>
              </div>
              <div class="row">
                <p id="tekstC">yourmail@domain.com</p>
                <p id="tekstC">yourmail@domain.com</p> 
              </div>
            </div>
        </div>
       
        <div class="col-lg-7 mx-lg-3 col-12 frm" >
          <h2>Write us your message</h2>
            <?php 

            if(isset($_SESSION['status']))
            {
              echo'<div class="alert alert-success"><i class="fa-solid fa-check"></i>' . $_SESSION['status'].'</div>';
              unset($_SESSION['status']);  
                   
                  }
            else if(isset($_SESSION['error']))
            {
              echo'<div class="alert alert-danger"><i class="fa-solid fa-check"></i>' . $_SESSION['error'].'</div>';
              unset($_SESSION['error']);    
                  }
                
            ?>
          <form id="contactForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="needs-validation" novalidate>
              
                <div class="mb-3">
                  <label class="form-label" for="name">Your Name</label>
                  <input class="form-control" id="name"  name="contact" type="text" required />
                  <div class="invalid-feedback">
                    Please fill the name field.
                  </div> 
                </div>
    
                
                <div class="mb-3">
                  <label class="form-label" for="emailAddress">Your Email Address</label>
                  <input class="form-control" id="emailAddress" name="emaili" type="email"  required />
                  <div class="invalid-feedback">
                    Please enter a valid email address.
                  </div> 
                </div>
               
                <div class="mb-3">
                  <label class="form-label" for="subject">Subject</label>
                  <input class="form-control" id="subject"  name="subject" type="text"  required />
                  <div class="invalid-feedback">
                    Please fill the subject field.
                  </div> 
                </div>

                <div class="mb-3">
                  <label class="form-label" for="message">Message</label>
                  <textarea class="form-control" id="message" name="message"  type="text" style="height: 10rem;" required ></textarea>
                  <div class="invalid-feedback">
                     Please fill the message textarea.
                  </div> 
                </div>

                <div class="d-grid">
                  <input type="submit" class="btn btn-light" value="Send" name="send_message">
                </div>         
            </form>        
        </div>
    </div>
</div>
<script src="js/form-validation.js"></script>
<?php include 'footer.php' ?>
</body>
</html>
