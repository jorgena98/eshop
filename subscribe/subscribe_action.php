<?php 
include_once 'database.php';
include_once 'subscription.php';

$database = new Database();
$db = $database->getConnection();

$subscriber = new Subscription($db);

if(isset($_POST['email_subscribe'])){ 
    $errorMsg = '';     
    $response = array( 
        'status' => 'err', 
        'msg' => 'Something went wrong, please try after some time.' 
    );     
    
	
    if(empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ 
        $pre = !empty($msg)?'<br/>':''; 
        $errorMsg .= $pre.'Please enter a valid email.'; 
    } 
         
    if(empty($errorMsg)){ 
        $email = $_POST['email']; 
        $token = md5(uniqid(mt_rand()));  
               
		    $subscriber->email = $email;
        if($subscriber->getSusbscriber()){ 
            $response['msg'] = 'Your email already exists in our subscribers list.'; 
        } else {      
			    $subscriber->verify_token = $token;
			    $insert = $subscriber->insert(); 
             
          if($insert){ 
			
				  $siteName = 'Nova Decor';  
				 
				  $siteURL = ($_SERVER["HTTPS"] == "on")?'https://':'http://'; 
				  $siteURL = $siteURL.$_SERVER["SERVER_NAME"].dirname($_SERVER['REQUEST_URI']).'/';
			
          $verifyLink = $siteURL.'verify_email.php?email_verify='.$token; 
          $subject = 'Confirm Subscription'; 
     
          $message = '<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;"> 
                
                <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
                  <tr>
                    <td bgcolor="#c3651e" align="center">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                          <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#c3651e" align="center" style="padding: 0px 10px 0px 10px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                          <td bgcolor="#ffffff" align="center" valign="top"
                            style=" border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; line-height: 48px;">
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome to NovaDecor!</h1>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                          <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 0px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Thank you for choosing NovaDecor. First, you need to confirm your account. Just press
                              the button below.</p>
                          </td>
                        </tr>
                        <tr>
                          <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 20px 30px;">
                                  <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                  
                                      <td align="center" style="border-radius: 20px;" bgcolor="#c3651e"><a href="'. $verifyLink.'" target="_blank"
                                          style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 20px; border: 1px solid #FFA73B; display: inline-block;">Confirm
                                          Account</a></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 20px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">This is an auto-generated email. Please <b>do not</b> reply to this email.</p>
                          </td>
                        </tr>
                        <tr>
                          <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Cheers,<br>NovaDecor Team</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                 
          
                </table>
              
              <body>';
                 
        $headers = "MIME-Version: 1.0" . "\r\n";  
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
        $headers .= "From: $siteName"." <".$siteEmail.">"; 
                 
        $mail = mail($email, $subject, $message, $headers); 
        if($mail){ 
        $response = array( 
        'status' => 'ok', 
        'msg' => 'A verification link has been sent to your email address, please check your email and verify.' 
                    ); 
                } 
            } 
            
        } 
    } else { 
        $response['msg'] = $errorMsg; 
        
    }       
    echo json_encode($response); 
} 
?>
