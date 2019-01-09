@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Ajouter un Lit :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
				<div class="widget-box" id="widget-box-1">
					<div class="widget-header">
						<h5 class="widget-title">Ajouter Un Lit :</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main">
							<form class="form-horizontal" role="form" method="POST" action="{{ route('lit.store') }}">
								{{ csrf_field() }}
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="numlit"><strong> Numéro Du Lit : </strong></label>
									<div class="col-sm-9">
										<input type="text" id="numlit" name="numlit" placeholder="Numéro De La lit" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="etatlit"><strong> Etat Du Lit : </strong></label>
									<div class="col-sm-9">
										<div class="radio">
											<label>
												<input name="etat" value="0" type="radio" class="ace" />
												<span class="lbl"> Bloqué</span>
											</label>
										</div>
										<div class="radio">
											<label>
												<input name="etat" value="1" type="radio" class="ace" />
												<span class="lbl"> Non Bloqué</span>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="salle"><strong>Chambre :</strong></label>
									<div class="col-sm-9">
										<select class="col-xs-10 col-sm-5" id="salle" name="idsalle">
											<option value="">Choisir Une Chambre...</option>
											@foreach($salles as $salle)
												<option value="{{ $salle->id }}">{{ $salle->num }}</option>
											@endforeach
										</select>
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