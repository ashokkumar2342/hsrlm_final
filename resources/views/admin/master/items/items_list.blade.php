@extends('admin.layout.base')
@section('body')
<section class="content">
    <div class="box">
        <div class="box-header">
            <button type="button" class="btn btn-sm btn-info pull-right" onclick="callPopupLarge(this,'{{ route('admin.master.add.items')}}')">Add Item</button>
            <h3 class="box-title">Items List</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="items_table">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Item Name</th>
                            <th class="text-nowrap">Item Picture</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Items as $Item)
                        <tr>
                            <td>{{ $Item->name }}</td>
                            <td>
                                @php
                             $itemsImage = route('admin.master.items.image',$Item->picture); 
                            @endphp
                                 <img  src="{{ ($Item->picture)? $itemsImage : asset('profile-img/user.png') }}" class="profile-user-img img-responsive img-circle">
                            </td>
                            <td>
                                <a onclick="callPopupLarge(this,'{{ route('admin.master.add.items',Crypt::encrypt($Item->id))}}')" title="Edit" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                <a href="" title="Edit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
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