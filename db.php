<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "nodemcu";

$conn = new mysqli($host,$user,$pass,$dbname);

if($conn->connect_error){
    die("Error: ".$conn->connect_error);
}
