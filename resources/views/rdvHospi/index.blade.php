@extends('app')
@section('title','Gestion Rendez_Vous & Lits')
@section('page-script')
<script type="text/javascript">
$(function(){
	 $("#addRdvh").on('click', function(event) {
	 	 $('#demande_id').val($(this).val());
	 	 jQuery('#rdvHModal').modal('show');
	 	 $('#rdvHModal').on('hidden.bs.modal', function (e) {
                            $('#rdvHModal form')[0].reset();
           	 });
	 });
})
function updateDureePrevue()
{
	if($("#dateEntree").val() != undefined) {
		var dEntree = $('#dateEntree').datepicker('getDate');
 		var dSortie = $('#dateSortiePre').datepicker('getDate');
		var iSecondsDelta = dSortie - dEntree;
		var iDaysDelta = iSecondsDelta / (24 * 60 * 60 * 1000);
		if(iDaysDelta < 0)
		{
			iDaysDelta = 0;
			$("#dateSortiePre").datepicker("setDate", dEntree); 
		}
		$('#numberDays').val(iDaysDelta );	
	}
}
var nowDate = new Date();
var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
$('document').ready(function(){
 	$("#dateEntree").datepicker("setDate", now);			
  	$("#dateSortiePre").datepicker("setDate", now);
});
</script>
@endsection
@section('main-content')
<div class="widget-header">
	<h5 class="widget-title bigger lighter"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;<strong>Demandes d'hospitalisations</strong></h5>
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
								<th class="text-center"><h5><strong>Mode d'admission</strong></h5></th>
								<th class="text-center" width="3%"><h5><strong>Priorité</strong></h5></th>
								<th class="text-center"><h5><strong>Médecin Traitant</strong></h5></th>
								<th class="text-center hidden-xs"><h5><strong>Observation</strong></h5></th>
								<th class="text-center"><h5><strong>Date</strong></h5></th>
								<th class="text-center"><h5><strong>Spécialité</strong></h5></th>
								<th class="text-center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						<?php $d=Date::Now().' monday next week' ?>
						@foreach($demandes as $demande)
							@if(date('d M Y',strtotime(($demande->date).' monday next week')-1) == date('d M Y',strtotime($d)-1))
							<tr>
								<td>{{ $demande->demandeHosp->consultation->patient->Nom }} {{ $demande->demandeHosp->consultation->patient->Prenom }}</td>
								<td>
									@switch( $demande->demandeHosp->modeAdmission )
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
								<td class="hidden-xs">{{ $demande->observation }}</td>
								<td>{{ $demande->demandeHosp->consultation->Date_Consultation }}</td>
								<td>{{ $demande->demandeHosp->Specialite->nom }}</td>
								<td class="text-center">
									<div class="btn-group">
										<button class="btn btn-sm btn-success" id="addRdvh" title="Affecter un Rendez-Vous" value="{{ $demande->id_demande }}">
											<i class="fa fa-clock-o" aria-hidden="true"></i>
										</button>
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
@if(isset($demandesUrg) && $demandesUrg->count() )
<div class="space-12"></div><div class="space-12"></div>
<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;<strong>Demandes d'hospitalisations urgentes</strong></h5></div>
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-red" id="widget-box-2">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des demandes d'urgence</h5></div>
		</div>
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
									<button class="btn btn-xs btn-success bedAffect" title="Affecter un lit" value="{{ $demande->id }}" data-Pid = '{{ $demande->consultation->patient->id }}'>
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
@endif
<div class="row">@include('rdvHospi.ModalFoms.rdvModalForm')</div>
<div class="row">@include('bedAffectations.affecteModalForm')</div>
@endsection