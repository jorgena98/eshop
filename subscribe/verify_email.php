<?php 
include_once 'database.php';
include_once 'subscription.php';

$database = new Database();
$db = $database->getConnection();
$subscriber = new Subscription($db);

$verifyMessage = '';
if(!empty($_GET['email_verify'])){     
	$token = $_GET['email_verify']; 	
	$subscriber->verify_token = $token;
    if($subscriber->isValidToken()){ 
       	$subscriber->is_verified = 1;        
        if($subscriber->update()) { 
            $verifyMessage = '<p class="success">Your email address has been verified successfully.</p>'; 
        } else { 
            $verifyMessage = '<p class="error">Some problem occurred on verifying your email, please try again.</p>'; 
        } 
    } else { 
        $verifyMessage = '<p class="error">You have clicked on the wrong link, please check your email and try again.</p>'; 
	}
}

?>
<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="ajax_sub.js"></script>
    <link rel="stylesheet" href="css/style.css">
  </head>
<body>

<div class="content"> 
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<?php echo $verifyMessage; ?>
			</div>
		</div>	 
	</div>       
</div>   		
</body>
</html>


