<?php

// $db_name = "mysql:host=localhost;dbname=pdfshare";
// $username = "root";
// $password = "";

// $conn = new PDO($db_name, $username, $password);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pdfshare";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());

}

?>