@extends('admin.layout.base')
@section('body')
<section class="content">
    <div class="box"> 
        <div class="box-body" id="div_user_list_table_show"> 
            <form action="{{ route('admin.cluster.village.store') }}" method="post" class="add_form form-horizontal" accept-charset="utf-8" no-reset="true" select-triger="user_select_box"> 
                  {{ csrf_field() }}
               <div class="col-md-4">
                 <div class="form-group col-md-12">
                   {{ Form::label('Cluster SHG','Cluster SHG',['class'=>' control-label']) }}                         
                   <div class="form-group">  
                          <select class="form-control" id="user_select_box"  multiselect-form="true"  name="user"  onchange="callAjax(this,'{{ route('admin.cluster.village.to.user') }}'+'?id='+this.value,'user_map_list')" > 
                           <option value="" disabled selected>Select User</option>
                          @foreach ($users as $user)
                               <option value="{{ $user->id }}">{{ $user->email }} &nbsp;&nbsp;&nbsp;&nbsp;( {{ $user->first_name }} )</option> 
                           @endforeach  
                          </select> 
                     
                     </div>
                 </div> 
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