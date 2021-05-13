<?php 
	require "backend_header.php";
	require "db_connect.php";

	date_default_timezone_set("Asia/Rangoon");
	$today = date('Y-m-d');

	// order
	$sql = 'SELECT count(id) as orderTotal FROM orders WHERE orderdate = :value1';
	$stmt= $conn->prepare($sql);
	$stmt->bindParam(':value1', $today);
	$stmt->execute();
	$orderCount = $stmt->fetch(PDO::FETCH_ASSOC);

	// customers/
	$roleId = 2;
	$sql = "SELECT count(users.id) as customerTotal FROM users
			INNER JOIN model_has_roles
			ON users.id = model_has_roles.user_id
			WHERE model_has_roles.role_id=:value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":value2", $roleId);
	$stmt->execute();
	$customers = $stmt->fetch(PDO::FETCH_ASSOC);

	//brands
	$sql = "SELECT count(id) as brandcount FROM brands";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$brands = $stmt->fetch(PDO::FETCH_ASSOC);
	var_dump($brands);

	//items
	$sql = 'SELECT count(id) as itemcount FROM items';
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$itemstotal = $stmt->fetch(PDO::FETCH_ASSOC);
 ?>


      <div class="app-title">
        <div>
          <h1><i class="icofont-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon icofont-prestashop"></i>
            <div class="info">
              <h4>Today orders</h4>
              <p><b><?= $orderCount['orderTotal']; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon icofont-ui-user-group"></i>
            <div class="info">
              <h4>Customers</h4>
              <p><b><?= $customers['customerTotal'] ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon icofont-badge"></i>
            <div class="info">
              <h4>Brands</h4>
              <p><b><?= $brands['brandcount']; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon icofont-box"></i>
            <div class="info">
              <h4>Items</h4>
              <p><b><?= $itemstotal['itemcount']; ?></b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Monthly Sales</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
            </div>
          </div>
        </div>
       
      </div>
    
 <?php 
 	require "backend_footer.php";
  ?>