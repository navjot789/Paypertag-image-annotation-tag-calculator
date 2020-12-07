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
                                  <h3 class="mb-0"><i class="fas fa-eye"></i> Task Status & Earnings</h3>
                                 
                                </div>
                                
                                <?php
                                
                                    $sql_prepare_query = 'SELECT task_status,task_code,attributes,total_tags,minutes,avg,a_w_m,t_w_m,usd,cr_d FROM tasks WHERE tagr_id= ? order by task_id desc';
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
          
          
          