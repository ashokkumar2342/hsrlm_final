<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="user_list_datatable">
		<thead>
			<tr>
				<th class="text-nowrap">Village Name</th>
				<th class="text-nowrap">Village Code</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($Villages as $Village)
			<tr>
				<td>{{ $Village->name }}</td>
				<td>{{ $Village->code }}</td>
				
				<td>
					<a onclick="callPopupLarge(this,'{{ route('admin.master.add.village',Crypt::encrypt($Village->id))}}')" title="Edit" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
					<a button-click="btn_village_list_table_show" success-popup="true" onclick="if (confirm('Are you Sure delete')){callAjax(this,'{{ route('admin.master.village.delete',Crypt::encrypt($Village->id))}}') } else{console_Log('cancel') }" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
					
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>