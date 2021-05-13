<?php 
	require "db_connect.php";

	$id = $_POST['id'];

	$logo = "SELECT photo FROM brands WHERE id = :val";
	$logostmt = $conn->prepare($logo);
	$logostmt->bindParam("val", $id);
	$logostmt->execute();
	$photo = $logostmt->fetch(PDO::FETCH_ASSOC);
	unlink($photo['photo']);
	

	$sql = 'DELETE FROM brands WHERE id=:id';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":id",$id);
	$stmt->execute();

	header('location:brand_list.php');
 ?>