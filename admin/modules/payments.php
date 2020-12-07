<?php

if($_GET['sub']=='total')
{
    include 'sub/total_payments.php';
}
else if($_GET['sub']=='current')
{
     include 'sub/current_payments.php';
}
else
{
    header('location:https://manage.paypertag.tk/dashboard?page=home');
    exit();
}




?>