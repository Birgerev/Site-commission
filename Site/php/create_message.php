<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "chat");

// Check connection
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get token and message from request parameters
$token = $_GET['token'];
$message_content = $_GET['message'];

// Query the login_tokens table to get the associated account name
$result = $conn->query("SELECT account_name FROM login_tokens WHERE token = '$token'");

// Check if there is a matching token
if($result->num_rows == 0){
  // If there is no matching token, return an error
  http_response_code(401);  //Unautharized response (invalid token)
  die("Invalid auth token");
}

// If the token is valid, get the account name from the query result
$account_name = $result->fetch_assoc()['account_name'];

// Insert the message into the messages table, using the account name as the sender
$conn->query("INSERT INTO messages (message_text, sender_name) VALUES ('$message_content', '$account_name')");

// Close the database connection
$conn->close();
?>
