<?php
      include("connection/connect.php");

      
       $get_ext_token = mysqli_real_escape_string($con, htmlspecialchars($_GET["token"]));
      
	if(!empty($get_ext_token))
	{
	
	
                		   //fetching token from user email address          
                                            $sql_prepare = 'SELECT token,cr_d FROM taggers Where token= ?';
                                            $stmt = $con->prepare($sql_prepare); 
                                            $stmt->bind_param('s', $get_ext_token);
                                            $stmt->execute();
                                            $stmt->bind_result($token,$cr_d);
                                            $stmt->fetch();
                                            $json = array();
                                            $json = array('token'=>$token,'join_date'=>$cr_d);
	







	  	if($json['token']==$get_ext_token) 
           	{
                            			    
	
                		 
                            $creation_date = $json['join_date']; //user creation date
                
                            //display the converted time added +4 hr
                            $expire_date = date('Y-m-d H:i',strtotime('+4 hour',strtotime($creation_date)));
                            //Times can be entered in a readable way:
                            
                            //+1 day = adds 1 day
                            //+1 hour = adds 1 hour
                            //+10 minutes = adds 10 minutes
                            //+10 seconds = adds 10 seconds
                            //To sub-tract time its the same except a - is used instead of a +
                            
                            
                             $now = date("Y-m-d H:i:s"); //current date_time
                            
                            
                        
                        if($now>$expire_date) {
                            //expired link
                            $error =  '<div class="alert alert-danger">  
                                                   <button type="button" class="close" data-dismiss="alert">×</button>  
                                                     <strong>Expired!</strong> token. For re-verification goto <a href="#">forget your password</a> Option. 
                                              </div> 
                                               <div style="color:#fff;" id="displayTimer"> </div>';
                             
                        }
                        else
                        { 
                            //still have a time out of 4hr
                           //  include("connection/connect.php");
                                                              $status = 1;
                                                        	$stmt->close();  //closing previous connection
                            			                      if($stmts = $con->prepare("UPDATE taggers SET status = ? WHERE token = ?"))
                                                                {
                                                                    $stmts->bind_param('is',$status,$json['token']);
                                                                    $stmts->execute();
                                                                    $stmts->close();
                                                                  
                                                                       $success =  '<div class="alert alert-success">  
                                                                                       <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                         <strong>Success!</strong> Verification Successful.
                                                                                         <div id="displayTimer"> </div>
                                                                                  </div> ';
                                                                   
                                                                }
                                                                else
                                                                {
                                                                     
                                                                        $error =  '<div class="alert alert-danger">  
                                                                                       <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                         <strong>ERROR!</strong> SQL ERROR OCCURED.
                                                                                  </div> 
                                                                                   <div style="color:#fff;" id="displayTimer"> </div>';
                                                                    }
                            			
                            			
                           
                        }
		 
		 
           	}
           else 
            {
              $error = ' <div class="alert alert-danger">  
                                                   <button type="button" class="close" data-dismiss="alert">×</button>  
                                                     <strong>Invalid Match!</strong> token not matched. 
                                              </div>
                                               <div style="color:#fff;" id="displayTimer"> </div>';
            }
         
	}
	else
	{
	   $error =  ' <div class="alert alert-warning">  
                                                   <button type="button" class="close" data-dismiss="alert">×</button>  
                                                     <strong>404!</strong> token not Found. 
                                                   
                                              </div>
                                              <div style="color:#fff;" id="displayTimer"> </div> ';
                                              
	}
	
	
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Verification</title>
    
  <?php 
          include "account/includes/head.php";
  ?>
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
            <div class="col-xl-10 col-lg-6 col-md-8 px-5">
            
              <?php
                  echo	$error.$success
                  
                  ?>                                             
              <p class="text-lead text-white">Click the below button in case if you don't redirected.</p>
              <div class="text-center">
                  <a href="https://paypertag.tk/login" class="btn btn-default mt-2" >click here</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      </div>
  
  

  
<!-- Argon Scripts -->
  <?php 
          include "account/includes/jquery.php";
    ?> 
    
                                                      <script>
                                                        
                                                    /* Countdown seconds */
                                                        var count = 8;
                                                        /* Website to redirect */
                                                        var url = "https://paypertag.tk/login";
                                                        /* Call function at specific intervals */
                                                        var countdown = setInterval(function() { 
                                                            /* Display Countdown with txt */
                                                            $("#displayTimer").text("Redirection in: " + count-- + " seconds");
                                                            
                                                            /* If count is smaller than 0 ...*/
                                                            if (count < 0) {
                                                                $("#displayTimer").text("Redirecting now....");
                                                                /* Clear timer set with setInterval */
                                                                clearInterval(countdown);
                                                                /* Redirect */
                                                                $(location).attr("href", url);
                                                           } 
                                                            // milliseconds
                                                        }, 1000);
                                                        
                                                    </script>
</body>
</html>