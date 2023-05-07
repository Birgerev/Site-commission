function onClick() {
		var name = document.getElementById("name").value;
		var password = document.getElementById("password").value;

		//Make http request to php site and await response
		fetch("php/login_get_token.php?account_name=" + name + "&password=" + password)
		.then(response => {
      if (!response.ok) {//Throw error if http request failed
        throw new Error(response.status);
      }
      return response.text();
    })
		.then(data => recievedToken(data))//Call recievedToken if request was Succesfull
		.catch(error => errorResponse(error));
}

function errorResponse(error){
		console.error('HTML-request error: ' + error);

		document.getElementById("errorText").textContent = "Misslyckades (Fel lösenord?): " + error;
}


function recievedToken(token) {
		//Store token in cookies, so we can use it on other pages as authorisation
		document.cookie = token;

		//Redirect
		window.location.href = "index.php";
}
