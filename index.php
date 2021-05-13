<?php
	require "frontend_header.php";
	require "db_connect.php";
	$sql = "SELECT items.*, brands.name as bname, brands.id bid, subcategories.name as sname, 
            subcategories.id as sid
            FROM items
            INNER JOIN brands
            ON items.brand_id = brands.id
            INNER JOIN subcategories
            ON items.subcategory_id = subcategories.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $items = $stmt->fetchAll();

    $sql1 = 'SELECT * FROM categories ORDER BY rand() LIMIT 8';
    $statement = $conn->prepare($sql1);
    $statement->execute();
    $categories= $statement->fetchAll();


?>

	
	<!-- Carousel -->
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  		<ol class="carousel-indicators">
    		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  		</ol>
  		
  		<div class="carousel-inner">
    		<div class="carousel-item active">
		      	<img src="frontend/image/banner/banner1.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/banner2.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="frontend/image/banner/garnier.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
  		</div>
	</div>


	<!-- Content -->
	<div class="container mt-5 px-5">
		<!-- Category -->
		<div class="row">
			<?php foreach ($categories as $category):
				$cid = $category['id'];
				$cname = $category['name'];
				$clogo = $category['logo'];
				// var_dump($clogo);

			 ?>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 ">
				<div class="card categoryCard border-0 shadow-sm p-3 mb-5 rounded text-center">
				  	<img src="<?= $clogo; ?>" style="height: 200px;" class="card-img-top img-fluid" alt="...">
				  	<div class="card-body">
				    	<p class="card-text font-weight-bold text-truncate"> <?= $cname; ?> </p>
				  	</div>
				</div>
			</div>
			<?php endforeach ?>
			
		</div>

		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>
		
		<!-- Discount Item -->
		<div class="row mt-5">
			<h1>All Item List</h1>
		</div>

	    <!-- Disocunt Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php $j=1; foreach($items as $item):
                            $codeno = $item['codeno'];
                            $name = $item['name'];
                            $price = $item['price'];
                            $discount = $item['discount'];
                            $description = $item['description'];
                            $id = $item['id'];
                            $brand_id = $item['brand_id'];
                            $subcategory_id = $item['subcategory_id'];
                            $bname = $item['bname'];
                            $sname = $item['sname'];
                            $photo = $item['photo'];

                         ?>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="<?= $photo; ?>" style="height: 150px;" class="img-fluid">
		                        <p class="text-truncate"><?= $name;?></p>
		                        <p class="item-price">
		                        	<strike><?= $discount; ?> </strike> 
		                        	<span class="d-block"><?= $price; ?></span>
		                        </p>

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
								<a href="itemdetail.php?id=<?= $id; ?>" class="btn btn-outline-info my-3 py-1">Detail</a>
		                    </div>
		                </div>
		            <?php endforeach; ?>
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Discount Item -->
		<div class="row mt-5">
			<h1> Discount Items </h1>
		</div>

	    <!-- Discount Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">

		            	<?php 
		            		$sql = "SELECT * FROM items WHERE discount !='' ORDER BY rand() LIMIT 8";
		            		$stmt=$conn->prepare($sql);
		            		$stmt->execute();
		            		$discountitems = $stmt->fetchAll();
		            		foreach ($discountitems as $discountItem) :
		            			$di_id = $discountItem['id'];
			            		$di_name = $discountItem['name'];
			            		$di_price = $discountItem['price'];
			            		$di_discount = $discountItem['discount'];
			            		$di_photo = $discountItem['photo'];
			            		$di_codeno = $discountItem['codeno'];
		            		
		            	 ?>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="<?= $di_photo;  ?>" style="height: 150px;" class="img-fluid">
		                        <p class="text-truncate"><?= $di_name; ?></p>
		                        <p class="item-price">
		                        	<strike><?= $di_discount; ?></strike> 
		                        	<span class="d-block"><?= $di_price; ?> Ks</span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="javascript:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $di_id; ?>" data-codeno="<?= $di_codeno; ?>" data-name="<?= $di_name; ?>" data-price="<?= $di_price; ?>" data-photo="<?= $di_photo; ?>" data-discount="<?=$discount; ?>">Add to Cart</a>
								<a href="itemdetail.php?id=<?= $di_id; ?>" class="btn btn-outline-info my-3 py-1">Detail</a>
		                    </div>
		                </div>
		                <?php endforeach; ?>

		                
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Hot Item -->
		<div class="row mt-5">
			<h1> Hot Items </h1>
		</div>

	    <!-- Hot Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php
		            	 $sql = 'SELECT * FROM items ORDER BY created_at DESC LIMIT 12';
		            	 $stmt = $conn->prepare($sql);
		            	 $stmt->execute();
		            	 $hotitems = $stmt->fetchAll();
		            	 foreach ($hotitems as $hotItem) :
		            	 	$hi_id = $hotItem['id'];
		            		$hi_name = $hotItem['name'];
		            		$hi_price = $hotItem['price'];
		            		$hi_discount = $hotItem['discount'];
		            		$hi_photo = $hotItem['photo'];
		            		$hi_codeno = $hotItem['codeno'];
		            	 
		            	 ?>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="<?= $hi_photo; ?>" style="height: 150px;" class="img-fluid">
		                        <p class="text-truncate"> <?= $hi_name; ?> </p>
		                        <p class="item-price">
		                        	<?php if($hi_discount){ ?>
			                        	<strike> <?= $hi_discount ?> Ks </strike> 
			                        	<span class="d-block"> <?= $hi_price ?> Ks</span>
			                        <?php } else{ ?>
										<span class="d-block"> <?= $hi_price ?> Ks</span>
			                        <?php } ?>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="javascript:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $hi_id; ?>" data-codeno="<?= $hi_codeno; ?>" data-name="<?= $hi_name; ?>" data-price="<?= $hi_price; ?>" data-photo="<?= $hi_photo; ?>" data-discount="<?=$discount; ?>">Add to Cart</a>
								<a href="itemdetail.php?id=<?= $hi_id; ?>" class="btn btn-outline-info my-3 py-1">Detail</a>
		                    </div>
		                </div>

		               <?php endforeach; ?>

		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		
		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	    <!-- Brand Store -->
	    <div class="row mt-5">
			<h1> Top Brand Stores </h1>
	    </div>

	    <!-- Brand Store Item -->
	    <section class="customer-logos slider mt-5">

	    	<?php 
	    		$sql = "SELECT * FROM brands ORDER BY rand() LIMIT 14";
	    		$stmt = $conn->prepare($sql);
	    		$stmt->execute();
	    		$brands = $stmt->fetchAll();

	    		foreach ($brands as $brand) :
	    			$tb_id = $brand['id'];
	    			$tb_name = $brand['name'];
	    			$tb_photo = $brand['photo'];
	    	  ?>
	      	<div class="slide">
	      		<a href="">
		      		<img src="<?= $tb_photo ?>">
		      	</a>
	      	</div>
	      	<?php endforeach;  ?>
	      	
	      	
	   	</section>

	    <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	</div>


	<?php require "frontend_footer.php"; ?>