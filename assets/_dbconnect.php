<?php

$server="localhost";
$username="root";
$password="";
$database="isecret";

$conn=mysqli_connect($server,$username,$password,$database);

if(!$conn){
    echo "Failed to connect to db";
    exit();
}

?>