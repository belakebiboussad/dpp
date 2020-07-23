<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title','Dossier patient')</title>
     @include('partials.htmlheader')
     @include('partials.scripts')
     @yield('style')
</head>
<body class="no-skin">
    @include('partials.navbar')
    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>
        @yield('page-script')
        @if( Auth::user()->role_id == 1)
            @include('partials.sidebar_med')
        @elseif( Auth::user()->role_id == 2)
            @include('partials.sidebar_rec')
        @elseif(Auth::user()->role_id == 4)
            @include('partials.sidebar')
        @elseif(Auth::user()->role_id == 5)
            @include('partials.sidebar_sur')    
        @elseif(Auth::user()->role_id == 6) 
            @include('partials.sidebar_dele')      
        @elseif(Auth::user()->role_id == 9)
            @include('partials.sidebar_agent_admis')
        @elseif(Auth::user()->role_id == 10)
            @include('partials.sidebar_pharm')
        @elseif(Auth::user()->role_id == 13)
            @include('partials.sidebar_chef_ser') 
        @elseif(Auth::user()->role_id == 3)
            @include('partials.sidebar_inf')
        @elseif(Auth::user()->role_id == 12)
            @include('partials.sidebar_radiologue')          
        @endif
        <div class="main-content">
            <div class="main-content-inner"> {{-- @include('partials.breadcrumbs') --}}
                <div class="page-content">
                  @include('flashy::message')
              	  @yield('main-content')
                </div>
                <!-- /page-content -->
            </div>
            <!-- /main-content-inner -->
        </div>
        <!-- /main-content -->
        <div>
            @include('partials.footer')
        </div>
    </div>
    <!-- /main-container -->
</body>
</html>
