@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Ajouter un Lit :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
				<div class="widget-box" id="widget-box-1">
					<div class="widget-header">
						<h5 class="widget-title">Lit :</h5>
						<div class="widget-toolbar widget-toolbar-light no-border">
						<i class="ace-icon fa fa-table"></i>
						<a href="/lit"> <b>&nbsp;Liste des Lits</b></a>
				</div>
					</div>
					<div class="widget-body">
						<div class="widget-main">
							<form class="form-horizontal" role="form" method="POST" action="{{ route('lit.store') }}">
								{{ csrf_field() }}
								<input type="text" name="idsalle" value="{{$id_salle}}" hidden>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="numlit"><strong> Numéro Du Lit : </strong></label>
									<div class="col-sm-9">
										<input type="number" id="numlit" name="numlit" placeholder="Numéro du  lit" class="col-xs-10 col-sm-5"  min="0"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> nom   Lit : </strong>
									</label>
									<div class="col-sm-9">
									<input type="text" id="nom" name="nom" placeholder="nom complet du lit" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div class="form-group" hidden>
									<label class="col-sm-3 control-label no-padding-right" for="chambre"><strong>Chambre :</strong></label>
									<div class="col-sm-9">
										<select class="col-xs-10 col-sm-5" id="chambre" name="chambre" required>
										<option value=" {{ $id_salle }}" ></option>
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