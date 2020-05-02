
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">{{ @$Villages->id? 'Edit' : 'Add' }} Items</h4>
		</div>
		<div class="modal-body"> 
			<form action="{{ route('admin.master.village.store',@$Villages->id) }}" method="post" class="add_form" button-click="btn_village_list_table_show,btn_close">
				{{ csrf_field() }}
				<div class="row"> 
					<div class="col-lg-12 form-group">
						<label>Items Name</label>
						<input type="text" name="items_name" class="form-control" placeholder="Enter Items Name" value="{{ @$Villages->name }}" maxlength="100"> 
					</div>
					<div class="col-lg-12 form-group">
						<label>Items Picture</label>
						<input type="file" name="items_picture" class="form-control"> 
					</div>
					<div class="col-lg-12 text-center" style="padding-top: 10px">
						<input type="submit" class="btn btn-success">
					</div> 
				</div> 
			</form>
		</div> 
	</div>
</div>

