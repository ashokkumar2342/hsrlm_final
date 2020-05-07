 
<div class="col-lg-5"> 
 {{ Form::label('Farmer','Farmer',['class'=>' control-label']) }} <br>
<select class="multiselect" multiple="multiple"  name="farmer_id[]" > 
  @foreach ($to_users as $user) 
    <option value="{{ $user->id }}"{{ in_array($user->id, $VillageFarmerMap)?'selected':'' }}>{{ $user->first_name }}</option>     
  @endforeach 
</select> 
</div>
 <div class="col-md-1" style="margin-top: 24px"> 
 <button type="submit"  class="btn btn-success">Save</button>  
  
   
 </div>
 <div class="col-md-2" style="margin-top: 24px"> 
  
  <a href="{{ route('admin.village.farmer.report',[$user_id,1]) }}" class="btn btn-default" target="blank" title="">PDF</a>

  
  <a href="{{ route('admin.village.farmer.report',[$user_id,2]) }}" class="btn btn-default" target="blank" title="">Excel</a>
  
   
 </div>    
 
 
 @include('admin.master.mapping.user_mapped')

 
        

</div> 
