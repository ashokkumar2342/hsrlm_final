 <div class="col-lg-6"> 
 {{ Form::label('Cluster SHG','Cluster SHG',['class'=>' control-label']) }} <br>
<select class="multiselect" multiple="multiple"  name="cluster[]" > 
  @foreach ($to_users as $user) 
    <option value="{{ $user->id }}"{{ in_array($user->id, $VillageFarmerMap)?'selected':'' }}>{{ $user->first_name }}</option>     
  @endforeach 
</select> 
</div>
 <div class="col-md-1" style="margin-top: 24px"> 
 <button type="submit"  class="btn btn-success">Save</button>  
  
   
 </div>   
 
 
 @include('admin.master.mapping.user_mapped')

 
        

</div> 
