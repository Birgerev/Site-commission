<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "chat");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$account_name = $_GET['account_name'];
$password = $_GET['password'];


//Insert new account into database
$conn->query("INSERT INTO registered_accounts (account_name, password) VALUES ('$account_name', '$password')");


//Generate a token which user uses to validate theirself
$token = generateRandomString(32);
//Store token in database
$conn->query("INSERT INTO login_tokens (token, account_name) VALUES ('$token', '$account_name')");

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
