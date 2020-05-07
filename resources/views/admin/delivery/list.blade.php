<div class="col-lg-4 form-group">
<label>For Date</label>
    <input type="date" class="form-control" id="d_for_date" value = "{{date('Y-m-d')}}" onchange="callAjax(this,'{{ route('delevery.order.user.order.list',3) }}','user_type_order_list_show_vender')" success-popup="true">
</div>
<div class="col-lg-12" id="user_type_order_list_show_vender">
    
</div>