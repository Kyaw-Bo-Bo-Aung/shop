<?php 
	require "db_connect.php";

	$id = $_POST['id'];
	$name = $_POST['name'];
	$oldphoto = $_POST['oldphoto'];
	$newphoto = $_FILES['newphoto'];

	if ($newphoto['size']>0) {
		$basepath = 'image/category/';
		$fullpath = $basepath.$newphoto["name"];
		move_uploaded_file($newphoto['tmp_name'], $fullpath);
	}else{
		$fullpath= $oldphoto;
	}

	$sql = "UPDATE categories SET name=:name, logo=:logo WHERE id=:id";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":name",$name);
	$stmt->bindParam(":logo",$fullpath);
	$stmt->bindParam(":id",$id);
	$stmt->execute();

	header("location: category_list.php");




 ?>