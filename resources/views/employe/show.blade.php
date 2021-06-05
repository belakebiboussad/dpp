@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Détails de : {{ $employe->nom }} {{ $employe->prenom }}</h1>
	</div>
	<div class="profile-user-info profile-user-info-striped">
		<div class="profile-info-row">
			<div class="profile-info-name"> Nom</div>
				<div class="profile-info-value">
					<span class="editable" id="username">{{ $employe->nom }}</span>
				</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Prénom</div>
				<div class="profile-info-value">
					<span class="editable" id="username">{{ $employe->prenom }}</span>
				</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Genre </div>
				<div class="profile-info-value">
					<span class="editable" id="username">{{ $employe->Sse == "M" ? 'Masculin' : 'Féminin' }}</span>
				</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name">Date naissance</div>
			<div class="profile-info-value">
				<span class="editable" id="signup">{{ $employe->Date_Naiss }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Age </div>
			<div class="profile-info-value">
				<span class="editable" id="age">38</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Lieu Naissance </div>
			<div class="profile-info-value">
				<i class="fa fa-map-marker light-orange bigger-110"></i>
				<span class="editable" id="country">{{ $employe->Lieu_Naissance }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Adresse </div>
			<div class="profile-info-value">
				<i class="fa fa-map-marker light-orange bigger-110"></i>
				<span class="editable" id="country">{{ $employe->Adresse }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> N° Télé fixe </div>
			<div class="profile-info-value">
				<span class="editable" id="age">{{ $employe->Tele_fixe }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> N° Télé mobile </div>
			<div class="profile-info-value">
				<span class="editable" id="age">{{ $employe->tele_mobile  }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Spécialité </div>
			<div class="profile-info-value">
				<span class="editable" id="age">{{ $employe->specialite }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Service </div>
			<div class="profile-info-value">
				<span class="editable" id="age">{{ $employe->service }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Matricule </div>
			<div class="profile-info-value">
				<span class="editable" id="age">{{ $employe->Matricule_dgsn }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> N° sécurité sociale </div>
			<div class="profile-info-value">
				<span class="editable" id="age">{{ $employe->NSS }}</span>
			</div>
		</div>
	</div>
@endsection