 
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
              <h5 class="h3 mb-0"><i class="fas fa-calendar-alt"></i> Calendar</h5>
              
               <a href="<?php echo $_SERVER['PHP_SELF'].'?page=calender&week='.($week-1).'&year='.$year; ?>"> <i class="fas fa-arrow-alt-circle-left"></i> Pre Week</a> <!--Previous week-->
               <a class="float-right" href="<?php echo $_SERVER['PHP_SELF'].'?page=calender&week='.($week+1).'&year='.$year; ?>">Next Week <i class="fas fa-arrow-circle-right"></i></a> <!--Next week-->
                                            
            </div>
            <!-- Card body -->
            <div class="card-body p-0">
              <div class="calendar fc fc-unthemed fc-ltr" >
                  
                      
                      <div class="fc-view-container" style="">
                          <div class="fc-view fc-basicWeek-view fc-basic-view" style="">
                              <table class="">
                                  <thead class="fc-head">
                                  <tr>
                                      <td class="fc-head-container fc-widget-header">
                                          <div class="fc-row fc-widget-header">
                                              <table class="">
                                                  <thead>
                                                      
                                                     
                                                        <tr>
                                                          
                                                                <?php
                                                                  $this_week = array();
                                                                        
                                                                do {
                                                                    echo '<th class="fc-day-header fc-widget-header fc-sun fc-past" ><span>' . $dt->format('l') . "<br>" . $dt->format('d M Y') . "</span></th>\n";
                                                                   
                                                                    $date_sheet = $dt->format('Y-m-d'); 
                                                                    array_push($this_week, $date_sheet);  
                                                                    
                                                                    $dt->modify('+1 day');
                                                                  
                                                           
                                                                } while ($week == $dt->format('W'));
                                                              
                                                         
                                                      
                                                                                              
                                                         
                                                                        ?>
                                                        </tr>
               
                                                        
                                               </thead>
                                                        
                                                 </table>
                                           </div>
                                            </td>
                                        </tr>
                                        </thead>
                                                        
                                                        <tbody class="fc-body">
                                                            <tr>
                                                                <td class="fc-widget-content">
                                                            <div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 853.6px;">
                                                                <div class="fc-day-grid fc-unselectable">
                                                                    <div class="fc-row fc-week fc-widget-content" style="height: 853px;">
                                                                        <div class="fc-bg">
                                                                            <table class="">
                                                                            <tbody>
                                                                                <tr> 
                                                                                
                                                                                <td class="fc-day fc-widget-content fc-sun fc-past" >
                                                                                            <?php
                                                                                            foreach($this_week as $key=>$value)
                                                                                               $key_0 ='0'; //monday
                                                                                          
                                                                                               $sql_prepare_query_0 = 'SELECT task_code,total_tags FROM tasks WHERE tagr_id = ? AND c_date = ?';
                                                                                                $stmt_0 = $con->prepare($sql_prepare_query_0); 
                                                                                                $stmt_0->bind_param("is",$_SESSION['tagr_id'],$this_week[$key_0]); 
                                                                                                $stmt_0->execute();
                                                                                                $stmt_0->bind_result($task_code_0,$total_tags_0);
                                                                                                $stmt_0->store_result();
                                                                                                 $stmt_0->num_rows;
                                                                                                $json_0 = array();
                                                                                              if( $stmt_0->num_rows >0)  
                                                                                              {
                                                                                                         while($stmt_0->fetch()) 
                                                                                                           {
                                                                                                               
                                                                                                           $json_0 = array('task_code_0'=>$task_code_0,'total_tags_0'=>$total_tags_0);
                                                                                                           
                                                                                                           $getname=$json_0['task_code_0'];
                                                                                                         
                                                                                                           
                                                                                                           
                                                                                                         echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-success fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">TAGS : '.$json_0['total_tags_0'].'</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                        
                                                                                                             }
                                                                                                 }else
                                                                                                 {
                                                                                                   
                                                                                                      echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-default fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">No Task Found!</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                     
                                                                                                 }
                                                                                               
                                                                                                 ?>
                                                                                     </td>
                                                                                     
                                                                                     
                                                                                   <td class="fc-day fc-widget-content fc-sun fc-past" >
                                                                                         <?php
                                                                                     
                                                                                       $key_1 ='1'; //tuesday
                                                                                       
                                                                                   $sql_prepare_query_1 = 'SELECT total_tags FROM tasks WHERE tagr_id = ? AND c_date = ?';
                                                                                        $stmt_1 = $con->prepare($sql_prepare_query_1);
                                                                                        $stmt_1->bind_param("is",$_SESSION['tagr_id'],$this_week[$key_1]); 
                                                                                        $stmt_1->execute();
                                                                                        $stmt_1->bind_result($total_tags_1);
                                                                                        $stmt_1->store_result();
                                                                                        $stmt_1->num_rows;
                                                                                        $json_1 = array();
                                                                                      if( $stmt_1->num_rows >0)  
                                                                                              {  
                                                                                                     while($stmt_1->fetch()) 
                                                                                                       {
                                                                                                           
                                                                                                       $json_1 = array('total_tags_1'=>$total_tags_1);
                                                                                                      
                                                                                                  
                                                                                                          echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-warning fc-draggable fc-resizable">
                                                                                                              <div class="fc-content">
                                                                                                              <span class="fc-title">TAGS : '.$json_1['total_tags_1'].'</span>
                                                                                                              </div>
                                                                                                        </a>';
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                     }
                                                                                              }else
                                                                                                 {
                                                                                                   
                                                                                                      echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-default fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">No Task Found!</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                     
                                                                                                 }
                                                                                         ?>
                                                                                    </td>
                                                                                         
                                                                                         
                                                                                         
                                                                                   
                                                                                         
                                                                                       <td class="fc-day fc-widget-content fc-sun fc-past" >
                                                                                         <?php
                                                                                     
                                                                                       $key_2 ='2'; //wed
                                                                                       
                                                                                   $sql_prepare_query_2 = 'SELECT total_tags FROM tasks WHERE tagr_id = ? AND c_date = ?';
                                                                                        $stmt_2 = $con->prepare($sql_prepare_query_2);
                                                                                        $stmt_2->bind_param("is",$_SESSION['tagr_id'],$this_week[$key_2]); 
                                                                                        $stmt_2->execute();
                                                                                        $stmt_2->bind_result($total_tags_2);
                                                                                        $stmt_2->store_result();
                                                                                        $stmt_2->num_rows;
                                                                                        $json_2 = array();
                                                                                        
                                                                                      if( $stmt_2->num_rows >0)  
                                                                                              {     
                                                                                                     while($stmt_2->fetch()) 
                                                                                                       {
                                                                                                           
                                                                                                       $json_2 = array('total_tags_2'=>$total_tags_2);
                                                                                                      
                                                                                                  
                                                                                                           echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-info fc-draggable fc-resizable">
                                                                                                              <div class="fc-content">
                                                                                                              <span class="fc-title">TAGS : '.$json_2['total_tags_2'].'</span>
                                                                                                              </div>
                                                                                                        </a>';
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                     }
                                                                                              }else
                                                                                                 {
                                                                                                   
                                                                                                      echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-default fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">No Task Found!</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                     
                                                                                                 }
                                                                                              
                                                                                         ?>
                                                                                    </td>
                                                                                        
                                                                                        
                                                                                        
                                                                                      <td class="fc-day fc-widget-content fc-sun fc-past" >
                                                                                         <?php
                                                                                     
                                                                                       $key_3 ='3'; //thus
                                                                                       
                                                                                   $sql_prepare_query_3 = 'SELECT total_tags FROM tasks WHERE tagr_id = ? AND c_date = ?';
                                                                                        $stmt_3 = $con->prepare($sql_prepare_query_3);
                                                                                        $stmt_3->bind_param("is",$_SESSION['tagr_id'],$this_week[$key_3]); 
                                                                                        $stmt_3->execute();
                                                                                        $stmt_3->bind_result($total_tags_3);
                                                                                        $stmt_3->store_result();
                                                                                        $stmt_3->num_rows;
                                                                                        $json_3 = array();
                                                                                        
                                                                                         if( $stmt_3->num_rows >0)  
                                                                                              {   
                                                                                                     while($stmt_3->fetch()) 
                                                                                                       {
                                                                                                           
                                                                                                       $json_3 = array('total_tags_3'=>$total_tags_3);
                                                                                                      
                                                                                                  
                                                                                                             echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-light fc-draggable fc-resizable">
                                                                                                              <div class="fc-content">
                                                                                                              <span class="fc-title">TAGS : '.$json_3['total_tags_3'].'</span>
                                                                                                              </div>
                                                                                                        </a>';
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                     }
                                                                                              }else
                                                                                                 {
                                                                                                   
                                                                                                      echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-default fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">No Task Found!</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                     
                                                                                                 }
                                                                                         ?>
                                                                                    </td>
                                                                                        
                                                                                <td class="fc-day fc-widget-content fc-sun fc-past" >
                                                                                         <?php
                                                                                     
                                                                                       $key_4 ='4'; //fri
                                                                                       
                                                                                   $sql_prepare_query_4 = 'SELECT total_tags FROM tasks WHERE tagr_id = ? AND c_date = ?';
                                                                                        $stmt_4 = $con->prepare($sql_prepare_query_4);
                                                                                        $stmt_4->bind_param("is",$_SESSION['tagr_id'],$this_week[$key_4]); 
                                                                                        $stmt_4->execute();
                                                                                        $stmt_4->bind_result($total_tags_4);
                                                                                        $stmt_4->store_result();
                                                                                        $stmt_4->num_rows;
                                                                                        $json_4 = array();
                                                                                        
                                                                                        if( $stmt_4->num_rows >0)  
                                                                                              {  
                                                                                                     while($stmt_4->fetch()) 
                                                                                                       {
                                                                                                           
                                                                                                       $json_4 = array('total_tags_4'=>$total_tags_4);
                                                                                                      
                                                                                                  
                                                                                                           echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-warning fc-draggable fc-resizable">
                                                                                                              <div class="fc-content">
                                                                                                              <span class="fc-title">TAGS : '.$json_4['total_tags_4'].'</span>
                                                                                                              </div>
                                                                                                        </a>'; 
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                                     }
                                                                                              }else
                                                                                                 {
                                                                                                   
                                                                                                      echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-default fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">No Task Found!</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                     
                                                                                                 }
                                                                                         ?>
                                                                                    </td>
                                                                                        
                                                                                  <td class="fc-day fc-widget-content fc-sun fc-past" >
                                                                                         <?php
                                                                                     
                                                                                       $key_5 ='5'; //sat
                                                                                       
                                                                                   $sql_prepare_query_5 = 'SELECT total_tags FROM tasks WHERE tagr_id = ? AND c_date = ?';
                                                                                        $stmt_5 = $con->prepare($sql_prepare_query_5);
                                                                                        $stmt_5->bind_param("is",$_SESSION['tagr_id'],$this_week[$key_5]); 
                                                                                        $stmt_5->execute();
                                                                                        $stmt_5->bind_result($total_tags_5);
                                                                                        $stmt_5->store_result();
                                                                                        $stmt_5->num_rows;
                                                                                        $json_5 = array();
                                                                                        
                                                                                       if( $stmt_5->num_rows >0)  
                                                                                                  {     
                                                                                                         while($stmt_5->fetch()) 
                                                                                                           {
                                                                                                               
                                                                                                           $json_5 = array('total_tags_5'=>$total_tags_5);
                                                                                                          
                                                                                                      
                                                                                                               echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-danger fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">TAGS : '.$json_5['total_tags_5'].'</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                      
                                                                                                      
                                                                                                      
                                                                                                         }
                                                                                                  }
                                                                                                  else
                                                                                                 {
                                                                                                   
                                                                                                      echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-default fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">No Task Found!</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                     
                                                                                                 }
                                                                                         ?>
                                                                                    </td>
                                                                                        
                                                                                      <td class="fc-day fc-widget-content fc-sun fc-past" >
                                                                                         <?php
                                                                                     
                                                                                       $key_6 ='6'; //sun
                                                                                       
                                                                                   $sql_prepare_query_6 = 'SELECT total_tags FROM tasks WHERE tagr_id = ? AND c_date = ?';
                                                                                        $stmt_6 = $con->prepare($sql_prepare_query_6);
                                                                                        $stmt_6->bind_param("is",$_SESSION['tagr_id'],$this_week[$key_6]); 
                                                                                        $stmt_6->execute();
                                                                                        $stmt_6->bind_result($total_tags_6);
                                                                                        $stmt_6->store_result();
                                                                                        $stmt_6->num_rows;
                                                                                        $json_6 = array();
                                                                                        
                                                                                           if( $stmt_6->num_rows >0)  
                                                                                                  {   
                                                                                                         while($stmt_6->fetch()) 
                                                                                                           {
                                                                                                               
                                                                                                           $json_6 = array('total_tags_6'=>$total_tags_6);
                                                                                                          
                                                                                                      echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-primary fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">TAGS : '.$json_6['total_tags_6'].'</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                      
                                                                                                         }
                                                                                                         
                                                                                                  }
                                                                                                   else
                                                                                                 {
                                                                                                   
                                                                                                      echo '<a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end bg-default fc-draggable fc-resizable">
                                                                                                                  <div class="fc-content">
                                                                                                                  <span class="fc-title">No Task Found!</span>
                                                                                                                  </div>
                                                                                                            </a>';
                                                                                                     
                                                                                                 }
                                                                                         ?>
                                                                                    </td>
                                                                                </tr>
                                                                              </tbody>
                                                                               </table>
                                                                            </div>
                                                                             
                                                                                         
                                                                      </div>
                                                                    </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
            </div>
          </div>

   
    
       
        