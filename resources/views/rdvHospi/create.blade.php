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
<div class="page-header">
	<h1>
		Ajouter un RDV Hospitalisation pour <strong>&laquo;{{$demande->demandeHosp->consultation->patient->Nom}}
		 {{ $demande->demandeHosp->consultation->patient->Prenom }}&raquo;</strong>
	</h1>
</div><!-- /.page-header -->
<div class="row">
	<div class="col-xs-12">
		<form class="form-horizontal" id="RDVForm" role="form" method="POST" action="{{  route('rdvHospi.store') }}">
			{{ csrf_field() }}
			<input type="text" name="id_demande" value="{{$demande->id_demande}}" hidden>
			<div class="row">
			       <div class="col-sm-12">
			       	<h3 class="header smaller lighter blue">informations concernant la demande d'hospitalisation</h3>
			        </div>
		      </div>
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-4 col-xs-4">
				    <label class="col-sm-4 col-xs-4 control-label no-padding-right" for="service"> <strong>Service:</strong></label>
	          <div class="col-sm-8 col-xs-8">
				      <input type="text" id="service" name="service" value="{{ $demande->demandeHosp->Service->nom }}" class="col-xs-12 col-sm-12" disabled/>
				    </div>
				  </div>
   			  <div class="col-sm-4 col-xs-4">
				  	<label class="col-sm-4 control-label no-padding-right" for="specialite"><strong>Specialite :</strong></label>
				  	<div class="col-sm-8 col-xs-8">
				       <input type="text" id="specialite" name="specialite" value="{{ $demande->demandeHosp->Specialite->nom }}" class="col-xs-12 col-sm-12" disabled/>
				    </div>  
				  </div>
			   	<div class="col-sm-4 col-xs-4">
				    <label class="col-sm-4 control-label no-padding-right no-wrap" for="mode"> <strong>Mode admis.:</strong></label>
				    <div class="col-sm-8 col-xs-8">
				      <input  type="text" id="mode" name="mode" value="{{ $demande->demandeHosp->modeAdmission }}" class="col-xs-12 col-sm-12" disabled/>
				    </div>
				  </div>
	   			</div>
   			</div><!-- row -->
   			<div class="space-12"></div>
			  <div class="row">
			  <div class="col-sm-12">
				  <div class="col-sm-4 col-xs-4">
				    <label class="col-sm-4 col-xs-4 control-label no-padding-right no-wrap" for="medecin"><strong>Medecin Trait.:</strong></label>
				    <div class="col-sm-8 col-xs-8">
				      <input type="text" id="medecin" name="medecin" value="{{$demande->medecin->Nom_Employe}} {{$demande->medecin->Prenom_Employe}}" class="col-xs-12 col-sm-12" disabled/>
				    </div>  
				  </div>
			    <div class="col-sm-4 col-xs-4">
				     <label class="col-sm-4 col-xs-4 control-label no-padding-right" for="priorite"> <strong> Priorité : </strong></label>
				      <div class="col-sm-8 col-xs-8">
			          <div class="control-group col-sm-12 col-xs-12">
						      <label><input name="priorite1" class="ace" type="radio" value="1" @if($demande->ordre_priorite ==1) checked @endif disabled ><span class="lbl">1</span>
			            </label>&nbsp; &nbsp;
						      <label><input name="priorite1" class="ace" type="radio" value="2"  @if($demande->ordre_priorite ==2) checked @endif disabled><span class="lbl">2</span>
						      </label>&nbsp; &nbsp;
						      <label>
						        <input name="priorite1" class="ace" type="radio" value="3"  @if($demande->ordre_priorite==3) checked @endif disabled><span class="lbl"> 3 </span>
						      </label>
              	</div>
              </div>
        	</div>
				  <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 col-xs-4 control-label no-padding-right" for="motif"><strong>observation :</strong></label>		              
              <div class="col-sm-8 col-xs-8">
               <input type="text" id="motif" name="motifhos" value="{{$demande->observation}}" class="col-xs-12 col-sm-12" disabled/>
              </div>
				  </div>
       	</div>
        </div>
     	  <div class="space-12"></div>
			  <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Admissions</h3></div></div>
			  <div class="space-12"></div>
			  <div class="row">
				<div class="col-sm-12">		
					<div class="col-sm-4 col-xs-4">
						<label class="col-sm-7 col-xs-7 control-label no-padding-right" for="dateEntree"><strong> Date entrée prévue : </strong></label>
						<div class=" input-group col-sm-5 col-xs-5">
							<input class="form-control date-picker" id="dateEntree" name="dateEntree" type="text" data-date-format="yyyy-mm-dd" required/>
						  	<span class="input-group-addon" onclick="$('#dateEntree').focus()"><i class="fa fa-calendar bigger-110"></i></span> 
						 </div>
					</div>
					<div class="col-sm-4 col-xs-4">
						<label class="col-sm-7 col-xs-7 control-label no-padding-right no-wrap" for="heure_rdvh"><strong> Heure entrée Prévue :</strong> </label>
            <div class="input-group col-sm-5 col-xs-5">	
						  <input id="heure_rdvh" name="heure_rdvh" class="form-control timepicker" type="text" required>
							<span class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></span>					
						</div>
					</div>
					<div id = "numberofDays" class="col-sm-4 col-xs-4">
						<label class="col-sm-6 control-label no-padding-right" for="numberDays"><strong> Durée Prévue :</strong>	</label>
				    <div class="col-sm-6 col-xs-6">
							<input class="col-xs-8 col-sm-8" id="numberDays" name="" type="number" placeholder="nombre de nuit(s)" min="0" max="50" value="0" required /><label for=""><small>nuit(s)</small></label>
						</div>	
					</div>
				</div>
			</div><!-- row -->
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">		
					<div class="col-sm-4 col-xs-4">
				  	<label class="col-sm-7 col-xs-7 control-label no-padding-right" for="dateSortiePre"><strong> Date sortie prévue :</strong></label>
			     	<div class="input-group col-sm-5 col-xs-5">
							<input class="col-xs-12 col-sm-12 date-picker" id="dateSortiePre" name="dateSortiePre" type="text" data-date-format="yyyy-mm-dd" onchange="updateDureePrevue()" required/>
						  <span class="input-group-addon" onclick="$('#dateSortie').focus()"><i class="fa fa-calendar bigger-110"></i></span>      
            </div>
					</div>
					<div class="col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="col-sm-7 col-xs-7 control-label no-padding-right no-wrap" for="heureSortiePrevue"><strong> Heure sortie Prévue :</strong></label>
					    <div class="input-group col-sm-5 col-xs-5">
								<input id="heureSortiePrevue" name="heureSortiePrevue" class="form-control timepicker" type="text" required>
								<span class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></span>		
							</div>
						</div>
					</div>
			  </div>
			</div>
    	<div class="space-12"></div>
		  <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Hébergement</h3></div> </div>
			<div class="space-12"></div>
			<div class="row ">
				<div class="col-sm-12">
					<div class="col-sm-4 col-xs-4">
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
				 	<div class="col-sm-4 col-xs-4">
				   		<label class="col-sm-4 control-label no-padding-right" for="salle"><strong> Salle :</strong></label>
						 	<div class="col-sm-8">
								<select id="salle" name="salle" data-placeholder="selectionnez la salle d'hospitalisation" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12" disabled>
									<option value="0" selected>Selectionnez une salle</option>
						  	</select>
						</div>
				  </div>
				 	<div class="col-xs-4"><label class="col-sm-4 control-label" for="heure_rdvh">	<strong>Lit : </strong></label>
				  	<div class="col-sm-8">
							<select id="lit" name="lit" data-placeholder="selectionnez le lit"  class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12" disabled>
									<option value="0" selected disabled>Selectionnez un lit</option>
							</select>
						</div>	
					</div>
				</div>
			</div><!-- ROW -->
			<div class="space-12"></div><div class="space-12"></div>	<div class="space-12"></div>
			<div class="row">
					<div class="col-xs-3"></div>
					<div class="col-xs-6 center bottom">
						<button class="btn btn-info btn-xs" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
						<button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
					</div>
					<div class="col-xs-3"></div>
			</div>			
		</form>	
	</div>
</div>
@endsection