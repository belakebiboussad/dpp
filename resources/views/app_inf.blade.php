<!DOCTYPE html>
<html lang="en">
 <title>@yield('title','Dossier patient')</title>
	@include('partials.htmlheader')
	<body class="no-skin">
		@include('partials.navbar')
		<div class="main-container" id="main-container">
     	<script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
      </script>
        @include('partials.sidebar_inf')
        <div class="main-content">
            <div class="main-content-inner">
            	{{-- @include('partials.breadcrumbs') --}}
            	<div class="page-content">
                @include('flashy::message')
                @yield('main-content')
                    
              </div>
            </div>
        </div>    <!-- main-content -->
        <br><br>
        <div>
        	@include('partials.footer')
        </div>
    </div><!-- main-containe -->
	</body>
  @include('partials.scripts')
	@yield('page-script')
</html>