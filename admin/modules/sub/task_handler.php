<?php
//deleting all status tasks
if(isset($_GET['id']) && isset($_GET['t_id']) && $_SESSION['adm_loggedin'] == TRUE)
{

        //decrypting task_code
            $task =base64_decode(urldecode($_GET['id'])); 
            $tagger_id = base64_decode(urldecode($_GET['t_id']));
        
            if ($stmt = $con->prepare("DELETE FROM tasks WHERE task_id= ? && tagr_id = ?"))
            {
                $stmt->bind_param("ii",$task,$tagger_id);
                if($stmt->execute())
                {
                    echo 'Task Deteted Successfully.';
                }else
                {
                    echo 'SQL ERROR';
                }
                
                $stmt->close();
                
            }
             else
             
                {
                    echo "ERROR: SQL";
                }
           
}

 
?>