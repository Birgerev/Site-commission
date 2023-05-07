//Determine whether we are logged in based on if cookie is set
var isLoggedIn = (document.cookie != "empty");

//We use two classes to identify which elements should be shown when logged in or when logged out
//".showLoggedOut" & ".showLoggedIn"
//Remove all elements of either class depending on "isLoggedIn"
if(isLoggedIn)
		document.querySelectorAll('.showLoggedOut').forEach(element => element.remove());
else
		document.querySelectorAll('.showLoggedIn').forEach(element => element.remove());

//Method called when log out button is pressed
function onClickLogOut() {
		//Empty the cookie, which contains the authentication token if logged in
		document.cookie = "empty";

		// Refresh the website
		location.reload();
}

function submitMessage() {
		//Fetch the login token we use instead of sending password & username
		var auth_token = document.cookie;
		//Get the message text from element with id #chatbox
		var message_content = document.getElementById("chatbox").value;

		//Open php page with token & text we want to send
		fetch("php/create_message.php?token=" + auth_token + "&message=" + message_content)

		//Refresh page after a couple millisenconds (so database has time to store the newest message)
		setInterval(function(){
		  location.reload();
		}, 200);
}
