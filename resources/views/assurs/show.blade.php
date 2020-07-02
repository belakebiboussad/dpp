@extends('app')
@section('main-content')
<div class="page-header">
	<h3>Détails du Fonctionnaire : {{ $assure->Nom }} {{ $assure->Prenom }}</h3>
	<div class="pull-right">
		<a href="{{ route('assur.index') }}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-search bigger-120 blue"></i>Chercher un Fonctionnire
		</a>
		<a href="{{route('assur.destroy',$assure->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-white btn-warning btn-bold">
    			<i class="ace-icon fa fa-trash-o bigger-120 orange"> Supprimer</i>
    		 </a>
    </div>
</div>
.<div class="row">
	<div id="" class="col-sm-6 co-xs-6">	
		<div class="col-xs-4 col-sm-4 center">
			<span class="profile-picture">
				<img class="editable img-responsive" alt="Avatar" id="avatar2" src="{{asset('/avatars/profile-pic.jpg')}}" />
			</span>
			<div class="space space-4"></div>
				<a href="{{ route('assur.edit', $assure->id) }}" class="btn btn-sm btn-block btn-success">
					<i class="ace-icon fa fa-pencil bigger-120"></i>
					<span class="bigger-110">Modifier  Informations</span>
				</a>
				<a  href="patientAssuree/{{$assure->id  }}" class="btn btn-sm btn-block btn-primary" >
					<i class="ace-icon fa fa-plus bigger-120"></i>
					<span class="bigger-110">Ajouter Patient</span>
				</a>
		</div><!-- /.col -->	
		<div class="col-xs-8 col-sm-8">							
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
							<i class="fa fa-map-marker light-orange bigger-110"></i>
							<span class="editable" id="adress">{{ $assure->adresse }}, {{$assure->commune->nom_commune}} {{$assure->wilaya->nom_wilaya}}</span>
						</div>
				</div>
			</div>
			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"> Sexe </div>
						<div class="profile-info-value">
							<span class="editable" id="nom">{{ $assure->Sexe =="M" ? "Homme" : "Femme" }}</span>
						</div>
				</div>
			</div>
			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"> Position actuelle </div>
					<div class="profile-info-value">
						<span class="label label-purple arrowed-in-right">
							<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>{{ $assure->Etat  }}
						</span>
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
					<div class="profile-info-name"> Grade </div>
						<div class="profile-info-value">
							<span class="label label-sm label-primary arrowed arrowed-right">{{ $assure->grade->nom  }}</span>
						</div>
				</div>
			</div>
			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"> Matricule </div>
						<div class="profile-info-value">
							<span class="label label-sm label-primary arrowed arrowed-right">{{ $assure->matricule  }}</span>
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
		</div>
	</div><!-- / col-sm-6-->		
	<div id="" class="col-sm-6 col-xs-6">	
		@if($assure->patients->count() >0)
		<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
			<div class="widget-box widget-color-blue" id="widget-box-2">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ayants droits</h5>
						<div class="widget-toolbar widget-toolbar-light no-border">{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
							<div class="fa fa-plus-circle"></div>
								<a href="patientAssuree/{{$assure->id  }} ">
									<strong>Patient</strong>
								</a>
						</div>
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
									<th class= "center"><em class="fa fa-cog"></em></th>
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
								<td>
									@if( $patient->Type == "Assure")
										 <span class="badge badge-primary">{{ $patient->Type }}</span>
									@else
										{{-- @if($patient->Type_p == "Conjoint(e)")<span class="badge badge-success">{{ $patient->Type_p}}</span>@else --}}
										 <span class="badge badge-info">{{ $patient->Type_p}}</span>
									@endif

								</td>
								<td class= "center">
									<a href="/patient/{{ $patient->id }}" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Consulter le dossier">
										<i class="fa fa-hand-o-up fa-xs"></i>
									</a>
									<!-- /patient/{{ $patient->id }}/edit -->
									<a href="patientAedit/{{ $patient->id  }}/{{ $assure->id  }}" class="btn btn-info btn-xs" data-toggle="tooltip" title="modifier">
										<i class="fa fa-edit fa-xs" aria-hidden="true" ></i>
									</a>
									<a href="{{ route('patient.destroy',$patient->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-white btn-warning btn-bold btn-xs">
    									<i class="ace-icon fa fa-trash-o bigger-120 orange"></i>
    		 					</a>
								</td>
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