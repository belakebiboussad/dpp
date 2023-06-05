@extends('app')
@section('main-content')
	<div class="page-header"><h1>Modifier la chambre "{{ $salle->nom }}"</h1></div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
			<div class="widget-header"><h5 class="widget-title">Chambre</h5></div>
			<div class="widget-body">
			<div class="widget-main">
			<form role="form" method="POST" action="{{ route('salle.update', $salle->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group row">
					<label class="col-sm-3 col-control-label" for="numsalle">Numéro</label>
					<div class="col-sm-9">
						<input type="number" min="0" name="num" value="{{ $salle->num }}" placeholder="Numéro De La Chambre" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-control-label" for="nomsalle">Nom</strong></label>
					<div class="col-sm-9">
						<input type="text" name="nom" value="{{ $salle->nom }}" placeholder="Nom De La Chambre" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-control-label" for="max_lit">Capacité</label>
					<div class="col-sm-9">
						<input type="number" name="max_lit" value="{{ $salle->max_lit }}" placeholder="Max des Lits" class="col-xs-10 col-sm-5" min="0"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-control-label" for="bloc">Bloc</label>
					<div class="col-sm-9">
						<input type="text" name="bloc" value="{{ $salle->bloc }}" placeholder="Bloc" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label" for="etage">N° d'étage</label>
					<div class="col-sm-9">
					<input type="number" name="etage" value="{{ $salle->etage }}" placeholder="N° d'etage" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-control-label" for="service_id">Service</label>
					<div class="col-sm-9">
						<select class="form-select col-xs-10 col-sm-5" name="service_id">
						<option value="{{$salle->service_id}}">{{ $salle->service->nom }}</option>
						@foreach($services as $service)
						<option value="{{ $service->id }}">{{ $service->nom }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-control-label" for="genre">Unité</label>
					<div class="col-sm-9">
					<label><input name="genre" value="0" type="radio" class="ace" @if(!($service->genre)) checked @endif/><span class="lbl">Homme</span></label>&nbsp;&nbsp;&nbsp;
					<label><input name="genre" value="1" type="radio" class="ace" @if($service->genre) checked @endif/><span class="lbl">Femme</span></label>&nbsp;&nbsp;&nbsp;
				  </div>
				</div>
				<div class="form-group row">
					<div class="checkbox col-sm-offset-3">
          <label>
<input name="etat" type="checkbox" class="ace" value ="1" {{(isset($salle->etat))? 'checked':''}}>
            <span class="lbl"> Chambre bloquée</span>
          </label>
          </div>
        </div>
				<div>
  					<div class="center">
  						<button class="btn btn-primary btn-xs" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
  						<button class="btn btn-warning btn-xs" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
  					</div>
					</div>
				</form>
				</div>
			</div>
				</div>
		</div>
	</div>
@stop