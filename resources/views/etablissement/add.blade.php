@extends('app')
@section('main-content')
	<div class="row"><h3>Ajouter Etablissement:</h3></div><div class="space-12 hidden-xs"></div>
		<form id ="addEtab" class="form-horizontal" role="form" method="POST" action="{{ route('etablissement.store') }}" enctype="multipart/form-data">
		<div class="row">
			{{ csrf_field() }}
		<div class="col-sm-9 col-xs-12">
			<div class="widget-box widget-primary" id="widget-box-1">
				<div class="widget-header" bg="blue"><h5 class="widget-title"><strong>Etablissement </strong></h5></div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Nom: </strong></label>
							<div class="col-sm-9">
								<input type="text" name="nom"  class="col-xs-12 col-sm-12" />
							</div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Adresse: </strong></label>
							<div class="col-sm-9"><input type="text" name="adresse" class="col-xs-12 col-sm-12"  /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Téléphone: </strong></label>
							<div class="col-sm-9"><input type="tel" name="tel" class="col-xs-12 col-sm-12 telfixe"  /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Téléphone 2: </strong></label>
							<div class="col-sm-9"><input type="tel" name="tel2" class="col-xs-12 col-sm-12 telfixe"  /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Tutelle: </strong></label>
							<div class="col-sm-9"><input type="text" name="tutelle" class="col-xs-12 col-sm-12 "  /></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-xs-12 center">
			<div class="space-12  hidden-xs"></div>
			<div class="form-group">
			
				<input type="file" class="form-control" id="logo" name="logo" alt="Logo du l'etablissement"/>
			</div>
		</div>
		</div><div class="space-12  hidden-xs"></div>	
		<div class="row">
						<div class="center">
							<button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
							<button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
						</div>
		</div>
	</form>
@endsection