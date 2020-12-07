<div class="content">
<div class="container-fluid">
    <div class="row">
	                    <div class="col-md-12">
							<h4 class="title">Local Workers List</h4>
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
											
												<th>TaggerID#</th>
                                                <th>Tagger Type</th>
                                                <th>Username</th>
                                                <th>email</th>
                                                <th>Verification Status</th>
                                             
                                                <th>Join Date</th>
                                                <th class="disabled-sorting">Actions</th>
											</tr>
											</tr>
										</thead>
										<tfoot>
											<tr >
											
												<th>TaggerID#</th>
                                                <th>Tagger Type</th>
                                                <th>Username</th>
                                                <th>email</th>
                                                <th>Verification Status</th>

                                                <th>Join Date</th>
                                                <th class="disabled-sorting">Actions</th>
											</tr>
										</tfoot>
										<tbody>
										    
										   <?php
										   
										         $prepare = 'SELECT username FROM taggers WHERE tagr_id=?';
										         $stmts = $con->prepare($prepare);
										         
										 while($stmt->fetch())
										 {
										     $json_data = array('task_id'=>$task_id,'tagr_id'=>$tagr_id,'task_code'=>$task_code,'attributes'=>$attributes,'total_tags'=>$total_tags,'minutes'=>$minutes,'avg'=>$avg,'usd'=>$usd,'cr_d'=>$cr_d);
                                                                                             
                                                     
                                                   
                                                       $stmts->bind_param('i',$json_data['tagr_id']); 
                                                       $stmts->execute();
                                                       $stmts->bind_result($username); 
                                                       $data = array();
                                                       $stmts->fetch();
                                                       $data = array('username'=>$username);
                                                                                               
										   ?>
										    
											<tr class="warning">
												
												<td><?php echo $json_data['task_id'];?></td>
												<td><?php echo $data['username'];?></td>
												<td><?php echo $json_data['task_code'];?></td>
												
											 <td><?php
                                              
                                                
                                                 if($json_data['attributes']==0 || $json_data['attributes']=='')
                                                   {
                                                         echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                   }else
                                                   {
                                                        echo $json_data['attributes'];
                                                   }
                                                 
                                                
                                                
                                                ?></td>
												
												
												<td><?php echo $json_data['total_tags'];?></td>
												
											
												
												 <td><?php  
                                                             if($json_data['avg']==0 || $json_data['avg']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                               else if($json_data['avg'] > 0 && $json_data['avg'] <= 14)
                                                               {
                                                                   echo '<span style="background-color:#98ce72;
                                                                                      color:#fff;
                                                                                      padding:2px;
                                                                                      border-top-left-radius:3px;
                                                                                      border-bottom-left-radius:3px;
                                                                                      ">'.$json_data['avg'].'</span>'.'<span  style="background-color:#000;
                                                                                                                                color:#fff;padding:2px;
                                                                                                                                 border-top-right-radius:3px;
                                                                                                                                 border-bottom-right-radius:3px;">sec</span>';
                                                                }
                                                               else if($json_data['avg'] > 14 && $json_data['avg'] <= 16)
                                                               {
                                                                   echo '<span style="background-color:#efd24e;color:#fff;
                                                                                      padding:2px;
                                                                                      border-top-left-radius:3px;
                                                                                      border-bottom-left-radius:3px;">'.$json_data['avg'].'</span>'.'<span  style="background-color:#000;color:#fff;
                                                                                                                                                                 padding:2px;
                                                                                                                                                                 border-top-right-radius:3px;
                                                                                                                                                                 border-bottom-right-radius:3px;">sec</span>';
                                                                }
                                                                else if($json_data['avg'] > 16 && $json_data['avg'] <= 17)
                                                               {
                                                                   echo '<span style="background-color:#FEBE5C;color:#fff;
                                                                                      padding:2px;
                                                                                      border-top-left-radius:3px;
                                                                                      border-bottom-left-radius:3px;">'.$json_data['avg'].'</span>'.'<span  style="background-color:#000;color:#fff;
                                                                                                                                                                 padding:2px;
                                                                                                                                                                 border-top-right-radius:3px;
                                                                                                                                                                 border-bottom-right-radius:3px;">sec</span>';
                                                                }
                                                              
                                                               else
                                                               {
                                                                    echo '<span style="background-color:#eb4b4b;color:#fff;
                                                                                      padding:2px;
                                                                                      border-top-left-radius:3px;
                                                                                      border-bottom-left-radius:3px;">'.$json_data['avg'].'</span>'.'<span  style="background-color:#000;color:#fff;
                                                                                                                                                                 padding:2px;
                                                                                                                                                                 border-top-right-radius:3px;
                                                                                                                                                                 border-bottom-right-radius:3px;">sec</span>';
                                                               }
                                                             
                                                       
                                                       ?></td>
												
												
											
											
												<td>
											<div class="dropup">
                                                  <button href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                      Option
                                                      <b class="caret"></b>
                                                  </button>
                                                  <ul class="dropdown-menu">
                                                    <li><a href="#"><i class="fas fa-check-circle text-success"></i> Confirm</a></li>
                                                    <li><a href="#"><i class="fas fa-user-slash text-danger"></i> Block</a></li>
                                                    <li><a href="#"><i class="fas fa-info-circle text-info"></i> Details</a></li>
                                                  
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
	                 </div> 
	                 
	                  </div> 