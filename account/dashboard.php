<?php
include_once("../connection/connect.php");
include_once("../connection/db.php");
session_start();

 $url = $_SERVER['REQUEST_URI']; //returns the current URL
 $parts = parse_url($url); //divide the url into parts(path,query)
            
          

if(isset($_SESSION['tagr_type']) && $_SESSION['tagr_type'] == 1)
{


        
        
        if (!isset($_SESSION['loggedin']) && !isset($_SESSION['tagr_id']) && $_SESSION['status'] == 0) // If the user is not logged in redirect to the login page...
        {
        	header('Location: ../login');
        	exit();
        
        }
        else if($parts['path']=='/account/dashboard' && $parts['query']=='') //Reason: Due to Disqus.com(if url is account/dashboard redirect back to account/dashboard?page=home )
        {
            header('Location: dashboard?page=home');
        	exit();
        }
        
        
        
        else
        {
        ?>
        
        <!DOCTYPE html>
        <html>
        
          <?php 
                  include "includes/head.php";
          ?>
        </head>
        
        <body>
          
          <!-- Sidenav -->
           <?php 
                  include "includes/navbar.php";
          ?>
          <!-- Main content -->
          <div class="main-content" id="panel">
            <!-- Topnav -->
           
            <?php 
                  include "includes/dashboard_top_navbar.php";
          ?>
          
            <div class="header bg-primary pb-6">
              <div class="container-fluid">
                <div class="header-body">
                    
                      <!-- Top_sub_nav -->
                       <?php 
                       
                                  include "includes/default_stats_navbar.php";
                          ?>
                                    
                    
                 <?php 
                 
                 
                  $page_array =array('home', 'new_task','new_team_task','preview_task','calender','pending','approved','payments','profile','settings','policy','task_updating','find-mistakes');
        
        if(in_array($_GET['page'], $page_array) && $_GET['page'] !=='')
        {
           $key = array_search($_GET['page'], $page_array);//getting key 
            $value = $page_array[$key];//getting values
           
           switch ($value)
           {
              
                 case "home": include "pages/home.php";
                    break;
                    
                 case "new_task": include "pages/add_task.php";
                    break;
                    
                 case "new_team_task": include "pages/add_team_task.php";
                    break;
                    
                 case "preview_task": include "pages/preview_task.php";
                    break;
                    
                 case "calender": include "pages/calender.php";
                    break;
                    
                 case "pending": include "pages/pending_task.php";
                    break;
                    
                 case "approved": include "pages/approved_task.php";
                    break;
                    
                 case "payments": include "pages/payments.php";
                    break;
                
                 case "profile": include "pages/profile.php";
                    break;
                    
                 case "settings": include "pages/settings.php";
                    break;
                
                 case "policy": include "pages/policy.php";
                    break;    
                    
                
             
                                //Hidden Pages
                                
                   case "task_updating": include "pages/task_status_update.php";
                     break;
                
                   case "find-mistakes": include "pages/mistake_finder.php";
                     break;
                
                   default:include "pages/home.php";
            }
           
           
        }else{
            echo '<H3>Page Not Found!</H3>';
        }
                 
             ?>
               
           
            
               
                    </div>
                    
                  </div>
                </div>
              </div> 
              
              
              
              
             <!--Tagging Mistake Modal-->
                    <div class="modal fade" id="mistake-search" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h6 class="modal-title" id="modal-title-default"><i class="fas fa-search-minus"></i> Mistakes search Form</h6>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <p>Finding your tagging mistakes are now easy, all you have to do is to enter the TASK CODE below.</p>
                    
                    
                    <div class="card-body px-lg-5 ">
                          <div class="text-center text-muted mb-4">
                            <small class="text-success">https://worker.microwork.io/tagging-mistakes/<code>[CODE]</code></small>
                          </div>
                          
                          <?php
                          
                          if(isset($_POST['hit']))
                          {
                             if(strlen($_POST['code']) <= 16 || strlen($_POST['code']) > 17 )
                              {
                                  $error =   	'<div class="alert alert-danger">  
                                                                                  <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                    <strong>Invalid Task Code!</strong> Please Enter Valid Task Code</a>. 
                                                                                    </div>  ';
                              }else{  
                              
                                          header('location:dashboard?page=find-mistakes&tag_code='.$_POST['code']);
                                          exit();
                              }
                          }
                          ?>
                          
                          
                          
                          <form method="POST"  role="form">
                            
                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-code"></i></span>
                                </div>
                                <input class="form-control" placeholder="Task code"  name="code" required> 
                              </div>
                            </div>
                           
                           
                           
                            <div class="text-center">
                              <button type="submit" name="hit" class="btn btn-primary my-4"><i class="fas fa-search"></i> Search</button>
                            </div>
                          </form>
                        </div>
                    
                    
                        </div>
                    
                      </div>
                    </div>
                  </div> 
    
          <!-- Argon Scripts -->
          <?php 
                  include "includes/jquery.php";
            ?>
          <script>
          /* password shown script during login */
        
            function myFunction() {
              var passwordFields = document.getElementsByClassName("password");
              for (let x of passwordFields) {
                if (x.type === "password") {
                  x.type = "text";
                } else {
                  x.type = "password";
                }
              }
            }
        </script>
        </script>
        </body>
        </html>
        <?php
          }
        }
        else
        {
            header('Location: ../login');
        	exit();
        }
        ?>