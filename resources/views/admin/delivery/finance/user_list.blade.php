 
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>User</th>
			<th>Mobile No.</th>
			 
			
			{{-- <th>Action</th> --}}
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user) 
		<tr onclick="callPopupLarge(this,'{{ route('admin.delivery.finance.userList.payment',[$user->id,$user_type_id]) }}')">
			<td>{{ $user->first_name or '' }}</td>
			<td>{{ $user->mobile_no or '' }}</td>
			 
		</tr>
		@endforeach
		
	</tbody>
</table>
 