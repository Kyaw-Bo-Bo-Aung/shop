<?php 
	require "db_connect.php";
	$id = $_POST['id'];

	$sql = 'DELETE FROM subcategories WHERE id=:id';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":id", $id);
	$stmt->execute();

	header("location:subcategory_list.php");

 ?>