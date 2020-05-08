<div class="text-right">
	<span>Balance : {{ $balance }}</span>
</div>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			 
			<th>Ref. Id</th>
			<th>On Date</th>
			<th>C/D</th>
			<th>Amount</th>
			 
			
			 
		</tr>
	</thead>
	<tbody>
		@foreach ($passbooks as $passbook)
		 
		<tr> 
			<td>
				@if ($passbook->order_id==null)
				{{ $passbook->receipt_id }} 
				@else
				{{ $passbook->order_id }} 
					
				@endif
			
			</td>
			<td>{{ $passbook->on_date }}</td>
			<td>{{ $passbook->transaction_type==1?'C':'D' }}</td> 
			<td>{{ $passbook->total_amount }}</td> 
		</tr>
		@endforeach
		
	</tbody>
</table>