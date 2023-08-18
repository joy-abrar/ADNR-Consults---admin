<?php 
	class Manager 
	{ 
		protected function dbConnect() 
		{ 
			$host_name = 'localhost'; 
			$database = 'projet1'; 
			$user_name = 'root'; 
			$password = '';
			$db = null; 
			try 
			{ 
				$db = new PDO("mysql:host=$host_name; dbname=$database", $user_name, $password);
				return $db; 
			} 
			catch (PDOException $e) 
			{ 
				echo "Erreur!: " . $e->getMessage() . "<br/>"; 
				die(); 
			} 
		} 
	}

?>