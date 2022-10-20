@extends('app')
@section('main-content')
<div class="row"><h4> <b>Détails : {{ $user->name }}</b></h4>
<div class="pull-right">
	<a href="{{ route('users.edit',$user->id )}}" class="btn btn-info btn-sm" data-toggle="tooltip" title="modifier">
		<i class="fa fa-edit fa-xs" aria-hidden="true" ></i>
	</a>
	
  <a href="{{ route('users.destroy',$user->id )}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-sm btn-danger" {{ $user->id == Auth::user()->id ? 'disabled':'' }}>
		<i class="fa fa-trash-o fa-xs"></i>
	</a>
</div>
</div>
<div class="tabbable">
	<ul class = "nav nav-pills nav-justified list-group" role="tablist">
		<li class="active col-md-6" role= "presentation"><a data-toggle="tab" href="#info-general"><i class="green ace-icon fa fa-book bigger-125"></i>&nbsp;Informations Géneral</a></li>
		<li class="col-md-6" role= "presentation"><a data-toggle="tab" href="#info-compte"><i class="red ace-icon fa fa-users bigger-125"></i>&nbsp;Informations du compte</a></li>
	</ul>
	<div class="tab-content profile-edit-tab-content jumbotron">
		<div id="info-general" class="tab-pane in active">
			<h5 class="header blue bolder">Informations administratives</h5>
			<div class="row">
				<div class="form-group col-xs-12 col-sm-4">
					<label class="col-sm-4 text-right">Nom :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->nom }}</label></div>
				</div>
				<div class="form-group col-xs-12 col-sm-4">
					<label class="col-sm-4  text-right">Prénom :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->prenom }}</label></div>
				</div>
				<div class="form-group col-xs-12 col-sm-4">
					<label class="col-sm-4  text-right">Né(e) le :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->Date_Naiss }}</label> </div>
				</div>
        <div class="row">
				<div class="form-group col-xs-12 col-sm-4">
					<label class="col-sm-4  text-right">Né(e) à :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->Lieu_Naissance }}</label></div>
				</div>
				<div class="form-group col-xs-12 col-sm-4">
					<label class="col-sm-4  text-right">Genre :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->sexe == "M" ? "Masculin" : "Féminin" }}</label></div>
				</div>
				<div class="form-group col-xs-12 col-sm-4">
					<label class="col-sm-4  text-right">Adresse :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->Adresse }}</label></div>
				</div>
			</div>
			<h5 class="header blue bolder">Contacts</h5>
			<div class="row">
				<div class="form-group col-xs-12 col-sm-4">
					<label class="col-sm-4 text-rightl">Tél mobile :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->tele_mobile }}</label></div>
				</div>
				<div class="form-group col-xs-12 col-sm-4">
						<label class="col-sm-4 text-right">Tél Fixe :</label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Tele_fixe }}</label></div>
				  </div>
			</div>
			<h5 class="header blue bolder">Informations du poste</h5>
			<div class="row">
				<div class="form-group col-xs-12 col-sm-3">
					<label class="col-sm-4  text-right">Matricule :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->Matricule_dgsn }}</label></div>
				</div>
				@isset($user->employ->service)
				<div class="form-group col-xs-12 col-sm-3">
					<label class="col-sm-4  text-right">Service :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->Service->nom }}</label></div>
				</div>
				@endisset
				@isset($user->employ->Specialite)
				<div class="form-group col-xs-12 col-sm-3">
					<label class="col-sm-4  text-right">Spécialité :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->employ->Specialite->nom }}</label></div>
				</div>
				@endisset	
				<div class="form-group col-xs-12 col-sm-3">
					<label class="col-sm-4  text-right">NSS :</label>
					<div class="col-sm-8"><label class="blue">{{$user->employ->NSS }}</label></div>
				</div>
			</div>
		</div>
		<div id="info-compte" class="tab-pane">
			<h4 class="header blue bolder">Informations du compte</h4>
			<div class="row">
				<div class="form-group col-xs-12 col-sm-6">
					<label class="col-sm-4 control-label  text-right">Nom d'utilisateur :</label>
					<div class="col-sm-8"><label class="blue">{{ $user->name }}</label></div>
				</div>
				<div class="form-group col-xs-12 col-sm-6">
					<label class="col-sm-4 control-label  text-right">Rôle :</b></label>
					<div class="col-sm-8"><label class="blue">{{ $user->role->role }}</label></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
	