@extends('app')
@section('main-content')
	<div class="row"><h3>Etablissement :</h3></div><div class="space-12 hidden-xs"></div>
	<div class="row">
		<div class="col-sm-9 col-xs-12">
			<div class="widget-box widget-primary" id="widget-box-1">
				<div class="widget-header" bg="blue"><h5 class="widget-title"><strong>Etablissement </strong></h5></div>
				<div class="widget-body">
					<div class="widget-main">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('etablissement.update', $etablissement->id) }}">
						<input type="hidden" name="id" value="{{ $etablissement->id }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Nom: </strong></label>
							<div class="col-sm-9">
								<input type="text" name="nom"  class="col-xs-12 col-sm-12"  value = "{{ $etablissement->nom }} " />
							</div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Adresse: </strong></label>
							<div class="col-sm-9"><input type="text" name="adresse" class="col-xs-12 col-sm-12" value="{{ $etablissement->adresse }}" /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Téléphone: </strong></label>
							<div class="col-sm-9"><input type="tel" name="tel" class="col-xs-12 col-sm-12 telfixe" value="{{ $etablissement->tel}}" /></div>
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
		<div class="col-sm-3 col-xs-12 center">
			<div class="space-12  hidden-xs"></div>
			<div class="form-group">
			  <label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Logo :</strong></label>
				<div class="col-sm-9">
					<span class="profile-picture col-sm-9">
						<img class="editable img-responsive" alt="Logo du l'etablissement" id="logo" src="{{ asset('/img/unknown.png') }}"/>
					</span>
				</div>	
			</div>
		</div>
	</div>
@endsection