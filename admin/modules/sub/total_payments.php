

<div class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            	<h4 class="title">Overall Payments Statistics</h4>
							<p class="category">A powerful jQuery plugin handcrafted by our friends from <a href="https://datatables.net/" target="_blank">dataTables.net</a>. It is a highly flexible tool, based upon the foundations of progressive enhancement and will add advanced interaction controls to any HTML table. Please check out the <a href="https://datatables.net/manual/index" target="_blank">full documentation.</a></p>

							<br>
            
	                     
	                                </div>
							
	                          
	                        </div>
	                  
	                    

									            <?php
									        
									          
									            
                                                   
                                                      $sql_prepare = 'SELECT taggers.tagr_id, sum(tasks.attributes),sum(tasks.total_tags),sum(tasks.a_w_m),sum(tasks.t_w_m),sum(tasks.usd), taggers.username 
                                                                       FROM taggers INNER JOIN tasks ON taggers.tagr_id=tasks.tagr_id
                                                                       WHERE tasks.tagr_id=? AND taggers.tagr_type=1 AND taggers.status=1';  //join table tagger and task for getting tags done by each taggger so far
                                                                   
                                                   
                                                         
                                                       $query= 'SELECT tagr_id FROM taggers WHERE tagr_type=1 AND status=1'; //getting tagr_id to run above sql query
                                                       
                                                                 $stmt_query = $con->prepare($query); 
                                                                 $stmt_query->execute();
                                                                 $stmt_query->bind_result($tagger_id_only);
                                                                 $stmt_query->store_result();
                                                                 $j_data = array();
                                                                                    
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
											
												<th>UID#</th>
                                                <th>Username</th>
                                                <th>T.Task Added</th>
                                                 <th>T.Att Done</th>
                                                 <th>T.T.W.A</th>
                                                <th>T.Tags Done</th>
                                                <th>T.Mistakes(A.W.M)</th>
                                                <th>T.Mistakes(T.W.M)</th>
                                              
                                                <th>T.Earnings</th>
                                              
                                            
											</tr>
										</thead>
										<tfoot>
											<tr >
											
											 	<th>UID#</th>
                                                <th>Username</th>
                                                <th>T.Task Added</th>
                                                <th>T.Att Done</th>
                                                <th>T.T.W.A</th>
                                                <th>T.Tags Done</th>
                                                <th>T.Mistakes(A.W.M)</th>
                                                <th>T.Mistakes(T.W.M)</th>
                                             
                                                <th>T.Earnings</th>
                                              
                                            
											</tr>
										</tfoot>
										<tbody>
										    
										    
										   <?php
										   
										    
										         
										           
                            	                $stmts = $con->prepare("SELECT * FROM tasks WHERE tagr_id=?"); //counting the number of task done by each tagger so far
                                              
										         
									while($stmt_query->fetch())
                										 {
                										     $j_data = array('tagger_id_only'=>$tagger_id_only);
                                                     
                                                       
                                                                                                 $stmt = $con->prepare($sql_prepare);
                                                                                                 $stmt->bind_param("i", $j_data['tagger_id_only']);
                                                                                                 $stmt->execute();
                                                                                                 $stmt->bind_result($tagr_id,$sum_of_att,$sum_of_tags,$sum_of_awm,$sum_of_twm,$sum_of_usd,$username);
                                                                                                 $stmt->store_result();
                                                                                                 $json_data = array();
                                                                                                 
                                                                                                 if($stmt->fetch())
                                                                                                 {
                                                                                                  $json_data = array('tagr_id'=>$tagr_id,
                                                                                                                      'totle_attributes_of_tagr'=>$sum_of_att,
                                                                                                                      'totle_tags_of_tagr'=>$sum_of_tags,
                                                                                                                      'totle_of_awm'=>$sum_of_awm,
                                                                                                                      'totle_of_twm'=>$sum_of_twm,
                                                                                                                      'totle_usd_of_tagr'=>$sum_of_usd,
                                                                                                                      'username'=>$username);
                                                                                                 }
                								
                                            
                                                 $stmts->bind_param("i", $j_data['tagger_id_only']);
                                                 $stmts->execute();
                                                 $stmts->num_rows;
                                                 $stmts->store_result();
                                                                                  
										   ?>
										    
											<tr class="active">
												
											<td><?php echo $json_data['tagr_id']; ?></td>
												
											<td><?php echo $json_data['username']; ?></td>
												
												
											
												
													<td><?php  
                                                             if($stmts->num_rows <= 0)
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                    echo '<strong>'.number_format($stmts->num_rows).'<strong>';
                                                               }
                                                             
                                                       
                                                       ?></td>
												
												
												
													<td><?php  
                                                              if($json_data['totle_attributes_of_tagr']==0 || $json_data['totle_attributes_of_tagr']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                    echo number_format($json_data['totle_attributes_of_tagr']);
                                                               }
                                                             
                                                       
                                                       ?></td>
												
												
												
													<td><?php  
												             $t_w_a =	number_format($json_data['totle_tags_of_tagr'] - $json_data['totle_attributes_of_tagr']);
													
                                                              if($t_w_a==0 || $t_w_a =='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                    echo $t_w_a;
                                                               }
                                                             
                                                       
                                                       ?></td>
												
											
													<td><?php  
                                                              if($json_data['totle_tags_of_tagr']==0 || $json_data['totle_tags_of_tagr']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                   echo '<strong>'.number_format($json_data['totle_tags_of_tagr']).'<strong>';
                                                               }
                                                             
                                                       
                                                       ?></td>
											
												
											
											  	
											  	<td><?php  
                                                             if($json_data['totle_of_awm']==0 || $json_data['totle_of_awm']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                    echo '-'.number_format($json_data['totle_of_awm']);
                                                               }
                                                             
                                                       
                                                       ?></td>
											  	
											  	
											  	
											       
											    	<td><?php  
                                                             if($json_data['totle_of_twm']==0 || $json_data['totle_of_twm']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                    echo '-'.number_format($json_data['totle_of_twm']);
                                                               }
                                                             
                                                       
                                                       ?></td>
												
											
												
												
												<td><?php   if($json_data['totle_usd_of_tagr']==0 || $json_data['totle_usd_of_tagr']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                       
                                                                        echo '<strong>'.'<span  style="color:#0cbc3d;">$'.number_format((float)$json_data['totle_usd_of_tagr'], 2, '.', '').'</span>'.'<strong>';
                                                                   }
												
												
												?></td>
												
												
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
	               
	           
	               