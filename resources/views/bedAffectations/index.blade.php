@extends('app_sur')
@section('main-content')
<div class="row"><h4 style="display: inline;"><strong>Affectation des lits </strong></h4><div class="pull-right"></div></div>
<div class="space-12"></div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des rendez-vous</h5></div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="text-center"><h6><strong>Patient</strong></h6></th>
							<th class="text-center"><h6><strong>Mode d'admission</strong></h6></th>
							<th class="text-center" width="3%"><h6><strong>Priorité</strong></h6></th>
							<th class="text-center"><h6><strong>Médecin traitant</strong></h6></th>
							<th class="text-center"><h6><strong>Date entrée</strong></h6></th>
							<th class="text-center"><h6><strong>Date sortie prévue</strong></h6></th>
						  <th class="text-center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($rdvs as $rdv)
					<tr id="{{ 'demande'.$rdv->demandeHospitalisation->id }}">
						<td>{{$rdv->demandeHospitalisation->consultation->patient->Nom }}
						 {{ $rdv->demandeHospitalisation->consultation->patient->Prenom }}
						</td>
						<td>
							@switch(  $rdv->demandeHospitalisation->modeAdmission )
   							  @case(0)
     								<span class="label label-sm label-primary">Programme</span>
        						@break
        					@case(1)
     								<span class="label label-sm label-success">Ambulatoire</span>
        						@break
        					@case(2)
     								<span class="label label-sm label-warning">Urgence</span>
        						@break		
						  	@endswitch
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
						<td>{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->nom }} &nbsp;{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->prenom }}</td>
						<td>{{ $rdv->date_RDVh }} &nbsp;{{ $rdv->heure_RDVh }}</td>
						<td>{{ $rdv->date_Prevu_Sortie }} &nbsp;{{ $rdv->heure_Prevu_Sortie }}</td>
						<td>
							<button class="btn btn-xs btn-success bedAffect" title="Affecter un lit" value="{{ $rdv->demandeHospitalisation->id }}">
								<i class="fa fa-bed fa-1x" aria-hidden="true"></i>{{-- addAffect({{$rdv->id}}) --}}
							</button>
						</td>
					</tr>
					@endforeach	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div><div class="col-sm-6 col-xs-6"></div>
</div><div class="space-12"></div>
@if(isset($demandesUrg) && $demandesUrg->count())
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 widget-container-col">
		<div class="widget-box widget-color-blue">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Demandes d'hospitalisations urgentes</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="text-center"><h5><strong>Patient</strong></h5></th>
								<th class="text-center"><h5><strong>Mode d'admission</strong></h5></th>
								<th class="text-center"><h5><strong>Date</strong></h5></th>
								<th class="text-center"><h5><strong>Spécialité</strong></h5></th>
								<th class="text-center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach($demandesUrg as $demande)
							<tr id="{{ 'demande'.$demande->id }}">
								<td>{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }}</td>
								<td>
									@switch($demande->modeAdmission)
			   							  @case(0)
			     								<span class="label label-sm label-primary">Programme</span>
			        							@break
			        						@case(1)
			     								<span class="label label-sm label-success">Ambulatoire</span>
			        							@break
			        						@case(2)
			     								<span class="label label-sm label-warning">Urgence</span>
			        							@break		
									 @endswitch
								</td>
								<td>{{ $demande->consultation->Date_Consultation }}</td><td>{{ $demande->Specialite->nom }}</td>
								<td class="text-center">
									<button class="btn btn-xs btn-success bedAffect" title="Affecter un Lits" value="{{ $demande->id }}">
										<i class="fa fa-bed fa-1x" aria-hidden="true"></i>
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
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>	
</div>
@endif
<div class="row">@include('bedAffectations.affecteModalForm')</div>
@endsection