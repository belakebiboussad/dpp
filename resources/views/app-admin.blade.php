<!DOCTYPE html>
<html lang="en">
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
          @include('partials.sidebar')
        <div class="main-content">
            <div class="main-content-inner">{{-- @include('partials.breadcrumbs') --}}
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
