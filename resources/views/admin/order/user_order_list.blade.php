@php
	$All_Qty=App\Model\Transaction::where('for_date',$for_date)->sum('qty');
@endphp
<div class="col-lg-2"style="margin-top: 24px">
	<span >Total Quantity : <b>{{ $All_Qty }}</b></span>
</div>
</br>
<div class="col-lg-12 table-responsive"> 
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Name</th>
			<th>Rate</th>
			<th>Quantity</th>
			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($user_ids as $user_id)
		@php
		    $Quantity=App\Model\Transaction::where('for_date',$for_date)->whereIn('user_id',$user_id)->sum('qty');
		    $rate=App\Model\Transaction::where('for_date',$for_date)->whereIn('user_id',$user_id)->sum('rate');
		@endphp
		<tr>
			<td>{{ $user_id->users->first_name or '' }}</td>
			<td>{{ $rate }}</td>
			<td>{{ $Quantity }}</td>
			<td>
				<a href="#" onclick="callPopupLarge(this,'{{ route('admin.order.user.order.list.view',[$user_id->user_id,$for_date]) }}')" title="" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
			</td>
		</tr>
		@endforeach
		
	</tbody>
</table>
</div>