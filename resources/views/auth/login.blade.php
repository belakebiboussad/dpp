@extends('auth.auth')
@section('title','Dossier Patient | login')
@section('content')
<br><br><br><br><br><br><br><br>      
<div id="login-box" class="login-box visible widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
             <div class ="center hidden">
                  <img src="img/logo.png" class="center thumb img-icons" alt="a picture">
            </div>  
            <h3><a href="#"><img src = "img/policeman.png" class ="img1"></a>&nbsp; Entrez Vos Informations </h3>
            <div class="space-6"></div>

            <form role="form" method="POST" action="{{ route('login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control"
                                   placeholder="nom utilisateur" name="name" readonly onfocus="this.removeAttribute('readonly');"/>
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </label>

                    <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="password" class="form-control"
                                       placeholder="Password" name="password" autocomplete="on"/>
                                <i class="ace-icon fa fa-lock"></i>
                            </span>
                    </label>

                    <div class="space"></div>
                        <? php echo Session::get('message');?>
                    <div class="clearfix">
                        <label class="inline">
                            <input type="checkbox" class="ace" name="remember"/>
                            <span class="lbl"> Souviens de moi</span>
                        </label>

                        <button type="submit"
                                class="width-35 pull-right btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-key"></i>
                            <span class="bigger-110">Entrer</span>
                        </button>
                    </div>
                    <div class="space-4"></div> 
                            @include('flashy::message')
                </fieldset>

            </form>
        </div>
        <!-- /.widget-main -->
    </div>
    <!-- /.widget-body -->
</div>
<!-- /.login-box -->
@endsection
