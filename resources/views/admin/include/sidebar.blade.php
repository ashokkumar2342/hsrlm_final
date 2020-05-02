<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
 
  
    <ul class="sidebar-menu" style="height:1030px;overflow: auto">
       
        {{-- <li class="header">MAIN NAVIGATION</li> --}}
        <li ><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> 
       @if (Auth::guard('admin')->user()->user_type_id==1)
           <li>
            <a href="{{ route('admin.account.user.list') }}">
              <i class="fa fa-th"></i> <span>User</span>
               
            </a>
          </li>
              
            
 
           <li class="treeview">
               <a href="#">
                   <i class="fa fa-user text-danger"></i>
                   <span>Master</span>
                   <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                   </span>
               </a>
               <ul class="treeview-menu">
                   <li><a href="{{ route('admin.master.village.list') }}"><i class="fa fa-circle-o"></i>  Add Village</a></li> 
                   <li><a href="{{ route('admin.master.items.list') }}"><i class="fa fa-circle-o"></i>  Add Items</a></li> 
               </ul>

           </li>
           <li class="treeview">
               <a href="#">
                   <i class="fa fa-user text-danger"></i>
                   <span>Maping</span>
                   <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                   </span>
               </a>
               <ul class="treeview-menu">
                   <li><a href="{{ route('admin.village.farmer') }}"><i class="fa fa-circle-o"></i>Village SHG -> Farmer</a></li> 
                   <li><a href="{{ route('admin.village.vendor') }}"><i class="fa fa-circle-o"></i>Village SHG -> Vendor</a></li> 
                   <li><a href="{{ route('admin.cluster.village') }}"><i class="fa fa-circle-o"></i>Cluster SHG -> Village SHG</a></li> 
                   <li><a href="{{ route('admin.delivery.village') }}"><i class="fa fa-circle-o"></i>Delivery  <-> Village/Cluster SHG </a></li> 
               </ul>
           </li>
        @endif 
         
 
          
         
         </ul>

   

         
         
        
        
   
        
        
     
</section>
<!-- /.sidebar -->
</aside>

<!-- =============================================== -->
