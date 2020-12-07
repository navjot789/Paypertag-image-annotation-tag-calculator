<?php
include_once("../connection/connect.php");
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['adm_loggedin']) && !isset($_SESSION['adm_id']))
{
	header('Location:https://care.paypertag.tk');
	exit();

}
else
{
    
   include 'includes/lib.php'; //contains resuable functions
?>

<!doctype html>
<html lang="en">

<?php include "includes/head.php";?>

<body>

	<div class="wrapper">
	   <?php include "includes/navbar.php";?>

	    <div class="main-panel">
		<?php include "includes/top_navbar.php";?>

	        <div class="content">
	             <?php 
            
                        if($_GET['page']=='home')
                        {
                              include "modules/home.php";
                        }
                        else if($_GET['page']=='batch')
                        {
                            include "modules/batch.php";
                        }
                         else if($_GET['page']=='task')
                        {
                            include "modules/task_management.php";
                        }
                        else if($_GET['page']=='taggers')
                        {
                            include "modules/taggers.php";
                        }
                          else if($_GET['page']=='payments')
                        {
                            include "modules/payments.php";
                        }
                        else if($_GET['page']=='guide')
                        {
                            include "modules/guides.php";
                        }
                        
                        else if($_GET['page']=='edit')   ///hidden pages start from here ///
                        {
                            include "modules/sub/task_status_edit.php";
                        }
                        else if($_GET['page']=='batch_edit')
                        {
                            include "modules/sub/batch_handler.php";
                        }
                        
                        else
                        {
                             include "modules/home.php";
                        }
                        
                        
                 ?>
       
	        </div>
           <?php include "includes/footer.php";?>
	    </div>
	</div>

<?php include "includes/jquery.php";?>
<script>
  
</script>
</body>


</html>
<?php
}
?>