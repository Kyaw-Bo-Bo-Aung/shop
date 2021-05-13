<?php 
	require "frontend_header.php";
    require "db_connect.php";
    $brandId = $_GET['id'];
    $sql = "SELECT * FROM brands ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $brands = $stmt->fetchAll();

    $sql = "SELECT * FROM brands WHERE id=:value1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value1', $brandId);
    $stmt->execute();
    $brandname = $stmt->fetch(PDO::FETCH_ASSOC);
    $brandtitle = $brandname['name'];

    $sql = "SELECT items.*, brands.*, items.name as iname, items.id as iid
    		FROM items
    		INNER JOIN brands
    		ON items.brand_id=brands.id
    		WHERE items.brand_id=:value3";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':value3', $brandId);
    $stmt->execute();
    $brand_items = $stmt->fetchAll();
    // print"<pre>";
    // print_r($brand_items)
; ?>

	
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> <?= $brandtitle ?> </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container mt-5">


		<div class="row mt-5">
            <div class="col">
                <div class="bbb_viewed_title_container">
                    <h3 class="bbb_viewed_title"> Products of <?= $brandtitle ?>  </h3>
                    <div class="bbb_viewed_nav_container">
                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="icofont-rounded-left"></i></div>
                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="icofont-rounded-right"></i></div>
                    </div>
                </div>
                <div class="bbb_viewed_slider_container">
                    <div class="owl-carousel owl-theme bbb_viewed_slider">
                        <?php foreach ($brand_items as $brand_item):
                                $id = $brand_item['iid'];
                                $brand_item_name = $brand_item['iname'];
                                $brand_item_discount = $brand_item['discount'];
                                $brand_item_price = $brand_item['price'];
                                $codeno = $brand_item['codeno'];
                                $brand_item_photo = $brand_item[3];
                         ?>
                                <div class="owl-item">
                                    <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="pad15">
                                            <img src="<?= $brand_item_photo; ?>" class="img-fluid" style="height: 150px; width: 200px;">
                                            <p class="text-truncate px-5
                                            "><?= $brand_item_name; ?></p>
                                            <p class="item-price">
                                                <strike><?= $brand_item_discount; ?> </strike> 
                                                <span class="d-block"><?= $brand_item_price; ?> Ks</span>
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

                                            <a href="javascript:void(0)" class="addtocartBtn text-decoration-none" data-id="<?= $id; ?>" data-codeno="<?= $codeno; ?>" data-name="<?= $brand_item_name; ?>" data-price="<?= $brand_item_price; ?>" data-photo="<?= $brand_item_photo; ?>" data-discount="<?= $brand_item_discount; ?>">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach ?>
                       

                        

                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <div class="bbb_viewed_title_container">
                    <h3 class="bbb_viewed_title"> Brand Category  </h3>
                    <div class="bbb_viewed_nav_container">
                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="icofont-rounded-left"></i></div>
                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="icofont-rounded-right"></i></div>
                    </div>
                </div>
                <div class="bbb_viewed_slider_container">
                    <div class="owl-carousel owl-theme bbb_viewed_slider">
                       <?php foreach ($brands as $brand):
                                $name = $brand['name'];
                                $photo = $brand['photo'];
                            ?>
                        <div class="owl-item">
                            <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="pad15">
                                    <img src="<?= $photo ?>" class="img-fluid" style="height: 100px">
                                    <p class="text-truncate"><?= $name ?></p>
                                    <!-- <div class="star-rating">
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><i class='bx bxs-star' ></i></li>
                                            <li class="list-inline-item"><i class='bx bxs-star' ></i></li>
                                            <li class="list-inline-item"><i class='bx bxs-star' ></i></li>
                                            <li class="list-inline-item"><i class='bx bxs-star' ></i></li>
                                            <li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
                                        </ul>
                                    </div> -->
                                    <!-- <a href="#" class="addtocartBtn text-decoration-none">Add to Cart</a> -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>

	</div>
	


<?php 
	require "frontend_footer.php";
?>