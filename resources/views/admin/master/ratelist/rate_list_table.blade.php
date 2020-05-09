 
<table class="table table-striped table-bordered table-hover" id="items_table">
    <thead>
        <tr>
            <th class="text-nowrap">Item Name</th>
            <th class="text-nowrap">Measurement</th>
            <th class="text-nowrap">Item Picture</th>
            <th class="text-nowrap">Previous Purchase</th>
            <th class="text-nowrap">Previous Sale</th>
            <th class="text-nowrap">Purchase Rate</th>
            <th class="text-nowrap">Sale Rate</th>             
        </tr>
    </thead>
    <tbody>
        @foreach ($Items as $Item)
        @php
        	 $RateList=App\Model\RateList::where('for_date',$date)->where('items_id',$Item->id)->first();
        	 $OldRateList=App\Model\RateList::where('for_date','<',$date)->where('items_id',$Item->id)->orderBy('for_date','DESC')->first();
        	 $purchase_rate =0;
        	 $sale_rate =0;

        	 $old_purchase_rate =0;
        	 $old_sale_rate =0;

        	 if (!empty($RateList)){ 
        	 $purchase_rate = $RateList->purchase_rate;
        	 $sale_rate = $RateList->sale_rate;
        	 } 

        	 if (!empty($OldRateList)){ 
        	 $old_purchase_rate = $OldRateList->purchase_rate;
        	 $old_sale_rate = $OldRateList->sale_rate;
        	 }

        	 if ($clone_previous_rate==1) {
        	 	 
        	 	$purchase_rate = $old_purchase_rate;
        	 	$sale_rate = $old_sale_rate;
        	 	 
        	 	 
        	 } 
        	
        	 
        	 
        @endphp
        <tr>
            <td>{{ $Item->name }}</td>
            <td>{{ $Item->measurements->short_name or '' }}</td>
            <td>
                @php
             $itemsImage = route('admin.master.items.image',$Item->picture); 
            @endphp
                 <img  src="{{ ($Item->picture)? $itemsImage : asset('profile-img/user.png') }}" width="50px">
            </td>
            <td>{{ $old_purchase_rate }}</td>
            <td>{{ $old_sale_rate }}</td> 
            <td> 
            	<input type="number" value="{{ $purchase_rate }}" required="" name="purchase_rate[{{ $Item->id }}]">
            </td>
             <td>
            	<input type="number" value="{{ $sale_rate }}" required="" name="sale_rate[{{ $Item->id }}]">
            </td>

             
             
        </tr>
        @endforeach
         
    </tbody>
</table>
<input type="hidden" name="status" id="status"> 
<div class="text-center">
	<input type="submit" name="Submit" value="Save As Draft" class="btn btn-warning" onclick="$('#status').val(0)">
    <input type="submit" name="Submit" value="Save Final" class="btn btn-success" onclick="$('#status').val(1)">
</div>
        
