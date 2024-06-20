<?php
 require 'db.php';

 $name = $_POST['name'];
 $email = $_POST['email'];
 $username = $_POST['username'];
 $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
 $phone = $_POST['phone'];

 $conn = connectDB();

 $sql = "INSERT INTO users (name, email, username, password, phone) VALUES
 (?, ?, ?, ?, ?)";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("sssss", $name, $email, $username, $password, $phone);
 
 $response = array();
 if ($stmt->execute()) {
 $response['success'] = true;
 } else {
 $response['success'] = false;
 }

 echo json_encode($response);
 
 $stmt->close();
 $conn->close();
?>