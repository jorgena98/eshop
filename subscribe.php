<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
	<link rel="stylesheet" href="css/stilizim.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	

  </head>
<body>
	<div class="content"> 
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="main-content">
					<div class="susbcribe-container">					
						<div class="bottom">												
							<form action="#" id="subscribeForm" method="post">	
							<div class="input-group py-2 my-2">							
								<input type="email" class="form-control" id="email" placeholder="Your email address..." required="">
								<input type="button" class="btn" id="subscribeButton" value="SUBSCRIBE"> </div>
							</form>
							<div class="hidden" id="emailError"></div>
							<div class="status"></div>	
							
						</div>
					</div>
				</div>
			</div>
		</div>	 
	</div>       
</div> 
<script src="js/subscribe.js"></script>
</body>
</html>



