@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	$(document).ready(function(){
		$("#addReserv").on('click', function() 
	  {
  		 alert('fdgfd');
  	});
	});
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Rendez-Vous</h5>
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
							<th class="text-center"><h5><strong>Date Entrée</strong></h5></th>
							<th class="text-center"><h5><strong>Date Sortie Prévue</strong></h5></th>
						  <th class="text-center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($rdvs as $rdv)
					<tr>
						<td>{{$rdv->demandeHospitalisation->consultation->patient->Nom }}
						 {{ $rdv->demandeHospitalisation->consultation->patient->Prenom }}
						</td>
						<td>
							{{ $rdv->demandeHospitalisation->modeAdmission }}
						</td>
						<td>
						@switch($rdv->demandeHospitalisation->ordre_priorite)
		  				@case(1)
								<span class="label label-sm label-success">{{$rdv->demandeHospitalisation->DemeandeColloque->ordre_priorite }}</span>
							  @break
						  @case(2)
								<span class="label label-sm label-warning">{{ $rdv->demandeHospitalisation->DemeandeColloque->ordre_priorite }}</span>
								@break
						  @case(3)
							  <span class="label label-sm label-danger">{{ $rdv->demandeHospitalisation->DemeandeColloque->ordre_priorite }}</span>
							  @break
						  @default
							  <span class="label label-sm label-success">{{ $rdv->demandeHospitalisation->DemeandeColloque->ordre_priorite }}</span>
							  @break
						@endswitch
						</td>
						<td>
							{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->nom }} &nbsp; 
							{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->prenom }}
						</td>
						<td>{{ $rdv->date_RDVh }} &nbsp;{{ $rdv->heure_RDVh }}</td>
						<td>{{ $rdv->date_Prevu_Sortie }} &nbsp;{{ $rdv->heure_Prevu_Sortie }}</td>
						<td><!-- {{ route('reservation.create',['id' =>$rdv->id ]) }} -->
							<a href="#" class="btn btn-xs btn-success" id ="addReserv" title="Réserver Lit">
						
							<i class="fa fa-bed fa-1x" aria-hidden="true"></i>
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
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	</div>
</div>
@endsection