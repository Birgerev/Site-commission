<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "chat");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$account_name = $_GET['account_name'];
$password = $_GET['password'];


//Get password for all accounts with our name
$result = $conn->query("SELECT password FROM registered_accounts WHERE account_name = '$account_name'");

//Return if no account with name exists
if($result->num_rows == 0)
  die("No accounts with name found");

//Get password in database
$database_password = $result->fetch_assoc()['password'];

//Compare database password and sent password to see if they match
if($password != $database_password)
  die("Password was wrong");

//Succesfull login
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
