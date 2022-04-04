@extends('app')
@section('title','Gestion Rendez_Vous & Lits')
@section('page-script')
<script type="text/javascript">
$(function(){
	 $(".addRdvh").on('click', function(event) {
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
	<div class="col-xs-12 widget-container-col">
		<div class="widget-box widget-color-blue">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des demandes de la semaine</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center"><h5><strong>Patient</strong></h5></th>
								<th class="center"><h5><strong>Mode d'admission</strong></h5></th>
								<th class="center" width="3%"><h5><strong>Priorité</strong></h5></th>
								<th class="center"><h5><strong>Médecin Traitant</strong></h5></th>
								<th class="center hidden-xs"><h5><strong>Observation</strong></h5></th>
								<th class="center"><h5><strong>Date</strong></h5></th>
								<th class="center"><h5><strong>Spécialité</strong></h5></th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						<?php $d=Date::Now().' monday next week' ?>
						@foreach($demandes as $demande)
	           @if(date('d M Y',strtotime(($demande->DemeandeColloque->colloque->date).' monday next week')-1) == date('d M Y',strtotime($d)-1)) 
							<tr>
								<td>{{ $demande->consultation->patient->full_name }} </td>
								<td>{{ $demande->modeAdmission }}</td>
								<td>
                                                                <span class="badge badge-{{ ($demande->DemeandeColloque->ordre_priorite == 3)  ? 'warning':'primary'  }}">
                                                                         {{ $demande->DemeandeColloque->ordre_priorite }}</span>
								</td>
								<th>{{ $demande->DemeandeColloque->medecin->full_name }}</th>
								<td class="hidden-xs">{{ $demande->DemeandeColloque->observation }}</td>
								<td>{{ $demande->consultation->date }}</td>
								<td>{{ $demande->Specialite->nom }}</td>
								<td class="center">
									<div class="btn-group">
										<button class="btn btn-sm btn-success addRdvh"  title="Affecter un Rendez-Vous" value="{{ $demande->id }}">
											<i class="fa fa-clock-o" aria-hidden="true"></i>
										</button>
									</div>
								</td>
								</tr>
								{{-- @endif --}}
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
								<td><span class="label label-sm label-warning">Urgence</span></td>
								<td>{{ $demande->consultation->date }}</td><td>{{ $demande->Specialite->nom }}</td>
								<td class="center">
									<button class="btn btn-xs btn-success bedAffect" title="Affecter un lit" value="{{ $demande->id }}" data-Pid = '{{ $demande->consultation->patient->id }}'><i class="fa fa-bed fa-1x" aria-hidden="true"></i>
									</button>
{{-- <a href="{{route('rdvHospi.destroy',$demande->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-120"></i>
									</a> --}}
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