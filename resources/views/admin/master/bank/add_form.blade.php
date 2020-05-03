<div class="modal-dialog" style="width:90%"> 
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body"> 
      <form action="{{ route('admin.master.store.bank.details') }}" method="post" class="add_form" button-click="btn_close">
        {{ csrf_field() }} 
        <div class="row">
          <div class="col-lg-6">
              <div class="panel panel-default">
                 <div class="panel-heading" style="font-size: 20px">Contact Details</div>
                    <div class="panel-body">
                      <div class="col-lg-6 form-group">
                          <label>Email</label><span class="fa fa-asterisk"></span>
                          <input type="email" name="email" class="form-control" placeholder="Enter Email" maxlength="100" value="{{ @$Employee->email }}"> 
                      </div>
                      <div class="col-lg-6 form-group">
                          <label>Country</label><span class="fa fa-asterisk"></span>
                          <select name="country" class="form-control" placeholder="Enter country">
                              <option value="1"{{ @$Employee->country==1?'selected': '' }}>India</option>
                              <option value="0"{{ @$Employee->country==0?'selected': '' }}>Other Country</option> 
                          </select>
                      </div>
                      <div class="col-lg-6 form-group">
                          <label>State</label><span class="fa fa-asterisk"></span>
                          <input type="text" name="state" class="form-control" placeholder="Enter State" maxlength="100" value="{{ @$Employee->state }}"> 
                      </div>
                      <div class="col-lg-6 form-group">
                          <label>City</label><span class="fa fa-asterisk"></span>
                          <input type="text" name="city" class="form-control" placeholder="Enter City" maxlength="100" value="{{ @$Employee->city }}"> 
                      </div>
                      <div class="col-lg-12 form-group">
                          <label>Current Address</label><span class="fa fa-asterisk"></span>
                          <textarea name="current_address" class="form-control" style="height: 36px" maxlength="200" placeholder="Enter Current Address">{{ @$Employee->current_address }}</textarea>
                      </div>
                      <div class="col-lg-12 form-group">
                          <label>Permanent Address</label><span class="fa fa-asterisk"></span>
                          <textarea name="permanent_address" class="form-control" style="height: 36px" maxlength="200" placeholder="Enter Permanent Address">{{ @$Employee->permanent_address }}</textarea>
                      </div>
                      <div class="col-lg-12 form-group">
                          <label>Pincode</label><span class="fa fa-asterisk"></span>
                          <input type="text" name="pincode" class="form-control" placeholder="Enter City" maxlength="6" value="{{ @$Employee->pincode }}"> 
                      </div> 
                    </div>
                 </div>
                 </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px">User Bank Details</div>
                    <div class="panel-body">
                    <div class="row">
                  <div class="col-lg-6 form-group">
                    <label>User Name</label>
                    <select name="user_id" class="form-control">
                       <option selected disabled>Select Bank</option>
                       @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }}</option>      
                        @endforeach 
                    </select> 
                  </div>
                  <div class="col-lg-6 form-group">
                    <label>Bank Name</label>
                    <select name="bank_name" class="form-control" id="select_employee_name">
                       <option selected disabled>Select Employee</option> 
                    </select> 
                  </div>
                  <div class="col-lg-6 form-group">
                    <label>IFSC Code</label>
                    <input type="text" name="ifsc_code" class="form-control" maxlength="50"> 
                   </div>
                   <div class="col-lg-6 form-group">
                    <label>Account No.</label>
                    <input type="text" name="account_no" class="form-control" maxlength="50"> 
                   </div>
                   <div class="col-lg-6 form-group">
                    <label>Branch</label>
                    <input type="text" name="branch" class="form-control" maxlength="50"> 
                   </div>
                   <div class="col-lg-6 form-group">
                    <label>Bank Address</label>
                    <input type="text" name="bank_address" class="form-control" maxlength="200"> 
                   </div> 
                </div>  
              </div>
            </div>
            </div>

                <div class="col-lg-12 text-center form-group"> 
                    <input type="submit"  class="btn btn-success" style="margin-top: 20px"> 
                </div> 
        </form>
     </div>
   </div>
</div>





