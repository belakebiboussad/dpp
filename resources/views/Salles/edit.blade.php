@extends('app')
@section('main-content')
	<div class="page-header"><h1>Modifier les données de la chambre "{{ $salle->nom }}" :</h1></div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
			<div class="widget-header"><h5 class="widget-title">Modifier les données d'une chambre :</h5></div>
			<div class="widget-body">
			<div class="widget-main">
			<form role="form" method="POST" action="{{ route('salle.update', $salle->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="numsalle">Numéro : </label>
					<div class="col-sm-9">
						<input type="text" name="num" value="{{ $salle->num }}" placeholder="Numéro De La Chambre" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="nomsalle">Nom : </strong></label>
					<div class="col-sm-9">
						<input type="text" name="nom" value="{{ $salle->nom }}" placeholder="Nom De La Chambre" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="max_lit">Capacité : </label>
					<div class="col-sm-9">
						<input type="text" name="max_lit" value="{{ $salle->max_lit }}" placeholder="Max des Lits" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="bloc">Bloc :</label>
					<div class="col-sm-9">
						<input type="text" name="bloc" value="{{ $salle->bloc }}" placeholder="Bloc" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etage">N° d'étage :</label>
					<div class="col-sm-9">
					<input type="text" name="etage" value="{{ $salle->etage }}" placeholder="N° d'etage" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="service_id">Service :</label>
					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" name="service_id">
						<option value="{{$salle->service_id}}">{{ $salle->service->nom }}</option>
						@foreach($services as $service)
						<option value="{{ $service->id }}">{{ $service->nom }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="genre">Unité :</label>
					<div class="col-sm-9">
					<label><input name="genre" value="0" type="radio" class="ace" @if(!($service->genre)) checked @endif/><span class="lbl">Homme</span></label>&nbsp;&nbsp;&nbsp;
					<label><input name="genre" value="1" type="radio" class="ace" @if($service->genre) checked @endif/><span class="lbl">Femme</span></label>&nbsp;&nbsp;&nbsp;
				  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etat">Bloquée :</label>
					<div class="col-sm-9">
						@if(isset($salle->etat))
						<label>
							<input name="etat" value="1" type="radio" class="ace" checked="checked" />
							<span class="lbl"> Oui {{$salle->etat }}</span>
						</label>&nbsp;&nbsp;	
						<label>
							<input name="etat" value="" type="radio" class="ace"/><span class="lbl"> Non</span>
						</label>
						@else
						<label>
							<input name="etat" value="1" type="radio" class="ace"/>
							<span class="lbl"> Oui {{$salle->etat }}</span>
						</label>&nbsp;&nbsp;
						<label>
							<input name="etat" value="" type="radio" class="ace"  checked="checked"/>
							<span class="lbl"> Non</span>
						</label>
						@endif
					</div>
					</div>
					<div>
  					<div class="center">
  						<button class="btn btn-primary btn-xs" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp;&nbsp;
  						<button class="btn btn-warning btn-xs" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
  					</div>
					</div>
				</form>
				</div>
			</div>
				</div>
		</div>
	</div>
@endsection