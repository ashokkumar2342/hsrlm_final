<div class="text-right">
	<span>Total Rs: {{ $passbooks->sum('total_amount') }}</span>
</div>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			 
			<th>Receipt Id</th>
			<th>On Date</th>
			<th>Amount</th>
			 
			
			 
		</tr>
	</thead>
	<tbody>
		@foreach ($passbooks as $passbook)
		 
		<tr> 
			<td>{{ $passbook->receipt_id }}</td>
			<td>{{ $passbook->on_date }}</td>
			<td>{{ $passbook->total_amount }}</td> 
		</tr>
		@endforeach
		
	</tbody>
</table>