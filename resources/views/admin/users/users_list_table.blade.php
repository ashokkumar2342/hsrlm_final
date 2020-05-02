<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="user_list_datatable">
		<thead>
			<tr>
				<th class="text-nowrap">First Name</th>
				<th class="text-nowrap">Last Name</th>
				<th class="text-nowrap">User Type</th>
				<th class="text-nowrap">User id</th>
				<th class="text-nowrap">Mobile No.</th>
				<th class="text-nowrap">Village</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td>{{ $user->first_name }}</td>
				<td>{{ $user->last_name }}</td>
				<td>{{ $user->userType->name or '' }}</td>
				<td>{{ $user->user_id }}</td>
				<td>{{ $user->mobile_no }}</td>
				<td>{{ $user->village->name or '' }}</td>
				<td>
					<a onclick="callPopupLarge(this,'{{ route('admin.account.add.user',Crypt::encrypt($user->id))}}')" title="Edit" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
					<a href="" title="Edit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>