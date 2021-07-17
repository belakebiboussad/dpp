<!DOCTYPE html>
<html lang="en">
    <title>Gestion des patients</title>
     @include('partials.htmlheader')
@include('partials.scripts')
    <body class="no-skin">
        @include('partials.navbar')
        <div class="main-container" id="main-container">
            @yield('page-script')
            @include('partials.sidebar_laboanalyses')
            <div class="main-content">
                <div class="main-content-inner">
                 <?php $lien = "Exmens Biologiques" ?> 
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