<?php
include "../../connection/connect.php";
session_start();

if(!isset($_SESSION['loggedin']) && $_SESSION['tagr_type'] !==2) {
	header('Location: ../../../login');
	exit();
}

	
    
                                                 if(isset($_GET['val']) && $_SESSION['loggedin'] == TRUE && $_SESSION['tagr_type'] == 2)
                                               {
                                                
                                                            //decrypting task_code
                                                                foreach($_GET as $loc=>$item)
                                                                        $_GET[$loc] = base64_decode(urldecode($item));
                                                            
                                                                if ($stmt = $con->prepare("DELETE FROM global_tasks WHERE task_code= ? && tagr_id = ?"))
                                                                {
                                                                    $stmt->bind_param("si",$_GET[$loc],$_SESSION['tagr_id']);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                    header('location:../dashpanel?p=new_task');
                                                                     exit();
                                                                }
                                                                 else
                                                                    {
                                                                        echo "ERROR: SQL";
                                                                    }
                                                               
                                                                $con->close();
                                                                $stmt->close();
                                                  }
                                               else if(isset($_GET['p_val']) && $_SESSION['loggedin'] == TRUE && $_SESSION['tagr_type'] == 2)
                                               {
                                                
                                                            //decrypting task_code
                                                                foreach($_GET as $loc=>$item)
                                                                        $_GET[$loc] = base64_decode(urldecode($item));
                                                            
                                                                if ($stmt = $con->prepare("DELETE FROM global_tasks WHERE task_code= ? && task_status=0 && tagr_id = ?"))
                                                                {
                                                                    $stmt->bind_param("si",$_GET[$loc],$_SESSION['tagr_id']);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                    header('location:../dashpanel?p=pending');
                                                                     exit();
                                                                }
                                                                 else
                                                                    {
                                                                        echo "ERROR: SQL";
                                                                    }
                                                               
                                                                $con->close();
                                                                $stmt->close();
                                                  }
                                                  else if(isset($_GET['a_val']) && $_SESSION['loggedin'] == TRUE && $_SESSION['tagr_type'] == 2)
                                               {
                                                
                                                            //decrypting task_code
                                                                foreach($_GET as $loc=>$item)
                                                                        $_GET[$loc] = base64_decode(urldecode($item));
                                                            
                                                                if ($stmt = $con->prepare("DELETE FROM global_tasks WHERE task_code= ? && task_status=1 && tagr_id = ?"))
                                                                {
                                                                    $stmt->bind_param("si",$_GET[$loc],$_SESSION['tagr_id']);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                    header('location:../dashpanel?p=approved');
                                                                     exit();
                                                                }
                                                                 else
                                                                    {
                                                                        echo "ERROR: SQL";
                                                                    }
                                                               
                                                                $con->close();
                                                                $stmt->close();
                                                  } 
                                                  
                                                 
                                                   else
                                                {
                                                     header('location:https://paypertag.tk/');
                                                     exit();
                                                }
                                                  
                    			    
                    			    
                    			    


?>