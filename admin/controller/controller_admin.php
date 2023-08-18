	<?php
require('model/Manager/userManager.php');


	class controls_Admin
	{

		function createAccount($email, $username, $password, $retypedPassword, $dob)
		{
			if ($password == $retypedPassword) 
			{
				$userManager = new userManager();
				$userManager -> createAccount($email, $username, $password, $dob);

				session_start();
				$_SESSION['createAccountStatus'] = "created" ;
					header("location:view/createdAccount/createdAccount.php");
			}

			else
			{
				$userManager = new userManager();

				$userManager -> missmatchedPassword();
			}
		}

		function login($username, $password)
		{
			$userManager = new userManager();
			$userManager -> login($username, $password);
		}

		function checkEmailAndPasswordForRecovery($email, $dateOfBirth, $code)
		{
			session_start();
			$_SESSION['recoveryEmail'] = $email;
			$_SESSION['recoveryCode'] = $code;
			$userManager = new userManager();
			$userManager -> checkEmailAndPasswordForRecovery($email, $dateOfBirth, $code);
			header('location:view/codeVerification/codeVerification.php');
			
		}


		function checkInsertedCode($recoveryEmail, $code)
		{
			$userManager = new userManager();
			$userManager -> checkInsertedCode($recoveryEmail, $code);
			
		}

		function resetPassword($recoveryEmail, $password,$retypedPassword)
		{
			if ($password == $retypedPassword) 
			{
				$userManager = new userManager();
				$userManager -> resetPassword($recoveryEmail, $password,$retypedPassword);
				header("location:index.php");
			}
			
			else 
			{
				echo "password didnt match";
			}	
		}

		function settings()
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
				session_start();
			}
			header("location:view/settings/settings.php");
		}

		function updateAccount($username, $email, $dob, $password, $retypedPassword)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
				session_start();
			}

			$userId = $_SESSION['userId'];

			if ($password === $retypedPassword) 
			{
				$userManager = new userManager();
				$userManager -> updateAccount($userId, $username, $email, $dob, $password, $retypedPassword);
				header("location:index.php?action=logout");
			}

			else
			{
				header("location:index.php?action=settings");
			}
		}

		function logout()
		{
			$userManager = new userManager();
			$userManager -> logout();
		}

		function forgetPassword()
		{
			$userManager = new userManager();
			$userManager -> forgetPassword();
		}

		function createAccountLink()
		{
			$userManager = new userManager();
			$userManager -> createAccountLink();
		}

		function forgetIdentification()
		{
			$userManager = new userManager();
			$userManager -> forgetIdentification();
		}

		function goBack()
		{
			$userManager = new userManager();
			$userManager -> goBack();
		}

		function accueil()
		{
			header("location: view/adminLogin/dashboard.php");
		}

		function showSentMailsForAdmin()
		{
			$userManager = new userManager();
			$showSentMailsForAdmin = $userManager -> showSentMailsForAdmin();
			include_once('view/showEmails/showEmails.php');
		}

		function accountCreateRequests()
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
				session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
				$userManager = new userManager();
				$accountCreateRequests = $userManager -> accountCreateRequests();
				$numberOfResults = $accountCreateRequests -> rowCount();

				include_once('view/accountCreateRequests/accountCreateRequests.php');
			}

			else
			{
				header("location:index.php");
			}
		}

		function validThisPraticienAccountRequest($id)
		{
			$praticienName = null;
			$praticienEmail = null;
			$praticienLogin = null;

			$userManager = new userManager();
			$validThisPraticienAccountRequest = $userManager -> validThisPraticienAccountRequest($id);

			$contentPageDesign = $userManager -> contentPageDesign($id);
			$createThisPraticienNaturoContentTable = $userManager -> createThisPraticienNaturoContentTable($id);

			$getPraticienDetailsForConfirmationMail = $userManager -> getPraticienDetailsForConfirmationMail($id);

			while ($rows = $getPraticienDetailsForConfirmationMail -> fetch()) 
			{
				$praticienName = base64_decode($rows['firstname']);
				$praticienEmail = base64_decode($rows['email']);
				$praticienLogin = base64_decode($rows['username']);
			}

			include_once('sendPraticienAccountConfirmedMail/sendPraticienAccountConfirmedMail.php');
			
			header('location:index.php?action=validAccounts');	
		}

		function validThisClientAccountRequest($id)
		{
			$userManager = new userManager();
			$validThisClientAccountRequest = $userManager -> validThisClientAccountRequest($id);

			header('location:index.php?action=validAccounts');	
		}

		function deleteThisClientRejectedAccount($id)
		{
			$userManager = new userManager();
			$deleteThisClientRejectedAccount = $userManager -> deleteThisClientRejectedAccount($id);
			$numberOfResults = $deleteThisClientRejectedAccount -> rowCount();

			$deleteThisClientAllConnections = $userManager -> deleteThisClientAllConnections($id);
			header('location:index.php?action=rejectAccounts');	
		}

		function rejectThisPraticienAccountRequest($id)
		{
			$userManager = new userManager();
			$rejectThisPraticienAccountRequest = $userManager -> rejectThisPraticienAccountRequest($id);

			$getPraticienDetailsForRejectMail = $userManager -> getPraticienDetailsForRejectMail($id);

			while ($rows = $getPraticienDetailsForRejectMail -> fetch()) 
			{
				$praticienName = base64_decode($rows['firstname']);
				$praticienEmail = base64_decode($rows['email']);
				$praticienLogin = base64_decode($rows['username']);
			}

			include_once('sendPraticienAccountRejectedMail/sendPraticienAccountRejectedMail.php');
			header('location:index.php?action=accountCreateRequests');	
		}

		function validAccounts()
		{
				$userManager = new userManager();
				$validPraticienAccounts = $userManager -> validPraticienAccounts();
				$numberOfPraticienResults = $validPraticienAccounts -> rowCount();

				$validClientAccounts = $userManager -> validClientAccounts();
				$numberOfClientResults = $validClientAccounts -> rowCount();
				
				include_once('view/validAccounts/validAccounts.php');
		}

		function rejectAccounts()
		{
			$userManager = new userManager();
			$rejectPraticienAccounts = $userManager -> rejectPraticienAccounts();
			$numberOfPraticienResults = $rejectPraticienAccounts -> rowCount();

			$rejectClientAccounts = $userManager -> rejectClientAccounts();
			$numberOfClientResults = $rejectClientAccounts -> rowCount();

			include_once('view/rejectAccounts/rejectAccounts.php');	
		}

		function deleteThisPraticienRejectedAccount($id)
		{
			$userManager = new userManager();
			$deleteThisPraticienRejectedAccount = $userManager -> deleteThisPraticienRejectedAccount($id);
			$numberOfResults = $deleteThisPraticienRejectedAccount -> rowCount();

			$deleteContentPageDesign = $userManager -> deleteContentPageDesign($id);
			$deleteThisPraticienNaturoContentTable = $userManager -> deleteThisPraticienNaturoContentTable($id);
			
			header('location:index.php?action=rejectAccounts');
		}

		function rejectThisPraticienValidAccount($id)
		{
			$userManager = new userManager();
			$rejectThisPraticienValidAccount = $userManager -> rejectThisPraticienValidAccount($id);
			$numberOfResults = $rejectThisPraticienValidAccount -> rowCount();
			include_once('sendPraticienValidateAccountRejectMail/sendPraticienValidateAccountRejectMail.php');
			header('location:index.php?action=validAccounts');
		}

		function rejectThisClientValidAccount($id)
		{
			$userManager = new userManager();
			$rejectThisClientValidAccount = $userManager -> rejectThisClientValidAccount($id);
			$numberOfResults = $rejectThisClientValidAccount -> rowCount();
			header('location:index.php?action=validAccounts');	
		}


		function deleteThisPraticienValidAccount($id)
		{
			$userManager = new userManager();
			$deleteThisPraticienValidAccount = $userManager -> deleteThisPraticienValidAccount($id);
			$numberOfResults = $deleteThisPraticienValidAccount -> rowCount();

			$deleteContentPageDesign = $userManager -> deleteContentPageDesign($id);
			$deleteThisPraticienNaturoContentTable = $userManager -> deleteThisPraticienNaturoContentTable($id);

			header('location:index.php?action=validAccounts');	
		}

		function deleteThisClientValidAccount($id)
		{
			$userManager = new userManager();
			$deleteThisClientValidAccount = $userManager -> deleteThisClientValidAccount($id);
			$numberOfResults = $deleteThisClientValidAccount -> rowCount();
			header('location:index.php?action=validAccounts');	
		}

		function clientList()
		{
			$userManager = new userManager();
			$clientList = $userManager -> clientList();
			$numberOfResults = $clientList -> rowCount();

			$unverifiedclientList = $userManager -> unverifiedclientList();
			$numberOfResults2 = $unverifiedclientList -> rowCount();
			include_once('view/clientList/clientList.php');	
		}

		function subscribers()
		{
			$userManager = new userManager();
			$getSubscribersId = $userManager -> getSubscribersId();
			$numberOfActivationStatus = $getSubscribersId -> rowCount();

			include_once("view/subscribers/subscribers.php");	
		}

		function updateThisPraticiensSubscription($id, $expiryDate)
		{
			$userManager = new userManager();
			$updateThisPraticiensSubscriptionToPurchase = $userManager -> updateThisPraticiensSubscriptionToPurchase($id, $expiryDate);
			
			$updateThisPraticiensSubscriptionToAccount = $userManager -> updateThisPraticiensSubscriptionToAccount($id, $expiryDate);

			header("location:index.php?action=subscribers");	
		}

		function demoUsers()
		{
			$userManager = new userManager();
			$demoUsers = $userManager -> demoUsers();
			$numberOfActivationStatus = $demoUsers -> rowCount();

			include_once("view/demoUsers/demoUsers.php");	
		}

		function praticienRights()
		{
			$userManager = new userManager();
			$praticienRights = $userManager -> praticienRights();
			$numberOfPraticienResults = $praticienRights -> rowCount();

			include_once("view/praticienRights/praticienRights.php");	
		}

		function updateThisPraticienRoles($thisPraticienId, $Naturopathe, $Reflexologue, $Sophrologue, $Medecin, $Chirurgien, $Pharmacien, $Dentiste, $SageFemme, $Veterinaire, $AideSoignant, $AuxiliaireDePuericulture, $Infirmier, $InfirmierDeBlocOperatoire, $InfirmierAnesthesiste, $Podologue, $Kinesitherapeute, $Ergotherapeute, $Orthophoniste, $Psychomotricien, $Dieteticien, $Orthoprothesiste, $Orthoptiste, $Pedicure, $ManipulateurEnElectroradiologieMedicale, $TechnicienDeLaboratoire, $PreparateurEnPharmacie, $Ambulancier, $Psychologue, $Ophtalmologue, $autres)
		{
			
			$userManager = new userManager();
			$updateThisPraticienRoles = $userManager -> updateThisPraticienRoles($thisPraticienId, $Naturopathe, $Reflexologue, $Sophrologue, $Medecin, $Chirurgien, $Pharmacien, $Dentiste, $SageFemme, $Veterinaire, $AideSoignant, $AuxiliaireDePuericulture, $Infirmier, $InfirmierDeBlocOperatoire, $InfirmierAnesthesiste, $Podologue, $Kinesitherapeute, $Ergotherapeute, $Orthophoniste, $Psychomotricien, $Dieteticien, $Orthoprothesiste, $Orthoptiste, $Pedicure, $ManipulateurEnElectroradiologieMedicale, $TechnicienDeLaboratoire, $PreparateurEnPharmacie, $Ambulancier, $Psychologue, $Ophtalmologue, $autres);
		   
		   unset($Naturopathe);
		   unset($Reflexologue);
		   unset($Sophrologue);
		   unset($Medecin);
		   unset($Chirurgien);
		   unset($Pharmacien);
		   unset($Dentiste);
		   unset($SageFemme);
		   unset($Veterinaire);
		   unset($AideSoignant);
		   unset($AuxiliaireDePuericulture);
		   unset($Infirmier);
		   unset($InfirmierDeBlocOperatoire);
		   unset($InfirmierAnesthesiste);
		   unset($Podologue);
		   unset($Kinesitherapeute);
		   unset($Ergotherapeute);
		   unset($Orthophoniste);
		   unset($Psychomotricien);
		   unset($Dieteticien);
		   unset($Orthoprothesiste);
		   unset($Orthoptiste);
		   unset($Pedicure);
		   unset($ManipulateurEnElectroradiologieMedicale);
		   unset($TechnicienDeLaboratoire);
		   unset($PreparateurEnPharmacie);
		   unset($Ambulancier);
		   unset($Psychologue);
		   unset($Ophtalmologue);
		   unset($autres);
		   unset($thisPraticienId);
		   
		   header("location: index.php?action=praticienRights");	
		}

		function updateThisPraticiensTrial($id, $expiryDate)
		{
			$trialUserFirstName = null;
			$trialUserEmail = null;
			
			$userManager = new userManager();
			$updateThisPraticiensTrial = $userManager -> updateThisPraticiensTrial($id, $expiryDate);
			$numberOfActivationStatus = $updateThisPraticiensTrial -> rowCount();

			$getUserDetailsForMailNotification = $userManager -> getUserDetailsForMailNotification($id);
			
			while($rows = $getUserDetailsForMailNotification -> fetch())
			{
				$trialUserFirstName = base64_decode($rows['firstname']);
				$trialUserEmail = base64_decode($rows['email']);
			}

			include_once('controller/sendPraticienTrialPeriodeUpdateMail/sendPraticienTrialPeriodeUpdateMail.php');
			header("location: index.php?action=demoUsers");
		}

		function deleteThisClient($id)
		{
			$userManager = new userManager();
			$deleteThisClient = $userManager -> deleteThisClient($id);
			$numberOfResults = $deleteThisClient -> rowCount();
			header('location:index.php?action=clientList');	
		}

		/*
		function seePraticienProfil()
		{
			$userManager = new userManager();
			$accountCreateRequests = $userManager -> accountCreateRequests();
			
			while ($rows = $accountCreateRequests -> fetch()) 
			{
				echo "Sexe : " . $rows['sexe'] . "<br>";
				echo "nom : " . base64_decode($rows['lastname']) . "<br>";
				echo "prenom : " . base64_decode($rows['firstname']) . "<br>";
				echo "date de naissance : " . $rows['dob'] . "<br>";
				echo "Email : " . base64_decode($rows['email']) . "<br>";
				echo "Nom d'utilisateur : " . base64_decode($rows['username']) . "<br>";
				
				echo "<h3>Addresse</h3>" . "<br>";
				echo "Addresse complet : <br><br> " . $srows['praticienRoadNumber'] . " " . ucwords($rows['praticienRoadName']) . " " . "<br>" . $rows['praticienCodePostal'] . " " . ucfirst($rows['praticienCityName']) . ", " . ucfirst($rows['praticienCountry']) . "<br><br><br>";
				
				echo "<h3>Justificatifs</h3>" . "<br>";
				echo "Numero du document : " . $rows['praticienIdentityNumber'] . "<br>";
				echo "Validite de ce document : " . $rows['praticienIdentityValidity'] . "<br>";
				echo "Piece d'identite : <br>" . "<img src = '../../test 31 praticien/" . $rows['praticienIdentityCard'] . "'/><br><br>";
				echo "Niveau d'etude : " . $rows['praticienEducationQualification'] . "<br>";
				echo "Diplome : <br>" . "<img src = '../../test 31 praticien/" . $rows['praticienDegreeOrCertificat'] . "'/><br><br>";
			}
			include_once('view/accountCreateRequests/accountCreateRequests.php');
		}
		*/
		function backToAdminDashboard()
		{
			header('location:view/adminLogin/dashboard.php');	
		}

		function deleteSelectedMail($id)
		{
			$userManager = new userManager();
			$userManager -> deleteSelectedMail($id);
			header("location:index.php?action=showSentMailsForAdmin");
		}

		function deleteAllMail()
		{
			$userManager = new userManager();
			$userManager -> deleteAllMail();
			header("location:index.php?action=showSentMailsForAdmin");
		}

		function connectionRecords()
		{
			$today = date("d/m/Y");
			$todayDate = date('d');
			$todayMonth = date('m');
			$todayYear = date('Y');


			$userManager = new userManager();
			
			$getBeforeLastDayRecords = $userManager -> getBeforeLastDayRecords($todayDate, $todayMonth, $todayYear);
			$totalBeforeLastDayRecords = $getBeforeLastDayRecords->rowCount();

			$getLastDayRecords = $userManager -> getLastDayRecords($todayDate, $todayMonth, $todayYear);
			$totalLastDayRecords = $getLastDayRecords->rowCount();
			
			$getTodayRecords = $userManager -> getTodayRecords($todayDate, $todayMonth, $todayYear);
			$totalTodayRecords = $getTodayRecords->rowCount();
			
			$getRecordsForLastTwoMonth = $userManager -> getRecordsForLastTwoMonth($todayMonth, $todayYear);
			$totalLastTwoMonthRecords = $getRecordsForLastTwoMonth->rowCount();

			$getRecordsForLastMonth = $userManager -> getRecordsForLastMonth($todayMonth, $todayYear);
			$totalLastMonthRecords = $getRecordsForLastMonth->rowCount();
			
			$getRecordsByMonth = $userManager -> getRecordsByMonth($todayMonth, $todayYear);
			$totalMonthRecords = $getRecordsByMonth->rowCount();
			
			$getRecordsForLastTwoYear = $userManager -> getRecordsForLastTwoYear($todayYear);
			$totalLastTwoYearRecords = $getRecordsForLastTwoYear->rowCount();

			$getRecordsForLastYear = $userManager -> getRecordsForLastYear($todayYear);
			$totalLastYearRecords = $getRecordsForLastYear->rowCount();

			$getRecordsByYear = $userManager -> getRecordsByYear($todayYear);
			$totalYearRecords = $getRecordsByYear->rowCount();
		
			

			$connectionRecords = $userManager -> connectionRecords();
			$numberOfPraticienResults = $connectionRecords->rowCount();
			
			include_once("view/records/records.php");	
		}

		function allConnectionRecords()
		{
			$today = date("d/m/Y");
			$todayDate = date('d');
			$todayMonth = date('m');
			$todayYear = date('Y');


			$userManager = new userManager();

			$allConnectionRecords = $userManager -> allConnectionRecords();
			$numberOfPraticienResults = $allConnectionRecords->rowCount();
			
			include_once("view/records/allConnectionRecords.php");	
		}


		function otherJustifications()
		{
			$userManager = new userManager();
			$otherJustifications = $userManager -> otherJustifications();
			$numberOfJustificationResults = $otherJustifications->rowCount();

			include_once("view/otherJustifications/otherJustifications.php");
		}

		function deleteThisJustificative($id)
		{
			$userManager = new userManager();
			$deleteThisJustificative = $userManager -> deleteThisJustificative($id);

			header("location: index.php?action=otherJustifications");
		}
	}