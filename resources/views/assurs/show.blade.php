@extends('app')
@section('main-content')
.<div class="row">
	<div id="" class="col-sm-6 co-xs-6">									
		<div class="page-header">
			<h3>Détails Du L'assuré : {{ $assur->Nom }} {{ $assur->Prenom }}</h3>
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
				<div class="profile-info-name"> Sexe </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assur->Sexe =="H" ? "Homme" : "Femme" }}</span>
					</div>
			</div>
		</div>
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Service </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assur->Service  }}</span>
					</div>
			</div>
		</div>
			<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> Matricule </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assur->matricule  }}</span>
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
		<div class="profile-user-info profile-user-info-striped">
			<div class="profile-info-row">
				<div class="profile-info-name"> NMGSN </div>
				<div class="profile-info-value">
					<span class="editable" id="nom">{{ $assur->NMGSN }}</span>
				</div>
			</div>
		</div>
	</div><!-- / col-sm-6-->		
	<div id="" class="col-sm-6 col-xs-6">	
		<div class="page-header">
			<h3>Ayant droit : {{ $assur->Nom }} {{ $assur->Prenom }}</h3>
		</div>
		<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
			<div class="widget-box widget-color-blue" id="widget-box-2">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Ayants drroits</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Né(e) le</th>
									<th>Relation</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
	</div><!-- / -->							
</div>
@endsection