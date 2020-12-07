 <div class="sidebar" data-background-color="brown" data-active-color="success">
	    <!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->
			<div class="logo" style="padding: 8px 0px 0px 10px;">
		
			    
				<a href="https://www.creative-tim.com/" class="simple-text logo-normal" style="text-transform: capitalize;">
		     	<img src="https://paypertag.tk/images/ppt.png" style="height:50px;width:200px;" />
				</a>

			
			</div>
	    	<div class="sidebar-wrapper">
				<div class="user">
	                <div class="info">
						<div class="photo">
		                    <img src="../../assets/img/faces/face-2.jpg" />
		                </div>

	                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
	                        <span>
								<?php  if(isset($_SESSION['adm_username']) && !empty($_SESSION['adm_username'])){ echo $_SESSION['adm_username'];} ?>
		                        <b class="caret"></b>
							</span>
	                    </a>
						<div class="clearfix"></div>

	                    <div class="collapse" id="collapseExample">
	                        <ul class="nav">
	                           
	                            <li>
									<a href="#settings">
										<span class="sidebar-mini">MP</span>
										<span class="sidebar-normal">My Profile</span>
									</a>
								</li>
							
								
	                        </ul>
	                    </div>
	                </div>
	            </div>
	            <ul class="nav">
	                
	                <li class="<?php if(isset($_GET['page']) && $_GET['page']=='home' ){ echo 'active';} ?>">
	                    <a  href="dashboard?page=home" >
	                        <i class="ti-panel"></i>
	                        <p>Dashboard</p>
	                    </a>
					
	                </li>
	                
					<li class="<?php if(isset($_GET['page']) && $_GET['page']=='batch' ){ echo 'active';} ?>" >
						<a  href="dashboard?page=batch">
	                        <i class="ti-briefcase"></i>
	                        <p>
						    	Batch Management
	                         
	                        </p>
	                    </a>
	                   
	                </li>
			
			
	        	<li  >
						<a data-toggle="collapse" href="#tasks">
	                        <i class="ti-harddrives"></i>
	                        <p>
								Task Management
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                  
	                    
	                    <div class="collapse" id="tasks">
							<ul class="nav">
								<li >
									<a href="dashboard?page=task&sub=pt">
										<span class="sidebar-mini">PT</span>
										<span class="sidebar-normal">Pending Tasks  <?php
	                                                                                             $sql_prepare = 'SELECT task_id from tasks WHERE task_status=0 ';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->execute();
                                                                                                 $stmt->store_result();
                                                                                                 echo  '('.$stmt->num_rows().')';
                                                                                                 $stmt->close();?></span>
									</a>
								</li>
								
								<li>
										<a href="dashboard?page=task&sub=at">
										<span class="sidebar-mini">AT</span>
										<span class="sidebar-normal">Approved Tasks <?php
	                                                                                             $sql_prepare = 'SELECT task_id from tasks WHERE task_status=1 ';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->execute();
                                                                                                 $stmt->store_result();
                                                                                                 echo  '('.$stmt->num_rows().')';
                                                                                                 $stmt->close();?></span>
									</a>
								</li>
							
								<li>
									<a href="dashboard?page=task&sub=rt">
										<span class="sidebar-mini">RT</span>
										<span class="sidebar-normal">Rejected Tasks <?php
	                                                                                             $sql_prepare = 'SELECT task_id from tasks WHERE task_status=2 ';
                                                                                                 $stmt = $con->prepare($sql_prepare); 
                                                                                                 $stmt->execute();
                                                                                                 $stmt->store_result();
                                                                                                 echo  '('.$stmt->num_rows().')';
                                                                                                 $stmt->close();?></span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </li>
			
			
			
			
			
					<li  >
						<a data-toggle="collapse" href="#formsExamples">
	                        <i class="ti-user"></i>
	                        <p>
								Taggers
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="formsExamples">
							<ul class="nav">
								<li >
									<a href="dashboard?page=taggers&sub=local">
										<span class="sidebar-mini">LT</span>
										<span class="sidebar-normal">Local Taggers</span>
									</a>
								</li>
								
								<li>
										<a href="dashboard?page=taggers&sub=global">
										<span class="sidebar-mini">GT</span>
										<span class="sidebar-normal">Global Taggers</span>
									</a>
								</li>
							
							
	                        </ul>
	                    </div>
	                </li>
	                
	                
	                
	          
	         	
	                
	               	<li  >
						<a data-toggle="collapse" href="#payments">
	                        <i class="ti-credit-card"></i>
	                        <p>
								Payments
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="payments">
							<ul class="nav">
								<li >
									<a href="dashboard?page=payments&sub=total">
										<span class="sidebar-mini">TE </span>
										<span class="sidebar-normal"> Total Earnings</span>
									</a>
								</li>
								
								<li>
										<a href="dashboard?page=payments&sub=current">
										<span class="sidebar-mini">CE</span>
										<span class="sidebar-normal">Current Earnings</span>
									</a>
								</li>
							
							
	                        </ul>
	                    </div>
	                </li> 
	                
	                <li class="<?php if(isset($_GET['page']) && $_GET['page']=='guide' ){ echo 'active';} ?>" >
						<a  href="dashboard?page=guide">
	                        <i class="ti-book"></i>
	                        <p>
						    	Guides
	                         
	                        </p>
	                    </a>
	                   
	                </li>
	          
				
	            </ul>
	    	</div>
	    </div>