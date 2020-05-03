 
<div class="col-lg-12" style="margin-top:10px;">
   @php
       $admin=App\User::find($user_id);
     @endphp  
        User  : <span style="color:#d02ee7 ;margin-bottom: 10px"><b>( {{ $admin->first_name or '' }} - {{ $admin->user_id or '' }} )</b></span> 
  <table class="table table-condensed "id="user_menu_table" style="width: 100%"> 
    <thead> 
      <tr>
        @if ($coditionId==4)
          <th>Cluster SHG</th>
          @else
          <th>Village SHG</th>
        @endif
        @if ($coditionId==2)
          <th>Farmer</th>
        @endif
        @if ($coditionId==3)
          <th>Vendor</th>
        @endif
        @if ($coditionId==4)
          <th>Village SHG</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($to_users as $to_user)
      <tr style="{{ in_array($to_user->id, $VillageFarmerMap)?'background-color: #95e49b':'background-color: #ec2020' }}">
        <td>{{ $admin->first_name or '' }}</td>
        <td>{{ $to_user->first_name }}</td>
            
        {{--  <td>@if ( in_array($subMenu->id, $usersmenus)) Yes @else  No @endif  </td>  --}}
    
      </tr>
      
       @endforeach  
      
    </tbody>
  </table>
</div>