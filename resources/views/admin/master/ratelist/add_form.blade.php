
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">{{ @$Itemsss->id? 'Edit' : 'Add' }} Items</h4>
		</div>
		<div class="modal-body"> 
			<form action="{{ route('admin.master.items.store',@$Itemsss->id) }}" method="post" class="add_form" button-click="btn_village_list_table_show,btn_close">
				{{ csrf_field() }}
				<div class="row"> 
					<div class="col-lg-12 form-group">
						<label>Items</label><span class="fa fa-asterisk"></span>
						<select name="items" class="form-control">
							<option selected disabled>Select Items</option>
							@foreach ($Items as $Item)
							<option value="{{ $Item->id }}">{{ $Item->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-lg-12 form-group">
						<label>Items Name</label><span class="fa fa-asterisk"></span>
						<input type="text" name="items_name" class="form-control" placeholder="Enter Items Name" value="{{ @$Itemsss->name }}" maxlength="100"> 
					</div><div class="col-lg-12 form-group">
						<label>Items Name</label><span class="fa fa-asterisk"></span>
						<input type="text" name="items_name" class="form-control" placeholder="Enter Items Name" value="{{ @$Itemsss->name }}" maxlength="100"> 
					</div><div class="col-lg-12 form-group">
						<label>Items Name</label><span class="fa fa-asterisk"></span>
						<input type="text" name="items_name" class="form-control" placeholder="Enter Items Name" value="{{ @$Itemsss->name }}" maxlength="100"> 
					</div><div class="col-lg-12 form-group">
						<label>Items Name</label><span class="fa fa-asterisk"></span>
						<input type="text" name="items_name" class="form-control" placeholder="Enter Items Name" value="{{ @$Itemsss->name }}" maxlength="100"> 
					</div>
					<div class="col-lg-12 text-center" style="padding-top: 10px">
						<input type="submit" class="btn btn-success">
					</div> 
				</div> 
			</form>
		</div> 
	</div>
</div>

