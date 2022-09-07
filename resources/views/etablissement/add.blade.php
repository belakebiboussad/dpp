@extends('app')
@section('main-content')
	<div class="row"><h3>Ajouter Etablissement:</h3></div><div class="space-12 hidden-xs"></div>
		<form id ="addEtab" class="form-horizontal" role="form" method="POST" action="{{ route('etablissement.store') }}" enctype="multipart/form-data">
		<div class="row">
			{{ csrf_field() }}
		<div class="col-sm-9 col-xs-12">
			<div class="widget-box widget-primary">
				<div class="widget-header" bg="blue"><h5 class="widget-title">Etablissement hospitalier</h5></div>
				<div class="widget-body">
					<div class="widget-main"><div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="nom">Nom:</label>
							<div class="col-sm-9">
								<input type="text" name="nom" class="form-control" />
							</div>
						</div><div class="space-12  hidden-xs"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="nom">Acronyme:</label>
              <div class="col-sm-9">
                <input type="text" name="acronyme" class="form-control" />
              </div>
            </div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="adresse">Adresse:</label>
							<div class="col-sm-9"><input type="text" name="adresse" class="form-control"  /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="tel">Téléphone:</label>
							<div class="col-sm-9"><input type="tel" name="tel" class="form-control telfixe" /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="tel2">Téléphone 2:</label>
							<div class="col-sm-9"><input type="tel" name="tel2" class="form-control telfixe"  /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="tutelle">Tutelle:</label>
							<div class="col-sm-9"><input type="text" name="tutelle" class="form-control"/></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-xs-12 center"><div class="space-12  hidden-xs"></div>
			<div class="form-group">
				<input type="file" class="form-control" id="logo" name="logo" alt="Logo du l'etablissement"/>
			</div>
		</div>
		</div><div class="space-12  hidden-xs"></div>	
		<div class="form-group col text-center">
                      <button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
			<button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
		</div>
	</form>
@endsection