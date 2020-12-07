</div>
</div>
</div>
<div class="container-fluid mt--6">


 <?php                                  //getting task details
                                                    $val = mysqli_real_escape_string($con,htmlentities(base64_decode(urldecode($_GET['t'])))); 
                                                    $sql_prepare = 'SELECT task_id,tagr_id,task_status,task_code,attributes,total_tags,minutes,avg,a_w_m,t_w_m,usd,cr_d FROM global_tasks WHERE task_code= ?';
                                                                                                 $stmt = $con->prepare($sql_prepare);
                                                                                                 $stmt->bind_param('s',$val);
                                                                                                 $stmt->execute();
                                                                                                 $stmt->bind_result($task_id,$tagr_id,$task_status,$task_code,$attributes,$total_tags,$minutes,$avg,$awm,$twm,$usd,$cr_d);
                                                                                                 $stmt->store_result();
                                                                                                 $json_data = array();
                                                                                                
                                                        
                                                    $stmt->fetch();
										
										     $json_data = array('task_id'=>$task_id,'tagr_id'=>$tagr_id,'task_status'=>$task_status,'task_code'=>$task_code,'attributes'=>$attributes,'total_tags'=>$total_tags,'minutes'=>$minutes,'avg'=>$avg,'a_w_m'=>$awm,'t_w_m'=>$twm,'usd'=>$usd,'cr_d'=>$cr_d); 
                                                     
                                                     
                                                     
                            
                                                                    
                                                    if(isset($_POST['update']))
                                                    {
                                                        
                                                         $status = mysqli_real_escape_string($con,htmlentities($_POST['status']));
                                                         $attributes = mysqli_real_escape_string($con,htmlentities($_POST['attributes']));
                                                         $t_tags = mysqli_real_escape_string($con,htmlentities($_POST['t_tags']));
                                                         $update_a_w_m = mysqli_real_escape_string($con,htmlentities($_POST['update_a_w_m']));
                                                         $update_t_w_m = mysqli_real_escape_string($con,htmlentities($_POST['update_t_w_m']));
                                                        
                                                        if($t_tags=='' || $t_tags==0)
                                                        {
                                                            
                                                           
                                                        $error =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <span class="alert-icon"><i class="fas fa-times-circle"></i></span>
                                                                <span class="alert-text"><strong>ERROR:</strong>  Total tags cannot be empty OR Zero!</span>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                  <span aria-hidden="true">×</span>
                                                                </button>
                                                              </div>';
                                                         
                                                            
                                                        }
                                                        else if($attributes > $t_tags)
                                                        {
                                                          
                                                          $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <span class="alert-icon"><i class="fas fa-times-circle"></i></span>
                                                                <span class="alert-text"><strong>ERROR:</strong> Attributes cannot be greater than total tags!</span>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                  <span aria-hidden="true">×</span>
                                                                </button>
                                                              </div>';
                                                        }  
                                                        else if($status==0)
                                                        {
                                                          
                                                          $error = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                                <span class="alert-icon"><i class="fas fa-times-circle"></i></span>
                                                                <span class="alert-text"><strong>Unable to change Task Status</strong> Kindly change the status of the task as Approved!</span>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                  <span aria-hidden="true">×</span>
                                                                </button>
                                                              </div>';
                                                        }
                                                        else
                                                        {
                                                                      //zero null fields
                                                                       if($attributes == '')
                                                                        {
                                                                            $attributes = 0;
                                                                        }
                                                                        if($update_a_w_m == '')
                                                                        {
                                                                            $update_a_w_m = 0;
                                                                        }
                                                                        if($update_t_w_m == '')
                                                                        {
                                                                            $update_t_w_m = 0;
                                                                        } 
                                                                        if($json_data['attributes'] == '' || $json_data['attributes'] == 0)
                                                                        {
                                                                                 $update_a_w_m = 0; //if attributes already 0 in db then there will be no minus from the attributes
                                                                        }
                                                            
                                                               //formula to calculate earnings
                                                                //note: we are calculating tags_with_attributes and tags_without_attributes seperately
                                                                   $box = 0.4;
                                                                   $class = 0.4;
                                                                   $attribute_price = 0.3 + $box + $class; //0.9 bcz we assume it already contains (box + class) price
                                                                   
                                                                   $box_class_cents = (($t_tags - $attributes) - $update_t_w_m) * ($box + $class); //(tags_without_att - entered tags mistakes) then * box_class
                                                                   $attribute_cents = ($attributes - $update_a_w_m) * $attribute_price; 
                                                                   
                                                                   $total_box_class_usd = $box_class_cents/100;
                                                                   $total_attribute_usd = $attribute_cents/100;
                      
                                                                  $total_usd = $total_box_class_usd + $total_attribute_usd;
                                                            
                                                               $prepare_query = 'UPDATE global_tasks SET task_status=?, attributes=?, total_tags=?, a_w_m=?, t_w_m=?, usd= ? WHERE tagr_id=? AND task_code = ?';
										                       $query = $con->prepare($prepare_query);
                                                               $query->bind_param('isssssis',$status,$attributes,$t_tags,$update_a_w_m,$update_t_w_m,$total_usd,$json_data['tagr_id'],$val); 
                                                               $query->execute();
                                                               
                                                               header("Refresh:0"); 
                                                               exit();
                                                              
                                                        }
                                                     }
                            
                            
                            
                            
                            
                                                     
                                                        
                                                                                                
                                                    ?>




  
      <div class="row ">
        <div class="col-xl-10 m-auto">
          <div class="row">
            <div class="col">
                
                <?php
                 if(isset($error))
                 {
                     echo $error;
                 }
                 else if(isset($success))
                 {
                       echo $success;
                 }
      
                ?>
                
                
              <div class="card mb-4">
                  
                  
                                <!-- Card header -->
                            
                                
                                <div class="card-header">
                                  <div class="row align-items-center">
                                    <div class="col-8">
                                      <!-- Title -->
                                      <h5 class="h3 mb-0"><i class="far fa-edit"></i> Update Task Status</h5>
                                    </div>
                                    <div class="col-4 text-right">
                                  
                                    <a href="#!" class="btn btn-sm btn-nutral">Worth: <span style="color:#2ae57d;"> $<?php echo $json_data['usd'];?></span></a> 
                                        
                                        <?php
									        if($json_data['task_status'] == 0)
									        {
									?>
                                      <a href="#!" class="btn btn-sm btn-warning"><i class="fas fa-clock"></i> Pending</a>
                                      
                                      <?php
									        }else if($json_data['task_status'] == 1)
									        {
									      
                                      ?>
                                        <a href="#!" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i> Approved</a>
                                        
                                       <?php
								        }
								
                                  ?> 
                                  
                                  
                                    </div>
                                  </div>
                                </div>
                               
                                
                                <!-- Card body -->
                                <div class="card-body">
                                  <!-- Form groups used in grid -->
                                  <form method="post">
                                         
                                                     
                                         <p class="card-text text-sm font-weight-bold text-right">Posted on <?php echo  date('jS F , Y h:i A', strtotime($json_data['cr_d']));?></p>
                                                    
                                      
                                                  <div class="row">
                                                      
                                                      
                                                      
                                                          <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label class="form-control-label" for="exampleFormControlSelect1"> Task Status</label>
                                                                      
                                                                <select class="form-control" id="exampleFormControlSelect1" name="status">
                                                                        <option disabled selected>-------------------------Select Status-----------------------------</option>    
                                                                     
                                                                <option value="0"  <?php if($json_data['task_status']== 0) echo 'selected="selected"'; ?> >Pending</option>
		                                                        <option value="1"  <?php if($json_data['task_status']== 1) echo 'selected="selected"'; ?>>Approved</option>
                                                                         
                                                                       
                                                                        </select>
                                                                        
                                                                        
                                                                        
                                                                      </div>
                                                          </div>
                                                      
                                                      
                                                         <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols2Input"><i class="fas fa-hashtag"></i> Task Code <code>*</code></label>
                                                        <input type="text" class="form-control" placeholder="Task Code" value="<?php echo $json_data['task_code'];?>" readonly disabled >
                                                      </div>
                                                    </div>
                                                      
                                                 
                                              </div> 
                                                   
                                                   
                                                   <div class="row"> 
                                                   
                                                   
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols2Input"><i class="fas fa-tag"></i> Attributes</label>
                                                        <input type="text" class="form-control"  name="attributes" placeholder="Attributes" value="<?php echo $json_data['attributes'];?>" >
                                                      </div>
                                                    </div>
                                                    
                                                       <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols1Input"><i class="fas fa-tags"></i> Total Tags <code>*</code></label>
                                                        <input type="text" class="form-control"  name="t_tags" placeholder="Total Tags" value="<?php echo $json_data['total_tags'];?>">
                                                      </div>
                                                    </div>
                                                    
                                                    
                                                 </div>
                                                 
                                                 
                                                     <div class="row"> 
                                                   
                                                   
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols2Input"><i class="fas fa-tag"></i> A.W.M</label>
                                                        <input type="text" class="form-control"  name="update_a_w_m" placeholder="Att with mistakes" value="<?php echo $json_data['a_w_m'];?>" >
                                                      </div>
                                                    </div>
                                                    
                                                       <div class="col-md-6">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols1Input"><i class="fas fa-tags"></i> T.W.M</label>
                                                        <input type="text" class="form-control"  name="update_t_w_m" placeholder="Tags with mistakes" value="<?php echo $json_data['t_w_m'];?>">
                                                      </div>
                                                    </div>
                                                    
                                                    
                                                 </div>
                                                    <div class="form-group" style="float:right">
                                                        <button type="submit" class="btn btn-primary" name="update"><i class="fas fa-pen-square"></i> UPDATE</button>
                                                      </div>
                                                   
                                                    
                                                  </div>
                                                  
                                                  <div class="card-header" style="padding:10px;">
                                                      <h6 class="mb-0">  <i class="fas fa-info-circle"></i> info: Fields with <code>*</code> are Required.</h6>
                                                     
                                                    </div>           
                                             
                                             
                                             
                                               
                                </form>
                                   </div> 
                          
                                
                              </div>
                    </div>
                  </div>
      
      
              </div>
              
              
            </div>
       
            
          </div>
  
         