@extends('app_recep')
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
	<div class="col-sm-12">
		<h3 class="header smaller lighter blue">
			Informations administratives
		</h3>
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
isset($name) ? $name : 'Guest'
							@if (!isset($patient->group_sang))
								<option value="">------</option>
							@else 		
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
						{{-- <div class="col-sm-2">
							<select id="rh" name="rh">
								<option value="">------</option>
								<option value="+" @if( $patient->rhesus =="+") selected @endif>+</option>
								<option value="-" @if( $patient->rhesus =="-") selected @endif>-</option>
							</select>
						</div> --}}
					</div>
				</div>{{-- col-sm-6 --}}
	      		</div> {{-- row --}}


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