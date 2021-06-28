@extends('app')
@section('title','Ajouter un patient')
@section('page-script')
 <script>
  	$( document ).ready(function() {
  		$('#type').change(function(){
  			if( $('#type').val() == "0")
  			{
				$("#foncform").addClass('hide');//copyPatient();
  				addRequiredAttr();
  			}
  			else if(($('#type').val() == "1") ||($('#type').val() == "2")||($('#type').val() == "3")||($('#type').val() == "4"))
  			{
  				$("#foncform").removeClass('hide');
			    addRequiredAttr();
  			}else
  			{
  				$(".starthidden").show(250);
  				$('.Asdemograph').find('*').each(function () {$(this).attr("disabled", true);});
			    $("#foncform").addClass('hide');
			    $("ul#menuPatient li:eq(0)").css('display', 'none');	
  		 }
  	  });
 	  	$( "#addPatientForm" ).submit(function( event ) {
			  if( ! checkPatient() )
      		{
	        	activaTab("Patient");
	        	event.preventDefault();
	      	}else{
      		if(($('#type').val() != "5" )){ //if(!($('#autre').is(':checked'))){ 
      			$('.Asdemograph').find('*').each(function () { $(this).attr("disabled", false); });	
						if( ! checkAssure() )
						{
						  activaTab("Assure");
					  	event.preventDefault();
						}else
						{
							if($('#hommeConf').is(':checked')){
							if( ! checkHomme() )
              					{
              						  activaTab("Homme_C");
              						event.preventDefault();
              					}else
                						$( "#addPatientForm" ).submit();
						}else
						{
							$( "#addPatientForm" ).submit();
						}
					}
				}
				else
				{
					if($('#hommeConf').is(':checked'))
					{
						if( ! checkHomme() )
					      {
			            activaTab("Homme_C");
			           	event.preventDefault();
					       }else
					             $( "#addPatientForm" ).submit();
					}else
						$( "#addPatientForm" ).submit();
				}
			 }    
		});
	});
</script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div>
  	<h3><strong>Ajouter un nouveau patient</strong></h3>
  	<div class="pull-right">
			<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i> Rechercher un patient
			</a>
		</div>
  </div>
  <div class="row tabs">
		<form class="form-horizontal" id = "addPatientForm" action="{{ route('patient.store') }}" method="POST" role="form">
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
	    		<ul class="nav nav-pills nav-justified list-group" role="tablist" id="menuPatient">
			   	<li class="active">
			   		<a data-toggle="tab" href="#Assure" class="jumbotron" onclick="copyPatientInfo(null);"><span class="bigger-130"><strong>Assuré(e)</strong></span></a>
					</li>
					<li ><a class="jumbotron" data-toggle="tab" href="#Patient"><span class="bigger-130"><strong>Patient</strong></span></a></li>
			 	  <li id ="hommelink" class="invisible"><a class="jumbotron" data-toggle="tab" href="#Homme_C">
			  		<span class="bigger-130"><b>Garde Malade</b></span></a>
				  </li>
		  </ul>
		  <div class="tab-content">
				<div id="Assure" class="tab-pane in active">@include("assurs.addAssure")</div>
				<div id="Patient" class="tab-pane fade">@include('patient.addPatient')</div>
				<div id="Homme_C" class="tab-pane fade hidden_fields">
				<div id ="homme_cPart">
					<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue"><b>Information Homme de confiance</b></h3></div></div>
					<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label class="col-sm-3 control-label" for="nomA"><strong>Nom :<span style="color: red">*</span></strong></label>
						<div class="col-sm-9">
							<input type="text" id="nomA" name="nom_homme_c" placeholder="Nom..." class="col-xs-12 col-sm-12" />
							</div><br>
						</div><br>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="prenomA"><strong>Prénom :<span style="color: red">*</span></strong></label>
							<div class="col-sm-9">
								<input type="text" id="prenomA" name="prenom_homme_c" placeholder="Prénom..." class="col-xs-12 col-sm-12" />
							</div>	<br>
						</div><br>
					</div>
				</div>{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="datenaissanceA"><strong class="text-nowrap">Né(e) le :</strong>	</label>
							<div class="col-sm-9">
								<input class="col-xs-12 col-sm-12 date-picker ltnow" id="datenaissance_h_c" name="datenaissance_h_c" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" autocomplete="off"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label text-nowrap" for="lien"><strong>Lien de parenté :</strong></label>
							<div class="col-sm-9">
								<select id="lien" name="lien" class="col-xs-12 col-sm-12">
									<option value="">Sélectionner...</option>
									<option value="conjoint">Conjoint(e)</option>
									<option value="père">Père</option>
									<option value="mère">Mère</option>
									<option value="frère">Frère </option>
									<option value="soeur">Soeur </option>
									<option value="membre_famille">Membre de famille </option>
									<option value="ami">Ami(e) </option>
									<option value="Autre">Autre </option>
								</select>
							</div>
						</div>
					</div>
				</div><div class="space-12"></div>{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="type_piece_id"><strong>Type pièce d'identité:<span style="color: red">*</span></strong></label>
							<div class="col-sm-9">
								<select name="type_piece_id" id="type_piece_id" class="col-xs-12 col-sm-12">
									<option value="">Sélectionner...</option>
									<option value="CNI">Carte d'identité nationale</option>
									<option value="Permis">Permis de conduire</option>
									<option value="Passeport">Passeport </option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 text-nowrap" for="npiece_id"><strong>N° Pièce :<span style="color: red">*</span></strong></label>
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
								<input class="col-xs-12 col-sm-12 date-picker" id="date_piece_id" name="date_piece_id" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" autocomplete="off"/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<br><br>
					</div>
				</div>	{{-- row --}}
				<div class="space-12"></div>
				<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue"><b>Contact</b></h3></div></div>{{-- row --}}
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
								<label class="control-label text-nowrap col-sm-2" for="mobileA"><i class="fa fa-phone"></i><b>Mob :<span style="color: red">*</span></b></label>
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
	  <div class="hr hr-dotted"></div>
		<div class="row">
			<div class="center"><br>
				<button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
			</div>
		</div>
	  </form>
	 </div>
@endsection