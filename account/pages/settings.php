<?php
if(isset($_POST['update'])){

                                     $password = mysqli_real_escape_string($con, htmlspecialchars($_POST["old_password"]));
                            		 $n_password = mysqli_real_escape_string($con, htmlspecialchars($_POST["new_password"]));
                            		 
                            		 
					                    
  
   
                            		  if (empty($password) ||  empty($n_password) ) 
                            		  {
                	                    // Could not get the data that should have been sent.
                	
                                    	
                                                    
                                                        $error =   '<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>ERROR: Empty Fields, Both fields are required.</strong> 
                                                                        </div>  ';                                                 
                                        }
                                        elseif(strlen($password) < 6 || strlen($n_password) < 6)  //cal password length
                	                    {
            	                    
                                               $error =   '<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>ERROR: Password is too short, Must be More than 6 Charactors.</strong> 
                                                                        </div>  ';
                                                
                                    	}
                                    
                                    	else
                                    	{
                                    	    
                                    	    	$sql_prepare = 'SELECT password FROM taggers WHERE tagr_id = ? && username = ?';
                            					$stmt = $con->prepare($sql_prepare); 
                                               
                                                	// Bind parameters (s = string, i = int, b = blob, etc), in our case the u_id is a int && username is string so we use "is"
                                                	$stmt->bind_param('is', $_SESSION['tagr_id'],  $_SESSION['username']);
                                                	$stmt->execute();
                                              
                                                
                                                	$stmt->bind_result($user_old_password);
                                                     $json = array();
                                                     if($stmt->fetch()) {
                                                                $json = array('user_old_password'=>$user_old_password);
                                                                
                                                         
                                                            }
                                             
                            					$stmt->close();
                                    	    
                                    	    
  
                                                     if(password_verify($password, $json['user_old_password']))
                                                     {
                                                         
                                                               $encrypt_passwords = password_hash($n_password, PASSWORD_DEFAULT);
                                                     
                                                               $stmt = $con->prepare('UPDATE taggers SET password = ? WHERE tagr_id = ? && username = ?');
                                                                     
                                                                        	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                                                                        	$stmt->bind_param('sis', $encrypt_passwords, $_SESSION['tagr_id'], $_SESSION['username']);
                                                                        	$stmt->execute();
                                                                        	$stmt->close();
                                                            
                                                            if($stmt)
                                                            {
                                                               
                                                                    
                                                                  $success =   '<div class="alert alert-success">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Password Updated Successfully.</strong> 
                                                                        </div>  ';
                                                                    
                                                            }
                                                            else
                                                            {
                                                                
                                                                  $error =   '<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>ERROR: Password Update Fail!</strong> 
                                                                        </div>  ';
                                                                    
                                                            }
                                                            
                                                     }
                                                     else
                                                     {
                                                        
                                                                    
                                                                    $error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>ERROR: Your Old Password is incorrect.</strong> 
                                                                        </div>  ';
                                                     }
                                    	}
  

}

?>

</div>
</div>
</div>

<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(https://images.unsplash.com/photo-1548484352-ea579e5233a8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-2"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Profile Settings</h1>
            <p class="text-white mt-0 mb-5">This is your profile Settings page. You can update your passwords and other System settings.</p>
          
          </div>
        </div>
      </div>
      
    </div>
    
    
    
    <div class="container-fluid mt--6">
      <div class="row">
    
       
        <div class="col-xl-12 order-xl-1">
     <form method="post">
         
           <?php if(isset($error))
                  {
                      echo $error;
                  }
                else if(isset($success))
                  {
                      echo $success;
                  }
              ?>
         
          <div class="card">
            
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"><i class="fas fa-cogs"></i> Profile Settings</h3>
                </div>
                <div class="col-4 text-right">
                  <button type="submit" onclick="return confirm('Are you Sure you want to Update your Old Password?')"  class="btn btn-sm btn-info" name="update"><i class="fas fa-edit"></i> Set Password</button>
                </div>
              </div>
            </div>
            <div class="card-body">
            
                <h6 class="heading-small text-muted mb-4">Change Password</h6>
                
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Old Password</label>
                        <input type="password" class="form-control password"  name="old_password" >
                      </div>
                    </div>
                    
            
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">New Password</label>
                        <input type="password"  class="form-control password" name="new_password" >
                      </div>
                    </div>
                  </div>
               
 
              
                   <div class="form-group">
                        <div class="custom-control custom-checkbox mb-3">
                          <input class="custom-control-input "  id="invalidCheck" type="checkbox" value=""   onclick="myFunction()">
                          <label class="custom-control-label" for="invalidCheck">Show Password</label>
                         
                        </div>
                      </div>
               
                
                
                
    

                
                
                
                
              
           
           
            </div>
          </div>
       </form> 
       </div>
        
      </div>
   
    </div>
