</div>
</div>
</div>
<?php         
                            
   


                $sqlFetch=mysqli_query($con, 'SELECT * FROM taggers_details WHERE tagr_id = "'.$_SESSION['tagr_id'].'" ');
                 $detail = mysqli_fetch_assoc($sqlFetch);
                 
                

            if(isset($_POST['update']))
            { 
                 $firstname =mysqli_real_escape_string($con,htmlspecialchars($_POST['first_name']));
                 $lastname =mysqli_real_escape_string($con,htmlspecialchars($_POST['last_name']));
                 $rank =mysqli_real_escape_string($con,htmlspecialchars($_POST['rank']));
                 $address =mysqli_real_escape_string($con,htmlspecialchars($_POST['address']));
                 $phone =mysqli_real_escape_string($con,htmlspecialchars($_POST['contact']));
                 $bank_branch =mysqli_real_escape_string($con,htmlspecialchars($_POST['bank_branch']));
                 $holder_name =mysqli_real_escape_string($con,htmlspecialchars($_POST['holder_name']));
                 $account_no =mysqli_real_escape_string($con,htmlspecialchars($_POST['account_no']));
                 $ifsc =mysqli_real_escape_string($con,htmlspecialchars($_POST['ifsc']));
                
               
                 
                if(mysqli_num_rows($sqlFetch) > 0) 
                {
                     if(empty($firstname) || empty($lastname) || empty($rank) ||
                                     empty($address) || empty($phone) || empty($bank_branch) ||
                                   empty($holder_name) || empty($account_no) || empty($ifsc))
                                    {
                                       
                                        	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>All Fields Required</strong> Seems like you forget to add something! 
                                                                        </div>  ';
                                    }
                                
                                else
                                {
                                    
                                     if( $firstname !== str_replace(' ','',$firstname) || ctype_digit($firstname) || $lastname !== str_replace(' ','',$lastname) || ctype_digit($lastname)){
                                      
                                       
                                       	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Invalid First OR Last Name</strong> Check your first and Last name and try again. 
                                                                        </div>  ';
                            
                                    }
                                    else if(strlen($phone) <= '9' || strlen($phone) >= '11') {
                                        
                                           
                                             	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Invalid Phone Number</strong> Enter your valid Contact Number try again. 
                                                                        </div>  ';
                                    }
                                    else if(!ctype_digit($phone))
                                    {
                                      
                                             	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>String Detected!</strong> Phone Number Cannot be converted into string. 
                                                                        </div>  ';
                                         
                                    }
                                     else if(!ctype_digit($account_no))
                                    {
                                        
                                         
                                         	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>String Detected!</strong> Account Number Cannot be converted into string. 
                                                                        </div>  ';
                                    }
                                   else if(!strpos(trim($holder_name), ' ') !== false){
                                       
                                         	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Invalid Account Holder Name</strong> Must be include First and Last name. 
                                                                        </div>  ';
                                      
                                    }
                                   else{
                    
                                               $sqlUpdate= 'UPDATE taggers_details SET f_name= ?, l_name= ?, work_as= ?, address= ?, phone= ?, branch= ?, acc_h_name= ?, acc_no= ?, ifsc_code= ?, up_d=? WHERE tagr_id = "'.$_SESSION['tagr_id'].'" ';
                                               
                                                 $stmt = $con->prepare($sqlUpdate); 
                                                  $stmt->bind_param('ssssssssss',$firstname,
                                                                                $lastname,$rank,$address,
                                                                                $phone,$bank_branch,strtoupper($holder_name),
                                                                                $account_no,$ifsc,$current_date);
                                                 $stmt->execute();
                                                 $stmt->close();
                                                 
                                                 header('location:dashboard?page=profile&s=2'); //for refreshing the page after update
                                                 exit();
                                            
                          }         }
                    
                } else {
                    
                    
                    
                                  if(empty($firstname) || empty($lastname) || empty($rank) ||
                                     empty($address) || empty($phone) || empty($bank_branch) ||
                                   empty($holder_name) || empty($account_no) || empty($ifsc))
                                    {
                                       
                                        
                                        	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>All Fields Required</strong> Seems like you forget to add something! 
                                                                        </div>  ';
                            
                                        
                                    }
                                
                                else
                                {
                                   
                                    if( $firstname !== str_replace(' ','',$firstname) || ctype_digit($firstname) || $lastname !== str_replace(' ','',$lastname) || ctype_digit($lastname)){
                                      
                                       
                                       	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Invalid First OR Last Name</strong> Check your first and Last name and try again. 
                                                                        </div>  ';
                            
                                    }
                                    else if(strlen($phone) <= '9' || strlen($phone) >= '11') {
                                        
                                           
                                             	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Invalid Phone Number</strong> Enter your valid Contact Number try again. 
                                                                        </div>  ';
                                    }
                                    else if(!ctype_digit($phone))
                                    {
                                      
                                             	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>String Detected!</strong> Phone Number Cannot be converted into string. 
                                                                        </div>  ';
                                         
                                    }
                                     else if(!ctype_digit($account_no))
                                    {
                                        
                                         
                                         	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>String Detected!</strong> Account Number Cannot be converted into string. 
                                                                        </div>  ';
                                    }
                                   else if(!strpos(trim($holder_name), ' ') !== false){
                                       
                                         	$error =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Invalid Account Holder Name</strong> Must be include First and Last name. 
                                                                        </div>  ';
                                      
                                    }
                                   else{
                                     
                                                $sqlInsert='insert into taggers_details(tagr_id,f_name,l_name,work_as,address,phone,branch,acc_h_name,acc_no,ifsc_code,cr_d) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
                                                $stmt = $con->prepare($sqlInsert); 
                                                                            
                                                 $stmt->bind_param('issssssssss',$_SESSION['tagr_id'],$firstname,
                                                                    $lastname,$rank,$address,
                                                                    $phone,$bank_branch,strtoupper($holder_name),
                                                                    $account_no,$ifsc,$current_date);
                                                 
                                                 $stmt->execute();
                                                 $stmt->close();
                                                 
                                                    
                                                         header('location:dashboard?page=profile&s=1'); //for refreshing the page after update
                                                         exit();
                                                         
                                                     
                                                         
                                    }
                                 
                                }
                  }                                                
                                                                                     
            }                                       
                                                                     
                   
  
  
                            ?>

<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(https://images.unsplash.com/photo-1472554117599-50e86139f312?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1051&q=80); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-2"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello <?php 
                                                       
                                                       if(!empty($detail['f_name']) && !empty($detail['l_name']) )
                                                       {
                                                           echo $detail['f_name'].' '.$detail['l_name'];
                                                       }else
                                                       {
                                                             echo $_SESSION['username'];
                                                       }
                                                     
                                                        ?>
                                                        </h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
          
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
                  else if($_GET['s']==1){
                      
                      echo $success ='<div class="alert alert-success">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Details inserted successfully</strong> you can modify it anytime. 
                                                                        </div>  '; 
                  }
                  else if($_GET['s']==2){
                      
                      echo $success ='<div class="alert alert-success">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Account Details updated</strong> you can modify it anytime. 
                                                                        </div>  '; 
                  }
              ?>
         
          <div class="card">
            
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"><i class="fas fa-user-edit"></i> Edit profile </h3>
                </div>
                <div class="col-4 text-right">
                  <button type="submit" onclick="return confirm('This infomation is used to verify USER IDENTITY and for payment procedure perposes. if you are not comfortable with this action you can easily revoke. Click ok to proceed futher')"  class="btn btn-sm btn-info" name="update"><i class="fas fa-edit"></i> update</button>
                </div>
              </div>
            </div>
            <div class="card-body">
            
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" class="form-control"  placeholder="<?php echo $_SESSION['username'];?>" disabled>
                      </div>
                    </div>
                    
                    <?php
                    $sql_fetch_email =mysqli_query($con, 'SELECT email FROM taggers WHERE tagr_id = "'.$_SESSION['tagr_id'].'" ');
                    $email = mysqli_fetch_assoc($sql_fetch_email);
                    
                    ?>
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email"  class="form-control" placeholder="<?php echo $email['email']; ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" class="form-control" placeholder="First name" value="<?php echo $detail['f_name']; ?>" name="first_name">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text"  class="form-control" placeholder="Last name"  value="<?php echo $detail['l_name']; ?>"  name="last_name">
                      </div>
                    </div>
                  </div>
                </div>
                
                
                <hr class="my-4">
                <!-- rank -->
                <h6 class="heading-small text-muted mb-4">Position</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                        
                  <div class="form-group">
                    <label class="form-control-label" for="exampleFormControlSelect1">Work As</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="rank">
                      <option value="Tagger">Tagger</option>
                      <option value="HR" disabled>HR Manager</option>
                      <option value="Founder" disabled>Founder</option>
                      <option value="Developer" disabled>Developer</option>
                    </select>
                  </div>
                      
                       </div>
                       
                    
                  </div>
          
                </div>
                
                
                
                
                
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-6">
                        
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                       <div class="input-group input-group-merge">
                          <input class="form-control" placeholder="Location" type="text" name="address" value="<?php echo $detail['address']; ?>">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                          </div>
                        </div>
                      </div>
                      
                       </div>
                       
                      <div class="col-md-6"> 
                      <div class="form-group">
                          <label class="form-control-label" for="input-address">Phone</label>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                          </div>
                          <input class="form-control" placeholder="Phone number" type="phone" name="contact" value="<?php echo $detail['phone']; ?>">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
          
                </div>
                <hr class="my-4">
                <!-- bank info -->
                <h6 class="heading-small text-muted mb-4">Bank Information</h6>
                  <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Bank Branch Name</label>
                         <div class="input-group input-group-merge">
                          <input class="form-control" placeholder="ex: SBI, PNB etc" type="text" name="bank_branch" value="<?php echo $detail['branch']; ?>">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Full Account Holder Name</label>
                        <div class="input-group input-group-merge">
                          <input class="form-control" placeholder="jon doe" type="text" name="holder_name" value="<?php echo $detail['acc_h_name']; ?>">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-user"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                        
                     
                      
                      <div class="form-group">
                             <label class="form-control-label" for="input-country">Account Number</label>
                        <div class="input-group input-group-merge">
                         
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                          </div>
                          
                        
                          <input class="form-control" value="<?php echo $detail['acc_no'] ?>" placeholder= "Account Number" type="text" name="account_no" >
                          
                          
                          <div class="input-group-append">
                            <span class="input-group-text"><small class="font-weight-bold">INR</small></span>
                          </div>
                        </div>
                      </div>
                      
                      
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">IFSC Code</label>
                        
                       <div class="input-group input-group-merge">
                        
                          <input class="form-control" placeholder="IFSC code" type="text" name="ifsc" value="<?php echo $detail['ifsc_code']; ?>">
                          <div class="input-group-append">
                            <span class="input-group-text"><small class="font-weight-bold">IFSC</small></span>
                          </div>
                          
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
           
            </div>
          </div>
       </form> </div>
        
      </div>
   
    </div>