@extends('app_sur')
@section('main-content')
<div class="page-header"><h4>Affectation des lits</h4></div>
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-6 col-xs-6 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des rendez-vous</h5></div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center">Patient</th>
             	<th class="center">Mode d'admission</th>
						  @isset($specialite->dhValid)
            	<th class="center" width="3%">Priorité</th>
							@endisset 
              <th class="center">Médecin traitant</th>
							<th class="center">Date entrée</th>
							<th class="center">Date sortie prévue</th>
						  <th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($rdvs as $rdv)
					<tr id="{{ 'demande'.$rdv->demandeHospitalisation->id }}">
						<td>{{$rdv->demandeHospitalisation->consultation->patient->full_name }}</td>
						<td><span class="label label-sm label-primary">{{ $rdv->demandeHospitalisation->modeAdmission }}</span></td>
						@isset($specialite->dhValid)
            <td>
             <span class="badge badge-{{ ($demande->DemeandeColloque->ordre_priorite == 3)  ? 'warning':'primary'  }}">
              {{ isset($rdv->demandeHospitalisation) ? $rdv->demandeHospitalisation->ordre_priorite : '' }}</span>
				    </td>
            @endisset
						<td>
            {{ isset($specialite->dhValid) ? $rdv->demandeHospitalisation->medecin->full_name: $rdv->demandeHospitalisation->consultation->medecin->full_name}}
            </td>
						<td>{{ $rdv->date_ent }}</td><td>{{ $rdv->date_prevsor }}</td>
						<td>
							<button class="btn btn-xs btn-success bedAffect" title="Affecter un lit" value="{{ $rdv->demandeHospitalisation->id }}">
								<i class="fa fa-bed fa-1x" aria-hidden="true"></i>
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
		<div class="widget-box widget-color-red">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Demandes d'hospitalisations urgentes</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center"><h5><strong>Patient</strong></h5></th>
								<th class="center"><h5><strong>Mode d'admission</strong></h5></th>
								<th class="center"><h5><strong>Date</strong></h5></th>
								<th class="center"><h5><strong>Spécialité</strong></h5></th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach($demandesUrg as $demande)
							<tr id="{{ 'demande'.$demande->id }}">
								<td>{{ $demande->consultation->patient->full_name }}</td>
								<td><span class="label label-sm label-warning">{{ $demande->modeAdmission }}</span></td>
	        						<td>{{ $demande->consultation->date }}</td><td>{{ $demande->Specialite->nom }}</td>
								<td class="center">
									<button class="btn btn-xs btn-success bedAffect" title="Affecter un Lits" value="{{ $demande->id }}">
										<i class="fa fa-bed fa-1x" aria-hidden="true"></i>
									</button>
{{-- <a href="{{route('rdvHospi.destroy',$demande->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-trash-o bigger-120"></i></a> --}}
									
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