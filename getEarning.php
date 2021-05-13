<?php 
	require "db_connect.php";

	// januaray
	$janFirst = strtotime("first day of januaray");
	$janLast = strtotime("last day of januaray");

	$janStart = date('Y-m-d', $janFirst);
	$janEnd = date('Y-m-d', $janLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $janStart);
	$stmt->bindParam("value2", $janEnd);
	$stmt->execute();
	$janResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($janResult);

	// february
	$febFirst = strtotime("first day of february");
	$febLast = strtotime("last day of february");

	$febStart = date('Y-m-d', $febFirst);
	$febEnd = date('Y-m-d', $febLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $febStart);
	$stmt->bindParam("value2", $febEnd);
	$stmt->execute();
	$febResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($febResult);

	// march
	$marFirst = strtotime("first day of march");
	$marLast = strtotime("last day of march");

	$marStart = date('Y-m-d', $marFirst);
	$marEnd = date('Y-m-d', $marLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $marStart);
	$stmt->bindParam("value2", $marEnd);
	$stmt->execute();
	$marResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($marResult);

	// april
	$aprFirst = strtotime("first day of april");
	$aprLast = strtotime("last day of april");

	$aprStart = date('Y-m-d', $aprFirst);
	$aprEnd = date('Y-m-d', $aprLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $aprStart);
	$stmt->bindParam("value2", $aprEnd);
	$stmt->execute();
	$aprResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($aprResult);

	// may
	$mayFirst = strtotime("first day of may");
	$mayLast = strtotime("last day of may");

	$mayStart = date('Y-m-d', $mayFirst);
	$mayEnd = date('Y-m-d', $mayLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $mayStart);
	$stmt->bindParam("value2", $mayEnd);
	$stmt->execute();
	$mayResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($mayResult);

	// june
	$junFirst = strtotime("first day of june");
	$junLast = strtotime("last day of june");

	$junStart = date('Y-m-d', $junFirst);
	$junEnd = date('Y-m-d', $junLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $junStart);
	$stmt->bindParam("value2", $junEnd);
	$stmt->execute();
	$junResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($junResult);

	// july
	$julFirst = strtotime("first day of july");
	$julLast = strtotime("last day of july");

	$julStart = date('Y-m-d', $julFirst);
	$julEnd = date('Y-m-d', $julLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $julStart);
	$stmt->bindParam("value2", $julEnd);
	$stmt->execute();
	$julResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($julResult);

	// august
	$augFirst = strtotime("first day of august");
	$augLast = strtotime("last day of august");

	$augStart = date('Y-m-d', $augFirst);
	$augEnd = date('Y-m-d', $augLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $augStart);
	$stmt->bindParam("value2", $augEnd);
	$stmt->execute();
	$augResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($augResult);

	// september
	$sepFirst = strtotime("first day of september");
	$sepLast = strtotime("last day of september");

	$sepStart = date('Y-m-d', $sepFirst);
	$sepEnd = date('Y-m-d', $sepLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $sepStart);
	$stmt->bindParam("value2", $sepEnd);
	$stmt->execute();
	$sepResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($sepResult);

	// october
	$octFirst = strtotime("first day of october");
	$octLast = strtotime("last day of october");

	$octStart = date('Y-m-d', $octFirst);
	$octEnd = date('Y-m-d', $octLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $octStart);
	$stmt->bindParam("value2", $octEnd);
	$stmt->execute();
	$octResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($octResult);

	// november
	$novFirst = strtotime("first day of november");
	$novLast = strtotime("last day of november");

	$novStart = date('Y-m-d', $novFirst);
	$novEnd = date('Y-m-d', $novLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $novStart);
	$stmt->bindParam("value2", $novEnd);
	$stmt->execute();
	$novResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($novResult);

	// december
	$decFirst = strtotime("first day of december");
	$decLast = strtotime("last day of december");

	$decStart = date('Y-m-d', $decFirst);
	$decEnd = date('Y-m-d', $decLast);

	$sql = 'SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam("value1", $decStart);
	$stmt->bindParam("value2", $decEnd);
	$stmt->execute();
	$decResult = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($decResult);

	$total= array(
		$janResult['total'],
		$febResult['total'],
		$marResult['total'],
		$aprResult['total'],
		$mayResult['total'],
		$junResult['total'],
		$julResult['total'],
		$augResult['total'],
		$sepResult['total'],
		$octResult['total'],
		$novResult['total'],
		$decResult['total'],
	);

	echo json_encode($total);

 ?>