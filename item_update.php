<?php 
	require "db_connect.php";
	$id = $_POST['id'];
	$codeno = $_POST['codeno'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$discount = $_POST['discount'];
	$description = $_POST['description'];
	$brand_id = $_POST['brand_id'];
	$subcategory_id = $_POST['subcategory_id'];
	$oldphoto = $_POST['oldphoto'];
	$newphoto = $_FILES['newphoto'];

	if ($newphoto['size']>0) {
		$basepath = "image/item/";
		$fullpath = $basepath.$newphoto['name'];
		move_uploaded_file($newphoto['tmp_name'], $fullpath);
	}else{
		$fullpath = $oldphoto;
	}

	

	$sql = "UPDATE items SET codeno=:codeno, name=:name, photo=:photo, price=:price, discount=:discount, description=:description, brand_id=:brand_id, subcategory_id=:subcategory_id WHERE id=:id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':id',$id);
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