<?php
include "../../connection/connect.php";
session_start();

if(!isset($_SESSION['loggedin'])) {
	header('Location: ../../../login');
	exit();
}

	
    
                                                 if(isset($_GET['val']) && $_SESSION['loggedin'] == TRUE)
                                               {
                                                
                                                            //decrypting task_code
                                                                foreach($_GET as $loc=>$item)
                                                                        $_GET[$loc] = base64_decode(urldecode($item));
                                                            
                                                                if ($stmt = $con->prepare("DELETE FROM tasks WHERE task_code= ? && tagr_id = ?"))
                                                                {
                                                                    $stmt->bind_param("si",$_GET[$loc],$_SESSION['tagr_id']);
                                                                    $stmt->execute();
                                                                    $stmt->close();
                                                                    header('location:../dashboard?page=new_task');
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