<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "iDiscuss";
    $con = mysqli_connect($server,$user,$password,$database);
    if(!$con){
        die("connection to the database has failed");
    }
    else{
    //echo "connection to the database has successfully";
    }

?>