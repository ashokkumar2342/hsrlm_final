 
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
		@foreach ($users as $user)
		@php
		    $users=App\User::find($user->id);
		    $Quantity=App\Model\Transaction::where('for_date',$for_date)->where('user_id',$user->id)->sum('qty');
		    $rate=App\Model\Transaction::where('for_date',$for_date)->where('user_id',$user->id)->sum('rate');
		@endphp
		<tr href="#" onclick="callPopupLarge(this,'{{ route('delevery.order.user.order.view',[$user->id,$for_date]) }}')">
			<td>{{ $user->first_name }}</td>
			<td>{{ $users->mobile_no }}</td>
			<td>{{ $Quantity }}</td>
			{{-- <td>
				<a href="#" onclick="callPopupLarge(this,'{{ route('admin.order.user.order.list.view',[$user->user_id,$for_date]) }}')" title="" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
			</td> --}}
		</tr>
		@endforeach
		
	</tbody>
</table>
 