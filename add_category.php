<?php 
	require "db_connect.php";


	$name = $_POST["name"];
	$photo = $_FILES["photo"];

	$basepath = "image/category/";
	$fullpath = $basepath.$photo["name"];
	move_uploaded_file($photo["tmp_name"], $fullpath);

	// var_dump($fullpath);
	

	$sql = "INSERT INTO categories(name,logo) VALUES (:value1, :value2)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam('value1',$name);
	$stmt->bindParam('value2',$fullpath);
	$stmt->execute();

	header("location: category_list.php");



 ?>