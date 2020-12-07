<?php
include_once("../connection/connect.php");
session_start();

 $url = $_SERVER['REQUEST_URI']; //returns the current URL
 $parts = parse_url($url); //divide the url into parts(path,query)
            
if(isset($_SESSION['tagr_type']) && $_SESSION['tagr_type'] == 2)
{

          

if (!isset($_SESSION['loggedin']) && !isset($_SESSION['tagr_id']) && $_SESSION['status'] == 0  && $_SESSION['tagr_type'] !== 2) // If the user is not logged in redirect to the login page...
{
	header('Location: ../login');
	exit();

}
else if($parts['path']=='/account/dashpanel' && $parts['query']=='') //Reason: Due to Disqus.com(if url is account/dashpanel redirect back to account/dashpanel?p=home )
{
    header('Location: dashpanel?p=home');
	exit();
}
else if($parts['path']=='/account/dashboard' && $parts['query']=='') //Reason: Due to Disqus.com(if url is account/dashpanel redirect back to account/dashpanel?p=home )
{
    header('Location: dashpanel?p=home');
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
  
 <!-- Appzi: Capture Insightful Feedback -->
<script async src="https://app.appzi.io/bootstrap/bundle.js?token=CV88w"></script>
<!-- End Appzi -->

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148576223-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-148576223-1');
</script>

  
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
         
        $page_array =array('home', 'new_task','preview_task','calender','pending','approved','payments','profile','task_updating','find-mistakes');
        
        if(in_array($_GET['p'], $page_array) && $_GET['p'] !=='')
        {
           $key = array_search($_GET['p'], $page_array);//getting key 
            $value = $page_array[$key];//getting values
           
           switch ($value)
           {
              
                case "home": include "global/home.php";
                    break;
                    
                case "new_task": include "global/add_task.php";
                    break;
                    
                case "preview_task": include "global/preview_task.php";
                    break;
                    
                 case "calender": include "global/calender.php";
                    break;
                    
                 case "pending": include "global/pending_task.php";
                    break;
                    
                 case "approved": include "global/approved_task.php";
                    break;
                    
                 case "payments": include "global/payments.php";
                    break;
                
                 case "profile": include "global/profile.php";
                    break;
                
              
           
                                //Hidden Pages
                                
                   case "task_updating": include "global/task_status_update.php";
                     break;
                
                   case "find-mistakes": include "global/mistake_finder.php";
                     break;
                
                   default:include "global/home.php";
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
                              
                                          header('location:dashpanel?p=find-mistakes&tag_code='.$_POST['code']);
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
}}else
{
    header('Location: ../login');
	exit();

}
?>