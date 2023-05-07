// Determine whether the user is logged in by checking if the authentication token cookie is set
var isLoggedIn = (document.cookie != "empty");

// Use two classes, ".showLoggedOut" and ".showLoggedIn", to identify which elements should be shown when the user is logged in or logged out
// Remove all elements of either class depending on the value of "isLoggedIn"
if (isLoggedIn) {
	// Remove all elements with the class "showLoggedOut"
	document.querySelectorAll('.showLoggedOut').forEach(element => element.remove());
} else {
	// Remove all elements with the class "showLoggedIn"
	document.querySelectorAll('.showLoggedIn').forEach(element => element.remove());
}

// This function is called when the user clicks the log out button
function onClickLogOut() {
	// Empty the authentication token cookie to log the user out
	document.cookie = "empty";

	// Refresh the website to update the UI and hide elements for authenticated users
	location.reload();
}

// This function is called when the user submits a chat message
function submitMessage() {
	// Get the authentication token from the cookie
	var auth_token = document.cookie;

	// Get the chat message text from the element with ID "chatbox"
	var message_content = document.getElementById("chatbox").value;

	// Send an HTTP request to a PHP page with the authentication token and message text as parameters
	fetch("php/create_message.php?token=" + auth_token + "&message=" + message_content)

	// Wait a couple milliseconds to let the database store the newest message, then refresh the page to display the updated chat messages
	setInterval(function(){
		location.reload();
	}, 200);
}
