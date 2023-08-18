<div id="dashboardMenuBloc">
	<nav id="dashboardMenu">
		<a id="welcomeUserName" href="../../index.php?action=accueil"><i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;<?= ucfirst(base64_decode($_SESSION['firstName'])) . " " . strtoupper(base64_decode($_SESSION['lastName'])) ?></a>
		<a id="dashboardButtons" href="../../index.php?action=accueil">ACCUEIL</a>
		<a id="dashboardButtons" href="../../index.php?action=myAccount">MON COMPTE</a>
		<a id="dashboardButtons" href="../../index.php?action=settings">PARAMETRES</a>
		<a id="dashboardButtons" href="../../index.php?action=more">PLUS</a>
		<a id="dashboardButtons" href="../../index.php?action=logout"><i class="fa-solid fa-power-off"></i></a>
	</nav>
</div>