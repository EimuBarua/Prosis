<?php
    $username="root";
    $password="";
    $hostname="localhost";
    $db="prosis_db";
    $conn=mysqli_connect($hostname,$username,$password,$db);
    if(!$conn){
        die("Connection failed: " .msysqli_connect_error());
    }
    else{
        // echo "connected successfully";
    }
?>
