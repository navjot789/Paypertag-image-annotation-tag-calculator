</div>
</div>
</div>
<div class="container-fluid mt--6">





  
      <div class="row ">
        <div class="col-xl-12">
        
      
      
          <div class="row">
            <div class="col">
              <div class="card mb-4" >
                                <!-- Card header -->
                                <div class="card-header">
                                  <h3 class="mb-0"><i class="fas fa-clock"></i> Pending Task List</h3>
                                 
                                </div>
                                
                                <?php
                                
                                    $sql_prepare_query = 'SELECT task_code,attributes,total_tags,minutes,avg,usd,cr_d FROM global_tasks WHERE tagr_id= ?  AND task_status=0 order by task_id desc';
                                    $stmt = $con->prepare($sql_prepare_query); 
                                    $stmt->bind_param("i", $_SESSION['tagr_id']);
                                    $stmt->execute();
                                    $stmt->bind_result($task_code,$attributes,$total_tags,$minutes,$avg,$usd,$cr_d);
                                   
                              
                                    
                                ?>
                                
                                
                                <!-- Card body -->
                             
                                  <div class="table-responsive py-2" >
                                      <table class="table table-flush" id="datatable-basic" >
                                        <thead class="thead-light" >
                                          <tr>
                                             <th>#</th>
                                             <th>Action</th>
                                            <th>Task Code</th>
                                            <th>Attributes</th>
                                            <th>Total Tags</th>
                                            <th>Minutes</th>
                                              <th>Speed/AVG</th>
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
                                              <th>Speed/AVG</th>
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
                                               
                                           $json = array('task_code'=>$task_code,'attributes'=>$attributes,'total_tags'=>$total_tags,'minutes'=>$minutes,'avg'=>$avg,'usd'=>$usd,'cr_d'=>$cr_d);
                                           $i++;
                                      ?>
                                            
                                        <tr  style="background-color:#f3e9a2;">
                                            
                                            <td><?php echo $i; ?></td>
                                            
                                               <td class="text-right">
                                                      <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                                     <a href="dashpanel?p=task_updating&t=<?php echo urlencode(base64_encode($json['task_code']));?>" onclick="return confirm('Are you sure you want to Edit this Task?')" class="dropdown-item" name="delete_task"> <i class="fas fa-edit text-success"></i> Edit</a>
                                                     
                                                      <a href="global/handler.php?p_val=<?php echo urlencode(base64_encode($json['task_code']));?>" onclick="return confirm('Are you sure you want to delete this Task? Beware this Action Cannot be Revoke!')" class="dropdown-item" name="delete_task"> <i class="fas fa-trash-alt text-red"></i> Remove</a>
                                                           
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
                  
            </div>
       
            
          </div>
  
         