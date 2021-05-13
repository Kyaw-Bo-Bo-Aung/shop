<?php 
	$servername = "localhost";
	$dbname = "mic_project";

	$user = "root";
	$password = "";

	$dsn = "mysql:host=$servername; dbname=$dbname";

	$pdo = new PDO ($dsn, $user, $password);

	try{
		$conn = $pdo;

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// echo "connected successfully.";
	}catch(PDOExcetption $e){
		echo "conncetion fail".$e->getMessage();
	};


 ?>