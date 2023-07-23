<div class="page-header"><h1>Modifier la chambre "{{ $salle->nom }}"</h1></div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
			<div class="widget-header"><h5 class="widget-title">Chambre</h5></div>
			<div class="widget-body">
			<div class="widget-main">
			<form role="form" method="POST" action="{{ route('salle.update', $salle) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right" for="numsalle">Numéro</label>
					<div class="col-sm-9">
						<input type="number" min="0" name="num" value="{{ $salle->num }}" class="form-control"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right" for="nomsalle">Nom</strong></label>
					<div class="col-sm-9">
						<input type="text" name="nom" value="{{ $salle->nom }}" class="form-control"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right" for="max_lit">Capacité</label>
					<div class="col-sm-9">
						<input type="number" name="max_lit" value="{{ $salle->max_lit }}" class="form-control" min="0"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right" for="bloc">Bloc</label>
					<div class="col-sm-9">
						<input type="text" name="bloc" value="{{ $salle->bloc }}" class="form-control" />
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right" for="etage">N° d'étage</label>
					<div class="col-sm-9">
					<input type="number" name="etage" value="{{ $salle->etage }}" class="form-control"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right" for="service_id">Service</label>
					<div class="col-sm-9">
						<select class="form-control" name="service_id">
						<option value="{{$salle->service_id}}">{{ $salle->service->nom }}</option>
						@foreach($services as $service)
						<option value="{{ $service->id }}">{{ $service->nom }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right" for="genre">Unité</label>
					<div class="col-sm-9">
					<label><input name="genre" value="0" type="radio" class="ace" @if($salle->genre==0) checked @endif/><span class="lbl">Homme</span></label>
					<label><input name="genre" value="1" type="radio" class="ace" @if($salle->genre==1) checked @endif/><span class="lbl">Femme</span></label>
            <label><input name="genre" value="2" type="radio" class="ace" @if($salle->genre ==2) checked @endif/><span class="lbl">Enfant</span></label>
				  </div>
				</div>
				<div class="form-group row">
					<div class="checkbox col-sm-offset-3">
          <label>
<input name="etat" type="checkbox" class="ace" value ="1" {{(isset($salle->etat))? 'checked':''}}><span class="lbl"> bloquée</span>
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