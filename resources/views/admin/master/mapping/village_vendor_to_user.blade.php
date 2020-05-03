 <div class="col-lg-6"> 
 {{ Form::label('Vendor','Vendor',['class'=>' control-label']) }} <br>
<select class="multiselect" multiple="multiple"  name="vendor[]" > 
  @foreach ($to_users as $user) 
    <option value="{{ $user->id }}"{{ in_array($user->id, $VillageFarmerMap)?'selected':'' }}>{{ $user->first_name }}</option>     
  @endforeach 
</select> 
</div>
 <div class="col-md-1" style="margin-top: 24px"> 
 <button type="submit"  class="btn btn-success">Save</button>  
  
   
 </div>
<div class="col-md-1" style="margin-top: 24px"> 
  
  <a href="{{ route('admin.village.vendor.report',$user_id) }}" class="btn btn-primary" target="blank" title="">PDF</a>
  
   
 </div> 
 
 
 @include('admin.master.mapping.user_mapped')

 
        

</div> 
