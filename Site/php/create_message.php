<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "chat");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$token = $_GET['token'];
$message_content = $_GET['message'];

//Get account_name for our token
$result = $conn->query("SELECT account_name FROM login_tokens WHERE token = '$token'");

//Return if no matching token exists
if($result->num_rows == 0){
  http_response_code(401);  //Unautharized response (invalid token)
  die("Invalid auth token");
}

//Succesfully authenticated
//Get account name in database
$account_name = $result->fetch_assoc()['account_name'];

//create message with sender & message_text
$conn->query("INSERT INTO messages (message_text, sender_name) VALUES ('$message_content', '$account_name')");

$conn->close();

?>
