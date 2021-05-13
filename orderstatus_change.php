<?php 
	require "db_connect.php";
	$id = $_GET['id'];

	if ($_GET['status']==0) {
		$status = "confirm";
	}else{
		$status = "delete";
	}

	$sql = 'UPDATE orders SET status=:status WHERE id=:id';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':status', $status);
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	header("location: order_list.php");




 ?>