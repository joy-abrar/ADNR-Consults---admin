<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css?version=1">
	<title>ADNR - Create Account</title>
</head>

<body>

	<div id="mainPage">
		<div id="connectionPart">
			<div id="connectionLogoBloc">
				<img id="connectionLogo" src="images/logo.png">
				<div id="formTitle">
					<hr id="borderLine">
						<span id="connectionMessage">Créez un compte</span>
					<hr id="borderLine">
				</div>
			</div>
				<form id="connectionForm" method="POST" action="../../index.php?action=createAccount">
					<h4 id="textParam">Votre Adresse Mail</h4>
					<input id="inputEmailForm" type="email" name="mail">
					<h4 id="textParam">Date De Naissance</h4>
					<input id="inputPasswordForm" type="date" name="dateOfBirth">
					<h4 id="textParam">Nom D'utilisateur</h4>
					<input id="inputEmailForm" type="text" name="username">
					<h4 id="textParam">Votre Mot De Passe</h4>
					<input id="inputEmailForm" type="password" name="password">
					<h4 id="textParam">Retapez Votre Mot De Passe</h4>
					<input id="inputEmailForm" type="password" name="retypedPassword">
					<br><br>
					<input id="connexionButton" type="submit" name="create" value="Créer">
					<div id="terms">
						<a id="conditionsLink" href="termsOfConditions/cgu.php">C.G.U.</a>
						<a id="conditionsLink" href="termsOfConditions/rgpd.php">RGPD</a>
						<a id="conditionsLink" href="termsOfConditions/mentions.php">Mentions Légales</a>
					</div>
					<br><br>
				</form>
		</div>

		<div id="sidePart">
		</div>
	</div>

</body>
</html>