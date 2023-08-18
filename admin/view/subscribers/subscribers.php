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
		<link rel="stylesheet" type="text/css" href="view/subscribers/style.css?version=1">
		<link rel="stylesheet" type="text/css" href="lib/css/styleMenubar.css?version=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
		<title>Admin - Liste des abonnées</title>
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

		<h2 id="title">MES ABONNEES</h2>
		<input type="text" id="mySearchBox" onkeyup="myFunction()" placeholder="Rechercher un client...">
		<div id="dashboardMenuOptions">
			<table class="zebra"> 
				</thead>
				<thead> 
				<tr> 
				    <th>Nom</th> 
				    <th>Prenom</th> 
				    <th>Numéro d'achat</th> 
				    <th>Date du paiement</th>
				    <th>Montant</th>
				    <th>Identité du compte</th> 
				    <th>Statue du paiement</th>
				    <th>Date de Fin d'abonnement</th>
				    <th>action</th>

				</tr> 
				</thead> 
				<tbody id="myTable"> 
			<?php
					if ($numberOfActivationStatus > 0) 
					{
						while ($rows = $getSubscribersId -> fetch()) 
						{

							$subscriberId = $rows['id']; 
							$getSubscribersSubscriptions = $userManager -> getSubscribersSubscriptions($subscriberId);

							while($rows2 = $getSubscribersSubscriptions->fetch())
							{
			?>

								<tr>
									<form method="POST" action="index.php?action=updateThisPraticiensSubscription&id=<?= $rows['id'] ?>">
									    <td><?= strtoupper(base64_decode($rows['lastname'])) ?></td> 
									    <td><?= ucfirst(base64_decode($rows['firstname'])) ?></td>
									    <td><?= $rows2['purchaseId'] ?></td> 
									    <td><?= $rows2['paymentTime'] ?></td>
									    <td><?= $rows2['amount'] ?> €</td>
									    <td><?= $rows2['payerId'] ?></td>
									    <td><?= $rows2['status'] ?></td>
									    <td><input type="date" name="expiryDate" value="<?= $rows2['expiryDate'] ?>"></td> 
									  
									    <td><input type="submit" name="submit" style="text-decoration: none;color: white; background: blue; border-radius: 5px;padding: 2px;" href="&id=<?= $rows['id'] ?>" value=" Soumettre "></td>
									</form>
								</tr>
			<?php
							}
						}
	
					}
					else
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
							<td>Vide</td>
						</tr> 
			<?php
				 	} 
			?>
				</tbody> 
			</table> 
		
		</div>

		<a id="returnFunction" href="index.php?action=backToAdminDashboard">Revenir</a>

		<script type="text/javascript" src="view/subscribers/main.js"></script>
	</body>
	</html>

<?php
	}
	else
	{
		header("location:index.php");
	}

?>