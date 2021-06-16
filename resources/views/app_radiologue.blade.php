<!DOCTYPE html>
<html lang="en">
    <title>Gestion des examens d'imagerie</title>
    @include('partials.htmlheader')
<body class="no-skin">
  @include('partials.navbar')
   @include('partials.scripts')
  <div class="main-container" id="main-container">
    {{-- <script type="text/javascript"> try{ace.settings.check('main-container' , 'fixed')}catch(e){} </script> --}}
    @yield('page-script')
    @include('partials.sidebar_radiologue')
    <div class="main-content">
      <div class="main-content-inner">
            <?php $lien = "Examens Radiologiques" ?>{{--@include('partials.breadcrumbs_rec') --}}
          <div class="page-content"> @yield('main-content')</div>  <!-- /page-content -->
      </div><!-- /main-content-inner -->
    </div>
    <!-- /main-content -->
    @include('partials.footer')
  </div><!-- /main-container -->
</body>