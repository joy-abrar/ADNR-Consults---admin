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
		<link rel="stylesheet" type="text/css" href="view/praticienRights/style.css?version=1.1">
		<link rel="stylesheet" type="text/css" href="lib/css/styleMenubar.css?version=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
		<title>Admin - Comptes validés</title>
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

		<h2 id="title">ROLE PRATICIENS</h2>
		<input type="text" id="mySearchBox" onkeyup="myFunction()" placeholder="Rechercher un praticien...">
		<div id="dashboardMenuOptions">
			<table class="zebra"> 
				</thead>
				<thead> 
				<tr> 
				    <th>Nom</th> 
				    <th>Prenom</th> 
				    <th>Date De Naissance</th>
				    <th>Identifiant</th>
				    <th>Niveau d'étude</th>
				    <th>Ville</th> 
				    <th>Code Postale</th>
				    <th>Pays</th>
				    <th>Rôles</th>
				    <th>Action</th>
				     

				</tr> 
				</thead> 
				<tbody id="myTable"> 
			<?php
				
					if ($numberOfPraticienResults == 0) 
					{
			?>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
							<td>Vide</td>
			<?php
					}

					else
					{
						while ($rows = $praticienRights -> fetch() ) 
						{
							$dateOfBirth = strtotime($rows['dob']);
							$dateOfBirth = date("d-m-Y" , $dateOfBirth);
			?>
							<tr> 
							    <td><?= ucfirst(base64_decode($rows['lastname'])) ?></td> 
							    <td><?= ucfirst(base64_decode($rows['firstname'])) ?></td> 
							    <td><?= $dateOfBirth ?></td>  
							    <td><?= base64_decode($rows['username']) ?></td>  
							    <td><?= $rows['praticienEducationQualification'] ?></td> 
								<td><?= $rows['praticienCityName'] ?></td>
								<td><?= $rows['praticienCodePostal'] ?></td> 
							    <td><?= $rows['praticienCountry'] ?></td>
							   	
								<td>
									<form method="POST" action="index.php?action=updateThisPraticienRoles&thisPraticienId=<?= $rows['id'] ?>">
								   		Naturopathe<input type="checkbox" name="Naturopathe" value="Naturopathe" 
								   		<?php 
									   		if ($rows['Naturopathe'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>> 
										Réflexologue<input type="checkbox" name="Réflexologue" value="Réflexologue"
										<?php 
									   		if ($rows['Reflexologue'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>> 
										Sophrologue<input type="checkbox" name="Sophrologue" value="Sophrologue"
										<?php 
									   		if ($rows['Sophrologue'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Médecin <input type="checkbox" name="Médecin" value="Médecin"
										<?php 
									   		if ($rows['Medecin'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										
										Chirurgien <input type="checkbox" name="Chirurgien" value="Chirurgien"
										<?php 
									   		if ($rows['Chirurgien'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Pharmacien<input type="checkbox" name="Pharmacien" value="Pharmacien"
										<?php 
									   		if ($rows['Pharmacien'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Dentiste<input type="checkbox" name="Dentiste" value="Dentiste"
										<?php 
									   		if ($rows['Dentiste'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Sage-femme<input type="checkbox" name="Sage-femme" value="Sage-femme"
										<?php 
									   		if ($rows['SageFemme'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Vétérinaire<input type="checkbox" name="Vétérinaire" value="Vétérinaire"
										<?php 
									   		if ($rows['Veterinaire'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Aide-soignant<input type="checkbox" name="AideSoignant" value="AideSoignant"
										<?php 
									   		if ($rows['AideSoignant'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Auxiliaire de puériculture <input type="checkbox" name="AuxiliaireDePuériculture" value="AuxiliaireDePuériculture"
										<?php 
									   		if ($rows['AuxiliaireDePuériculture'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Infirmier<input type="checkbox" name="Infirmier" value="Infirmier"
										<?php 
									   		if ($rows['Infirmier'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Infirmier de bloc opératoire <input type="checkbox" name="InfirmierDeBlocOpératoire" value="InfirmierDeBlocOpératoire"
										<?php 
									   		if ($rows['InfirmierDeBlocOperatoire'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Infirmier anesthésiste <input type="checkbox" name="InfirmierAnesthésiste" value="InfirmierAnesthésiste"
										<?php 
									   		if ($rows['InfirmierAnesthesiste'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Podologue<input type="checkbox" name="Podologue" value="Podologue"
										<?php 
									   		if ($rows['Podologue'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Kinésithérapeute <input type="checkbox" name="Kinésithérapeute" value="Kinésithérapeute"
										<?php 
									   		if ($rows['Kinesitherapeute'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Ergothérapeute <input type="checkbox" name="Ergothérapeute" value="Ergothérapeute"
										<?php 
									   		if ($rows['Ergotherapeute'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Orthophoniste <input type="checkbox" name="Orthophoniste" value="Orthophoniste"
										<?php 
									   		if ($rows['Orthophoniste'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Psychomotricien <input type="checkbox" name="Psychomotricien" value="Psychomotricien"
										<?php 
									   		if ($rows['Psychomotricien'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Diététicien <input type="checkbox" name="Diététicien" value="Diététicien"
										<?php 
									   		if ($rows['Dieteticien'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Orthoprothésiste <input type="checkbox" name="Orthoprothésiste" value="Orthoprothésiste"
										<?php 
									   		if ($rows['Orthoprothesiste'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Orthoptiste<input type="checkbox" name="Orthoptiste" value="Orthoptiste"
										<?php 
									   		if ($rows['Orthoptiste'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Pédicure<input type="checkbox" name="Pédicure" value="Pédicure"
										<?php 
									   		if ($rows['Pedicure'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Manipulateur en électroradiologie médicale <input type="checkbox" name="ManipulateurEnElectroradiologieMédicale" value="ManipulateurEnElectroradiologieMédicale"
										<?php 
									   		if ($rows['ManipulateurEnElectroradiologieMedicale'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Technicien de laboratoire <input type="checkbox" name="TechnicienDeLaboratoire" value="TechnicienDeLaboratoire"
										<?php 
									   		if ($rows['TechnicienDeLaboratoire'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Préparateur en pharmacie <input type="checkbox" name="PréparateurEnPharmacie" value="PréparateurEnPharmacie"
										<?php 
									   		if ($rows['PreparateurEnPharmacie'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Ambulancier<input type="checkbox" name="Ambulancier" value="Ambulancier"
										<?php 
									   		if ($rows['Ambulancier'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Psychologue<input type="checkbox" name="Psychologue" value="Psychologue"
										<?php 
									   		if ($rows['Psychologue'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
										Ophtalmologue<input type="checkbox" name="Ophtalmologue" value="Ophtalmologue"
										<?php 
									   		if ($rows['Ophtalmologue'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>

										Autres<input type="checkbox" name="autres" value="autres"
										<?php 
									   		if ($rows['autres'] == 1) 
									   		{
									   	?>
									   			checked
									   	<?php
									   		}
									   	?>>
								    		<td><input type="submit" name="submit" value="Valider"></td>
										</form>
									</td>
							</tr>
			<?php
						}
				 	} 
			?>
				</tbody> 
			</table> 
		</div>

		<a id="returnFunction" href="index.php?action=backToAdminDashboard">Revenir</a>

		<script type="text/javascript" src="view/validAccounts/main.js"></script>
	</body>
</html>

<?php
}
else
{
	header("location: index.php");
}
?>