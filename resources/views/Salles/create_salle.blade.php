@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Ajouter une Chambre :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
				<div class="widget-box" id="widget-box-1">
					<div class="widget-header">
						<h5 class="widget-title">Ajouter Une Chambre :</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main">
							<form class="form-horizontal" role="form" method="POST" action="{{ route('salle.store') }}">
								{{ csrf_field() }}
								<input type="text" name="idservice" value="{{$idservice}}" hidden>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="numsalle"><strong> Numéro Chambre : </strong></label>
									<div class="col-sm-9">
										<input type="text" id="numsalle" name="numsalle" placeholder="Numéro De La Chambre" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="nomsalle"><strong> Nom Chambre : </strong></label>
									<div class="col-sm-9">
										<input type="text" id="nomsalle" name="nomsalle" placeholder="Nom De La Chambre" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="maxlits"><strong> Max Des Lits : </strong></label>
									<div class="col-sm-9">
										<input type="text" id="maxlits" name="maxlits" placeholder="Max Des Lits" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="bloc"><strong> Bloc : </strong></label>
									<div class="col-sm-9">
										<input type="text" id="bloc" name="bloc" placeholder="Bloc" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="etage"><strong> N° d'etage : </strong></label>
									<div class="col-sm-9">
										<input type="text" id="etage" name="etage" placeholder="N° d'etage" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div>
									<div class="center">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-save bigger-110"></i>
											Save
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