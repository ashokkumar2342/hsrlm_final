 
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>User</th>
			<th>Mobile No.</th>
			<th>Qty.</th>
			
			{{-- <th>Action</th> --}}
		</tr>
	</thead>
	<tbody>
		@foreach ($passbooks as $passbook)
		{{-- @php
		    $Quantity=App\Model\Passbook::where('user_id',$passbook->user_id)->sum('qty');
		    $rate=App\Model\Transaction::where('for_date',$for_date)->where('user_id',$user->id)->sum('rate');
		@endphp --}}
		<tr>
			<td>{{ $passbook->users->first_name or '' }}</td>
			<td>{{ $passbook->users->mobile_no or '' }}</td>
			<td></td>
			
			{{-- <td>
				<a href="#" onclick="callPopupLarge(this,'{{ route('admin.order.user.order.list.view',[$user->user_id,$for_date]) }}')" title="" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
			</td> --}}
		</tr>
		@endforeach
		
	</tbody>
</table>
 