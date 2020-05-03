@extends('admin.layout.base')
@section('body')
<section class="content">
    
    <div class="box">
         
        <div class="box-body">
            <form action="{{ route('admin.master.rate.list.price.store') }}" method="post" class="add_form" no-reset="true">
            {{ csrf_field() }}
            <div class="row"> 
                <div class="col-lg-4 form-group">
                <label>For Date</label>
                    <input type="date" class="form-control" id="for_date" name="for_date" onchange="callAjax(this,'{{ route('admin.master.rate.list.price') }}'+'?clone_previous_rate='+$('#clone_previous_rate').val()+'&for_date='+$('#for_date').val(),'rate_list')" success-popup="true">
                </div>

                <div class="col-lg-2 form-group">
                      <label>Clone Previous Rate</label>
                    <select name="clone_previous_rate" id="clone_previous_rate" class="form-control" onchange="callAjax(this,'{{ route('admin.master.rate.list.price') }}'+'?clone_previous_rate='+$('#clone_previous_rate').val()+'&for_date='+$('#for_date').val(),'rate_list')" success-popup="true">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                         
                    </select>
                     
                  
                </div>
            </div>
            <div class="row">  
                <div class="col-lg-12" id="rate_list">
                    
                </div>
            </div>
            
        </form>
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