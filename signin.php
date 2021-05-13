<?php 
	require "db_connect.php";
	session_start();

	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT users.*, model_has_roles.role_id, roles.name as rolename
			FROM users
			INNER JOIN model_has_roles
			ON users.id=model_has_roles.user_id
			INNER JOIN roles
			ON model_has_roles.role_id=roles.id
			WHERE email=:email AND password=:password";

		$stmt=$conn->prepare($sql);
		$stmt->bindParam(":email",$email);
		$stmt->bindParam(":password",$password);
		$stmt->execute();

	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	// print"<pre>";
	// print_r($user);
	// die();

	if ($stmt->rowCount() <= 0) {
		$_SESSION["loginfail"]='Your current email and password is invalid.';
		header("location:login.php");
	}else{
		$_SESSION['login_user']=$user;
		if ($user['rolename'] == "admin"){
			header("location: category_list.php");
		}else{
			header("location:index.php");
		}
	}



 ?>