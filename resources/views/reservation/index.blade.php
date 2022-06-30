@extends('app'){{-- @extends('app_sur') --}}
@section('page-script')
<script type="text/javascript">
	function addReserv(rdv_id)
	{
		$('#rdv_id').val(rdv_id);
		$('#addReservationForm').removeAttr('hidden');
	}
	$(function(){
		$("#addReserv").click(function(){
			$('#rdv_id').val($(this).val());
			$('.demande_id').val($(this).attr('data-demande-id'));
			$('#addReservationForm').removeAttr('hidden');
		})
	})
	$(document).ready(function(){
		$("#saveReservation").click(function(){
			$('#addReservationForm').submit();
			$("#serviceh").selct(0);
		});
	});
</script>
@endsection
@section('main-content')
<div class="row"><h4 style="display: inline;"><strong>Réserver un lit </strong></h4><div class="pull-right"></div></div>
<div class="space-12"></div>
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des rendez-vous</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center"><h6><strong>Patient</strong></h6></th>
							<th class="center"><h6><strong>Mode d'admission</strong></h6></th>
							<th class="center" width="3%"><h6><strong>Priorité</strong></h6></th>
							<th class="center"><h6><strong>Médecin traitant</strong></h6></th>
							<th class="center"><h6><strong>Date d'entrée</strong></h6></th>
							<th class="center"><h6><strong>Date sortie prévue</strong></h6></th>
						  <th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($rdvs as $rdv)
					<tr>
						<td>{{$rdv->demandeHospitalisation->consultation->patient->full_name }}</td>
						<td>
							@switch($rdv->demandeHospitalisation->modeAdmission)
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
						<td>
							{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->full_name }} </td>
						<td>{{ $rdv->date }} &nbsp;{{ $rdv->heure }}</td>
						<td>{{ $rdv->date_Prevu_Sortie }} &nbsp;{{ $rdv->heure_Prevu_Sortie }}</td>
						<td><!--<a class="btn btn-xs btn-success" id ="addReserv"><i class="fa fa-bed fa-1x" aria-hidden="true"></i></a> 
onclick ="addReserv({{$rdv->id}})"-->
							<button class="btn btn-xs btn-success" id ="addReserv" value ='{{ $rdv->id }}' data-demande-id = "{{ $rdv->demandeHospitalisation->id }}" title="Réserver un lit">
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
	</div>
	<div class="col-md-4 col-sm-4 col-xs-4 col-md-offset-1">
	<form id="addReservationForm" action="{{ route('reservation.store') }}" method="POST" accept-charset="utf-8" role="form" hidden>
		{{ csrf_field() }}
		<input type="hidden" id="rdv_id" name="rdv_id">
    <input type="hidden" id="affect" value="0">
    <input type="hidden" class="demande_id" name="demande_id" value="">	
		<div class="form-group">
      <label for="serviceh">Service :</label>
      <select id="serviceh" class="form-control selectpicker serviceHosp"/>
        <option value="" selected disabled>Selectionnez un service</option>
        @foreach($services as $service)
        <option value="{{ $service->id }}">{{ $service->nom }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="salle">Salle :</label>
      <select id="salle" class="form-control selectpicker salle"/>
        <option value="" selected disabled>Selectionnez  une salle</option>
      </select>
    </div>
    <div class="form-group">
      <label for="lit_id">Lit :</label>
      <select id="lit_id" name="lit_id" class="form-control selectpicker lit_id"/>
        <option value="" selected disabled>Selectionnez un lit</option>
      </select>
    </div>
	 <div class="row">
			<div class="col-sm12">
				<div class="center bottom" style="bottom:0px;">
					<button class="btn btn-info btn-sm" type="submit" id="saveReservation">
						<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
					</button>&nbsp;&nbsp;
					<button class="btn btn btn-sm" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
				</div>
			</div>
		</div><!-- row -->
	</form>
	</div>
</div>
@endsection