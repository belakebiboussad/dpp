<!DOCTYPE html>
<html lang="en">
    <title>Gestion Des Patients</title>
    @include('partials.htmlheader')
<body class="no-skin">
    @include('partials.scripts')
    @include('partials.navbar')

    <div class="main-container" id="main-container">
     {{--    <script type="text/javascript">
           try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script> --}}
        @yield('page-script')
        @include('partials.sidebar_med')

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
</body>
</html>