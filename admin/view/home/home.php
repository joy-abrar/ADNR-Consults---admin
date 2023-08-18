<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css?version=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/1bd3419ec6.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="main.js"></script>
	<title>ADNR Formations</title>
</head>
<body>

	<div id="mainPage">
		<div id="connectionPart">
			<div id="connectionLogoBloc">
				<img id="connectionLogo" src="images/logo.png">
				<div id="formTitle">
					<hr id="borderLine">
						<span id="connectionMessage">Admin</span>
					<hr id="borderLine">
				</div>
			</div>
				<form id="connectionForm" method="POST" action="../../index.php?action=login">
					<h4 id="textParam">Identifiant</h4>
					<input id="inputEmailForm" type="text" name="username" autocomplete="off">
					<h4 id="textParam">Mot de passe</h4>
					<input id="inputPasswordForm" type="password" name="password"><i onclick="showOrHide()" id="showOrHidePassword" class="fa-regular fa-eye"></i><br><br>
					<input type="checkbox" name="checkBox">&nbsp;&nbsp;&nbsp; <span id="textParam">Se souvenir de moi</span>&nbsp;&nbsp;&nbsp; <a id="forgetPasswordLink" href="../../index.php?action=forgetPassword">Mot de passe oublié ?</a>
					<a id="createAccountLink" href="../../index.php?action=createAccountLink">Créer un compte</a>
					<br>
					<input id="connexionButton" type="submit" name="connect" value="Connexion">
					<div id="terms">
						<a id="conditionsLink" href="../termsOfConditions/cgu.php">C.G.U.</a>
						<a id="conditionsLink" href="../termsOfConditions/rgpd.php">RGPD</a>
						<a id="conditionsLink" href="../termsOfConditions/mentions.php">Mentions Légales</a>
					</div>
					<br><br>
				</form>
		</div>

		<div id="sidePart">
		</div>
	</div>

</body>
</html>