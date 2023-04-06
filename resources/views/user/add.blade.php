@extends('app')
@section('title','Ajouter un Utilisateure')
@section('main-content')
	<div class="container-fluid">
	<div class="row"><h4>Ajouter un nouveau utilisateur</h4></div>
	<form  id="userAdd" action="{{ url('/users/store') }}" method="POST">
	<div class="widget-box">
		<div class="widget-body">
			<div class="widget-main">
				{{ csrf_field() }}
				<h4 class="header block blue">Informations adminstratives</h4><div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
							<label class="col-sm-3 control-label" for="nom">Nom:</label>
							<div class="col-sm-9">
							<input class="form-control " type="text" name="nom" placeholder="Nom..." Autocomplete="off" required/>
							</div>
						</div>
					</div>
         	<div class="col-xs-12 col-sm-4">
						<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="prenom">Prénom :</label>
						<div class="col-sm-9">
						<input class="form-control" type="text"  name="prenom" placeholder="Prénom..." Autocomplete="off" required/>
							</div>
						</div>
					</div>
          <div class="col-xs-12 col-sm-4">
            <div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
            <label class="col-sm-3 control-label" for="datenaissance">Né(e) le :</label>
            <div class="col-sm-9">
            <input class="form-control date-picker ltnow" type="text" name="datenaissance" placeholder="Date Naissance..." data-date-format="yyyy-mm-dd" autocomplete ="off" required/>
            </div>
            </div>
          </div>
				</div><div class="space-12"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="lieunaissance">Né(e) à :</label>
						<div class="col-sm-9">
						  <input class="form-control autoCommune" type="text" id="lieunaissance" name="lieunaissance" placeholder="Lieu Naissance..." Autocomplete="off"/>
						</div>
						</div>
					</div>
          <div class="col-sm-4">
            <div class="form-group {{ $errors->has('sexe') ? 'has-error' : '' }}">
              <label class="col-sm-3 control-label" for="sexe">Genre :</label>
              <div class="col-sm-9">
                <div class="radio">
                  <label><input name="sexe" value="M" type="radio" class="ace" checked /><span class="lbl"> Masculin</span></label>
                  <label><input name="sexe" value="F" type="radio" class="ace" /><span class="lbl"> Féminin</span></label>
                </div>
              </div>  
            </div>
          </div>
            <div class="col-xs-12 col-sm-4">
            <div class="{{ $errors->has('nss') ? "has-error" : "" }}">
              <label class="control-label col-sm-3 col-xs-3" for="nss">NSS :</label>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2} $" --}}
              <input type="text" class="nssform col-sm-9 col-xs-9"  name="nss"  placeholder="XXXXXXXXXXXX">
            </div>
          </div>
				</div>
				<hr>
				<h4 class="header block blue">Contact</h4><div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="col-sm-5">
						<label class="control-label col-sm-3 col-xs-3" for="adresse"> Adresse :</label>
						<input type="text" name="adresse" placeholder="Adresse..." class="col-sm-9 col-xs-9"/>
					</div>
					<div class="col-sm-2">
						<div class="{{ $errors->has('mobile') ? "has-error" : "" }}">
							<label class="control-label col-sm-4 col-xs-4" for="mobile">Mob:</label>
							<div class="input-group col-sm-8 col-xs-8">
                <span class="input-group-addon"><i class="ace-icon fa fa-phone"></i></span>
                <input type="tel" name="mobile" class ="form-control mobile" required/>
              </div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="{{ $errors->has('fixe') ? "has-error" : "" }}">
						<label class="control-label col-sm-4 col-xs-4" for="fixe">Fixe :</label>
						<div class="input-group col-sm-8 col-xs-8">
              <span class="input-group-addon"><i class="ace-icon fa fa-phone"></i></span>
              <input type="tel" class="form-control telfixe" name="fixe"></div>
            </div>
					</div>
          <div class="col-sm-3">
            <div class="{{ $errors->has('mail') ? "has-error" : "" }}">
              <label for="mail" class="control-label col-sm-3 col-xs-3">E-Mail:</label>
              <input type="email" class="col-sm-9 col-xs-9" name="mail" placeholder="E-Mail..." autocomplete="off">
            </div>
          </div>
				</div>
				<h4 class="header block blue">Fonction</h4><div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('mat') ? "has-error" : "" }}">
							<label class="control-label col-sm-4 col-xs-4" for="mat">Matricule:</label>
							<input type="text" class="col-sm-8 col-xs-8" name="mat" placeholder="Matricule..." maxlength =5 minlength =5>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3"></div>
					<div class="col-xs-12 col-sm-3">
            <div class="{{ $errors->has('role') ? "has-error" : "" }}">
              <label for="role" class="control-label col-sm-4 col-xs-4">Rôle:</label>
              <select id="role" name="role" class="col-sm-8 col-xs-8" required>
                <option value="" selected disabled>Sélectionner...</option>
                @foreach($roles as $role)
                  <option value="{{ $role->id }}">{{ $role->role }}</option>
                @endforeach
              </select>
            </div>
          </div>
					<div class="col-xs-12 col-sm-3">
						<div class="hidden">
							<label for="specialite" class="control-label col-sm-3 col-xs-3">Spécialité :</label>
							<select name="specialite" class="col-sm-9 col-xs-9">
								<option  value="" selected disabled>Sélectionner...</option>
								@foreach($specialites as $specialite)
								<option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
								@endforeach
							</select>
						</div>
					</div>
					
				</div>
					<h4 class="header block blue">Informations de compte</h4><div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('username') ? "has-error" : "" }}">
							<label class="control-label col-sm-3 col-xs-3" for="username">Login :</label>
							<input type="text" class="col-sm-9 col-xs-9"  name="username" placeholder="Nom d'utilisateur..." readonly onfocus="this.removeAttribute('readonly');" autocomplete="off" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('password') ? "has-error" : "" }}">
							<label for="password" class="control-label col-sm-3 col-xs-3">Password :</label>
							<input type="password" autocomplete="off" class="col-sm-9 col-xs-9" name="password" placeholder="Mot de passe..."  autocomplete="off" required>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><div class="hr hr-dotted"></div>
	<div class="row">
		<div class="col-sm12 center"><br>
			<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save icon-on-left bigger-110"></i> Enregistrer	</button>
			<button type="reset" class="btn btn-sm btn-default"><i class="ace-icon fa fa-undo icon-on-left bigger-110"></i> Annuler</button>
		</div>
	</div>
	</form>
</div>
@stop
@section('page-script')
<script type="text/javascript">
  $(function(){
    $("#role").change(function (e) {
      var rols = [ "1", "10", "12", "13", "14"  ];
      var role = $('#role').val();
      if(jQuery.inArray(role, rols ) != -1){
       $(".hidden").removeClass();
      }
    });
  });
</script>
@stop
