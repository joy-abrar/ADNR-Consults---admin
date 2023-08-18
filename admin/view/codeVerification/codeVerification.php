<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css?version=1">
	<title>ADNR - Check Code</title>
</head>

<body>

	<div id="mainPage">
		<div id="connectionPart">
			<div id="connectionLogoBloc">
				<img id="connectionLogo" src="images/logo.png">
				<div id="formTitle">
					<hr id="borderLine">
						<span id="connectionMessage">Vérification</span>
					<hr id="borderLine">
				</div>
			</div>
				<form id="connectionForm" method="POST" action="../../index.php?action=checkInsertedCode">
					<b id="verificationMessage">Un code vient juste de vous êtes envoyé. Vérifiez votre boîte mail et insérez-le</b>
					<h4 id="textParam">Code De Vérification</h4>
					<input id="inputEmailForm" type="number" name="code" min="1000" max="9999">
					<br>
					<input id="connexionButton" type="submit" name="connect" value="Suivant">
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