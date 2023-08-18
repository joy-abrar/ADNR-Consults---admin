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
		<link rel="stylesheet" type="text/css" href="view/showEmails/style.css?version=1">
		<link rel="stylesheet" type="text/css" href="lib/css/styleMenubar.css?version=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
		<title>Admin - Mails envoyés</title>
	</head>
	<body id="setFont">

	<!------------ LOADING SCREEN ------------->
		<div class="se-pre-con"></div>	
	<!----------------------------------------->

		<div class="dropdown">
		  <button class="dropbtn">MENU</button>
		  <div class="dropdown-content">
		  <a href="index.php?action=accueil">ACCUEIL</a>
		  <a href="index.php?action=myAccount">MON COMPTE</a>
		  <a href="index.php?action=settings">PARAMETRES</a>
		  <a href="index.php?action=more">PLUS</a>
		  <a href="index.php?action=logout">SE DECONNECTER</a>
		  </div>
		</div>


		<?php
			include_once('lib/topMenu1.php');
		?>

		<h2 id="title">MAILS ENVOYES</h2>
		<input type="text" id="mySearchBox" onkeyup="myFunction()" placeholder="Rechercher un mail...">
		<div id="dashboardMenuOptions">
			<table class="zebra"> 
					<a class="deleteTable" href="index.php?action=deleteAllMail">Supprimer tout</a>
				</thead>
				<thead> 
				<tr> 
				    <th>Envoyé depuis</th> 
				    <th>Envoyé vers</th> 
				    <th>Date</th>
				    <th>Heure</th> 
				    <th>Site web</th> 
				    <th>Options</th> 
				</tr> 
				</thead> 
				<tbody id="myTable"> 
			<?php
				while ($rows = $showSentMailsForAdmin -> fetch() ) 
				{
					$mailDate = strtotime($rows['mailTime']);
					$mailDate = date('d/m/Y', $mailDate);

					$mailTime = strtotime($rows['mailTime']);
					$mailTime = date('H:i', $mailTime); 
			?>

						<tr>
						    <td><?php echo base64_decode($rows['senderMail']) ?></td> 
						    <td><?php echo base64_decode($rows['receiverMail']) ?></td> 
						    <td><?php echo $mailDate ?></td>
						    <td><?php echo $mailTime ?></td> 
						    <td><a target="_new" href="../projet 1.8" style="color: blue;">ADNR Formations</a></td> 
						    <td><a href="index.php?action=deleteSelectedMail&id=<?=$rows['id']?>">Supprimer</a></td> 
						</tr> 

			<?php
				 } 
			?>
				</tbody> 
			</table> 
		</div>

		<a id="returnFunction" href="index.php?action=backToAdminDashboard">Revenir</a>
	</body>
	<script type="text/javascript" src="view/showEmails/main.js"></script>
</html>
<?php
	}

	else
	{
		header("location:index.php");
	}
?>