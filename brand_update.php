<?php 
	require "db_connect.php";

	$id = $_POST['id'];
	$name = $_POST['name'];
	$oldphoto = $_POST['oldphoto'];
	$newphoto = $_FILES['newphoto'];

	if ($newphoto['size']>0) {
		$basepath = 'image/logo/';
		$fullpath = $basepath.$newphoto['name'];
		move_uploaded_file($newphoto['tmp_name'], $fullpath);
	}else{
		$fullpath = $oldphoto;
	}

	$sql = 'UPDATE brands SET name=:name, photo=:photo WHERE id=:id';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':photo',$fullpath);
	$stmt->execute();

	header("location:brand_list.php");


 ?>