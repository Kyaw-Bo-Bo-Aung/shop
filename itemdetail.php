<?php 
	require "frontend_header.php";
	require "db_connect.php";

	$item_id = $_GET['id'];
	// var_dump($item_id); 

	$sql = "SELECT items.*, brands.name as bname
			FROM items
			LEFT JOIN brands
			ON items.brand_id=brands.id
			WHERE items.id=:item_id";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":item_id", $item_id);
	$stmt->execute();
	$item = $stmt->fetch(PDO::FETCH_ASSOC);

	$id = $item['id'];
	$codeno = $item['codeno'];
	$name = $item['name'];
	$price = $item['price'];
	$discount = $item['discount'];
	$description = $item['description'];
	$photo = $item['photo'];
	$brand = $item['bname'];


	$sql = "SELECT items.*, subcategories.name as sname, subcategories.category_id as sid
			FROM items
			JOIN subcategories
			ON items.subcategory_id=subcategories.id
			WHERE items.id=:item_id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':item_id', $item_id);
	$stmt->execute();
	$subcategory = $stmt->fetch(PDO::FETCH_ASSOC);
	$subcategory_id = $subcategory['sid'];

	$sql = "SELECT subcategories.*, categories.name as cname
			FROM subcategories
			JOIN categories
			ON subcategories.category_id=categories.id
			WHERE subcategories.category_id=:category_id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':category_id', $subcategory_id);
	$stmt->execute();
	$category = $stmt->fetch(PDO::FETCH_ASSOC);

	$sql = "SELECT items.*, subcategories.id as subid, categories.id as catid,
			subcategories.name as subname, categories.name as catname
			FROM items
			JOIN subcategories
			ON items.subcategory_id = subcategories.id
			JOIN categories
			ON subcategories.category_id = categories.id
			WHERE items.id=:item_id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':item_id', $item_id);
	// $stmt->bindParam(':category_id', $subcategory_id);
	$stmt->execute();
	$relateds = $stmt->fetch(PDO::FETCH_ASSOC);
	// print"<pre>";
	// print_r($relateds); 
	// die();

 ?>

	
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"><?= $codeno; ?> </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container">

		<!-- Breadcrumb -->
		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
		    	<li class="breadcrumb-item">
		    		<a href="index.php" class="text-decoration-none secondarycolor"> Home </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> <?= $relateds['catname'] ?> </a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
					<?= $relateds['subname'] ?>
		    	</li>
		  	</ol>
		</nav>

		<div class="row mt-5">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="<?= $photo;  ?>" class="img-fluid">
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
				
				<h4> <?= $name; ?> </h4>

				<div class="star-rating">
					<ul class="list-inline">
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
					</ul>
				</div>

				<p>
					<?= $description; ?>
				</p>

				<p> 
					<span class="text-uppercase "> Current Price : </span>
					<span class="maincolor ml-3 font-weight-bolder"><?= $price; ?> Ks </span>
				</p>

				<p> 
					<span class="text-uppercase "> Brand : </span>
					<span class="ml-3"> <a href="" class="text-decoration-none text-muted"> <?= $brand; ?> </a> </span>
				</p>

				<a href="javascript:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $id; ?>" data-codeno="<?= $codeno; ?>" data-name="<?= $name; ?>" data-price="<?= $price; ?>" data-photo="<?= $photo; ?>" data-discount="<?= $discount; ?>"><i class="icofont-shopping-cart mr-2"></i> Add to Cart</a>
				

			</div>
		</div>

		<!-- <div class="row mt-5">
			<div class="col-12">
				<h3> Related Item </h3>
				<hr>
			</div>
			

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="<?= $relateds['photo'] ?>" class="img-fluid">
				</a>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="image/item/saisai_three.jpg" class="img-fluid">
				</a>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="image/item/saisai_four.jpg" class="img-fluid">
				</a>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="image/item/saisai_four.jpg" class="img-fluid">
				</a>
			</div>
		</div>
 -->
		
	</div>
	


<?php 
	require "frontend_footer.php";
?>