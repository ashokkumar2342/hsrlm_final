@extends('admin.layout.base')
@section('body')
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">User Bank List</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-lg-4">
                    <label>User Id</label>
                    <input type="text" id="user_id" name="user_id" placeholder="Enter User Id" class="form-control">
                </div>
                <div class="col-lg-3">
                    <button onclick="callAjax(this,'{{ route('admin.master.show.bank.details') }}'+'?user_id='+$('#user_id').val(),'add_bank_details_form')" success-popup="true" class="btn btn-success" style="margin-top: 24px">Show</button>
                </div>
            </div>
            <div style="margin-top: 50px" class="col-lg-12" id="add_bank_details_form">
                
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

    $('#btn_village_list_table_show').click();
</script>
@endpush