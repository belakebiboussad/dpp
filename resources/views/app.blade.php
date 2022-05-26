<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <title>@yield('title','Dossier patient')</title>
  @include('partials.htmlheader')
  @yield('style')
</head>
<body class="no-skin">
      @include('partials.navbar')
      @include('partials.scripts')
      @include('flashy::message')
      <div class="main-container" id="main-container">
      <script type="text/javascript">
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
         @elseif(Auth::user()->role_id == 8) 
            @include('partials.sidebar_dir')           
        @elseif(Auth::user()->role_id == 9)
            @include('partials.sidebar_agent_admis')
        @elseif(Auth::user()->role_id == 10)
            @include('partials.sidebar_pharm')
        @elseif(Auth::user()->role_id == 13)
            @include('partials.sidebar_chef_ser') 
        @elseif(Auth::user()->role_id == 3)
            @include('partials.sidebar_inf')
         @elseif(Auth::user()->role_id == 11)
            @include('partials.sidebar_laboanalyses')    
        @elseif(Auth::user()->role_id == 12)
            @include('partials.sidebar_radiologue')
        @elseif(Auth::user()->role_id == 14)
            @include('partials.sidebar_med')           
        @endif
        <div class="main-content">
            <div class="main-content-inner">{{-- @include('partials.breadcrumbs') --}}
                <div class="page-content">
                  @include('flashy::message')
                  @yield('main-content')
                </div>
            </div>
        </div><!-- /main-content -->
        <div>{{-- @include('partials.footer') --}}
        </div>
    </div><!-- /main-container -->
</body>
</html>
