<?php 
	require "frontend_header.php";
	require "db_connect.php";

	$subcategory_id = $_GET['id'];

// subcategory
    $sql = "SELECT subcategories.*, categories.id as cid, categories.name as cname
            FROM subcategories
            LEFT JOIN categories
            ON subcategories.category_id=categories.id
            WHERE subcategories.id=:value1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $subcategory_id);
    $stmt->execute();
    $subcategory = $stmt->fetch(PDO::FETCH_ASSOC);

    $subcategory_name = $subcategory['name'];
    $category_id = $subcategory['category_id'];
    $category_name = $subcategory['cname'];


// subcategories
    $sql = 'SELECT * FROM subcategories WHERE category_id= :value2';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value2', $category_id);
    $stmt->execute();
    $subcategories = $stmt->fetchAll();

// items 
    $sql = 'SELECT * FROM items WHERE subcategory_id=:value3';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value3', $subcategory_id);
    $stmt->execute();
    $items = $stmt->fetchAll();

 ?>

	
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> <?= $subcategory_name; ?> </h1>
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
		    		<a href="#" class="text-decoration-none secondarycolor"> <?= $category_name; ?> </a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
					<?= $subcategory_name; ?>
		    	</li>
		  	</ol>
		</nav>

		<div class="row mt-5">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<ul class="list-group">
					<?php foreach ($subcategories as $subcategory):
						$sid = $subcategory['id'];
						$name = $subcategory['name'];
					?>
						<li class="list-group-item <?php if($sid == $subcategory_id) echo"active"; ?>">
					  		<a href="subcategory.php?id=<?= $sid; ?>" class="text-decoration-none secondarycolor"> <?= $name?> </a>
					  	</li>
					<?php endforeach; ?>
				  	
				</ul>
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

				<div class="row">
					<!-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12"> -->
						<?php foreach ($items as $item) {
							$codeno = $item['codeno'];
                            $name = $item['name'];
                            $price = $item['price'];
                            $discount = $item['discount'];
                            $description = $item['description'];
                            $id = $item['id'];
                            $brand_id = $item['brand_id'];
                            $subcategory_id = $item['subcategory_id'];
                            $photo = $item['photo'];
						  ?>
					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">

						<div class="card pad15 mb-3">
						  	<img src="<?= $photo; ?>" class="card-img-top" alt="...">
						  	
						  	<div class="card-body text-center">
						    	<h5 class="card-title text-truncate"><?= $name; ?></h5>
						    	
						    <?php if ($discount) {
						    		# code...
						    	?>
						    	<p class="item-price">
		                        	<strike><?= $discount; ?> Ks</strike> 
		                        	<span class="d-block"><?= $price; ?> Ks</span>
		                        </p>
		                    <?php }else{ ?>
		                    	<p class="item-price">
		                        	<span class="d-block"><?= $price ?> Ks</span>
		                        </p>
		                    <?php }; ?>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

										<a href="javascript:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $id; ?>" data-codeno="<?= $codeno; ?>" data-name="<?= $name; ?>" data-price="<?= $price; ?>" data-photo="<?= $photo; ?>" data-discount="<?= $discount; ?>">Add to Cart</a>
						  	</div>
						</div>
					</div>
						<?php } ?>
					<!-- </div> -->

				

				
				</div>


				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-end">
					    <li class="page-item disabled">
					      	<a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i class="icofont-rounded-left"></i>
					      	</a>
					    </li>
					    <li class="page-item">
					    	<a class="page-link" href="#">1</a>
					    </li>
					    <li class="page-item active">
					    	<a class="page-link" href="#">2</a>
					    </li>
					    <li class="page-item">
					    	<a class="page-link" href="#">3</a>
					    </li>
					    <li class="page-item">
					      	<a class="page-link" href="#">
					      		<i class="icofont-rounded-right"></i>
					      	</a>
					    </li>
					</ul>
				</nav>
			</div>
		</div>

		
	</div>
	

<?php 
	require "frontend_footer.php";
 ?>