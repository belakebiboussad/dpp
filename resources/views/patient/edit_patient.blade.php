@extends('app')
@section('page-script')
	<script>
	function showType(value){
    		switch(value){
		           case "Assure":
		                     $("#nomf").val($("#nom").val());
		                     $("#prenomf").val($("#prenom").val());
		                     $("#datenaissancef").val($("#datenaissance").val());
		                     $("#lieunaissancef").val($("#lieunaissance").val());
		                     $("input[name=sexef][value=" + $('input[name=sexe]:radio:checked').val() + "]").prop('checked', true);  
		                     $("#foncform").addClass('hide'); 
		                     $('#Type_p').attr('required', false);  
		                     addRequiredAttr();
		                      break;
		           case "Ayant_droit":
		                    $("#nomf").val("");
		                    $("#prenomf").val("");
		                    $("#foncform").removeClass('hide');
		                    $('#Type_p').attr('required', true); 
		                    addRequiredAttr();
		                
		                break;
		           case "Autre":
		                     $(".starthidden").show(250);
		                     $("#foncform").addClass('hide');
		                     $('#Type_p').attr('required', false); 
		                     $("ul#menuPatient li:not(.active) a").prop('disabled', true);
		               break;         
			}			
		}
	</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>modification Du Patient :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
	<div class="pull-right">
		<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>
				Retour a La Liste Des Patients
			</a>
	</div>
</div>
<form class="form-horizontal" action="{{ route('patient.update',$patient ->id) }}" method="POST">
	{{ csrf_field() }}
  	{{ method_field('PUT') }}
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
   		 <li class="active"><a data-toggle="tab" href="#Patient">
   		 	<span class="bigger-130"><strong>Patient</strong></span></a>
   		 </li>
    		<li><a data-toggle="tab" href="#Assure">
    			<span class="bigger-130"><strong>Assure</strong></span></a>
    		</li>
  	</ul>
  	<div class="tab-content">
	 	<div id="Patient" class="tab-pane fade in active">
	      		<div class="row">
	      			<div class="col-sm-12">
				<h3 class="header smaller lighter blue">Informations administratives</h3>
			</div>
	      		</div>
	      		<div class="row">
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="nom">
							<strong>Nom :</strong> 
						</label>
						<div class="col-sm-9">
						<input type="text" id="nom" name="nom" placeholder="Nom..." value="{{ $patient->Nom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
							{!! $errors->first('datenaissance', '<small class="alert-danger">:message</small>') !!}
						</div>
					</div>
				</div>{{-- col-sm-6	 --}}
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="prenom">
							<strong>Prénom :</strong>
						</label>
						<div class="col-sm-9">
							<input type="text" id="prenom" name="prenom" placeholder="Prénom..."value="{{ $patient->Prenom }}"class="form-control form-control-lg col-xs-12 col-sm-12" autocomplete="off" required/>
							{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>{{-- col-sm-6	 --}}
	      		</div>  {{-- row --}}
	      		<div class="row">
	      			<div class="col-sm-6">
					<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
					<label class="col-sm-3 control-label" for="datenaissance">
						<strong>Né(e) le :</strong>
					</label>
					<div class="col-sm-9">
						<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" value="{{ $patient->Dat_Naissance }}" required/>
							{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
					</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="lieunaissance">
							<strong class="text-nowrap">Lieu de naissance :</strong>
						</label>
					<div class="col-sm-9">
					<input type="text" id="lieunaissance" name="lieunaissance" placeholder="Lieu de naissance..."  autocomplete = "off" class="col-xs-12 col-sm-12" value="{{ $patient->Lieu_Naissance }}"required/>
					 {!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
					</div>
					</div>
				</div>
	      		</div>  {{-- row --}}
	      		<div class="row">
	      			<div class="col-sm-6">
					<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="sexe">
							<strong>Sexe :</strong>
						</label>
						<div class="col-sm-9">
							<div class="radio">
							<label>
							<input name="sexe" value="M" type="radio" class="ace" {{ $patient->Sexe == "M" ? "checked" : ""}}/>
								<span class="lbl"> Masculin</span>
							</label>
							<label>
							<input name="sexe" value="F" type="radio" class="ace" {{ $patient->Sexe == "F" ? "checked" : ""}}/>
								<span class="lbl"> Féminin</span>
							</label>
							</div>
						</div>	
					</div>
				</div>	{{-- col-sm-6 --}}
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label text-nowrap" for="gs">
							<strong>Groupe sanguin :</strong>
						</label>
						<div class="col-sm-2">
							<select class="form-control" id="gs" name="gs">
							@if(!isset($patient->group_sang)  && empty($patient->group_sang)) 
								<option value="" selected >------</option>
								<option value="A" >A</option>
								<option value="B">B</option>
								<option value="AB" >AB</option>
								<option value="O" >O</option>
							@else 		
								<option value="" selected >------</option>
								<option value="A" @if( $patient->group_sang =="A") selected @endif>A</option>
								<option value="B" @if( $patient->group_sang =="B") selected @endif>B</option>
								<option value="AB" @if( $patient->group_sang =="AB") selected @endif>AB</option>
								<option value="O" @if( $patient->group_sang =="O") selected @endif>O</option>
							@endif
							</select>
						</div>
						<label class="col-sm-3 control-label no-padding-right" for="rh">
							<strong>Rhésus :</strong>
						</label>
						<div class="col-sm-2">
						<select id="rh" name="rh">
						@if(!isset($patient->rhesus)  && empty($patient->rhesus)) 
							<option value="" selected >------</option>
							<option value="+">+</option>
							<option value="-">-</option>
						@else
							<option value="" >------</option>
							<option value="+" @if( $patient->rhesus =="+") selected @endif>+</option>
							<option value="-" @if( $patient->rhesus =="-") selected @endif>-</option>
						@endif
						</select>
						</div>
					</div>
				</div>{{-- col-sm-6 --}}
	      		</div> {{-- row --}}
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
					<label class="col-sm-3 control-label" for="sf">
						<strong class="text-nowrap">Civilité :</strong>
					</label>
				
					<div class="col-sm-9">
						<select class="form-control" id="sf" name="sf">
							<option value="celibataire" @if( $patient->situation_familiale =='celibataire') selected @endif >Célibataire</option>
							<option value="marie" @if( $patient->situation_familiale =='marie') selected @endif>Marié</option>
							<option value="divorce" @if( $patient->situation_familiale =="divorce") selected @endif >Divorcé</option>
							<option value="veuf" @if( $patient->situation_familiale =="veuf") selected @endif  >Veuf</option>
						</select>
					</div>
					</div>
				</div>
				{{-- /nom de jeune fille --}}
			</div>	{{-- row --}}
			<div class="row">
				<div class="col-sm-12">
				<h3 class="header smaller lighter blue">Contact</h3>
				</div>
			</div>	{{-- row --}}
			<div class="space-12"></div>	
			<div class="row">
				<div class="col-sm-5">
					<div class="form-group">
						<label class="control-label col-sm-3" for="adresse"><strong>Adresse :</strong></label>
						<div class="col-sm-9">
						<textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse...">{{ $patient->Adresse }}</textarea>	
						</div>
					</div>
				</div>{{-- coli-sm-6 --}}
				<div class="col-sm-7">
					<div class="form-group">
						<div class="form-group">
						<label class="control-label text-nowrap col-sm-2 for="mobile1"><i class="fa fa-phone"></i><strong>Mob1:</strong></label>
						<div class="col-sm-2" style="width:80px;">
							<select name="operateur1" id="operateur1" class="form-control" required="">
					                                     @php	$operator = substr($patient->tele_mobile1,0,2) @endphp
		 						<option value="05" @if($operator == '05') selected @endif >05</option>         
							   	<option value="06" @if($operator == '06') selected @endif >06</option>
							           <option value="07" @if($operator == '07') selected @endif>07</option>
                       					</select>	
						</div>
						<input id="mobile1" name="mobile1"  maxlength =8 minlength =8  name="mobile1" type="tel" autocomplete="off" class="col-sm-2" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX"  value= " {{  substr($patient->tele_mobile1,2,10) }}" required />	
						<label class="control-label text-nowrap col-sm-2 for="mobile2"><i class="fa fa-phone"></i><strong>Mob2:</strong></label>
						<div class="col-sm-2" style="width:80px;">
				        		<select name="operateur2" id="operateur2" class="form-control">
						@if(!isset($patient->tele_mobile2)  && empty($patient->tele_mobile2))		
					              	 <option value="" selected >XX</option>
					              	  <option value="05" >05</option>
							 <option value="06">06</option>
							 <option value="07">07</option>
						@else
							@php  $operator2 = substr($patient->tele_mobile2,0,2) @endphp
							<option value="" >XX</option>
							 <option value="" @if($operator2 == '05') selected @endif>05</option>
							 <option value="" @if($operator2 == '06') selected @endif>06</option>
							 <option value="" @if($operator2 == '07') selected @endif>07</option>
						@endif				
                       					</select>
          						</div>
          						<input id="mobile2" name="mobile2"  maxlength =8 minlength =8  type="tel" autocomplete="off" class="col-sm-2" value="{{  substr($patient->tele_mobile2,2,10) }}" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"   placeholder="XX XX XX XX">
						</div>
					</div>
				</div>
			</div>{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-6">
					<div class="col-sm-2">
						<label class="control-label no-padding-right pull-right" style=" padding-top: 0px;"><strong>Type :</strong></label>
					</div>
					<div class="col-sm-9">
						<label class="line-height-1 blue">
							<input id="fonc" name="type" value="Assure" type="radio" class="ace" onclick="showType('Assure')"  @if($patient->Type =='Assure') Checked @endif />
							<span class="lbl"> Assuré(e)</span>
						</label>&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="ayant" name="type" value="Ayant_droit" type="radio" class="ace" onclick="showType('Ayant_droit')" @if($patient->Type =='Ayant_droit') Checked @endif />
							<span class="lbl"> Ayant droit</span>
						</label>&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="autre" name="type" value="Autre" type="radio" class="ace" onclick="showType('Autre')" @if($patient->Type =='Autre') Checked @endif />
							<span class="lbl"> Autre</span>
						</label>	
					</div>		
				</div>{{-- col-sm-6 --}}
			</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row" id="foncform">
			<div class="col-sm-6">
				<div class="form-group">
				 <label class="col-sm-3 control-label" for="Type_p">
					<strong>Type :</strong>
				</label>
				<div class="col-sm-9">
		  			<select class="form-control col-xs-12 col-sm-6" id="Type_p" name="Type_p" required>
						<option value="">------</option>
						<option value="Ascendant" @if($patient->Type_p == 'Ascendant')  selected @endif>Ascendant</option>
						<option value="Descendant" @if($patient->Type_p == 'Descendant')  selected @endif>Descendant</option>
						<option value="Conjoint" @if($patient->Type_p == 'Conjoint')  selected @endif>Conjoint</option>
					</select>
				</div>	
				</div>					
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					 <label class="col-sm-4 control-label" for="nsspatient">
						<strong>NSS (patient):</strong>
					</label>
					<div class="col-sm-8">
						<input type="text" class="form-control col-xs-12 col-sm-6" id="nsspatient" name="nsspatient" value="{{ $patient->NSS }}"
						pattern="^\[0-9]{2}+' '+\[0-9]{4} +' '+\[0-9]{4}+' '+[0-9]{2}$"  placeholder="XX XXXX XXXX XX" />
					</div>
				</div>			
			 </div>	
			</div>{{-- row --}}

			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-6 starthidden">
					<label for="description"><strong>Autre information :</strong></label>
					<textarea class="form-control" id="description" name="description" placeholder="Description du la dérogation" ></textarea>
				</div>
			</div>
	      	</div> {{-- tab-pane --}}
	      	<div id="Assure" class="tab-pane fade">
	      	<div id ="assurePart">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="header smaller lighter blue">
						<strong>Information L'Assuré(e)</strong>
					</h3>
				</div>	
			</div>{{-- row --}}
		</div>{{-- assurePart --}}
	      	</div> {{-- tab-pane --}}
	</div> {{-- tab-content --}}
@endsection