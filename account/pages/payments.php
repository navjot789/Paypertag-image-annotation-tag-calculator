 
 </div>
     </div>
 </div>
 
             
         <?php
         
         
            $dt = new DateTime;
            if (isset($_GET['year']) && isset($_GET['week'])) {
                $dt->setISODate($_GET['year'], $_GET['week']);
            } else {
                $dt->setISODate($dt->format('o'), $dt->format('W'));
            }
            $year = $dt->format('o');
            $week = $dt->format('W');
            
        
             				            
            ?>
 <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <!-- Fullcalendar -->
          <div class="card card-calendar">
            <!-- Card header -->
            <div class="card-header">
              <!-- Title -->
              <h5 class="h3 mb-0"><i class="ni ni-money-coins text-success"></i> Weekly Payments</h5>
              
               <a href="<?php echo $_SERVER['PHP_SELF'].'?page=payments&week='.($week-1).'&year='.$year; ?>"> <i class="fas fa-arrow-alt-circle-left"></i> Pre Week</a> <!--Previous week-->
               
              
                
                
                
               <a class="float-right" href="<?php echo $_SERVER['PHP_SELF'].'?page=payments&week='.($week+1).'&year='.$year; ?>">Next Week <i class="fas fa-arrow-circle-right"></i></a> <!--Next week-->
                
                                            
            </div>
            
           
            
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <?php
                                                              $this_week = array();
                                                                        
                                                                do {
                                                                   // echo '<button type="button" class="btn btn-default" style="margin-bottom:2px;">' . $dt->format('d M Y') . "</button>\n";
                                                                   
                                                                    $date_sheet = $dt->format('Y-m-d'); 
                                                                    array_push($this_week, $date_sheet);  
                                                                    
                                                                    $dt->modify('+1 day');
                                                                  
                                                           
                                                                } while ($week == $dt->format('W'));
                                                                
                                                                
                                                                
                                                            
                                                              
                                                             foreach($this_week as $key=>$value)
                                                                  $key_0 ='0'; //monday
                                                                  
                                                                $timestamp_start = strtotime($this_week[$key_0]);
                                                                $week_start = date('l d-F-Y', $timestamp_start); 
                                                                echo '<button type="button" class="btn btn-default btn-sm" style="margin-bottom:2px;">'.$week_start.'</button>';  
                                                                  
                                                                   echo 'to ';
                                                                  
                                                             foreach($this_week as $key=>$value)
                                                                  $key_6 ='6'; //sunday  
                                                                  
                                                                $timestamp_end = strtotime($this_week[$key_6]);
                                                                $week_end = date('l d-F-Y', $timestamp_end); 
                                                                echo '<button type="button" class="btn btn-default btn-sm" style="margin-bottom:2px;">'.$week_end.'</button>';  
                                                               
                                                               
                                                               
                                                               
                                                 //current week sql queries
									           $sql_prepare = 'SELECT taggers.tagr_id, sum(tasks.attributes),sum(tasks.total_tags),sum(tasks.a_w_m),sum(tasks.t_w_m),sum(tasks.usd), taggers.username 
                                                               FROM taggers INNER JOIN tasks ON taggers.tagr_id=tasks.tagr_id WHERE tasks.c_date BETWEEN "'.$this_week[$key_0].'" AND "'.$this_week[$key_6].'" 
                                                               AND tasks.tagr_id="'.$_SESSION['tagr_id'].'" AND taggers.tagr_type=1 AND taggers.status=1'; //join table tagger and task for getting tags of perticular week.
                                                                   
                                                                                                 $stmt = $con->prepare($sql_prepare);
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
                                                         
                                               //getting total tasks  done by perticular taggger      
                                                $stmts = $con->prepare('SELECT task_id FROM tasks WHERE c_date BETWEEN "'.$this_week[$key_0].'" AND "'.$this_week[$key_6].'" AND tagr_id="'.$_SESSION['tagr_id'].'"');                   
                                                 $stmts->bind_param("i", $j_data['tagger_id_only']);
                                                 $stmts->execute();
                                                 $stmts->num_rows;
                                                 $stmts->store_result(); 
                                                               
          ?>
                                         
                                        
                                                
                                            <button type="button" class="btn btn-sm btn-primary mb-3 float-right" data-toggle="modal" data-target="#modal-default">
                                                <i class="fas fa-info-circle"></i> Column Shortcut </button>
                                                
                                               <a class="btn btn-sm btn-primary mb-3 float-right text-white" ><i class="fas fa-print"></i> Print </a>   
                    
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
                                <th>T.TASK </th>
                                <td>Total Tasks</td>
                            
                              </tr>
                              <tr>
                                <th>T.AT</th>
                                <td>Total Attributes  </td>
                              
                              </tr>
                              <tr>
                                <th>T.T.W.A</th>
                                <td>Total Tags without Attributes</td>
                             
                              </tr>
                              
                              <tr>
                                <th>T.TAGS</th>
                                <td>Total Tags</td>
                             
                              </tr>
                              
                              <tr>
                                <th>T.MISTAKES(A.W.M)</th>
                                <td>Total Mistakes of (Attributes With Mistakes)</td>
                             
                              </tr>
                              
                              <tr>
                                <th>T.MISTAKES(T.W.M)</th>
                                <td>Total Mistakes of (Tags With Mistakes)</td>
                             
                              </tr>
                              
                               <tr>
                                <th>T.EARNINGS</th>
                                <td>Total Earnings</td>
                             
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
              
            
            </div>
             <div class="card-header">
                <h3 class="mb-0">Invoice for Tagger: <?php echo $json_data['username']; ?></h3>
              </div>
            
            <div class="card-body">
       

        
            <div class="table-responsive-sm">
                    <table class="table table-striped">
                                <thead>
                                <tr>
                                        <th class="">T.Task</th>
                                        <th>T.AT </th>
                                        <th>T.T.W.A</th>
                                        <th class="right">T.Tags </th>
                                        <th class="">T.Mistakes(A.W.M)</th>
                                        <th class="right">T.Mistakes(T.W.M)</th>
                                        <th class="right"> T.Earnings</th>
                                
                                </tr>
                                </thead>
                                        <tbody>
                                            
                   <?php
                   if(!$stmts->num_rows <= 0)
                   {
                       if(date('Y-m-d') >= $this_week[$key_0] && date('Y-m-d') <= $this_week[$key_6])  //disabling current week payment invoice
                       {
                            echo   '<tr>
                                        <td colspan="7">
                                        <div class="alert alert-info  fade show text-center" role="alert">
                                             <span class="alert-icon text-default"><i class="fas fa-info"></i></span>
                                             <span class="alert-text"  style="padding:30px;"><strong>Invoice Not Generated!</strong> Current week invoice is not generated yet, check back on monday.</span>
                                                   
                                        </div></td>
                            
                                 </tr>';
                       }
                       else{
                          
                       
                   ?>     
                                            
                                        <tr>
                                        <td class=""><?php  
                                                             if($stmts->num_rows <= 0)
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                    echo '<strong>'.number_format($stmts->num_rows).'<strong>';
                                                               }
                                                             
                                                       
                                                       ?></td>
                                                       
                                                <td class="left strong">
                                                    <?php  
                                                              if($json_data['totle_attributes_of_tagr']==0 || $json_data['totle_attributes_of_tagr']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                    echo number_format($json_data['totle_attributes_of_tagr']);
                                                               }
                                                             
                                                       
                                                       ?>
                                                </td>
                                                
                                                
                                                
                                                <td class="left"><?php  
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
                                                
                                                <td class="right"><?php  
                                                              if($json_data['totle_tags_of_tagr']==0 || $json_data['totle_tags_of_tagr']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                   echo '<strong>'.number_format($json_data['totle_tags_of_tagr']).'<strong>';
                                                               }
                                                             
                                                       
                                                       ?></td>
                                                       
                                                  <td class=""><?php  
                                                             if($json_data['totle_of_awm']==0 || $json_data['totle_of_awm']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                    echo '-'.number_format($json_data['totle_of_awm']);
                                                               }
                                                             
                                                       
                                                       ?></td>
                                                       
                                                       
                                                <td class="right"><?php  
                                                             if($json_data['totle_of_twm']==0 || $json_data['totle_of_twm']=='' )
                                                               {
                                                                   echo '<span  style="background-color:#c0c0c0;color:#fff;padding:2px;border-radius:3px;">N/A</span>';
                                                               }
                                                            
                                                               else
                                                               {
                                                                    echo '-'.number_format($json_data['totle_of_twm']);
                                                               }
                                                             
                                                       
                                                       ?></td>
                                                       
                                                  <td class="right"><?php   if($json_data['totle_usd_of_tagr']==0 || $json_data['totle_usd_of_tagr']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                       
                                                                        echo '<strong>'.'<span  style="color:#0cbc3d;">$'.number_format((float)$json_data['totle_usd_of_tagr'], 2, '.', '').'</span>'.'<strong>';
                                                                   }
												
												
												?></td>
                                        </tr>
                                  
                                     
                                     
                                        </tbody>
            </table>
            </div>
            
            
            
            
            
            <div class="row">
            <div class="col-lg-4 col-sm-5">
            
            </div>
            
            <div class="col-lg-4 col-sm-5 ml-auto">
            <table class="table table-clear">
                        <tbody>
                            
                            <tr>
                            <td class="left">
                            <strong>Subtotal</strong>
                            </td>
                            <td class="right">
                                                             <?php   if($json_data['totle_usd_of_tagr']==0 || $json_data['totle_usd_of_tagr']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                       
                                                                        echo '<strong>'.'<span  style="color:#0cbc3d;">$'.number_format((float)$json_data['totle_usd_of_tagr'], 2, '.', '').'</span>'.'<strong>';
                                                                   }
                                
                                ?>
                                
                            </td>
                            </tr>
                       
                           
                        
                           
                            <tr>
                            <td class="left">
                            <strong>Total</strong>
                            </td>
                            <td class="right">
                            <strong><?php   if($json_data['totle_usd_of_tagr']==0 || $json_data['totle_usd_of_tagr']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                       
                                                                        echo '<strong>'.'<span  style="color:#0cbc3d;">$'.number_format((float)$json_data['totle_usd_of_tagr'], 2, '.', '').'</span>'.'<strong>';
                                                                   }
                                
                                ?></strong>
                            </td>
                            </tr>
                            
                            
                   <?php
                       }
                   }else{
                       
                        
                    ?>
                        
                         
                        
                        
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-warning  fade show text-center" role="alert" >
                                     <span class="alert-icon" ><i class="fas fa-exclamation-triangle"></i></span>
                                     <span class="alert-text" style="padding:30px;"><strong>No Invoice Found!</strong> There is No Work done for this week.</span>
                                           
                             </div></td>
                            
                        </tr>
                        
                        
                        
                   <?php
                    
                       
                   }
                   ?>         
                            
                            
                            
                            
                        
                        </tbody>
            </table>
            
            </div>
            
            </div>
            
            </div>
            </div>
          </div>    
          
          
           </div>
            </div>
          </div>
          </div>
 


       
        