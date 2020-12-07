
 <?php                                  //getting task details
                                                    $val = mysqli_real_escape_string($con,htmlentities(base64_decode(urldecode($_GET['val'])))); 
                                                    $sql_prepare = 'SELECT task_id,tagr_id,task_status,task_code,attributes,total_tags,minutes,avg,a_w_m,t_w_m,usd,cr_d FROM tasks WHERE task_code= ?';
                                                                                                 $stmt = $con->prepare($sql_prepare);
                                                                                                 $stmt->bind_param('s',$val);
                                                                                                 $stmt->execute();
                                                                                                 $stmt->bind_result($task_id,$tagr_id,$task_status,$task_code,$attributes,$total_tags,$minutes,$avg,$awm,$twm,$usd,$cr_d);
                                                                                                 $stmt->store_result();
                                                                                                 $json_data = array();
                                                                                                
                                                        
                                                    $stmt->fetch();
										
										     $json_data = array('task_id'=>$task_id,'tagr_id'=>$tagr_id,'task_status'=>$task_status,'task_code'=>$task_code,'attributes'=>$attributes,'total_tags'=>$total_tags,'minutes'=>$minutes,'avg'=>$avg,'a_w_m'=>$awm,'t_w_m'=>$twm,'usd'=>$usd,'cr_d'=>$cr_d); 
                                                     
                                                     
                                                     
                                             //getting user data        
                                                $prepare = 'SELECT username FROM taggers WHERE tagr_id=?';
										         $stmts = $con->prepare($prepare);
                                                   
                                                       $stmts->bind_param('i',$json_data['tagr_id']); 
                                                       $stmts->execute();
                                                       $stmts->bind_result($username); 
                                                       $data = array();
                                                       $stmts->store_result();
                                                       $stmts->fetch();
                                                       $data = array('username'=>$username);
                                                                                                
                            
                            
                                                                    
                                                    if(isset($_POST['update']))
                                                    {
                                                        
                                                         $status = mysqli_real_escape_string($con,htmlentities($_POST['status']));
                                                         $attributes = mysqli_real_escape_string($con,htmlentities($_POST['attributes']));
                                                         $t_tags = mysqli_real_escape_string($con,htmlentities($_POST['t_tags']));
                                                         $update_a_w_m = mysqli_real_escape_string($con,htmlentities($_POST['update_a_w_m']));
                                                         $update_t_w_m = mysqli_real_escape_string($con,htmlentities($_POST['update_t_w_m']));
                                                        
                                                        if($t_tags=='' || $t_tags==0)
                                                        {
                                                            
                                                            echo 'Total tags cannot be empty OR Zero!';
                                                          echo "<script>demo.showNotification('bottom','left');</script>";
                                                            
                                                        }
                                                        else if($attributes > $t_tags)
                                                        {
                                                            echo 'Attributes cannot be greater than total tags!';
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
                                                                   $box = 0.3;
                                                                   $class = 0.3;
                                                                   $attribute_price = 0.3 + $box + $class; //0.9 bcz we assume it already contains (box + class) price
                                                                   
                                                                   $box_class_cents = (($t_tags - $attributes) - $update_t_w_m) * ($box + $class); //(tags_without_att - entered tags mistakes) then * box_class
                                                                   $attribute_cents = ($attributes - $update_a_w_m) * $attribute_price; 
                                                                   
                                                                   $total_box_class_usd = $box_class_cents/100;
                                                                   $total_attribute_usd = $attribute_cents/100;
                      
                                                                  $total_usd = $total_box_class_usd + $total_attribute_usd;
                                                            
                                                               $prepare_query = 'UPDATE tasks SET task_status=?, attributes=?, total_tags=?, a_w_m=?, t_w_m=?, usd= ? WHERE tagr_id=? AND task_code = ?';
										                       $query = $con->prepare($prepare_query);
                                                               $query->bind_param('isssssis',$status,$attributes,$t_tags,$update_a_w_m,$update_t_w_m,$total_usd,$json_data['tagr_id'],$val); 
                                                               $query->execute();
                                                               
                                                               header("Refresh:0"); 
                                                               exit();
                                                              
                                                        }
                                                     }
                            
                            
                            
                            
                            
                                                     
                                                        
                                                                                                
                                                    ?>

<div class="container-fluid" onload="demo.showNotification('top','center')">
	                <div class="row">
	                    <div class="col-md-10 col-md-offset-1">
	                        <div class="card card-wizard" id="wizardCard" 
	                        style="background:<?php   if($json_data['task_status']==0){echo '#efef7b;';}
	                                                  else if($json_data['task_status']==1){echo '#a9d96e;';}
	                                                  else if($json_data['task_status']==2){echo '#f89e9c;';}
	                                                  else{echo '#ccc;';}?>">
	                            <form id="wizardForm" method="post"  novalidate="novalidate">
		                            <div class="card-header text-center">
		                             
		                                <h4 class="card-title">
        		                                    <i class="fas fa-circle text-warning"></i> 
        		                                    <i class="fas fa-circle text-success"></i>
        		                                    <i class="fas fa-circle text-danger"></i> 
        		                                    Tasks Status Editor 
        		                                    <i class="fas fa-circle text-warning"></i> 
        		                                    <i class="fas fa-circle text-success"></i>
        		                                    <i class="fas fa-circle text-danger"></i>
		                                    </h4>
		                                <p class="category">Tasks Management and Control Panel</p>
		                              
		                            </div>
		                          
	            					<div class="card-content">
	            					    <ul class="nav nav-pills">
		            						<li  style="width: 33.3333%;"><a>Posted by: <?php echo $data['username'];?></a></li>
		            						<li class="active" style="width: 33.3333%;"><a >Worth: <span style="color:#2ae57d;"> $<?php echo $json_data['usd'];?></span></a></li>
		            						<li style="width: 33.3333%;"><a ><?php echo  date('jS F , Y h:i A', strtotime($json_data['cr_d']));?></a></li>
		            						
		            					</ul>
	            					    
		            			 <div class="tab-pane" id="tab2">
		                                        <h5 class="text-center">Change the status and edit there mistakes from the below fields.</h5>
		                                        <div class="row">
		                                            <div class="col-md-5 col-md-offset-1">
		                                               
		                                                <div class="form-group">
		                                                    <label class="control-label">
																Task Status 
															</label>
															<?php
															        if($json_data['task_status'] == 0)
															        {
															?>
            		                                                <span class="badge badge-dot mr-4 " style="background:#f0a810;">
                                                                       <span style="font-size:10px;" class="status ">pending</span>
                                                                     </span>
                                                              <?php
															        }else if($json_data['task_status'] == 1)
															        {
															      
                                                              ?>
                                                                  <span class="badge badge-dot mr-4 " style="background:#80b984;">
                                                                       <span style="font-size:10px;" class="status ">Approved</span>
                                                                     </span>
                                                              <?php
															        }else if($json_data['task_status'] == 2)
															        {
															      
                                                              ?>
                                                                 <span class="badge badge-dot mr-4 " style="background:#c84513;">
                                                                       <span style="font-size:10px;" class="status ">Rejected</span>
                                                                     </span>
                                                               <?php
															        }
															
                                                              ?>
                                                              
                                                              
                                                                     
		                                                    <select name="status" class="form-control">
		                                                        <option selected disabled>- Change Task Status -</option>
		                                                        <option value="0"  <?php if($json_data['task_status']== 0) echo 'selected="selected"'; ?> >Pending</option>
		                                                        <option value="1"  <?php if($json_data['task_status']== 1) echo 'selected="selected"'; ?>>Approved</option>
		                                                        <option value="2"  <?php if($json_data['task_status']== 2) echo 'selected="selected"'; ?>>Rejected</option>
		                                                        
		                                                    </select>
		                                             
		                                            </div>
		                                            </div>
		                                            <div class="col-md-5 ">
		                                                <div class="form-group">
		                                                    <label class="control-label">Task Code<star>*</star></label>
		                                                    <input class="form-control" type="text" placeholder="Task Code" value="<?php echo $json_data['task_code'];?>" readonly>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="row">
		                                            <div class="col-md-5 col-md-offset-1">
		                                                <div class="form-group">
		                                                    <label class="control-label">Attributes</label>
		                                                    <input class="form-control"  type="text" name="attributes" placeholder="Attributes" value="<?php echo $json_data['attributes'];?>">
		                                                </div>
		                                            </div>
		                                            <div class="col-md-5">
		                                             <div class="form-group">
		                                                    <label class="control-label">Total Tags<star>*</star></label>
		                                                    <input class="form-control" type="text" name="t_tags" placeholder="Total Tags" value="<?php echo $json_data['total_tags'];?>">
		                                                </div>
		                                            </div>
		                                        </div>
		                                        
		                                        <div class="row">
		                                            <div class="col-md-5 col-md-offset-1">
		                                                <div class="form-group">
		                                                    <label class="control-label">A.W.M</label>
		                                                    <input class="form-control" type="text" name="update_a_w_m" placeholder="Att with mistakes" value="<?php echo $json_data['a_w_m'];?>" >
		                                                </div>
		                                            </div>
		                                            <div class="col-md-5">
		                                                <div class="form-group">
		                                                    <label class="control-label">T.W.M</label>
		                                                    <input class="form-control" type="text" name="update_t_w_m" placeholder="Tags with mistakes" value="<?php echo $json_data['t_w_m'];?>">
		                                                </div>
		                                            </div>
		                                        </div>
		                                        
		                                        
		            					    </div>
	            					</div>
		            				<div class="card-footer">
    		            				    <?php
    		            				     if($json_data['task_status']==0)
    										 {
    		            				     ?>
		                                     <a t class="btn btn-default btn-fill btn-wd btn-back pull-left" href="https://manage.paypertag.tk/dashboard?page=task&sub=pt" style="">Back</a>
		                                 <?php
									        }else  if($json_data['task_status']==1)
									        {
									      
                                         ?>
                                        <a t class="btn btn-default btn-fill btn-wd btn-back pull-left" href="https://manage.paypertag.tk/dashboard?page=task&sub=at" style="">Back</a>
                                        
                                        
                                        <?php
									        }else  if($json_data['task_status']==2)
									        {
									      
                                      ?>
                                        <a t class="btn btn-default btn-fill btn-wd btn-back pull-left" href="https://manage.paypertag.tk/dashboard?page=task&sub=rt" style="">Back</a>
                                       <?php
									        }
															
                                    ?>
		                                
		                                <button type="submit" class="btn btn-info btn-fill btn-wd btn-next pull-right" name="update">update</button>
		                              
		                                <div class="clearfix"></div>
		            				</div>
	                        	</form>
	                    	</div>
	                	</div>
	            	</div>
	        	</div>