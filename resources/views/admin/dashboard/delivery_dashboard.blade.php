@extends('admin.layout.base')
@section('body')
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Order Lists</h3>
        </div>
        <div class="box-body">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Farmer</a></li>

              <li><a data-toggle="tab" href="#menu1" onclick="callAjax(this,'{{ route('delivery.order.list',3) }}','menu1')">Vendor</a></li>
              
            </ul>
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <div class="col-lg-4 form-group">
                <label>For Date</label>
                    <input type="date" class="form-control" id="for_date" value = "{{date('Y-m-d')}}" onchange="callAjax(this,'{{ route('admin.order.user.order.list',2) }}','user_type_order_list_show')" success-popup="true">
                </div>
              <div id="user_type_order_list_show">
                    
                </div>
              </div>
              <div id="menu1" class="tab-pane fade">
                
              </div>
              
            </div>
        </div>
    </div>
</section>
@endsection
@push('links')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
<script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#items_table').DataTable();
    });
    $("#for_date").trigger('change');

    $('#btn_village_list_table_show').click();
</script>
@endpush