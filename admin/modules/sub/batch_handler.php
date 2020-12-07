<?php
//edit/delete batches and change its status 

         
        if(isset($_GET['b']) && $_SESSION['adm_loggedin'] == TRUE) //delete batch
            {
            
                    //decrypting batch id
                        $batch_id =base64_decode(urldecode($_GET['b'])); 
                       
                    
                        if ($stmt = $con->prepare("DELETE FROM batch WHERE b_id= ?"))
                        {
                            $stmt->bind_param("i",$batch_id);
                            if($stmt->execute())
                            {
                                echo 'Batch Deteted Successfully.';
                                header('location:dashboard?page=batch');
                                exit();
                                
                            }else
                            {
                                echo 'SQL ERROR';
                            }
                            
                            $stmt->close();
                            
                        }
                         else{
                                echo "ERROR: SQL";
                            }
                       
            }
      
                       
          else if($_GET['s'] == 0 && isset($_GET['batch']) && $_SESSION['adm_loggedin'] == TRUE )//disable
            {
                //decrypting batch id
                        $batch_id =base64_decode(urldecode($_GET['batch'])); 
                    
                        if ($stmt = $con->prepare("UPDATE batch SET status=0 WHERE b_id= ?"))
                        {
                            $stmt->bind_param("i",$batch_id);
                            if($stmt->execute())
                            {
                                echo 'Batch Disable Successfully.';
                                header('location:dashboard?page=batch');
                                exit();
                            }else
                            {
                                echo 'SQL ERROR';
                            }
                            
                            $stmt->close();
                            
                        }
                         else{
                                echo "ERROR: SQL";
                            }
            }
            else if($_GET['s'] == 1 && isset($_GET['batch']) && $_SESSION['adm_loggedin'] == TRUE )//active
            {
                //decrypting batch id
                        $batch_id =base64_decode(urldecode($_GET['batch'])); 
                    
                      if ($stmt = $con->prepare("UPDATE batch SET status=1 WHERE b_id= ?"))
                        {
                            $stmt->bind_param("i",$batch_id);
                            if($stmt->execute())
                            {
                                echo 'Batch active Successfully.';
                                header('location:dashboard?page=batch');
                                exit();
                            }else
                            {
                                echo 'SQL ERROR';
                            }
                            
                            $stmt->close();
                            
                        }
                         else{
                                echo "ERROR: SQL";
                            }
            }
            
            
             else if($_GET['s'] == 2 && isset($_GET['batch']) && $_SESSION['adm_loggedin'] == TRUE )//upcomming
            {       
                    
                //decrypting batch id
                        $batch_id =base64_decode(urldecode($_GET['batch'])); 
                        
                        if ($stmt = $con->prepare("UPDATE batch SET status=2 WHERE b_id= ?"))
                        {
                            $stmt->bind_param("i",$batch_id);
                            if($stmt->execute())
                            {
                                echo 'Batch updomming Successfully.';
                                header('location:dashboard?page=batch');
                                exit();
                            }else
                            {
                                echo 'SQL ERROR';
                            }
                            
                            $stmt->close();
                            
                        }
                         else{
                                echo "ERROR: SQL";
                            }
            }
            else
            {
                 header('location:dashboard?page=batch');
                 exit();
            }
?>