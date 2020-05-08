
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
			
		</div>
		<div class="modal-body"> 
      <div class="row">
        <form action="{{ route('admin.delivery.finance.userList.payment.store',[$user_id,$user_type_id]) }}" method="post"  class="add_form" button-click="btn_close">
          {{ csrf_field() }}
         <div class="col-lg-6 form-group">
          <label>Amount</label>
           <input type="number" name="amount"  class="form-control">
         </div>
         <div class="col-lg-6 form-group">
          <label>Transaction Type</label>          
           <select name="transaction_type" class="form-control">
             <option value="1" {{ $user_type_id==3?'selected':'' }}>Received</option>
             <option value="2" {{ $user_type_id==2?'selected':'' }}>Paid</option>
              
           </select>
         </div>
        <div class="text-center">
          <div class="col-lg-12 form-group">
          
          <input type="submit" name="Submit" class="btn btn-success">
           </div>
        </div>
        </form>
      </div>
		</div> 
	</div>
</div>
