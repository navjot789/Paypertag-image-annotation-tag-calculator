<?php
include "../connection/connect.php";
session_start();

if(!empty($_SESSION["adm_loggedin"]) && $_SESSION['adm_id'] !==0)
{
    sleep(1);
    header("Location:dashboard.php" );
	exit();
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
                          else  if ($stmt = $con->prepare('SELECT adm_id, username, password FROM administrator WHERE ( username = ? OR email = ?)') ) 
                          
                            {
                            	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                            	$stmt->bind_param('ss', $login,$login);
                            	$stmt->execute();
                            	// Store the result so we can check if the account exists in the database.
                            	$stmt->store_result();
                            	
                            	
                            	
                            	if ($stmt->num_rows > 0) 
                            	{
                            	$stmt->bind_result($adm_id, $username, $hashed_password);
                            	$stmt->fetch();
                            	// Account exists, now we verify the password.
                            	// Note: remember to use password_hash in your registration file to store the hashed passwords.
                            	
                                    	if (password_verify($password, $hashed_password))
                                    	{
                                    		// Verification success! User has loggedin!
                                    		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
                                    	
                                        	
                                                		    session_regenerate_id();
                                                    		$_SESSION['adm_loggedin'] = TRUE;
                                                    	    $_SESSION['adm_username'] = $username;
                                                    	    $_SESSION['adm_id'] = $adm_id;
                                                    	  
                                                    	     
                                                    	    header("Location:dashboard.php" );
                                                            exit(); 
                                                             
                                                		
                                            	
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
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Adminstrator Login</title>

	<!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/paper-dashboard-pro"/>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


     <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/main.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
              
                <a class="navbar-brand" href="https://paypertag.tk"><image src="https://paypertag.tk/images/ppt.png" style="height: 50px;width: 200px;" ></a>
            </div>
          
        </div>
    </nav>
        <?php
        $my_array = array("blue","azure","orange","green","red","purple");
        shuffle($my_array);
        ?>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="<?php echo $my_array[0]; ?>" data-image="assets/img/background/background-2.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" style="margin-top :40px;">
                            <?php if(isset($error))
                        { echo $error;}?>
                            <form method="post" >
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="card-header">
                                        <h3 class="card-title text-center">Admin Login</h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="form-group">
                                            <label>Email address or username</label>
                                            <input type="text" placeholder="Enter email" class="form-control input-no-border" name="email_username">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label> 
                                            <input type="password" placeholder="Password" class="form-control input-no-border" name="password">
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-fill btn-wd " name="login">Let's go</button>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        	<footer class="footer footer-transparent">
                <div class="container">
                    <div class="copyright">
                        &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="https://paypertag.tk">Paypertag.tk</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>


	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

	<script type="text/javascript">
        $().ready(function(){
            demo.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
	</script>


</html>
<?php

}?>