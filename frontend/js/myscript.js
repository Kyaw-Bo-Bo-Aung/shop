$(document).ready(function(){
		showdata();
		cartnoti();
		// $("#ordersuccess").fadeOut(slow);
		// $("#ordersuccess").fadeIn();
	
// addtocart btn
	$(".addtocartBtn").on('click',function(){
		// alert("ok");	
		var id = $(this).data("id");
		// var di_id = $(this).data("di_id");
		// var hi_id = $(this).data("hi_id");

		var name = $(this).data("name");
		// var di_name = $(this).data("di_name");
		// var hi_name = $(this).data("hi_name");
		// console.log(di_name);

		var price = $(this).data("price");
		// var di_price = $(this).data("di_price");
		// var hi_price = $(this).data("hi_price");
		// console.log(price);

		var codeno = $(this).data("codeno");
		// var di_codeno = $(this).data("di_codeno");
		// var hi_codeno = $(this).data("hi_codeno");
		var photo = $(this).data("photo");
		var discount = $(this).data("discount");
		// console.log(discount);

		var item = {
			"id" : id,
			"name" : name,
			"price" : price,
			"codeno" : codeno,
			"photo" : photo,
			"qty" : 1,
			"discount" : discount
		};

		var storagedata = localStorage.getItem("itemlist");
		var itemarray;
		if (!storagedata) {
			itemarray=[];
		}else{
			itemarray = JSON.parse(storagedata);
		}

		var condition = false;

		itemarray.forEach( function(v, i) {
			if(id==v.id){
				v.qty++;
				condition=true;
			}
		});
		if (condition==false) {
			itemarray.push(item);
		}

		var itemstring = JSON.stringify(itemarray);
		localStorage.setItem("itemlist", itemstring);
		showdata();
	})
// end addtocart btn

// showdata
	function showdata () {
		// alert("ok");
		var storagedata = localStorage.getItem("itemlist");
		var html='';
		if (storagedata) {
			var itemarray = JSON.parse(storagedata);
			var tfoot = '';
			var thead='';
			var alltotal = 0;
			thead +=`
				<tr>
					<th colspan="3"> Product </th>
					<th colspan="3"> Qty </th>
					<th> Price </th>
					<th> Total </th>
				</tr>
				`;
			
			itemarray.forEach( function(v, i) {
				var id = v.id;
				var name = v.name;
				var price = v.price;
				var codeno = v.codeno;
				var photo = v.photo;
				var qty = v.qty;
				var discount = v.discount;
				var total = price*v.qty;
				alltotal += total;

				html+=`
				<tr>
					<td>
						<button class="btn btn-outline-danger remove btn-sm" style="border-radius: 50%" data-id=${i}> 
							<i class="icofont-close-line"></i> 
						</button> 
					</td>
					<td> 
						<img src="${photo}" class="cartImg">						
					</td>
					<td> 
						<p> ${name} </p>
						<p> ${codeno}</p>
					</td>
					<td>
						<button class="btn btn-outline-secondary plus_btn" data-id="${i}"> 
							<i class="icofont-plus"></i> 
						</button>
					</td>
					<td>
						<p> ${qty} </p>
					</td>
					<td>
						<button class="btn btn-outline-secondary minus_btn" data-id="${i}"> 
							<i class="icofont-minus"></i>
						</button>
					</td>`

					if (discount) {
					html+=`<td>
								<p class="text-danger"> 
									${price}
								</p>
								<p class="font-weight-lighter"> 
								<del> ${discount} </del> </p>
							</td>`
					}
					

					html+=`<td>
						${total}
					</td>
				</tr>
				`
			});
		
			$("#shoppingcart_table").html(html);
			$(".alltotal").html(alltotal +" Ks");
			$("#shoppingcart_thead").html(thead);

			cartnoti();

		}else{
			html+=
			`<div class="col-12">
				<h5 class="text-center"> There are no items in this cart </h5>
			</div>

			<div class="col-12 mt-5 ">
				<a href="index.php" class="btn btn-secondary mainfullbtncolor px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>
			</div>`;
			$('#itemexist').hide();
			$('.noneshoppingcart_div').html(html);
		}
	}
// end showdata

// increase btn
	$("#shoppingcart_table").on('click','.plus_btn',function(){
			// alert("ok");
			var id=$(this).data('id');
			// console.log(id);
			var storagedata=localStorage.getItem("itemlist");
			if(storagedata){
				var itemArray=JSON.parse(storagedata);

				itemArray.forEach( function(v, i) {
					// console.log(v);
					if(i==id){
						// alert("ok");
						v.qty++;
					}
					// statements
				});
			var itemstring=JSON.stringify(itemArray);
			localStorage.setItem("itemlist",itemstring);
			showdata();
			
			}
		})
// end increase btn

// decrease btn
	$("#shoppingcart_table").on('click','.minus_btn',function(){
			//alert("ok");
			var id=$(this).data('id');

			var itemlist=localStorage.getItem("itemlist");
			if(itemlist){
				var itemArray=JSON.parse(itemlist);

				itemArray.forEach( function(v, i) {

					if(i==id){
						//alert("ok");
						v.qty--;
						if(v.qty==0){
							if (confirm("Are you sure")) {
								itemArray.splice(id, 1);
							}else{
								v.qty++;
							}
							
						}
					}
					// statements
				});
			var itemstring=JSON.stringify(itemArray);
			localStorage.setItem("itemlist",itemstring);
			showdata();
			}
		})
// end decrease btn

// cartnoti
	function cartnoti(){
		// alert("ok");
		var storagedata=localStorage.getItem("itemlist");
			if(storagedata){
				var itemArray=JSON.parse(storagedata);
				var total=0;
				var cash=0;
				itemArray.forEach( function(v, i) {
					 total+=v.qty;
					 cash+=(v.price*v.qty);
				});
				// console.log(total);
				$(".cartNoti").html(total);
				$("#cartCash").html(cash+" Ks");
			}else{
				$(".cartNoti").html(0);
				$("#cartCash").html(0);
			}
	}
// end cartnoti

//remove btn
	$('#shoppingcart_table').on("click",".remove",function(){
		var id = $(this).data('id');

		// console.log(id);

		var itemlist=localStorage.getItem("itemlist");
			if(itemlist){
				var itemArray=JSON.parse(itemlist);

				itemArray.forEach( function(v, i){
					// console.log(i);
					if (i==id) {
						if (confirm("Are you sure?")) {
							itemArray.splice(id,1);
						}
						// alert("ok");
						
					}
				})
			}
			var itemstring=JSON.stringify(itemArray);
			localStorage.setItem("itemlist",itemstring);
			showdata();
	})
// end remove btn

// checkoutbtn
	$(".checkoutBtn").on('click', function(){
		// alert("ok");
		var storagedata = localStorage.getItem("itemlist");
		var notes = $('#notes').val();
		// console.log(notes);
		var itemArray = JSON.parse(storagedata);
		var total = $('.alltotal').html() ;
		// console.log(total);

		$.post('storeorder.php',{
			cart: itemArray,
			note: notes,
			total: total
		},function(response){
			localStorage.clear();
			location.href="ordersuccess.php";
		})
	})
// end checkoutbtn


// modalbtn
	$(".detailmodal").on('click',function(){
		// alert("ok");
		var id = $(this).data('id');
		
		// alert(id);
		$.ajax({
			type: 'post',
			url: 'order_history_detail.php',
			data: {
				id: id
			},
			success:function(data){
				// console.log(data);
				var orderHistoryList = JSON.parse(data);
				var html='';
				var z=1;
				var total = 0;
				console.log(orderHistoryList);
				orderHistoryList.forEach( function(v, i) {
					var itemname = v.it_name;
					var itemprice = v.it_price;
					var qty = v.qty;
					var subtotal = v.qty*v.it_price;
					total+=subtotal;
					html+=`
				<tr>
 					<td>${z++}</td>
 					<td>${itemname}</td>
 					<td>${itemprice}</td>
 					<td>${qty}</td>
 					<td>${subtotal}</td>
 				</tr>
 				
 				`
				});
				html+=`<tr>
					<td></td>
 					<td colspan=3>Total</td>
 					<td>${total} Ks </td>
 				</tr>`
				$('#mytbody').html(html);
			}
		})
		
		$('.detailmodallist').modal('show');
	})

// end modalbtn


// ordersuccess

// end ordersuccess
	

})