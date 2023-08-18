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
		<link rel="stylesheet" type="text/css" href="view/otherJustifications/style.css?version=1.0">
		<link rel="stylesheet" type="text/css" href="lib/css/styleMenubar.css?version=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
		<title>Admin - Autres pièces justificatifs</title>
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

		<h2 id="title">AUTRES PIECES JUSTIFICATIVES</h2>
		<input type="text" id="mySearchBox" onkeyup="myFunction()" placeholder="Rechercher un client vérifié...">
		<div id="dashboardMenuOptions">
			<table class="zebra"> 
				</thead>
				<thead> 
				<tr> 
				    <th>Nom</th> 
				    <th>Prenom</th> 
				    <th>Date De Naissance</th> 
				    <th>Identifiant</th> 
				    <th>Adresse mail</th>
				    <th>Nom du document</th>
				    <th>Voir le document</th>
				    <th>Supprimer</th>

				</tr> 
				</thead> 
				<tbody id="myTable"> 
			<?php
					if ($numberOfJustificationResults == 0) 
					{
			?>
						<tr>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
						</tr>
			<?php
					}
					else
					{
						while ($rows = $otherJustifications -> fetch() ) 
						{
							$praticienId = $rows['praticienId'];
							
							$getThisPraticienDetails = $userManager -> getThisPraticienDetails($praticienId);
							
							while ($rows2 = $getThisPraticienDetails -> fetch()) 
							{
			?>
								<tr>
								    <td><?= base64_decode($rows2['lastname']) ?></td> 
								    <td><?= base64_decode($rows2['firstname']) ?></td> 
								    <td><?= $rows2['dob']; ?></td>
								    <td><?= base64_decode($rows2['username']) ?></td> 
								    <td><?= base64_decode($rows2['email']) ?></td>   
								    <td><?= $rows['documentName'] ?></td>
								    <td><b onclick = "debugBase64('<?= $rows['documentData'] ?>')" >Voir</b></td> 
								    
								    <td><a href="index.php?action=deleteThisJustificative&id=<?= $rows['id'] ?>">Supprimer</a></td>
							</tr>
			<?php
								
							}
			?> 
			<?php
						}
				 	} 
			?>
				</tbody> 
			</table> 
		
		</div>


		<a id="returnFunction" href="index.php?action=backToAdminDashboard">Revenir</a>

		<script type="text/javascript" src="view/otherJustifications/main.js"></script>
	</body>
	</html>

<?php
	}

	else
	{
		header("location:index.php");
	}


?>