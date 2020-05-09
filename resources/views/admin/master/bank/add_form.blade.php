 <form action="{{ route('admin.master.store.bank.details') }}" method="post" class="add_form" button-click="btn_close">
        {{ csrf_field() }} 
        <div class="row">
          <div class="col-lg-6">
              <div class="panel panel-default">
                 <div class="panel-heading" style="font-size:13px;height: 30px">Contact Details</div>
                    <div class="panel-body">
                      <div class="col-lg-6 form-group">
                          <label>User Name</label><span class="fa fa-asterisk"></span>
                          <input type="text" name="user_name" class="form-control" placeholder="Enter User Name" maxlength="100" value="{{ @$user->first_name }}">
                          <input type="hidden" name="user_id" value="{{ @$user->id }}"> 
                      </div>
                      <div class="col-lg-6 form-group">
                          <label>Date of Birth</label>
                          <input type="date" name="dob" class="form-control" value="{{ @$userdetail->dob }}"> 
                      </div>
                      <div class="col-lg-6 form-group">
                          <label>Gender</label><span class="fa fa-asterisk"></span>
                          <select name="gender" class="form-control">
                            <option selected disabled>Select Gender</option>
                            <option value="1"{{ @$userdetail->gender==1?'selected' :'' }}>Male</option>
                            <option value="2"{{ @$userdetail->gender==2?'selected' :'' }}>Female</option>
                          </select>
                      </div>
                      <div class="col-lg-6 form-group">
                          <label>City</label>
                          <input type="text" name="city" class="form-control" placeholder="Enter City" maxlength="100" value="{{ @$userdetail->city }}"> 
                      </div>
                      <div class="col-lg-12 form-group">
                          <label>Current Address</label>
                          <textarea name="current_address" class="form-control" style="height: 36px" maxlength="200" placeholder="Enter Current Address">{{ @$userdetail->c_address }}</textarea>
                      </div>
                      <div class="col-lg-12 form-group">
                          <label>Permanent Address</label>
                          <textarea name="permanent_address" class="form-control" style="height: 36px" maxlength="200" placeholder="Enter Permanent Address">{{ @$userdetail->p_address }}</textarea>
                      </div>
                      <div class="col-lg-12 form-group">
                          <label>Pincode</label>
                          <input type="text" name="pincode" class="form-control" placeholder="Enter City" maxlength="6" value="{{ @$userdetail->pincode }}"> 
                      </div> 
                    </div>
                 </div>
                 </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:13px;height: 30px">User Bank Details</div>
                    <div class="panel-body" style="height:400px">
                    <div class="row">
                  <div class="col-lg-6 form-group">
                    <label>Bank Name</label><span class="fa fa-asterisk"></span>
                    <select name="bank_name" class="form-control">
                      <option selected disabled>Select Bank</option>
                      @foreach ($banks as $bank)
                       <option value="{{ $bank->id }}"{{ @$bankDetail->bank_id==$bank->id?'selected' :'' }}>{{ $bank->name }}</option> 
                      @endforeach
                    </select> 
                  </div>
                  <div class="col-lg-6 form-group">
                    <label>IFSC Code</label><span class="fa fa-asterisk"></span>
                    <input type="text" name="ifsc_code" class="form-control" maxlength="50" value="{{ @$bankDetail->ifsc_code }}"> 
                   </div>
                   <div class="col-lg-6 form-group">
                    <label>Account No.</label><span class="fa fa-asterisk"></span>
                    <input type="text" name="account_no" class="form-control" maxlength="50" value="{{ @$bankDetail->account_no }}"> 
                   </div>
                   <div class="col-lg-6 form-group">
                    <label>Branch</label><span class="fa fa-asterisk"></span>
                    <input type="text" name="branch" class="form-control" maxlength="50" value="{{ @$bankDetail->branch }}"> 
                   </div>
                   <div class="col-lg-12 form-group">
                    <label>Bank Address</label>
                    <textarea name="bank_address" class="form-control" maxlength="200">{{ @$bankDetail->bank_address }}</textarea>
                   </div> 
                </div>  
              </div>
            </div>
            </div>

                <div class="col-lg-12 text-center form-group"> 
                    <input type="submit"  class="btn btn-success" style="margin-top: 20px"> 
                </div> 
        </form>