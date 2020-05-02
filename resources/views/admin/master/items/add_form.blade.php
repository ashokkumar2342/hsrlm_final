
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">{{ @$Items->id? 'Edit' : 'Add' }} Items</h4>
		</div>
		<div class="modal-body"> 
			<form action="{{ route('admin.master.items.store',@$Items->id) }}" method="post" class="add_form" button-click="btn_village_list_table_show,btn_close" content-refresh="items_table">
				{{ csrf_field() }}
				<div class="row"> 
					<div class="col-lg-12 form-group">
						<label>Items Name</label><span class="fa fa-asterisk"></span>
						<input type="text" name="items_name" class="form-control" placeholder="Enter Items Name" value="{{ @$Items->name }}" maxlength="100"> 
					</div>
					<div class="col-lg-12 form-group">
						<label>Measurement</label><span class="fa fa-asterisk"></span>
						 <select name="measurement" class="form-control">
						 	@foreach ($measurements as $measurement)
						 		<option value="{{ $measurement->id }}">{{ $measurement->short_name }}</option> 
						 	@endforeach
						 	
						 	 
						 </select>
					</div>
					<div class="col-lg-12 form-group">
						<label>Items Picture</label>
						@if (empty($Items))
							<span class="fa fa-asterisk"></span> 
						@endif
						
						<input type="file" name="items_picture" {{ empty($Items)?'required':'' }} class="form-control" accept="image/x-png,image/gif,image/jpeg"> 
					</div>
					<div class="col-lg-12 text-center" style="padding-top: 10px">
						<input type="submit" class="btn btn-success">
					</div> 
				</div> 
			</form>
		</div> 
	</div>
</div>

