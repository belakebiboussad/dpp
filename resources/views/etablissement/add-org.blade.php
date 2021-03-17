@extends('app')
@section('main-content')
	<div class="row"><h3>Etablissement :</h3></div><div class="space-12 hidden-xs"></div>
	<div class="row">
		<form class="form-horizontal" role="form" method="POST" action="{{ route('etablissement.store') }}" enctype="multipart/form-data">
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
								<input type="text" name="nom" placeholder="Nom du l'etablissement" class="col-xs-12 col-sm-12" required/>
							</div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Adresse: </strong></label>
							<div class="col-sm-9"><input type="text" name="adresse" placeholder="Adresse du l'etablissement" class="col-xs-12 col-sm-12"/></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Téléphone: </strong></label>
							<div class="col-sm-9"><input type="tel" name="tel" placeholder="Téléphone du l'etablissement" class="col-xs-12 col-sm-12 telfixe"/></div>
						</div><div class="space-12  hidden-xs"></div>	
					  <div class="center">
							<button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
							<button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-xs-12 center">
			<div class="space-12  hidden-xs"></div>
			<div class="form-group">
			  <label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Logo: </strong></label>
				<div class="col-sm-9">
					<span class="profile-picture col-sm-9">
					<!-- 	<img class="editable img-responsive" alt="Logo du l'etablissement" id="logo" name="logo" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}"/> -->
						<input type="file" class="form-control" id="logo" name="logo" alt="Logo du l'etablissement">
					</span>
				</div>	
			</div>
		</div>
		</form>
	</div>
@endsection