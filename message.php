 <?php
 require 'db.php';
 $conn = connectDB();
 $sql = "SELECT messages.message, users.username FROM messages JOIN users ON
 messages.user_id = users.id ORDER BY messages.timestamp DESC";
 $result = $conn->query($sql);
 $messages = array();
 while ($row = $result->fetch_assoc()) {
 $messages[] = $row;
 }
 echo json_encode($messages);
 $conn->close();
 ?>