@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Ajouter un Lit :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
		<div class="widget-box" id="widget-box-1">
			<div class="widget-header">
				<h5 class="widget-title"><i class="ace-icon fa fa-bed bigger-120"></i><strong>Lit :</strong></h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
					<i class="ace-icon fa fa-table"></i>
					<a href="/lit"> <b>&nbsp;Liste des Lits</b></a>
			</div>
			<div class="widget-body">
			<div class="widget-main">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('lit.store') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="numlit"><strong> Numéro Lit : </strong>
					</label>
					<div class="col-sm-9">
					<input type="number" id="numlit" name="numlit" placeholder="numéro du  lit" class="col-xs-10 col-sm-5"  required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> nom   Lit : </strong>
					</label>
					<div class="col-sm-9">
					<input type="text" id="nom" name="nom" placeholder="nom complet du lit" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="salle"><strong>Chambre :</strong></label>
					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" id="salle" name="idsalle" required>
						<option value="">Choisir Une Chambre...</option>
						@foreach($salles as $salle)
						<option value="{{ $salle->id }}">{{ $salle->nom }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="etatlit"><strong> Bloquer le Lit : </strong></label>
				<div class="col-sm-9">
				<div class="checkbox">
				            <label>
					               <input type="checkbox" name="etat" value ="1">
				            </label>
				</div>
				</div>
				</div>
				<div>
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