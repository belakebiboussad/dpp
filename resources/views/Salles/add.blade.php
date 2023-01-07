@extends('app')
@section('main-content')
	<div class="page-header"><h1>Ajouter une nouvelle chambre :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box">
			<div class="widget-header"><h5 class="widget-title">Ajouter une chambre :</h5></div>
			<div class="widget-body">
			<div class="widget-main">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('salle.store') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="service">Service :</label>
          <div class="col-sm-9">
          @if(isset($service->id))
            <input type="hidden"  name="service_id" value="{{ $service->id }}">
            <div class="col-xs-10 col-sm-5 ">
              <span class="form-control">{{ $service->nom }}</span>
              </div>
          @else
          <select class="col-xs-10 col-sm-5" id="service" name="service_id">
						<option value="">Selectionnez....</option>
						@foreach($services as $service)
						<option value="{{ $service->id }}">{{ $service->nom }}</option>
						@endforeach
					</select>
					@endif
				</div>
			  </div><div class="space-12 hidden-xs"></div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="num">Numéro chambre :</label>
					<div class="col-sm-9">
						<input type="number" name="num" placeholder="Numéro de la Chambre" min="1" class="col-xs-10 col-sm-5" />
					</div>
				</div><div class="space-12 hidden-xs"></div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="nom">Nom chambre :</label>
					<div class="col-sm-9">
						<input type="text" name="nom" placeholder="Nom De La Chambre" class="col-xs-10 col-sm-5" />
					</div>
				</div><div class="space-12 hidden-xs"></div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="max_lit">Capacité :</label>
					<div class="col-sm-9">
						<input type="number" name="max_lit" placeholder="Max Des Lits" class="col-xs-10 col-sm-5" />
					</div>
				</div><div class="space-12 hidden-xs"></div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="bloc">Bloc :</label>
					<div class="col-sm-9">
						<input type="text" name="bloc" placeholder="Bloc" class="col-xs-10 col-sm-5" />
					</div>
				</div><div class="space-12 hidden-xs"></div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etage">N° d'étage :</label>
					<div class="col-sm-9">
						<input type="number" name="etage" placeholder="N° d'etage" class="col-xs-10 col-sm-5" min="0" />
					</div>
				</div><div class="space-12 hidden-xs"></div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="genre">Unité :</label>
					<div class="col-sm-9">
					<label><input name="genre" value="0" type="radio" class="ace" checked/><span class="lbl">Homme</span></label>&nbsp;&nbsp;
					<label><input name="genre" value="1" type="radio" class="ace"/><span class="lbl">Femme</span></label>&nbsp;&nbsp;&nbsp;
					<label><input name="genre" value="1" type="radio" class="ace"/><span class="lbl">Enfant</span></label>&nbsp;&nbsp;&nbsp;
				  </div>
				</div><div class="space-12 hidden-xs"></div>
				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="etat">Chambre bloquée :</label>
					<div class="col-sm-9">
						<div class="checkbox">
	            <label><input type="checkbox" name="etat" value ="1"></label>
		        </div>
					</div>
				</div><div class="space-12 hidden-xs"></div>
				<div class="row">
					<div class="center">
						<button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save"></i>
								Enregistrer</button>&nbsp; &nbsp;
						<button class="btn btn-xs btn-warning" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
					</div>
				</div>	
				</form>
				</div>
			</div>
			</div>
		</div>
	</div>
@endsection