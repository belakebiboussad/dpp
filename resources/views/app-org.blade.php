<!DOCTYPE html>
<html lang="en">
    <title>@yield('title','Dossier patient')</title>
     @include('partials.htmlheader')
     @yield('style')
     @include('partials.scripts')
<body class="no-skin">
    @include('partials.navbar')
    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>
          @yield('page-script')
        @if(App\modeles\rol::where("id",Illuminate\Support\Facades\Auth::user()->role_id)->first()->role == "reception")
            @include('partials.sidebar_rec')
        @elseif(App\modeles\rol::where("id",Illuminate\Support\Facades\Auth::user()->role_id)->first()->role == "Medecine")
            @include('partials.sidebar_med')
        @elseif(App\modeles\rol::where("id",Illuminate\Support\Facades\Auth::user()->role_id)->first()->role == "administrateur")
            @include('partials.sidebar')
        @elseif(App\modeles\rol::where("id",Illuminate\Support\Facades\Auth::user()->role_id)->first()->role == "surveillant médical")
            @include('partials.sidebar_sur')
        @elseif(App\modeles\rol::where("id",Illuminate\Support\Facades\Auth::user()->role_id)->first()->role == "Receptioniste")
            @include('partials.sidebar_rec')    
        @endif
        <div class="main-content">
            <div class="main-content-inner">
                {{-- @include('partials.breadcrumbs') --}}
                <div class="page-content">
                   @include('flashy::message')
              	   @yield('main-content')
                </div>
                <!-- /page-content -->
            </div>
            <!-- /main-content-inner -->
        </div>
        <!-- /main-content -->
        <br>
        <br>
          <div>
                @include('partials.footer')
           </div>
     

    </div>
    <!-- /main-container -->
</body>
</html>
