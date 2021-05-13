<?php 
	require "db_connect.php";

	$id = $_POST['id'];

	$logo = "SELECT logo FROM categories WHERE id = :val";
	$logostmt = $conn->prepare($logo);
	$logostmt->bindParam("val", $id);
	$logostmt->execute();
	$logo = $logostmt->fetch(PDO::FETCH_ASSOC);
	unlink($logo['logo']);

	$sql = "DELETE FROM categories WHERE id=:id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":id",$id);
	$stmt->execute();



	header("location: category_list.php");
 ?>