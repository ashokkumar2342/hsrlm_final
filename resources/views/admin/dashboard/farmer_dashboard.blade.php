   @extends('admin.layout.base')
 @push('links')
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 @endpush
@section('body') 
{{-- <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
 </section> --}}
     <!-- Main content -->
   <section class="content"> 
   		<div class="box">
   			<div class="box-body">
   			    <form action="{{ route('admin.master.rate.list.price.farmer.store') }}" method="post" class="add_form" no-reset="true">
   			    {{ csrf_field() }}
   			    <div class="row"> 
   			        <div class="col-lg-4 form-group">
   			        <label>For Date</label>
   			            <input type="date" value = "{{date('Y-m-d')}}" class="form-control item" id="for_date" name="for_date" onchange="callAjax(this,'{{ route('admin.master.rate.list.price.farmer') }}'+'?for_date='+$('#for_date').val(),'rate_list')" success-popup="true">
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
@push('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script> --}}
<script src="{{ asset('admin_asset/plugins/chartjs/Chart.js') }}"></script>
<script src="{{ asset('admin_asset/dist/js/adminlte.min.js') }}"></script>
{{-- <script src="../../dist/js/adminlte.min.js"></script> --}}
<script>
	 
$("#for_date").trigger('change');
// function itemsSum(obj) {

//   var value =parseInt(this.value)
//   if (isNaN(value)) {
//     value =0
//   }
   
//   value += parseFloat(value);  
//    console.log(value);
         
// }

 
</script>
<script>
	// function itemsSum(obj) {
	// 	var calculated_total_sum = 0;
	//  	$.each(obj, function( index, value ) {  	 
	     	 
	//      	console.log(value);
	//      	if ($.isNumeric(get_textbox_value)) {
	//      	   calculated_total_sum += parseFloat(get_textbox_value);
	//      	   }  

	//  	}); 
	//       console.log(calculated_total_sum)      
	// }
// $(document).ready(function(){ 
// $("#items_table").on('input', '.item', function () {
//        var calculated_total_sum = 0;
     
//        $("#items_table .item").each(function () {
//            var get_textbox_value = $(this).val();
//            if ($.isNumeric(get_textbox_value)) {
//               calculated_total_sum += parseFloat(get_textbox_value);
//               }                  
//             });
//        console.log(calculated_total_sum)
//               // $("#total_sum_value").html(calculated_total_sum);
//        });

// });

</script>
</body>


@endpush
