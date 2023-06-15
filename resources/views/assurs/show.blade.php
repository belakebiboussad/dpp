@extends('app')
@section('page-script')
<script>
	jQuery('body').on('click', '.delete-patient', function () {
		 var patient_id = $(this).val();      
	       $.ajax({
		       type: "DELETE",
		       url: '/patient/' + patient_id,
           data: { _token: CSRF_TOKEN },
		       success: function (data) {
		              $("#patient" + patient_id).remove()
		          },
		        error: function (data) {
		              	console.log('Error:', data);
		        }
	      	});
	});
</script>
@stop
@section('main-content')
<div class="page-header">
	<h1>Détails du fonctionnaire : {{ $assure->full_name }}</h1>
	<div class="pull-right">
		<a href="{{ route('assur.index') }}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-search bigger-120 blue"></i>Rechercher un fonctionnire</a>
		<a href="{{route('assur.destroy',$assure->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-white btn-warning btn-bold"><i class="ace-icon fa fa-trash-o bigger-120 orange"> Supprimer</i></a>
   </div>
</div>
<div class="row">
	<div id="" class="col-sm-6 co-xs-6">	
		<div class="col-xs-4 col-sm-4 center">
			<span class="profile-picture">
				<img class="editable img-responsive" alt="Avatar" id="avatar2" src="{{asset('/avatars/profile-pic.jpg')}}" />
			</span><div class="space space-4"></div>
{{--<a href="{{ route('assur.edit', $assure->id) }}" class="btn btn-sm btn-block btn-success"><i class="ace-icon fa fa-pencil"></i><span>Modifier</span>
				</a> --}}
				<a  href="patientAssuree/{{$assure->id  }}" class="btn btn-sm btn-block btn-primary" >
					<i class="ace-icon fa fa-plus bigger-120"></i>
					<span class="bigger-110">Patient</span>
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
							<span class="editable" id="nom">{{ $assure->dob }} à {{ $assure->POB->nom }} </span>
						</div>
				</div>
			</div>
			@if(isset($assure->commune_res))
			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"> Adresse </div>
						<div class="profile-info-value">
							<i class="fa fa-map-marker light-orange bigger-110"></i>
							<span class="editable" id="adress">{{ $assure->adresse }}, {{$assure->commune->daira->wilaya->name}} {{$assure->wilaya->nom}}</span>
						</div>
				</div>
			</div>
			@endif
			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"> Genre </div>
						<div class="profile-info-value">
							<span class="editable" id="nom">{{ $assure->Sexe =="M" ? "Masculin" : "Féminin" }}</span>
						</div>
				</div>
			</div>
			<div class="profile-user-info profile-user-info-striped">
				<div class="profile-info-row">
					<div class="profile-info-name"> Sécurité sociale </div>
					<div class="profile-info-value">
						<span class="editable" id="nom">{{ $assure->NSS }}</span>
					</div>
				</div>
			</div>
		</div>
	</div><!-- / col-sm-6-->		
	<div id="" class="col-sm-6 col-xs-6">	
		@if($assure->patients->count() >0)
		<div class="col-xs-12 widget-container-col">
			<div class="widget-box widget-color-blue">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ayants droits</h5>
						<div class="widget-toolbar widget-toolbar-light no-border">{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
							<div class="fa fa-plus-circle"></div>
							<a href="patientAssuree/{{$assure->id}} "><b>Patient</b></a>
						</div>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th class= "center">#</th>
									<th class= "center">Nom</th>
									<th class= "center">Prénom</th>
									<th class= "center">Né(e) le</th>
									<th class= "center">Type</th>
									<th class= "center"><em class="fa fa-cog"></em></th>
								</tr>
							</thead>
							<tbody>
							<?php $j = 1; ?>
							@foreach($assure->patients as $patient)	
							<tr id="{{ 'patient'.$patient->id }}">
								<td>{{$j++}}</td>
								<td>{{ $patient->Nom}}</td>
								<td> {{ $patient->Prenom}}</td>
								<td> {{ $patient->dob->format('Y-m-d') }}</td>
								<td><span class="label label-sm label-success">{{ $patient->Type->nom }}</span></td>
								<td class= "center">
									<a href="/patient/{{ $patient->id }}" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Consulter le dossier">
										<i class="fa fa-hand-o-up fa-xs"></i>
									</a>
									<a href="patientAedit/{{ $patient->id  }}/{{ $assure->id  }}" class="btn btn-info btn-xs" data-toggle="tooltip" title="modifier">
										<i class="fa fa-edit fa-xs" aria-hidden="true" ></i>Editer
									</a>
									 <button type="button" class="btn btn-xs btn-danger delete-patient" value="{{ $patient->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>
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
@stop