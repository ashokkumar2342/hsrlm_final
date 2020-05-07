<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			 
			<th>Order Id</th>
			<th>Delivery Date</th>
			<th>Transaction Type</th>
			<th>Total Amount</th>
			
			 
		</tr>
	</thead>
	<tbody>
		@foreach ($passbooks as $passbook)
		 
		<tr>
			<td>{{ $passbook->order_id }}</td>
			<td>{{ $passbook->delivery_date }}</td>
			<td>{{ $passbook->delivery_date }}</td>
			<td>{{ $passbook->delivery_date }}</td>
			
			 
			 
		</tr>
		@endforeach
		
	</tbody>
</table>