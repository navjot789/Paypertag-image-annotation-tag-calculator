
 <nav class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
           
          <!-- 
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" method="post" >
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search by Task Code" type="text" name="q">
              </div>
            </div>
          <input  type="submit"  name="search" class="form-control" style="display:none;">
          </form>
          Search form -->
          
        
          
       <?php
        if ($_SESSION['tagr_type'] ==2 && $_SESSION['status'] !== 0)
                {
        ?>
          <a href="#" class="btn btn-sm btn-default" style="background: rgb(21, 39, 69) !important;"><i class="fas fa-circle text-success"></i> Box: 0.4c | Class: 0.4c | Atribute: 0.3c</a>
          <?php
                }?>
          
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
              
              
           </ul>
           
           
          <ul class="navbar-nav align-items-center ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                 
               
                  <span class="avatar avatar-sm rounded-circle">
                    <img Image src="https://paypertag.tk/images/user.png">
                  </span>
                  <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">
                        
                        <?php
                         if (isset($_SESSION['username']) && isset($_SESSION['tagr_id']) && $_SESSION['status'] !== 0)
                        {
                           echo $_SESSION['username'];
                        }
                        ?>
                        </span>
                  </div>
                  
                  
                </div>
              </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header noti-title">
                          <h6 class="text-overflow m-0">Welcome!
                           <?php
                             if (isset($_SESSION['username']) && isset($_SESSION['tagr_id']) && $_SESSION['status'] !== 0)
                            {
                               echo $_SESSION['username'];
                            }
                        ?>
                          
                          </h6>
                        </div>
            <?php
                 if ($_SESSION['tagr_type'] ==2 && $_SESSION['status'] !== 0)
                {
               
            ?>
                        <a href="dashpanel?p=profile" class="dropdown-item">
                          <i class="ni ni-single-02"></i>
                          <span>My profile</span>
                        </a>
                      
                        <a href="#!" class="dropdown-item">
                          <i class="ni ni-calendar-grid-58"></i>
                          <span>Activity</span>
                        </a>
                        <a href="mailto:ns949405@gmail.com" class="dropdown-item">
                          <i class="ni ni-support-16"></i>
                          <span>Support</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout" class="dropdown-item">
                          <i class="ni ni-user-run"></i>
                          <span>Logout</span>
                        </a>
                        
                <?php
                }else
                {
                   ?> <a href="dashboard?page=profile" class="dropdown-item">
                          <i class="ni ni-single-02"></i>
                          <span>My profile</span>
                        </a>
                        <a href="dashboard?page=settings" class="dropdown-item">
                          <i class="ni ni-settings-gear-65"></i>
                          <span>Settings</span>
                        </a>
                        <a href="#!" class="dropdown-item">
                          <i class="ni ni-calendar-grid-58"></i>
                          <span>Activity</span>
                        </a>
                        <a href="mailto:ns949405@gmail.com" class="dropdown-item">
                          <i class="ni ni-support-16"></i>
                          <span>Support</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="logout" class="dropdown-item">
                          <i class="ni ni-user-run"></i>
                          <span>Logout</span>
                        </a>
                        <?php
                }
                ?>
                        
                      </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
  