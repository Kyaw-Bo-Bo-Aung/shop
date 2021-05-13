<?php 
	session_start();
	require "db_connect.php";

	$carts = $_POST['cart'];
	$note = $_POST['note'];
	$total = $_POST['total'];

	// print "<pre>";
	// print_r($total);

	date_default_timezone_set("Asia/Rangoon");

	//voucher
	$voucherno = strtotime(date("h:i:s"));

	// orederdate
	$orderdate = date("Y-m-d");

	// userid
	$user_id = $_SESSION['login_user']['id'];

	// status
	$status = "order";

	

		$sql = "INSERT INTO orders(orderdate,voucherno,total,note,status,user_id) VALUES (:orderdate,:voucherno,:total,:note,:status,:user_id)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':orderdate',$orderdate);
		$stmt->bindParam(':voucherno',$voucherno);
		$stmt->bindParam(':total',$total);
		$stmt->bindParam(':note',$note);
		$stmt->bindParam(':status',$status);
		$stmt->bindParam(':user_id',$user_id);
		$stmt->execute();

		$order_id = $conn->lastInsertId();

		foreach ($carts as $cart) {
		$item_id = $cart['id'];
		$qty = $cart['qty'];

		// var_dump(getType $order_id);

		$sql = "INSERT INTO item_order(qty, item_id, order_id) VALUES (:qty, :item_id, :order_id)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':qty', $qty);
		$stmt->bindParam(':item_id', $item_id);
		$stmt->bindParam(':order_id', $order_id);
		$stmt->execute();




	}
 ?>