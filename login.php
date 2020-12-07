<?php
include "connection/connect.php";
session_start();

if(!empty($_SESSION["loggedin"]) && $_SESSION['status']==1)
{
    sleep(1);
    
      if($_SESSION['tagr_type']==1)
       {
	    header("Location:account/dashboard?page=home" );
        exit(); 
       }else if($_SESSION['tagr_type']==2)
       {
           header("Location:account/dashpanel?p=home" );
           exit(); 
       }
}
else if(!empty($_COOKIE['tagger_username']) && !empty($_COOKIE['tagger_pass_salt']))
{
	   
	$_SESSION['loggedin'] = $_COOKIE['loggedin'];
	$_SESSION['status'] = $_COOKIE['status'] ;
	$_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['tagr_id'] = $_COOKIE['tagr_id'];
    $_SESSION['tagr_type'] = $_COOKIE['tagr_type']; 
	   
	ob_end_flush();   
    
   
       if($_SESSION['tagr_type']==1)
       {
	    header("Location:account/dashboard?page=home" );
        exit(); 
       }else if($_SESSION['tagr_type']==2)
       {
           header("Location:account/dashpanel?p=home" );
           exit(); 
       }
}
else
{	      
   			
                if (isset($_POST['login']))
                {
                        	$login = mysqli_real_escape_string($con, htmlspecialchars($_POST["email_username"]));
                			$password = mysqli_real_escape_string($con, htmlspecialchars($_POST["password"]));
                			
                // Now we check if the data from the login form was submitted, isset() will check if the data exists.
                if (empty($login) ||  empty($password) ) {
                	// Could not get the data that should have been sent.
                	
                		$error = ' <div class="alert alert-danger">  
                                     <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Empty Fields!</strong> Please fill both the username and password field!. 
                                                                                    </div>  ';
                }
                
                // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
                  else  if ($stmt = $con->prepare('SELECT tagr_id, tagr_type, username, password, status FROM taggers WHERE ( username = ? OR email = ?)') ) 
                  
                    {
                    	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                    	$stmt->bind_param('ss', $login,$login);
                    	$stmt->execute();
                    	// Store the result so we can check if the account exists in the database.
                    	$stmt->store_result();
                    	
                    	
                    	
                    	if ($stmt->num_rows > 0) 
                    	{
                    	$stmt->bind_result($tagr_id, $tagr_type, $username, $hashed_password, $status);
                    	$stmt->fetch();
                    	// Account exists, now we verify the password.
                    	// Note: remember to use password_hash in your registration file to store the hashed passwords.
                    	
                            	if (password_verify($password, $hashed_password))
                            	{
                            		// Verification success! User has loggedin!
                            		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
                            	
                                		if($status==1)
                                		{
                                		    session_regenerate_id();
                                    		$_SESSION['loggedin'] = TRUE;
                                    		$_SESSION['status'] = $status;
                                    		$_SESSION['username'] = $username;
                                    	    $_SESSION['tagr_id'] = $tagr_id;
                                    	    $_SESSION['tagr_type'] = $tagr_type;
                                    	    
                                                      
                                                          if(isset($_POST['rememberme']) && $_POST['rememberme']=='1')
                                                          {
                                                				setcookie("tagger_username", $username, time() + (86400 * 30)); 
                                                				setcookie("tagger_pass_salt", $hashed_password, time() + (86400 * 30)); 
                                                				
                                                				setcookie("loggedin", $_SESSION['loggedin'], time() + (86400 * 30)); 
                                                				setcookie("loggedin", $_SESSION['loggedin'], time() + (86400 * 30)); 
                                                				setcookie("status", $_SESSION['status'], time() + (86400 * 30)); 
                                                				setcookie("username", $_SESSION['username'], time() + (86400 * 30)); 
                                                				setcookie("tagr_id", $_SESSION['tagr_id'], time() + (86400 * 30)); 
                                                				setcookie("tagr_type", $_SESSION['tagr_type'], time() + (86400 * 30)); 
                                                          }
                                                          
                                                          
                                                          
                                                       if($tagr_type==1)
                                                       {
                                                	    header("Location:account/dashboard?page=home" );
                                                        exit(); 
                                                       }else if($tagr_type==2)
                                                       {
                                                           header("Location:account/dashpanel?p=home" );
                                                           exit(); 
                                                       }
                                             
                                             
                                             
                                		}
                                		elseif($status==2)
                                		{
                                		    	$error =   	'<div class="alert alert-danger">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                            <strong> Account Suspended!</strong> Your account is Blocked by Adminstrator. 
                                                                            </div>  ';
                                		}
                                		else
                                		{
                                		    	$error =   	'<div class="alert alert-danger">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>In-Active Account!</strong> check your email for further information 
                                                                            OR re-send verification link using <a href="https://paypertag.tk/password_reset">forgot password</a>. 
                                                                            </div>  ';
                                		}
                            		
                               
                                      
                                      
                                      
                                      
                            	
                            	} 
                            	else {
                            		$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Incorrect password!</strong> password dosnt seems to be valid. 
                                                                        </div>  ';
                            	}
                        } 
                    else {
                    	$error = ' <div class="alert alert-danger">  
                                                                                        <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Incorrect username or email!</strong> username or email dosnt seems to be valid. 
                                                                                    </div>  ';
                        }
                    $stmt->close();
                    	
                    	
                    }
                }

?>

<!DOCTYPE html>
<html>

<head>
  
  <?php 
          include "account/includes/head.php";
  ?>
      
      <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148576223-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-148576223-1');
    </script>
    </head>

<body class="bg-default">
  
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
              <h1 class="text-white">Welcome Tagger!</h1>
              <p class="text-lead text-white">Enter your credentials to login Tagger Account.</p>
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
            <?php echo $error;  	 ?>
          <div class="card bg-secondary border-0 mb-0">
            
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Sign in with credentials</small>
              </div>
              
              
              <form role="form" method="post">
                  
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email or Username" type="text" name="email_username">
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
                
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="rememberme" value="1">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4" name="login">Sign in</button>
                </div>
                
              </form>
              
              
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="password_reset" class="text-light"><small>Forgot password?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="signup" class="text-light"><small>Create new account</small></a>
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
</body>
</html>
<?php
}?>