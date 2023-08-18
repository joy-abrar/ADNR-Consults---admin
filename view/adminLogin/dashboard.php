<?php
	session_start();

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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
		<title>Admin - Tableau de Bord</title>
	</head>
	<body id="setFont">

		<!------------ LOADING SCREEN ------------->
			<div class="se-pre-con"></div>	
		<!----------------------------------------->

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
			include_once("../../lib/topMenu2.php");
		?>

		<div id="dashboardMenuOptions">

			
			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=showSentMailsForAdmin" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/email.png" >Email Envoyés</a>
			</div>

			<!--
			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=createTable" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/01.jpg" >Gestion des utilisateurs</a>
			</div>
			-->
			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=accountCreateRequests" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/create.png" >Demandes de création du compte</a>
			</div>

			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=validAccounts" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/valid.png" >Comptes Validés</a>
			</div>

			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=rejectAccounts" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/refused.png" >Comptes Refusés</a>
			</div>		
		
			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=clientList" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/client.png" >Comptes Clients</a>
			</div>

			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=subscribers" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/subscribers.png" >Les Abonnées</a>
			</div>

			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=demoUsers" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/demo.png" >Version D'essais</a>
			</div>

			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=praticienRights" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/praticienRights.png" >Droits De Praticiens</a>
			</div>

			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=connectionRecords" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/records.png" >Historiques De Connexions</a>
			</div>

			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=allConnectionRecords" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/records.png" >Tous les Records</a>
			</div>

			<div id="dashboardMenuOptionsImageBloc">
				<a href="../../index.php?action=otherJustifications" id="dashboardMenuOption"><img id="dashboardMenuOptionsImage" src="images/otherDocuments.png" >Autres Justificatifs</a>
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