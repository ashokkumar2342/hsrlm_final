 
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>User</th>
			<th>Rate</th>
			<th>Quantity</th>
			
			{{-- <th>Action</th> --}}
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
		@php
		    $Quantity=App\Model\Transaction::where('for_date',$for_date)->where('user_id',$user->id)->sum('qty');
		    $rate=App\Model\Transaction::where('for_date',$for_date)->where('user_id',$user->id)->sum('rate');
		@endphp
		<tr>
			<td>{{ $user->first_name }}</td>
			<td>{{ $rate }}</td>
			<td>{{ $Quantity }}</td>
			{{-- <td>
				<a href="#" onclick="callPopupLarge(this,'{{ route('admin.order.user.order.list.view',[$user->user_id,$for_date]) }}')" title="" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
			</td> --}}
		</tr>
		@endforeach
		
	</tbody>
</table>
 