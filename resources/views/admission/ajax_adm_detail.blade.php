<div class="widget-box widget-color-blue col-xs-12 col-sm-12" id="widget-box2">
	<div class="widget-header" style = " width : 104%; margin-left :-3% ">
		<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ajouter une hospitalisation</h5>
	</div>
	<div class="widget-body">
		<div class="widget-main no-padding">
			<div class="space-12"></div>
			<form class="form-horizontal" role="form" method="POST" action="{{ route('hospitalisation.store') }}">
				{{ csrf_field() }}
				<input type="hidden" name="id_admission" id="id_admission" value="" >
				<input type="hidden" name="patient_id" value="{{ $adm->demandeHospitalisation->consultation->patient->id }}">
				<div class="row">
					<div class="form-group">		
						<label class="col-sm-4 control-label no-padding-right" for="patient"><strong>Patient :</strong></label>
						<div class="col-sm-8 col-xs-8">
							<input type="text" class="col-xs-11 col-sm-11" name="patient" value="{{ $adm->demandeHospitalisation->consultation->patient->Nom }} {{ $adm->demandeHospitalisation->consultation->patient->Nom }}"  readonly>			
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">		
						<label class="col-sm-4 control-label no-padding-right" for="service"><strong>Service :</strong></label>
						<div class="col-sm-8 col-xs-8">
							<input type="text" name="service" class="col-xs-11 col-sm-11"  value="{{ $adm->demandeHospitalisation->Service->nom }}" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">		
						<label class="col-sm-4 col-xs-4 control-label no-padding-right" for="medecin"><strong>Medecin Trait.. :</strong></label>
						<div class="col-sm-8 col-xs-8">
							<select name="medecin" id="medecin" class="col-xs-11 col-sm-11">
							@isset($adm->demandeHospitalisation->DemeandeColloque)
								<option value="{{ $adm->demandeHospitalisation->DemeandeColloque->medecin->id }}" selected>{{ $adm->demandeHospitalisation->DemeandeColloque->medecin->nom }} {{ $adm->demandeHospitalisation->DemeandeColloque->medecin->prenom }}</option>}
							@endisset
							@foreach($medecins as $medecin)
								<option value="{{ $medecin->id }}">{{$medecin->nom }} {{$medecin->prenom }} </option> 
							@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="row">	
					<div class="form-group">
						<label class="col-sm-4 col-xs-4 control-label no-padding-right" for="Date_entree"><strong> Date Entrée :</strong></label>
						<div class="col-sm-8 col-xs-8">
							<input class="col-xs-11 col-sm-11 date-picker" name="Date_entree" type="text" data-date-format="yyyy-mm-dd" value="<?= date("Y-m-j") ?>" readonly/>
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label class="col-sm-4 col-xs-4 control-label no-padding-right" for="numberDays"><strong> Durée Prévue :</strong></label>
					  <div class="col-sm-8 col-xs-8 text-nowrap">
							<input class="col-xs-10 col-sm-10" id="numberDays" type="number" min="0" max="50" value="0" />
							<label for=""><small>&nbsp; nuit(s)</small></label>
						</div>
					</div>
		  	</div>
  			<div class="row">
					<div class="form-group">
					<label class="col-sm-4 col-xs-4 control-label no-padding-right text-nowrap" for="Date_Prevu_Sortie"><strong>Date Sortie Prév. :</strong></label>
					<div class="col-sm-8 col-xs-8">
						<input class="col-xs-11 col-sm-11 date-picker" id="Date_Prevu_Sortie" name="Date_Prevu_Sortie" type="text" data-date-format="yyyy-mm-dd" onchange="updateDureePrevue()" />
					</div>
				</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right text-nowrap" for="mode"><strong>Mode Hospitalis. :</strong></label>
						<div class="col-sm-8 col-xs-8">
							<select id="mode" name="mode" value="" class="col-xs-11 col-sm-11" required>
							<option value="">Selectionner....</option>
							@foreach($modesHosp as $mode)
								<option value="{{ $mode->id }}">{{ $mode->nom}}</option>
							@endforeach
							</select>
						</div>
					</div>
				</div>	
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	
</script>
