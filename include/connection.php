<?php
    $root = (!empty($_SERVER['HTTPS'])? 'https' : 'http'). '://'.$_SERVER['HTTP_HOST'] .'/';

    $servername = '127.0.0.1:3306';
    $username = 'root';
    $password = 'root';
    $dbname = 'kerp_db';

    $conn = new mysqli($servername,$username,$password,$dbname);
    mysqli_set_charset($conn,'utf8');

    if($conn->connect_error){
        print_r("Error connecting to database!");
    }
?>