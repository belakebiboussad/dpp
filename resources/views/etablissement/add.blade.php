@extends('app')
@section('main-content')
	<div class="row"><h3>Etablissement :</h3></div><div class="space-12 hidden-xs"></div>
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="widget-box widget-primary" id="widget-box-1">
				<div class="widget-header" bg="blue"><h5 class="widget-title"><strong>Etablissement </strong></h5></div>
				<div class="widget-body">
					<div class="widget-main">
						<form class="form-horizontal" role="form" method="POST" action="{{ route('etablissement.store') }}">
						{{ csrf_field() }}
						<div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Nom: </strong></label>
							<div class="col-sm-9">
								<input type="text" name="nom" placeholder="Nom du l'etablissement" class="col-xs-12 col-sm-12" required/>
							</div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="center">
							<button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
							<button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection