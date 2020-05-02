@extends('admin.layout.base')
@section('body')
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Rates List</h3>
        </div>
        <div class="box-body">
            <form action="{{ route('admin.master.items.store',@$Itemsss->id) }}" method="post" class="add_form" button-click="btn_village_list_table_show,btn_close">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-4 form-group">
                </div>
                <div class="col-lg-4 form-group">
                <label>For Date</label>
                    <input type="date" class="form-control" name="">
                </div>
                <div class="col-lg-4 form-group">
                </div>
            </div>
            @foreach ($Items as $Item)
            @php
            $itemsImage = route('admin.master.items.image',$Item->picture); 
            @endphp
            <div class="col-lg-4">
                
            <td>
            <img  src="{{ ($Item->picture)? $itemsImage : asset('profile-img/user.png') }}" class="profile-user-img img-responsive img-circle">
            </td>
            </div>
            @endforeach
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