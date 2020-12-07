                 
  
  
   <!-- Card stats -->
          <div class="row">
              
              <div class=" col-md-12" style="overflow:auto;max-height:800px;">
                <div class="card bg-gradient-default">
                <div class="card-body">
                  <h3 class="card-title text-white"><i class="fas fa-info-circle"></i> Information</h3>
                  <blockquote class="blockquote text-white mb-0">
                   <div id="disqus_thread"></div>
                        <script>
                        
                        /**
                        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function() { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = 'https://paypertag.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                        })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
                </div>
              </div>
             </div> 
             
             
            <div class="col-xl-3 col-md-6">
              <div class="card bg-gradient-default border-0">
                   
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Tasks Added </h5>
                      <span class="h2 font-weight-bold mb-0">
                           <?php
                            //total tasks
                                                                     $sql_prepare = 'select task_id FROM global_tasks where tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$_SESSION['tagr_id']);
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     
                                                                    if($stmt->num_rows > 0)
                                                                         {
                                                                              echo '<span style="color:#fff;">'. number_format($stmt->num_rows).'</span>';
                                                                         }else
                                                                         {
                                                                             echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                         }
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                            ?>
                          <h5 class="card-title text-uppercase text-muted mb-0">This week </h5>
                          <?php
                                 //current week tasks
                                                                     $sql_prepare = 'SELECT task_id FROM global_tasks WHERE c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$_SESSION['tagr_id']);
                                                                     $stmt->execute();
                                                                     $stmt->bind_result($task_id);
                                                                     $stmt->store_result();
                                                                  
                                                                    
                                                                     if($stmt->num_rows > 0)
                                                                         {
                                                                                echo '<span style="color:#fff;">'.$stmt->num_rows.'</span>';
                                                                         }else
                                                                         {
                                                                              echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                         }
                                                                    
                                                                     $stmt->close();
                        ?>
                          </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="fas fa-plus-circle"></i>
                      </div>
                    </div>
                  </div>
                  
                  
                  
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fab fa-stack-overflow"></i>
                    
                    <?php
                    //last week tasks
                  
                                                                     $sql_prepare = 'SELECT task_id from global_tasks WHERE c_date between "'.$dFrom.'" AND "'.$dTo.'" AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$_SESSION['tagr_id']);
                                                                     $stmt->execute();
                                                                     $stmt->bind_result($task_id);
                                                                     $stmt->store_result();
                                                                  
                                                                    
                                                                     if($stmt->num_rows > 0)
                                                                         {
                                                                                echo '<span style="color:#fff;">'.$stmt->num_rows.'</span>';
                                                                         }else
                                                                         {
                                                                              echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                         }
                                                                    
                                                                     $stmt->close();
                  ?>
                    
                    
                    
                    
                    
                    </span>
                    <span class="text-nowrap">for last week</span>
                    
                  </p>
                </div>
              </div>
            </div>
            
            
                <div class="col-xl-3 col-md-6">
              <div class="card bg-gradient-default border-0">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Tags Added</h5>
                      <span class="h2 font-weight-bold mb-0">
                          
                          
                                <?php
                                //total tags
                                                                     $sql_prepare = 'select sum(total_tags) from global_tasks where tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$_SESSION['tagr_id']);
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
                                                                                echo '<span style="color:#fff;">'.number_format($json['total_tags']).'</span>';
                                                                         }                                       
                                                                       $stmt->close();
                   
  
  
                            ?>
                  
                          
                          
                          
                          
                          
                      </span>
                      <h5 class="card-title text-uppercase text-muted mb-0">this week</h5>
                       <?php
                       //current week tags
                                                                     $sql_prepare = 'SELECT sum(total_tags) FROM global_tasks WHERE c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$_SESSION['tagr_id']);
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
                                                                               echo '<span style="color:#fff;">'.number_format($json['total_tags']).'</span>';
                                                                         }
                                                                     
                                                                      $stmt->close();
                  ?>
                      
                      
                      
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      <i class="fas fa-plus-circle"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"> <i class="fas fa-tags"></i> 
                    
                      <?php
                      //last week tags
                                                                     $sql_prepare = 'SELECT sum(total_tags) FROM global_tasks WHERE c_date between "'.$dFrom.'" AND "'.$dTo.'" AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$_SESSION['tagr_id']);
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
                                                                                echo '<span style="color:#fff;">'.number_format($json['total_tags']).'</span>';
                                                                         }
                                                                     
                                                                      $stmt->close();
                  ?>
                          
                    
                    
                    </span>
                    <span class="text-nowrap">for last week</span>
                  </p>
                </div>
              </div>
            </div>
            
              <div class="col-xl-3 col-md-6">
              <div class="card bg-gradient-default border-0">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Mistakes Done</h5>
                      <span class="h2 font-weight-bold mb-0">
                          
                      <?php
                    //total  mistakes
                                                                     $sql_prepare = 'SELECT (sum(a_w_m) + sum(t_w_m)) FROM global_tasks WHERE tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$_SESSION['tagr_id']);
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
                                                                           echo '<span style="color:#fff;">'.number_format($json['total_mistakes']).'</span>';
                                                                     }
                                                                                                                 
                                                                      $stmt->close();
                                                                      
                                                                   
                  ?>
                    
                          
                          
                          
                      </span>
                        <h5 class="card-title text-uppercase text-muted mb-0">this week</h5>
                      <?php
                          //current week mistakes
                                                                  $sql_prepare = 'SELECT (sum(a_w_m) + sum(t_w_m)) FROM global_tasks WHERE c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$_SESSION['tagr_id']);
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
                                                                           echo '<span style="color:#fff;">'.number_format($json['total_mistakes']).'</span>';
                                                                     }
                                                                                                            
                                                                     
                                                                     
                                                                     
                                                                      $stmt->close();
                          ?>
                    
                    
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                     <i class="fas fa-times-circle"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fas fa-minus-circle"></i>
                    
                        <?php
                            //last week mistakes
                                                                  $sql_prepare = 'SELECT (sum(a_w_m) + sum(t_w_m)) FROM global_tasks WHERE c_date between "'.$dFrom.'" AND "'.$dTo.'" AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('i',$_SESSION['tagr_id']);
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
                                                                              echo '<span style="color:#fff;">'.number_format($json['total_mistakes']).'</span>'; 
                                                                     }
                                                                                                            
                                                                     
                                                                     
                                                                     
                                                                      $stmt->close();
                          ?>
                    
                    
                    </span>
                    <span class="text-nowrap"> for last week</span>
                  </p>
                </div>
              </div>
            </div>
            
            
            
            
        
            
            
            
            <div class="col-xl-3 col-md-6">
              <div class="card bg-gradient-default border-0">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Earnings</h5>
                      <span class="h4 font-weight-bold mb-0">
                      
                       <?php
                       
                          $sqlFetch=mysqli_query($con, 'SELECT currency_code FROM taggers_details WHERE tagr_id = "'.$_SESSION['tagr_id'].'" ');
                          $detail = mysqli_fetch_assoc($sqlFetch); //getting curency code only
                 
                          if($detail['currency_code'] == '')
                          {
                               $curr = $detail['currency_code'];
                               $curr='PHP';
                          }
                          else{
                                $curr = $detail['currency_code'];
                          }
                            
                  
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
                                                                     $sql_prepare = 'SELECT sum(usd) FROM global_tasks WHERE task_status =? AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('ii',$approved,$_SESSION['tagr_id']);
                                                                     $stmt->execute();
                                                              
                                                              
                                                                     $stmt->bind_result($total_earn);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('total_earn'=>$total_earn);
                                                                     
                                                                     $navtive_currency = convertCurrency($json['total_earn'], 'USD', $curr); //function calling
                                                                     
                                                                     if($json['total_earn'] <=0 || $json['total_earn'] == '')
                                                                     {
                                                                         echo '<span style="color:#fff;">$0.00</span>';
                                                                     }
                                                                     else
                                                                     {
                                                                      
                                                                          echo '<span style="color:#fff;">'.'$'.number_format((float)$json['total_earn'], 2, '.', '').'<span style="font-size:10px;">&nbsp;/&nbsp;'.$curr.' : '.$navtive_currency.' </span> <a href="https://paypertag.tk/account/dashpanel?p=profile" style="font-size:9px;" >(change)</a></span>'; 
                                                                     }
                                                                     
                                                                      
                                                                      
                                                                      $stmt->close();
                                                                   
                  ?>
                    <h5 class="card-title text-uppercase text-muted mb-0">this week</h5>  
                      <?php                                         //calculating current week earings
                                                                   $sql_prepare = 'SELECT sum(usd) FROM global_tasks WHERE c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND task_status =? AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('ii',$approved,$_SESSION['tagr_id']);
                                                                     $stmt->execute();
                                                              
                                                                     $stmt->bind_result($current_earn);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('current_earn'=>$current_earn);
                                                                     
                                                                     $navtive_currency = convertCurrency($json['current_earn'], 'USD', $curr); //function calling
                                                                     
                                                                   
                                                                      
                                                                       if($json['current_earn']=='' || $json['current_earn']==0 || $json['current_earn'] < 0)
                                                                      {
                                                                             echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                      }else
                                                                      {
                                                                             echo '<span style="color:#fff;">'.'$'.number_format((float)$json['current_earn'], 2, '.', '').'<span style="font-size:12px;">&nbsp; /&nbsp;'.$curr.' : '.$navtive_currency.'</span></span>'; 
                                                                      }
                                                                        
                                                                      
                                                                      $stmt->close();
                      ?>
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fas fa-coins" ></i> 
                    <?php                                             //calculating last week earings
                                                                     $sql_prepare = 'SELECT sum(usd) FROM global_tasks WHERE c_date between "'.$dFrom.'" AND "'.$dTo.'" AND task_status =? AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('ii',$approved,$_SESSION['tagr_id']);
                                                                     $stmt->execute();
                                                                     $stmt->bind_result($usd);
                                                                     $json = array();
                                                                     $stmt->fetch();
                                                                     $json = array('usd'=>$usd);
                                                                     
                                                                      $navtive_currency_past_week = convertCurrency($json['usd'], 'USD', $curr); //function calling
                                                                      
                                                                      if($json['usd']=='' || $json['usd']==0)
                                                                      {
                                                                             echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data</span>';
                                                                      }else
                                                                      {
                                                                              echo '<span style="color:#fff;">'.'$'.number_format((float)$json['usd'], 2, '.', '').'<span style="font-size:12px;">/'.
                                                                              $curr.' : '.$navtive_currency_past_week.'</span></span>';  
                                                                      }
                                                                         
                                                                       
                                                                      $stmt->close();
                  ?>
                    
                    </span>
                    <span class="text-nowrap"> for last week</span>
                  </p>
                </div>
              </div>
            </div>
     
            
            
            <div class="col-xl-3 col-md-6">
              <div class="card bg-gradient-default border-0">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">PENDING TASKS</h5>
                      <span class="h2 font-weight-bold mb-0">
                          
                          <?php
                                                                     $pending = 0;
                                                                     $sql_prepare = 'select task_id FROM global_tasks where task_status= ? AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('ii',$pending,$_SESSION['tagr_id']);
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                              echo '<span style="color:#fff;">'.$stmt->num_rows.'</span>';
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                            ?>
                          
                          
                          
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                        <i class="fas fa-hourglass-half"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-info mr-2"><i class="fas fa-info-circle"></i></span>
                    <span class="text-nowrap">Under Review</span>
                  </p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
              <div class="card bg-gradient-default border-0">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">APPROVED TASKS</h5>
                      <span class="h2 font-weight-bold mb-0">
                          
                           <?php
                                                                     $approved = 1;
                                                                     $sql_prepare = 'select task_id FROM global_tasks where task_status= ? AND tagr_id = ?';
                                                                     $stmt = $con->prepare($sql_prepare); 
                                                                     $stmt->bind_param('ii',$approved,$_SESSION['tagr_id']);
                                                                     $stmt->execute();
                                                                     $stmt->store_result();
                                                                     if( $stmt->num_rows >0)
                                                                     {
                                                                             echo '<span style="color:#fff;">'.number_format($stmt->num_rows).'</span>';
                                                                     }else
                                                                     {
                                                                         echo '<span class="text-nowrap" style="color:red;font-size:12px;">No data Found.</span>';
                                                                     }
                                                                  
                                                                     $stmt->fetch();
                                                                     $stmt->close();
                   
  
  
                            ?>
                          
                          
                      </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                       <i class="fas fa-thumbs-up"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fas fa-check-circle"></i> </span>
                    <span class="text-nowrap">verification success</span>
                  </p>
                </div>
              </div>
            </div>
            
            
        
            
               
            
            
            
            
            
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
         <div class="col-md-12">
              <div class="card mb-4">
                                <!-- Card header -->
                                <div class="card-header">
                                  <h3 class="mb-0"><i class="fas fa-globe-asia"></i> Pink Project</h3>
                                 
                                </div>
                                
                                <?php
                               
                                    $sql_prepare_query = 'SELECT tagr_id,total_tags,minutes,avg,usd,cr_d FROM global_tasks order by task_id desc';
                                    $stmt = $con->prepare($sql_prepare_query); 
                                    $stmt->execute();
                                    $stmt->bind_result($tagr_id,$total_tags,$minutes,$avg,$usd,$cr_d);
                                    $stmt->store_result();
                                   
                                            
                                    
                                ?>
                                
                                
                                <!-- Card body -->
                             
                                  <div class="table-responsive py-2" >
                                      <table class="table table-flush" id="datatable-basic" >
                                        <thead class="thead-light" >
                                          <tr>
                                             <th>#</th>
                                             <th>Completed By</th>
                                           
                                          
                                            <th>Total Tags</th>
                                            <th>Minutes</th>
                                            <th>Speed/avg</th>
                                             <th>Earned</th>
                                            <th>Posted At</th>
                                       
                                          </tr>
                                        </thead>
                                        <tfoot>
                                          <tr>
                                             <th>#</th>
                                             <th>Completed By </th>
                                             
                                            
                                            <th>Total Tags</th>
                                            <th>Minutes</th>
                                             <th>Speed/avg</th>
                                             <th>Earned</th>
                                            <th>Posted At</th>
                                         
                                          </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                      <?php
                                      
                                       $json = array();
                                       $i=0;
                                  
                                  
                                           $query2 = $con->prepare('SELECT username FROM taggers WHERE tagr_id = ?');
                                   
                                   
                                   
                                           while($stmt->fetch()) 
                                           {
                                               
                                           $json = array('tagr_id'=>$tagr_id,'total_tags'=>$total_tags,'minutes'=>$minutes,'avg'=>$avg,'usd'=>$usd,'cr_d'=>$cr_d);
                                           $i++;
                                           
                                         
                                                        $query2->bind_param("i", $json['tagr_id']); 
                                                        $query2->execute();
                                                        $query2->bind_result($username);
                                                        $query2->fetch();
                                         
                                               
                                                $user_obj = array('username'=>$username);
                                      ?>
                                            
                                        <tr>
                                            
                                            <td><?php echo $i; ?></td>
                                            <td><?php   echo $user_obj['username'];        ?></td>
                                              
                                                
                                              
                                                
                                                
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
                                                
                                                <td> <?php echo  date('g:ia \o\n l<\b\\r> jS F Y', strtotime($json['cr_d'])); ?></td>
                                              
                                              
                                       </tr>
                                             <?php  } $stmt->close();$query2->close(); ?>
                                       
                                        
                                        </tbody>
                                      </table>
                                    </div>
         
                              </div>
                    </div>
      
    
      
      
      </div>
     </div>
          
          
   
  
    
       