<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname="phptutorial";

$connection = mysqli_connect($host,$username,$password,$dbname);

if(!$connection){
    die("connection error: ".mysqli_connect_error());
}

?>