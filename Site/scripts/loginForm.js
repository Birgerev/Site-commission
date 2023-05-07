function onClick() {
		// Get the values of the name and password fields from the HTML document
		var name = document.getElementById("name").value;
		var password = document.getElementById("password").value;

		// Make an HTTP request to a PHP site to log in and get an authorization token
		fetch("php/login_get_token.php?account_name=" + name + "&password=" + password)
		.then(response => {
			// Check if the HTTP response was successful
			if (!response.ok) {
				// If the response was not successful, throw an error
				throw new Error(response.status);
			}
			// If the response was successful, return the response text
			return response.text();
		})
		.then(data => recievedToken(data)) // Call the recievedToken function with the response data
		.catch(error => errorResponse(error)); // If an error occurred, call the errorResponse function to handle it
}

function errorResponse(error){
		// Log the error message to the console
		console.error('HTML-request error: ' + error);

		// Set the error text in the HTML document to display the error message
		document.getElementById("errorText").textContent = "Misslyckades (Fel lösenord?): " + error;
}


function recievedToken(token) {
		// Store the token in a cookie so that it can be used for authorization on other pages
		document.cookie = token;

		// Redirect the user to the index.php page
		window.location.href = "index.php";
}
