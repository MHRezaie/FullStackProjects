<?php
    $server='localhost';
    $user='root';
    $password='12345678900MM.M';
    $database='digitalbank';
    $mysqli=new mysqli($server,$user,$password,$database);
    if($mysqli->connect_errno){
       echo 'failed to connect :'.$mysqli->connect_error;
       exit();
    }
?>