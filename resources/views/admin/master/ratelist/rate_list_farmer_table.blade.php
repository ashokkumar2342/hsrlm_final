
 <table class="table table-striped table-bordered table-hover" id="items_table">
    <thead>
        <tr>
            <th class="text-nowrap">Items</th>  
            <th class="text-nowrap">Rate</th>
            <th class="text-nowrap">Quantity</th>             
            <th class="text-nowrap">Total</th>             
        </tr>
    </thead>
    <tbody>
        @foreach ($Items as $Item)
        @php
        	 $RateList=App\Model\RateList::where('for_date',$date)->where('items_id',$Item->id)->first(); 
        	 $purchase_rate =0; 
           $rate =0; 
          	 if (!empty($RateList)){ 
              $users =Auth::guard('admin')->user();
              $transaction=App\Model\Transaction::where('user_id',$users->id)->where('for_date',$date)->where('item_id',$Item->id)->first(); 
              if(!empty($transaction)){
               $Qty=$transaction->qty;
               $transaction_id=$transaction->id;
               $rate =$transaction->rate;
              }else{
                $Qty=0;
                $transaction_id='';
              } 
              if ($users->user_type_id==2){
                $purchase_rate = $RateList->purchase_rate;
              }elseif($users->user_type_id==3){
                $purchase_rate = $RateList->sale_rate;
              } 
              $p_tolal=$Qty*$rate;
        	 }  
        @endphp
        <tr>
           
            <input type="hidden" name="transaction_id[{{ $Item->id }}]" value="{{ @$transaction_id }}">
            <td>
                @php
             $itemsImage = route('admin.master.items.image',$Item->picture); 
            @endphp
                 <img  src="{{ ($Item->picture)? $itemsImage : asset('profile-img/user.png') }}" width="50px">
                <h5> {{ $Item->name }}</h5>                
            </td>
            
           
            <td> 
            	 <b>{{ $purchase_rate }}</b>
               <input type="hidden" class="form-control" style="width:60px"   value="{{ $purchase_rate }}" required="" name="rate[{{ $Item->id }}]" id="rate">
            </td>
             <td>
            	<input type="number" class="form-control item" style="width:60px"   value="{{ @$Qty}}" required="" name="units[{{ $Item->id }}]" id="p_rate_{{ $Item->name }}" oninput="calcPrice(this.value,{{ $purchase_rate }},'p_total_{{ $Item->id }}')">
                {{-- <input type="number" class="form-con   trol item" style="width:60px"   value="0" required="" name="purchage_rate[]" id="purchage_rate{{ $Item->id }}"> --}}
            </td>
            <td>
                <span id="p_total_{{ $Item->id }}">{{ @$p_tolal }}</span>
                <input type="hidden" class="form-control sub_total_item" style="width:60px"   value="{{ @$p_tolal }}" required="" name="sub_p_total_[{{ $purchase_rate }}]" id="sub_p_total_{{ $Item->id }}">
            </td>

             
             
        </tr>
        @endforeach
         
    </tbody>
</table> 
 
<div class="text-center">
	<input type="submit" name="Submit" class="btn btn-success">
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
            $("#total_units").html(calculated_total_sum);
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
            $("#total_units").html(calculated_total_sum);


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