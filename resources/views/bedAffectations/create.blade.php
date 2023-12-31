@extends('app')
@section('main-content')
<div class="page-header"><h2>Affecter un lit</h2></div>
<div class="row">
	<div class="col-sm-12 col-xs-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header"><h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Liste des rendez-vous</h5></div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th rowspan="2"  class="center">Patient</th>
              <th rowspan="2" class="center">Genre</th>
             	<th rowspan="2"  class="center">Mode d'admission</th>
						  @isset($specialite->dhValid)
            	<th  rowspan="2" class="center" width="3%">Priorité</th>
							@endisset 
              <th rowspan="2" class="center">Service</th>
              <th rowspan="2" class="center">Specialité</th>
              <th rowspan="2" class="center">Médecin traitant</th>
							<th rowspan="2" class="center">Date entrée</th>
							<th rowspan="2" class="center">Date sortie prévue</th>
              <th colspan="3" scope="colgroup" class="center">Lit reservé</th>
						  <th rowspan="2" class="center"><em class="fa fa-cog"></em></th>
						</tr>
            <tr>
              <th scope="col" class="center">Service</th>
              <th scope="col" class="center">Salle</th>
              <th scope="col" class="center">Lit</th>              
            </tr>
					</thead>
					<tbody>
					@foreach($rdvs as $rdv)
					<tr id="{{ 'demande'.$rdv->demandeHospitalisation->id }}">
						<td>{{ $rdv->demandeHospitalisation->consultation->patient->full_name }}</td>
            <td>{{ $rdv->demandeHospitalisation->consultation->patient->Sexe }}</td>
						<td>
              <span class="badge badge-{{( $rdv->demandeHospitalisation->getModeAdmissionID($rdv->demandeHospitalisation->modeAdmission)) == 2 ? 'warning':'primary' }}">
                  {{ $rdv->demandeHospitalisation->modeAdmission }}
              </span>
            </td>
            @isset($specialite->dhValid)
            <td>
             <span class="badge badge-{{ ($demande->DemeandeColloque->ordre_priorite == 3)  ? 'warning':'primary'  }}">
              {{ isset($rdv->demandeHospitalisation) ? $rdv->demandeHospitalisation->ordre_priorite : '' }}</span>
				    </td>
            @endisset
            <td>{{ $rdv->demandeHospitalisation->Service->nom }}</td>
            <td>{{ $rdv->demandeHospitalisation->Specialite->nom }}</td>
						<td>
            {{ isset($specialite->dhValid) ? $rdv->demandeHospitalisation->medecin->full_name: $rdv->demandeHospitalisation->consultation->medecin->full_name}}
            </td>
						<td>{{ $rdv->date_ent }}</td><td>{{ $rdv->date_prevsor }}</td>
            @if($rdv->bedReservation)
            <td>{{ $rdv->bedReservation->lit->salle->service->nom }}</td>
            <td>{{ $rdv->bedReservation->lit->salle->nom }}</td><td>{{ $rdv->bedReservation->lit->nom }}</td>
            @else
              <td></td><td></td><td></td>
            @endif
					<td class="center">
						<button class="btn btn-xs btn-success bedAffect" title="Affecter un lit" value="{{ $rdv->demandeHospitalisation->id }}"><i class="fa fa-bed" aria-hidden="true"></i></button>
				  </td>
					</tr>
					@endforeach	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>
</div><div class="space-12"></div>
@if(isset($demandesUrg) && $demandesUrg->count())
<div class="row">
	<div class="col-sm-12 col-xs-12 widget-container-col">
		<div class="widget-box widget-color-red">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="fa fa-list" aria-hidden="true"></i> Demandes d'hospitalisations urgentes</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center">Patient</th> <th class="center">Genre</th>
               	<th class="center">Mode d'admission</th><th class="center">Date entrée</th>
							  <th class="center">Service</th><th class="center">Spécialité</th>
                <th class="center">Médecin traitant</th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach($demandesUrg as $demande)
							<tr id="{{ 'demande'.$demande->id }}">
								<td>{{ $demande->consultation->patient->full_name }}</td>
                <td>{{ $demande->consultation->patient->Sexe }}</td>
            		<td><span class="label label-sm label-warning">{{ $demande->modeAdmission }}</span></td>
                <td>{{ $demande->consultation->date->format('Y-m-d') }}</td>
                <td>{{ $demande->Service->nom }}</td>
                <td>{{ $demande->Specialite->nom }}</td>
                <td>{{ $demande->consultation->medecin->full_name }}</td>  
								<td class="center">
									<button class="btn btn-xs btn-success bedAffect" title="Affecter un Lits" value="{{ $demande->id }}"><i class="fa fa-bed fa-1x" aria-hidden="true"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
  </div>
</div>
@endif
<div class="row">@include('bedAffectations.ModalFoms.addAffecteModal')</div>
@stop
@section('page-script')
<script type="text/javascript">
$(function(){
  $('body').on('click', '.bedAffect', function (event) {
    $('.demande_id').val($(this).val());
    $('#patient_id').val($(this).attr('data-Pid'));//cas dh urg
    $('#bedAffectModal').modal('show');
    $('#bedAffectModal').on('hidden.bs.modal', function (e) {
      $('#bedAffectModal form')[0].reset();
    });
  });
  jQuery('body').on('click', '#AffectSave', function (e) {
    e.preventDefault();
    var formData = {
       _token: CSRF_TOKEN,
      demande_id : $('.demande_id').val(),
      lit_id     : $('.lit_id').val()
    }; 
    $.ajax({
        url : '{{ route ("bedAffectation.store") }}',
        type:'POST',
        data:formData,
        success: function (data) {
          $("#demande" + formData['demande_id']).remove();
          $('#bedAffectModal').trigger("reset");
          $('#bedAffectModal').modal('hide'); 
        }
   });
  });
})
</script>
@stop
