<?php

	require('controller/controller_admin.php');


	if (isset($_GET['action'])) 
	{
		if ($_GET['action'] == "createAccount") 
		{
			$email = base64_encode($_POST['mail']) ;
			$username = base64_encode($_POST['username']);
			$password = base64_encode($_POST['password']);
			$retypedPassword = base64_encode($_POST['retypedPassword']);
			$dob = $_POST['dateOfBirth'];

			$controls_admin = new Controls_Admin();
			$controls_admin -> createAccount($email, $username, $password, $retypedPassword, $dob);
			
		}


		if ($_GET['action'] == "login") 
		{
			$username = base64_encode($_POST['username']);
			$password = base64_encode($_POST['password']);
			$controls_admin = new controls_Admin();
			$controls_admin -> login($username, $password);
		}

		if ($_GET['action'] == "checkEmailAndPasswordForRecovery") 
		{
			$code = rand("1000", "9999");
			$email = base64_encode($_POST['email']);
			$dateOfBirth = $_POST['dateOfBirth'];
			
			/*
			echo $dateOfBirth . "<br>";
			$yyyy = substr($dateOfBirth,0,4);
			$mm = substr($dateOfBirth,5,2);
			$dd = substr($dateOfBirth,8,2);
			$convertedDate = $yyyy."-".$mm."-".$dd;
			echo $convertedDate;
			*/
			if ($email && $dateOfBirth != null) 
			{
				$controls_admin = new controls_Admin();
				$controls_admin -> checkEmailAndPasswordForRecovery($email, $dateOfBirth, $code);		
			}

			else
			{
				
			}
		}

		if ($_GET['action'] == "checkInsertedCode") 
		{
			session_start();
			$recoveryEmail = $_SESSION['recoveryEmail'];
			$code = $_POST['code'];
			$controls_admin = new controls_Admin();
			$controls_admin -> checkInsertedCode($recoveryEmail, $code);
		}


		if ($_GET['action'] == "resetPassword") 
		{
			$password = base64_encode($_POST['password']);
			$retypedPassword = base64_encode($_POST['retypedPassword']);
			session_start();
			$recoveryEmail = $_SESSION['recoveryEmail'];

			$controls_admin = new controls_Admin();
			$controls_admin -> resetPassword($recoveryEmail, $password,$retypedPassword);
		}


		if ($_GET['action'] == "wrongPassword") 
		{
			header("location: view/wrongPassword/wrongPassword.php");		
		}

		if ($_GET['action'] == "settings") 
		{
			$controls_admin = new controls_Admin();
			$controls_admin -> settings();		
		}

		if ($_GET['action'] == "updateAccount") 
		{
			$username = base64_encode($_POST['username']);
			$email = base64_encode($_POST['email']);
			$dob = $_POST['dob'];
			$password = base64_encode($_POST['password']);
			$retypedPassword = base64_encode($_POST['retypedPassword']);

			$controls_admin = new controls_Admin();
			$controls_admin -> updateAccount($username, $email, $dob, $password, $retypedPassword);		

		}


		if ($_GET['action'] == "logout")
		{

			$controls_admin = new Controls_Admin();
			$controls_admin -> logout();
			
		}

		if ($_GET['action'] == "forgetPassword") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> forgetPassword();
		}

		if ($_GET['action'] == "forgetIdentification") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> forgetIdentification();
		}

		if ($_GET['action'] == "goBack") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> goBack();
		}

		if ($_GET['action'] == "createAccountLink") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> createAccountLink();	
		}

		if ($_GET['action'] == "accueil") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> accueil();	
		}

		if ($_GET['action'] == "showSentMailsForAdmin") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> showSentMailsForAdmin();
		}

		if ($_GET['action'] == "accountCreateRequests") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> accountCreateRequests();
		}

		if ($_GET['action'] == "validThisPraticienAccountRequest") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> validThisPraticienAccountRequest($id);
		}

		if ($_GET['action'] == "validThisClientAccountRequest") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> validThisClientAccountRequest($id);
		}

		if ($_GET['action'] == "deleteThisClientRejectedAccount") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> deleteThisClientRejectedAccount($id);
		}


		if ($_GET['action'] == "rejectThisPraticienAccountRequest") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> rejectThisPraticienAccountRequest($id);
		}

		if ($_GET['action'] == "validAccounts") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> validAccounts();
		}

		if ($_GET['action'] == "rejectAccounts") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> rejectAccounts();
		}

		if ($_GET['action'] == "deleteThisPraticienRejectedAccount") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> deleteThisPraticienRejectedAccount($id);
		}

		if ($_GET['action'] == "rejectThisPraticienValidAccount") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> rejectThisPraticienValidAccount($id);
		}

		if ($_GET['action'] == "rejectThisClientValidAccount") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> rejectThisClientValidAccount($id);
		}

		if ($_GET['action'] == "deleteThisPraticienValidAccount") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> deleteThisPraticienValidAccount($id);
		}

		if ($_GET['action'] == "deleteThisClientValidAccount") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> deleteThisClientValidAccount($id);
		}
		
		
		if ($_GET['action'] == "clientList") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> clientList();
		}

		if ($_GET['action'] == "subscribers") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> subscribers();
		}

		if ($_GET['action'] == "updateThisPraticiensSubscription") 
		{
			$id = $_GET['id'];
			$expiryDate = $_POST['expiryDate'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> updateThisPraticiensSubscription($id, $expiryDate);
		}

		if ($_GET['action'] == "demoUsers") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> demoUsers();
		}

		if ($_GET['action'] == "praticienRights") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> praticienRights();
		}

		if ($_GET['action'] == "updateThisPraticienRoles") 
		{
			$thisPraticienId = $_GET['thisPraticienId'];
			echo $thisPraticienId;

			$Naturopathe = 0;
			$Reflexologue = 0;
			$Sophrologue = 0;
			$Medecin = 0;
			$Chirurgien = 0;
			$Pharmacien = 0;
			$Dentiste = 0;
			$SageFemme = 0;
			$Veterinaire = 0;
			$AideSoignant = 0;
			$AuxiliaireDePuericulture = 0;
			$Infirmier = 0;
			$InfirmierDeBlocOperatoire = 0;
			$InfirmierAnesthesiste = 0;
			$Podologue = 0;
			$Kinesitherapeute = 0;
			$Ergotherapeute = 0;
			$Orthophoniste = 0;
			$Psychomotricien = 0;
			$Dieteticien = 0;
			$Orthoprothesiste = 0;

			$Orthoptiste = 0;
			$Pedicure = 0;
			$ManipulateurEnElectroradiologieMedicale = 0;
			$TechnicienDeLaboratoire = 0;
			$PreparateurEnPharmacie = 0;
			$Ambulancier = 0;
			$Psychologue = 0;
			$Ophtalmologue = 0;
			$autres = 0;

			
			if (isset($_POST['Naturopathe']))
			{
				$Naturopathe = 1;
			}

			if (isset($_POST['Réflexologue']))
			{
				$Reflexologue = 1;
			}

			if (isset($_POST['Sophrologue']))
			{
				$Sophrologue = 1;
			}

			if (isset($_POST['Médecin']))
			{
				$Medecin = 1;
			}

			if (isset($_POST['Chirurgien']))
			{
				$Chirurgien = 1;
			}

			if (isset($_POST['Pharmacien']))
			{
				$Pharmacien = 1;
			}

			if (isset($_POST['Dentiste']))
			{
				$Dentiste = 1;
			}

			if (isset($_POST['SageFemme']))
			{
				$SageFemme = 1;
			}

			if (isset($_POST['Vétérinaire']))
			{
				$Veterinaire = 1;
			}

			if (isset($_POST['AideSoignant']))
			{
				$AideSoignant = 1;
			}

			if (isset($_POST['AuxiliaireDePuériculture']))
			{
				$AuxiliaireDePuericulture = 1;
			}

			if (isset($_POST['Infirmier']))
			{
				$Infirmier = 1;
			}

			if (isset($_POST['InfirmierDeBlocOpératoire']))
			{
				$InfirmierDeBlocOperatoire = 1;
			}

			if (isset($_POST['InfirmierAnesthésiste']))
			{
				$InfirmierAnesthesiste = 1;
			}

			if (isset($_POST['Podologue']))
			{
				$Podologue = 1;
			}

			if (isset($_POST['Kinésithérapeute']))
			{
				$Kinesitherapeute = 1;
			}

			if (isset($_POST['Ergothérapeute']))
			{
				$Ergotherapeute = 1;
			}

			if (isset($_POST['Orthophoniste']))
			{
				$Orthophoniste = 1;
			}

			if (isset($_POST['Psychomotricien']))
			{
				$Psychomotricien = 1;
			}

			if (isset($_POST['Diététicien']))
			{
				$Dieteticien = 1;
			}

			if (isset($_POST['Orthoprothésiste']))
			{
				$Orthoprothesiste = 1;
			}

			if (isset($_POST['Orthoptiste']))
			{
				$Orthoptiste = 1;
			}

			if (isset($_POST['Pédicure']))
			{
				$Pedicure = 1;
			}

			if (isset($_POST['ManipulateurEnElectroradiologieMédicale']))
			{
				$ManipulateurEnElectroradiologieMedicale = 1;
			}

			if (isset($_POST['TechnicienDeLaboratoire']))
			{
				$TechnicienDeLaboratoire = 1;
			}

			if (isset($_POST['PréparateurEnPharmacie']))
			{
				$PreparateurEnPharmacie = 1;
			}

			if (isset($_POST['Ambulancier']))
			{
				$Ambulancier = 1;
			}

			if (isset($_POST['Psychologue']))
			{
				$Psychologue = 1;
			}

			if (isset($_POST['Ophtalmologue']))
			{
				$Ophtalmologue = 1;
			}

			if (isset($_POST['autres']))
			{
				$autres = 1;
			}
			
			$controls_admin = new Controls_Admin();
			$controls_admin -> updateThisPraticienRoles($thisPraticienId, $Naturopathe, $Reflexologue, $Sophrologue, $Medecin, $Chirurgien, $Pharmacien, $Dentiste, $SageFemme, $Veterinaire, $AideSoignant, $AuxiliaireDePuericulture, $Infirmier, $InfirmierDeBlocOperatoire, $InfirmierAnesthesiste, $Podologue, $Kinesitherapeute, $Ergotherapeute, $Orthophoniste, $Psychomotricien, $Dieteticien, $Orthoprothesiste, $Orthoptiste, $Pedicure, $ManipulateurEnElectroradiologieMedicale, $TechnicienDeLaboratoire, $PreparateurEnPharmacie, $Ambulancier, $Psychologue, $Ophtalmologue, $autres);
		}

		if ($_GET['action'] == "updateThisPraticiensTrial") 
		{
			$id = $_GET['id'];
			$expiryDate = $_POST['expiryDate'];

			$controls_admin = new Controls_Admin();
			$controls_admin -> updateThisPraticiensTrial($id, $expiryDate);
		}

		if ($_GET['action'] == "deleteThisClient") 
		{
			$id = $_GET['id'];
		
			$controls_admin = new Controls_Admin();
			$controls_admin -> deleteThisClient($id);
		}

		if ($_GET['action'] == "backToAdminDashboard") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> backToAdminDashboard();
		}

		if ($_GET['action'] == "deleteSelectedMail") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> deleteSelectedMail($id);
		}

		if ($_GET['action'] == "deleteAllMail") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> deleteAllMail();
		}

		if ($_GET['action'] == "connectionRecords") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> connectionRecords();
		}

		if ($_GET['action'] == "allConnectionRecords") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> allConnectionRecords();
		}

		if ($_GET['action'] == "otherJustifications") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> otherJustifications();
		}

		if ($_GET['action'] == "deleteThisJustificative") 
		{
			$id = $_GET['id'];
			$controls_admin = new Controls_Admin();
			$controls_admin -> deleteThisJustificative($id);
		}
	}


	else
	{
		if (session_status() === PHP_SESSION_NONE) 
		{
			session_start();
		}
		
		if ($_SESSION['sessionStatus'] == "online") 
		{
			$controls_admin = new Controls_Admin();
			$controls_admin -> accueil();
		}
		
		else
		{
			header("location: view/home/home.php");
		}
	}

?>