@extends('app')
@section('main-content')
	<div class="row"><h4><strong>Modifier les données du lit :</strong></h4>
	</div>
	<div class="row">
		<div class="col-xs-12">
		<div class="widget-box" id="widget-box-1">
		<div class="widget-header">
			<h5 class="widget-title"><i class="ace-icon fa fa-bed bigger-120"></i>Lit :</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
					<i class="ace-icon fa fa-table bigger-120"></i>
			<a href="/lit"> <b>&nbsp;Liste des lits</b></a>
			</div>
		</div>
		<div class="widget-body">
		<div class="widget-main">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('lit.update', $lit->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="numlit"><strong> Numéro : </strong></label>
					<div class="col-sm-9">
						<input type="number" id="numlit" name="numlit" value="{{ $lit->num }}" placeholder="Numéro du lit" class="col-xs-10 col-sm-5" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Nom : </strong></label>
					<div class="col-sm-9">
						<input type="text" id="nom" name="nom" value="{{ $lit->nom }}" placeholder="Nom du lit" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etage"><strong> Chambre : </strong></label>
					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" id="salle" name="salle" required>
							<option value="{{ $lit->salle_id }}">
							{{ App\modeles\salle::where("id", $lit->salle_id)->get()->first()->nom }}
							</option>
							@foreach($salles as $salle)
							<option value="{{ $salle->id }}">{{ $salle->nom }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etatlit"><strong> Lit bloqué : </strong></label>
					<div class="col-sm-9">
						<div class="checkbox">
					            <label>
					                <input type="checkbox" name="etat" value ="{{ $lit->etat }}"  {{ $lit->etat == 0 ? "checked" : "" }} >
					            </label>
					</div>
					</div>
				</div>
				<div class="center">
					<button class="btn btn-info" type="submit">
						<i class="ace-icon fa fa-save bigger-110"></i>
						Enregistrer
					</button>
					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>
						Annuler
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