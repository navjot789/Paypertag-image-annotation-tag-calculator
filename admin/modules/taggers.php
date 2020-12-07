<?php

if($_GET['sub']=='local')
{
    include 'sub/local_worker.php';
}
else if($_GET['sub']=='global')
{
     include 'sub/global_worker.php';
}
else
{
    header('location:https://manage.paypertag.tk/dashboard?page=home');
    exit();
}




?>