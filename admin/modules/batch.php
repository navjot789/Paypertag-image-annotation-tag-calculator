
<?php



                                              
if(isset($_POST['hit']))
{
  
    $b_name = mysqli_real_escape_string($con,htmlentities($_POST['b_name']));
    $status = mysqli_real_escape_string($con,htmlentities($_POST['status']));
   
 
    if(!empty($b_name) || !empty($status))
    {
                                               
                                         
                                               
                                               
                                                $sql_prepare = 'INSERT INTO batch(batch_name,status,cr_d) VALUES( ?, ?, ?)';
                                                $stmt = $con->prepare($sql_prepare); 
                                                $stmt->bind_param('sis',$b_name,$status,$current_date);
                                                if($stmt->execute())
                                                 {
                                                 
                                                     
                                                
                                                     echo '<div class="alert alert-success">
                    	                                 
                    	                                    <span><i class="fas fa-check-circle"></i> <b> Success - </b> New Batch Added successfully!</span>
                    	                                    </div>';
                    	                                    
                    	                                    
                                                     $stmt->close();
                                                 }
                                                 else
                                                 {
                                                      echo 'ERROR';
                                                 }
                                               
                                               
                                                  
                                               
                                               
                                               
    }else
    {
                    echo '<div class="alert alert-danger">
                    	                   <span><i class="fas fa-exclamation-triangle"></i> <b> Empty fields Detected - </b> Both Fields are Required!</span>
                    	                                    </div>';
    }
       
}


?>






<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            	<h4 class="title">Batch & Management</h4>
							<p class="category">A powerful jQuery plugin handcrafted by our friends from <a href="https://datatables.net/" target="_blank">dataTables.net</a>. It is a highly flexible tool, based upon the foundations of progressive enhancement and will add advanced interaction controls to any HTML table. Please check out the <a href="https://datatables.net/manual/index" target="_blank">full documentation.</a></p>

							<br>
            
	                        <div class="card">
	                            <form id="registerFormValidation"  method="post" novalidate="novalidate">
	                                <div class="card-header">
										<h4 class="card-title">
										Adding Current/upcomming Batch
										</h4>
									</div>
	                                <div class="card-content">
	                                    <fieldset>
		                                    <div class="form-group column-sizing">
		                                    	<label class="col-sm-12 control-label">
												Add New Batch Information
												</label>
	                                    		<div class="col-sm-6">
	                                				<input class="form-control" id="idSource" type="text" placeholder="Batch Name" name="b_name">
	                                    		</div>
		                                    
		                                		
		                                	<div class="col-sm-6">
		                                                
		                                                    <select name="status" class="form-control">
		                                                        <option selected disabled="">- Batch Status -</option>
		                                                        
		                                                       <option  value="0">- Disabled -</option>
		                                                        <option value="1">- Active -</option>
		                                                        <option value="2">- Upcomming -</option>
		                                                    </select>
		                                      </div>
		                                  
		                                 </div>
		                                 </fieldset>
		                                     <p></p>
		                                <fieldset>
    	                                   
    	                                   
    	                                 
    	                                    
    	                                  
    	                                   
    	                                    
    	                                     <div class="form-group column-sizing ">
		                                    
	                                         	 <div class="col-sm-12">
                                                      <button type="submit" name="hit" class="btn btn-fill btn-success btn-wd" style="float:right;">Submit</button>
	                                            </div>
		                                	
		                                    </div>
    	                                    
	                                    </fieldset> 
		                             </div>
		                               
		                            
	                                    </form>
	                            </div>
	                                </div>
							
	                          
	                        </div>
	                  
	                    
	                
							<h4 class="title">Batches</h4>
							<p class="category">A powerful jQuery plugin handcrafted by our friends from <a href="https://datatables.net/" target="_blank">dataTables.net</a>. It is a highly flexible tool, based upon the foundations of progressive enhancement and will add advanced interaction controls to any HTML table. Please check out the <a href="https://datatables.net/manual/index" target="_blank">full documentation.</a></p>

							<br>

									            <?php
									            
									            //task deleting script
									             include "task_handler.php";
									            
									            
                                                      //all pending tasks by taggers  
                                                   $sql_prepare = 'SELECT task_id,tagr_id,task_code,attributes,total_tags,minutes,avg,usd,cr_d FROM tasks WHERE task_status=0 ';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->execute();
                                                                                                 $stmt->bind_result($task_id,$tagr_id,$task_code,$attributes,$total_tags,$minutes,$avg,$usd,$cr_d);
                                                                                                 $stmt->store_result();
                                                                                                 $json_data = array();
                                                                                                
                                                                                                
                                                    ?>
									                  
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="toolbar">
	                                    <!--Here you can write extra buttons/actions for the toolbar-->
	                                </div>
                                    <div class="fresh-datatables">
										<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										<thead>
											<tr>
											
												<th>Batch ID#</th>
                                                <th>Batch Name</th>
                                                <th>Status</th>
                                              
                                                <th>Posted At</th>
                                                <th class="disabled-sorting">Actions</th>
											</tr>
										</thead>
										<tfoot>
											<tr >
											
											    <th>Batch ID#</th>
                                                <th>Batch Name</th>
                                                <th>Status</th>
                                              
                                                <th>Posted At</th>
                                                <th class="disabled-sorting">Actions</th>
											</tr>
										</tfoot>
										<tbody>
										    
										   <?php
										   
										         $prepare = 'SELECT b_id,batch_name,status,cr_d FROM batch';
										         $stmts = $con->prepare($prepare);
										         $stmts->execute();
										         $stmts->bind_result($b_id,$batch_name,$status,$cr_d);
										         $data = array(); 
										 while($stmts->fetch())
										 {
										     $json_data = array('b_id'=>$b_id,'batch_name'=>$batch_name,'status'=>$status,'cr_d'=>$cr_d);
                                                                                                
										   ?>
										    
											<tr class="dark">
												
											<td><?php echo $json_data['b_id'];?></td>
												
											 <td><?php
                                              
                                                
                                                 if($json_data['batch_name']=='')
                                                   {
                                                         echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                   }else
                                                   {
                                                        echo $json_data['batch_name'];
                                                   }
                                                 
                                                
                                                
                                                ?></td>
												
												
												<td><?php 
												            if($json_data['status'] == 0)
												            {
												                echo	'<button class="btn btn-default  btn-sm "><i class="fas fa-ban text-default"></i> Disabled</button>';
												                
												            }else if($json_data['status'] == 1)
											            	{
											            	       echo	' <button class="btn btn-success  btn-sm "><i class="fas fa-check-circle text-success"> Active</button>';
											            	}else{
											            	          echo	'  <button class="btn btn-sm btn-warning "><i class="fas fa-hourglass-half text-warning"></i> Upcomming</button>';
											            	}
											            
												
												
												?></td>
												
											
												
												 <td style="font-size:12px;"><?php echo $new = date('g:ia \o\n l<\b\\r> jS F Y', strtotime($json_data['cr_d'])); ?></td>
											
												<td>
											
												   <div class="dropup">
                                                  <button href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                      Option
                                                      <b class="caret"></b>
                                                  </button>
                                                  
                                                  
                                                  <ul class="dropdown-menu">
                                                      
                                                        <?php
                                                          if($json_data['status'] == 1) //if status is already active
    												            {
                                                        ?> 
                                                          <li><a href="dashboard?page=batch_edit&s=2&batch=<?php echo urlencode(base64_encode($json_data['b_id']));?>">
                                                              <i class="fas fa-hourglass-half text-warning"></i> Upcomming</a></li>
                                                          
                                                          <li><a href="dashboard?page=batch_edit&s=0&batch=<?php echo urlencode(base64_encode($json_data['b_id']));?>"><i class="fas fa-ban text-default"></i> Disable</a></li>
                                                        
                                                      <?php
    												            }else if($json_data['status'] == 0) // disabled
    												            {
                                                      ?>
                                                      
                                                           <li><a href="dashboard?page=batch_edit&s=1&batch=<?php echo urlencode(base64_encode($json_data['b_id']));?>"><i class="fas fa-check-circle text-success"></i> Activate</a></li>
                                                           <li><a href="dashboard?page=batch_edit&s=2&batch=<?php echo urlencode(base64_encode($json_data['b_id']));?>"><i class="fas fa-hourglass-half text-warning"></i> Upcomming</a></li>
                                                      
                                                      <?php
                                                           }else if($json_data['status'] == 2) // upcomming
    												            {
                                                      ?>
                                                      
                                                           <li><a href="dashboard?page=batch_edit&s=1&batch=<?php echo urlencode(base64_encode($json_data['b_id']));?>"><i class="fas fa-check-circle text-success"></i> Activate</a></li>
                                                           <li><a href="dashboard?page=batch_edit&s=0&batch=<?php echo urlencode(base64_encode($json_data['b_id']));?>"><i class="fas fa-ban text-default"></i> Disable</a></li>
                                                      
                                                      <?php
                                                            }
                                                      ?>
                                                  
                                                    
                                                     <li><a href="dashboard?page=batch_edit&b=<?php echo urlencode(base64_encode($json_data['b_id']));?>" onclick="return confirm('Are you sure you want to remove this Batch?')" ><i class="fas fa-trash-alt text-danger"></i> Remove</a>
                                                     </li>
                                                  
                                                  </ul>
                                                  
                                                  
                                            </div>
											    
											     
												</td>
											</tr>
										
											<?php
										 }  $stmt->close();
											?>
										   </tbody>
									    </table>
									</div>


	                            </div>
	                        </div><!--  end card  -->
	                    </div> <!-- end col-md-12 -->
	                </div> <!-- end row -->
	               