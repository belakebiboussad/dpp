@extends('app')
@section('main-content')
	<div class="row"><h3><strong>Actualiser les données de l'établissement:</strong></h3></div><div class="space-12 hidden-xs"></div>
		<form id ="editEtab" class="form-horizontal" role="form" method="POST" action="{{ route('etablissement.update', $etab->id) }}" enctype="multipart/form-data">
		<div class="row">
			<input type="hidden" name="id" value="{{ $etab->id }}">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
		<div class="col-sm-9 col-xs-12">
			<div class="widget-box widget-primary" >
				<div class="widget-header" bg="blue"><h5 class="widget-title"><strong>Etablissement hospitalier</strong></h5></div>
				<div class="widget-body">
					<div class="widget-main"><div class="space-12 hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom">Nom :</label>
							<div class="col-sm-9">
								<input type="text" name="nom"  class="col-xs-12 col-sm-12"  value = "{{ $etab->nom }} " />
							</div>
						</div><div class="space-12  hidden-xs"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="nom">Acronyme :</label>
              <div class="col-sm-9">
                <input type="text" name="acronyme"  class="col-xs-12 col-sm-12"  value = "{{ $etab->acronyme }} " />
              </div>
            </div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom">Adresse:</label>
							<div class="col-sm-9"><input type="text" name="adresse" class="col-xs-12 col-sm-12" value="{{ $etab->adresse }}" /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom">Téléphone:</label>
							<div class="col-sm-9"><input type="tel" name="tel" class="col-xs-12 col-sm-12 telfixe" value="{{ $etab->tel }}" /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom">Téléphone 2:</label>
							<div class="col-sm-9"><input type="tel" name="tel2" class="col-xs-12 col-sm-12 telfixe" value="{{ $etab->tel2 }}" /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nom">Tutelle:</label>
							<div class="col-sm-9"><input type="text" name="tutelle" class="col-xs-12 col-sm-12 " value="{{ $etab->tutelle }}"  /></div>
						</div>v
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-xs-12 center">
			<div class="space-12  hidden-xs"></div>
			<div class="form-group">
				<img src="{{ url('/img/'.$etab->logo) }}" alt ="" height="30%" width="30%" id ="logoimg"/>
			</div>
			<div class="form-group">
				<input type="file" class="form-control" id="logo" name="logo" alt="Logo du l'etablissement" value= "{{ url('/img/'.$etab->logo) }}" /> 
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