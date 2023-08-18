<?php
	
	require('Manager.php');

	class userManager extends Manager
	{

		public function createAccount($email, $username, $password, $dob)
		{
			$db = $this->dbConnect();
			$createAccount = $db -> prepare('INSERT INTO users(email, username, password, dob) VALUES(?, ?, ?, ?) ');
			$createAccount ->execute(array($email, $username, $password, $dob));
			return $createAccount;
		}

		public function missmatchedPassword()
		{
			header("location:index.php?action=wrongPassword");
		}

		public function login($username, $password)
		{
			$db = $this->dbConnect();
			$loginAccount = $db -> prepare('SELECT * FROM user_admin WHERE username = ? AND password = ? AND status = ? ');
			$loginAccount ->execute(array($username, $password, "administrateur"));
			
			$rows = $loginAccount->fetch(PDO::FETCH_ASSOC);				

			/*
				while($rows = $loginAccount -> fetch())
				{
				}
			*/
			$fromDatabaseId = $rows['id'];
			$fromDatabaseUsername = $rows['username'];
			$fromDatabaseFirstname = $rows['firstname'];
			$fromDatabaseLastname = $rows['lastname'];
			$fromDatabasePassword = $rows['password'];
			$fromDatabaseUserEmail = $rows['email'];
			$fromDatabaseUserStatus = $rows['status'];
			$fromDatabaseDob = $rows['dob'];

			if ($loginAccount)
			{
				if ($username == $fromDatabaseUsername && $password == $fromDatabasePassword) 
				{

					if ($fromDatabaseUserStatus == "administrateur") 
					{
						session_start();
						$_SESSION['sessionStatus'] = "adminOnline" ;
						$_SESSION['userId'] = $fromDatabaseId;
						$_SESSION['userName'] = $fromDatabaseUsername;
						$_SESSION['firstName'] = $fromDatabaseFirstname;
						$_SESSION['lastName'] = $fromDatabaseLastname;
						$_SESSION['userPassword'] = $fromDatabasePassword;
						$_SESSION['userEmail'] = $fromDatabaseUserEmail;
						$_SESSION['userStatus'] = $fromDatabaseUserStatus;
						$_SESSION['userDob'] = $fromDatabaseDob;

						header('location: view/adminLogin/dashboard.php');
					}

					else
					{
						header('location:index.php');
					}
				
				}
				
				else
				{

					header("location:index.php");
				}
			}

			else
			{
				echo "fetch didnt worked for login";
			}
		}

		public function checkEmailAndPasswordForRecovery($email, $dateOfBirth, $code)
		{
			$db = $this->dbConnect();
			$checkForVerification = $db -> prepare('SELECT * FROM user_admin WHERE email = ? AND dob = ? ');
			$checkForVerification ->execute(array($email, $dateOfBirth));
			
			$rows = $checkForVerification->fetch(PDO::FETCH_ASSOC);				
			
			$idFromDb = $rows['id'];
			$emailFromDb = $rows['email'];
			$dobFromDb = $rows['dob'];
			$usernameFromDb = $rows['username'];
		
			if ($checkForVerification -> rowCount() > 0) 
			{

				echo "verification success !" ;

				if ($emailFromDb == $email && $dobFromDb == $dateOfBirth) 
				{
					$inputCode = $db -> prepare('UPDATE user_admin SET code = ? WHERE email = ? AND dob = ?');
					$inputCode ->execute(array($code, $email, $dateOfBirth));				
					include_once('view/sendPassword/sendPassword.php');
					return $inputCode;
				}
				
			
				else
				{
					header("location view/index.php");
				}
			
			}
			
			else
			{
				echo "didnt match with db !" ;
			}	

		}

		public function checkInsertedCode($recoveryEmail, $code)
		{
			$db = $this->dbConnect();
			$checkInsertedCode = $db -> prepare('SELECT * FROM user_admin WHERE email = ?');
			$checkInsertedCode ->execute(array($recoveryEmail));

			$rows = $checkInsertedCode->fetch(PDO::FETCH_ASSOC);	
			$codeFromDb = $rows['code'];

			if ($codeFromDb == $code) 
			{
				header("location:view/resetPassword/resetPassword.php");
			}
		}

		public function resetPassword($recoveryEmail, $password,$retypedPassword)
		{
			$db = $this->dbConnect();
			$resetPassword = $db -> prepare('UPDATE user_admin SET password = ? WHERE email = ?');
			$resetPassword ->execute(array($password, $recoveryEmail));
		}

		public function forgetPassword()
		{
			header("location: view/forgetPassword/forgetPassword.php");
		}

		public function createAccountLink()
		{
			header("location: view/createAccountPage/createAccountPage.php");
		}

		public function forgetIdentification()
		{
			header("location: view/forgetIdentification/forgetIdentification.php");
		}


		public function logout()
		{
			session_start();
			$_SESSION['sessionStatus'] == "offline" ;
			$_SESSION['userId'] = null;
			$_SESSION['userName'] = null;
			$_SESSION['userPassword'] = null;
			$_SESSION['firstName'] = null;
			$_SESSION['lastName'] = null;
			session_unset();
			header("location: view/home/home.php");
		}

		public function goBack()
		{
			header("location: view/index.php");

		}


		public function showSentMailsForAdmin()
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			 if ($_SESSION['sessionStatus'] == "adminOnline")
			 {
				$db = $this->dbConnect();
				$showSentMailsForAdmin = $db -> prepare('SELECT * FROM mails ORDER BY mailTime DESC');
				$showSentMailsForAdmin ->execute(array());
				return $showSentMailsForAdmin;
			 }
		}

		public function accountCreateRequests()
		{
			if (session_status() === PHP_SESSION_NONE)
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline")
			{
				$verificationStatus = "waiting" ;
			   $db = $this->dbConnect();
			   $accountCreateRequests = $db -> prepare('SELECT * FROM user_praticien WHERE verificationStatus = ?');
			   $accountCreateRequests ->execute(array($verificationStatus));
			   return $accountCreateRequests;
			}
		}

		public function validThisPraticienAccountRequest($id)
		{
			if (session_status() === PHP_SESSION_NONE)
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline")
			{

				$today = date("d-m-Y");
			    $thirtyDaysLaterDate = new DateTime($today);
			    $thirtyDaysLaterDate->add(new DateInterval("P30D"));
			    
				$expiryDate = $thirtyDaysLaterDate->format('Y-m-d');
	     		
	     		$activationStatus = "trial";
			   	$verificationStatus = "confirmed" ;
			   	$db = $this->dbConnect();
			   	$validThisPraticienAccountRequest = $db -> prepare('UPDATE user_praticien SET verificationStatus = ?, activationStatus = ?, expiryDate = ? WHERE id = ?');
			   $validThisPraticienAccountRequest ->execute(array($verificationStatus, $activationStatus, $expiryDate, $id));
			   return $validThisPraticienAccountRequest;
				
			}
		}

		public function contentPageDesign($id)
		{
			$db = $this->dbConnect();
		   	$contentPageDesign = $db -> prepare('INSERT INTO  contentPageDesign (praticienId) VALUES(?)');
		   	$contentPageDesign ->execute(array($id));
		   	return $contentPageDesign;
		}

		public function createThisPraticienNaturoContentTable($id)
		{
			$db = $this->dbConnect();
		   	$createThisPraticienNaturoContentTable = $db -> prepare('INSERT INTO  mynaturoprogramcontent (praticienId) VALUES(?)');
		   	$createThisPraticienNaturoContentTable ->execute(array($id));
		   	
		   	return $createThisPraticienNaturoContentTable;
		}

		public function getPraticienDetailsForConfirmationMail($id)
		{
			$db = $this->dbConnect();
		   	$getPraticienDetailsForConfirmationMail = $db -> prepare('SELECT * FROM user_praticien WHERE id = ?');
		   	$getPraticienDetailsForConfirmationMail ->execute(array($id));
		   	
		   	return $getPraticienDetailsForConfirmationMail;
		}

		public function validThisClientAccountRequest($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
	     		
			   	$verificationStatus = "confirmed" ;
			   	$db = $this->dbConnect();
			   	$validThisClientAccountRequest = $db -> prepare('UPDATE user_client SET verificationStatus = ? WHERE id = ?');
			   $validThisClientAccountRequest ->execute(array($verificationStatus, $id));
			   return $validThisClientAccountRequest;
				
			}
		}

		public function deleteThisClientRejectedAccount($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
			   $db = $this->dbConnect();
			   $deleteThisClientRejectedAccount = $db -> prepare('DELETE FROM user_client WHERE id = ?');
			   $deleteThisClientRejectedAccount ->execute(array($id));
			   return $deleteThisClientRejectedAccount;
			}
		}	

		public function deleteThisClientAllConnections($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
			   $db = $this->dbConnect();
			   $deleteThisClientAllConnections = $db -> prepare('DELETE FROM myconnections WHERE clientId = ?');
			   $deleteThisClientAllConnections ->execute(array($id));
			   return $deleteThisClientAllConnections;
			}
		}

		public function rejectThisPraticienAccountRequest($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
			   $verificationStatus = "rejected" ;
			   $db = $this->dbConnect();
			   $rejectThisPraticienAccountRequest = $db -> prepare('UPDATE user_praticien SET verificationStatus = ? WHERE id = ?');
			   $rejectThisPraticienAccountRequest ->execute(array($verificationStatus, $id));
			   return $rejectThisPraticienAccountRequest;
			}
		}

		public function getPraticienDetailsForRejectMail($id)
		{
			$db = $this->dbConnect();
		   	$getPraticienDetailsForRejectMail = $db -> prepare('SELECT * FROM user_praticien WHERE id = ?');
		   	$getPraticienDetailsForRejectMail ->execute(array($id));
		   	
		   	return $getPraticienDetailsForRejectMail;
		}		

		public function validPraticienAccounts()
		{
			   $verificationStatus = "confirmed" ;
			   $db = $this->dbConnect();
			   $validPraticienAccounts = $db -> prepare('SELECT * FROM user_praticien WHERE verificationStatus = ?');
			   $validPraticienAccounts ->execute(array($verificationStatus));
			   return $validPraticienAccounts;
		}

		public function validClientAccounts()
		{
			   $verificationStatus = "confirmed" ;
			   $db = $this->dbConnect();
			   $validClientAccounts = $db -> prepare('SELECT * FROM user_client WHERE verificationStatus = ?');
			   $validClientAccounts ->execute(array($verificationStatus));
			   return $validClientAccounts;
		}			


		public function rejectPraticienAccounts()
		{
			   $verificationStatus = "rejected" ;
			   $db = $this->dbConnect();
			   $rejectPraticienAccounts = $db -> prepare('SELECT * FROM user_praticien WHERE verificationStatus = ?');
			   $rejectPraticienAccounts ->execute(array($verificationStatus));
			   return $rejectPraticienAccounts;
		}

		public function rejectClientAccounts()
		{
			   $verificationStatus = "rejected" ;
			   $db = $this->dbConnect();
			   $rejectClientAccounts = $db -> prepare('SELECT * FROM user_client WHERE verificationStatus = ?');
			   $rejectClientAccounts ->execute(array($verificationStatus));
			   return $rejectClientAccounts;
		}

		public function deleteThisPraticienRejectedAccount($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
			   $db = $this->dbConnect();
			   $deleteThisPraticienRejectedAccount = $db -> prepare('DELETE FROM user_praticien WHERE id = ?');
			   $deleteThisPraticienRejectedAccount ->execute(array($id));
			   return $deleteThisPraticienRejectedAccount;
			}
		}	

		public function rejectThisPraticienValidAccount($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
				$verificationStatus = "rejected";
			   $db = $this->dbConnect();
			   $rejectThisPraticienValidAccount = $db -> prepare('UPDATE user_praticien SET verificationStatus = ? WHERE id = ?');
			   $rejectThisPraticienValidAccount ->execute(array($verificationStatus, $id));
			   return $rejectThisPraticienValidAccount;
			}
		}

		public function rejectThisClientValidAccount($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
				$verificationStatus = "rejected";
			   $db = $this->dbConnect();
			   $rejectThisClientValidAccount = $db -> prepare('UPDATE user_client SET verificationStatus = ? WHERE id = ?');
			   $rejectThisClientValidAccount ->execute(array($verificationStatus, $id));
			   return $rejectThisClientValidAccount;
			}
		}

		public function deleteThisPraticienValidAccount($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
			   $db = $this->dbConnect();
			   $deleteThisPraticienValidAccount = $db -> prepare('DELETE FROM user_praticien WHERE id = ?');
			   $deleteThisPraticienValidAccount ->execute(array($id));
			   return $deleteThisPraticienValidAccount;
			}
		}

		public function deleteContentPageDesign($id)
		{
			$db = $this->dbConnect();
		   	$deleteContentPageDesign = $db -> prepare('DELETE FROM contentPageDesign WHERE praticienId = ?');
		   	$deleteContentPageDesign ->execute(array($id));
		   	return $deleteContentPageDesign;
		}

		public function deleteThisPraticienNaturoContentTable($id)
		{
			$db = $this->dbConnect();
		   	$deleteThisPraticienNaturoContentTable = $db -> prepare('DELETE FROM mynaturoprogramcontent WHERE praticienId = ?');
		   	$deleteThisPraticienNaturoContentTable ->execute(array($id));
		   	return $deleteThisPraticienNaturoContentTable;
		}

		public function deleteThisClientValidAccount($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
			   $db = $this->dbConnect();
			   $deleteThisValidAccount = $db -> prepare('DELETE FROM user_client WHERE id = ?');
			   $deleteThisValidAccount ->execute(array($id));
			   return $deleteThisValidAccount;
			}
		}

		public function clientList()
		{
			   $verificationStatus = "confirmed";			
			   $db = $this->dbConnect();
			   $clientList = $db -> prepare('SELECT * FROM user_client WHERE verificationStatus = ?');
			   $clientList -> execute(array($verificationStatus));
			   return $clientList;
			   
			   
			   //$status = "client";
			   //$clientList = $db -> prepare('SELECT * FROM user_client WHERE status = ?');
		}	

		public function unverifiedclientList()
		{
			   $userVerificationStatus = "unverified";			
			   $db = $this->dbConnect();
			   $unverifiedclientList = $db -> prepare('SELECT * FROM user_client WHERE userVerification = ?');
			   $unverifiedclientList -> execute(array($userVerificationStatus));
			   return $unverifiedclientList;
			   
			   
			   //$status = "client";
			   //$clientList = $db -> prepare('SELECT * FROM user_client WHERE status = ?');
		}	

		public function getSubscribersId()
		{
		   $status = "active";
		   $db = $this->dbConnect();
		   $getSubscribersId = $db -> prepare('SELECT * FROM user_praticien WHERE activationStatus = ?');
		   $getSubscribersId -> execute(array($status));
		   return $getSubscribersId;
		}	

		public function getSubscribersSubscriptions($subscriberId)
		{
		   $status = "active";
		   $db = $this->dbConnect();
		   $getSubscribersSubscriptions = $db -> prepare('SELECT * FROM purchase WHERE praticienId = ?');
		   $getSubscribersSubscriptions -> execute(array($subscriberId));
		   return $getSubscribersSubscriptions;
		}

		public function updateThisPraticiensSubscriptionToPurchase($id, $expiryDate)
		{
		   $db = $this->dbConnect();
		   $updateThisPraticiensSubscriptionToPurchase = $db -> prepare('UPDATE purchase SET expiryDate = ? WHERE praticienId = ?');
		   $updateThisPraticiensSubscriptionToPurchase -> execute(array($expiryDate, $id));
		   return $updateThisPraticiensSubscriptionToPurchase;
		}

		public function updateThisPraticiensSubscriptionToAccount($id, $expiryDate)
		{
		   $db = $this->dbConnect();
		   $updateThisPraticiensSubscriptionToAccount = $db -> prepare('UPDATE user_praticien SET expiryDate = ? WHERE id = ?');
		   $updateThisPraticiensSubscriptionToAccount -> execute(array($expiryDate, $id));
		   return $updateThisPraticiensSubscriptionToAccount;
		}

		public function demoUsers()
		{
		   $activationStatus = "trial";
		   $verificationStatus = "confirmed";
		   $db = $this->dbConnect();
		   $demoUsers = $db -> prepare('SELECT * FROM user_praticien WHERE activationStatus = ? AND verificationStatus = ?');
		   $demoUsers -> execute(array($activationStatus, $verificationStatus));
		   return $demoUsers;
		}

		public function praticienRights()
		{
		   $verificationStatus = "confirmed" ;
		   $db = $this->dbConnect();
		   $praticienRights = $db -> prepare('SELECT * FROM user_praticien WHERE verificationStatus = ?');
		   $praticienRights ->execute(array($verificationStatus));
		   return $praticienRights;
		}

		public function updateThisPraticienRoles($thisPraticienId, $Naturopathe, $Reflexologue, $Sophrologue, $Medecin, $Chirurgien, $Pharmacien, $Dentiste, $SageFemme, $Veterinaire, $AideSoignant, $AuxiliaireDePuericulture, $Infirmier, $InfirmierDeBlocOperatoire, $InfirmierAnesthesiste, $Podologue, $Kinesitherapeute, $Ergotherapeute, $Orthophoniste, $Psychomotricien, $Dieteticien, $Orthoprothesiste, $Orthoptiste, $Pedicure, $ManipulateurEnElectroradiologieMedicale, $TechnicienDeLaboratoire, $PreparateurEnPharmacie, $Ambulancier, $Psychologue, $Ophtalmologue, $autres)
		{
		   $db = $this->dbConnect();
		   $updateThisPraticienRoles = $db -> prepare('UPDATE user_praticien SET Naturopathe = ?, Reflexologue = ?, Sophrologue = ?, Medecin = ?, Chirurgien = ?, Pharmacien = ?, Dentiste = ?, SageFemme = ?, Veterinaire = ?, AideSoignant = ?, AuxiliaireDePuericulture = ?, Infirmier = ?, InfirmierDeBlocOperatoire = ?, InfirmierAnesthesiste = ?, Podologue = ?, Kinesitherapeute = ?, Ergotherapeute = ?, Orthophoniste = ?, Psychomotricien = ?, Dieteticien = ?, Orthoprothesiste = ?, Orthoptiste = ?, Pedicure = ?, ManipulateurEnElectroradiologieMedicale = ?, TechnicienDeLaboratoire = ?, PreparateurEnPharmacie = ?, Ambulancier = ?, Psychologue = ?, Ophtalmologue = ?, autres = ? WHERE id = ?');
		   
		   $updateThisPraticienRoles ->execute(array($Naturopathe, $Reflexologue, $Sophrologue, $Medecin, $Chirurgien, $Pharmacien, $Dentiste, $SageFemme, $Veterinaire, $AideSoignant, $AuxiliaireDePuericulture, $Infirmier, $InfirmierDeBlocOperatoire, $InfirmierAnesthesiste, $Podologue, $Kinesitherapeute, $Ergotherapeute, $Orthophoniste, $Psychomotricien, $Dieteticien, $Orthoprothesiste, $Orthoptiste, $Pedicure, $ManipulateurEnElectroradiologieMedicale, $TechnicienDeLaboratoire, $PreparateurEnPharmacie, $Ambulancier, $Psychologue, $Ophtalmologue, $autres, $thisPraticienId));
		   return $updateThisPraticienRoles;
		}

		public function updateThisPraticiensTrial($id, $expiryDate)
		{
		   $db = $this->dbConnect();
		   $updateThisPraticiensTrial = $db -> prepare('UPDATE user_praticien SET expiryDate = ? WHERE id = ?');
		   $updateThisPraticiensTrial -> execute(array($expiryDate, $id));
		   return $updateThisPraticiensTrial;
		}

		public function getUserDetailsForMailNotification($id)
		{
		   $db = $this->dbConnect();
		   $getUserDetailsForMailNotification = $db -> prepare('SELECT * FROM user_praticien WHERE id = ?');
		   $getUserDetailsForMailNotification -> execute(array($id));
		   return $getUserDetailsForMailNotification;
		}

		public function deleteThisClient($id)
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
				$status = "client";
			   $db = $this->dbConnect();
			   $clientList = $db -> prepare('DELETE FROM user_client WHERE id = ?');
			   $clientList -> execute(array($id));
			   return $clientList;
			}
		}

		public function deleteSelectedMail()
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			 if ($_SESSION['sessionStatus'] == "adminOnline") 
			 {
				$db = $this->dbConnect();
				$deleteSelectedMail = $db -> prepare('DELETE FROM mails WHERE id = ?');
				$deleteSelectedMail ->execute(array($id));
			 }

			 else
			 {
			 	header("location: index.php");
			 }
		}

		public function deleteAllMail()
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			 if ($_SESSION['sessionStatus'] == "adminOnline") 
			 {
				$db = $this->dbConnect();
				$deleteAllMail = $db -> prepare('DELETE FROM clientemails');
				$deleteAllMail ->execute(array());	
			 }

			 else
			 {
			 	header("location: index.php");
			 }
		}

		public function connectionRecords()
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
				$db = $this->dbConnect();
				$connectionRecords = $db -> prepare('SELECT DISTINCT praticienId FROM records');
				$connectionRecords ->execute(array());	
				return $connectionRecords;
			}

			else
			{
				header("location: index.php");
			}
		}

		public function allConnectionRecords()
		{
			if (session_status() === PHP_SESSION_NONE) 
			{
    			session_start();
			}

			if ($_SESSION['sessionStatus'] == "adminOnline") 
			{
				$db = $this->dbConnect();
				$allConnectionRecords = $db -> prepare('SELECT * FROM records ORDER BY id');
				$allConnectionRecords ->execute(array());	
				return $allConnectionRecords;
			}

			else
			{
				header("location: index.php");
			}
		}

		public function getThisPraticienLastRecords($praticienId)
		{
				$db = $this->dbConnect();
				$getThisPraticienLastRecords = $db -> prepare('SELECT * FROM records WHERE praticienId = ? ORDER BY lastConnectionTime DESC LIMIT 1');
				$getThisPraticienLastRecords ->execute(array($praticienId));	
				return $getThisPraticienLastRecords;
		}

		public function getThisPraticienTotalInformationForRecords($praticienId)
		{
			
				$db = $this->dbConnect();
				$getThisPraticienTotalInformationForRecords = $db -> prepare('SELECT * FROM user_praticien WHERE id = ?');
				$getThisPraticienTotalInformationForRecords ->execute(array($praticienId));	
				return $getThisPraticienTotalInformationForRecords;
		}

		public function getThisPraticienTotalRecords($praticienId)
		{
			
				$db = $this->dbConnect();
				$getThisPraticienTotalRecords = $db -> prepare('SELECT * FROM records WHERE praticienId = ? ORDER BY lastConnectionTime DESC');
				$getThisPraticienTotalRecords ->execute(array($praticienId));	
				return $getThisPraticienTotalRecords;
		}

		public function getBeforeLastDayRecords($todayDate, $todayMonth, $todayYear)
		{
			$beforeLastDay = $todayDate-2;
			$db = $this->dbConnect();
			$getBeforeLastDayRecords = $db -> prepare('SELECT id, DAY(lastConnectionTime) AS todayRecords FROM records WHERE DAY(lastConnectionTime) = ? AND MONTH(lastConnectionTime) = ? AND YEAR(lastConnectionTime) = ?');
			$getBeforeLastDayRecords ->execute(array($beforeLastDay, $todayMonth, $todayYear));	
			return $getBeforeLastDayRecords;
		}

		public function getLastDayRecords($todayDate, $todayMonth, $todayYear)
		{
			$lastDay = $todayDate-1;
			$db = $this->dbConnect();
			$getLastDayRecords = $db -> prepare('SELECT id, DAY(lastConnectionTime) AS todayRecords FROM records WHERE DAY(lastConnectionTime) = ? AND MONTH(lastConnectionTime) = ? AND YEAR(lastConnectionTime) = ?');
			$getLastDayRecords ->execute(array($lastDay, $todayMonth, $todayYear));	
			return $getLastDayRecords;
		}

		public function getTodayRecords($todayDate, $todayMonth, $todayYear)
		{
			$db = $this->dbConnect();
			$getTodayRecords = $db -> prepare('SELECT id, DAY(lastConnectionTime) AS todayRecords FROM records WHERE DAY(lastConnectionTime) = ? AND MONTH(lastConnectionTime) = ? AND YEAR(lastConnectionTime) = ?');
			$getTodayRecords ->execute(array($todayDate, $todayMonth, $todayYear));	
			return $getTodayRecords;
		}

		public function getRecordsByMonth($todayMonth, $todayYear)
		{
			$db = $this->dbConnect();
			$getRecordsByMonth = $db -> prepare('SELECT id, MONTH(lastConnectionTime) AS recordMonth FROM records WHERE MONTH(lastConnectionTime) = ? AND YEAR(lastConnectionTime) = ?');
			$getRecordsByMonth ->execute(array($todayMonth, $todayYear));	
			return $getRecordsByMonth;
		}

		public function getRecordsForLastTwoMonth($todayMonth, $todayYear)
		{
			$lastTwoMonth = $todayMonth-2;
			$db = $this->dbConnect();
			$getRecordsForLastTwoMonth = $db -> prepare('SELECT id, MONTH(lastConnectionTime) AS recordLastMonth FROM records WHERE MONTH(lastConnectionTime) = ? AND YEAR(lastConnectionTime) = ?');
			$getRecordsForLastTwoMonth ->execute(array($lastTwoMonth, $todayYear));	
			return $getRecordsForLastTwoMonth;
		}

		public function getRecordsForLastMonth($todayMonth, $todayYear)
		{
			$lastMonth = $todayMonth-1;
			$db = $this->dbConnect();
			$getRecordsForLastMonth = $db -> prepare('SELECT id, MONTH(lastConnectionTime) AS recordLastMonth FROM records WHERE MONTH(lastConnectionTime) = ? AND YEAR(lastConnectionTime) = ?');
			$getRecordsForLastMonth ->execute(array($lastMonth, $todayYear));	
			return $getRecordsForLastMonth;
		}

		public function getRecordsForLastTwoYear($todayYear)
		{
			$lastTwoYear = $todayYear-2;
			$db = $this->dbConnect();
			$getRecordsForLastYear = $db -> prepare('SELECT id, YEAR(lastConnectionTime) AS recordYear FROM records WHERE YEAR(lastConnectionTime) = ?');
			$getRecordsForLastYear ->execute(array($lastTwoYear));
			return $getRecordsForLastYear;
		}

		public function getRecordsForLastYear($todayYear)
		{
			$lastYear = $todayYear-1;
			$db = $this->dbConnect();
			$getRecordsForLastYear = $db -> prepare('SELECT id, YEAR(lastConnectionTime) AS recordYear FROM records WHERE YEAR(lastConnectionTime) = ?');
			$getRecordsForLastYear ->execute(array($lastYear));
			return $getRecordsForLastYear;
		}

		public function getRecordsByYear($todayYear)
		{
			$db = $this->dbConnect();
			$getRecordsByYear = $db -> prepare('SELECT id, YEAR(lastConnectionTime) AS recordYear FROM records WHERE YEAR(lastConnectionTime) = ?');
			$getRecordsByYear ->execute(array($todayYear));
			return $getRecordsByYear;
		}

		public function otherJustifications()
		{
			$db = $this -> dbConnect();
			$otherJustifications = $db-> prepare('SELECT * FROM otherCabinetJustifications');
			$otherJustifications -> execute(array());
			return $otherJustifications;
		}

		public function deleteThisJustificative($id)
		{
			$db = $this -> dbConnect();
			$deleteThisJustificative = $db-> prepare('DELETE FROM otherCabinetJustifications WHERE id = ?');
			$deleteThisJustificative -> execute(array($id));
			return $deleteThisJustificative;
		}

		public function getThisPraticienDetails($praticienId)
		{
			$db = $this->dbConnect();
			$getThisPraticienDetails = $db -> prepare('SELECT * FROM user_praticien WHERE id = ?');
			$getThisPraticienDetails -> execute(array($praticienId));
			return $getThisPraticienDetails;
		}

		public function test($username, $password)
		{
			$db = $this->dbConnect();
			$check = $db -> prepare('INSERT INTO users(username, password) VALUES(?, ?) ');
			$check ->execute(array($username, $password));
			return $check;
		}

		public function emailCheck($email)
		{
			$db = $this->dbConnect();
			$check = $db -> prepare('SELECT email FROM users WHERE email = ?');
			$check ->execute(array($email));
			return $check;
		}

		public function updateAccount($userId, $username, $email, $dob, $password, $retypedPassword)
		{
			$db = $this -> dbConnect();
			$updateAccount = $db -> prepare('UPDATE user_admin SET username = ?, email = ?, dob = ?, password = ? WHERE id = ? ');
			$updateAccount -> execute(array($username, $email, $dob, $password, $userId));
			return $updateAccount;
		}
		


	}
?>