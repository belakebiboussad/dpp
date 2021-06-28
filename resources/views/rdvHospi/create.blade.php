@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	var nowDate = new Date();
  var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
 	$('document').ready(function(){
    $("#dateEntree").datepicker("setDate", now);			
	  $("#dateSortiePre").datepicker("setDate", now);	//$('#dateSortiePre').attr('readonly', true);
	 	$( "#RDVForm" ).submit(function( event ) {  
  			$("#dateSortiePre").prop('disabled', false);
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
<div class="page-header" width="100%">
	<div class="row"><div class="col-sm-12" style="margin-top: -3%;"><?php $patient = $demande->demandeHosp->consultation->patient; ?>@include('patient._patientInfo')</div></div>
</div>
<div class="row"><h3><strong>Ajouter un Rendez-vous hospitalisation</strong></h3></div>
<div class="row">
	<div class="col-xs-12">
		<form class="form-horizontal" id="RDVForm" role="form" method="POST" action="{{  route('rdvHospi.store') }}">
			{{ csrf_field() }}
			<input type="text" name="id_demande" value="{{$demande->id_demande}}" hidden>
			<input type="text" id="affect" value="0" hidden>
			<div class="row">
			  <div class="col-sm-12"><h3 class="header smaller lighter blue">Demande d'hospitalisation</h3></div>
			</div><div class="space-12 hidden-xs"></div>
			<div class="row">
				<div class="col-sm-4 col-xs-12 form-group">
				    <label class="col-sm-4 col-xs-5 control-label no-padding-right" for="service"> <strong>Service:</strong></label>
	          <div class="col-sm-8 col-xs-7">
				      <input type="text" id="service" class="col-sm-12 col-xs-12" name="service" value="{{ $demande->demandeHosp->Service->nom }}" disabled/>
				    </div>
				</div>
				<div class="col-sm-4 col-xs-12 form-group">
			  	<label class="col-sm-4 col-xs-5 control-label no-padding-right no-wrap" for="specialite"><strong>Specialite :</strong></label>
			  	<div class="col-sm-8 col-xs-7">
			       <input type="text" id="specialite" class="col-sm-12 col-xs-12" name="specialite" value="{{ $demande->demandeHosp->Specialite->nom }}" disabled/>
			    </div>  
			  </div>
		   	<div class="col-sm-4 col-xs-12 form-group">
			    <label class="col-sm-4 col-xs-5 control-label no-padding-right no-wrap" for="mode"> <strong>Mode admis.:</strong></label>
			    <div class="col-sm-8 col-xs-7">
			      <input  type="text" id="mode" class="col-sm-12 col-xs-12" name="mode" value="{{ $demande->demandeHosp->modeAdmission }}" disabled/>
			    </div>
			  </div>
	   		</div><div class="space-12"></div>
			  <div class="row">
				  <div class="col-sm-4 col-xs-12 form-group">
				    <label class="col-sm-4 col-xs-5 control-label no-padding-right no-wrap" for="medecin"><strong>Medecin Traitant:</strong></label>
				    <div class="col-sm-8 col-xs-7">
				      <input type="text" id="medecin" class="col-sm-12 col-xs-12" name="medecin" value="{{$demande->medecin->nom}} {{$demande->medecin->prenom}}" disabled/>
				    </div>  
				  </div>
			    <div class="col-sm-4 col-xs-12 form-group">
				     <label class="col-sm-4 col-xs-5 control-label no-padding-right" for="priorite"> <strong> Priorité : </strong></label>
				      <div class="col-sm-8 col-xs-7">
			          <div class="control-group col-sm-12 col-xs-12">
						      <label><input name="priorite1" class="ace col-sm-4 col-xs-4" type="radio" value="1" @if($demande->ordre_priorite ==1) checked @endif disabled ><span class="lbl">1</span>
			            </label>
						      <label><input name="priorite1" class="ace col-sm-4 col-xs-4" type="radio" value="2"  @if($demande->ordre_priorite ==2) checked @endif disabled><span class="lbl">2</span>
						      </label>
						      <label>
						        <input name="priorite1" class="ace col-sm-4 col-xs-4" type="radio" value="3"  @if($demande->ordre_priorite==3) checked @endif disabled><span class="lbl"> 3 </span>
						      </label>
              	</div>
              </div>
        	</div>
				  <div class="col-sm-4 col-xs-12 form-group">
            <label class="col-sm-4 col-xs-5 control-label no-padding-right" for="motif"><strong>observation :</strong></label>		              
              <div class="col-sm-8 col-xs-7">
               <input type="text" id="motif" class="col-sm-12 col-xs-12" name="motifhos" value="{{$demande->observation}}" disabled/>
              </div>
				  </div>
        </div><div class="space-12 hidden-xs"></div>
			  <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Admissions</h3></div></div>
			  <div class="space-12 hidden-xs"></div>
			  <div class="row">
			  	<div class="col-sm-4 col-xs-12 form-group">
				  	<label class="col-sm-4 col-xs-5 control-label no-padding-right no-wrap" for="dateEntree"><strong>Date entrée :</strong></label>
				  	<div class="input-group col-sm-8 col-xs-7">
				  		<input class="form-control date-picker" id="dateEntree" name="dateEntree" type="text" data-date-format="yyyy-mm-dd" required/>
						  <span class="input-group-addon" onclick="$('#dateEntree').focus()"><i class="fa fa-calendar bigger-110"></i></span> 	
				  	</div>
					</div>
					<div class="col-sm-4 col-xs-12 form-group">
				  	<label class="col-sm-4 col-xs-5 control-label no-padding-right no-wrap" for="heure_rdvh"><strong>Heure entrée :</strong></label>
				  	<div class="input-group col-sm-8 col-xs-7">
				  		<input class="form-control timepicker" id="heure_rdvh" name="heure_rdvh" type="text" required/>
						  <span class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></span>	 	
				  	</div>
					</div>
					<div id ="numberofDays" class="col-sm-4 col-xs-12 form-group">
				  	<label class="col-sm-4 col-xs-5 control-label no-padding-right no-wrap" for="numberDays"><strong>Durée :</strong></label>
				  	<div class="input-group col-sm-8 col-xs-7">
				  		<input id="numberDays" min="0" max="50" value="0" class="form-control" type="number" required>
						  <span class="input-group-addon">nuit(s)</span> 	
				  	</div>
					</div>		
			  </div><div class="space-12"></div>
			  <div class="row">
			  	<div class="col-sm-4 col-xs-12">
				  	<label class="col-sm-4 col-xs-5 control-label no-padding-right no-wrap" for="dateSortiePre"><strong>Date sortie :</strong></label>
				  	<div class="input-group col-sm-8 col-xs-7">
				  		<input class="form-control date-picker" id="dateSortiePre" name="dateSortiePre" type="text" data-date-format="yyyy-mm-dd" onchange="updateDureePrevue()" required/>
						  <span class="input-group-addon" onclick="$('#dateSortie').focus()"><i class="fa fa-calendar bigger-110"></i></span> 	
				  	</div>
					</div>
					<div class="col-sm-4 col-xs-12">
						<label class="col-sm-4 col-xs-5 control-label no-padding-right no-wrap" for="heureSortiePrevue"><strong>Heure sortie :</strong></label>
						<div class="input-group col-sm-8 col-xs-7">
							<input id="heureSortiePrevue" name="heureSortiePrevue" class="form-control timepicker" type="text" required>
							<span class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></span>		
						</div>
					</div> 
			  </div><div class="space-12 hidden-xs"></div>
		  	<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Hébergement</h3></div></div><div class="space-12 hidden-xs"></div>
				<div class="row ">
					<div class="col-sm-4 col-xs-12">
				  	<label class="col-sm-4 control-label no-padding-right" for="dateSortie">	<strong> Service :</strong>	</label>
						<div class="col-sm-8">
							<select id="serviceh" name="serviceh" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12" placeholder="Selectionnez le service"/>
							  <option value="0" selected >Selectionnez un service</option>
							  @foreach($services as $service)
								<option value="{{ $service->id }}">{{ $service->nom }}</option>
								@endforeach
							</select>
					  </div>
				  </div>
				  <div class="col-sm-4 col-xs-12">
			   		<label class="col-sm-4 control-label no-padding-right" for="salle"><strong> Salle :</strong></label>
					 	<div class="col-sm-8">
							<select id="salle" name="salle" data-placeholder="selectionnez la salle d'hospitalisation" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12" disabled>
								<option value="0" selected>Selectionnez une salle</option>
					  	</select>
						</div>
				  </div>
				 	<div class="col-sm-4 col-xs-12">
				 		<label class="col-sm-4 control-label" for="lit_id">	<strong>Lit : </strong></label>
				  	<div class="col-sm-8">
							<select id="lit_id" name="lit_id" data-placeholder="selectionnez le lit"  class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12" disabled>
									<option value="0" selected disabled>Selectionnez un lit</option>
							</select>
						</div>	
					</div>
			  </div><div class="space-12"></div><div class="space-12"></div><div class="space-12"></div>
				<div class="row">
					<div class="center bottom" style="bottom:0px;">
						<button class="btn btn-info btn-xs" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp;&nbsp; &nbsp;
						<button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
					</div>
				</div>			
			</form>	
	</div>
</div>
@endsection