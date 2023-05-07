<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "chat");

// Check connection
if ($conn->connect_error) {
  http_response_code(500);  // Internal error response
  die("Connection failed: " . $conn->connect_error);
}

// Read user request data
$account_name = $_GET['account_name'];
$password = $_GET['password'];

// Check if account name already exists
$result = $conn->query("SELECT * FROM registered_accounts WHERE account_name = '$account_name'");

// Return error if account already exists
if($result->num_rows > 0){
  http_response_code(400);  // Bad request response (can't create duplicates)
  die("Duplicate account");
}

// Insert new account into database
$conn->query("INSERT INTO registered_accounts (account_name, password) VALUES ('$account_name', '$password')");

// Generate a token which user uses to validate themselves
$token = generateRandomString(32);

// Store token in database
$conn->query("INSERT INTO login_tokens (token, account_name) VALUES ('$token', '$account_name')");

// Echo the generated token
echo $token;

$conn->close();

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
