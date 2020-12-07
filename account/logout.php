
<?php 
session_start();
//User session in ['user']
if($_SESSION['tagr_id']){
    
 
    session_unset(); //unset all sessions
    session_destroy(); //destroy all sessions
    session_write_close();
    setcookie(session_name(),'',0,'/');
    
    //unset all cookies
    setcookie("tagger_username", NULL, 0, "/"); 
    setcookie("tagger_pass_salt", NULL, 0, "/");
    setcookie("loggedin", NULL, 0, "/");
    setcookie("status", NULL, 0, "/");
    setcookie("username", NULL, 0, "/");
    setcookie("tagr_id", NULL, 0, "/");
    setcookie("tagr_type", NULL, 0, "/");
 
    session_regenerate_id(true); //randomly generate new session ids
    header("location:https://paypertag.tk/login.php");
    exit();


}
else
{
    echo 'not getting any session';
}
?>
