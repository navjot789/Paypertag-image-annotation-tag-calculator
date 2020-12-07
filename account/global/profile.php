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
                 $prefered_curr =mysqli_real_escape_string($con,htmlspecialchars($_POST['curr']));
               
               
                 
                if(mysqli_num_rows($sqlFetch) > 0) 
                {
                     if(empty($firstname) || empty($lastname) || empty($rank) || empty($prefered_curr))
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
                              
                                   
                                   else{
                    
                                               $sqlUpdate= 'UPDATE taggers_details SET f_name= ?, l_name= ?, work_as= ?, currency_code=?, up_d=? WHERE tagr_id = "'.$_SESSION['tagr_id'].'" ';
                                               
                                                 $stmt = $con->prepare($sqlUpdate); 
                                                  $stmt->bind_param('sssss',$firstname,$lastname,$rank,$prefered_curr,$current_date);
                                                
                                                if($stmt->execute())
                                                 {
                                                     
                                                 header('location:dashpanel?p=profile&s=2'); 
                                                 exit();
                                                 
                                                 }
                                                
                                                 $stmt->close();     
                          }         }
                    
                } 
                else {
                                  if(empty($firstname) || empty($lastname) || empty($rank) || empty($prefered_curr))
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
                                  
                                   else{
                                     
                            
                                                $sqlInsert='insert into taggers_details(tagr_id,f_name,l_name,work_as,currency_code,cr_d) values(?, ?, ?, ?, ?, ?)';
                                                $stmt = $con->prepare($sqlInsert); 
                                                $stmt->bind_param('isssss',$_SESSION['tagr_id'],$firstname,$lastname,$rank,$prefered_curr,$current_date);
                                                 
                                                 if($stmt->execute())
                                                 {
                                                       header('location:dashpanel?p=profile&s=1'); //for refreshing the page after update
                                                      exit();
                                                 }
                                                
                                                 $stmt->close();     
                                                         
                                    }
                                   
                                    
                                 
                                }
                  }                                                
                                                                                     
            }                                       
                                                                     
           
 if(isset($_POST['update_pass'])){

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
                  else if(isset($success))
                  {
                      echo $success;
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
                <!-- rank -->
                <h6 class="heading-small text-muted mb-4">Setup Your Native Currency</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                        
                  <div class="form-group">
                    <label class="form-control-label" for="exampleFormControlSelect1">Set as</label>
                     <select class="form-control" id="exampleFormControlSelect1" name="curr">
                           <?php
                          
                           ?>
              
                                  <option value="AED" <?php if($detail['currency_code'] == 'AED') echo 'selected="selected"'; ?> >AED</option>
                                  
                                  <option value="AFN" <?php if($detail['currency_code'] == 'AFN') echo 'selected="selected"'; ?>>AFN</option>
                                  
                                  <option value="ALL" <?php if($detail['currency_code'] == 'ALL') echo 'selected="selected"'; ?>>ALL</option>
                                  
                                  <option value="AMD" <?php if($detail['currency_code'] == 'AMD') echo 'selected="selected"'; ?>>AMD</option>
                                  
                                  <option value="ANG" <?php if($detail['currency_code'] == 'ANG') echo 'selected="selected"'; ?>>ANG</option>
                                  
                                  <option value="AOA" <?php if($detail['currency_code'] == 'AOA') echo 'selected="selected"'; ?>>AOA</option>
                                  
                                  <option value="ARS" <?php if($detail['currency_code'] == 'ARS') echo 'selected="selected"'; ?>>ARS</option>
                                  
                                  <option value="AUD" <?php if($detail['currency_code'] == 'AUD') echo 'selected="selected"'; ?>>AUD</option>
                                  
                                  <option value="AWG" <?php if($detail['currency_code'] == 'AWG') echo 'selected="selected"'; ?>>AWG</option>
                                  
                                  <option value="AZN" <?php if($detail['currency_code'] == 'AZN') echo 'selected="selected"'; ?>>AZN</option>
                                  
                                  <option value="BAM" <?php if($detail['currency_code'] == 'BAM') echo 'selected="selected"'; ?>>BAM</option>
                                  
                                  <option value="BBD" <?php if($detail['currency_code'] == 'BBD') echo 'selected="selected"'; ?>>BBD</option>
                                  
                                  <option value="BDT" <?php if($detail['currency_code'] == 'BDT') echo 'selected="selected"'; ?>>BDT</option>
                                  
                                  <option value="BGN" <?php if($detail['currency_code'] == 'BGN') echo 'selected="selected"'; ?>>BGN</option>
                                  
                                  <option value="BHD" <?php if($detail['currency_code'] == 'BHD') echo 'selected="selected"'; ?>>BHD</option>
                                  
                                  <option value="BIF" <?php if($detail['currency_code'] == 'BIF') echo 'selected="selected"'; ?>>BIF</option>
                                  
                                  <option value="BMD" <?php if($detail['currency_code'] == 'BMD') echo 'selected="selected"'; ?>>BMD</option>
                                  
                                  <option value="BND" <?php if($detail['currency_code'] == 'BND') echo 'selected="selected"'; ?>>BND</option>
                                  
                                  <option value="BOB" <?php if($detail['currency_code'] == 'BOB') echo 'selected="selected"'; ?>>BOB</option>
                                  
                                  <option value="BRL" <?php if($detail['currency_code'] == 'BRL') echo 'selected="selected"'; ?>>BRL</option>
                                  
                                  <option value="BSD" <?php if($detail['currency_code'] == 'BSD') echo 'selected="selected"'; ?>>BSD</option>
                                  
                                  <option value="BTC" <?php if($detail['currency_code'] == 'BTC') echo 'selected="selected"'; ?>>BTC</option>
                                  
                                  <option value="BTN" <?php if($detail['currency_code'] == 'BTN') echo 'selected="selected"'; ?>>BTN</option>
                                  
                                  <option value="BWP" <?php if($detail['currency_code'] == 'BWP') echo 'selected="selected"'; ?>>BWP</option>
                                  
                                  <option value="BYN" <?php if($detail['currency_code'] == 'BYN') echo 'selected="selected"'; ?>>BYN</option>
                                  
                                  <option value="BYR" <?php if($detail['currency_code'] == 'BYR') echo 'selected="selected"'; ?>>BYR</option>
                                  
                                  <option value="BZD" <?php if($detail['currency_code'] == 'BZD') echo 'selected="selected"'; ?>>BZD</option>
                                  
                                  <option value="CAD" <?php if($detail['currency_code'] == 'CAD') echo 'selected="selected"'; ?>>CAD</option>
                                  
                                  <option value="CDF" <?php if($detail['currency_code'] == 'CDF') echo 'selected="selected"'; ?>>CDF</option>
                                  
                                  <option value="CHF" <?php if($detail['currency_code'] == 'CHF') echo 'selected="selected"'; ?>>CHF</option>
                                  
                                  <option value="CLF" <?php if($detail['currency_code'] == 'CLF') echo 'selected="selected"'; ?>>CLF</option>
                                  
                                  <option value="CLP" <?php if($detail['currency_code'] == 'CLP') echo 'selected="selected"'; ?>>CLP</option>
                                  
                                  <option value="CNY" <?php if($detail['currency_code'] == 'CNY') echo 'selected="selected"'; ?>>CNY</option>
                                  
                                  <option value="COP" <?php if($detail['currency_code'] == 'COP') echo 'selected="selected"'; ?>>COP</option>
                                  
                                  <option value="CRC" <?php if($detail['currency_code'] == 'CRC') echo 'selected="selected"'; ?>>CRC</option>
                                  
                                  <option value="CUC" <?php if($detail['currency_code'] == 'CUC') echo 'selected="selected"'; ?>>CUC</option>
                                  
                                  <option value="CUP" <?php if($detail['currency_code'] == 'CUP') echo 'selected="selected"'; ?>>CUP</option>
                                  
                                  <option value="CVE" <?php if($detail['currency_code'] == 'CVE') echo 'selected="selected"'; ?>>CVE</option>
                                  
                                  <option value="CZK" <?php if($detail['currency_code'] == 'CZK') echo 'selected="selected"'; ?>>CZK</option>
                                  
                                  <option value="DJF" <?php if($detail['currency_code'] == 'DJF') echo 'selected="selected"'; ?>>DJF</option>
                                  
                                  <option value="DKK" <?php if($detail['currency_code'] == 'DKK') echo 'selected="selected"'; ?>>DKK</option>
                                  
                                  <option value="DOP" <?php if($detail['currency_code'] == 'DOP') echo 'selected="selected"'; ?>>DOP</option>
                                  
                                  <option value="DZD" <?php if($detail['currency_code'] == 'DZD') echo 'selected="selected"'; ?>>DZD</option>
                                  
                                  <option value="EGP" <?php if($detail['currency_code'] == 'EGP') echo 'selected="selected"'; ?>>EGP</option>
                                  
                                  <option value="ERN" <?php if($detail['currency_code'] == 'ERN') echo 'selected="selected"'; ?>>ERN</option>
                                  
                                  <option value="ETB" <?php if($detail['currency_code'] == 'ETB') echo 'selected="selected"'; ?>>ETB</option>
                                  
                                  <option value="EUR" <?php if($detail['currency_code'] == 'EUR') echo 'selected="selected"'; ?>>EUR</option>
                                  
                                  <option value="FJD" <?php if($detail['currency_code'] == 'FJD') echo 'selected="selected"'; ?>>FJD</option>
                                  
                                  <option value="FKP" <?php if($detail['currency_code'] == 'FKP') echo 'selected="selected"'; ?>>FKP</option>
                                  
                                  <option value="GBP" <?php if($detail['currency_code'] == 'GBP') echo 'selected="selected"'; ?>>GBP</option>
                                  
                                  <option value="GEL" <?php if($detail['currency_code'] == 'GEL') echo 'selected="selected"'; ?>>GEL</option>
                                  
                                  <option value="GGP" <?php if($detail['currency_code'] == 'GGP') echo 'selected="selected"'; ?>>GGP</option>
                                  
                                  <option value="GHS" <?php if($detail['currency_code'] == 'GHS') echo 'selected="selected"'; ?>>GHS</option>
                                  
                                  <option value="GIP" <?php if($detail['currency_code'] == 'GIP') echo 'selected="selected"'; ?>>GIP</option>
                                  
                                  <option value="GMD" <?php if($detail['currency_code'] == 'GMD') echo 'selected="selected"'; ?>>GMD</option>
                                  
                                  <option value="GNF" <?php if($detail['currency_code'] == 'GNF') echo 'selected="selected"'; ?>>GNF</option>
                                  
                                  <option value="GTQ" <?php if($detail['currency_code'] == 'GTQ') echo 'selected="selected"'; ?>>GTQ</option>
                                  
                                  <option value="GYD" <?php if($detail['currency_code'] == 'GYD') echo 'selected="selected"'; ?>>GYD</option>
                                  
                                  <option value="HKD" <?php if($detail['currency_code'] == 'HKD') echo 'selected="selected"'; ?>>HKD</option>
                                  
                                  <option value="HNL" <?php if($detail['currency_code'] == 'HNL') echo 'selected="selected"'; ?>>HNL</option>
                                  
                                  <option value="HRK" <?php if($detail['currency_code'] == 'HRK') echo 'selected="selected"'; ?>>HRK</option>
                                  
                                  <option value="HTG" <?php if($detail['currency_code'] == 'HTG') echo 'selected="selected"'; ?>>HTG</option>
                                  
                                  <option value="HUF" <?php if($detail['currency_code'] == 'HUF') echo 'selected="selected"'; ?>>HUF</option>
                                  
                                  <option value="IDR" <?php if($detail['currency_code'] == 'IDR') echo 'selected="selected"'; ?>>IDR</option>
                                  
                                  <option value="ILS" <?php if($detail['currency_code'] == 'ILS') echo 'selected="selected"'; ?>>ILS</option>
                                  
                                  <option value="IMP" <?php if($detail['currency_code'] == 'IMP') echo 'selected="selected"'; ?>>IMP</option>
                                  
                                  <option value="INR" <?php if($detail['currency_code'] == 'INR') echo 'selected="selected"'; ?>>INR</option>
                                  
                                  <option value="IQD" <?php if($detail['currency_code'] == 'IQD') echo 'selected="selected"'; ?>>IQD</option>
                                  
                                  <option value="IRR" <?php if($detail['currency_code'] == 'IRR') echo 'selected="selected"'; ?>>IRR</option>
                                  
                                  <option value="ISK" <?php if($detail['currency_code'] == 'ISK') echo 'selected="selected"'; ?>>ISK</option>
                                  
                                  <option value="JEP" <?php if($detail['currency_code'] == 'JEP') echo 'selected="selected"'; ?>>JEP</option>
                                  
                                  <option value="JMD" <?php if($detail['currency_code'] == 'JMD') echo 'selected="selected"'; ?>>JMD</option>
                                  
                                  <option value="JOD" <?php if($detail['currency_code'] == 'JOD') echo 'selected="selected"'; ?>>JOD</option>
                                  
                                  <option value="JPY" <?php if($detail['currency_code'] == 'JPY') echo 'selected="selected"'; ?>>JPY</option>
                                  
                                  <option value="KES" <?php if($detail['currency_code'] == 'KES') echo 'selected="selected"'; ?>>KES</option>
                                  
                                  <option value="KGS" <?php if($detail['currency_code'] == 'KGS') echo 'selected="selected"'; ?>>KGS</option>
                                  
                                  <option value="KHR" <?php if($detail['currency_code'] == 'KHR') echo 'selected="selected"'; ?>>KHR</option>
                                  
                                  <option value="KMF" <?php if($detail['currency_code'] == 'KMF') echo 'selected="selected"'; ?>>KMF</option>
                                  
                                  <option value="KPW" <?php if($detail['currency_code'] == 'KPW') echo 'selected="selected"'; ?>>KPW</option>
                                  
                                  <option value="KRW" <?php if($detail['currency_code'] == 'KRW') echo 'selected="selected"'; ?>>KRW</option>
                                  
                                  <option value="KWD" <?php if($detail['currency_code'] == 'KWD') echo 'selected="selected"'; ?>>KWD</option>
                                  
                                  <option value="KYD" <?php if($detail['currency_code'] == 'KYD') echo 'selected="selected"'; ?>>KYD</option>
                                  
                                  <option value="KZT" <?php if($detail['currency_code'] == 'KZT') echo 'selected="selected"'; ?>>KZT</option>
                                  
                                  <option value="LAK" <?php if($detail['currency_code'] == 'LAK') echo 'selected="selected"'; ?>>LAK</option>
                                  
                                  <option value="LBP" <?php if($detail['currency_code'] == 'LBP') echo 'selected="selected"'; ?>>LBP</option>
                                  
                                  <option value="LKR" <?php if($detail['currency_code'] == 'LKR') echo 'selected="selected"'; ?>>LKR</option>
                                  
                                  <option value="LRD" <?php if($detail['currency_code'] == 'LRD') echo 'selected="selected"'; ?>>LRD</option>
                                  
                                  <option value="LSL" <?php if($detail['currency_code'] == 'LSL') echo 'selected="selected"'; ?>>LSL</option>
                                  
                                  <option value="LVL" <?php if($detail['currency_code'] == 'LVL') echo 'selected="selected"'; ?>>LVL</option>
                                  
                                  <option value="LYD" <?php if($detail['currency_code'] == 'LYD') echo 'selected="selected"'; ?>>LYD</option>
                                  
                                  <option value="MAD" <?php if($detail['currency_code'] == 'MAD') echo 'selected="selected"'; ?>>MAD</option>
                                  
                                  <option value="MDL" <?php if($detail['currency_code'] == 'MDL') echo 'selected="selected"'; ?>>MDL</option>
                                  
                                  <option value="MGA" <?php if($detail['currency_code'] == 'MGA') echo 'selected="selected"'; ?>>MGA</option>
                                  
                                  <option value="MKD" <?php if($detail['currency_code'] == 'MKD') echo 'selected="selected"'; ?>>MKD</option>
                                  
                                  <option value="MMK" <?php if($detail['currency_code'] == 'MMK') echo 'selected="selected"'; ?>>MMK</option>
                                  
                                  <option value="MNT" <?php if($detail['currency_code'] == 'MNT') echo 'selected="selected"'; ?>>MNT</option>
                                  
                                  <option value="MOP" <?php if($detail['currency_code'] == 'MOP') echo 'selected="selected"'; ?>>MOP</option>
                                  
                                  <option value="MRO" <?php if($detail['currency_code'] == 'MRO') echo 'selected="selected"'; ?>>MRO</option>
                                  
                                  <option value="MUR" <?php if($detail['currency_code'] == 'MUR') echo 'selected="selected"'; ?>>MUR</option>
                                  
                                  <option value="MVR" <?php if($detail['currency_code'] == 'MVR') echo 'selected="selected"'; ?>>MVR</option>
                                  
                                  <option value="MWK" <?php if($detail['currency_code'] == 'MWK') echo 'selected="selected"'; ?>>MWK</option>
                                  
                                  <option value="MXN" <?php if($detail['currency_code'] == 'MXN') echo 'selected="selected"'; ?>>MXN</option>
                                  
                                  <option value="MYR" <?php if($detail['currency_code'] == 'MYR') echo 'selected="selected"'; ?>>MYR</option>
                                  
                                  <option value="MZN" <?php if($detail['currency_code'] == 'MZN') echo 'selected="selected"'; ?>>MZN</option>
                                  
                                  <option value="NAD" <?php if($detail['currency_code'] == 'NAD') echo 'selected="selected"'; ?>>NAD</option>
                                  
                                  <option value="NGN" <?php if($detail['currency_code'] == 'NGN') echo 'selected="selected"'; ?>>NGN</option>
                                  
                                  <option value="NIO" <?php if($detail['currency_code'] == 'NIO') echo 'selected="selected"'; ?>>NIO</option>
                                  
                                  <option value="NOK" <?php if($detail['currency_code'] == 'NOK') echo 'selected="selected"'; ?>>NOK</option>
                                  
                                  <option value="NPR" <?php if($detail['currency_code'] == 'NPR') echo 'selected="selected"'; ?>>NPR</option>
                                  
                                  <option value="NZD" <?php if($detail['currency_code'] == 'NZD') echo 'selected="selected"'; ?>>NZD</option>
                                  
                                  <option value="OMR" <?php if($detail['currency_code'] == 'OMR') echo 'selected="selected"'; ?>>OMR</option>
                                  
                                  <option value="PAB" <?php if($detail['currency_code'] == 'PAB') echo 'selected="selected"'; ?>>PAB</option>
                                  
                                  <option value="PEN" <?php if($detail['currency_code'] == 'PEN') echo 'selected="selected"'; ?>>PEN</option>
                                  
                                  <option value="PGK" <?php if($detail['currency_code'] == 'PGK') echo 'selected="selected"'; ?>>PGK</option>
                                  
                                  <option value="PHP" <?php if($detail['currency_code'] == 'PHP') echo 'selected="selected"'; ?>>PHP</option>
                                  
                                  <option value="PKR" <?php if($detail['currency_code'] == 'PKR') echo 'selected="selected"'; ?>>PKR</option>
                                  
                                  <option value="PLN" <?php if($detail['currency_code'] == 'PLN') echo 'selected="selected"'; ?>>PLN</option>
                                  
                                  <option value="PYG" <?php if($detail['currency_code'] == 'PYG') echo 'selected="selected"'; ?>>PYG</option>
                                  
                                  <option value="QAR" <?php if($detail['currency_code'] == 'QAR') echo 'selected="selected"'; ?>>QAR</option>
                                  
                                  <option value="RON" <?php if($detail['currency_code'] == 'RON') echo 'selected="selected"'; ?>>RON</option>
                                  
                                  <option value="RSD" <?php if($detail['currency_code'] == 'RSD') echo 'selected="selected"'; ?>>RSD</option>
                                  
                                  <option value="RUB" <?php if($detail['currency_code'] == 'RUB') echo 'selected="selected"'; ?>>RUB</option>
                                  
                                  <option value="RWF" <?php if($detail['currency_code'] == 'RWF') echo 'selected="selected"'; ?>>RWF</option>
                                  
                                  <option value="SAR" <?php if($detail['currency_code'] == 'SAR') echo 'selected="selected"'; ?>>SAR</option>
                                  
                                  <option value="SBD" <?php if($detail['currency_code'] == 'SBD') echo 'selected="selected"'; ?>>SBD</option>
                                  
                                  <option value="SCR" <?php if($detail['currency_code'] == 'SCR') echo 'selected="selected"'; ?>>SCR</option>
                                  
                                  <option value="SDG" <?php if($detail['currency_code'] == 'SDG') echo 'selected="selected"'; ?>>SDG</option>
                                  
                                  <option value="SEK" <?php if($detail['currency_code'] == 'SEK') echo 'selected="selected"'; ?>>SEK</option>
                                  
                                  <option value="SGD" <?php if($detail['currency_code'] == 'SGD') echo 'selected="selected"'; ?>>SGD</option>
                                  
                                  <option value="SHP" <?php if($detail['currency_code'] == 'SHP') echo 'selected="selected"'; ?>>SHP</option>
                                  
                                  <option value="SLL" <?php if($detail['currency_code'] == 'SLL') echo 'selected="selected"'; ?>>SLL</option>
                                  
                                  <option value="SOS" <?php if($detail['currency_code'] == 'SOS') echo 'selected="selected"'; ?>>SOS</option>
                                  
                                  <option value="SRD" <?php if($detail['currency_code'] == 'SRD') echo 'selected="selected"'; ?>>SRD</option>
                                  
                                  <option value="STD" <?php if($detail['currency_code'] == 'STD') echo 'selected="selected"'; ?>>STD</option>
                                  
                                  <option value="SVC" <?php if($detail['currency_code'] == 'SVC') echo 'selected="selected"'; ?>>SVC</option>
                                  
                                  <option value="SYP" <?php if($detail['currency_code'] == 'SYP') echo 'selected="selected"'; ?>>SYP</option>
                                  
                                  <option value="SZL" <?php if($detail['currency_code'] == 'SZL') echo 'selected="selected"'; ?>>SZL</option>
                                  
                                  <option value="THB" <?php if($detail['currency_code'] == 'THB') echo 'selected="selected"'; ?>>THB</option>
                                  
                                  <option value="TJS" <?php if($detail['currency_code'] == 'TJS') echo 'selected="selected"'; ?>>TJS</option>
                                  
                                  <option value="TMT" <?php if($detail['currency_code'] == 'TMT') echo 'selected="selected"'; ?>>TMT</option>
                                  
                                  <option value="TND" <?php if($detail['currency_code'] == 'TND') echo 'selected="selected"'; ?>>TND</option>
                                  
                                  <option value="TOP" <?php if($detail['currency_code'] == 'TOP') echo 'selected="selected"'; ?>>TOP</option>
                                  
                                  <option value="TRY" <?php if($detail['currency_code'] == 'TRY') echo 'selected="selected"'; ?>>TRY</option>
                                  
                                  <option value="TTD" <?php if($detail['currency_code'] == 'TTD') echo 'selected="selected"'; ?>>TTD</option>
                                  
                                  <option value="TWD" <?php if($detail['currency_code'] == 'TWD') echo 'selected="selected"'; ?>>TWD</option>
                                  
                                  <option value="TZS" <?php if($detail['currency_code'] == 'TZS') echo 'selected="selected"'; ?>>TZS</option>
                                  
                                  <option value="UAH" <?php if($detail['currency_code'] == 'UAH') echo 'selected="selected"'; ?>>UAH</option>
                                  
                                  <option value="UGX" <?php if($detail['currency_code'] == 'UGX') echo 'selected="selected"'; ?>>UGX</option>
                                  
                                  <option value="USD" <?php if($detail['currency_code'] == 'USD') echo 'selected="selected"'; ?>>USD</option>
                                  
                                  <option value="UYU" <?php if($detail['currency_code'] == 'UYU') echo 'selected="selected"'; ?>>UYU</option>
                                  
                                  <option value="UZS" <?php if($detail['currency_code'] == 'UZS') echo 'selected="selected"'; ?>>UZS</option>
                                  
                                  <option value="VEF" <?php if($detail['currency_code'] == 'VEF') echo 'selected="selected"'; ?>>VEF</option>
                                  
                                  <option value="VND" <?php if($detail['currency_code'] == 'VND') echo 'selected="selected"'; ?>>VND</option>
                                  
                                  <option value="VUV" <?php if($detail['currency_code'] == 'VUV') echo 'selected="selected"'; ?>>VUV</option>
                                  
                                  <option value="WST" <?php if($detail['currency_code'] == 'WST') echo 'selected="selected"'; ?>>WST</option>
                                  
                                  <option value="XAF" <?php if($detail['currency_code'] == 'XAF') echo 'selected="selected"'; ?>>XAF</option>
                                  
                                  <option value="XAG" <?php if($detail['currency_code'] == 'XAG') echo 'selected="selected"'; ?>>XAG</option>
                                  
                                  <option value="XCD" <?php if($detail['currency_code'] == 'XCD') echo 'selected="selected"'; ?>>XCD</option>
                                  
                                  <option value="XDR" <?php if($detail['currency_code'] == 'XDR') echo 'selected="selected"'; ?>>XDR</option>
                                  
                                  <option value="XOF" <?php if($detail['currency_code'] == 'XOF') echo 'selected="selected"'; ?>>XOF</option>
                                  
                                  <option value="XPF" <?php if($detail['currency_code'] == 'XPF') echo 'selected="selected"'; ?>>XPF</option>
                                  
                                  <option value="YER" <?php if($detail['currency_code'] == 'YER') echo 'selected="selected"'; ?>>YER</option>
                                  
                                  <option value="ZAR" <?php if($detail['currency_code'] == 'ZAR') echo 'selected="selected"'; ?>>ZAR</option>
                                  
                                  <option value="ZMK" <?php if($detail['currency_code'] == 'ZMK') echo 'selected="selected"'; ?>>ZMK</option>
                                  
                                  <option value="ZMW" <?php if($detail['currency_code'] == 'ZMW') echo 'selected="selected"'; ?>>ZMW</option>
                                  
                                  <option value="ZWL" <?php if($detail['currency_code'] == 'ZWL') echo 'selected="selected"'; ?>>ZWL</option>
              
        
                           
                           
                            </select>
                  </div>
                      
                       </div>
                       
                    
                  </div>
          
                </div>
       
           
            </div>
          </div>
       </form> 
       </div>
       
       
             <div class="col-xl-12 order-xl-1" >
     <form method="post">
         
         
         
          <div class="card">
            
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"><i class="fas fa-cogs"></i> Update Account Password</h3>
                </div>
                <div class="col-4 text-right">
                  <button type="submit" onclick="return confirm('Are you Sure you want to Update your Old Password?')" class="btn btn-sm btn-info" name="update_pass"><i class="fas fa-edit"></i> Set Password</button>
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
   
    </div>