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
		var auth_token = document.cookie;
		var message_content = document.getElementById("chatbox").value;


		fetch("php/create_message.php?token=" + auth_token + "&message=" + message_content)
		location.reload();

}
