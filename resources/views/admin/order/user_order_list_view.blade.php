
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" id="btn_close" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"></h4>
		</div>
		<div class="modal-body"> 
<div class="table-responsive">
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
       {{--  @php
        	 $RateList=App\Model\RateList::where('for_date',$date)->where('items_id',$Item->id)->first(); 
        	 $purchase_rate =0; 
          	 if (!empty($RateList)){ 
              $user_type_id =Auth::guard('admin')->user()->user_type_id;
              if ($user_type_id==2){
                $purchase_rate = $RateList->purchase_rate;
              }elseif($user_type_id==3){
                $purchase_rate = $RateList->sale_rate;
              } 
        	 }  
        @endphp --}}
        <tr>
           
            
            <td>
            @php
              $Items_pic=App\Model\Item::where('id',$Item->item_id)->get();
             $itemsImage = route('admin.master.items.image',$Items_pic->first()->picture);
             
            @endphp
                 <img  src="{{ ($Items_pic->first()->picture)? $itemsImage : asset('profile-img/user.png') }}" width="50px">
                <h5> {{ $Item->Items->name or ''}}</h5>                
            </td>
            
           
            <td> 
            	 <b>{{ $Item->rate }}</b>
               {{-- <input type="hidden" class="form-control sub_total_item" style="width:60px"   value="{{ $purchase_rate }}" required="" name="rate[{{ $Item->id }}]" id="rate"> --}}
            </td>
             <td>{{ $Item->qty }}
            	{{-- <input type="number" class="form-control item" style="width:60px"   value="0" required="" name="units[{{ $Item->id }}]" id="p_rate_{{ $Item->name }}" oninput="calcPrice(this.value,{{ $purchase_rate }},'p_total_{{ $Item->id }}')"> --}}
                {{-- <input type="number" class="form-con   trol item" style="width:60px"   value="0" required="" name="purchage_rate[]" id="purchage_rate{{ $Item->id }}"> --}}
            </td>
            <td>{{ $Item->qty*$Item->rate }}
                {{-- <span id="p_total_{{ $Item->id }}"></span>
                <input type="hidden" class="form-control sub_total_item" style="width:60px"   value="0" required="" name="sub_p_total_[{{ $purchase_rate }}]" id="sub_p_total_{{ $Item->id }}"> --}}
            </td>

             
             
        </tr>
        @endforeach
         
    </tbody>
</table>
</div>
		</div> 
	</div>
</div>

