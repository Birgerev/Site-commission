<!doctype html>
<html lang="sv">
	<head>
		<meta charset="utf-8">

		<!-- TODO comments-->
		<!-- TODO verification-->
		<title>Chat</title>
		<!-- <link rel="icon" type="Images/x-icon" href="Images/Logga.png">-->

		<link rel="stylesheet" href="styles/style.css">
		<link rel="stylesheet" href="styles/contentContainers.css">

	</head>
	<body>
		<div class="contentPanel">
			<div class="containerTitle">
				<h1>Forum</h1>
				<br>
				<a class="button showLoggedIn" onclick="onClickLogOut()">Logga ut</a>
			</div>

			<div id="messageHistory">
				<?php
				// Create connection
				$conn = new mysqli("localhost", "root", "", "chat");

				// Check connection
				if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

				//Get last 100 messages and order them by latest first
				$rows = $conn->query("SELECT sender_name, message_text FROM messages ORDER BY timestamp DESC LIMIT 100");

				while ($row = $rows->fetch_array(MYSQLI_NUM)) {
					echo
					"<div class='message'>
						<h1>$row[0]</h1>
						<p>$row[1]</p>
					</div>";
				}
				?>
			</div>


			<textarea type="text" id="chatbox" class="showLoggedIn"></textarea>

			<a id="submitMessageButton" class="button showLoggedIn" onclick="submitMessage()">Skicka</a>


			<div class="logInBox showLoggedOut">
				<a href="logga_in.html" class="button">Logga in</a>
				eller
				<a href="skapa_konto.html" class="button">Skapa ett konto</a>
			</div>

		</div>
	</body>

	<script src="scripts/chat.js"></script>

</html>
