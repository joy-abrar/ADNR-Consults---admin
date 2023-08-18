<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css?version=1">
	<title>ADNR - Reset Password</title>
</head>

<body>

	<div id="mainPage">
		<div id="connectionPart">
			<div id="connectionLogoBloc">
				<img id="connectionLogo" src="images/logo.png">
				<div id="formTitle">
					<hr id="borderLine">
						<span id="connectionMessage">Réinitialiser</span>
					<hr id="borderLine">
				</div>
			</div>
				<form id="connectionForm" method="POST" action="../../index.php?action=resetPassword">
					<h4 id="textParam">Saisissez votre mot de passe</h4>
					<input id="inputPasswordForm" type="password" name="password" required>
					<h4 id="textParam">Resaisissez votre mot de passe</h4>
					<input id="inputPasswordForm" type="password" name="retypedPassword" required><br><br>
					<br>
					<input id="connexionButton" type="submit" name="connect" value="Mettre à jour">
					<br><br>
				</form>
		</div>
	</div>

</body>
</html>