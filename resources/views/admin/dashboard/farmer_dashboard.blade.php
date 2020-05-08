   @extends('admin.layout.base')
 @push('links')
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 @endpush
@section('body')
<section class="content"> 
    <div class="box">
     <div class="box-body"> 
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Items List </a></li>
  <li><a data-toggle="tab" href="#menu1" select-triger="p_for_date" onclick="callAjax(this,'{{ route('admin.vender.passbook') }}','menu1')">Passbook</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <form action="{{ route('admin.master.rate.list.price.farmer.store') }}" method="post" class="add_form" no-reset="true" select-triger="for_date">
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
  </div>
  </form>
  <div id="menu1" class="tab-pane fade">
    
  
  </div>
</div>

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
