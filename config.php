<?php
session_start();

$host = "bloodbank-db";
$user = "root";
$password = "Admin@123";
$dbname = "bloodbank";

$con = mysqli_connect($host,$user,$password,$dbname);

if(!$con){
    die(mysqli_connect_error());
}