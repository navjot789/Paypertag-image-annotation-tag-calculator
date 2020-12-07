<?php
 ////////////////////phpmailer Starts///////////////////// 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require './inc/phpmailer/src/Exception.php';
    require './inc/phpmailer/src/PHPMailer.php';
    require './inc/phpmailer/src/SMTP.php';
   ////////////////////phpmailer ends///////////////////// 

session_start();
include "connection/connect.php";
 $get_ext_token = mysqli_real_escape_string($con, htmlspecialchars($_GET["external_token"]));
      
	if(!empty($get_ext_token))
	{
	
	
                		 
                		   
                		   $stmts = $con->prepare('SELECT username,token,status,upd_d FROM taggers WHERE token = ?');
                                		    $stmts->bind_param('s', $get_ext_token);
                                        	$stmts->execute();
                                        	
                                        	$stmts->bind_result($username,$ext_token_fetch,$status,$date);
                                            $json = array();
                                             
                                        if($stmts->fetch()) 
                                         {
                                            $json = array('username'=>$username,'token'=>$ext_token_fetch,'status'=>$status,'password_updation_date'=>$date);
                                    
                                            }
                                        	
                                     
                		   
                		   
	
	
	  	if($json['token']==$get_ext_token) 
           	{
                            			    
	
                		 
                            $creation_date = $json['password_updation_date']; //user creation date
                
                            //display the converted time added +3 hr
                            $expire_date = date('Y-m-d H:i',strtotime('+3 hour',strtotime($creation_date)));
                            //Times can be entered in a readable way:
                            
                            //+1 day = adds 1 day
                            //+1 hour = adds 1 hour
                            //+10 minutes = adds 10 minutes
                            //+10 seconds = adds 10 seconds
                            //To sub-tract time its the same except a - is used instead of a +
                            
                            
                             $now = date("Y-m-d H:i:s"); //current date_time
                            
                            
                        
                        if($now>$expire_date) {
                            //expired link
                            
                             header('location:https://ahref.tech/confirm/5'); 
                             
                              
                        }
                        else
                        {
                            //still have a time out of 3hr
                            //showing user password change form
                                  
                            	  	     $password = mysqli_real_escape_string($con, htmlspecialchars($_POST["password"]));
                            	    	 $c_password = mysqli_real_escape_string($con, htmlspecialchars($_POST["c_password"]));
                            		 
                            		if(isset($_POST["password_submit"]))
                            		{
                            		  
                            		 
                            		  
                                                    		  if (empty($password) ||  empty($c_password) ) 
                                                    		  {
                                        	                    // Could not get the data that should have been sent.
                                        	
                                                            		$error = ' <div class="alert alert-danger">  
                                                                                 <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                                    <strong>Empty Fields!</strong> Both fields cannot be empty. 
                                                                                                                                </div>  ';
                                                                }
                                                                elseif(strlen($password) < 6 || strlen($c_password) < 6)  //cal password length
                                        	                    {
                                    	
                                                                 $error='    <div class="alert alert-danger">  
                                                                                                                <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                <strong>Opps!</strong> Password is too short, Must be More than 6 Charactors. 
                                                                                                            </div>  ';	    
                                    		
                                                            	}
                                                            	elseif($password !== $c_password)
                                                            	{
                                                            	       $error='    <div class="alert alert-danger">  
                                                                                                                <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                <strong>Miss-match!</strong> Password confirmation doesnt match the password. 
                                                                                                            </div>  ';	    
                                                            	}
                                                            	else
                                                            	{
                                                            	        
                                                            	    if($status!==2)
                                                            	    {
                                                            	    
                                                            	         $con = mysqli_connect("localhost","u871036354_pay","74587458","u871036354_pay");
                                                                         if (!$con)
                                                                          {
                                                                          die('Could not connect: ' . mysqli_error());
                                                                          }
                                                                         
                                                                	    $encrypt_password = password_hash($c_password, PASSWORD_DEFAULT);
                                                                        $sql = mysqli_query($con,'UPDATE taggers SET status=1, password ="'.$encrypt_password.'" WHERE token = "'.$get_ext_token.'"');
                                                               
                                                                
                                                                                if($sql)
                                                                                {
                                                                                   $success='    <div class="alert alert-success text-center">  
                                                                                                                <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                <strong>Password Changed!</strong> update successfully. 
                                                                                                            </div>  ';	   
                                                                                    
                                                                                }
                                                                                else
                                                                                {
                                                                                     $error='    <div class="alert alert-danger text-center">  
                                                                                                                <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                <strong>SQL ERROR:</strong> Contact developer. 
                                                                                                            </div>  ';	    
                                                                                }
                                                            	    }else
                                                            	    {
                                                            	           $error='    <div class="alert alert-danger text-center">  
                                                                                                                <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                <strong>Account Suspended</strong>, Cannot change the Password. 
                                                                                                            </div>  ';	   
                                                            	    }
                                                                                
                                                                        
                                                            	}
                                    	
                            		  
                               		                          
                                                }
                            		
                            		
                            		
                            		
                            		
                            			
    		$password_changer_form	= '<!-- Main content -->
                                                      <div class="main-content">
                                                        <!-- Header -->
                                                        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
                                                          <div class="container">
                                                            <div class="header-body text-center  mb-4">
                                                              <div class="row justify-content-center">
                                                                <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                                                                  <h1 class="text-white">Reset your password</h1>
                                                                  <p class="text-lead text-white">Change password for @'.$json['username'].'</p>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="separator separator-bottom separator-skew zindex-100">
                                                            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                              <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                                                            </svg>
                                                          </div>
                                                        </div>
                                                        <!-- Page content -->
                                                        <div class="container mt--8 pb-5">
                                                          <div class="row justify-content-center">
                                                            <div class="col-lg-5 col-md-7">';
                                                            
                                                              	
                                                    			 if(isset($error))
                                                    			 {
                                                    			      echo $error; 
                                                    			 }
                                                    			 	 if(isset($success))
                                                    			 {
                                                    			      echo $success; 
                                                    			 }
                                                    			 
                                                    			 	 
                                                    			 	 
                                                              echo '<div class="card bg-secondary border-0 mb-0">
                                                                
                                                                <div class="card-body px-lg-5 py-lg-5">
                                                                  <div class="text-center text-muted mb-4">
                                                                    <small>Enter New Password</small>
                                                                  </div>
                                                                  
                                                                  
                                                                  <form role="form" method="post">
                                                                      
                                                                    <div class="form-group mb-3">
                                                                      <div class="input-group input-group-merge input-group-alternative">
                                                                        <div class="input-group-prepend">
                                                                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                                                        </div>
                                                                        <input class="form-control" placeholder="New password" name="password" type="text" >
                                                                      </div>
                                                                    </div>
                                                                    
                                                                     <div class="form-group mb-3">
                                                                      <div class="input-group input-group-merge input-group-alternative">
                                                                        <div class="input-group-prepend">
                                                                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                                                        </div>
                                                                        <input class="form-control"  placeholder=" Re-password" name="c_password" type="text" >
                                                                      </div>
                                                                    </div>
                                                                    
                                                                    <div class="text-center">
                                                                      <button type="submit" class="btn btn-primary my-4"  name="password_submit">Change Password</button>
                                                                    </div>
                                                                    
                                                                  </form>
                                                                  
                                                                  <p class="info-row">
                                                					<span>Once done,</span>
                                                					<a href="https://paypertag.tk/login" class="register-link">Click Here</a> <span>to login.</span>
                                                				</p>
                                                                </div>
                                                              </div>
                                                             
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>';
                                            
                                            
                                            
                            		
                            		
                           
                        }
		 
		
           	}
           else 
            {
                 header('location:https://ahref.tech/confirm/3');  //token not matched
            }
          	
	}
	else
	{
	
	      
   			
                if (isset($_POST['submit']))
                {
                        	$email = $_POST['email'];
                	
                // Now we check if the data from the entered email in the form was submitted, isset() will check if the data exists.
                if (empty($email) ) {
                	// Could not get the data that should have been sent.
                	
                		$error = ' <div class="alert alert-danger">  
                                     <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Empty Fields!</strong> Please enter your email. 
                                                                                    </div>  ';
                }
                
                // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
                  else  if ($stmt = $con->prepare('SELECT email FROM taggers WHERE email = ?') ) 
                  
                    {
                    	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                    	$stmt->bind_param('s', $email);
                    	$stmt->execute();
                    	// Store the result so we can check if the account exists in the database.
                    	$stmt->store_result();
                    	
                    	
                    	if ($stmt->num_rows > 0) 
                    	{
                    	$stmt->bind_result($email_fetch);
                    	$stmt->fetch();
                    	// Account exists
                    
                    	
                            	
                            	if(!empty($email_fetch))
                                {   
                                    //updating token
                                            $now = date("Y-m-d H:i:s");
                                            $token =  md5(uniqid(rand(), TRUE));
                                		    $stmt = $con->prepare('UPDATE taggers SET token = ?,upd_d = ? WHERE email = ?');
                                		    $stmt->bind_param('sss', $token,$now,$email_fetch);
                                        	$stmt->execute();
                                		    $stmt->close();
                                		    
                                	  //fetching token
                                	  
                                		    $stmts = $con->prepare('SELECT token FROM taggers WHERE token = ?');
                                		    $stmts->bind_param('s', $token);
                                        	$stmts->execute();
                                        	
                                        	$stmts->bind_result($token);
                                            $json = array();
                                             
                                        if($stmts->fetch()) 
                                         {
                                            $json = array('token'=>$token);
                                    
                                            }
                                        	
                                    
                                             $token_id = $json['token'];
                                             $link="https://$_SERVER[HTTP_HOST]"."/password_reset/" .$token_id;
                                             
                                                $toEmail = $email_fetch;
                                                
                                                
                                                include "inc/pass_reset_email_content.php";
                                             
                                           
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
                                                                        $mail->Subject = '[Paypertag] Rest your Password';
                                                                        $mail->msgHTML($content);
                                                                        $mail->send();
                                                
                                              
                                             
                                             
                                		     $stmts->close();
                                		    
                                }
                            		
                               
                                    $success = ' <div class="alert alert-success">  
                                                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Done</strong> Check your email for a link to reset your password. If it doesn’t appear within a few minutes, check your spam folder. 
                                                                                    </div>  ';  
                                      
                                      
                            	
                            
                        } 
                    else {
                    	$error = ' <div class="alert alert-danger">  
                                                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Invalid email! </strong> sorry we cant find that email. 
                                                                                    </div>  ';
                        }
                    $stmt->close();
                    	
                    	
                    }
                }


}
?>


<!DOCTYPE html>
<html>

<head>
  <title>Password Reset</title>
  <?php 
          include "account/includes/head.php";
  ?>
</head>

<body class="bg-default">
 <?php
	if(empty($get_ext_token))
	{
?> 


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
              <h1 class="text-white">Reset your password</h1>
              <p class="text-lead text-white">We will send you a link to reset your password.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          	 <?php
			 if(isset($error))
			 {
			      echo $error; 
			 }
			 	 if(isset($success))
			 {
			      echo $success; 
			 }
			 	 ?>
			 	 
			 	 
          <div class="card bg-secondary border-0 mb-0">
            
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>To reset your password, enter email address you use to sign in</small>
              </div>
              
              
              <form role="form" method="post">
                  
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Enter your Email Address" type="text" name="email">
                  </div>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4" name="submit">Send password reset email</button>
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
  
 
    
    
    
    
    <?php
}
else
{
   if($json['token']==$get_ext_token)
   {
        
    echo $password_changer_form;
   }
}
?>


 
  <!-- Argon Scripts -->
  <?php 
          include "account/includes/jquery.php";
    ?>

 
</body>
</html>
