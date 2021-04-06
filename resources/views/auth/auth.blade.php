<!DOCTYPE html>
<html lang="en">
@include('partials.htmlheader')
@include('partials.scripts')
<body class="login-layout light-login" style="background-image: url({{ asset('/avatars/hop.jpg') }}); background-size: cover;">
<div class="main-container">
  <div class="main-content">
    <div class="space-12"></div><div class="space-12"></div> <div class="space-12"></div>
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="center">
            <h4 class="blue" id="id-company-text">&copy;Etablissement Hospitalier de la Sûreté Nationale</h4>
            <h1><i class="ace-icon fa fa-h-square blue"></i>
             <span class="white" id="id-text2">Dossier Médical Eléctronique</span>
          </h1>
               
        </div>
        <div class="space-6"></div>
        <div class="login-container">
          <div class="position-relative">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include('flashy::message')
            @yield('content')
          </div><!-- /.position-relative -->    
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.main-content --> 
</div>
<!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<!-- <![endif]-->

<!--[if IE]>-->
<script type="text/javascript">
    window.jQuery || document.write("<script src='{{ asset('/js/jquery.min.js') }}'>"+"<"+"/script>");
</script>
<!--[endif]-->
<script type="text/javascript">
//    if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    //you don't need this, just used for changing background
    jQuery(function($) {
        $('#btn-login-dark').on('click', function(e) {
            $('body').attr('class', 'login-layout');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'blue');
            e.preventDefault();
        });
        $('#btn-login-light').on('click', function(e) {
            $('body').attr('class', 'login-layout light-login');
            $('#id-text2').attr('class', 'grey');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
        });
        $('#btn-login-blur').on('click', function(e) {
            $('body').attr('class', 'login-layout blur-login');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'light-blue');

            e.preventDefault();
        });
    });
</script>
</body>
</html>
