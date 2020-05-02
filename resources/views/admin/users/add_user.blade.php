<div class="modal-content">
	<div class="modal-header">
		<button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">{{ @$users->id? 'Edit' : 'Add' }}  User </h4>
	</div>
	<div class="modal-body"> 
		<div class="box-body"> 
			<form action="{{ route('admin.account.user.store',@$users->id) }}" method="post" class="add_form" button-click="btn_user_list_table_show,btn_close">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-lg-3">
						<div class="form-group">
							<label>First Name</label><span class="fa fa-asterisk"></span>
							<input type="text" name="first_name" class="form-control" placeholder="Enter First Name" maxlength="100" value="{{ @$users->first_name }}">
						</div>                                
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" maxlength="50" value="{{ @$users->last_name }}">
						</div>                                
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>User Type</label>
							<span class="fa fa-asterisk"></span>
							<select class="form-control" name="user_type_id">
								@foreach($userTypes as $userType)
								<option value="{{ $userType->id }}" {{ @$users->roles->id == $userType->id ? 'selected="selected"' : '' }}>{{ $userType->name }}</option>  
								@endforeach 
							</select>
						</div>                               
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>User Id</label><span class="fa fa-asterisk"></span>
							<input type="text" name="user_id" class="form-control" value="{{ @$users->user_id }}" maxlength="10" placeholder="Enter User Id">
						</div>                                
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="Password">Password</label>
							<span class="fa fa-asterisk"></span>
							<input type="password" name="password" class="form-control"  maxlength="15" placeholder="Password" min="6">
						</div>                               
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Mobile No.</label>
							<span class="fa fa-asterisk"></span>
							<input type="text" name="mobile_no" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'  value="{{@$users->mobile_no }}" placeholder="Enter Mobile No.">
						</div>                                
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label>Village</label>
							<span class="fa fa-asterisk"></span>
							<select class="form-control" name="village">
								@foreach($Villages as $Village)
								<option value="{{ $Village->id }}" {{ @$users->roles->id == $Village->id ? 'selected="selected"' : '' }}>{{ $Village->name }}</option>  
								@endforeach 
							</select>
						</div>                                
					</div>
				</div> 
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

