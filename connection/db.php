<?php
Class connection{
    
    function getdbconnect(){
        $con = mysqli_connect("localhost","root","","ppt") or die("Couldn't connect");

        return $con;
    }
}
?>