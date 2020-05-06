
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
			<h5 class="modal-title" >Qty. :  <b><span id="d_total_units"></span></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Rs : <b><span id="total_price"></span></b></h5>
		</div>
		<div class="modal-body">
      @php
        $userDetails =App\User::find($user_id);
      @endphp
        <span>User Name : <b>{{ $userDetails->first_name }}</b></span></br> 
        <span>Mobile No. : <b>{{ $userDetails->mobile_no }}</b></span>
<form action="{{ route('delevery.order.user.order.store',$for_date) }}" method="post" class="add_form">
<div class="table-responsive">
 <table class="table table-striped table-bordered table-hover" id="items_table">
    <thead>
        <tr>
            <th class="text-nowrap">Items</th>  
            <th class="text-nowrap">Rate</th>
            <th class="text-nowrap">Qty.</th>             
            <th class="text-nowrap">Total</th>             
        </tr>
    </thead>
    <tbody>
        @foreach ($orderLists as $orderList)
        @php
        	 $RateList=App\Model\RateList::where('for_date',$for_date)->where('items_id',$orderList->item_id)->first(); 
        	 $purchase_rate =0; 
          	 if (!empty($RateList)){ 
              $user_type_id =Auth::guard('admin')->user()->user_type_id;
               $transaction=App\Model\Transaction::where('user_id',$user_id)->where('for_date',$for_date)->where('item_id',$orderList->item_id)->first(); 
              if(!empty($transaction)){
               $Qty=$transaction->qty;
               $transaction_id=$transaction->id;
               $rate =$transaction->rate;
              }else{
                $Qty=0;
                $transaction_id='';
              } 
              if ($user_type_id==2){
                $purchase_rate = $RateList->purchase_rate;
              }elseif($user_type_id==3){
                $purchase_rate = $RateList->sale_rate;
              }
              $p_tolal=$Qty*$rate; 
        	 }  
        @endphp
        <tr>
           
            
            <td>
            @php
              $Items_pic=App\Model\Item::where('id',$orderList->item_id)->get();
             $itemsImage = route('admin.master.items.image',$Items_pic->first()->picture);
             
            @endphp
                 <img  src="{{ ($Items_pic->first()->picture)? $itemsImage : asset('profile-img/user.png') }}" width="50px">
                <h5> {{ $orderList->Items->name or ''}}</h5>                
            </td>
            
               <input type="hidden" class="form-control" style="width:60px"   value="{{ $orderList->order_id }}" required="" name="order_id[{{ $orderList->item_id }}]">

               <input type="hidden" class="form-control" style="width:60px"   value="{{ $orderList->rate }}" required="" name="rate[{{ $orderList->item_id }}]" id="rate">
           
            <td> 
            	 <b>{{ $orderList->rate }}</b>
            </td>
             <td>
            	<input type="number" class="form-control item" style="width:60px"   value="{{ $orderList->qty }}" required="" name="units[{{ $orderList->item_id }}]" id="p_rate_{{ $orderList->item_id }}" oninput="calcPrice(this.value,{{ $orderList->rate }},'p_total_{{ $orderList->item_id}}')">
                {{-- <input type="number" class="form-con   trol item" style="width:60px"   value="0" required="" name="purchage_rate[]" id="purchage_rate{{ $Item->id }}"> --}}
            </td>
            <td>
                <span id="p_total_{{ $orderList->item_id }}">{{ $p_tolal }}</span>
                <input type="hidden" class="form-control sub_total_item" style="width:60px"   value="{{ $p_tolal }}" required="" name="sub_p_total_[{{ $orderList->item_id }}]" id="sub_p_total_{{ $orderList->item_id }}">
            </td>

             
             
        </tr>
        @endforeach
         
    </tbody>
</table>
</div>
<div class="text-center">
  <input type="submit" name="Submit" class="btn btn-success">
</div>
</form>
		</div> 
	</div>
</div>
<script>
    $(document).ready(function () { 
        $("#items_table").on('input', '.item', function () { 
           var calculated_total_sum = 0; 
           $("#items_table .item").each(function () { 
               var get_textbox_value = $(this).val(); 
               if ($.isNumeric(get_textbox_value)) {
                  calculated_total_sum += parseFloat(get_textbox_value);
                  }                  
                }); 
            $("#d_total_units").html(calculated_total_sum);
        });
    });
    $(document).ready(function () {          
           var calculated_total_sum = 0; 
           $("#items_table .item").each(function () { 
               var get_textbox_value = $(this).val(); 
               if ($.isNumeric(get_textbox_value)) {
                  calculated_total_sum += parseFloat(get_textbox_value);
                  }                  
                }); 
            $("#d_total_units").html(calculated_total_sum);


        });  
     
     
    $(document).ready(function () {
        $("#items_table").on('input', '.item', function () { 
           var p_calculated_total_sum = 0; 
           $("#items_table .sub_total_item").each(function () { 
               var get_textbox_value = $(this).val(); 
               if ($.isNumeric(get_textbox_value)) {
                  p_calculated_total_sum += parseFloat(get_textbox_value);
                  }                  
                }); 
            $("#total_price").html(p_calculated_total_sum);
        });
    });
    $(document).ready(function () { 
        
           var p_calculated_total_sum2 = 0; 
           $("#items_table .sub_total_item").each(function () { 
               var get_textbox_value = $(this).val(); 
               if ($.isNumeric(get_textbox_value)) {
                  p_calculated_total_sum2 += parseFloat(get_textbox_value);
                  }                  
                }); 
            $("#total_price").html(p_calculated_total_sum2);
        });
   
    
  
function calcPrice(unit,price,div_id){
    var total = unit * price; 
    
    $("#"+div_id).html(total);
    $("#sub_"+div_id).val(total);

}
</script>
