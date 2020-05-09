<!DOCTYPE html>
<html>
<head>
  <title>

  </title>
  <style type="text/css" media="screen">
    @page{
        margin:0px
    }
    
    .page-breck{
      page-break-before:always; 
    } 
    li{
        font-size: 14px; 
        margin-left: 20px; 
    }
    .fontBold{
        font:12;
        font-weight: 600;
        padding-top: 5px
    }
    table td{
        padding-left: 5px;
        padding-bottom: 5px;
    }
</style>
</head>
 @include('admin.include.boostrap')
<body>
{{--  @include('admin.student.studentdetails.pdf_page_count') --}}
 
<div class="container">
  	
 
     @foreach ($users as $user)
     	@php
     		 $Transactions=App\Model\Transaction::where('for_date',$for_date)
                                ->where('user_type_id',$user_type_id)
                                ->where('user_id',$user->id)
                                ->get();
            $Transaction=App\Model\Transaction::where('for_date',$for_date)
                                ->where('user_type_id',$user_type_id)
                                ->where('user_id',$user->id)
                                ->first();
            $total =0;
     	@endphp
     	<div class="text-center">
     		<h1>Jhajjar Mahila Federation</h1>
     	</div>
     	<table class="table-bordered table-striped table">
     		 
     		<tbody>
     			<tr>
     				<td>Name :  {{ $user->first_name }} {{ $user->last_name }}</td>
     				<td>Moble :  {{ $user->mobile_no }}</td>
     				<td>User Type :  {{ $user->userType->name or '' }}</td>
     				<td>order id :  {{ $Transaction->order_id }}</td>
     			</tr>
     			<tr>
     				<td colspan="3">Address :  </td>
     			 
     				 
     			</tr>
     		</tbody>
     	</table>
     	<table class="table-bordered table-striped table">
     		<thead>
     			<tr>
     				<th>Item</th>
     				<th>Rate</th>
     				<th>Qty</th>
     				<th>Total</th>
     			</tr>
     		</thead>
     		<tbody>
     			@foreach($Transactions as $itam)
     			<tr>
     				<td>{{ $itam->Items->name or '' }}</td>
     				<td>{{ $itam->rate }}</td>
     				<td>{{ $itam->qty  }}</td>
     				<td>{{ $itam->rate * $itam->qty }}</td>
     				 @php
     				 	  $total +=$itam->rate * $itam->qty;
     				 @endphp
     			</tr>
     			@endforeach
     			<tr>
     				<td></td>
     				<td></td>
     				<td>Grand Total</td>
     				<td>{{ $total }}</td>
     				 
     			</tr>
     		</tbody>
     	</table>
     	<div class="page-breck"></div> 
     @endforeach
 
</div>   
</body>
</html>
 