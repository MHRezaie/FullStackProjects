<?php
    $server='localhost';
    $user='root';
    $password='12345678900MM.M';
    $database='digitalbank';
    $connection=mysqli_connect($server,$user,$password,$database);
    if(!$connection){
        die('query fialed'.mysqli_error($connection));
    }
?>