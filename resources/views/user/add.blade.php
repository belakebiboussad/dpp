@extends('app')
@section('title','Ajouter un Utilisateure')
@section('page-script')
<script>
// $(document).ready(function() { 
// });
//jQuery(function($) {
//$('.mobile1').mask('0999999999');//$('.telfixe').mask('099-99-99-99');});
</script>
@endsection
@section('main-content')
	<div class="page-header"><h2>Ajouter un nouveau utilisateur </h2></div>
	<div class="widget-box" id="widget-box-1">
		<div class="widget-body">
			<div class="widget-main">	{{-- "{{route('users.store')}} --}}
		  <form  id="userAdd" class="form-horizontal" action="{{ url('/users/store') }}" method="POST">
				{{ csrf_field() }}
				<h4 class="header blue bolder smaller">Informations adminstratives</h4><div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
							<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Nom:</b></label>
							<div class="col-sm-8">
							<input class="col-xs-12 col-sm-12" type="text" id="nom" name="nom" placeholder="Nom..." Autocomplete="off" required/>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
						<label class="col-sm-4 control-label no-padding-right" for="prenom"><b>Prénom:</b></label>
						<div class="col-sm-8">
						<input class="col-xs-12 col-sm-12" type="text" id="prenom" name="prenom" placeholder="Prénom..." Autocomplete="off" required/>
							</div>
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
						<label class="col-sm-4 control-label no-padding-right" for="datenaissance"><b>Date Naissance:</b></label>
						<div class="col-sm-8">
						<input class="col-xs-12 col-sm-12 date-picker" type="text" id="datenaissance" name="datenaissance" placeholder="Date Naissance..." data-date-format="yyyy-mm-dd" autocomplete ="off" required/>
						</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
						<label class="col-sm-4 control-label no-padding-right" for="lieunaissance"><b>Lieu Naissance:</b></label>
						<div class="col-sm-8">
						<input class="col-xs-12 col-sm-12 autoCommune" type="text" id="lieunaissance" name="lieunaissance" placeholder="Lieu Naissance..." Autocomplete="off"/>
						</div>
						</div>
					</div>
				</div><div class="space-12 hidden-xs"></div>
				<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
					<label class="col-sm-3 control-label no-padding-right"><b>Genre:</b></label>
					<div class="col-sm-9">
						<label class="inline col-sm-1">
							<input name="sexe" value="M" type="radio" class="ace" checked />
							<span class="lbl middle"> Masculin</span>
						</label>
						&nbsp; &nbsp; &nbsp;
						<label class="inline col-sm-1">
							<input name="sexe" value="F" type="radio" class="ace" />
							<span class="lbl middle"> Féminin</span>
						</label>
					</div>
				</div>
				<hr>
				<h4 class="header blue bolder smaller">Contact</h4><div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="{{ $errors->has('adresse') ? "has-error" : "" }}">
						<label for="adresse"><b>Adresse:</b></label>
						<textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse..."></textarea>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('mobile') ? "has-error" : "" }}">
							<label for="mobile"><b>Tél mobile:</b></label><input type="tel" id="mobile" name="mobile" class ="form-control mobile"  required/>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('fixe') ? "has-error" : "" }}">
						<label for="fixe"><b>Tél Fixe:</b></label><input type="tel" class="form-control telfixe" id="fixe" name="fixe"></div>
					</div>
				</div>
				<h4 class="header blue bolder smaller">Information de poste</h4>	<div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('mat') ? "has-error" : "" }}">
							<label for="mat"><b>Matricule:</b></label>
							<input type="text" class="form-control" id="mat" name="mat" placeholder="Matricule...">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('service') ? "has-error" : "" }}">
							<label for="service"><b>Service:</b></label>
							<select class="form-control" id="service" name="service">
								<option value="" selected disabled>Sélectionner...</option>
								@foreach($services as $service)
								<option value="{{ $service->id }}">{{ $service->nom }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div>
							<label for="specialite"><b>Spécialité:</b></label>
							<select class="form-control" id="specialite" name="specialite">
								<option  value="" selected>Sélectionner...</option>
								@foreach($specialites as $specialite)
								<option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<h4 class="header blue bolder smaller">Informations d'assurance</h4><div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('nss') ? "has-error" : "" }}">
							<label for="nss"><b>N° Sécurité Sociale:</b></label>
							<input type="text" class="form-control" id="nss" name="nss" pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2} $" placeholder="XX XXXX XXXX XX">
						</div>
					</div>
				</div>
				<h4 class="header blue bolder smaller">Informations de compte</h4>	<div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('username') ? "has-error" : "" }}">
							<label for="username"><b>Nom d'utilisateur:</b></label>
							<input type="text" class="form-control" id="usernamee" name="username" placeholder="Nom d'utilisateur..." autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('password') ? "has-error" : "" }}">
							<label for="password"><b>Mot de passe:</b></label>
							<input type="password" autocomplete="off" class="form-control" id="password" name="password" placeholder="Mot de passe..." required>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('mail') ? "has-error" : "" }}">
							<label for="mail"><b>E-Mail:</b></label>
							<input type="email" class="form-control" id="mail" name="mail" placeholder="E-Mail...">
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('role') ? "has-error" : "" }}">
							<label for="role"><b>Role:</b></label>
							<select id="role" name="role" class="form-control" required>
								<option value="">Sélectionner...</option>
								@foreach($roles as $role)
									<option value="{{ $role->id }}">{{ $role->role }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions center">
				<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save icon-on-left bigger-110"></i>&nbsp;Enregistrer	</button>
				<button type="reset" class="btn btn-sm btn-default">	<i class="ace-icon fa fa-undo icon-on-left bigger-110"></i>&nbsp;Annuler</button>
			</div>
			</form>
		</div>
	</div>
@endsection