@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	var nowDate = new Date();
  	var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
 	$('document').ready(function(){
	    $("#dateEntree").datepicker("setDate", now);			
			$("#dateSortie").datepicker("setDate", now);	
			$('#dateSortie').attr('readonly', true);
			$('.timepicker').timepicker({
	      		timeFormat: 'HH:mm',
	            	interval: 15,
	            	minTime: '08',
	            	maxTime: '17:00pm',
	            	defaultTime: '09:00',   
	            	startTime: '08:00',
	            	dynamic: true,
	            	dropdown: true,
	            	scrollbar: true
	  });
		$( "#RDVForm" ).submit(function( event ) {  
	  		$("#dateSortie").prop('disabled', false);
	  	});
	  	$('.filelink' ).click( function( e ) {
	             e.preventDefault();  
	    	});
		});
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
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1>
		Ajouter Un RDV Hospitalisation pour <strong>&laquo;{{$demande->demandeHosp->consultation->patient->Nom}}
		 {{ $demande->demandeHosp->consultation->patient->Prenom }}&raquo;</strong>
	</h1>
</div><!-- /.page-header -->
<div class="row">
	<div class="col-xs-12">
		<form class="form-horizontal" id="RDVForm" role="form" method="POST" action="{{  route('admission.store') }}">
			{{ csrf_field() }}
			<input type="text" name="id_demande" value="{{$demande->id_demande}}" hidden>
			<div class="row">
				<div class="col-sm12">
					 <h3 class="header smaller lighter blue">Informations concernant la demande d'hospitalisation</h3>
				</div>
			</div>
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-4 col-xs-4">
				    <label class="col-sm-4 col-xs-4 control-label no-padding-right" for="service"> <strong>Service:</strong> </label>
				    <div class="col-sm-8 col-xs-8">
			        <input type="text" id="service" name="service" value="{{ $demande->demandeHosp->Service->nom }}" class="col-xs-12 col-sm-12" disabled/>
			      </div>
			    </div>
		   	  <div class="col-xs-4">
						<label class="col-sm-3 control-label no-padding-right" for="motif"><strong>Spécialité :</strong></label>
						<div class="col-sm-9">
							<input type="text" id="motif" name="motifhos" value="{{$demande->demandeHosp->Specialite->nom}}" class="col-xs-12 col-sm-12" disabled/>
						</div>	
					</div>
		 			<div class="col-xs-4">
		 				<label class="col-sm-3 control-label no-padding-right" for="motif"><strong>Mode d'admission:</strong></label>
						<div class="col-sm-9">
							<input  type="text" id="motif" name="motifhos" placeholder="Mode d'admission" value="{{ $demande->modeAdmission }}" class="col-xs-10 col-sm-5" disabled/>
						</div>	
		 			</div>
   		</div>	
   		</div><!-- row -->
   		<div class="space-12"></div>
			<div class="row form-group">
			  <div class="col-xs-4">
			  	<label class="col-sm-3 control-label no-padding-right" for="motif"><strong>Médecin traitant:</strong></label>
					<div class="col-sm-9">
						<input type="text" id="motif" name="motifhos" value="{{$demande->medecin->nom}} {{$demande->medecin->prenom}}" class="col-xs-10 col-sm-5" disabled/>
					</div>	
			  </div>
			<div class="col-xs-4">
   				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="priorite"><strong> Priorité :</strong></label>
					<div class="control-group">
						&nbsp; &nbsp;
						<label>
							<input name="priorite" class="ace" type="radio" value="1" disabled @if($demande->ordre_priorite==1)checked="checked"@endif >
							<span class="lbl"> 1 </span>
						</label>&nbsp; &nbsp;
						<label>
							<input name="priorite" class="ace" type="radio" value="2" disabled @if($demande->ordre_priorite==2)checked="checked"@endif>
								<span class="lbl"> 2 </span>
						</label>&nbsp; &nbsp;
						<label>
							<input name="priorite" class="ace" type="radio" value="3" disabled @if($demande->ordre_priorite==3)checked="checked"@endif>
							<span class="lbl"> 3 </span>
							</label>
						</div>
				  </div>
   		  </div>
				<div class="col-xs-4">
					<label class="col-sm-3 control-label no-padding-right" for="motif"><strong>Observation :</strong></label>
						<div class="col-sm-9">
						<input type="text" id="motif" name="motifhos" value="{{$demande->observation}}" class="col-xs-10 col-sm-5" disabled/>
					</div>	
				</div>
			</div><!-- row -->
			<div class="page-header"><h1>Admission</h1></div>
			<div class="space-12"></div>
			<div class="row form-group">
				<div class="col-xs-4">
					<label class="col-sm-4 control-label no-padding-right" for="dateEntree">	<strong> Date entrée prévue :</strong></label> 
					<div class="col-sm-8">
							<input class="col-xs-5 col-sm-5 date-picker" id="dateEntree" name="dateEntree" type="text" placeholder="Date d'entrée prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required/>
					  	<button class="btn btn-sm filelink" onclick="$('#dateEntree').focus()"><i class="fa fa-calendar"></i></button>
					</div>
				</div>
				<div class="col-xs-4">
					<label class="col-sm-4 control-label no-padding-right" for="heure_rdvh" style="padding: 0.9%;">	<strong> Heure entrée prévue :</strong></label>
					<div class="input-group col-sm-8" style ="width:35.8%;padding: 0.8%;">	
					  <input id="heure_rdvh" name="heure_rdvh" class="form-control timepicker" type="text"  required>
						<span class="input-group-addon">	<i class="fa fa-clock-o bigger-110"></i></span>
					</div>
				</div>
				<div id = "numberofDays" class="col-xs-4">
					<label class="col-sm-3 control-label no-padding-right" for="numberDays"><strong> Durée prévue :</strong></label>
				 	<div class="col-sm-9">
						<input class="col-xs-5 col-sm-5" id="numberDays" name="" type="number" placeholder="nombre de nuit(s)" min="0" max="50" value="0" required />
						<label for=""><small>Nuit(s)</small></label>
					</div>	
				</div>
			</div><!-- row -->
			<div class="space-12"></div>
			<div class="row form-group">
			  <div class="col-xs-4">
			  	<label class="col-sm-4 control-label no-padding-right" for="dateSortie"><strong> Date sortie prévue :</strong></label>
					<div class="col-sm-8">
							<input class="col-xs-5 col-sm-5 date-picker" id="dateSortiePre" name="dateSortiePre" type="text" placeholder="Date sortie prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required onchange="updateDureePrevue()"/>
							<button class="btn btn-sm filelink"  onclick="$('#dateSortie').focus()" disabled><i class="fa fa-calendar"></i> </button>
						</div>
			  </div>
			  <div class="col-xs-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="heureSortiePrevue" style="padding: 0.9%;"><strong> Heure sortie prévue :</strong></label>
						<div class="input-group col-sm-8" style ="width:35.8%;padding: 0.8%;">	
							<input id="heureSortiePrevue" name="heureSortiePrevue" class="form-control timepicker" type="text" required>
							<span class="input-group-addon">	<i class="fa fa-clock-o bigger-110"></i></span>			
						</div>
					</div>
			  </div>
			</div>
      <div class="space-12"></div>
			<div class="page-header"><h1>Hébergement</h1></div>
      <div class="space-12"></div>
			<div class="row form group">
				<div class="col-xs-4">
			  		<label class="col-sm-4 control-label no-padding-right" for="dateSortie">	<strong> Service :</strong>	</label>
					 	<div class="col-sm-8">
							<select id="serviceh" name="serviceh" class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-9" placeholder="selectionnez le service d'hospitalisation"/>
							  <option value="" selected disabled>Selectionnez le service d'hospitalisation</option>
							  @foreach($services as $service)
								<option value="{{ $service->id }}">{{ $service->nom }}</option>
								@endforeach
							</select>
						</div>
			  </div>
			  <div class="col-xs-4">
			   		<label class="col-sm-4 control-label no-padding-right" for="salle">	<strong> Salle :</strong>	</label>
						<div class="col-sm-8">
							<select id="salle" name="salle" class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-9" disabled>
								<option value="" selected>Selectionnez la salle d'hospitalisation</option>
						  </select>
						</div>
			  </div>
			  <div class="col-xs-4">
			  	<label class="col-sm-3 control-label" for="lit_id">	<strong>Lit : </strong></label>
						<div class="col-sm-8">
							<select id="lit_id" name="lit_id" class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-9" disabled>
								<option value="" selected disabled>Selectionnez le lit d'hospitalisation</option>
							</select>
						</div>	
				</div>
			</div><!-- ROW -->
			<div class="space-12"></div><div class="space-12"></div><div class="space-12"></div>	<div class="space-12"></div>
			<div class="row">
					<div class="col-xs-3"></div>
					<div class="col-xs-6 center bottom">
						<button class="btn btn-info btn-xs" type="submit">	<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer	</button>&nbsp; &nbsp; &nbsp;
						<button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
					</div>
					<div class="col-xs-3"></div>
			</div>			
		</form>	
	</div>
</div>
@endsection