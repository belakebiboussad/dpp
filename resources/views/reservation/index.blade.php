@extends('app'){{-- @extends('app_sur') --}}
@section('page-script')
<script type="text/javascript">
	function addReserv(rdv_id)
	{
		$('#addReservationForm').removeAttr('hidden');
		$('#rdv_id').val(rdv_id);
	}
	$(document).ready(function(){
		$("#saveReservation").click(function(){
			$('#addReservationForm').submit();
			$("#serviceh").selct(0);
		});
	});
</script>
@endsection
@section('main-content')
<div class="page-header"><h1 style="display: inline;"><strong>Réserver un Lit </strong></h1><div class="pull-right"></div></div>
<div class="space-12"></div>
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
						<td>
<!--<a href="#" class="btn btn-xs btn-success" id ="addReserv" title="Réserver Lit"><i class="fa fa-bed fa-1x" aria-hidden="true"></i></a> -->
							<button class="btn btn-xs btn-success" onclick ="addReserv({{$rdv->id}})" title="Réserver Lit">
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
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	<form id="addReservationForm" action="{{ route('reservation.store') }}" method="POST" accept-charset="utf-8" role="form" hidden>
		{{ csrf_field() }}
		<input type="hidden" id="rdv_id" name="rdv_id">		
		<div class="row ">
			<div class="col-sm-12 col-xs-12">
				<label class="col-sm-4 control-label no-padding-right" for="dateSortie"><strong> Service :</strong>	</label>
				<div class="col-sm-8">
					<select id="serviceh" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12" placeholder="Selectionnez le service"/>
					  <option value="0" selected >Selectionnez un service</option>
					  @foreach($services as $service)
							<option value="{{ $service->id }}">{{ $service->nom }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div><!-- row -->
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="salle"><strong> Salle :</strong></label>
				<div class="col-sm-8">
					<select id="salle" data-placeholder="selectionnez la salle d'hospitalisation" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12" disabled>
						<option value="0" selected>Selectionnez une salle</option>
				 	</select>
				</div>
				</div>
			</div>
		</div>
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group">
					<label class="col-sm-4 control-label" for="lit_id">	<strong>Lit : </strong></label>
					<div class="col-sm-8">
						<select id="lit_id" name="lit_id" data-placeholder="selectionnez le lit"  class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12" disabled>
							<option value="0" selected disabled>Selectionnez un lit</option>
						</select>
					</div>	
			  </div>
			</div>
		</div><!-- ROW -->
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm12">
				<div class="center bottom" style="bottom:0px;">
					<button class="btn btn-info btn-sm" type="submit" id="saveReservation">
						<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
					</button>&nbsp; &nbsp; &nbsp;
					<button class="btn btn btn-sm" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
				</div>
			</div>
		</div><!-- row -->
	</form>
	</div>
</div>
@endsection