@extends('app')
@section('main-content')
<div class="page-header">
  <h4>Détails du l'utilisateur &quot; {{ $user->employ->full_name }} &quot;</h4>
  <div class="pull-right">
    <a href="{{ route('users.index') }}" class="btn btn-xs btn-white"><i class="ace-icon fa fa-search blue"></i>Chercher</a>
    <a href="{{ route('users.destroy',$user->id )}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger" {{ $user->id == Auth::user()->id ? 'disabled':'' }}> Supprimer<i class="fa fa-trash-o fa-xs"></i>
  	</a>
  </div>
</div>
<div id="info-general">
	<h5 class="header blue">Informations administratives</h5>
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
	<h5 class="header blue">Contacts</h5>
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
	<h5 class="header blue">Informations du poste</h5>
	<div class="row">
		<div class="form-group col-xs-12 col-sm-3">
			<label class="col-sm-4  text-right">Matricule :</label>
			<div class="col-sm-8"><label class="blue">{{ $user->employ->matricule }}</label></div>
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
  <h5 class="header blue">Informations du compte</h5>
  <div class="row">
    <div class="form-group col-xs-12 col-sm-6">
      <label class="col-sm-4 control-label  text-right">Nom d'utilisateur :</label>
      <div class="col-sm-8"><label class="blue">{{ $user->username }}</label></div>
    </div>
    <div class="form-group col-xs-12 col-sm-6">
      <label class="col-sm-4 control-label  text-right">Rôle :</b></label>
      <div class="col-sm-8"><label class="blue">{{ $user->role->role }}</label></div>
    </div>
  </div>
</div>
@stop
	