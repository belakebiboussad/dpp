@extends('app_sur')
@section('main-content')
	<div class="page-header">
		<h1>
			Ajouter Un RDV Hospitalisation pour {{$demande->Nom}} {{$demande->Prenom}}
		</h1>
	</div><!-- /.page-header -->
	<div class="row">
		<div class="col-xs-12">		
			<form class="form-horizontal" role="form" method="POST" action="{{ route('admission.store') }}">
				{{ csrf_field() }}
				<input type="text" name="id_demande" value="{{$demande->id_demande}}" hidden>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="service">
						<strong> 
							Service :
						</strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="service" name="service" placeholder="Motif De L'hospitalisation" value="{{ $demande->nomService }}" class="col-xs-10 col-sm-5" disabled/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="motif">
						<strong> 
							Motif De L'hospitalisation :
						</strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="{{ $demande->motif }}" class="col-xs-10 col-sm-5" disabled/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="priorite">
						<strong> 
							Priorité :
						</strong>
					</label>
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
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="motif">
						<strong> 
							 observation :
						</strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="{{$demande->observation}}" class="col-xs-10 col-sm-5" disabled/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="date">
					 	<strong> 
					 		Date prévue d'hospitalisation : 
						</strong>
					</label>
					<div class="col-sm-9">
						<input class="col-xs-10 col-sm-5 date-picker" id="date" name="date" type="text" placeholder="Date prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="heure_rdvh">
					 	<strong> 
					 		Heure Prévue d'hospitalisation : 
						</strong>
					</label>
					<div class="input-group col-sm-9 bootstrap-timepicker" style="width: 350px">		
						<input id="heure_rdvh" name="heure_rdvh" class="form-control" type="text" required>
							<span class="input-group-addon">
								<i class="fa fa-clock-o bigger-110"></i>
							</span>						
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="heure_rdvh">
					 	<strong> 
					 		Service d'hospitalisation : 
						</strong>
					</label>
					<select id="serviceh" name="serviceh" data-placeholder="selectionnez le service d'hospitalisation" class="selectpicker show-menu-arrow place_holder " required>
						<option value="" selected disabled>selectionnez le service d'hospitalisation</option>
						@foreach($services as $service)
							<option value="{{ $service->id }}">{{ $service->nom }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="heure_rdvh">
					 	<strong> 
					 		Salle d'hospitalisation : 
						</strong>
					</label>
					<select id="salle" name="salle" data-placeholder="selectionnez la salle d'hospitalisation" class="selectpicker show-menu-arrow place_holder " required>
						<option value="" selected disabled>selectionnez la salle d'hospitalisation
						</option>
						<option value="1">1</option>
					</select>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="heure_rdvh">
					 	<strong> 
					 		Lit d'hospitalisation : 
						</strong>
					</label>
					<select id="lit" name="lit" data-placeholder="selectionnez le lit" class="selectpicker show-menu-arrow place_holder " onchange="" required>
						<option value="" selected disabled>selectionnez le lit
						</option>
						<option value="1">1</option>
					</select>
				</div>
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-check bigger-110"></i>
							Submit
						</button>
						&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="ace-icon fa fa-undo bigger-110"></i>
							Reset
						</button>
					</div>
			</form>
		</div>
	</div>
@endsection