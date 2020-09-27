@extends('app_sur')
@section('main-content')
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
								<td>
									{{ $demande->demandeHosp->consultation->Date_Consultation }}
								</td>
								<td>{{ $demande->demandeHosp->Specialite->nom }}</td>
								<td>
									<div class="hidden-sm hidden-xs btn-group">
										<a href="{{ route('rdvHospi.create',['id' =>$demande->id_demande ]) }}" class="btn btn-xs btn-success">
											<i class="fa fa-plus fa-xs"></i> &nbsp;RDV Hospitalisaton
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

<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-red" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des demandes d'urgence</h5>
			</div>
		</div>
	</div>
</div>

		

@endsection