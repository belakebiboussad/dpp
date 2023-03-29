@extends('auth.auth')
@section('title','Dossier Patient | login')
@section('content')
<div id="login-box" class="login-box visible widget-box no-border">
	<div class="widget-body">
		<div class="widget-main">
			<h4 class="header blue lighter bigger"><i class="ace-icon fa fa-user"></i>
        Veuillez entrer vos information</h4>
			<div class="space-6"></div>
			<form role="form" method="POST" action="{{ route('login') }}">
       {{ csrf_field() }}
				<fieldset>
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="text" class="form-control" placeholder="Nom utilisateur"  name="name"/><i class="ace-icon fa fa-user"></i>
						</span>
					</label>
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
							<input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off" /><i class="ace-icon fa fa-lock"></i>
						</span>
					</label>
					<div class="space"></div>
					<div class="clearfix">
						<label class="inline">
							<input type="checkbox" class="ace" /><span class="lbl"> Souvien de moi</span>
						</label>
						<button type="submit" class="width-35 pull-right btn btn-sm btn-primary"><i class="ace-icon fa fa-key"></i>	<span class="bigger-110">Entrer</span></button>						
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
@endsection