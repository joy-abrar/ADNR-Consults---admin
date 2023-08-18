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
		<link rel="stylesheet" type="text/css" href="view/records/style.css?version=1">
		<link rel="stylesheet" type="text/css" href="lib/css/styleMenubar.css?version=1">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
		<title>Admin - Historiques</title>
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
		<h2 id="title">HISTORIQUES DE CONNEXIONS PRATICIENS</h2>
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
				    <th>Ville</th> 
				    <th>Code Postale</th>
				    <th>Nombre total de connexions</th>
				    <th>Dernier connexion</th>
				   <!-- <th>Supprimer</th> -->
				     

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
						<!--	<td>Vide</td> -->
			<?php
					}

					else
					{
			?>

						

			<?php
				 		while($rows = $connectionRecords -> fetch())
						{
							$praticienId = $rows['praticienId'];
							
							$getThisPraticienLastRecords = $userManager -> getThisPraticienLastRecords($praticienId);

							while ($rows2 = $getThisPraticienLastRecords -> fetch()) 
							{

								$getThisPraticienTotalRecords = $userManager -> getThisPraticienTotalRecords($praticienId);
								$rows3 = $getThisPraticienTotalRecords->rowCount();
							
								$getThisPraticienTotalInformationForRecords = $userManager -> getThisPraticienTotalInformationForRecords($praticienId);
								
								while($rows4 = $getThisPraticienTotalInformationForRecords -> fetch())
								{
			?>
									<tr>
									<td><?= strtoupper(base64_decode($rows4['lastname'])) ?></td>
									<td><?= ucwords(base64_decode($rows4['firstname'])) ?></td>
									<td><?= $rows4['dob'] ?></td> 
									<td><?= base64_decode($rows4['username']) ?></td>
									<td><?= $rows4['praticienCityName'] ?></td>
									<td><?= $rows4['praticienCodePostal'] ?></td> 
									<td><?= $rows3 ?></td>
									<td><?= $rows2['lastConnectionTime']?></td>
									</tr>
			<?php
								}
							}
							
							
						}	
					} 
			?>
					
				</tbody> 
			</table> 
		</div>

	<!-- --------------------------------- GRAPH RECORDS -------------------------------- -->
	<script>
	  	window.onload = function () 
	  	{
			var chart = new CanvasJS.Chart("chartContainer", 
			{
				title: {
					text: "Nombre total de connexions en journée"
				},
				exportFileName: "NB de connexions journée",
				exportEnabled: true,
				axisY: {
					labelFontSize: 20,
					labelFontColor: "dimGrey"
				},
				axisX: {
					labelAngle: -30
				},
				data: [
				{
					type: "spline",
					dataPoints: 
					[
						{	y: <?= $totalBeforeLastDayRecords ?>, label: "<?= $todayDate-2 . '/' . $todayMonth. '/' . $todayYear ?>" },
						{	y: <?= $totalLastDayRecords ?>, label: "<?= $todayDate-1 . '/' . $todayMonth . '/' . $todayYear ?>" },
						{	y: <?= $totalTodayRecords ?>, label: "<?= $today ?>" },
						/*{	y: 0, label: " "}*/
					]
				}
				]
			});

			chart.render();



			var chart2 = new CanvasJS.Chart("chartContainer2", 
			{
				title: {
					text: "Nombre total de connexions par mois"
				},
				exportFileName: "NB de connexions mensuel",
				exportEnabled: true,
				axisY: {
					labelFontSize: 20,
					labelFontColor: "dimGrey"
				},
				axisX: {
					labelAngle: -30
				},
				data: [
				{
					type: "spline",
					dataPoints: 
					[
						{	y: <?= $totalLastTwoMonthRecords ?>, label: "<?= $todayMonth-2 . '/' .$todayYear ?>" },
						{	y: <?= $totalLastMonthRecords ?>, label: "<?= $todayMonth-1 . '/' .$todayYear ?>" },
						{	y: <?= $totalMonthRecords ?>, label: "<?= $todayMonth. '/' . $todayYear ?>" },
						/*{ y: 0, label: " "}*/
					]
				}
				]
			});

			chart2.render();


		var chart3 = new CanvasJS.Chart("chartContainer3", 
		{
				title: {
					text: "Nombre total de connexions par l'année"
				},
				exportFileName: "NB de connexions annuelle",
				exportEnabled: true,
				axisY: {
					labelFontSize: 20,
					labelFontColor: "dimGrey"
				},
				axisX: {
					labelAngle: -30
				},
				data: [
				{
					type: "spline",
					dataPoints: 
					[
						{	y: <?= $totalLastTwoYearRecords ?>, label: "<?= $todayYear-2 ?>" },
						{	y: <?= $totalLastYearRecords ?>, label: "<?= $todayYear-1 ?>" },
						{	y: <?= $totalYearRecords ?>, label: "<?= $todayYear ?>" },
						
						/*{ y: 0, label: " "}*/
					]
				}
				]
			});

			chart3.render();

		}

		
	</script>

  <div id="graphBloc">
  	<div id="chartContainer" style="height: 30vh; width: 30%;"></div>
  	<div id="chartContainer2" style="height: 30vh; width: 30%;"></div>
  	<div id="chartContainer3" style="height: 30vh; width: 30%;"></div>
  </div>
<!-- --------------------------------- END GRAPH RECORDS -------------------------------- -->

		<a id="returnFunction" href="index.php?action=backToAdminDashboard">Revenir</a>

		<script type="text/javascript" src="view/records/main.js"></script>
		<script src="view/records/canvasjs.min.js"></script>
	</body>
</html>

<?php
}
else
{
	header("location: index.php");
}
?>