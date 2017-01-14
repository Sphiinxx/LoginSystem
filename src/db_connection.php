<?php
$host = "localhost";
$user = "root";
$pass = "Password";
$database = "login";

$sql_connection = mysqli_connect($host, $user, $pass, $database);

if (mysqli_connect_errno())
    die ("MySQL Database Connection Error.");
