<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = "demo";
    $connection = mysqli_connect($servername, $username, $password, $dbname);
      
    // Check connection
    if(!$connection){
        die('Database connection error : ' .mysqli_connect_error());
    }
    
?>