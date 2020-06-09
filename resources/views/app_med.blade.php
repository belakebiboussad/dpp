<!DOCTYPE html>
<html lang="en">
    <title>Dossier Patient</title>
    @include('partials.htmlheader')
      @yield('style')
      {{-- @include('partials.scripts') --}}
    <body class="no-skin">
      @include('partials.scripts')
      @include('partials.navbar')
      {{--  @include('partials.scripts') --}}
      <div class="main-container" id="main-container">
        <script type="text/javascript">
          try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>
        @yield('page-script')
        @include('partials.sidebar_med')
        <div class="main-content">
          <div class="main-content-inner">
            <?php $lien = "Patients" ?> 
            @include('partials.breadcrumbs_rec')
            <div class="page-content">
            @include('flashy::message')
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