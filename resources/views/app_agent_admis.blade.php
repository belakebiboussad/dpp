<!DOCTYPE html>
<html lang="en">
  <title>Gestion des admissions</title>
  @include('partials.htmlheader')
  @yield('style')
  <body class="no-skin">
    @include('partials.navbar')
    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>
        @if(Auth::user()->role_id == 9)
          @include('partials.sidebar_agent_admis')
        @endif 
        <div class="main-content">
            <div class="main-content-inner">
                <?php $lien = "Admissions" ?> 
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

    </div> <!-- /main-container -->
  </body>
  @include('partials.scripts')
  @yield('page-script')
</html>