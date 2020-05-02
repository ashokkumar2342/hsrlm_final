 
  <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>Dashboard</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Dashboard</b></span>
                
                
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                
                <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
          
           
         
            <button type="hidden" class="hidden" id="admin_photo_refrash" onclick="callAjax(this,'{{ route('admin.profile.photo.refrash') }}','photo_refrash')">img ShoW</button>
            <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
              <div id="photo_refrash">
                
              </div>
             
            </a>
            <ul class="dropdown-menu">
              @php
                $admins=Auth::guard('admin')->user();
                $profile = route('admin.profile.photo.show',$admins->profile_pic);
                @endphp
              <li class="user-header">
                 <img  src="{{ ($admins->profile_pic)? $profile : asset('profile-img/user.png') }}" class="profile-user-img img-responsive img-circle">
                <p>
                  {{ Auth::guard('admin')->user()->first_name }}
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('admin.logout.get') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
            </nav>
        </header>
