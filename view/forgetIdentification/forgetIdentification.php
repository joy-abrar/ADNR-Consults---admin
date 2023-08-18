<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css?version=1">
	<title>ADNR - Forget Identification</title>
</head>

<body>

	<div id="mainPage">
		<div id="connectionPart">
			<div id="connectionLogoBloc">
				<img id="connectionLogo" src="images/logo.png">
				<div id="formTitle">
					<hr id="borderLine">
						<span id="connectionMessage">Identification Oublié</span>
					<hr id="borderLine">
				</div>
			</div>
				<form id="connectionForm" method="POST" action="../index.php?action=login">
					<h4 id="textParam">Votre Adresse Mail</h4>
					<input id="inputEmailForm" type="email" name="username">
					<h4 id="textParam">Date De Naissance</h4>
					<input id="inputPasswordForm" type="date" name="password"><i onclick="showOrHide()" id="showOrHidePassword" class="fa-regular fa-eye"></i><br><br>
					&nbsp;&nbsp;&nbsp; <a id="forgetPasswordLink" href="../../index.php?action=forgetIdentification">identifiant oublié ?</a>
					<br>
					<input id="connexionButton" type="submit" name="connect" value="Verifier">
					<br><br>
				</form>
		</div>

		<div id="sidePart">
			<div id="homeFeed">
				<center><h1>MESSAGE TO PUBLISH</h1></center>
			</div>

			<div id="terms">
				<a id="conditionsLink" href="termsOfConditions/cgu.php">C.G.U.</a>
				<a id="conditionsLink" href="termsOfConditions/rgpd.php">RGPD</a>
				<a id="conditionsLink" href="termsOfConditions/mentions.php">Mentions Légales</a>
			</div>	
		</div>
	</div>

</body>
</html>