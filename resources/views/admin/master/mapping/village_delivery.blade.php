@extends('admin.layout.base')
@section('body')
<section class="content">
    <div class="box"> 
        <div class="box-body" id="div_user_list_table_show"> 
            <form action="{{ route('admin.delevery.village.store') }}" method="post" class="add_form form-horizontal" accept-charset="utf-8" no-reset="true" select-triger="user_select_box"> 
                  {{ csrf_field() }}

              <div class="col-lg-3">
                <label>Delivery</label>
                <select class="form-control" id="user_select_box"  multiselect-form="true"  name="delivery"  onchange="callAjax(this,'{{ route('admin.delevery.village.to.user') }}'+'?delivery='+$('#user_select_box').val()+'&cluster_village_shg='+$('#cluster_village_shg').val(),'user_map_list')" success-popup="true"> 
                           <option value="" disabled selected>Select User</option>
                          @foreach ($users as $user)
                               <option value="{{ $user->id }}">{{ $user->email }} &nbsp;&nbsp;&nbsp;&nbsp;( {{ $user->first_name }} )</option> 
                           @endforeach  
                </select> 
              </div>
               <div class="col-lg-2">
                    <label>Village/Cluster SHG</label>
                    <select name="cluster_village_shg" id="cluster_village_shg" multiselect-form="true"  class="form-control" onchange="callAjax(this,'{{ route('admin.delevery.village.to.user') }}'+'?delivery='+$('#user_select_box').val()+'&cluster_village_shg='+$('#cluster_village_shg').val(),'user_map_list')" success-popup="true">
                      <option selected disabled>Select Option</option>
                      <option value="4">Village SHG</option>
                      <option value="5">Cluster SHG</option>
                    </select>
                 </div>
               <div  id="user_map_list">  
                  
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
        $('#').DataTable();
    });

     
</script>
@endpush