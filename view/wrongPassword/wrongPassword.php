<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css?version=1">

	<title>ANDR Formation</title>
</head>
<body>

	<header id="headerPart">
		<img id="logo" src="images/ADNR_Dégradé_Version.png">
	

		<div id="menuNav">

			<button id="linkParam1" onclick="switchFunction2()" > Se Connecter</button>
			<button id="linkParam2" onclick="switchFunction2()" > S'enregistrer</button>
			
		</div>
	</header>

	<div id="backgroundImage">
	</div>

	<div id="connectionBloc2">
		<form id="connectionForm" method="GET" action="../index.php?action=login">
			<b>Identifiant:</b>
			<input type="username" name="username">
			<b>Mot De Passe:</b>
			<input type="password" name="password">
			<br>
			<input id="loginFormButton" type="submit" name="connect" value="CONNECTER">

		</form>
	</div>

	<div id="createAccountBloc2">
		<form id="createAccountForm" method="POST" action="../index.php?action=createAccount">
			<b>Email:</b>
			<input type="email" name="email" required>
			<b>Identifiant:</b>
			<input type="username" name="username" required>
			<b>Mot De Passe:</b>
			<input type="password" name="password" required>
			<b>Retapez votre Mot De Passe:</b>
			<input type="password" name="retypedPassword" required>
			<b>Date De Naissance:</b>
			<input style="min-height: 1.5rem;" type="date" name="dob" required>
			<br>
			<b style="color:red">Le mot de passe n'est pas correct.</b>
			<br>
			<input id="createFormButton" type="submit" name="create" value="CREER">

		</form>
	</div>
	
<script type="text/javascript" src="main.js"></script>
</body>
</html>