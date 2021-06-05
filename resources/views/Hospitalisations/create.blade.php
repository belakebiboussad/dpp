@extends('app')
@section('page-script')
<script>	
	function updateDureePrevue()
	{
		if($("#Date_entree").val() != undefined) {
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
	function formFill(adm)
	{	
		$('#patient option:selected').remove();
		$('#garde').find('option').remove();
		$('#service').find('option').remove();
		if($('#widget-box2').hasClass('invisible'))
	    		$('#widget-box2').removeClass('invisible');
		$('#patient').append($('<option>', { 
	   		value: adm['demande_hospitalisation']['consultation']['patient']['id'],
	  		 text : adm['demande_hospitalisation']['consultation']['patient']['Nom']+" " + adm['demande_hospitalisation']['consultation']['patient']['Prenom'], 
	   		 selected : true
	  }));
	  $('#service').append($('<option>', { 
		    value: adm['demande_hospitalisation']['service']['id'],
		    text : adm['demande_hospitalisation']['service']['nom'], 
		    selected : true
	 	}));
	  
	  if(adm['demande_hospitalisation']['modeAdmission']=='urgence')
	 	  $("#medecin").val(adm['demande_hospitalisation']['consultation']['docteur']['id']).change();
	 	else
	 	  $("#medecin").val(adm['demande_hospitalisation']['demeande_colloque']['id_medecin']).change();
	 	
	 	if(adm['demande_hospitalisation']['consultation']['patient']['hommes_conf'].length == 0)
	 		$("#garde").addClass('invisible');
	 	else
	 	{
	 		if($('#garde').hasClass('invisible'))
	    			$('#garde').removeClass('invisible');
		  $('#garde_id').append($('<option>', { 
	  	 			value: '',
	     				text : 'Selectionner un garde malade', 
	    		}));
		  	$.each(adm['demande_hospitalisation']['consultation']['patient']['hommes_conf'], function( index, garde ) {
		   		$('#garde_id').append($('<option>', { 
	  	 			value: garde['id'],
	     				text : garde['nom']+" " + garde['prenom'], 
	    			}));
	  		});
	 	}
	 	$('#id_admission').val(adm['id']);
	 	$('#patient_id').val(adm['demande_hospitalisation']['consultation']['patient']['id']);
	 	if(adm['demande_hospitalisation']['bed_affectation'] != null)
	 	 	$('#lit_id').val(adm['demande_hospitalisation']['bed_affectation']['lit_id']);
 	  if(adm['demande_hospitalisation']['modeAdmission']=='urgence')
 		{
 			$("#Date_entree").datepicker("setDate", adm['demande_hospitalisation']['consultation']['Date_Consultation']);
 			$("#Date_Prevu_Sortie").datepicker("setDate", adm['demande_hospitalisation']['consultation']['Date_Consultation']);
 		}
 		else
 		{
 			$("#Date_entree").datepicker("setDate", adm['rdv_hosp']['date_RDVh']);
    	$("#Date_Prevu_Sortie").datepicker("setDate", adm['rdv_hosp']['date_Prevu_Sortie']);
 		}
  	updateDureePrevue();
	}
	function addDays()
  {
		  var datefin = new Date($('#Date_entree').val());
	  	datefin.setDate(datefin.getDate() + parseInt($('#numberDays').val(), 10));
	  	$("#Date_Prevu_Sortie").val(moment(datefin).format("YYYY-MM-DD"));        
  	}
  	$('document').ready(function(){
  	$("#numberDays").on('click keyup', function() {
      addDays();
    });
    $( "#sendBtn" ).click(function() {
    		$("#Date_entree").prop("disabled", false);
	});	
  });
</script>
@endsection
@section('title') Nouvelle Hospitalisation
@endsection
@section('main-content')
<div class="page-header"><h1> Ajouter une Hospitalisation </h1></div><div class="space-12"></div>
<div class="row">
	<div class="col-sm-8 col-xs-8">
		<div class="widget-box widget-color-blue">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Admissions du Jourd</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
				  	<thead>
							<th class ="center" width="15%"><strong>Patient</strong></th>
							<th class ="center"><strong>Mode Admission</strong></th>
							<th class ="center"><strong>Service</strong></th>
							<th class ="center"><strong>Medecin Traitant</strong></th>
							<th class ="center" width="1%"><strong>Priorite</strong></th>
							<th class ="center"><strong>Observation</strong></th>
							<th class ="center"><strong>Date Entrée</strong></th>
							<th class ="center"><strong>date Sortie prévue</strong></th>
							<th class ="center"  width="10%"><em class="fa fa-cog"></em></th>
						</thead>
						<tbody>
							@foreach($adms as $key=>$adm)
							<tr>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->consultation->patient->Nom }} {{$adm->rdvHosp->demandeHospitalisation->consultation->patient->Prenom }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->modeAdmission }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->Service->nom }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->nom }} {{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->prenom }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->ordre_priorite }}</td>
								<td>{{ $adm->rdvHosp->demandeHospitalisation->DemeandeColloque->observation }}	</td>
								<td>{{ $adm->rdvHosp->date_RDVh	}}</td>
								<td>{{ $adm->rdvHosp->date_Prevu_Sortie}}	</td>
								<td class ="center">
									<a href="javascript:formFill({{ $adm }} );" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Hospitalisation"> 
										<i class="menu-icon fa fa-plus"></i>
									</a>
									<a href="{{ route('admission.destroy',$adm->id) }}" class="btn btn-danger btn-xs" data-toggle="tooltip" title="supprimer l'admission" data-method="DELETE" data-confirm="Etes Vous Sur de supprimer l'admission?"><i class="ace-icon fa fa-trash-o"></i>		
									</a>
								</td>		
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<br>
		<!-- debut -->
		<div class="widget-box widget-color-red">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Admissions d'urgence  du Jour</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
				  	<thead>
							<th class ="center" width="15%"><strong>Patient</strong></th>
							<th class ="center"><strong>Mode Admission</strong></th>
							<th class ="center"><strong>Service</strong></th>
							<th class ="center"><strong>Date Entrée</strong></th>
							<th class ="center"><strong>date Sortie prévue</strong></th>
							<th class ="center" width="10%"><em class="fa fa-cog"></em></th>
						</thead>
						<tbody>
							@foreach($admsUrg as $key=>$adm)
							<tr>
								<td>{{ $adm->demandeHospitalisation->consultation->patient->Nom }} {{ $adm->demandeHospitalisation->consultation->patient->Prenom }}</td>
								<td>{{ $adm->demandeHospitalisation->modeAdmission }}</td>
								<td>{{ $adm->demandeHospitalisation->Service->nom }}</td>
								<td>{{ date("Y-m-d")	}}</td>
								<td>{{ date("Y-m-d")	}}</td>
								<td class ="center">
									<a href="javascript:formFill({{ $adm }} );" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter une Hospitalisation"> 
										<i class="menu-icon fa fa-plus"></i>
									</a>
									<a href="{{ route('admission.destroy',$adm->id) }}" class="btn btn-danger btn-xs" data-toggle="tooltip" title="supprimer l'admission" data-method="DELETE" data-confirm="Etes Vous Sur de supprimer l'admission?"><i class="ace-icon fa fa-trash-o"></i>
								</td>		
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div><!-- fin -->
	</div><!-- col-sm-8  -->
	<div class="col-sm-4 col-xs-4">
		<div class="widget-box widget-color-blue col-xs-12 col-sm-12 invisible" id="widget-box2">
			<div class="widget-header" style = " width : 104%; margin-left :-3% ">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ajouter une Hospitalisation</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<div class="space-12"></div><!-- id = "hospCreateForm" -->
					<form class="form-horizontal" role="form" method="POST" action="{{ route('hospitalisation.store') }}">
						{{ csrf_field() }}
						<input type="hidden" name="id_admission" id="id_admission" value="" >
						<input type="hidden" name="patient_id" id="patient_id" value="">
					{{-- 	<input type="hidden" name="demande_id" id="demande_id" value=""> --}}
						<input type="hidden" name="lit_id" id="lit_id" value="">
						<div class="row">
							<div class="form-group">		
								<label class="col-sm-4 control-label no-padding-right" for="patient"><strong>Patient :</strong></label>
								<div class="col-sm-8 col-xs-8">
									<select name="patient" id="patient" class="col-xs-11 col-sm-11" disabled></select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">		
								<label class="col-sm-4 control-label no-padding-right" for="service"><strong>Service :</strong></label>
								<div class="col-sm-8 col-xs-8">
									<select name="service" id="service" class="col-xs-11 col-sm-11" disabled /></select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">		
								<label class="col-sm-4 col-xs-4 control-label no-padding-right" for="medecin"><strong>Medecin Trait.. :</strong></label>
								<div class="col-sm-8 col-xs-8">
									<select name="medecin" id="medecin" class="col-xs-11 col-sm-11">
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
									<input class="col-xs-11 col-sm-11 date-picker" id="Date_entree" name="Date_entree" type="text" placeholder="Date Hospitalisation" data-date-format="yyyy-mm-dd" disabled/>
								</div>				
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label class="col-sm-4 col-xs-4 control-label no-padding-right" for="numberDays"><strong> Durée Prévue :</strong></label>
							  <div class="col-sm-8 col-xs-8 text-nowrap">
									<input class="col-xs-10 col-sm-10" id="numberDays" type="number" placeholder="nombre de nuit(s)" min="0" max="50" value="0" />
									<label for=""><small>&nbsp; nuit(s)</small></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
							<label class="col-sm-4 col-xs-4 control-label no-padding-right text-nowrap" for="Date_Prevu_Sortie"><strong>Date Sortie Prév. :</strong></label>
							<div class="col-sm-8 col-xs-8">
								<input class="col-xs-11 col-sm-11 date-picker" id="Date_Prevu_Sortie" name="Date_Prevu_Sortie" type="text" placeholder="Date Sortie Prévue" data-date-format="yyyy-mm-dd" onchange="updateDureePrevue()" />
							</div>
						</div>
						</div>			
						<div class="row">
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right text-nowrap" for="mode"><strong>Mode Hospitalis. :</strong></label>
								<div class="col-sm-8 col-xs-8">
									<select id="mode" name="mode" value="" class="col-xs-11 col-sm-11">
									@foreach($modesHosp as $mode)
										<option value="{{ $mode->id }}">{{ $mode->nom}}</option>
									@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row" id ="garde">
							<div class="form-group">
								<label class="col-sm-4 control-label no-padding-right" for="garde"><strong>Garde Malade :</strong></label>
								<div class="col-sm-8 col-xs-8">
									<select id="garde_id" name="garde_id" placeholder="Ajouter garde malade" value="" class="col-xs-11 col-sm-11">
										<option value="">Selectionner un Garde malade</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hébergement</span></strong></div>
						</div>
						<div class="row">
						<div class="col-sm-4">
							<ul class="list-unstyled spaced">
								<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>
									<span class="badge badge-pill badge-success">{{ $adm->demandeHospitalisation->bedAffectation->lit->salle->service->nom }}</span>
								</li>
							</ul>
						</div>
						<div class="col-sm-4">
							<ul class="list-unstyled spaced">
								<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Salle :</strong>
									<span class="badge badge-pill badge-primary">{{ $adm->demandeHospitalisation->bedAffectation->lit->salle->nom }}</span>
								</li>
							</ul>
						</div>
						<div class="col-sm-4">
							<ul class="list-unstyled spaced">
								<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Lit :</strong>
									<span class="badge badge-pill badge-default">{{ $adm->demandeHospitalisation->bedAffectation->lit->nom }}</span>
								</li>
							</ul>
						</div>
					</div>
						 <div class="space-12"></div>
						<div class="row">
							<div class="col-sm12">
								<div class="center bottom" style="bottom:0px;">
									<button class="btn btn-info btn-sm" type="submit" id ="sendBtn"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
									<button class="btn btn-danger btn-sm" type="reset">	<i class="ace-icon fa fa-close bigger-110"></i>Annuler</button>
								</div>
							</div>
						</div><div class="space-12"></div>
					</form>
				</div>
			</div><!-- widget-body -->
		</div><!-- widget-box -->
	</div><!-- col-sm-4 -->
</div>
@endsection