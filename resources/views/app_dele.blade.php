<!DOCTYPE html>
<html lang="en">
    {{-- <title>Gestion Des Colloques</title> --}}
     <title>@yield('title','Gestion Des Colloques')</title>
    {{-- @include('partials.htmlheader',['html_title' => "Gestion Des Colloques"]) --}}
    @include('partials.htmlheader')
  <body class="no-skin">
         @include('partials.scripts')
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
        @elseif(App\modeles\rol::where("id",Illuminate\Support\Facades\Auth::user()->role_id)->first()->role == "surveillant médical")
            @include('partials.sidebar_sur')
        @elseif(App\modeles\rol::where("id",Illuminate\Support\Facades\Auth::user()->role_id)->first()->role == "Delegue colloque")
            @include('partials.sidebar_dele')
        @endif
        <div class="main-content">
                 <div class="main-content-inner">
                @include('partials.breadcrumbs_rec')

                <div class="page-content">
                    @yield('main-content')
                </div>
                <!-- /page-content -->
            </div>
            <!-- /main-content-inner -->
        </div>
        <!-- /main-content -->
        @include('partials.footer')

    </div>
    <!-- /main-container -->
        {{-- @include('partials.scripts') --}}
</body>
</html>