
<?php 
session_start();
//User session in ['user']
if($_SESSION['adm_id']){
    
 
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
    header("location:https://manage.paypertag.tk/");
    exit();


}
else
{
    echo 'not getting any session';
}
?>
