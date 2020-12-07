<?php
   ////////////////////phpmailer Starts///////////////////// 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require './inc/phpmailer/src/Exception.php';
    require './inc/phpmailer/src/PHPMailer.php';
    require './inc/phpmailer/src/SMTP.php';
   ////////////////////phpmailer ends///////////////////// 
   
    include "connection/connect.php";
           
    $username = mysqli_real_escape_string($con, htmlspecialchars($_POST['username']));
    $email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($con, htmlspecialchars($_POST['password']));
   
 
 
    if(isset($_POST['submit']))
    {
        
    						$secretKey = "6LcmTqMUAAAAAHW6EWpnT_jM2KXUbmntGDje_EvQ";
    						$responseKey = "6LcmTqMUAAAAAOkyjI6fVixDhp3gJ2taxjehZY1T";
						
						    $responseKey = mysqli_real_escape_string($con,htmlentities($_POST['g-recaptcha-response'])); //responce_key_callback_by_google
                            $userIP = $_SERVER['REMOTE_ADDR']; //user_ip_address
                            $google_api_url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP"; // google_api_url
                            $response = file_get_contents($google_api_url);
                            $response = json_decode($response);
						
						
						
						
						
        
         if(!empty($username) && !empty($email) && !empty($password))
         {
                 
                 
                //now lets check if user username in already exist	
                    $stmt = $con->prepare('SELECT tagr_id FROM taggers WHERE username = ?');
                    $stmt->bind_param('s', $username);
                    	$stmt->execute();
                    	// Store the result so we can check if the account exists in the database.
                    	$stmt->store_result();
                 
                 
                   
                //now lets check if user email in already exist
                    $stmts = $con->prepare('SELECT tagr_id FROM taggers WHERE email = ?');
                    $stmts->bind_param('s', $email);
                    	$stmts->execute();
                    	// Store the result so we can check if the account exists in the database.
                    	$stmts->store_result();
                    	
                   
      
       
                  if (strpos($username, ' ') > 0) {
                      
                       echo  $error ='           <div class="alert alert-danger">  
                                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                        <strong>Invalid!</strong> Try username without spaces. 
                                                                    </div>  ';	
                    } 
                                   
                elseif($stmt->num_rows > 0)
                 {
        	         
                               $error='    <div class="alert alert-danger">  
                                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                        <strong>Opps!</strong> username is already in use, Pick different one. 
                                                                    </div>  ';	
                                                                    
                                                                    
                              $stmt->close();                                      
                                
                                
                  }
                elseif($stmts->num_rows > 0)
                 {
        	         
                                
                          $error='    <div class="alert alert-danger">  
                                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                        <strong>Opps!</strong> Email is already in use, Pick different one. 
                                                                    </div>  ';	 
                                                                    
                             $stmts->close();                                             
                                
                  }  
                elseif(strlen($password) < 6)  //cal password length
                	{
            	
            		
            		
                                
                         $error='    <div class="alert alert-danger">  
                                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                        <strong>Opps!</strong> Password is too short, Must be 6 Charactors. 
                                                                    </div>  ';	    
            		
                	}
            
            elseif($response->success == false)
                    {
                        
                              $error='
                             
                                        <div class="alert alert-danger">  
                                            <button type="button" class="close" data-dismiss="alert">×</button>  
                                            <strong>Opps!</strong> You Missed the Captcha, please try again below: 
                                        </div>  ';
                                
                                
                    }
                 else 
                 {
                      $encrypt_passwords = password_hash($password, PASSWORD_DEFAULT);
                      $token =  md5(uniqid(rand(), TRUE));
                      
                       $stmt = $con->prepare('INSERT INTO taggers(token,username,email,password,cr_d) VALUES(?, ?, ?, ?, ?)');
                       $stmt->bind_param('sssss', $token,$username,$email,$encrypt_passwords,$current_date);
                       
                       if($stmt->execute())
                       {
                                                
                                                        
                                         //fetching token from db          
                                            $sql_prepare = 'SELECT token FROM taggers Where token= ?';
                                            $stmt = $con->prepare($sql_prepare); 
                                            $stmt->bind_param('s', $token);
                                            $stmt->execute();
                                            $stmt->bind_result($token);
                                            $stmt->fetch();
                                            $json = array();
                                            $json = array('token'=>$token);
                                          
                                         $token_id = $json['token'];
                                         $link="https://$_SERVER[HTTP_HOST]"."/activate/".$token_id;
                                                                                      
                                                       $toEmail = $email;
                                                       $subject = "Confirm your E-mail address";
                                                       
                                                       
                                                                    include "inc/email_content.php";  //content  
                                                                    
                                                                    
                                                                        $mail = new PHPMailer;
                                                                     
                                                                        $mail->isSMTP();
                                                                        $mail->SMTPDebug = 0;//0= off, 1=client message,2=client-server message
                                                                        
                                                                        $mail->Host = 'mx1.hostinger.com';
                                                                        $mail->Port = 587;
                                                                        $mail->SMTPAuth = true;
                                                                        $mail->SMTPSecure = 'tls';
                                                                        $mail->Username = 'support@paypertag.tk';
                                                                        $mail->Password = '74587458';
                                                                        
                                                                        $mail->setFrom('support@paypertag.tk', '');
                                                                        $mail->addReplyTo('support@paypertag.tk', '');
                                                                        $mail->addAddress($toEmail);
                                                                        $mail->Subject = 'Confirm your E-mail address';
                                                                        $mail->msgHTML($content);
                                                                        
                                                                      
                                                                              
                                                                             if($mail->send()) 
                                                                             {
                                                                                
                                                                                                                         
                                                                                 $success='    <div class="alert alert-success">  
                                                                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                        <strong>Success.</strong> Thank you For registering with us, check your 
                                                                                                                             email to activate your account. Dont forget to check spam folder. 
                                                                                                    </div>  ';	
                                                                                                    
                                        	                                 } 
                                        	                                 else
                                        	                                 {
                                        	                                    
                                        	                                    
                                                                                   // echo 'error: ' . $mail->ErrorInfo;                  
                                                                                                      
                                                                                 $error='    <div class="alert alert-danger">  
                                                                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                        <strong>Opps!</strong>unable to send email, Try again later. 
                                                                                                    </div>  ';		
                                        	                                 }              
                                                                    
                                                                     
                                                                    
                                                                    
                       } else
                        {
                              
                                 
                                 $error='    <div class="alert alert-danger">  
                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                        <strong>ERROR!</strong>SQL:Query_Error 
                                                    </div>  ';		
                         }
                                
                    
                      


                                              
                                        
                         
                }
        
         }
        
          else
            {
                  
                     
                     $error='    <div class="alert alert-danger">  
                                            <button type="button" class="close" data-dismiss="alert">×</button>  
                                            <strong>Opps!</strong> You forget to enter data, please try again below: 
                                        </div>  ';		
             }
       
    }
	
	?>


<!DOCTYPE html>
<html>


<head>
 <?php 
          include "account/includes/head.php";
  ?>
</head>

<body class="bg-default">
 
  <!-- Navbar -->
  <?php 
          include "account/includes/login_register_navbar.php";
  ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center  mb-4">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Create an account</h1>
              <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p>
            </div>
          </div>
        </div>
      </div>
     
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">         
        
        <?php
        if(isset($error)){echo $error; } else if(isset($success)){echo $success; }
        ?>
        
          <div class="card bg-secondary border-0">
         
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Sign up with credentials</small>
              </div>
        
              
              <form role="form" method="post">
                  
       
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="Username" type="text" name="username">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="email">
                  </div>
                </div>
                  <div class="form-group">
                  
                  
                          <div class="input-group input-group-merge">
                              <div class="input-group input-group-merge input-group-alternative">
                                   <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                  
                                <input class="form-control" placeholder="Password" type="password" name="password" id="myInput">
                              
                                      <div class="input-group-append">
                                    <span class="input-group-text" onclick="myFunction()">  <i class="fas fa-eye"></i></span>
                                      </div>
                                      
                              </div>
                        </div>
                      
                </div>
                
                
                
                  <div class="form-group text-center">
                 
                  <div align="center" class="g-recaptcha" data-sitekey="6LcmTqMUAAAAAOkyjI6fVixDhp3gJ2taxjehZY1T"></div>
                
                </div>
                
              
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4" name="submit">Create account</button>
                </div>
                
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php 
          include "account/includes/login_register_footer.php";
  ?>
  <!-- Argon Scripts -->
  <!-- Core -->
  <!-- Argon Scripts -->
  <?php 
          include "account/includes/jquery.php";
    ?>
    <script>
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>
     <script src='https://www.google.com/recaptcha/api.js'></script>
</body>


</html>