 <div class="col-lg-4">
 @if ($conditionid2==4)
 {{ Form::label('Village SHG','Village SHG',['class'=>' control-label']) }} <br>
  @else
  {{ Form::label('Cluster SHG','Cluster SHG',['class'=>' control-label']) }} <br>	
  @endif 
<select class="multiselect" multiple="multiple"  name="cluster_village_id[]" > 
  @foreach ($to_users as $user) 
    <option value="{{ $user->id }}"{{ in_array($user->id, $VillageFarmerMap)?'selected':'' }}>{{ $user->first_name }}</option>     
  @endforeach 
</select> 
</div>
 <div class="col-md-1" style="margin-top: 24px"> 
 <button type="submit"  class="btn btn-success">Save</button>  
  
   
 </div>
 <div class="col-md-1" style="margin-top: 24px"> 
  
  <a href="{{ route('admin.village.cluster.delevery.report',[$user_id,$conditionid2]) }}" class="btn btn-primary" target="blank" title="">PDF</a>
  
   
 </div>    
 
 
 @include('admin.master.mapping.user_mapped')

 
        

</div> 
