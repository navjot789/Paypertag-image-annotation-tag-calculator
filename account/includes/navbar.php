<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="https://paypertag.tk/">
          <img src="https://paypertag.tk/images/pptb.png" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
                 
          <li class="nav-item nav-link">
             <small> 
             <i class="far fa-calendar-alt"></i> Date: <?php echo date('l d-m-y'); ?>
             
              </small>
            </li>
          
            <?php
                if($_SESSION['tagr_type'] ==1 && $_SESSION['status'] !== 0)
                 {
             ?>   
              
            <li class="nav-item">
              <a class="nav-link active" href="dashboard?page=home">
                <i class="ni ni-shop text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
              
            </li>
            
            
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-tag text-orange"></i>
                <span class="nav-link-text">Tagging</span>
              </a>
              <div class="collapse" id="navbar-examples">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="dashboard?page=new_task" class="nav-link"><i class="fas fa-plus"></i> Add Tasks (solo)</a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="dashboard?page=new_team_task" class="nav-link"><i class="fas fa-users"></i> Add Tasks (Team)</a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="dashboard?page=preview_task" class="nav-link"><i class="fas fa-eye"></i> Preview Tasks</a>
                  </li>
                 
                 <li class="nav-item">
                    <a href="dashboard?page=calender" class="nav-link"><i class="fas fa-calendar-alt"></i> Calender</a>
                  </li>
                  
                </ul>
              </div>
            </li>
            
              <li class="nav-item">
              <a class="nav-link " href="dashboard?page=payments">
                <i class="ni ni-money-coins text-success"></i>
                <span class="nav-link-text">Payments</span>
              </a>
              
            </li>
            
              <li class="nav-item">
              <a class="nav-link " href="dashboard?page=policy">
                <i class="fas fa-info text-info"></i>
                <span class="nav-link-text">Terms&Conditions</span>
              </a>
              
            </li>
            
            <?php
                 }
                 else if($_SESSION['tagr_type'] == 2 && $_SESSION['status'] !== 0)
                  {
            ?>
                   <li class="nav-item">
                      <a class="nav-link active" href="dashpanel?p=home">
                        <i class="ni ni-shop text-primary"></i>
                        <span class="nav-link-text">Dashpanel</span>
                      </a>
              
            </li>
            
            
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-tag text-orange"></i>
                <span class="nav-link-text">Tagging</span>
              </a>
              <div class="collapse" id="navbar-examples">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="dashpanel?p=new_task" class="nav-link"><i class="fas fa-plus"></i> Add Tasks</a>
                  </li>
                  <li class="nav-item">
                    <a href="dashpanel?p=preview_task" class="nav-link"><i class="fas fa-eye"></i> Preview Tasks</a>
                  </li>
                 
                 <li class="nav-item">
                    <a href="dashpanel?p=calender" class="nav-link"><i class="fas fa-calendar-alt"></i> Calender</a>
                  </li>
                  
                </ul>
              </div>
            </li>
            
             <li class="nav-item">
              <a class="nav-link" href="#navbar-examplesnew" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examplesnew">
                <i class="ni ni-books text-default"></i>
                <span class="nav-link-text">Task Management</span>
              </a>
              <div class="collapse" id="navbar-examplesnew">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="dashpanel?p=pending" class="nav-link"><i class="fas fa-clock"></i> Pending Tasks
                    <?php
	                                                                                             $sql_prepare = 'SELECT task_id from global_tasks WHERE task_status=0 AND tagr_id ="'.$_SESSION['tagr_id'].'" ';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->execute();
                                                                                                 $stmt->store_result();
                                                                                                 echo  '('.$stmt->num_rows().')';
                                                                                                 $stmt->close();?>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="dashpanel?p=approved" class="nav-link"><i class="fas fa-clipboard-check"></i> Approved Tasks
                        <?php
	                                                                                             $sql_prepare = 'SELECT task_id from global_tasks WHERE task_status=1 AND tagr_id ="'.$_SESSION['tagr_id'].'" ';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->execute();
                                                                                                 $stmt->store_result();
                                                                                                 echo  '('.$stmt->num_rows().')';
                                                                                                 $stmt->close();?>
                    </a>
                  </li>
                
                  
                </ul>
              </div>
            </li>
            
              <li class="nav-item">
              <a class="nav-link " href="dashpanel?p=payments">
                <i class="ni ni-money-coins text-success"></i>
                <span class="nav-link-text">Payments</span>
              </a>
              
            </li>
            
          
           </ul> 
         
        
            <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Advance statistics</h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
              
               <li class="nav-item">
              <a class="nav-link" href="https://docs.google.com/spreadsheets/d/1DR-P7YK7QGfnZz4EEOPHxl3SQioBsEaKNv395lbC-WE" target="_blank">
                <i class="fas fa-chart-line"></i>
                <span class="nav-link-text"> Morrisons 3 - Bounding Box Stats</span>
              </a>
            </li>
               
              
            <li class="nav-item">
              <a class="nav-link" href="https://docs.google.com/spreadsheets/d/1jFhTHaEiM5HeCWgX6thNTkC65hkwxhQHXY-8slUvbSI/edit" target="_blank">
                <i class="fas fa-chart-line"></i>
                <span class="nav-link-text">Bounding Box daily Stats</span>
              </a>
            </li>
            
            
            
            <li class="nav-item">
              <a class="nav-link" href="https://docs.google.com/document/d/12xD9snphEP2dx1MfpvGm4gboUgS8MrfXAOGerYZ5t6U/edit" target="_blank">
                <i class="fas fa-dizzy"></i>
                <span class="nav-link-text">Sick leave</span>
              </a>
            </li>
               
          
          
            <?php
                      
                  }
            ?>
              </ul>
            
                 <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Account Documentation</h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="https://youtu.be/PEV4g3VlF5w" target="_blank">
                <i class="fab fa-youtube text-danger"></i>
                <span class="nav-link-text">Getting started</span>
              </a>
            </li>
            
          </ul>
        
          
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Guides</h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
              
               <li class="nav-item">
              <a class="nav-link" href="https://docs.google.com/document/d/1WzhRGW_SmnMyQUPs-fwUaxPu3cHkqkATpDK6x0fZ-sY" target="_blank">
              <i class="fas fa-book"></i>
                <span class="nav-link-text">Pink Project Guide <strong>NEW</strong></span>
              </a>
            </li>
              
              <li class="nav-item">
              <a class="nav-link" href="https://quip.com/vWihAW82VBgb" target="_blank">
              <i class="fas fa-book"></i>
                <span class="nav-link-text">Pink Project Guide <strong>OLD</strong></span>
              </a>
            </li>
            
              <li class="nav-item">
              <a class="nav-link" href="https://quip.com/pfytAWaJJMiE" target="_blank">
              <i class="fas fa-book"></i>
                <span class="nav-link-text">Pink Albertsons Guide</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="https://microwork.quip.com/6e4gAtVJELNX/Fishtailing-Annotation-Guide" target="_blank">
              <i class="fas fa-journal-whills"></i>
                <span class="nav-link-text">Fishtailing Guide</span>
              </a>
            </li>
            
            
            <li class="nav-item">
              <a class="nav-link" href="https://quip.com/I1XRAbLMGeBs" target="_blank">
              <i class="fas fa-journal-whills"></i>
                <span class="nav-link-text">FAQ | Full Annotation</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="https://docs.google.com/document/d/116qWAFmVdTc9ikCD9kiTQSUvUFVmbzx_lKYfvkgSwUw/edit?usp=sharing" target="_blank">
              <i class="fas fa-journal-whills"></i>
                <span class="nav-link-text">FAQ | Shelves</span>
              </a>
            </li>
            
            
            
            
          </ul>
          
        </div>
      </div>
    </div>
  </nav>