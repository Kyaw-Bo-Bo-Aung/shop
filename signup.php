<?php 
	require "db_connect.php";
	session_start();

	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$address = $_POST['address'];
	
	$role = 2;

	$sql = "INSERT INTO users (name, phone, email, password, address) VALUES (:name, :phone, :email, :password, :address)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":name", $name);
	$stmt->bindParam(":phone", $phone);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":password", $password);
	$stmt->bindParam(":address", $address);
	$stmt->execute();

	$userid = $conn->lastInsertId();

	$sql = "INSERT INTO model_has_roles (user_id, role_id) VALUES (:user_id, :role_id)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":user_id", $userid);
	$stmt->bindParam(":role_id", $role);
	$stmt->execute();


	$_SESSION["regsuccess"] = 'Yes, it is not easy, but you did it! Please sign in again.';
	header('location: login.php');




 ?>