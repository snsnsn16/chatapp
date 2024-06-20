 <?php
 require 'db.php';
 $user_id = $_POST['user_id'];
 $message = $_POST['message'];
 $conn = connectDB();
 $sql = "INSERT INTO messages (user_id, message) VALUES (?, ?)";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("is", $user_id, $message);
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