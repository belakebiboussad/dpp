@extends('app')
@section('main-content')
	<div class="page-header"><h4>Modifier le lit </h4></div>
	<div class="row">
		<div class="col-xs-12">
		<div class="widget-box">
		<div class="widget-header">
			<h5 class="widget-title"><i class="ace-icon fa fa-bed bigger-120"></i>Lit :</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
					<i class="ace-icon fa fa-table"></i><a href="/lit">&nbsp;Lits</a>
			</div>
		</div>
		<div class="widget-body">
		<div class="widget-main">
			<form class="form-horizontal" role="form" method="POST" action="{{ route('lit.update', $lit->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="numlit">Numéro :</label>
					<div class="col-sm-9">
						<input type="number" name="num" value="{{ $lit->num }}" class="col-xs-10 col-sm-5" required/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="nom">Nom : </label>
					<div class="col-sm-9">
						<input type="text" name="nom" value="{{ $lit->nom }}"  class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etage">Chambre : </label>
					<div class="col-sm-9">
						<select class="col-xs-10 col-sm-5" id="salle" name="salle_id" required>
							@foreach($salles as $salle)
							<option value="{{ $salle->id }}" @if($lit->salle_id == $salle->id) selected @endif>{{ $salle->nom }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div>
                              <div class=" col-sm-9 col-sm-offset-3">
                            <div class="form-group">
                                      <label>Bloqué :
                                        <input id="" type="checkbox" class="ace ace-switch ace-switch-4"  name="etats" value ="1"  data-on="Oui"  data-off="Non" {{ $lit->bloq == 1  ? "checked" : "" }} />
                                        <span class="lbl"></span>
                                      </label>
                            </div>
                              </div>
				<div class="center">
					<button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp; &nbsp;
					<button class="btn btn-danger" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
				</div>
				</div>
			</form>
			</div>
		</div>
		</div>
	</div>
</div>
@endsection