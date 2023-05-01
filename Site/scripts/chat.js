//Determine whether we are logged in based on if cookie is set
var isLoggedIn = (document.cookie != "empty");

//Remove all elements that should be hidden when logged in/ logged out
if(isLoggedIn)
		document.querySelectorAll('.visibleWhenLoggedOut').forEach(element => element.remove());
else
		document.querySelectorAll('.visibleWhenLoggedIn').forEach(element => element.remove());

//Method called when log out button is pressed
function onClickLogOut() {
		//Empty the cookie, which contains the authentication token if logged in
		document.cookie = "empty";

		// Refresh the website
		location.reload();
}
