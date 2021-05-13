<?php 
  require "backend_header.php";
  require "db_connect.php";

  date_default_timezone_set("Asia/Rangoon");
  $voucherid = $_GET['id'];
  // var_dump($voucherid); 
  $sql = 'SELECT item_order.*, items.id as i_id, items.name as i_name, items.description as i_desc,   items.codeno as i_codeno, items.price as i_price, orders.* 
          FROM item_order
          INNER JOIN items
          ON item_order.item_id = items.id
          INNER JOIN orders
          ON item_order.order_id = orders.id
          WHERE item_order.order_id = :value1';
  $stmt=$conn->prepare($sql);
  $stmt->bindParam(":value1", $voucherid);
  $stmt->execute();
  $orderdetails = $stmt->fetchAll();
  // print"<pre>";
  // print_r($orderdetails); 

  $sql= "SELECT * FROM orders WHERE id=:id";
  $stmt=$conn->prepare($sql);
  $stmt->bindParam(':id', $voucherid);
  $stmt->execute();
  $order_user_join = $stmt->fetch(PDO::FETCH_ASSOC);
  $user_id = $order_user_join["user_id"];
  $voucher_no = $order_user_join['voucherno'];
  $voucher_date = $order_user_join['orderdate'];


  $sql = "SELECT * FROM users where id=:value2";
  $stmt=$conn->prepare($sql);
  $stmt->bindParam(":value2", $user_id);
  $stmt->execute();
  $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
  $user_name = $user_info['name'];
  $user_add = $user_info['address'];
  $user_phone = $user_info['phone'];
  $user_email = $user_info['email']; 



?>

<div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i>Voucher no. <?= $voucher_no; ?></h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: <?= $voucher_date; ?> </h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-12">To
                  <address><strong><?= $user_name; ?></strong><br><?= $user_add; ?><br>Phone: <?= $user_phone; ?><br>Email: <?= $user_email; ?></address>
                </div>
                
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Qty</th>
                        <th>Item</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($orderdetails as $orderdetail) {
                       ?>
                      <tr>
                        <td><?= $orderdetail['qty']; ?></td>
                        <td><?= $orderdetail['i_name']; ?></td>
                        <td><?= $orderdetail['i_codeno']; ?></td>
                        <td><?= $orderdetail['i_desc']; ?></td>
                        <td><?= $orderdetail['qty']*$orderdetail['i_price'];?></td>
                      </tr>
                      
                      <?php } ?>

                      <tr>
                        <td colspan="4"><b>Total</b></td>
                        <td><?= $orderdetail['total']; ?></td>
                      </tr>
                      <?php ; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>



<?php 
  require "backend_footer.php";
?>