@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Modifier une Chambre :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
			<div class="widget-header">
				<h5 class="widget-title">Modifier Une Chambre :</h5>
			</div>
			<div class="widget-body">
			<div class="widget-main">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('salle.update', $salle->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="numsalle"><strong> Numéro Chambre : </strong></label>
					<div class="col-sm-9">
						<input type="text" id="numsalle" name="numsalle" value="{{ $salle->num }}" placeholder="Numéro De La Chambre" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="nomsalle"><strong> Nom Chambre : </strong></label>
					<div class="col-sm-9">
						<input type="text" id="nomsalle" name="nomsalle" value="{{ $salle->nom }}" placeholder="Nom De La Chambre" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="maxlits"><strong> Max Lits : </strong></label>
					<div class="col-sm-9">
						<input type="text" id="maxlits" name="maxlits" value="{{ $salle->max_lit }}" placeholder="Max des Lits" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="bloc"><strong> Bloc : </strong></label>
					<div class="col-sm-9">
						<input type="text" id="bloc" name="bloc" value="{{ $salle->bolc }}" placeholder="Bloc" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etage"><strong> N° d'etage : </strong></label>
					<div class="col-sm-9">
					<input type="text" id="etage" name="etage" value="{{ $salle->etage }}" placeholder="N° d'etage" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etage"><strong> Service : </strong></label>
					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" id="service" name="service">
						<option value="{{$salle->id_service}}">
						{{ App\modeles\service::where("id", $salle->id_service)->get()->first()->nom }}
						</option>
						@foreach($services as $service)
						<option value="{{ $service->id }}">{{ $service->nom }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="bloc"><strong> Etat : </strong></label>
					<div class="col-sm-9">
						<label>
							<input name="etat" value="bloquée" type="radio" class="ace" {{ $salle->etat == "bloquee" ? "checked" : "" }}/>
							<span class="lbl"> bloquée</span>
						</label>&nbsp;&nbsp;&nbsp;				
						<label>
							<input name="etat" value="Non bloquee" type="radio" class="ace" {{ $salle->etat == "Non bloquee" ? "checked" : "" }}/>
							<span class="lbl"> Non bloquée</span>
						</label>
						
					</div>
					</div>
					<div>
					<div class="center">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-save bigger-110"></i>
							Enregistrer
						</button>&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="ace-icon fa fa-undo bigger-110"></i>Annuler
						</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
		</div>
	</div>
@endsection