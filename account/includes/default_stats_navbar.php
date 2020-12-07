  <?php
    //GETTING DATA FOR PREVIOUS WEEK
   
                $dtFrom = new DateTime; // get current date
                $dtTo = new DateTime;
                
                // format for previous week (no previous year check)
                $dtFrom->setISODate($dtFrom->format('o'), $dtFrom->format('W') - 1);
                // do the same for end date range
                $dtTo->setISODate($dtTo->format('o'), $dtTo->format('W') );
                // subtract 1 day
                $dtTo->sub(new DateInterval('P1D') );
                // convert to iso date for database use
                $dFrom = $dtFrom->format('Y-m-d');
                $dTo   = $dtTo->format('Y-m-d');
                
                
       //GETTING DATA FOR CURRENT WEEK

                $dtFrom_current = new DateTime; // get current date
                $dtTo_current   = new DateTime;
                
                $dtFrom_current->setISODate( $dtFrom_current->format( 'o' ), $dtFrom_current->format( 'W' ) );
                
                $dtTo_current->setISODate( $dtTo_current->format( 'o' ), $dtTo_current->format( 'W' ) );
                // add 1 day
                $dtTo_current->add( new DateInterval( 'P6D' ) );
                
                // convert to iso date for database use
                 $dFrom_current = $dtFrom_current->format( 'Y-m-d' );
             
                 $dTo_current = $dtTo_current->format( 'Y-m-d' );
                 
                 
              
              
                  //calculating current week earings 
                 
                           $approved = 1;
                           
                                $sql_prepare_current = 'SELECT sum(usd) AS current_week_earning FROM global_tasks WHERE c_date between "'.$dFrom_current.'" AND "'.$dTo_current.'" AND task_status ="'.$approved.'" AND tagr_id = "'.$_SESSION['tagr_id'].'"';
                                                                     
                                $current_week = mysqli_query($con,$sql_prepare_current);  
                                $current = mysqli_fetch_array($current_week);
                                 
                                            
                                                                          
   ?>
          
 <?php
    if($_SESSION['tagr_type'] ==2 && $_SESSION['status'] !== 0)
     {
 ?>
      
        <div class="row align-items-center py-4">
            <div class="col-lg-5 col-6">
           
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="dashpanel"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="dashpanel?p=home">dashpanel</a></li>
                   <?php
                           if($_GET['p']=='home')
                            {
                               echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashpanel?p=home">Home</a></li>';
                            }
                            else if($_GET['p']=='new_task')
                            {
                                 
                                   echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashpanel?p=new_task">New Task</a></li>';
                            }
                            else if($_GET['p']=='preview_task')
                            {
                             
                               echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashpanel?p=preview_task">Preview</a></li>';
                            }
                            else if($_GET['p']=='calender')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashpanel?p=calender">Calender</a></li>';
                            }
                             else if($_GET['p']=='profile')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashpanel?p=profile">My Profile</a></li>';
                            }
                            
                              else if($_GET['p']=='settings')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="p"><a href="dashpanel?p=settings">Profile Settings</a></li>';
                            }
                              else if($_GET['p']=='pending')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="p"><a href="dashpanel?p=pending">Pending Tasks</a></li>';
                            }
                              else if($_GET['p']=='approved')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="p"><a href="dashpanel?p=approved">Approved Tasks</a></li>';
                            }
                               else if($_GET['p']=='payments')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="p"><a href="dashpanel?p=payments">payments</a></li>';
                            }
                            
                             else if($_GET['p']=='task_updating')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="p"><a href="dashpanel?p=task_updating">Status-Updater</a></li>';
                            }
                            
                  ?>
            
                  
                  
                </ol>
              </nav>
            </div>
            
            
            
            <div class="col-lg-12 col-12 text-center">
                
                <a href="#" class="btn btn-sm btn-default" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#mistake-search" style="background: rgb(21, 39, 69) !important;"><i class="fas fa-search-minus"></i> Find Tagging Mistakes</a>
                
             
                 <a href="https://www.google.com/search?q=stopwatch" class="btn btn-sm btn-neutral" target="_blank"><i class="fas fa-stopwatch"></i> StopWatch</a>
                <a href="dashpanel?p=new_task" class="btn btn-sm btn-neutral"><i class="fas fa-plus"></i> New Task</a>
              
              
             
              
              
                <a href="#" class="btn btn-sm btn-dark">
                    <i class="fas fa-money-check-alt text-success"></i>
                    Balance : <?php 
                    
                                                                     if($current['current_week_earning'] <=0 || $current['current_week_earning'] == '')
                                                                     {
                                                                         echo  '$0.00';
                                                                     }
                                                                     else
                                                                     {
                                                                         echo '$'.number_format((float)$current['current_week_earning'], 2, '.', '');  
                                                                     }
                    ?></a>
                
                
                
                
            </div>
          </div>
          
<?php
}else if($_SESSION['tagr_type'] ==1 && $_SESSION['status'] !== 0)
{
?>

       <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
           
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="dashboard"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="dashboard?page=home">Dashboards</a></li>
                   <?php
                           if($_GET['page']=='home')
                            {
                               echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashboard?page=home">Home</a></li>';
                            }
                            else if($_GET['page']=='new_task')
                            {
                                 
                                   echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashboard?page=new_task">New Task</a></li>';
                            }
                            else if($_GET['page']=='preview_task')
                            {
                             
                               echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashboard?page=preview_task">Preview</a></li>';
                            }
                            else if($_GET['page']=='calender')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashboard?page=calender">Calender</a></li>';
                            }
                             else if($_GET['page']=='profile')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashboard?page=profile">My Profile</a></li>';
                            }
                            
                              else if($_GET['page']=='settings')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashboard?page=settings">Profile Settings</a></li>';
                            }
                                else if($_GET['page']=='payments')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashboard?page=payments">payments</a></li>';
                            }
                            
                              else if($_GET['page']=='new_team_task')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashboard?page=new_team_task">Team Task</a></li>';
                            }
                                else if($_GET['page']=='policy')
                            {
                                 echo '<li class="breadcrumb-item active" aria-current="page"><a href="dashboard?page=policy">Terms&Cond</a></li>';
                            }
                            
                  ?>
            
                  
                  
                </ol>
              </nav>
            </div>
            
            
            
            <div class="col-lg-12 col-12 text-center">
           
           
           
                 
            
              
             
               
                
                
                <ul class="list-inline ">
                  <li class="list-inline-item">
                      
                   <a href="#" class="btn btn-sm btn-default" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#mistake-search" style="background: rgb(21, 39, 69) !important;"><i class="fas fa-search-minus"></i> Find Tagging Mistakes</a>
                  
                  </li>
                  <li class="list-inline-item">
                      <a href="https://www.google.com/search?q=stopwatch" class="btn btn-sm btn-neutral" target="_blank"><i class="fas fa-stopwatch"></i> StopWatch</a>
                  </li>
                  <li class="list-inline-item">   
                  <a href="dashboard?page=new_task" class="btn btn-sm btn-neutral"><i class="fas fa-plus"></i> New Task</a>
                  </li>
                  
                  <li class="list-inline-item ">   
                  <a href="#" class="btn btn-sm btn-dark">
                    <i class="fas fa-money-check-alt text-success"></i>
                    Balance : <?php 
                    
                                                                     if($current['current_week_earning'] <=0 || $current['current_week_earning'] == '')
                                                                     {
                                                                         echo  '$0.00';
                                                                     }
                                                                     else
                                                                     {
                                                                         echo '$'.number_format((float)$current['current_week_earning'], 2, '.', '');  
                                                                     }
                    ?></a>
                 
                  </li>
                  
                </ul>
               
            </div>
          </div>
   <?php
}
?>