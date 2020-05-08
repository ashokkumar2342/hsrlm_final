 <form action="{{ route('admin.vender.passbook.table') }}" method="post"  class="add_form" button-click="btn_close" success-content-id="passbook_list" no-reset="true">
 	{{ csrf_field() }}
 <div class="row">  
    <div class="col-lg-4 form-group">
    <label>Form Date</label>
        <input type="date" class="form-control"  name="from_date" >
    </div> 
    <div class="col-lg-4 form-group">
    <label>To Date</label>
        <input type="date" class="form-control" name="to_date">
    </div>
    <div class="col-lg-4 form-group"><br>
     <input type="submit" name="submit" value="Show" class="form-control btn btn-success">
        
    </div>  
    <div class="col-lg-12" id="passbook_list"> 
    </div>  
</div>
</form>

