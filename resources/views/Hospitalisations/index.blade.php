@extends('app')
@section('style')
<style>

</style>
@endsection
@section('page-script')
<script>
$('document').ready(function(){

	jQuery('.cloturerHosp').click(function () {
	  var hospID = $(this).data('id');
	  $("#hospID").val( hospID );
	  $('#Heure_sortie').timepicker({
      timeFormat: 'HH:mm',
      interval: 60,
      minTime: '08',
      maxTime: '17:00pm',
      defaultTime: '09:00',   
      startTime: '08:00',
      dynamic: true,
      dropdown: true,
      scrollbar: true,
      //template: 'modal'
    });
	});
	jQuery('#saveCloturerHop').click(function () {
	  var hospID =$("#hospID").val();
	});
});
</script>
@endsection
@section('main-content')
	<div class="page-header">
		<h1>
			<strong>Liste des Hospitalisations :</strong>
		</h1>
	</div><!-- /.page-header -->
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Hospitalisations</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center">Patient</th>
								<th class="center">Mode Admission</th>
								<th class="center">Date Entrée</th>
								<th class="center">Date Sortie Prévue</th>
								<th class="center">Date Sortie</th>
								<th class="center">Médecin</th>
								<th class="center">Etat</th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach( $hospitalisations as $hosp)
								<tr id={{{$hosp->id}}}>
									<td>
										@if(Auth::user()->role->id == 1)
											<a href="/patient/{{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient->id}}/edit">
												{{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient->Nom }}
												{{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient->Prenom }}
											</a>
											@else
											{{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient->Nom }}
											{{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient->Prenom }}
										@endif
									</td>
									<td>{{ $hosp->admission->rdvHosp->demandeHospitalisation->modeAdmission }}</td>
									<td><span class ="text-danger">{{ $hosp->Date_entree }}</span></td>
								  <td><span class ="text-danger">{{ $hosp->Date_Prevu_Sortie }}</span></td>
							  	<td>{{ $hosp->Date_Sortie == null ? "Pas encore" : $hosp->Date_Sortie }}</td>
							  	<td>
							  		{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->Nom_Employe }}
							  		{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->Prenom_Employe }}
							  	</td>
							  	<td><span class="badge badge-pill badge-success">{{ $hosp->etat_hosp }}</span></td>
							  	<td class="center">
							  		<a href="{{ route('hospitalisation.show',$hosp->id)}}" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Voir détails..." data-placement="bottom">
							  				<i class="fa fa-hand-o-up fa-xs bigger-120" aria-hidden="true"></i>&nbsp;</a>
							  		</a>
							  		@if(! in_array(Auth::user()->role_id,[3,9]))
							  	  	<a href="{{ route('hospitalisation.edit',$hosp->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier l'Hospitalisation" data-placement="bottom">
							  				<i class="fa fa-edit fa-xs bigger-120" aria-hidden="true"></i>
							  			</a>
							  	   	@if(Auth::user()->role_id == 1)
							  	  		<a href="/visite/create/{{ $hosp->id }}" class ="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Visite" data-placement="bottom"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i></a>
							  	  	 	<!-- <button class="btn btn-info btn-xs" type="button" data-toggle="modal" data-target="#sortieHosp" title="Clôturer Hospitalisation" value=" {{$hosp->id }}"><i class="fa fa-sign-out" aria-hidden="true" style="font-size:16px;"></i></button> -->
							  	  	 	<a data-toggle="modal" data-id="{{ $hosp->id}}" title="Clôturer Hospitalisation" class="cloturerHosp btn btn-primary btn-xs" href="#sortieHosp"><i class="fa fa-sign-out" aria-hidden="true" style="font-size:16px;"></i></a>
							  	  	@endif
							  	  	@if(Auth::user()->role_id == 5)
							  	  		<a class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Imprimer un ticket" data-placement="bottom"><i class="ace-icon glyphicon glyphicon-print bigger-120"></i></a>
							  	  	@endif
							  	  @else
							  	  	@if(Auth::user()->role_id != 9)
							  	  	<a href="{{ route('visites.edit', $hosp->id)}}" class ="btn btn-primary btn-xs" data-toggle="tooltip" title="voir Actes" data-placement="bottom"><i class="fa fa-folder-open fa-lg bigger-120"></i></a>
							  	  	@endif
							  	  @endif
							  	</td>	
								</tr>
							@endforeach
						</tbody>
					</table>
				</div><!-- widget-main -->
		  	</div>	<!-- widget-body -->
		 </div> <!-- widget-box -->
	</div>
	<div class="row">@include('Hospitalisations.sortieModal')</div>
@endsection
