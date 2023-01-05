@extends('app')
@section('title','Gestion Rendez_Vous & Lits')
@section('page-script')
<script type="text/javascript">
  var nowDate = new Date();
  var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
   $(function(){
	  $(".addRdvh").on('click', function(event) {
      $('#demande_id').val($(this).val());
      $(".date").datepicker("setDate", now);     
      $(".date_end").datepicker("setDate", now);
      $(".numberDays").val(0);
      $('#rdvHModal').modal('show');
	 	  $('#rdvHModal').on('hidden.bs.modal', function (e) {
        $('#rdvHModal form')[0].reset();
      });
	  });
    $(".numberDays").on('click keyup', function() {
      if( ! isEmpty($('.serviceHosp').val()))
        $(".serviceHosp").prop("selectedIndex", 0).change();
      addDays();
    });
    $(".date").change(function(){
      if( ! isEmpty($('.serviceHosp').val()))
        $(".serviceHosp").prop("selectedIndex", 0).change();
      $('.numberDays').val(0);
      addDays();
    });
    $(".date_end").change(function(){
      if($(".serviceHosp").val() != "")
         $(".serviceHosp").prop("selectedIndex", 0).change();
      updateDureePrevue();
    })
})
</script>
@endsection
@section('main-content')
<div class="page-header"><h4>Demandes d'hospitalisations</h4></div>
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
								<th class="center">Patient</th>
                <th class="center">Genre</th>
                <th class="center">Date</th>
								<th class="center">Mode d'admission</th>
                <th class="center">Spécialité</th>
                <th class="center">Médecin Traitant</th>
								@isset($specialite->dhValid)
                <th class="center" width="3%">Priorité</th>
								<th class="center hidden-xs">Observation</th>					
								@endisset
                <th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						<?php $d=Date::Now().' monday next week' ?>
						@foreach($demandes as $demande)
	           {{--@if(date('d M Y',strtotime(($demande->DemeandeColloque->colloque->date).' monday next week')-1) == date('d M Y',strtotime($d)-1)) --}}
							<tr>
								<td>{{ $demande->consultation->patient->full_name }} </td>
                <td>{{ $demande->consultation->patient->Sexe }} </td>
								<td>{{ $demande->consultation->date->format('Y-m-d') }}</td>
                <td><span class="badge badge-{{( $demande->getModeAdmissionID($demande->modeAdmission)) == 2 ? 'warning':'primary' }}">{{ $demande->modeAdmission }}</span></td>
                <td>{{ $demande->Specialite->nom }}</td>
                <td>
                  {{ isset($specialite->dhValid) ? $demande->DemeandeColloque->medecin->full_name: $demande->consultation->medecin->full_name}}
                </td>
								@isset($specialite->dhValid)
                <td>
                  <span class="badge badge-{{ ($demande->DemeandeColloque->ordre_priorite == 3)  ? 'warning':'primary'  }}">
                  {{ isset($demande->DemeandeColloque) ? $demande->DemeandeColloque->ordre_priorite : '' }}</span>
								</td>
								<td class="hidden-xs">{{ isset($demande->DemeandeColloque) ? $demande->DemeandeColloque->observation : '' }}</td>
							  @endisset
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
<div class="row">@include('rdvHospi.ModalFoms.rdvModalForm')</div>
@endsection