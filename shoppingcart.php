<?php 
	require "frontend_header.php";
 ?>

	
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Your Shopping Cart </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container mt-5">
		
		<!-- Shopping Cart Div -->
	<div id="itemexist">
		<div class="row mt-5 shoppingcart_div">
			<div class="col-12">
				<a href="index.php" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>
			</div>
		</div>

		<div class="row mt-5 shoppingcart_div">
			<div class="table-responsive">
				<table class="table">
					<thead id="shoppingcart_thead">
						
					</thead>
					<tbody id="shoppingcart_table">
						
					</tbody>
					<tfoot id="shoppingcart_tfoot">
						<tr>
							<td colspan="8">
								<h3 class="text-right alltotal">  </h3>
							</td>
						</tr>
						<tr> 
							<td colspan="5"> 
								<textarea class="form-control" id="notes" placeholder="Any Request..."></textarea>
							</td>
							<td colspan="3">
								<?php if (isset($_SESSION['login_user'])){ ?>
									<a href="javascript:void(0)" class="btn btn-secondary btn-block mainfullbtncolor checkoutBtn"> 
										Check Out 
									</a>
								<?php }else{ ?>
									<a href="login.php" class="btn btn-secondary btn-block mainfullbtncolor"> 
										Check Out 
									</a>
								<?php }; ?>
								

							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

		<!-- No Shopping Cart Div -->
		<div class="row mt-5 noneshoppingcart_div text-center">
			
			

		</div>
		

	</div>
	


<?php 
	require "frontend_footer.php";
?>