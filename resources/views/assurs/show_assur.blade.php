@extends('app_recep')
@section('main-content')
	<div class="page-header">
		<h1>Détails Du L'assuré : {{ $assur->Nom }} {{ $assur->Prenom }}</h1>
	</div>
	<div class="profile-user-info profile-user-info-striped">
		<div class="profile-info-row">
			<div class="profile-info-name"> Nom </div>
				<div class="profile-info-value">
					<span class="editable" id="nom">{{ $assur->Nom }}</span>
				</div>
		</div>
	</div>
	<div class="profile-user-info profile-user-info-striped">
		<div class="profile-info-row">
			<div class="profile-info-name"> Prénom </div>
				<div class="profile-info-value">
					<span class="editable" id="nom">{{ $assur->Prenom }}</span>
				</div>
		</div>
	</div>
	<div class="profile-user-info profile-user-info-striped">
		<div class="profile-info-row">
			<div class="profile-info-name"> Date Naissance </div>
				<div class="profile-info-value">
					<span class="editable" id="nom">{{ $assur->Date_Naissance }}</span>
				</div>
		</div>
	</div>
	<div class="profile-user-info profile-user-info-striped">
		<div class="profile-info-row">
			<div class="profile-info-name"> Genre </div>
				<div class="profile-info-value">
					<span class="editable" id="nom">{{ $assur->Sexe =="H" ? "Masculin" : "Féminin" }}</span>
				</div>
		</div>
	</div>
	<div class="profile-user-info profile-user-info-striped">
		<div class="profile-info-row">
			<div class="profile-info-name"> Matricule </div>
				<div class="profile-info-value">
					<span class="editable" id="nom">{{ $assur->Matricule  }}</span>
				</div>
		</div>
	</div>
	<div class="profile-user-info profile-user-info-striped">
		<div class="profile-info-row">
			<div class="profile-info-name"> sécurité sociale </div>
				<div class="profile-info-value">
					<span class="editable" id="nom">{{ $assur->NSS }}</span>
				</div>
		</div>
	</div>
@endsection