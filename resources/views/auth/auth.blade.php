<!DOCTYPE html>
<html lang="en">
@include('partials.htmlheader')
@include('partials.scripts')
<body class="login-layout light-login" style="background-image: url({{asset('/avatars/hop.jpg')}}); background-size: cover;">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="center">
                    <h1>
                        <i class="ace-icon fa fa-h-square blue"></i>
                        Etablissement Hospitalier de la Sûreté Nationale
                        <i class="ace-icon fa fa-h-square blue"></i>
                    </h1>
                    <h1>
                        <i class="ace-icon fa fa-user-md blue"></i>
                        Système de Gestion de Dossier Patient
                        <i class="ace-icon fa fa-user-md blue"></i>
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
                    </div>
                    <!-- /.position-relative -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.main-content -->
</div>
<!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
{{-- <script type="text/javascript">
    window.jQuery || document.write("<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>"+"<"+"/script>");
</script> --}}

<!-- <![endif]-->

<!--[if IE]>-->
<script type="text/javascript">
    window.jQuery || document.write("<script src='{{ asset('/js/jquery-2.2.4.min.js') }}'>"+"<"+"/script>");
</script>
<!--[endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
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
