             </div>
             </div>
        </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">

  
            
          <div class="row">
            <div class="col">
              <div class="card mb-4 bg-default ">
                                <!-- Card header -->
                              <div class="card-header">
                                  <div class="row align-items-center">
                                    <div class="col-8">
                                      <!-- Title -->
                                      <h3 class="mb-0"><i class="fas fa-eye"></i> Task Status & Earnings</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                         <button type="button" class="btn btn-sm btn-primary mb-3 float-right" data-toggle="modal" data-target="#modal-default"><i class="fas fa-info-circle"></i> Column Shortcut </button>
                                        
                                    </div>
                                  </div>
                                </div>
                                
                                <?php
                                
                                    $sql_prepare_query = 'SELECT task_status,task_code,attributes,total_tags,minutes,avg,a_w_m,t_w_m,usd,cr_d FROM global_tasks WHERE tagr_id= ? order by task_id desc';
                                    $stmt = $con->prepare($sql_prepare_query); 
                                    $stmt->bind_param("i", $_SESSION['tagr_id']);
                                    $stmt->execute();
                                    $stmt->bind_result($task_status,$task_code,$attributes,$total_tags,$minutes,$avg,$a_w_m,$t_w_m,$usd,$cr_d);
                                   
                                
                                ?>
                                
                                
                                <!-- Card body -->
                             
                                  <div class="table-responsive py-2" >
                                      <table class="table table-flush table-dark " id="datatable-basic" >
                                        <thead class="thead-dark" >
                                          <tr>
                                                <th>#</th>
                                                <th>status</th>
                                                <th>Task Assigned Code</th>
                                                <th>Attributes</th>
                                                <th>T.W.A</th>  
                                                <th>Total Tags</th>
                                                <th>Minutes</th>
                                                <th>AVG</th>
                                                <th>A.W.M</th>
                                                <th>T.W.M</th>
                                                <th>USD</th>
                                                <th>Posted At</th>
                                               
                                          </tr>
                                       
                                        </thead>
                                    
                                        <tbody>
                                            
                          <?php
                          
                          
                           $json = array();
                           $i=0;
                               while($stmt->fetch()) 
                               {
                                   
                               $json = array('task_status'=>$task_status,'task_code'=>$task_code,'attributes'=>$attributes,'total_tags'=>$total_tags,'minutes'=>$minutes,'avg'=>$avg,'a_w_m'=>$a_w_m,'t_w_m'=>$t_w_m,'usd'=>$usd,'cr_d'=>$cr_d);
                               $i++;
                          ?>
                                            
                                        <tr >
                                            
                                            
                                            <td><?php echo $i; ?></td>
                                            
                                                <td >
                                                    <?php
                                                         if($json['task_status']==0)
                                                           {
                                                                 echo '<span class="badge badge-dot mr-4">
                                                                        <i class="bg-warning"></i>
                                                                        <span style="font-size:10px;" class="status">pending</span>
                                                                      </span>';
                                                           }
                                                           else if($json['task_status']==1)
                                                           {
                                                                  echo '<span class="badge badge-dot mr-4">
                                                                        <i class="bg-success"></i>
                                                                        <span style="font-size:10px;" class="status">Approved</span>
                                                                      </span>';
                                                           }
                                                           else if($json['task_status']==2)
                                                           {
                                                                  echo '<span class="badge badge-dot mr-4">
                                                                        <i class="bg-danger"></i>
                                                                        <span style="font-size:10px;" class="status">Rejected</span>
                                                                      </span>';
                                                           }
                                                     
                                                    ?>
                                                </td>
                                                
                                                
                                               <td  style="font-size:12px;"><?php echo $json['task_code']; ?></td>
                                               
                                                <td><?php
                                              
                                                
                                                 if($json['attributes']==0 || $json['attributes']=='')
                                                   {
                                                         echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                   }else
                                                   {
                                                        echo $json['attributes'];
                                                   }
                                                 
                                                
                                                
                                                ?></td>
                                                
                                                
                                               <td><?php echo  $tag_without_attribute = $json['total_tags'] - $json['attributes']; ?></td> 
                                               
                                               
                                               
                                               <td><?php echo $json['total_tags']; ?></td>
                                                
                                                <td><?php 
                                                
                                                 if($json['minutes']==0 || $json['minutes']=='')
                                                   {
                                                         echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                   }else
                                                   {
                                                        echo $json['minutes'];
                                                   }
                                                
                                                ?></td>
                                                
                                                 <td><?php  
                                                             if($json['avg']==0 || $json['avg']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                               else if($json['avg'] > 0 && $json['avg'] <= 14)
                                                               {
                                                                   echo '<span style="background-color:#98ce72;
                                                                                      color:#fff;
                                                                                      padding:2px;
                                                                                      border-top-left-radius:3px;
                                                                                      border-bottom-left-radius:3px;
                                                                                      ">'.$json['avg'].'</span>'.'<span  style="background-color:#000;
                                                                                                                                color:#fff;padding:2px;
                                                                                                                                 border-top-right-radius:3px;
                                                                                                                                 border-bottom-right-radius:3px;">sec</span>';
                                                                }
                                                               else if($json['avg'] > 14 && $json['avg'] <= 16)
                                                               {
                                                                   echo '<span style="background-color:#efd24e;color:#fff;
                                                                                      padding:2px;
                                                                                      border-top-left-radius:3px;
                                                                                      border-bottom-left-radius:3px;">'.$json['avg'].'</span>'.'<span  style="background-color:#000;color:#fff;
                                                                                                                                                                 padding:2px;
                                                                                                                                                                 border-top-right-radius:3px;
                                                                                                                                                                 border-bottom-right-radius:3px;">sec</span>';
                                                                }
                                                                else if($json['avg'] > 16 && $json['avg'] <= 17)
                                                               {
                                                                   echo '<span style="background-color:#FEBE5C;color:#fff;
                                                                                      padding:2px;
                                                                                      border-top-left-radius:3px;
                                                                                      border-bottom-left-radius:3px;">'.$json['avg'].'</span>'.'<span  style="background-color:#000;color:#fff;
                                                                                                                                                                 padding:2px;
                                                                                                                                                                 border-top-right-radius:3px;
                                                                                                                                                                 border-bottom-right-radius:3px;">sec</span>';
                                                                }
                                                              
                                                               else
                                                               {
                                                                    echo '<span style="background-color:#eb4b4b;color:#fff;
                                                                                      padding:2px;
                                                                                      border-top-left-radius:3px;
                                                                                      border-bottom-left-radius:3px;">'.$json['avg'].'</span>'.'<span  style="background-color:#000;color:#fff;
                                                                                                                                                                 padding:2px;
                                                                                                                                                                 border-top-right-radius:3px;
                                                                                                                                                                 border-bottom-right-radius:3px;">sec</span>';
                                                               }
                                                             
                                                       
                                                       ?></td>
                                                       
                                                       
                                                
                                                <td><?php
                                                
                                                 if($json['a_w_m']==0 || $json['a_w_m']=='')
                                                   {
                                                         echo '<span  >------</span>';
                                                   }else
                                                   {
                                                        echo '-'.$json['a_w_m'];
                                                   }
                                                ?></td>
                                                
                                                
                                                
                                                <td><?php
                                                
                                                 if($json['t_w_m']==0 || $json['t_w_m']=='')
                                                   {
                                                         echo '<span  >------</span>';
                                                   }else
                                                   {
                                                        echo '-'.$json['t_w_m'];
                                                   }
                                                ?></td>
                                                
                                                
                                                <td><?php
                                             
                                                        if($json['task_status']==0)
                                                           {
                                                                 echo '<span  >------</span>';
                                                                 
                                                            }
                                                           else if($json['task_status']==1)
                                                           {
                                                                 if($json['usd']==0 || $json['usd']=='')
                                                                   {
                                                                         echo '<span  >------</span>';
                                                                   }else
                                                                   {
                                                                        echo '<span  style="color:#43e972;"#43e972>$'.$json['usd'].'</span>';
                                                                   }
                                                           }
                                                           else if($json['task_status']==2)
                                                           {
                                                                  echo '<span class="badge badge-dot mr-4">
                                                                        <i class="bg-danger"></i>
                                                                        <span style="font-size:10px;" class="status">Refused!</span>
                                                                      </span>';
                                                           }
                                             
                                             
                                                   
                                                   
                                                ?></td>
                                                
                                                <td style="font-size:12px;"><?php echo  date('g:ia \o\n l<\b\\r> jS F Y', strtotime($json['cr_d'])); ?></td>
                                             
                                               
                                       </tr>
                                             <?php } ?>
                                       
                                        
                                        </tbody>
                                      </table>
                                    </div>
         
                              </div>
                    </div>
                  </div>
       
            
          </div>   
          
               <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h6 class="modal-title" id="modal-title-default"><i class="fas fa-info-circle"></i> Column Shortcut's information</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <p>Shortcut's that help you for better understanding of Table Columns.</p>
                            <div class="table-responsive">
                           <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Shortcut</th>
                                <th>Short for</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th>T.W.A </th>
                                <td>Tags without Attributes</td>
                            
                              </tr>
                              <tr>
                                <th>A.W.M</th>
                                <td>Attributes with Mistakes</td>
                              
                              </tr>
                              <tr>
                                <th>T.W.M</th>
                                <td>Tags with Mistakes</td>
                             
                              </tr>
                              
                             
                              
                            </tbody>
                          </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary ml-auto" data-dismiss="modal">Close</button>
                         
                        </div>
                      </div>
                    </div>
                  </div> 
                  
              
          