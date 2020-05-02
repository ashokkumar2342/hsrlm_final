 
<div class="col-lg-6"> 
 {{ Form::label('Farmer','Farmer',['class'=>' control-label']) }} <br>
<select class="multiselect" multiple="multiple"  name="to_user[]" > 
  @foreach ($to_users as $user) 
    <option value="{{ $user->id }}">{{ $user->first_name }}</option>     
  @endforeach 
</select> 
</div>
 <div class="col-md-1" style="margin-top: 24px"> 
 <button type="submit"  class="btn btn-success">Save</button>  
  
   
 </div>   
 
 
 {{-- @include('admin.master.mapping.user_mapped') --}}

 
        

</div> 
