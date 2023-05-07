<!doctype html>
<html lang="sv">
	<head>
		<meta charset="utf-8">

		<!-- Set the title of the page -->
		<title>Chat</title>

		<!--Link to all css style sheets-->
		<link rel="stylesheet" href="styles/global.css">
		<link rel="stylesheet" href="styles/contentContainers.css">
		<link rel="stylesheet" href="styles/chat.css">

		</head>

		<!-- The body of the HTML page -->
		<body>
		<div class="contentPanel">
			<!-- The title of the chat forum -->
			<div class="titleContainer">
				<h1>Forum</h1>
				<br>

				<!-- Button to log out, only shown when logged in -->
				<a class="button showLoggedIn" onclick="onClickLogOut()">Logga ut</a>
			</div>

			<!-- The container for the chat messages -->
			<div id="messageHistory">
				<?php
						// Create connection to the database
						$conn = new mysqli("localhost", "root", "", "chat");

						// Check if connection failed
						if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

						//Get the 100 latest messages and order them by latest first
						$rows = $conn->query("SELECT sender_name, message_text FROM messages ORDER BY timestamp DESC LIMIT 100");

						while ($row = $rows->fetch_array(MYSQLI_NUM)) {
							//Echo the sender name and message for each message in the database
							echo
							"<div class='message'>
								<h1>$row[0]</h1>
								<p>$row[1]</p>
							</div>";
						}
				?>
			</div>

			<!-- Textarea for inputting a new message, only shown when logged in -->
			<textarea id="chatbox" class="showLoggedIn"></textarea>

			<!-- Button to submit a new message, only shown when logged in -->
			<a id="submitMessageButton" class="button showLoggedIn" onclick="submitMessage()">Skicka</a>

			<!-- Login prompt, shown when not logged in -->
			<div class="logInPrompt showLoggedOut">
				<a href="logga_in.html" class="button">Logga in</a>
				eller
				<a href="skapa_konto.html" class="button">Skapa ett konto</a>
			</div>

			<!-- Include the JavaScript file -->
			<script src="scripts/chat.js"></script>
		</div>
</body>
