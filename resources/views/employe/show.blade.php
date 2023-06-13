@extends('app')
@section('main-content')
	<div class="page-header"><h1>Détails de : {{ $employe->full_name }}</h1></div>
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
			<div class="profile-info-name">Date de naissance</div>
			<div class="profile-info-value">
				<span class="editable" id="signup">{{ $employe->dob }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Age </div>
			<div class="profile-info-value">
				<span class="editable" id="age">38</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> Lieu de naissance </div>
			<div class="profile-info-value">
				<i class="fa fa-map-marker light-orange bigger-110"></i>
				<span class="editable" id="country">{{ $employe->pob }}</span>
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
			<div class="profile-info-name"> N° Tél fixe </div>
			<div class="profile-info-value">
				<span class="editable" id="age">{{ $employe->Tele_fixe }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> N° Tél mobile </div>
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
				<span class="editable" id="age">{{ $employe->matricule }}</span>
			</div>
		</div>
		<div class="profile-info-row">
			<div class="profile-info-name"> N° sécurité sociale </div>
			<div class="profile-info-value">
				<span class="editable" id="age">{{ $employe->NSS }}</span>
			</div>
		</div>
	</div>
@stop