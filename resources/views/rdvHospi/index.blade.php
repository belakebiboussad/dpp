@extends('app_sur')
@section('title')
Gestion Rendez_Vous & Lits
@endsection
@section('page-script')
<script>
	jQuery('body').on('click', '#bedAffect', function (event) {
		$('#demande_id').val($(this).val());
		jQuery('#bedAffectModal').modal('show');
	});
	jQuery('body').on('click', '#bedAffect', function (event) {
		e.preventDefault();
		var formData = {
			    Patient_ID_Patient      : '{{ $patient->id }}',
				  Antecedant           : 'Personnels',//jQuery('#Antecedant').val()
				  typeAntecedant       : jQuery('#typeAntecedant').val(),
				  stypeatcd            : jQuery('#sstypeatcdc').val(),
				  date                    : $('#dateAntcd').val(),
				  descrioption         : $("#description").val(),
	   	  };

	});	
</script>
@endsection
@section('main-content')
<div class="widget-header">
	<h5 class="widget-title bigger lighter">
		<i class="fa fa-list" aria-hidden="true"></i>&nbsp;Demandes Hospitalisations
	</h5>
</div>
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des demandes de la semaine</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="text-center"><h5><strong>Patient</strong></h5></th>
								<th class="text-center"><h5><strong>Mode Admission</strong></h5></th>
								<th class="text-center" width="3%"><h5><strong>Priorité</strong></h5></th>
								<th class="text-center"><h5><strong>Medecin Trait.</strong></h5></th>
								<th class="text-center"><h5><strong>Observation</strong></h5></th>
								<th class="text-center"><h5><strong>date</strong></h5></th>
								<th class="text-center"><h5><strong>spécialité</strong></h5></th>
								<th class="text-center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						<?php $d=Date::Now().' monday next week' ?>
						@foreach($demandes as $demande)
							@if(date('d M Y',strtotime(($demande->date).' monday next week')-1) == date('d M Y',strtotime($d)-1))
							<tr>
								<td>{{ $demande->demandeHosp->consultation->patient->Nom }} {{ $demande->demandeHosp->consultation->patient->Prenom }}</td>
								<td>{{ $demande->demandeHosp->modeAdmission }}</td>
								<td>
									@switch($demande->ordre_priorite)
										 @case(1)
 											<span class="label label-sm label-success">{{ $demande->ordre_priorite }}</span>
    									@break
										@case(2)
   											<span class="label label-sm label-warning">{{ $demande->ordre_priorite }}</span>
    										@break
										@case(3)
											<span class="label label-sm label-danger">{{ $demande->ordre_priorite }}</span>
											@break
    								@default
  										<span class="label label-sm label-success">{{ $demande->ordre_priorite }}</span>
  										@break
									@endswitch
								</td>
								<th>{{ $demande->medecin->nom }} &nbsp; {{ $demande->medecin->prenom }}</th>
								<td>{{ $demande->observation }}</td>
								<td>{{ $demande->demandeHosp->consultation->Date_Consultation }}</td>
								<td>{{ $demande->demandeHosp->Specialite->nom }}</td>
								<td class="text-center">
									<div class="hidden-sm hidden-xs btn-group">
										<a href="{{ route('rdvHospi.create',['id' =>$demande->id_demande ]) }}" class="btn btn-xs btn-success" title="Ajouter Rendez-Vous">
											<span syle="color:green">
												<i class="fa fa-clock-o" aria-hidden="true"></i>
											</span>

										</a>
									</div>
									</td>
								</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!-- /.span -->
</div>
<div class="space-12"></div><div class="space-12"></div>
<div class="widget-header">
	<h5 class="widget-title bigger lighter">
		<i class="fa fa-list" aria-hidden="true"></i>&nbsp;Demandes Hospitalisations Urgentes
	</h5>
</div>
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-red" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des demandes d'urgence</h5>
			</div>
		</div>
		<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="text-center"><h5><strong>Patient</strong></h5></th>
								<th class="text-center"><h5><strong>Mode Admission</strong></h5></th>
								<th class="text-center"><h5><strong>date</strong></h5></th>
								<th class="text-center"><h5><strong>spécialité</strong></h5></th>
								<th class="text-center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach($demandesUrg as $demande)
							<tr>
								<td>{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }}</td>
								<td>{{ $demande->modeAdmission }}</td>
								<td>{{ $demande->consultation->Date_Consultation }}</td>					
								<td>{{ $demande->Specialite->nom }}</td>
								<td class="text-center"><!-- {{ route('lit.affecter',['id' =>$demande->id ]) }} -->
									<button class="btn btn-xs btn-success" title="Affecter un Lits" id ="bedAffect" value="{{ $demande->id }}">
										<span style="color: red;"><i class="fa fa-bed fa-1x" aria-hidden="true"></i></span>
									</button>
									<a href="{{route('rdvHospi.destroy',$demande->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
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
<div class="row">@include('lits.affecteModalForm')
	
</div>
@endsection