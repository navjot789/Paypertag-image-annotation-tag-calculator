<?php

if($_GET['sub']=='pt')
{
    include 'sub/pt.php';
}
else if($_GET['sub']=='at')
{
     include 'sub/at.php';
}
else if($_GET['sub']=='rt')
{
     include 'sub/rt.php';
}
else
{
    header('location:https://manage.paypertag.tk/dashboard?page=home');
    exit();
}




?>