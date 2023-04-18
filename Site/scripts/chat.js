
var isLoggedIn = (document.cookie != "empty");

if(isLoggedIn)
		document.querySelectorAll('.visibleWhenLoggedOut').forEach(element => element.remove());
else
		document.querySelectorAll('.visibleWhenLoggedIn').forEach(element => element.remove());

function onClickLogOut() {
		//Empty the cookie, which contains token if logged in
		document.cookie = "empty";

		// Reload the current page
		location.reload();
}
