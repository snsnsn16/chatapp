<?php 
require 'config.php';
 function connectDB() {
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 return $conn;
 }

 ?>