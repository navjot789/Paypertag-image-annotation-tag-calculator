</div>
</div>
</div>
<div class="container-fluid mt--6">


<?php
 if(isset($_POST['add']))
       {
              $batch = mysqli_real_escape_string($con,htmlentities($_POST['batch'])); 
              
              $code = mysqli_real_escape_string($con,htmlentities($_POST['task_code'])); 
              $atributes = mysqli_real_escape_string($con,htmlentities($_POST['atributes'])); 
              $tasks = mysqli_real_escape_string($con,htmlentities($_POST['tasks'])); 
              $time = mysqli_real_escape_string($con,htmlentities($_POST['time'])); 
              
              
              //now lets check if user task_code in already exist
                    $stmts = $con->prepare('SELECT task_id FROM global_tasks WHERE task_code = ?');
                    $stmts->bind_param('s', $code);
                    	$stmts->execute();
                    	// Store the result so we can check if the task exists in the database.
                    	$stmts->store_result();
              
              
             
                      if(empty($batch) || empty($code) || empty($tasks))
                       {
                                	$error =   	'<div class="alert alert-danger">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>Blank!</strong> All * Fields are Required</a>. 
                                                                            </div>  ';
                       }
                      else if(strlen($code) <= 16 || strlen($code) > 17 )
                      {
                          $error =   	'<div class="alert alert-danger">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>Invalid Task Code!</strong> Please Enter Valid Task Code</a>. 
                                                                            </div>  ';
                      }
                      else if($stmts->num_rows > 0)
                      {
                          $error =   	'<div class="alert alert-warning">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>Task Code Already Assigned!</strong> The task Code you have enter is already completed</a>. 
                                                                            </div>  ';
                      }
                       else if($atributes > $tasks)
                      {
                          $error =   	'<div class="alert alert-warning">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>ERROR!</strong> The Attributes cannot be greater than Total number of Tags</a>. 
                                                                            </div>  ';
                      }
                       else
                       {
                                  
                                          if(ctype_digit($atributes) || $atributes =='' )
                                          {
                                             
                                                               if(ctype_digit($tasks))
                                                                 {
                                                                                        
                                                                          if( strpos($time,'.') !== false || ctype_digit($time) || $time =='')
                                                                                             {
                                                                                                 
                                                                                                           if(empty($atributes))
                                                                                                           {
                                                                                                               $atributes = 0;
                                                                                                           }
                                                                                                          
                                                                                                          if(empty($batch))
                                                                                                           {
                                                                                                               $batch = 0;
                                                                                                           }
                                                                                                 
                                                                                                 
                                                                                                            $flot_time  = floatval($time);
                                                                                                          
                                                                                                           //formula to calculate average time on per tag
                                                                                                             $time_per_tag = $flot_time * 60/$tasks; // time per tag(in sec)  =  (taken_min X 60seconds)/total_tags
                                                                                                             $time_per_tag = number_format($time_per_tag, 2, '.', '');  // Last two parameters are optional // Outputs x.xx
                                                                                                               
                                                                  
                                                                                                            //formula to calculate earnings
                                                                                                            //note: we are calculating tags_with_attributes and tags_without_attributes seperately
                                                                                                               $box = 0.4;
                                                                                                               $class = 0.4;
                                                                                                               $attribute = 0.3 + $box + $class; //0.9 bcz we assume it already contains (box + class) price
                                                                                                               
                                                                                                               $box_class_cents = ($tasks - $atributes) * ($box + $class);
                                                                                                               $attribute_cents = $atributes * $attribute;
                                                                                                               
                                                                                                               $total_box_class_cents = $box_class_cents/100;
                                                                                                               $total_attribute_cents = $attribute_cents/100;
                                                                  
                                                                                                              $total_usd = $total_box_class_cents + $total_attribute_cents;
                                                                                                               
                                                                                                           $sql_prepare = 'insert into global_tasks(b_id,tagr_id,task_code,attributes,total_tags,minutes,avg,usd,cr_d,c_date) 
                                                                                                           values("'.$batch.'",
                                                                                                                  "'.$_SESSION['tagr_id'].'",
                                                                                                                  "'.$code.'",
                                                                                                                  "'.$atributes.'",
                                                                                                                  "'.$tasks.'",
                                                                                                                  "'.$flot_time.'",
                                                                                                                   "'.$time_per_tag.'",
                                                                                                                   "'.$total_usd.'",
                                                                                                                   "'.$current_date.'",
                                                                                                                   "'.date("Y-m-d").'")';
                                                                                                                   
                                                                                                                   
                                                                                                          $result= mysqli_query($con,$sql_prepare);
                                                                  
                                                                                                              if($result)
                                                                                                              {
                                                                                                                  $success =   	'<div class="alert alert-success">  
                                                                                                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                                                            <strong>New Task Added Successfully</strong> on </a>'.$current_date.'</div>';
                                                                                                                                                            
                                                                                                              }
                                                                                                              else
                                                                                                              {
                                                                                                                      $error = 	'<div class="alert alert-danger">  
                                                                                                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                                                            <strong>SQL ERROR:</strong>Contact Webdeveloper ASAP:(</a>
                                                                                                                                                            </div>'.$total_usd;
                                                                                                              }
                                                                                          
                                                                                           }
                                                                                          else
                                                                                          {
                                                                                              $error =   	'<div class="alert alert-danger">  
                                                                                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                                            <strong>Strings Detected!</strong> Minutes Cannot be converted into Strings</a>. 
                                                                                                                                            </div>  ';
                                                                                          }
                                                 	
                                              
                                                                 }
                                                                  else
                                                                  {
                                                                      $error =   	'<div class="alert alert-danger">  
                                                                                                                  <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                    <strong>Strings Detected!</strong> Tags Cannot be converted into Strings</a>. 
                                                                                                                    </div>  ';
                                                                  }
                                                                      
                                          }
                                          else
                                          {
                                              $error =   	'<div class="alert alert-danger">  
                                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                            <strong>Strings Detected!</strong> Attributes Cannot be converted into Strings</a>. 
                                                                                            </div>  ';
                                          }
                                  
                           
                }
            
              
                

}


?>


  
      <div class="row ">
        <div class="col-xl-8">
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
                                  <h3 class="mb-0"><i class="fas fa-plus"></i> Add New Task</h3>
                                 
                                </div>
                               
                                
                                <!-- Card body -->
                                <div class="card-body">
                                  <!-- Form groups used in grid -->
                                  <form method="post">
                                             <div class="row">
                                                      
                                                         <div class="col-md-12">
                                                                <div class="form-group">
                                                                        <label class="form-control-label" for="exampleFormControlSelect1"> Batch Name <code>*</code> (Batch that your task associated with)</label>
                                                                      
                                                                <select class="form-control" id="exampleFormControlSelect1" name="batch">
                                                                        <option disabled selected>-------Select Batch Name-------</option>    
                                                                         <?php
                                                                         $sql_qry = "SELECT b_id,batch_name FROM batch WHERE status=1";
                                                                          
                                                                            $select = $con->prepare($sql_qry);          
                                                                            $select->execute();
                                                                            $select->bind_result($b_id,$batch_name);
                                                                            $new_obj = array();
                                                                            $select->store_result();
                                                                           
                                                                         if($select->num_rows > 0)
                                                                         {
                                                                            while($select->fetch())
                                                                            {
                                                                                $new_obj = array('b_id'=>$b_id,'batch_name'=>$batch_name);
                                                                       ?>   
                                                                       
                                                                                 <option  value="<?php echo $new_obj['b_id']; ?>"><?php echo $new_obj['batch_name']; ?></option>
                                                                         
                                                                        <?php
                                                                             }
                                                                            }else
                                                                            {
                                                                                echo '<option disabled selected>-------No Batch is Active on Microwork-------</option>';
                                                                            } $select->close();
                                                                        ?>
                                                                        </select>
                                                                        
                                                                        
                                                                        
                                                                      </div>
                                                          </div>
                                                    
                                              </div>      
                                                    
                                      
                                                  <div class="row">
                                                      
                                                         <div class="col-md-3">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols2Input"><i class="fas fa-hashtag"></i> Task Code <code>*</code></label>
                                                        <input type="text" class="form-control"  placeholder="Task Code" name="task_code">
                                                      </div>
                                                    </div>
                                                      
                                                 
                                                    <div class="col-md-3">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols2Input"><i class="fas fa-tag"></i> Attributes</label>
                                                        <input type="text" class="form-control"  placeholder="Attributes" name="atributes">
                                                      </div>
                                                    </div>
                                                    
                                                      <div class="col-md-3">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols1Input"><i class="fas fa-tags"></i> Total Tags <code>*</code></label>
                                                        <input type="text" class="form-control"  placeholder="Total Tags" name="tasks">
                                                      </div>
                                                    </div>
                                                    
                                                    
                                                      <div class="col-md-3">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols2Input"><i class="fas fa-hourglass-end"></i> Minutes</label>
                                                        <input type="text" class="form-control"  placeholder="Minutes" name="time">
                                                      </div>
                                                    </div>
                                                 
                                                  
                                                  
                                                  </div>
                                             
                                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="add"><i class="fas fa-plus"></i> Add Task</button>
                                                </div>
                                </form>
                                
                               <div class="card-header" style="padding:10px;">
                                  <h6 class="mb-0">  <i class="fas fa-info-circle"></i> info: Fields with <code>*</code> are Required.</h6>
                                 
                                </div>
                                
                              </div>
                    </div>
                  </div>
      
      
          <div class="row">
            <div class="col">
              <div class="card mb-4" >
                                <!-- Card header -->
                                <div class="card-header">
                                  <h3 class="mb-0"><i class="fas fa-history"></i> Task History</h3>
                                 
                                </div>
                                
                                <?php
                                
                                    $sql_prepare_query = 'SELECT task_code,attributes,total_tags,minutes,usd,cr_d FROM global_tasks WHERE tagr_id= ? order by task_id desc';
                                    $stmt = $con->prepare($sql_prepare_query); 
                                    $stmt->bind_param("i", $_SESSION['tagr_id']);
                                    $stmt->execute();
                                    $stmt->bind_result($task_code,$attributes,$total_tags,$minutes,$usd,$cr_d);
                                   
                              
                                    
                                ?>
                                
                                
                                <!-- Card body -->
                             
                                  <div class="table-responsive py-2" >
                                      <table class="table table-flush" id="datatable-buttons" >
                                        <thead class="thead-light" >
                                          <tr>
                                             <th>#</th>
                                             <th>Action</th>
                                            <th>Task Code</th>
                                            <th>Attributes</th>
                                            <th>Total Tags</th>
                                            <th>Minutes</th>
                                             <th>USD</th>
                                            <th>Posted At</th>
                                         
                                          </tr>
                                        </thead>
                                        <tfoot>
                                          <tr>
                                             <th>#</th>
                                             <th>Action</th>
                                             <th>Task Code</th>
                                            <th>Attributes</th>
                                            <th>Total Tags</th>
                                            <th>Minutes</th>
                                             <th>USD</th>
                                            <th>Posted At</th>
                                        
                                          </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                      <?php
                                      
                                       $json = array();
                                       $i=0;
                                           while($stmt->fetch()) 
                                           {
                                               
                                           $json = array('task_code'=>$task_code,'attributes'=>$attributes,'total_tags'=>$total_tags,'minutes'=>$minutes,'usd'=>$usd,'cr_d'=>$cr_d);
                                           $i++;
                                      ?>
                                            
                                        <tr>
                                            
                                            <td><?php echo $i; ?></td>
                                            
                                               <td class="text-right">
                                                      <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                                           
                                                      <a href="global/handler.php?val=<?php echo urlencode(base64_encode($json['task_code']));?>" onclick="return confirm('Are you sure you want to delete this Task? Beware this Action Cannot be Revoke!')" class="dropdown-item" name="delete_task"> <i class="fas fa-trash-alt text-red"></i> Remove</a>
                                                           
                                                        </div>
                                                      </div>
                                             </td>
                                             
                                             
                                               <td><strong><?php echo $json['task_code']; ?></strong></td>
                                                
                                                  <td><?php 
                                                
                                                        
                                                         if($json['attributes']==0 || $json['attributes'] =='' )
                                                           {
                                                                 echo '<span  style="background-color:#c0c0c0;color:#fff;padding:3px;">N/A</span>';
                                                           }else
                                                           {
                                                                echo $json['attributes'];
                                                           }
                                                           
                                                ?></td>
                                                
                                                
                                                <td><?php echo $json['total_tags']; ?></td>
                                                
                                                <td><?php 
                                                
                                                        
                                                         if($json['minutes']==0 || $json['minutes'] =='' )
                                                           {
                                                                 echo '<span  style="background-color:#c0c0c0;color:#fff;padding:3px;">N/A</span>';
                                                           }else
                                                           {
                                                                echo $json['minutes'];
                                                           }
                                                           
                                                ?></td>
                                                <td><?php 
                                                
                                                            if($json['usd']==0 || $json['usd']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                        echo '<span  style="color:#43e972;">$'.$json['usd'].'</span>';
                                                                   }
                                                
                                                ?></td>
                                                
                                                <td><?php echo  date('g:ia \o\n l<\b\\r> jS F Y', strtotime($json['cr_d'])); ?></td>
                                              
                                               
                                       </tr>
                                             <?php  } ?>
                                       
                                        
                                        </tbody>
                                      </table>
                                    </div>
         
                              </div>
                    </div>
                  </div>
      
      
      
      
      
      
      
      
      
      
              </div>
              
              
              
               <div class="col-xl-4">
                      <div class="row">
                        <div class="col">
                       <div class="card">
                           
                                    <!-- Card header -->
                                    <div class="card-header">
                                      <!-- Title -->
                                      <h4 class=" mb-0">Read FAQs before Adding Tasks    </h4>
                                    </div>
                                    <!-- Card body -->
                                    <div class="card-body p-0">
                                    
                                      
                                      <div class="accordion" id="accordionExample">
                                                <div class="card" style="margin-bottom: 0px;">
                                                    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                      
                                                           <div class="checklist-item checklist-item-success ">
                                                                <div class="checklist-info">
                                                                  <a href="#"><h5 class="checklist-title mb-0" data-toggle="modal" data-target="#exampleModal">How do I know my batch Name?</h5></a>
                                                                 
                                                                </div>
                                                                <div>
                                                                 
                                                                </div>
                                                           </div>
                                                      
                                                      
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" >
                                                        <div class="card-body">
                                                              <p>
                                                         Name of the batch can be found on the card from which you assign the task currently.
                                                           </p>
                                                            <div class="text-center">
                                                              <img src="images/batchname.png" class="rounded img-thumbnail img-fluid" alt="...">
                                                            </div>   
                                                      
                                                      
                                                        </div>
                                                    </div>
                                              </div>
                                                <div class="card" style="margin-bottom: 0px;">
                                                    <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        
                                                            <div class="checklist-item checklist-item-success ">
                                                                <div class="checklist-info">
                                                                  <a href="#"><h5 class="checklist-title mb-0" >Where do I find Task Code?</h5></a>
                                                                 
                                                                </div>
                                                                <div>
                                                                 
                                                                </div>
                                                           </div>
                                                        
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                               <p>
                                                               Each Task code is unique itself and can easily be found at the URL Address Bar when you assign the task.
                                                           </p>
                                                            <div class="text-center">
                                                              <img src="images/task_code.png" class="rounded img-thumbnail img-fluid" alt="...">
                                                            </div>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card" style="margin-bottom: 0px;">
                                                    <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                     
                                                      <div class="checklist-item checklist-item-success ">
                                                            <div class="checklist-info">
                                                              <a href="#"><h5 class="checklist-title mb-0" >How do I calculate my Attributes?</h5></a>
                                                             
                                                            </div>
                                                            <div>
                                                             
                                                            </div>
                                                       </div>
                                                      
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <p>Attributes can only be count as manually in the task, you have to gothrough the whole task and search for it, if one tag has double attributes then you have to count that tags as double attributes.</p>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                       <div class="card" style="margin-bottom: 0px;">
                                                    <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                                     
                                                      <div class="checklist-item checklist-item-success ">
                                                            <div class="checklist-info">
                                                              <a href="#"><h5 class="checklist-title mb-0" >How do I calculate my Total Tags?</h5></a>
                                                             
                                                            </div>
                                                            <div>
                                                             
                                                            </div>
                                                       </div>
                                                      
                                                    </div>
                                                    <div id="collapse4" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                       <div class="card-body">
                                                               <p>
                                                               Total tags can be found once you done tagging with the task.
                                                           </p>
                                                            <div class="text-center">
                                                              <img src="images/total_tsk1.png" class="rounded img-thumbnail img-fluid" alt="...">
                                                            </div>  
                                                            
                                                            
                                                             <p>
                                                               Or can be found at the bottom of the screen on the right hand side inside the task.
                                                           </p>
                                                            <div class="text-center">
                                                              <img src="images/total_tsk2.png" class="rounded img-thumbnail img-fluid" alt="...">
                                                            </div>   
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                    </div>
                                  </div>
                                  
                                  
                                    
                                            
                           
                                </div>
                              </div>
                  
                          </div>
              
              
              
              
              
            </div>
       
            
          </div>
  
         