@extends('admin.layout.base')
@section('body')
<section class="content">
    
    <div class="box">
         
        <div class="box-body">
            <form action="{{ route('admin.master.items.store',@$Itemsss->id) }}" method="post" class="add_form" button-click="btn_village_list_table_show,btn_close">
            {{ csrf_field() }}
            <div class="row"> 
                <div class="col-lg-4 form-group">
                <label>For Date</label>
                    <input type="date" class="form-control" name="for_date" onclick="callAjax(this,'{{ route('admin.master.rate.list.price') }}','rate_list')">
                </div>
                <div class="col-lg-8 form-group">
                </div>
            </div>
            <div class="row" id="rate_list">  
                
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