<div class="widget-box widget-color-blue col-xs-12 col-sm-12" id="widget-box2">
	<div class="widget-header" style = " width : 104%; margin-left :-3% ">
		<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ajouter une hospitalisation</h5>
	</div>
	<form class="form-horizontal" role="form" method="POST" action="{{ route('hospitalisation.store') }}">
		{{ csrf_field() }}
		 <input type="hidden" name="id_admission" id="id_admission" value="{{ $adm->id }}" >
		<div class="widget-body">
			<div class="widget-main no-padding">
				<div class="space-12"></div>
				<div class="row">
					<div class="form-group">		
						<label class="col-sm-4 control-label no-padding-right" for="patient"><strong>Patient :</strong></label>
						<div class="col-sm-8 col-xs-8">
							<input type="text" class="col-xs-11 col-sm-11" value="{{ $adm->demandeHospitalisation->consultation->patient->Nom }} {{ $adm->demandeHospitalisation->consultation->patient->Nom }}"  readonly>			
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">		
						<label class="col-sm-4 control-label no-padding-right" for="service"><strong>Service :</strong></label>
						<div class="col-sm-8 col-xs-8">
							<input type="text" class="col-xs-11 col-sm-11"  value="{{ $adm->demandeHospitalisation->Service->nom }}" readonly>
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
							<input class="col-xs-11 col-sm-11 date-picker" name="Date_entree" id="Date_entree" type="text" data-date-format="yyyy-mm-dd" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" disabled/>	
						</div>				
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label class="col-sm-4 col-xs-4 control-label no-padding-right" for="numberDays"><strong> Durée Prévue :</strong></label>
					  <div class="col-sm-8 col-xs-8 text-nowrap">
							<input class="col-xs-10 col-sm-10" id="numberDays" type="number" min="0" max="50" value="{{$nbr}}" />
							<label for=""><small>&nbsp; nuit(s)</small></label>
						</div>
					</div>
		  	</div>
  			<div class="row">
					<div class="form-group">
						<label class="col-sm-4 col-xs-4 control-label no-padding-right text-nowrap" for="Date_Prevu_Sortie"><strong>Date Sortie Prév. :</strong></label>
						<div class="col-sm-8 col-xs-8">
						@if($adm->demandeHospitalisation->modeAdmission =="Urgence")
						<input class="col-xs-11 col-sm-11 date-picker" id="Date_Prevu_Sortie" name="Date_Prevu_Sortie" type="text" data-date-format="yyyy-mm-dd" onchange="updateDureePrevue()" value="<?= date("Y-m-j") ?>"  autocomplete="off"/> 
						@else
						<input class="col-xs-11 col-sm-11 date-picker" id="Date_Prevu_Sortie" name="Date_Prevu_Sortie" type="text" data-date-format="yyyy-mm-dd" value="{{ $adm->rdvHosp->date_Prevu_Sortie}}" onchange="updateDureePrevue()"  autocomplete="off"/>
						@endif
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
			@if($adm->demandeHospitalisation->consultation->patient->hommesConf->count() > 0)
			<div class="row" id="garde">
				<div class="form-group">
					<label class="col-sm-4 control-label no-padding-right" for="garde"><strong>Garde Malade :</strong></label>
					<div class="col-sm-8 col-xs-8">
					<select id="garde_id" name="garde_id" placeholder="Ajouter garde malade" value="" class="col-xs-11 col-sm-11">
							<option value="">Selectionner ....</option>
							@foreach($adm->demandeHospitalisation->consultation->patient->hommesConf as $hom)
							<option value="{{ $hom->id}}">{{ $hom->nom }}&nbsp; {{ $hom->prenom }}</option>}
							option
							@endforeach
						</select>
					</div>
				</div>
			</div>	
			@endif
			<div class="row">
				<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hébergement</span></strong></div>
			</div>
			<div class="row">
				<div class="col-sm-5">
					<ul class="list-unstyled spaced">
						<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>
							<div class="input-group">
								<span class="badge badge-pill badge-success">{{ $adm->demandeHospitalisation->bedAffectation->lit->salle->service->nom }}</span>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-sm-4">
					<ul class="list-unstyled spaced">
						<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Salle :</strong>
							<div class="input-group">
								<span class="badge badge-pill badge-primary">{{ $adm->demandeHospitalisation->bedAffectation->lit->salle->nom }}</span>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-sm-3">
					<ul class="list-unstyled spaced">
						<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Lit :</strong>
						<div class="input-group">
							<span class="badge badge-pill badge-default">{{ $adm->demandeHospitalisation->bedAffectation->lit->nom }}</span>
						</div>	
						</li>
					</ul>
				</div>
		  </div><div class="space-12"></div>
		</div>
		<div class="widget-footer widget-footer-large center">
			<div class="row">
				<div class="col-sm12">
					<div class="center bottom" style="bottom:0px;">
						<button class="btn btn-info btn-sm" type="submit" id ="sendBtn"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
						<!-- <button class="btn btn-danger btn-sm" type="reset">	<i class="ace-icon fa fa-close bigger-110"></i>Annuler</button> -->
					</div>
				</div>
			</div><div class="space-12"></div>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">
	function updateDureePrevue()
	{
		if(($('#Date_entree').datepicker('getDate')) != undefined){
			var dEntree = $('#Date_entree').datepicker('getDate');
			var dSortie = $('#Date_Prevu_Sortie').datepicker('getDate');
			var iSecondsDelta = dSortie - dEntree;
			var iDaysDelta = iSecondsDelta / (24 * 60 * 60 * 1000);
			if(iDaysDelta < 0)
			{
				iDaysDelta = 0;
				$("#Date_Prevu_Sortie").datepicker("setDate", dEntree); 
			}
			$('#numberDays').val(iDaysDelta );	
		}		
	}
	function addDays()
 	 {
		 var datefin = new Date($('#Date_entree').val());
	  	datefin.setDate(datefin.getDate() + parseInt($('#numberDays').val(), 10));
	  	$("#Date_Prevu_Sortie").val(moment(datefin).format("YYYY-MM-DD"));        
  	}
	$(function() {
  		$( ".date-picker" ).datepicker({
		    	autoclose: true,
		       todayHighlight: true,
		       dateFormat: 'yy-mm-dd',
		       flat: true,
		       calendars: 1,//language: 'fr',
		       changeYear: true,
		       yearRange: "-120:+80"
  		 });
  		$("#numberDays").on('click keyup', function() {
      			addDays();
    	});
    	
	});	// $(function() {	$( "#sendBtn" ).click(function() { 		$("#Date_entree").prop("disabled", false);});}); 
</script>
