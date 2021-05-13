<?php 
	require "db_connect.php";

	$id = $_POST['id'];

	$logo = "SELECT photo FROM items WHERE id = :val";
	$logostmt = $conn->prepare($logo);
	$logostmt->bindParam("val", $id);
	$logostmt->execute();
	$logo = $logostmt->fetch(PDO::FETCH_ASSOC);
	unlink($logo['photo']);

	$sql = "DELETE FROM items WHERE id=:id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":id",$id);
	$stmt->execute();

	header("location: item_list.php");
 ?>