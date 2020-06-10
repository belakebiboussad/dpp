@extends('app')
@section('main-content')
<div class="page-header">
	<h3>Détails du Fonctionnaire : {{ $assure->Nom }} {{ $assure->Prenom }}</h3>
	<div class="pull-right" style ="margin-top: -0.5%;">
		<a href="{{route('assur.index')}}" class ="btn btn-white btn-info btn-bold btn-xs">Rechercher un Fonctionnaire&nbsp;<i class="ace-icon fa fa-arrow-circle-right bigger-120 black"></i></a>
	</div>
</div>
.<div class="row">
	<div id="" class="col-sm-6 co-xs-6">									
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Nom </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assure->Nom }}</span>
					</div>
			</div>
		</div>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Prénom </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assure->Prenom }}</span>
					</div>
			</div>
		</div>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Né(e) </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assure->Date_Naissance }} à {{ $assure->lieuNaissance->nom }} </span>
					</div>
			</div>
		</div>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Adress </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assure->adresse }}</span>
					</div>
			</div>
		</div>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Sexe </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assure->Sexe =="H" ? "Homme" : "Femme" }}</span>
					</div>
			</div>
		</div>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Position actuelle </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assure->Etat  }}</span>
					</div>
			</div>
		</div>
		@if($assure->Eta == "En exercice")
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Service </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assure->Service  }}</span>
					</div>
			</div>
		</div>
		@endif
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Matricule </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assure->matricule  }}</span>
					</div>
			</div>
		</div>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> sécurité sociale </div>
				<div class="profile-info-value">
					<span class="editable" id="nom">{{ $assure->NSS }}</span>
				</div>
			</div>
		</div>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> NMGSN </div>
				<div class="profile-info-value">
					<span class="editable" id="nom">{{ $assure->NMGSN }}</span>
				</div>
			</div>
		</div>
	</div><!-- / col-sm-6-->		
	<div id="" class="col-sm-6 col-xs-6">	
		@if($assure->patients->count() >0)
		<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
			<div class="widget-box widget-color-blue" id="widget-box-2">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Ayants droits</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th class= "center">#</th>
									<th class= "center"> <strong>Nom</strong></th>
									<th class= "center"><strong>Prénom</strong></th>
									<th class= "center"><strong>Né(e) le</strong></th>
									<th class= "center"><strong>Relation</strong></th>
									<th class= "center"></th>
								</tr>
							</thead>
							<tbody>
							<?php $j = 1; ?>
							@foreach($assure->patients as $patient)	
							<tr>
								<td>{{$j++}}</td>
								<td>{{ $patient->Nom}}</td>
								<td> {{ $patient->Prenom}}</td>
								<td> {{ $patient->Dat_Naissance }}</td>
								<td> <span class="badge badge-primary">{{ $patient->Type_p }}</span></td>
								<td></td>
							</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
		@endif
	</div><!-- / -->							
</div>
@endsection