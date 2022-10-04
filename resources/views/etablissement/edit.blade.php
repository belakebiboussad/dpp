@extends('app')
@section('main-content')
	<div class="page-header"><h3>Modifier l'établissement</h3></div><div class="space-12 hidden-xs"></div>
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
							<label class="col-sm-3 control-label" for="nom">Nom :</label>
							<div class="col-sm-9">
								<input type="text" name="nom"  class="form-control"  value = "{{ $etab->nom }} " />
							</div>
						</div><div class="space-12  hidden-xs"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="nom">Acronyme :</label>
              <div class="col-sm-9">
                <input type="text" name="acronyme"  class="form-control"  value = "{{ $etab->acronyme }} " />
              </div>
            </div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="nom">Adresse:</label>
							<div class="col-sm-9"><input type="text" name="adresse" class="form-control" value="{{ $etab->adresse }}" /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="nom">Téléphone:</label>
							<div class="col-sm-9"><input type="tel" name="tel" class="form-control telfixe" value="{{ $etab->tel }}" /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="nom">Téléphone 2:</label>
							<div class="col-sm-9"><input type="tel" name="tel2" class="form-control telfixe" value="{{ $etab->tel2 }}" /></div>
						</div><div class="space-12  hidden-xs"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="nom">Tutelle:</label>
							<div class="col-sm-9"><input type="text" name="tutelle" class="form-control" value="{{ $etab->tutelle }}"  /></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-xs-12 center">
			<div class="form-group">
				<img src="{{ url('/img/'.$etab->logo) }}" alt ="" height="30%" width="30%" id ="logoimg"/>
			</div>
			<div class="form-group">
				<input type="file" class="form-control" id="logo" name="logo" alt="Logo du l'etablissement" value= "{{ url('/img/'.$etab->logo) }}" /> 
			</div>
		</div>
		</div><div class="space-12  hidden-xs"></div>	
			<div class="form-group col text-center">
				<button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp;
				<button class="btn btn-xs btn-warning" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
			</div>
	</form>
@endsection