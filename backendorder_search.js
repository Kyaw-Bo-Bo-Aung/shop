$(document).ready(function(){
	$('.searchBtn').on('click', function(){
		var startDate = $('#startdate').val();
		var endDate = $('#enddate').val();

		// console.log(startDate);
		// console.log(endDate);

		$.ajax({
			type: 'POST',
			url: 'ordersearch.php',
			data:{
				start: startDate,
				end: endDate
			},
			success:function(response){
				// order search ကနေ search လုပ်လို့ရလာတဲ့ result ကို $.each နဲ့ loop ပတ်မှာ
				// console.log(response);
				var searchResults = JSON.parse(response);
				var orderSearchResultDiv = '';

				orderSearchResultDiv+=`
				<div class="table-responsive">
					<table class="table table-hover table-bordered ordertable">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Voucherno</th>
                              <th>Order date</th>
                              <th>Total</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
				`;

				var a = 1;
				$.each(searchResults,function(i,v){
					if (v) {
						var id = v.id;
						var voucherno = v.voucherno;
						var total = v.total;
						var status = v.status;
						var date = v.orderdate;

						if (status=='order') {
							var actionBtn = `
							<a href="" class="btn btn-outline-info">
                				<i class="icofont-info"></i>
                			</a>
                			<a href="orderstatus_change.php?id=${i}&status=0" class="btn btn-outline-warning">
                				<i class="icofont-ui-check"></i>
                			</a>
                			<a href="orderstatus_change.php?id=${i}&status=1" class="btn btn-outline-danger">
                				<i class="icofont-close"></i>
                			</a>
							`;
						}else{
							var actionBtn = `
							<a href="" class="btn btn-outline-info">
                				<i class="icofont-info"></i>
                			</a>
							`;
						}

					}
					orderSearchResultDiv+=`
						<tr>
							<td>${a++}</td>
							<td>${voucherno}</td>
							<td>${date}</td>
							<td>${total}</td>
							<td>${status}</td>
							<td>${actionBtn}</td>
						</tr>
						`;
				})
				
				orderSearchResultDiv+=`
						</tbody>
					</table>
				</div>
				`
			
			$("#searchitem").html(orderSearchResultDiv);
			}


		})
			
	})

// pie chart plugins
	$.ajax({
		type: "POST",
		url: "getEarning.php",
		success: function(response){
			// console.log(response);
			var earningResult = JSON.parse(response);
			
			var data = {
		      	labels: ["Jan", "Feb", "Mar", "Apr", "May","Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		      	datasets: [
		      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [
      			earningResult[0],earningResult[1],earningResult[2],earningResult[3],earningResult[4],
      			earningResult[5],earningResult[6],earningResult[7],earningResult[8],earningResult[9],
      			earningResult[10],earningResult[11]
      			]
      		}
      	]
      };
     
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      

		}
	})


      



})