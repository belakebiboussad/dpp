@extends('app')
@section('title','Ajouter un patient')
@section('style')
<style>
</style>
@endsection
@section('page-script')
	<script>
		$( document ).ready(function() {
			var bloodhound1 = new Bloodhound({
		        datumTokenizer: Bloodhound.tokenizers.whitespace,
		        queryTokenizer: Bloodhound.tokenizers.whitespace,
		        remote: {
						url: '/patients/findcom?com=%QUERY%',
							wildcard: '%QUERY%'
					},
			});
			$('#lieunaissance').typeahead({
					autoselect: true,
					hint: true,
					highlight: true,
					minLength: 1,		
			},{
				name: 'communenom',
				source: bloodhound1,
				display: function(data) {
					return data.nom_commune;  //Input value to be set when you select a suggestion. 
				},
				templates: {
					empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucune Commune</div></div>'
					],
					header: [
						'<div class="list-group search-results-dropdown">'
					],
					suggestion: function(data) {
						return '<div style="font-weight:normal; margin-top:-10px ! important;width:300px !important" class="list-group-item" onclick="autocopleteCNais(\''+data.id_Commune+'\')">' + data.nom_commune+ '</div></div>'
						//return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item" onclick="show(\''+data.Id_wilaya+','+data.nom_wilaya+','+data.id_Commune+'\')">' + data.nom_commune+ '</div></div>'
					}	
				}
			});
			$('#lieunaissancef').typeahead({
					autoselect: true,
					hint: true,
					highlight: true,
					minLength: 1,		
			},{
				name: 'communenom',
				source: bloodhound1,
				display: function(data) {
					return data.nom_commune;  //Input value to be set when you select a suggestion. 
				},
				templates: {
					empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucune Commune</div></div>'
					],
					header: [
						'<div class="list-group search-results-dropdown">'
					],
					suggestion: function(data) {
						return '<div style="font-weight:normal; margin-top:-10px ! important;width:300px !important" class="list-group-item" onclick="autocopleteCNaisAS(\''+data.id_Commune+'\')">' + data.nom_commune+ '</div></div>'
						//return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item" onclick="show(\''+data.Id_wilaya+','+data.nom_wilaya+','+data.id_Commune+'\')">' + data.nom_commune+ '</div></div>'
					}	
				}
			});
			$('#commune').typeahead({///////////////autocomplete lieu de naissance
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				name: 'communenom',
				source: bloodhound1,
				display: function(data) {
					return data.nom_commune  //Input value to be set when you select a suggestion. 
				},
				templates: {
					empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucune Commune</div></div>'
					],
					header: [
						'<div class="list-group search-results-dropdown">'
					],
					suggestion: function(data) {//return '<div style="font-weight:normal; margin-top:-10px ! important;width:300px !important" class="list-group-item" onclick="autocopleteCNais(\''+data.id_Commune+'\')">' + data.nom_commune+ '</div></div>'
						//return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item" onclick="show(\''+data.Id_wilaya+','+data.nom_wilaya+','+data.id_Commune+'\')">' + data.nom_commune+ '</div></div>'
							return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item" onclick="show(\''+data.Id_wilaya+','+data.nom_wilaya+','+data.id_Commune+','+'wilaya'+'\')">' + data.nom_commune+ '</div></div>'
					}
				}	
			});
			
		  $('#communef').typeahead({	/////////// Autocomletecommune de l'assure
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				name: 'communenom',
				source: bloodhound1,
				display: function(data) {
					return data.nom_commune  //Input value to be set when you select a suggestion. 
				},
				templates: {
					empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucune Commune</div></div>'
					],
					header: [
						'<div class="list-group search-results-dropdown">'
					],
					suggestion: function(data) {
							return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item" onclick="show(\''+data.Id_wilaya+','+data.nom_wilaya+','+data.id_Commune+','+'wilayaf'+'\')">' + data.nom_commune+ '</div></div>'

					}
				}	
			});
			$( ".civilite" ).change(function() {
				 var sex =  $('input[name=sexe]:checked').val();
				 if(sex == "F")
				 {
			 		var civilite= $("select.civilite option").filter(":selected").val();
			 		if((civilite =="marie")|| (civilite =="veuf"))
	  					$('#Div-nomjeuneFille').removeAttr('hidden');
		  			else
		  				$('#Div-nomjeuneFille').attr('hidden','');	
				 }else
				 	$('#Div-nomjeuneFille').attr('hidden','');	
						
			});
			$('input[type=radio][name=sexe]').change(function(){
			 	if($(this).val() == "M")
			 		$('#Div-nomjeuneFille').attr('hidden','');
			 	else
			 	{
			 		var civilite= $("select.civilite option").filter(":selected").val();
			 		if((civilite =="marie")|| (civilite =="veuf"))
		  			$('#Div-nomjeuneFille').removeAttr('hidden');
			 	}
			});
			$('input[type=radio][name=etatf]').change(function(){
				if($(this).val() != "En_exercice")
					$('#serviceFonc').addClass('invisible'); 
				else
					$('#serviceFonc').removeClass('invisible'); 	
			});
		});
		
		function autocopleteCNais(commune)
		{
			$("#idlieunaissance").val(commune);
		}
		function autocopleteCNaisAS(commune)
		{
			$("#idlieunaissancef").val(commune);
		}
		function show(wilaya)
		{
			var res = wilaya.split(",");
			$("#idwilaya").val(res[0]);
			$("#idcommune").val(res[2]);
			$("#"+res[3]).val(res[1]);
		}
		function copyPatient(){
			$("#nomf").val($("#nom").val());$("#prenomf").val($("#prenom").val());
			$("#datenaissancef").val($("#datenaissance").val());$("#lieunaissancef").val($("#lieunaissance").val());
			$("#idlieunaissancef").val($("#idlieunaissance").val());
			$("input[name=sexef][value=" + $('input[name=sexe]:radio:checked').val() + "]").prop('checked', true); 
		 	$("#adressef").val($('#adresse').val() + " "+ $('#commune').val() + " "+ $('#wilaya').val() )
			$( "#gsf" ).val($( "#gs" ).val());
		 	$( "#rhf" ).val($( "#rh" ).val());
			$("#foncform").addClass('hide');$('#Type_p').attr('required', false);  
			addRequiredAttr();
		}
		function copyPatientInfo()
		{
			if($('#fonc').is(':checked'))
				copyPatient();
		}
		function showType(value){ 
	    switch(value){
					case "Assure":
			      copyPatient();  
			      var classList = $('ul#menuPatient li:eq(0)').attr('class').split(/\s+/);
						$.each(classList, function(index, item) {
    					if (item === 'hidden') {   						
    						$( "ul#menuPatient li:eq(0)" ).removeClass( item );
    				}
						});
						$(".starthidden").hide(250);
			      break;
			    case "Ayant_droit":
			        $("#nomf").val("");
			        $("#prenomf").val("");
			        $("#foncform").removeClass('hide');
			        $('#Type_p').attr('required', true); 
			        $(".starthidden").hide(250);
			        addRequiredAttr();
			        var classList = $('ul#menuPatient li:eq(0)').attr('class').split(/\s+/);
							$.each(classList, function(index, item) {
			    					if (item === 'hidden') {   						
			    						$( "ul#menuPatient li:eq(0)" ).removeClass( item );
			    					}
							});
			        break;
			    case "Autre":
			        $(".starthidden").show(250);
			        $("#foncform").addClass('hide');
			        $('#Type_p').attr('required', false);  //$("ul#menuPatient li:not(.active) a").prop('disabled', true); $("ul#menuPatient li:eq(0)").css('display', 'none');
			       	if(! ($( "ul#menuPatient li:eq(0)" ).hasClass( "hidden" )))
          				$( "ul#menuPatient li:eq(0)" ).addClass( "hidden" );
			        break;         
			 }			
		}
		function checkFormAddPAtient()
  	{         
  		if(!($('#autre').is(':checked'))){ 
      	if( ! checkAssure() )
      	{
        	activaTab("Assure");
        	return false;
      	}else{
      		if($('#hommeConf').is(':checked')){
            if( ! checkHomme() )
            {
              activaTab("Homme_C");
              return false;
            }else
            return true;  
          }else{
            return true;   
          }
          return true;
      	}
      }else
      {
               if($('#hommeConf').is(':checked')){
                    if( ! checkHomme() )
                    {
                           activaTab("Homme_C");
                         return false;
                     }else
                          return true;  
                }else
                     return true; 
          }
     }
	</script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div><h4>Ajouter un nouveau Patient</h4></div
  <div class="row">
	{{-- action="{{ route('patient.store') }}" --}}
	<form class="form-horizontal" id = "addPAtient" action="{{ route('patient.store') }}" method="POST" role="form" autocomplete="off" onsubmit="return checkFormAddPAtient(this);">
	  {{ csrf_field() }}
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group" id="error" aria-live="polite">
			@if (count($errors) > 0)
			  <div class="alert alert-danger">
					<ul>
					 @foreach ($errors->all() as $error)
				 	           <li>{{ $error }}</li>
					@endforeach
					</ul>
				</div>
			@endif
			</div>
		</div>
	</div>
	<ul class="nav nav-pills nav-justified list-group" role="tablist" id="menuPatient">
   	<li class="active"><a data-toggle="tab" href="#Assure" class="jumbotron" onclick="copyPatientInfo();">
    		<span class="bigger-130"><strong>Assure</strong></span></a>
		</li>
		<li ><a class="jumbotron" data-toggle="tab" href="#Patient">
			<span class="bigger-130"><strong>Patient</strong></span></a>
	 	</li>
 	  <li id ="hommelink" class="invisible"><a class="jumbotron" data-toggle="tab" href="#Homme_C">
  		<span class="bigger-130"><b>Garde Malde</b></span></a>
	  </li>
  </ul>
	<div class="tab-content">
		<div id="Assure" class="tab-pane in active">
			 <div id ="assurePart">
					@include("assurs.addAssure")
			 </div>{{-- assurePart	 --}}
		</div>	{{-- tab-pane --}}
		<div id="Patient" class="tab-pane fade">
	   		@include('patient.addPatient')
		</div> 	{{-- tab-pane --}}
		<div id="Homme_C" class="tab-pane fade hidden_fields">
			<div id ="homme_cPart">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="header smaller lighter blue"><b>Information de l'Homme de confiance</b></h3>
					</div>	
				</div>{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="nomA"><strong>Nom :</strong></label>
							<div class="col-sm-9">
								<input type="text" id="nomA" name="nom_homme_c" placeholder="Nom..." class="col-xs-12 col-sm-12" />
							</div>
							<br>
						</div>
							<br>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="prenomA"><strong>Prénom :</strong></label>
							<div class="col-sm-9">
								<input type="text" id="prenomA" name="prenom_homme_c" placeholder="Prénom..." class="col-xs-12 col-sm-12" />
							</div>
							<br>
						</div>
						<br>
					</div>
				</div>{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="datenaissanceA"><strong class="text-nowrap">Né(e) le :</strong>	</label>
							<div class="col-sm-9">
								<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance_h_c" name="datenaissance_h_c" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label " for="lien"><strong>Lien de parenté :</strong></label>
							<div class="col-sm-9">
								<select id="lien" name="lien" class="col-xs-12 col-sm-12">
									<option value="">Sélectionner...</option>
									<option value="conjoint">Conjoint(e)</option>
									<option value="père">Père</option>
									<option value="mère">Mère</option>
									<option value="frère">Frère </option>
									<option value="soeur">Soeur </option>
									<option value="membre_famille">Membre de famille </option>
									<option value="ami">Ami </option>
									<option value="Autre">Autre </option>
								</select>
							</div>
						</div>
					</div>
				</div>{{-- row --}}
				<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label " for="type_piece_id"><strong>Type  pièce d'identité:</strong>			</label>
							<div class="col-sm-9">
								<select name="type_piece_id" id="type_piece_id" class="col-xs-12 col-sm-12">
									<option value="">Sélectionner...</option>
									<option value="CNI">Carte d'identité nationale</option>
									<option value="Permis">Permis de Conduire</option>
									<option value="Passeport">Passeport </option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3" for="npiece_id"><strong>N° de la pièce :</strong></label>
							<div class="col-sm-9">
								<div class="clearfix">
									<input type="text" id="npiece_id" name="npiece_id" class="col-xs-12 col-sm-12" placeholder="N° de la pièce d'identité..."/>
								</div>
							</div>
						</div>
						<br>
					</div>
				</div><!-- row -->
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3" for="date_piece_id"><strong>Délivré le :</strong></label>
					    <div class="col-sm-9">
								<input class="col-xs-12 col-sm-12 date-picker" id="date_piece_id" name="date_piece_id" type="text" data-date-format="yyyy-mm-dd" placeholder="Délivré le..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<br><br>
					</div>
				</div>	{{-- row --}}
				<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-12">
						<h3 class="header smaller lighter blue"><b>Contact</b></h3>
					</div>
				</div>	{{-- row --}}
				<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<label class="control-label col-sm-3" for="adresseA"><b>Adresse :</b></label>
							<div class="col-sm-9">
								<textarea class="form-control" id="adresseA" name="adresseA" placeholder="Adresse..."></textarea>	
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-group">
								<label class="control-label text-nowrap col-sm-2" for="mobileA"><i class="fa fa-phone"></i><b>Mob :</b></label>
								<div class="col-sm-2">
									<select name="operateur_h" id="operateur_h" class="form-control" >
								    <option value="">XX</option>
								    <option value="05">05</option>         
								   	<option value="06">06</option>
								    <option value="07">07</option>
	                </select>	
								</div>
							<input id="mobileA" name="mobile_homme_c"  maxlength =8 minlength =8  name="mobileA" type="tel" autocomplete="off" class="col-sm-2" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX"/>
							</div>
						</div>
					</div>
				</div>	{{-- row --}}	
			</div><!-- homme_cPart -->
			</div>	
		</div>
		{{--fin homme--}}	{{-- tab-pane --}}

		</div>{{-- tab_content --}}
		<div class="hr hr-dotted"></div>
		<div class="row">
			<div class="center">
				<br>
				<button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Réinitialiser</button>
			</div>
		</div>	
	</form>
</div>{{-- row --}}
</div>{{-- container-fluid --}}
@endsection