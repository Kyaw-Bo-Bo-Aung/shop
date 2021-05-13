<?php 
	require "db_connect.php";

	$id = $_POST['id'];
	$name = $_POST['name'];

	$sql = "UPDATE subcategories SET name=:name WHERE id=:id";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":name",$name);
	$stmt->bindParam(":id",$id);
	$stmt->execute();

	header("location: subcategory_list.php");
 ?>