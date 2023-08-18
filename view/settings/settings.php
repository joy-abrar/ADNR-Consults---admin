<?php
	if (session_status() === PHP_SESSION_NONE) 
	{
		session_start();
	}

	if ($_SESSION['sessionStatus'] == "adminOnline") 
	{
?>
	<!DOCTYPE html>
	<html>
	<head>
		<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script src="https://kit.fontawesome.com/1bd3419ec6.js" crossorigin="anonymous"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css?version=1">
		<link rel="stylesheet" type="text/css" href="../../lib/css/styleMenubar.css?version=1">
		<title>ADNR - Settings</title>
	</head>
	<body id="setFont">

		<div class="dropdown">
		  <button class="dropbtn">MENU</button>
		  <div class="dropdown-content">
		  <a href="../../index.php?action=accueil">ACCUEIL</a>
		  <a href="../../index.php?action=myAccount">MON COMPTE</a>
		  <a href="../../index.php?action=settings">PARAMETRES</a>
		  <a href="../../index.php?action=more">PLUS</a>
		  <a href="../../index.php?action=logout">SE DECONNECTER</a>
		  </div>
		</div>

		<?php
			include_once('../../lib/topMenu2.php');
		?>
		
		<div id="settingsPageMain">
			<div id="settingsForum">
				<h3 id="settingsTitle">Paramètre du compte</h3>
					<form id="settingsFormItems" method="POST" action="../../index.php?action=updateAccount">
						<h4>Identifiant</h4>
						<input id="settingsFormInputDeco" type="text" name="username" value="<?= base64_decode($_SESSION['userName']) ?>" required readonly>
						<h4>Adresse mail</h4>
						<input id="settingsFormInputDeco" type="email" name="email" value="<?= base64_decode($_SESSION['userEmail']) ?>" required>
						<h4>Date de naissance</h4>
						<input id="settingsFormInputDeco" type="date" name="dob" value="<?= $_SESSION['userDob'] ?>" required>
						<h4>Mot de passe</h4>
						<input id="settingsFormInputDeco" type="password" name="password" value="<?= base64_decode($_SESSION['userPassword']) ?>" required>
						<h4>Retaper le mot de passe</h4>
						<input id="settingsFormInputDeco" type="password" name="retypedPassword" value="" required>
						<br>
						<input id="settingsSubmitButton" type="submit" name="valid" value="Sauvegarder">
					</form>
			</div>		
		</div>

		<script type="text/javascript" src="main.js"></script>
	</body>
	</html>

<?php
	}

	else
	{
		header("location:../../index.php");
	}


?>