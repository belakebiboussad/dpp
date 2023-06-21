@extends('app')
@section('main-content')
	<div class="row"><h3>Ajouter Etablissement:</h3></div><div class="space-12 hidden-xs"></div>
		<form id ="addEtab" role="form" method="POST" action="{{ route('etablissement.store') }}" enctype="multipart/form-data">
		<div class="row">
			{{ csrf_field() }}
		<div class="col-sm-9 col-xs-12">
			<div class="widget-box widget-primary h-100  p-3">
				<div class="widget-header" bg="blue"><h5 class="widget-title">Etablissement hospitalier</h5></div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="form-group row">
							<label class="col-sm-3 control-label text-right">Nom</label>
							<div class="col-sm-9"><input type="text" name="nom" class="form-control" /></div>
						</div>
            <div class="form-group row">
              <label class="col-sm-3 control-label text-right" for="nom">Acronyme</label>
              <div class="col-sm-9"> <input type="text" name="acronyme" class="form-control" /></div>
            </div>
						<div class="form-group row">
							<label class="col-sm-3 control-label text-right" for="adresse">Adresse</label>
							<div class="col-sm-9"><input type="text" name="adresse" class="form-control"  /></div>
						</div>
						<div class="form-group row">
              <label class="control-label col-xs-12 col-sm-3 text-right">Téléphone</label>
              <div class="col-xs-12 col-sm-9">
                <div class="input-group">
                  <span class="input-group-addon fa fa-phone"></span>
                  <input type="tel" name="tel" class="form-control telfixe">
                </div>
              </div>
            </div>
					  <div class="form-group row">
              <label class="control-label col-xs-12 col-sm-3 text-right" >Téléphone2</label>
              <div class="col-xs-12 col-sm-9">
                <div class="input-group">
                  <span class="input-group-addon fa fa-phone"></span>
                  <input type="tel" name="tel2" class="form-control telfixe">
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-xs-12 col-sm-3 text-right" for="tel2">Email</label>
              <fieldset>
                <label class="block clearfix">
                  <span class="block input-icon input-icon-right">
                    <input type="email" class="form-control" placeholder="Email" name="contact" value="{{ old('email') }}"/>
                    <i class="ace-icon fa fa-envelope"></i>
                  </span>
                </label>
              </fieldset>
            </div>
            <div class="form-group row">
              <span class="col-xs-12 col-sm-7 col-sm-offset-3">
                <label class="middle">
                  <input class="ace" type="checkbox" id="id-publicEtab">
                  <span class="lbl">Etablissement public</span>
                </label>
              </span>
            </div>
            <div class="form-group etabPub hidden row">
            <label class="col-sm-3 control-label text-right" for="nom">Type</label>
              <div class="col-sm-9">
              <select name="type_id" id="type_id" class="form-control">
                <option value="" disabled selected>Selectionner...</option>
                @foreach($types  as  $type)
                <option value="{{ $type->id }}">{{ $type->nom }}-{{ $type->acr }}</option>
                @endforeach
              </select>
              </div>
            </div>
						<div class="form-group etabPub hidden row">
							<label class="col-sm-3 control-label text-right" for="tutelle">Tutelle</label>
							<div class="col-sm-9"><input type="text" name="tutelle" class="form-control"/></div>
						</div><div class="space-12  hidden-xs"></div>
         
              <div class="form-group row">
                <label class="col-sm-3 col-control-label text-right" for="logo">Logo</label>
                <div class="col-sm-9"><input type="file" class="form-control form-control-file" id="logo" name="logo" alt="Logo du l'etablissement" /> 
               </div>
            </div>
            <br>
            
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-xs-12 center"></div>
		</div>	
		<div class="form-group col text-center">
			<button class="btn btn-xs btn-primary" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
      <button class="btn btn-xs btn-warning" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
		</div>
	</form>
@stop