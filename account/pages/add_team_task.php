</div>
</div>
</div>
<div class="container-fluid mt--6">



<?php
$errors = array();

include "classes/team_stats.php";
//$obj = new teamstats();
//echo $obj->group_total_display();


 if(isset($_POST['add']))
       {
              $batch = mysqli_real_escape_string($con,htmlentities($_POST['batch'])); 
              $code = mysqli_real_escape_string($con,htmlentities($_POST['task_code'])); 
              $total_tags = mysqli_real_escape_string($con,htmlentities($_POST['total_tags'])); 
              $teamates = mysqli_real_escape_string($con,htmlentities($_POST['mates'])); 
              
              $my_attributes = mysqli_real_escape_string($con,htmlentities($_POST['my_attributes'])); 
              $my_total = mysqli_real_escape_string($con,htmlentities($_POST['my_total'])); 
        
              
              
              //now lets check if user task_code in already exist
                    $stmts = $con->prepare('SELECT tc_id FROM team_tag_0 WHERE task_code = ?');
                    $stmts->bind_param('s', $code);
                    	$stmts->execute();
                    	// Store the result so we can check if the task exists in the database.
                    	$stmts->store_result();
              
              
             
                      if(empty($batch) || empty($code) || empty($total_tags) || empty($teamates) || empty($my_total))
                       {
                                	$errors[] =   	'<div class="alert alert-danger">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>Blank!</strong> All * Fields are Required. 
                                                                            </div>  ';
                       }
                      else if(strlen($code) <= 16 || strlen($code) > 17 )
                      {
                          $errors[] =   	'<div class="alert alert-danger">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>Invalid Task Code!</strong> Please Enter Valid Task Code. 
                                                                            </div>  ';
                      }
                  
                    
                       else if($my_attributes > $my_total)
                      {
                          $errors[] =   	'<div class="alert alert-warning">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>ERROR!</strong>  Your Attributes cannot be greater than your Total number of Tags. 
                                                                            </div>  ';
                      }
                      
                        else if($total_tags < $my_total || $total_tags < $my_attributes )
                      {
                          $errors[] =   	'<div class="alert alert-warning">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>ERROR!</strong>  Your Tags cannot be greater than Group Total Tags. 
                                                                            </div>  ';
                      }
                      else
                      {
                          
                          
                           if($stmts->num_rows > 0)
                           {
                              //update or add teammates data
                                                                 $errors[] =   	'<div class="alert alert-warning">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>Task Already initialized!</strong> Try Again search by Task code below to add teammates data. 
                                                                            </div>  ';
                           }else
                           {
                                //insert the query
                                
                                
                                                                 
                                           if(ctype_digit($my_attributes) || $my_attributes =='' )
                                          {
                                             
                                                                if(ctype_digit($total_tags)  && ctype_digit($my_total))
                                                                 {
                                                                                        
                                                                       
                                                                        $stmts = $con->prepare('insert into team_tag_0(b_id,task_code,total_tags,mates,cr_d) values(?, ?, ?, ?, ?)');
                                                                        $stmts->bind_param('issis', $batch,$code,$total_tags,$teamates,$current_date);
                                                                        
                                                                                if($stmts->execute()) 
                                                                                {
                                                                                    $query = $con->prepare('select tc_id from team_tag_0 where task_code= ?');
                                                                                    $query->bind_param('s', $code);
                                                                                    $query->execute();
                                                                                    $query->bind_result($fetch_task_code);
                                                                                    $query->store_result();
                                                                                    if($query->fetch())
                                                                                    {
                                                                                        $json = array('fetch_task_code'=>$fetch_task_code);
                                                                                      
                                                                                        
                                                                                         $stmt = $con->prepare('insert into team_tag_1(tc_id,tagr_id,my_att,my_tags,usd,cr_d) values(?, ?, ?, ?, ?, ?)');
                                                                                         
                                                                                         #money calculated formaula
                                                                                         $attribute_counted = ($my_attributes * 0.3)/100;
                                                                                         $total_tags_counted = (($my_total - $my_attributes) * 0.8)/100;
                                                                                         $money = $attribute_counted + $total_tags_counted;
                                                                                         $usd = number_format((float)$money, 2, '.', ''); 
                                                                                         
                                                                                         $stmt->bind_param('iissss', $json['fetch_task_code'],$_SESSION['tagr_id'],$my_attributes,$my_total,$usd,$current_date);
                                                                                         if($stmt->execute()) 
                                                                                          {
                                                                                              $errors[] =   	'<div class="alert alert-success">  
                                                                                                              <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                <strong>Task Added!</strong> This task is unique and added successfully. 
                                                                                                                </div>  ';
                                                                                          }
                                                                                    }
                                                                                }
                                                                                          
                                                                  }
                                                                else
                                                                  {
                                                                      $errors[] =   	'<div class="alert alert-danger">  
                                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                        <strong>Strings Detected!</strong> Tags Cannot be converted into Strings. 
                                                                                        </div>  ';
                                                                  }
                                                 	
                                              
                                             }
                                              else
                                              {
                                                  $errors[] =   	'<div class="alert alert-danger">  
                                                                                              <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                <strong>Strings Detected!</strong> Attributes Cannot be converted into Strings. 
                                                                                                </div>  ';
                                              }
                                                    
                                
                                
                                
                                
                                
                                
                                
                                
                           }
                          
                                                                   
                                                            
                         }
                

}


     if(isset($_POST['search']))
    {  
           $task_search = mysqli_real_escape_string($con,htmlentities($_POST['task_search'])); 
         
          if(strlen($task_search) <= 16 || strlen($task_search) > 17 )
              {
                  $errors[]  =   	'<div class="alert alert-danger">  
                                                                  <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                    <strong>Invalid Task Code!</strong> Please Enter Valid Task Code. 
                                                                    </div>  ';
              }
              else
              {
          
                      //now lets check if user task_code in already exist
                        $search = $con->prepare('SELECT tc_id,task_code,total_tags,mates,cr_d FROM team_tag_0 WHERE task_code = ?');
                        $search->bind_param('s', $task_search);
                        $search->execute();
                        $search->store_result();
                       if($search->num_rows > 0) 
                       {
                            $search->bind_result($tc_id,$task_code,$total_tags,$teammates,$date);
                            
                             if($search->fetch())
                                {
                                    $data = array('tc_id'=>$tc_id,'task_exist'=>$task_code,'total_task_tags'=>$total_tags,'teammates'=>$teammates,'creation_date'=>$date);
                                    
                                      $success =   	'<div class="alert alert-success">  
                                                                  <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                    <strong>'.$search->num_rows.' Search result Found. </strong> 
                                                                    </div>  '; 
                                
                                    
                                    
                                }
                                
                       }
                       else
                       {
                          $errors[]  =   	'<div class="alert alert-danger">  
                                                                  <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                    <strong>0 Search Result found.</strong>
                                                                    </div>  '; 
                       }
              }
    }

   
   
 if(isset($_POST['countme']))
 {
         $my_attributes_new = mysqli_real_escape_string($con,htmlentities($_POST['my_att_new'])); 
         $my_total_new = mysqli_real_escape_string($con,htmlentities($_POST['my_total_new'])); 
          $task_code_ID = mysqli_real_escape_string($con,htmlentities(base64_decode(urldecode($_POST['task_c_id'])))); 
         
         if(empty($my_total_new))
                       {
                                	$errors[] =   	'<div class="alert alert-danger">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>Blank!</strong> All (*) Fields are Required. 
                                                                            </div>  ';
                       } 
          else if($my_attributes_new > $my_total_new)
                      {
                          $errors[] =   	'<div class="alert alert-warning">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>ERROR!</strong> The Attributes cannot be greater than Total number of Tags. 
                                                                            </div>  ';
                      }
          else if($_SESSION['GP_T_T'] < $my_total_new || $_SESSION['GP_T_T'] < $my_attributes_new)
                      {
                           $errors[] =   	'<div class="alert alert-warning">  
                                                                          <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                            <strong>ERROR!</strong> Your Tags cannot be greater than Group Total Tags. 
                                                                            </div>  ';
                      }
                      else
                        {
                            
                              if(ctype_digit($my_attributes_new) || $my_attributes_new =='')
                                          {
                                                if(ctype_digit($my_total_new))
                                                   {
                                                          $check = $con->prepare('SELECT tagr_id FROM `team_tag_1` WHERE tc_id=? AND tagr_id=?'); //prevent user not to insert tags again from this form
                                                          $check->bind_param('ii',$task_code_ID,$_SESSION['tagr_id']);
                                                          $check->execute();
                                                          $check->store_result();
                                                          if($check->num_rows() <= 0 || $check->num_rows() < 1) //check if tagger already added its contribution or not
                                                          {
                                                               $stmts = $con->prepare('insert into team_tag_1(tc_id,tagr_id,my_att,my_tags,usd,cr_d) values(?, ?, ?, ?, ?, ?)');
                                                               
                                                                 #money calculated formaula
                                                                     $attribute_counted = ($my_attributes_new * 0.3)/100;
                                                                     $total_tags_counted = (($my_total_new - $my_attributes_new) * 0.8)/100;
                                                                     $money = $attribute_counted + $total_tags_counted;
                                                                     $usd = number_format((float)$money, 2, '.', ''); 
                                                               
                                                               $stmts->bind_param('iissss',$task_code_ID,$_SESSION['tagr_id'],$my_attributes_new,$my_total_new,$usd,$current_date);
                                                               
                                                               
                                                                if($stmts->execute())
                                                                {
                                                                            $errors[] =   	'<div class="alert alert-success">  
                                                                                                                  <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                    <strong>Team Contibution Added!</strong> Your Tags recorded successfully. 
                                                                                                                    </div>  ';
                                                                }
                                                                  
                                                                  
                                                              }
                                                           else
                                                              {
                                                                   $errors[] =   	'<div class="alert alert-danger">  
                                                                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                                        <strong>Tags Already Added!</strong> Your Tags Already recorded. 
                                                                                                                        </div>  ';
                                                              }
                                                              
                                                           
                                                          
                                                                      
                                                   }else
                                                  {
                                                      $errors[] =   	'<div class="alert alert-danger">  
                                                                      <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                        <strong>Strings Detected!</strong> Tags Cannot be converted into Strings. 
                                                                        </div>  ';
                                                  }
                                              
                                          }else{
                                               $errors[] =   	'<div class="alert alert-danger">  
                                                                                              <button type="button" class="close" data-dismiss="alert">×</button>  
                                                                                                <strong>Strings Detected!</strong> Attributes Cannot be converted into Strings. 
                                                                                                </div>  ';
                                          }
                                          
                            
                            
                            
                            
                        }
         
 }
 
      
                                                                          
?>
       
       
                  
  
      <div class="row ">
        <div class="col-xl-8">
          <div class="row">
            <div class="col">
                
                <?php
                if(count($errors) > 0){
                        foreach($errors as $e){
                            echo $e . "<br />";
                        }
                    }
                    
                  if(isset($success))
                 {
                       echo $success;
                 }
    
                ?>
                
                
                
              <div class="card mb-4">
                  
           
                  
                                <!-- Card header -->
                                <div class="card-header">
                                
                                  
                                  <div class="row align-items-center">
                                    <div class="col-6">
                                      <!-- Title -->
                                         <form class="navbar-search navbar-search-dark form-inline mr-sm-3" method="post">
                                        <div class="form-group mb-0">
                                          <div class="input-group input-group-alternative input-group-merge">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Search by Task code" type="text" name="task_search">
                                          </div>
                                        </div>
                                        <button type="submit" class="close" name="search"></button>
                                      </form>
                                    </div>
                                    <div class="col-6 text-right">
                                     
                                   <h3 class="mb-0"><i class="fas fa-users"></i> Add New Task (Team)</h3>
                                     
                                    </div>
                                  </div>
                                 
                                </div>
                               
                                
                                <!-- Card body -->
                                <div class="card-body">
                                  <!-- Form groups used in grid -->
                                  <form method="post">
                                      
                                      
                                      <?php
                                      
                                   
                                            if(!empty($data['task_exist']))
                                            { //task exist
                                      ?>
                                            
                                             <ul class="list-unstyled ">
                                                  
                                                   <style>
                                                        
                                                        @media screen and (min-width: 700px) {
                                                          .divider {
                                                             float:right;
                                                              }
                                                        }
                                                        </style>
                                                    <li>
                                                      <div class="d-flex divider" >
                                                        <div>
                                                          <div class="icon icon-xs icon-shape bg-gradient-default text-white shadow rounded-circle">
                                                          <i class="far fa-calendar-alt"></i>
                                                          </div>
                                                        </div>
                                                        <div>
                                                          <span class="pl-2 text-sm"><strong>Added on:</strong> <?php echo  date('m/d/Y h:i:s a',strtotime($data['creation_date']));?></span>
                                                        </div>
                                                      </div>
                                                    </li>
                                                   
                                                   
                                                   
                                                    <li>
                                                      <div class="d-flex align-items-center">
                                                        <div>
                                                          <div class="icon icon-xs icon-shape bg-gradient-primary text-white shadow rounded-circle">
                                                          <i class="fas fa-hashtag"></i>
                                                          </div>
                                                        </div>
                                                        <div>
                                                          <span class="pl-2 text-sm"><strong>Task Associated Code:</strong> <?php echo $data['task_exist'];?></span>
                                                           <input type="hidden" class="form-control"  name="task_c_id" value="<?php echo urlencode(base64_encode($data['tc_id']));?>">
                                                        </div>
                                                      </div>
                                                    </li>
                                                    
                                                      <li>
                                                      <div class="d-flex align-items-center">
                                                        <div>
                                                          <div class="icon icon-xs icon-shape bg-gradient-primary text-white shadow rounded-circle">
                                                          <i class="fas fa-tags"></i>
                                                          </div>
                                                        </div>
                                                        <div>
                                                          <span class="pl-2 text-sm"><strong>Total Tags:</strong> <?php echo $_SESSION['GP_T_T']= $data['total_task_tags'];?></span>
                                                        </div>
                                                      </div>
                                                    </li>
                                                    
                                                    <li>
                                                      <div class="d-flex align-items-center">
                                                        <div>
                                                          <div class="icon icon-xs icon-shape bg-gradient-primary text-white shadow rounded-circle">
                                                            <i class="fas fa-headphones"></i>
                                                          </div>
                                                        </div>
                                                        <div>
                                                          <span class="pl-2 text-sm"><strong>Players:</strong>
                                                          <?php 
                                                          
                                                              if($data['teammates']==2)
                                                              {
                                                                  echo 'Dual (2)';
                                                              }else if($data['teammates']==3)
                                                              {
                                                                  echo 'Tier (3)';
                                                              }else if($data['teammates']==4)
                                                              {
                                                                  echo 'Squad (4)';
                                                              }
                                                              
                                                          
                                                          ?>
                                                          
                                                          </span>
                                                        </div>
                                                      </div>
                                                    </li>
                                                    
                                                     <li>
                                                      <div class="d-flex align-items-center">
                                                        <div>
                                                          <div class="icon icon-xs icon-shape bg-gradient-primary text-white shadow rounded-circle">
                                                            <i class="fas fa-door-open"></i>
                                                          </div>
                                                        </div>
                                                        <div>
                                                          <span class="pl-2 text-sm"><strong>Vacancy:</strong> 
                                                          
                                                          <?php 
                                                          
                                                              $vac = $con->prepare('select count(team_tag_1.team_task_id) AS total
                                                                                    FROM team_tag_0 LEFT JOIN team_tag_1 ON team_tag_0.tc_id = team_tag_1.tc_id where team_tag_0.tc_id=?
                                                                                    Group by team_tag_1.tc_id');
                                                                                    
                                                            $vac->bind_param('i', $data['tc_id']);
                                                            $vac->execute();
                                                            $vac->store_result();
                                                            
                                                            $vac->bind_result($total_vacancy_filled);
                                                                
                                                                 if($vac->fetch())
                                                                    {
                                                                        $object = array('total_vacancy_filled'=>$total_vacancy_filled);
                                    
                                                                    }
                                                                   
                                                                   $vacancy = $data['teammates'] - $object['total_vacancy_filled'];  //total teamates in db minus(-) total added count(tagr_id) in table(team_tag_1)
                                                                  
                                                                   if($vacancy==0)
                                                                   {
                                                                       echo '<button disabled class="btn  btn-sm btn-danger" >Closed</button>';
                                                                   }else
                                                                   {
                                                                        echo '<button disabled class="btn  btn-sm btn-info" >'.$vacancy.' space left</button>';
                                                                   }
                                                          ?>
                                                          
                                                          </span>
                                                        </div>
                                                      </div>
                                                    </li>
                                                
                                                  </ul>
                                             
                                                     <?php
                                                     if($vacancy!==0)
                                                        {                    
                                                     ?>
                                                          <div class="row">
                                                                 
                                                                <div class="col-md-6">
                                                                  <div class="form-group">
                                                                    <label class="form-control-label" for="example3cols2Input"><i class="fas fa-tag"></i> My Attributes</label>
                                                                    <input type="text" class="form-control"  placeholder="My Attributes" name="my_att_new">
                                                                  </div>
                                                                </div>
                                                                
                                                               
                                                                
                                                                
                                                                  <div class="col-md-6">
                                                                  <div class="form-group">
                                                                    <label class="form-control-label" for="example3cols2Input"><i class="fas fa-user-tag"></i> My Total Tags <code>*</code></label>
                                                                    <input type="text" class="form-control"  placeholder="My Total Tags" name="my_total_new">
                                                                  </div>
                                                                </div>
                                                             
                                                              
                                                              
                                                         </div> 
                                                              
                                                                 <button type="submit" class="btn btn-primary btn-lg btn-block" name="countme"><i class="fas fa-plus"></i> Count me in!</button>
                                                        
                                                       <?php
                                                        }else{
                                                            
                                                         echo  '<a href="dashboard?page=new_team_task" class="btn btn-primary btn-sm text-center"><i class="fas fa-arrow-circle-left"></i> Go back </a>';
                                                      
                                                        }?>
                                            
                        
                                       <?php
                                            } else{ 
                                                
                                                
                                      ?>     
                                               
                                                <div class="row">
                                                    
                                                
                                                                  
                                                         <div class="col-md-12">
                                                                <div class="form-group">
                                                                        <label class="form-control-label" for="exampleFormControlSelect1"> Batch Name <code>*</code> (Batch that your task associated with)</label>
                                                                      
                                                                <select class="form-control" id="exampleFormControlSelect1" name="batch">
                                                                        <option disabled selected>-------Select Batch Name-------</option>    
                                                                         <?php
                                                                         $sql_qry = "SELECT b_id,batch_name FROM batch WHERE status=1";
                                                                          
                                                                            $select = $con->prepare($sql_qry);          
                                                                            $select->execute();
                                                                            $select->bind_result($b_id,$batch_name);
                                                                            $new_obj = array();
                                                                            $select->store_result();
                                                                           
                                                                         if($select->num_rows > 0)
                                                                         {
                                                                            while($select->fetch())
                                                                            {
                                                                                $new_obj = array('b_id'=>$b_id,'batch_name'=>$batch_name);
                                                                       ?>   
                                                                       
                                                                                 <option  value="<?php echo $new_obj['b_id']; ?>"><?php echo $new_obj['batch_name']; ?></option>
                                                                         
                                                                        <?php
                                                                             }
                                                                            }else
                                                                            {
                                                                                
                                                                           
                                                                                echo '<option disabled selected>-------No Batch is Active on Microwork-------</option>';
                                                                            } $select->close();
                                                                        ?>
                                                                        </select>
                                                                        
                                                                        
                                                                        
                                                                      </div>
                                                          </div>
                                                    
                                              </div>      
                                                    
                                      
                                                  <div class="row">
                                                      
                                                         <div class="col-md-6">
                                                          <div class="form-group">
                                                            <label class="form-control-label" for="example3cols2Input"><i class="fas fa-hashtag"></i> Task Code <code>*</code></label>
                                                            <input type="text" class="form-control"  placeholder="Task Code" name="task_code">
                                                          </div>
                                                        </div>
                                                    
                                                       <div class="col-md-6">
                                                          <div class="form-group">
                                                            <label class="form-control-label" for="example3cols1Input"><i class="fas fa-tags"></i> Group Total Tags <code>*</code></label>
                                                            <input type="text" class="form-control"  placeholder="Total Tags" name="total_tags">
                                                          </div>
                                                        </div>
                                                    
                                                      
                                                 </div>   
                                                 
                                                  <div class="row">
                                                      
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols2Input"><i class="fas fa-tag"></i> My Attributes</label>
                                                        <input type="text" class="form-control"  placeholder="Attributes" name="my_attributes">
                                                      </div>
                                                    </div>
                                                    
                                                   
                                                    
                                                    
                                                      <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols2Input"><i class="fas fa-user-tag"></i> My Total Tags <code>*</code></label>
                                                        <input type="text" class="form-control"  placeholder="Total Tags" name="my_total">
                                                      </div>
                                                    </div>
                                                 
                                                      <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label class="form-control-label" for="example3cols2Input"><i class="fas fa-headphones"></i> Team-Mates <code>*</code></label>
                                                     
                                                         
                                                         <select class="form-control" id="exampleFormControlSelect1" name="mates">
                                                                        <option disabled selected>-------Select Mates-------</option>  
                                                                                 <option  value="2">Dual</option>
                                                                                 <option  value="3">Tier</option>
                                                                                 <option  value="4">Squad</option>
                                                                        </select>
                                                     
                                                     
                                                      </div>
                                                    </div>
                                                  
                                                  </div>
                                             
                                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="add"><i class="fas fa-plus"></i> Add Task</button>
                                               
                                               
                                               
                                               
                                               
                                               
                                               
                                               
                                 <?php
                                            }
                                      ?>     
                                                        
                                       </div>      
                                </form>
                                
                               <div class="card-header" style="padding:10px;">
                                  <h6 class="mb-0">  <i class="fas fa-info-circle"></i> info: Fields with <code>*</code> are Required.</h6>
                                 
                                </div>
                                
                              </div>
                    </div>
                  </div>
      
              </div>
              
              
               <div class="col-xl-4">
         
                  <!-- Card stats -->
                  <div class="card bg-gradient-default">
                    <!-- Card body -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Group Tags</h5>
                          <span class="h2 font-weight-bold mb-0 text-white">350,897</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                            <i class="ni ni-active-40"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-sm">
                        <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap text-light">Since last month</span>
                      </p>
                    </div>
                  </div>
                  <div class="card bg-gradient-primary">
                    <!-- Card body -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0 text-white">Contribution</h5>
                          <span class="h2 font-weight-bold mb-0 text-white">2,356</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                            <i class="ni ni-atom"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-sm">
                        <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap text-light">Since last month</span>
                      </p>
                    </div>
                  </div>
                  <div class="card bg-gradient-danger">
                    <!-- Card body -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total Group Earning</h5>
                          <span class="h2 font-weight-bold mb-0 text-white">49,65%</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                            <i class="ni ni-spaceship"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-sm">
                        <span class="text-white mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span class="text-nowrap text-light">Since last month</span>
                      </p>
                    </div>
                  </div>
           
             </div>
     
       
      </div> 
       
          
          <div class="row ">
           <div class="col-xl-12">
               <div class="row">
            <div class="col">
              <div class="card mb-4" >
                                <!-- Card header -->
                                <div class="card-header">
                                  <h3 class="mb-0"><i class="fas fa-history"></i> Team Task History</h3>
                                 
                                </div>
                                
                                <?php
                                
                                    $sql_prepare_query = 'SELECT team_tag_0.task_code, team_tag_0.total_tags, team_tag_0.mates,
                                                                 team_tag_1.my_att,
                                                                 team_tag_1.my_tags,
                                                                 team_tag_1.usd,
                                                                 team_tag_1.a_w_m,
                                                                 team_tag_1.t_w_m, 
                                                                 team_tag_1.cr_d 
                                                          FROM team_tag_0 INNER JOIN team_tag_1 ON team_tag_0.tc_id=team_tag_1.tc_id AND team_tag_1.tagr_id=? order by team_tag_1.team_task_id DESC';
                                                          
                                    $stmt = $con->prepare($sql_prepare_query); 
                                    $stmt->bind_param("i", $_SESSION['tagr_id']);
                                    $stmt->execute();
                                    $stmt->bind_result($task_code,$total_tags,$players,$my_att,$my_tags,$usd,$awm,$twm,$cr_d);
                                   
                              
                                    
                                ?>
                                
                                
                                <!-- Card body -->
                             
                                  <div class="table-responsive py-2" >
                                      <table class="table table-flush" id="datatable-buttons" >
                                        <thead class="thead-light" >
                                          <tr>
                                             <th>#</th>
                                          <!-- <th>Action</th>-->
                                            <th>Group Task Code</th>
                                            <th>Group Total Tags</th>
                                            <th>players</th>
                                            <th>My Att</th>
                                             <th>My Tags</th>
                                             <th>USD</th>
                                            <th>A.W.M</th>
                                            <th>T.W.M</th>
                                            <th>Posted At</th>
                                         
                                          </tr>
                                        </thead>
                                        <tfoot>
                                          <tr>
                                             <th>#</th>
                                            <!-- <th>Action</th>-->
                                            <th>Group Task Code</th>
                                            <th>Group Total Tags</th>
                                            <th>players</th>
                                            <th>My Att</th>
                                            <th>My Tags</th>
                                            <th>USD</th>
                                            <th>A.W.M</th>
                                            <th>T.W.M</th>
                                            <th>Posted At</th>
                                        
                                          </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                      <?php
                                      
                                       $json = array();
                                       $i=0;
                                           while($stmt->fetch()) 
                                           {
                                               
                                           $json = array('task_code'=>$task_code,'total_tags'=>$total_tags,'players'=>$players,'my_att'=>$my_att,'my_tags'=>$my_tags,'usd'=>$usd,'awm'=>$awm,'twm'=>$twm,'cr_d'=>$cr_d);
                                           $i++;
                                      ?>
                                            
                                        <tr>
                                            
                                            <td><?php echo $i; ?></td>
                                            
                                            <!--   <td class="text-right">
                                                      <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                                           
                                                      <a href="pages/handler.php?val=<?php echo urlencode(base64_encode($json['task_code']));?>" onclick="return confirm('Are you sure you want to delete this Task? Beware this Action Cannot be Revoke!')" class="dropdown-item" name="delete_task"> <i class="fas fa-trash-alt text-red"></i> Remove</a>
                                                           
                                                        </div>
                                                      </div>
                                             </td>-->
                                             
                                             
                                               <td><strong><?php echo $json['task_code']; ?></strong></td>
                                                
                                                 
                                                
                                                
                                                <td><strong><?php echo $json['total_tags']; ?></strong></td>
                                                
                                                <td><strong><?php 
                                                          
                                                              if($json['players']==2)
                                                              {
                                                                  echo 'Dual (2)';
                                                              }else if($json['players']==3)
                                                              {
                                                                  echo 'Tier (3)';
                                                              }else if($json['players']==4)
                                                              {
                                                                  echo 'Squad (4)';
                                                              }
                                                              
                                                          
                                                          ?></strong></td>
                                                          
                                                          
                                                <td><?php 
                                                
                                                            if($json['my_att']==0 || $json['my_att']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                        echo $json['my_att'];
                                                                   }
                                                
                                                ?></td>
                                                
                                                <td>
                                                <strong>
                                                <?php 
                                                
                                                            if($json['my_tags']==0 || $json['my_tags']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                        echo $json['my_tags'];
                                                                   }
                                                
                                                ?></strong></td>
                                                
                                                <td><?php 
                                                
                                                            if($json['usd']==0 || $json['usd']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                        echo '<span style="color: #05c005;">$'.$json['usd'].'<span>';
                                                                   }
                                                
                                                ?>
                                                    
                                                </td>
                                                <td>
                                                    <?php 
                                                
                                                            if($json['awm']==0 || $json['awm']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                        echo '<span style="color: #f30707;">'.$json['awm'].'<span>';
                                                                   }
                                                
                                                ?>
                                                </td>
                                                <td>
                                                     <?php 
                                                
                                                            if($json['twm']==0 || $json['twm']=='')
                                                                   {
                                                                         echo '<span  >-----</span>';
                                                                   }else
                                                                   {
                                                                        echo '<span style="color: #f30707;">'.$json['twm'].'<span>';
                                                                   }
                                                
                                                ?>
                                                </td>
                                                
                                                <td><?php echo  date('g:ia \o\n l<\b\\r> jS F Y', strtotime($json['cr_d'])); ?></td>
                                              
                                               
                                       </tr>
                                             <?php  } ?>
                                       
                                        
                                        </tbody>
                                      </table>
                                    </div>
         
                              </div>
                    </div>
                  </div>
               
           </div>
          </div>
  
        </div> 