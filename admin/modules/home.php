


<div class="container-fluid">
	                <div class="row">
	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-info text-center">

	                                         <i class="fas fa-plus-circle"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>TOTAL TASKS</p>
	                                           
	                                           
	                                             <?php
                                                    //total tasks
                                                                                             $sql_prepare = 'select task_id from tasks';
                                                                                             $stmt = $con->prepare($sql_prepare); 
                                                                                             $stmt->execute();
                                                                                             $stmt->store_result();
                                                                                             
                                                                                            if($stmt->num_rows > 0)
                                                                                                 {
                                                                                                       echo  number_format($stmt->num_rows);
                                                                                                 }else
                                                                                                 {
                                                                                                     echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                                                 }
                                                                                             $stmt->fetch();
                                                                                             $stmt->close();
                                           
                          
                          
                                                    ?>
	                                           
	                                           
	                                           
	                                           
	                                           
	                                           
	                                        </div>
	                                        <div class="numbers">
	                                            
	                                                 <div class="stats">
	                                                     <p>THIS WEEK</p>
									                  
									                     <?php
                                                             //current week tasks
                                                                                          $sql_prepare = 'SELECT task_id FROM tasks WHERE c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" ';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->execute();
                                                                                                 $stmt->bind_result($task_id);
                                                                                                 $stmt->store_result();
                                                                                              
                                                                                                
                                                                                                 if($stmt->num_rows > 0)
                                                                                                     {
                                                                                                        echo  number_format($stmt->num_rows);
                                                                                                     }else
                                                                                                     {
                                                                                                          echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                                                     }
                                                                                                
                                                                                                 $stmt->close();
                                                    ?>
									                  
									                  
									                </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                              <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                  <div class="pull-right" style="position:relative; display:inline-block;">
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Shows the total tasks assigny by taggers."></i>
                                      </div>
                                 <i class="fab fa-stack-overflow text-success"></i> 
                                 
                                 
                                 <?php
                                          //last week tasks
                  
                                                                     $sql_prepare = 'SELECT task_id FROM tasks WHERE c_date between "'.$dFrom.'" AND "'.$dTo.'" ';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->execute();
                                                                     $stmt->bind_result($task_id);
                                                                     $stmt->store_result();
                                                                  
                                                                    
                                                                     if($stmt->num_rows > 0)
                                                                         {
                                                                            echo  number_format($stmt->num_rows);
                                                                         }else
                                                                         {
                                                                              echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                         }
                                                                    
                                                                     $stmt->close();
                                  ?>
                                 
                                    
                                 
                                 
                                 Added Last week
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                    
	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-info text-center">
	                                           <i class="fas fa-plus-circle"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>TOTAL TAGS</p>
	                                              <?php
                                                                //total tags
                                                                                                     $sql_prepare = 'select sum(total_tags) from tasks';
                                                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                                                    $stmt->execute();
                                                                                                     $stmt->bind_result($total_tags);
                                                                                                    $json = array();
                                                                                                    $stmt->fetch();
                                                                                                    $json = array('total_tags'=>$total_tags);
                                                                                                             
                                                                                                       if( $json['total_tags']==0 || $json['total_tags'] == '')
                                                                                                         {
                                                                                                                 echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                                                         }else
                                                                                                         {
                                                                                                                  echo  number_format($json['total_tags']);
                                                                                                         }                                       
                                                                                                       $stmt->close();
                                                   
                                  
                                  
                                                            ?>
	                                        </div>
	                                        <div class="numbers">
	                                            
	                                                 <div class="stats">
	                                                     <p>THIS WEEK</p>
									                     <?php
                                                                       //current week tags
                                                                            $sql_prepare = 'SELECT sum(total_tags) FROM tasks WHERE c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" ';
                                                                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                                                                    
                                                                                                                     $stmt->execute();
                                                                                                                     $stmt->bind_result($total_tags);
                                                                                                                     $json = array();
                                                                                                                     $stmt->fetch();
                                                                                                                     $json = array('total_tags'=>$total_tags);
                                                                                                                           
                                                                                                                       
                                                                                                                       if( $json['total_tags']==0 || $json['total_tags'] == '')
                                                                                                                         {
                                                                                                                                echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                                                                         }else
                                                                                                                         {
                                                                                                                                echo  number_format($json['total_tags']);
                                                                                                                         }
                                                                                                                     
                                                                                                                      $stmt->close();
                                                                  ?>   
                                		 </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				                <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                  <div class="pull-right" style="position:relative; display:inline-block;">
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Shows the total tasks assigny by taggers."></i>
                                      </div>
                                <i class="fas fa-tags text-success"></i> 
                                    <?php
                                          //last week tags
                                                                     $sql_prepare = 'SELECT sum(total_tags) FROM tasks WHERE c_date between "'.$dFrom.'" AND "'.$dTo.'" ';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                   
                                                                     $stmt->execute();
                                                                     $stmt->bind_result($total_tags);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('total_tags'=>$total_tags);
                                                                           
                                                                       
                                                                       if( $json['total_tags']==0 || $json['total_tags'] == '')
                                                                         {
                                                                                echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                         }else
                                                                         {
                                                                                   echo  number_format($json['total_tags']);
                                                                         }
                                                                     
                                                                      $stmt->close();
                  ?>
                                Added Last week
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                    
	                    
	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-danger text-center">
	                                          <i class="fas fa-times-circle"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>TOTAL MISTAKES </p>
	                                              <?php
                                                 //total  mistakes
                                                                     $sql_prepare = 'SELECT (sum(a_w_m) + sum(t_w_m)) FROM tasks';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                   
                                                                     $stmt->execute();
                                                              
                                                                     $stmt->bind_result($total_mistakes);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('total_mistakes'=>$total_mistakes);
                                                                     
                                                                   if( $json['total_mistakes']==0 || $json['total_mistakes'] == '')
                                                                     {
                                                                           echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                     }else
                                                                     {
                                                                            echo  number_format($json['total_mistakes']);
                                                                     }
                                                                                                                 
                                                                      $stmt->close();
                                                                      
                                                                   
                                                             ?>
	                                           
	                                        </div>
	                                        <div class="numbers">
	                                            
	                                                 <div class="stats">
	                                                     <p>THIS WEEK</p>
									                  <?php
                                                           //current week mistakes
                                                                  $sql_prepare = 'SELECT (sum(a_w_m) + sum(t_w_m)) FROM tasks WHERE c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" ';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     
                                                                     $stmt->execute();
                                                                     $stmt->bind_result($total_mistakes);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('total_mistakes'=>$total_mistakes);
                                                                     
                                                                  
                                                                     if( $json['total_mistakes']==0 || $json['total_mistakes'] == '')
                                                                     {
                                                                             echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                     }else
                                                                     {
                                                                           echo  number_format($json['total_mistakes']);
                                                                     }
                                                                                                            
                                                                     
                                                                     
                                                                     
                                                                      $stmt->close();
                                                         ?>
									                </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
							 <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                  <div class="pull-right" style="position:relative; display:inline-block;">
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Shows the total tasks assigny by taggers."></i>
                                      </div>
                                 <i class="fas fa-minus-circle text-success"></i> 
                                 
                        <?php
                            //last week mistakes
                                                                  $sql_prepare = 'SELECT (sum(a_w_m) + sum(t_w_m)) FROM tasks WHERE c_date between "'.$dFrom.'" AND "'.$dTo.'" ';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                   
                                                                     $stmt->execute();
                                                                     $stmt->bind_result($total_mistakes);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('total_mistakes'=>$total_mistakes);
                                                                     
                                                                  
                                                                     if( $json['total_mistakes']==0 || $json['total_mistakes'] == '')
                                                                     {
                                                                             echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                     }else
                                                                     {
                                                                             echo  number_format($json['total_mistakes']);
                                                                     }
                                                                                                            
                                                                     
                                                                     
                                                                     
                                                                      $stmt->close();
                          ?>
                    
                                 Added Last week
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                    
	                    
	                    
	                    
	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-3">
	                                        <div class="icon-big icon-success text-center">
	                                           <i class="fas fa-hand-holding-usd"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-9">
	                                        <div class="numbers">
	                                            <p>OVERALL EARNINGS</p>
	                                             <?php
                  
                                                      function convertCurrency($amount,$from_currency,$to_currency){
                                                          $apikey = '609f99da8b9249ae9aa7'; //other api key: 555b3846e626a2594af9 609f99da8b9249ae9aa7
                                                        
                                                          $from_Currency = urlencode($from_currency);
                                                          $to_Currency = urlencode($to_currency);
                                                          $query =  "{$from_Currency}_{$to_Currency}";
                                                        
                                                          $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
                                                          $obj = json_decode($json, true);
                                                        
                                                          $val = floatval($obj["$query"]);
                                                        
                                                        
                                                          $total = $val * $amount;
                                                          return number_format($total, 2, '.', '');
                                                        }
                                                          
                  
                                                                     $approved = 1;
                                                                     $sql_prepare = 'SELECT sum(usd) FROM tasks WHERE task_status =?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$approved);
                                                                     $stmt->execute();
                                                              
                                                              
                                                                     $stmt->bind_result($total_earn);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('total_earn'=>$total_earn);
                                                                     
                                                                     $navtive_currency = convertCurrency($json['total_earn'], 'USD', 'INR'); //function calling
                                                                     
                                                                     if($json['total_earn'] <=0 || $json['total_earn'] == '')
                                                                     {
                                                                         echo  '$0.00';
                                                                     }
                                                                     else
                                                                     {
                                                                      
                                                                         echo  '$'.number_format((float)$json['total_earn'], 2, '.', '').'<span style="font-size:12px;">/Rs'.$navtive_currency.'</span>'; 
                                                                     }
                                                                     
                                                                      
                                                                      
                                                                      $stmt->close();
                                                                   
                                                              ?>
	                                        </div>
	                                          <div class="numbers">
	                                            
	                                                 <div class="stats">
	                                                     <p>THIS WEEK</p>
									               
									                    <?php      //calculating current week earings
                                                                  
                                                                   $sql_prepare = 'SELECT sum(usd) FROM tasks WHERE c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND task_status =?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$approved);
                                                                     $stmt->execute();
                                                              
                                                                     $stmt->bind_result($current_earn);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('current_earn'=>$current_earn);
                                                                     
                                                                     $navtive_currency = convertCurrency($json['current_earn'], 'USD', 'INR'); //function calling
                                                                     
                                                                   
                                                                      
                                                                       if($json['current_earn']=='' || $json['current_earn']==0 || $json['current_earn'] < 0)
                                                                      {
                                                                             echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                      }else
                                                                      {
                                                                           echo  '$'.number_format((float)$json['current_earn'], 2, '.', '').'<span style="font-size:12px;">/Rs'.$navtive_currency.'</span>'; 
                                                                      }
                                                                        
                                                                      
                                                                      $stmt->close();
                                                            ?>
									               
									               
									                </div>
	                                        </div>
	                                        
	                                    </div>
	                                </div>
	                            </div>
							 <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                  <div class="pull-right" style="position:relative; display:inline-block;">
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Shows the total tasks assigny by taggers."></i>
                                      </div>
                                 <i class="fas fa-coins text-success"></i>
                                 
                                  <?php //calculating last week earings
                                                                     $sql_prepare = 'SELECT sum(usd) FROM tasks WHERE c_date between "'.$dFrom.'" AND "'.$dTo.'" AND task_status =?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$approved);
                                                                     $stmt->execute();
                                                                     $stmt->bind_result($usd);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('usd'=>$usd);
                                                                     
                                                                      $navtive_currency_past_week = convertCurrency($json['usd'], 'USD', 'INR'); //function calling
                                                                      
                                                                      if($json['usd']=='' || $json['usd']==0)
                                                                      {
                                                                             echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                      }else
                                                                      {
                                                                           echo  '$'.number_format((float)$json['usd'], 2, '.', '').'<span style="font-size:12px;">/Rs'.$navtive_currency_past_week.'</span>';  
                                                                      }
                                                                         
                                                                       
                                                                      $stmt->close();
                                    ?>
                                  Last week
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                     <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center">
	                                         <i class="fas fa-hourglass-half"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>PENDING TASKS </p>
	                                             
                                                      <?php
                                                                                                 $pending = 0;
                                                                                                 $sql_prepare = 'select task_id from tasks where task_status= ?';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->bind_param('i',$pending);
                                                                                                 $stmt->execute();
                                                                                                 $stmt->store_result();
                                                                                                 if( $stmt->num_rows >0)
                                                                                                 {
                                                                                                        echo number_format($stmt->num_rows);
                                                                                                 }else
                                                                                                 {
                                                                                                     echo '<span class="text-nowrap" style="color:green;font-size:12px;">No data Found </span><i class="fas fa-smile-beam text-warning"></i>';
                                                                                                 }
                                                                                              
                                                                                                 $stmt->fetch();
                                                                                                 $stmt->close();
                                               
                              
                              
                                                        ?>
                          
	                                        </div>
	                                          <div class="numbers">
	                                            
	                                                 <div class="stats">
	                                                     <p>THIS WEEK</p>
									                    
                              <?php
                                                                      $sql_prepare = 'select task_id from tasks where c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND task_status= ?';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->bind_param('i',$pending);
                                                                                                 $stmt->execute();
                                                                                                 $stmt->store_result();
                                                                                                 if( $stmt->num_rows >0)
                                                                                                 {
                                                                                                        echo number_format($stmt->num_rows);
                                                                                                 }else
                                                                                                 {
                                                                                                    echo '<span class="text-nowrap" style="color:green;font-size:12px;">No data Found </span><i class="fas fa-smile-beam text-warning"></i>';
                                                                                                 }
                                                                                              
                                                                                                 $stmt->fetch();
                                                                                                 $stmt->close();
                       
      
      
                                ?>
                          
									                  
									                  
									                </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
									 <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                  <div class="pull-right" style="position:relative; display:inline-block;">
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Shows the total tasks assigny by taggers."></i>
                                      </div>
                                <i class="fas fa-sync text-warning"></i> 
                                <?php
                                                                      $sql_prepare = 'select task_id from tasks where c_date between "'.$dFrom.'" AND "'.$dTo.'" AND task_status= ?';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->bind_param('i',$pending);
                                                                                                 $stmt->execute();
                                                                                                 $stmt->store_result();
                                                                                                 if( $stmt->num_rows >0)
                                                                                                 {
                                                                                                        echo number_format($stmt->num_rows);
                                                                                                 }else
                                                                                                 {
                                                                                                     echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                                                 }
                                                                                              
                                                                                                 $stmt->fetch();
                                                                                                 $stmt->close();
                       
      
      
                                ?>
                                
                                since Last week
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                    
	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-4">
	                                        <div class="icon-big icon-success text-center">
	                                        <i class="fas fa-clipboard-check"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-8">
	                                        <div class="numbers">
	                                            <p>APPROVED TASKS </p>
	                                             <?php
                                                                     $approved = 1;
                                                                     $sql_prepare = 'select task_id from tasks where task_status= ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$approved);
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                              echo number_format($stmt->num_rows);
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                                                  ?>
	                                        </div>
	                                           <div class="numbers">
	                                            
	                                                 <div class="stats">
	                                                     <p>THIS WEEK</p>
									                  <?php
                                                                  
                                                                     $sql_prepare = 'select task_id from tasks where c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND task_status= ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$approved);
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                              echo number_format($stmt->num_rows);
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                                                  ?>
									                </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
									 <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                  <div class="pull-right" style="position:relative; display:inline-block;">
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Shows the total tasks assigny by taggers."></i>
                                      </div>
                                 <i class="fas fa-check-circle text-success"></i>
                                   <?php
                                                                  
                                                                     $sql_prepare = 'select task_id from tasks where c_date between "'.$dFrom.'" AND "'.$dTo.'" AND task_status= ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$approved);
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                              echo number_format($stmt->num_rows);
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                                                  ?>
                                 Approved Last week
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                    
	                      <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-danger text-center">
	                                       <i class="fas fa-ban"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>REJECTED TASKS </p>
	                                           <?php
                                                                     $reject = 2;
                                                                     $sql_prepare = 'select task_id from tasks where task_status= ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$reject);
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                             echo number_format($stmt->num_rows);
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:green;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                                                    ?>
	                                        </div>
	                                        
	                                           <div class="numbers">
	                                            
	                                                 <div class="stats">
	                                                     <p>THIS WEEK</p>
									                   <?php
                                                                     
                                                                     $sql_prepare = 'select task_id from tasks where c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND task_status= ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$reject);
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                             echo number_format($stmt->num_rows);
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:green;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                                                    ?>
									                </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								 <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                  <div class="pull-right" style="position:relative; display:inline-block;">
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Shows the total tasks assigny by taggers."></i>
                                      </div>
                                 <i class="fas fa-exclamation-circle text-danger"></i> 
                                  <?php
                                                                     
                                                                     $sql_prepare = 'select task_id from tasks where c_date between "'.$dFrom.'" AND "'.$dTo.'" AND task_status= ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$reject);
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                             echo number_format($stmt->num_rows);
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:green;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                                                    ?>
                                 Rejected Last week
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-success text-center">
	                                            <i class="ti-wallet"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>REVENUE</p>
	                                             <?php
                                                                     $reject = 2;
                                                                     $sql_prepare = 'select sum(attributes),sum(total_tags) from tasks where task_status= ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$reject);
                                                                     $stmt->bind_result($attributes,$total_tags);
                                                                     $stmt->execute();
                                                                     $stmt->store_result(); 
                                                                     $arr =array();
                                                                     $stmt->fetch();
                                                                    
                                                                    $arr =array('attributes'=>$attributes,'total_reject_tasks'=>$total_tags);
                                                                     
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                                $att =  ($arr['attributes'] * 0.9)/100;
                                                                                $tags = ($arr['total_reject_tasks'] - $arr['attributes']) * 0.6/100;
                                                                                
                                                                                $navtive_currency = convertCurrency(($att + $tags), 'USD', 'INR'); //function calling
                                                                                echo  '$'.number_format((float)($att + $tags), 2, '.', '').'<span style="font-size:12px;">/Rs'.$navtive_currency.'</span>'; 
                                                                          
                                                                          
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:green;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                    
                                                                     $stmt->close();
                   
  
  
                                                    ?>
	                                        </div>
	                                           <div class="numbers">
	                                            
	                                                 <div class="stats">
	                                                     <p>THIS WEEK</p>
									                 <?php
                                                                     
                                                                     
                                                                     $sql_prepare = 'select sum(attributes),sum(total_tags) from tasks where c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND task_status= ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$reject);
                                                                     $stmt->bind_result($attributes,$total_tags);
                                                                     $stmt->execute();
                                                                     $stmt->store_result(); 
                                                                     $arr =array();
                                                                     $stmt->fetch();
                                                                    
                                                                    $arr =array('attributes'=>$attributes,'total_reject_tasks'=>$total_tags);
                                                                     
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                                $att =  ($arr['attributes'] * 0.9)/100;
                                                                                $tags = ($arr['total_reject_tasks'] - $arr['attributes']) * 0.6/100;
                                                                                
                                                                                echo '$'.($att + $tags); 
                                                                          
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:green;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                    
                                                                     $stmt->close();
                   
  
  
                                                    ?>
									                </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								 <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                  <div class="pull-right" style="position:relative; display:inline-block;">
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Shows the total tasks assigny by taggers."></i>
                                      </div>
                                 <i class="fas fa-chart-line text-success"></i> 
                                   <?php
                                                                     
                                                                     
                                                                     $sql_prepare = 'select sum(attributes),sum(total_tags) from tasks where c_date between "'.$dFrom.'" AND "'.$dTo.'" AND task_status= ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$reject);
                                                                     $stmt->bind_result($attributes,$total_tags);
                                                                     $stmt->execute();
                                                                     $stmt->store_result(); 
                                                                     $arr =array();
                                                                     $stmt->fetch();
                                                                    
                                                                    $arr =array('attributes'=>$attributes,'total_reject_tasks'=>$total_tags);
                                                                     
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                                $att =  ($arr['attributes'] * 0.9)/100;
                                                                                $tags = ($arr['total_reject_tasks'] - $arr['attributes']) * 0.6/100;
                                                                                
                                                                                echo '$'.($att + $tags); 
                                                                          
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:green;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                    
                                                                     $stmt->close();
                   
  
  
                                                    ?>
                                 
                                 Added Last week
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                     <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-success text-center">
	                                           <i class="fas fa-user-check"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>VERIFIED USERS</p>
	                                             <?php
                                                                     
                                                                     $sql_prepare = 'select tagr_id from taggers where tagr_type=1 AND status=1';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                   
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                             echo number_format($stmt->num_rows);
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:red;font-size:12px;">No User Found.</span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                                                    ?>
	                                        </div>
	                                        
	                                    </div>
	                                </div>
	                            </div>
									 <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                  
                                  <i class="fas fa-info-circle text-info"></i> Verified Emails
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                      
	                     <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-4">
	                                        <div class="icon-big icon-warning text-center">
	                                         <i class="far fa-pause-circle"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-8">
	                                        <div class="numbers">
	                                            <p>UNVERIFIED USERS</p>
	                                              <?php
                                                                     
                                                                     $sql_prepare = 'select tagr_id from taggers where tagr_type=1 AND status=0';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                   
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                             echo number_format($stmt->num_rows);
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:green;font-size:12px;">No User Found <i class="fas fa-smile-beam text-warning"></i></span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                                                    ?>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								 <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                 
                                 <i class="fas fa-info-circle text-info"></i> Yet email is not verify
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                     
	                     <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-danger text-center">
	                                          <i class="fas fa-user-slash"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>USERS BAN</p>
	                                            <?php
                                                                     
                                                                     $sql_prepare = 'select tagr_id from taggers where tagr_type=1 AND status=2';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                   
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                             echo number_format($stmt->num_rows);
                                                                     }else
                                                                     {
                                                                           echo '<span class="text-nowrap" style="color:green;font-size:12px;">No User Found <i class="fas fa-smile-beam text-warning"></i></span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                                                    ?>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								 <div class="card-footer">
                                  <hr />
                                  <div class="stats">
                                
                                 <i class="fas fa-info-circle text-info"></i> User Ban due to any reason
                                  </div>
                                  </div>
	                        </div>
	                    </div>
	                    
	                </div>
	                
	                
	                
	                
			
					<div class="row">
						<div class="col-lg-3 col-sm-6">
							<div class="card card-circle-chart" data-background-color="blue">
								<div class="card-header text-center">
	                                <h5 class="card-title">TASKs</h5>
	                                <p class="description">Weekly Tasks Target</p>
	                            </div>
								<div class="card-content">
									<div id="chartDashboard" class="chart-circle" data-percent="70">70%</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="card card-circle-chart" data-background-color="green">
								<div class="card-header text-center">
	                                <h5 class="card-title">TAGs</h5>
	                                <p class="description">Weekly Tags Target</p>
	                            </div>
								<div class="card-content">
									<div id="chartOrders" class="chart-circle" data-percent="34">34%</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="card card-circle-chart" data-background-color="orange">
								<div class="card-header text-center">
	                                <h5 class="card-title">Earning</h5>
	                               <p class="description">Weekly Earning Target</p>
	                            </div>
								<div class="card-content">
									<div id="chartNewVisitors" class="chart-circle" data-percent="63">63%</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="card card-circle-chart" data-background-color="brown">
								<div class="card-header text-center">
	                                <h5 class="card-title">Mistakes</h5>
	                                <p class="description">Monthly newsletter</p>
	                            </div>
								<div class="card-content">
									<div id="chartSubscriptions" class="chart-circle" data-percent="10">10%</div>
								</div>
							</div>
						</div>
					</div>
                </div>