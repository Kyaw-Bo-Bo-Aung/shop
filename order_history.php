<?php 
	require "frontend_header.php";
	require "db_connect.php";

	$userid = $_SESSION['login_user']['id'];

	$sql = 'SELECT * FROM orders WHERE user_id=:value1 ORDER BY orderdate DESC';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':value1', $userid);
	$stmt->execute();

	$orders = $stmt->fetchAll();
	// print"<pre>";
	// print_r($orders);


?>

<div class="jumbotron jumbotron-fluid subtitle">
	<div class="container">
		<h1 class="text-center text-white">Your order history</h1>
	</div>
</div>

<div class="container">
	<div class="row">
		<?php foreach ($orders as $order) {
			$id = $order['id'];
			$orderdate = $order['orderdate'];
			$voucherno = $order['voucherno'];
			$total = $order['total'];
			$note = $order['note'];
			$status = $order['status'];

		 ?>
		<div class="col-lg-4 col-md-6 col-sm-12 col-12 p-4">
			<div class="card">
				<div class="card-body">		
				<h5 class="card-title"><?= $voucherno; ?></h5>
				<h6 class="card-subtitle"><?= $orderdate; ?></h6>
				<p class="text-white card-text float-right">
					<?php if($status == 'order'){ ?>
						<span class="badge rounded-pill bg-warning p-2"><?= $status; ?></span>
					<?php }elseif($status == 'delete'){ ?>
						<span class="badge rounded-pill bg-danger p-2"><?= $status; ?></span>
					<?php }else{  ?>
						<span class="badge rounded-pill bg-success p-2"><?= $status; ?></span>
					<?php } ?>
				</p>
				<button class="card-link btn btn-outline-info my-3 detailmodal" data-id='<?= $id ?>'>Detail</button>
				</div>
			</div>
		</div>
		<?php }; ?>
	</div>
</div>

<!-- modal -->

<div class="modal fade detailmodallist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-image: linear-gradient(-90deg, #E2335E, #F49FB9);">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Your Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     		<table class="table table-hover">
     			<thead class="thead-dark">
     				<tr>
     					<th>#</th>
	     				<th>Item</th>
	     				<th>Price</th>
	     				<th>Qty</th>
	     				<th>Sub-total</th>
     				</tr>
     			</thead>
     			<tbody id="mytbody">
     				
     			</tbody>
     			
     		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-block" data-dismiss="modal" style="background-image: linear-gradient(-90deg, #E2335E, #F49FB9); color: white;">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->



 <?php 
 require "frontend_footer.php";
  ?>



