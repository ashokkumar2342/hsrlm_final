@extends('admin.layout.base')
@section('body')
<section class="content">
    <div class="box">
        <div class="box-header">
            <button type="button" class="btn btn-sm btn-info pull-right" onclick="callPopupLarge(this,'{{ route('admin.master.add.village')}}')">Add User</button>
            <h3 class="box-title">Villages List</h3>
        </div>
        <button id="btn_village_list_table_show" hidden data-table="user_list_datatable" onclick="callAjax(this,'{{ route('admin.master.village.list.table') }}','div_user_list_table_show')">show </button>
        <div class="box-body" id="div_user_list_table_show"> 
            
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
        $('#').DataTable();
    });

    $('#btn_village_list_table_show').click();
</script>
@endpush