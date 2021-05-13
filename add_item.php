<?php 
	require "db_connect.php";

	$codeno = $_POST['codeno'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$discount = $_POST['discount'];
	$description = $_POST['description'];
	$brand_id = $_POST['brand_id'];
	$subcategory_id = $_POST['subcategory_id'];
	$photo = $_FILES['photo'];

	$basepath = "image/item/";
	$fullpath = $basepath.$photo['name'];
	move_uploaded_file($photo['tmp_name'], $fullpath);

	$sql = 'INSERT INTO items(codeno,name,photo,price,discount,description,brand_id,subcategory_id) VALUES (:codeno, :name, :photo, :price, :discount, :description, :brand_id, :subcategory_id)';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":codeno", $codeno);
	$stmt->bindParam(":name", $name);
	$stmt->bindParam(":photo", $fullpath);
	$stmt->bindParam(":price", $price);
	$stmt->bindParam(":discount", $discount);
	$stmt->bindParam(":description", $description);
	$stmt->bindParam(":brand_id", $brand_id);
	$stmt->bindParam(":subcategory_id", $subcategory_id);
	$stmt->execute();

	header("location: item_list.php");
	



 ?>