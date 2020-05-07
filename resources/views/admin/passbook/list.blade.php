 <div class="row"> 
    <div class="col-lg-4 form-group">
    <label>For Date</label>
        <input type="date" value = "{{date('Y-m-d')}}" class="form-control item" id="p_for_date" name="for_date" onchange="callAjax(this,'{{ route('admin.vender.passbook.table') }}'+'?for_date='+$('#p_for_date').val(),'passbook_list')" success-popup="true">
    </div>  
    <div class="col-lg-12" id="passbook_list"> 
    </div>  
</div>

