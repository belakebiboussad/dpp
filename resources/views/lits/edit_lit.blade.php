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
							<form class="form-horizontal" role="form" method="POST" action="{{ route('lit.update', $lit->id) }}">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="numlit"><strong> Numéro Du Lit : </strong></label>
									<div class="col-sm-9">
										<input type="text" id="numlit" name="numlit" value="{{ $lit->num }}" placeholder="Numéro du lit" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="etatlit"><strong> Etat Du Lit : </strong></label>
									<div class="col-sm-9">
										<div class="radio">
											<label>
												<input name="etat" value="0" type="radio" class="ace" {{ $lit->etat == 0 ? "checked" : "" }}/>
												<span class="lbl"> Bloqué</span>
											</label>
										</div>
										<div class="radio">
											<label>
												<input name="etat" value="1" type="radio" class="ace" {{ $lit->etat == 1 ? "checked" : "" }}/>
												<span class="lbl"> Non Bloqué</span>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="etatlit"><strong> Etat Du Lit : </strong></label>
									<div class="col-sm-9">
										<div class="radio">
											<label>
												<input name="affectation" value="0" type="radio" class="ace" {{ $lit->affectation == 0 ? "checked" : ""}}/>
												<span class="lbl"> Non Affecté</span>
											</label>
										</div>
										<div class="radio">
											<label>
												<input name="affectation" value="1" type="radio" class="ace" {{ $lit->affectation == 1 ? "checked" : ""}}/>
												<span class="lbl">Affecté</span>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="etage"><strong> Chambre : </strong></label>
									<div class="col-sm-9">
										<select class="col-xs-10 col-sm-5" id="salle" name="salle">
											<option value="{{ $lit->id_salle }}">
												{{ App\modeles\salle::where("id", $lit->id_salle)->get()->first()->num }}
											</option>
											@foreach($salles as $salle)
											<option value="{{ $salle->id }}">{{ $salle->num }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div>
									<div class="center">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											Submit
										</button>
										&nbsp; &nbsp; &nbsp;
										<button class="btn" type="reset">
											<i class="ace-icon fa fa-undo bigger-110"></i>
											Reset
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