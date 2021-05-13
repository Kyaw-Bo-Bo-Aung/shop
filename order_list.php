<?php 
    require "backend_header.php";
    require "db_connect.php";

   date_default_timezone_set("Asia/Rangoon");
   $todaydate = date("Y-m-d");

   $orderStatus = "Order";
   $confirmStatus = "Confirm";
   $deleteStatus = "Delete";

	$sql = "SELECT * FROM orders WHERE orderdate = :orderdate 
	   		AND status= :status
	   		ORDER BY id DESC"; 
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':orderdate', $todaydate);
	$stmt->bindParam(':status', $orderStatus);
	$stmt->execute();
	$pending_orders = $stmt->fetchAll();

	$sql = "SELECT * FROM orders WHERE orderdate = :orderdate 
	   		AND status= :status
	   		ORDER BY id DESC"; 
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':orderdate', $todaydate);
	$stmt->bindParam(':status', $confirmStatus);
	$stmt->execute();
	$confirm_orders = $stmt->fetchAll();

	$sql = "SELECT * FROM orders WHERE orderdate = :orderdate 
	   		AND status= :status
	   		ORDER BY id DESC"; 
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':orderdate', $todaydate);
	$stmt->bindParam(':status', $deleteStatus);
	$stmt->execute();
	$cancel_orders = $stmt->fetchAll();

?>


        <div class="app-title">
            <div>
                <h1> <i class="icofont-list"></i> Order List </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <a href="category_new.php" class="btn btn-outline-primary">
                    <i class="icofont-plus"></i>
                </a>
            </ul>
        </div>

		<div class="col-md-12">
			<div class="tile">
				<h3 class="tile-title">Search order history</h3>
				<div class="tile-body">
					<form class="row">
						<div class="form-group col-md-5">
						  <label class="control-label">Start date</label>
						  <input class="form-control" type="date" id="startdate">
						</div>
						<div class="form-group col-md-5">
						  <label class="control-label">End date</label>
						  <input class="form-control" type="date" id="enddate">
						</div>
						<div class="form-group col-md-2 align-self-end">
						  <button class="btn btn-primary searchBtn" type="button">Search</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- search -->
		 <!-- <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">

						<div id='searchitem'>
							<div class="table-responsive">
						        <table class="table table-hover table-bordered ordertable">
						            <thead>
						                <tr>
						                  <th>#</th>
						                  <th>Voucherno</th>
						                  <th>Total</th>
						                  <th>Action</th>
						                </tr>
						            </thead>
						            <tbody>
						                <?php $i=1;
						                foreach ($pending_orders as $pending_order) {
						                 	$pending_id = $pending_order['id'];
						                 	$pending_voucherno = $pending_order['voucherno'];
						                 	$pending_total = $pending_order['total'];
										?>
						                	<tr>
						                		<td><?= $i++; ?></td>
						                		<td><?= $pending_voucherno; ?></td>
						                		<td><?= $pending_total; ?></td>
						                		<td>
						                			<a href="" class="btn btn-outline-info">
						                				<i class="icofont-info"></i>
						                			</a>
						                			<a href="orderstatus_change.php?id=<?=$pending_id?>&status=0" class="btn btn-outline-warning">
						                				<i class="icofont-ui-check"></i>
						                			</a>
						                			<a href="orderstatus_change.php?id=<?=$pending_id?>&status=1" class="btn btn-outline-danger">
						                				<i class="icofont-close"></i>
						                			</a>
						                		</td>
						                	</tr>
						                <?php }; ?>
						            </tbody>
						        </table>
						    </div> 
						</div>
						
                    </div>
                </div>
            </div>
        </div> -->
		<!-- end search -->

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                    	<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pending Order</a>
							</li>
							<li class="nav-item" role="presentation">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Confirm Order</a>
							</li>
							<li class="nav-item" role="presentation">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Delete Order</a>
							</li>
							</ul>
							<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="table-responsive">
		                            <table class="table table-hover table-bordered ordertable">
		                                <thead>
		                                    <tr>
		                                      <th>#</th>
		                                      <th>Voucherno</th>
		                                      <th>Total</th>
		                                      <th>Action</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                    <?php $i=1;
		                                    foreach ($pending_orders as $pending_order) {
		                                     	$pending_id = $pending_order['id'];
		                                     	$pending_voucherno = $pending_order['voucherno'];
		                                     	$pending_total = $pending_order['total'];
											?>
		                                    	<tr>
		                                    		<td><?= $i++; ?></td>
		                                    		<td><?= $pending_voucherno; ?></td>
		                                    		<td><?= $pending_total; ?></td>
		                                    		<td>
		                                    			<a href="orderitem_detail.php?id=<?= $pending_id?>" class="btn btn-outline-info">
		                                    				<i class="icofont-info"></i>
		                                    			</a>
		                                    			<a href="orderstatus_change.php?id=<?=$pending_id?>&status=0" class="btn btn-outline-warning">
		                                    				<i class="icofont-ui-check"></i>
		                                    			</a>
		                                    			<a href="orderstatus_change.php?id=<?=$pending_id?>&status=1" class="btn btn-outline-danger">
		                                    				<i class="icofont-close"></i>
		                                    			</a>
		                                    		</td>
		                                    	</tr>
		                                    <?php }; ?>
		                                </tbody>
		                            </table>
		                        </div>
							</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div class="table-responsive">
		                            <table class="table table-hover table-bordered ordertable">
		                                <thead>
		                                    <tr>
		                                      <th>#</th>
		                                      <th>Voucherno</th>
		                                      <th>Total</th>
		                                      <th>Action</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                    <?php $i=1;
		                                    foreach ($confirm_orders as $confirm_order) {
		                                     	$confirm_id = $confirm_order['id'];
		                                     	$confirm_voucherno = $confirm_order['voucherno'];
		                                     	$confirm_total = $confirm_order['total'];
											?>
		                                    	<tr>
		                                    		<td><?= $i++; ?></td>
		                                    		<td><?= $confirm_voucherno; ?></td>
		                                    		<td><?= $confirm_total; ?></td>
		                                    		<td>
		                                    			<a href="orderitem_detail.php?id=<?= $confirm_id?>" class="btn btn-outline-info">
		                                    				<i class="icofont-info"></i>
		                                    			</a>
		                                    			<a href="orderstatus_change.php?id=<?=$confirm_id?>&status=1" class="btn btn-outline-danger">
		                                    				<i class="icofont-close"></i>
		                                    			</a>
		                                    		</td>
		                                    	</tr>
		                                    <?php }; ?>
		                                </tbody>
		                            </table>
		                        </div>
							</div>
							<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
								<div class="table-responsive">
		                            <table class="table table-hover table-bordered ordertable">
		                                <thead>
		                                    <tr>
		                                      <th>#</th>
		                                      <th>Voucherno</th>
		                                      <th>Total</th>
		                                      <th>Action</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                    <?php $i=1;
		                                    foreach ($cancel_orders as $cancel_order) {
		                                     	$cancel_id = $cancel_order['id'];
		                                     	$cancel_voucherno = $cancel_order['voucherno'];
		                                     	$cancel_total = $cancel_order['total'];
											?>
		                                    	<tr>
		                                    		<td><?= $i++; ?></td>
		                                    		<td><?= $cancel_voucherno; ?></td>
		                                    		<td><?= $cancel_total; ?></td>
		                                    		<td>
		                                    			<a href="orderitem_detail.php?id=<?= $cancel_id?>" class="btn btn-outline-info">
		                                    				<i class="icofont-info"></i>
		                                    			</a>
		                                    		</td>
		                                    	</tr>
		                                    <?php }; ?>
		                                </tbody>
		                            </table>
		                        </div>
							</div>
							</div>
                    </div>
                </div>
            </div>
        </div>



<?php 
        require "backend_footer.php";
 ?>