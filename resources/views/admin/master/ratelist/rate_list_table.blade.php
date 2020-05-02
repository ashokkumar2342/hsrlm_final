
<table class="table table-striped table-bordered table-hover" id="items_table">
    <thead>
        <tr>
            <th class="text-nowrap">Item Name</th>
            <th class="text-nowrap">Measurement</th>
            <th class="text-nowrap">Item Picture</th>
            
             
        </tr>
    </thead>
    <tbody>
        @foreach ($Items as $Item)
        <tr>
            <td>{{ $Item->name }}</td>
            <td>{{ $Item->measurements->short_name or '' }}</td>
            <td>
                @php
             $itemsImage = route('admin.master.items.image',$Item->picture); 
            @endphp
                 <img  src="{{ ($Item->picture)? $itemsImage : asset('profile-img/user.png') }}" width="50px">
            </td>
             
        </tr>
        @endforeach
    </tbody>
</table>            
