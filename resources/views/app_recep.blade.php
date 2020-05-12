<!DOCTYPE html>
<html lang="en">
    <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>@yield('title','Gestion des Rendez-Vous')</title>
         @yield('style')
         <title>Gestion Des Patients</title>
         @include('partials.htmlheader')
         @include('partials.scripts')   
   </head>
    <body class="no-skin">
        @include('partials.navbar')
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>
            @yield('page-script')
            @if(Auth::user()->role->id == 2)
                @include('partials.sidebar_rec')
            @elseif(Auth::user()->role->id == 1)
               @include('partials.sidebar_med')
            @elseif(Auth::user()->role->id == 5)
               @include('partials.sidebar_med')  
            @endif
            <div class="main-content">
                <div class="main-content-inner"> 
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
    </body>
</html>