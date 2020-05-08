@extends('admin.layout.base')
@section('body')
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Payment</h3>
        </div>
        <div class="box-body">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" id="farmer_btn" onclick="callAjax(this,'{{ route('admin.delivery.finance.userList',2) }}','home')">Farmer</a></li>
              <li><a data-toggle="tab" onclick="callAjax(this,'{{ route('admin.delivery.finance.userList',3) }}','home')">Vendor</a></li>
              
            </ul>
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
              
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
   

    $('#farmer_btn').click();
</script>
@endpush