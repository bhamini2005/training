<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "demo";
$conn =mysqli_connect($servername,$username,$password,$database);
if ($conn->connect_error) echo "Error";
//else echo "Connected successfully";


?>
