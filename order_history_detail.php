<?php 
	require "db_connect.php";

	$id = $_POST['id'];
	// var_dump($id);

	$sql= 'SELECT item_order.*, items.name as it_name, items.price as it_price
			FROM item_order 
			INNER JOIN items 
			ON item_order.item_id = items.id
			WHERE order_id = :value1
			ORDER BY created_at DESC';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1', $id);
	$stmt->execute();

	$orderHistoryDetails = $stmt->fetchAll();
	// print'<pre>';
	// print_r($orderHistoryDetails);

	echo json_encode($orderHistoryDetails);




 ?>