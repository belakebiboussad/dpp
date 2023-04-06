@extends('app')
@section('main-content')
<div class="page-header"><h1>Réserver un lit</h1></div>
<div class="row">
	<div class="col-sm-12 col-xs-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i> Liste des rendez-vous</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center">Patient</th>
              <th class="center">Genre</th>
							<th class="center">Mode d'admission</th>
							@isset($specialite->dhValid)
              <th class="center" width="3%">Priorité</th>
							@endisset
              <th class="center">Service</th>
              <th class="center">Specialité</th>
              <th class="center">Médecin traitant</th>
							<th class="center">Date d'entrée</th>
							<th class="center">Date sortie prévue</th>
						  <th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($rdvs as $rdv)
					<tr id ="{{ 'rdv-' . $rdv->id }}">
						<td>{{ $rdv->demandeHospitalisation->consultation->patient->full_name }}</td>
            <td>{{ $rdv->demandeHospitalisation->consultation->patient->Sexe }}</td>
						<td>
		          <span class="badge badge-{{( $rdv->demandeHospitalisation->getModeAdmissionID($rdv->demandeHospitalisation->modeAdmission)) == 2 ? 'warning':'primary' }}">
              {{ $rdv->demandeHospitalisation->modeAdmission }}</span>
						</td>
						@isset($specialite->dhValid)
            <td>
            @isset($specialite->dhValid,$rdv->demandeHospitalisation->DemeandeColloque)
						<span class="badge badge-{{ ($rdv->demandeHospitalisation->DemeandeColloque->ordre_priorite == 3)  ? 'warning':'primary'  }}">
                  {{ isset($rdv->demandeHospitalisation->DemeandeColloque) ? $rdv->demandeHospitalisation->DemeandeColloque->ordre_priorite : '' }}</span>
            @endisset
						</td>
            @endisset
            <td>{{ $rdv->demandeHospitalisation->Service->nom }}</td>
            <td>{{ $rdv->demandeHospitalisation->Specialite->nom }}</td>
						<td>
              {{ isset($specialite->dhValid, $rdv->demandeHospitalisation->DemeandeColloque) ? $rdv->demandeHospitalisation->DemeandeColloque->medecin->full_name : $rdv->demandeHospitalisation->consultation->medecin->full_name}}
				    </td>
						<td>{{ $rdv->date_ent }}</td><td>{{ $rdv->date_prevsor }}</td>
						<td class="center">
							<button class="btn btn-xs btn-success addReserv" value ='{{ $rdv->id }}' title="Réserver un lit">
							 	<i class="fa fa-bed" aria-hidden="true"></i>
							</button>
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
<div class="row">@include('reservations.ModalFoms.addReservModal')</div>
@stop
@section('page-script')
<script type="text/javascript">
  $(function(){
    $(".addReserv").click(function(e){
      e.preventDefault();
      $('#rdv_id').val($(this).val());
      $.get('/rdvHospi/' + $(this).val() + '/edit', function (data) { 
        $(".date").val(data['date']);
        $(".date_end").val(data['date_Prevu_Sortie']);
        $('.demande_id').val(data['id_demande']);
        $('#bedReservModal').modal('show');
      });   
    });
    $("#saveReservation").click(function(e){   // $('#addReservationForm').submit(); // $("#serviceh").selct(0);
      e.preventDefault();
      var formData = { _token: CSRF_TOKEN, id_rdvHosp:$("#rdv_id").val(), id_lit:$(".lit_id").val()};
      var url = "{{ route('reservation.store') }}"; 
       $.ajax({
            type : 'POST',
            url :url,
            data:formData,
            success:function(data){
              $("#rdv-" + data.id_rdvHosp).remove();
              $(".serviceHosp").prop("selectedIndex", 0).change();
              $('#bedReservModal').modal('hide');
            },
      }); 
    });
  })
</script>
@stop