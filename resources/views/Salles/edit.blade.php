@extends('app')
@section('main-content')
	<div class="row"><h3><strong>Modifier les données de la chambre "{{ $salle->nom }}" :</strong></h3>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
			<div class="widget-header">
				<h5 class="widget-title"><strong>Modifier une chambre :</strong></h5>
			</div>
			<div class="widget-body">
			<div class="widget-main">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('salle.update', $salle->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="numsalle"><strong> Numéro chambre : </strong></label>
					<div class="col-sm-9">
						<input type="text" name="num" value="{{ $salle->num }}" placeholder="Numéro De La Chambre" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="nomsalle"><strong> Nom chambre : </strong></label>
					<div class="col-sm-9">
						<input type="text" name="nom" value="{{ $salle->nom }}" placeholder="Nom De La Chambre" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="max_lit"><strong> Max lits : </strong></label>
					<div class="col-sm-9">
						<input type="text" name="max_lit" value="{{ $salle->max_lit }}" placeholder="Max des Lits" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="bloc"><strong> Bloc : </strong></label>
					<div class="col-sm-9">
						<input type="text" name="bloc" value="{{ $salle->bloc }}" placeholder="Bloc" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etage"><strong> N° d'etage : </strong></label>
					<div class="col-sm-9">
					<input type="text" name="etage" value="{{ $salle->etage }}" placeholder="N° d'etage" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etage"><strong> Service : </strong></label>
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
					<label class="col-sm-3 control-label no-padding-right" for="genre"><strong> Genre: </strong></label>
					<div class="col-sm-9">
					<label><input name="genre" value="0" type="radio" class="ace" @if(!($service->genre)) checked @endif/><span class="lbl">Homme</span></label>&nbsp;&nbsp;
					<label><input name="genre" value="1" type="radio" class="ace" @if($service->genre) checked @endif/><span class="lbl">Femme</span></label>&nbsp;&nbsp;&nbsp;
				  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etat"><strong> bloquée : </strong></label>
					<div class="col-sm-9">
						@if(isset($salle->etat))
						<label>
							<input name="etat" value="1" type="radio" class="ace" checked="checked" />
							<span class="lbl"> Oui {{$salle->etat }}</span>
						</label>&nbsp;&nbsp;&nbsp;				
						<label>
							<input name="etat" value="" type="radio" class="ace"/>
							<span class="lbl"> Non</span>
						</label>
						@else
						<label>
							<input name="etat" value="1" type="radio" class="ace"/>
							<span class="lbl"> Oui {{$salle->etat }}</span>
						</label>&nbsp;&nbsp;&nbsp;				
						<label>
							<input name="etat" value="" type="radio" class="ace"  checked="checked"/>
							<span class="lbl"> Non</span>
						</label>
						@endif
						
					</div>
					</div>
					<div>
					<div class="center">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-save bigger-110"></i>
							Actualiser
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