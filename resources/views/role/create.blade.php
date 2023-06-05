@extends('app')
@section('title','Ajouter un Rôle')
@section('main-content')
<div class="page-header"><h1>Ajouter un nouveau rôle</h1></div>
<div class="row">
	<div class="col-sm-12">
			<form role="form" method="POST" action="{{ route('role.store') }}">
				{{ csrf_field() }}
				<div class="form-group row">
					<label class="col-sm-3 control-label no-padding-right" for="rolename">Nom</label>
					<div class="col-sm-9">
						<input type="text" name="nom" placeholder="Nom du rôle" class="col-xs-10 col-sm-5" required/>
					</div>
				</div>
        <div class="form-group row">
          <label class="col-sm-3 control-label no-padding-right" for="rolename">Type</label>
          <div class="col-sm-9">
            <select  name="type"  class="col-xs-10 col-sm-5" required>
              <option value="" disabled selected>---Selectionner---</option>
              <option value="0">Médicale</option>
              <option value="">Paramédicale</option>
              <option value="1">Administratif</option>
             </select>
          </div>
        </div>
				<div class="center row">
          <button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save "></i>Enregistrer</button> 
	        <button class="btn btn-xs btn-warning" type="reset"> <i class="ace-icon fa fa-undo"></i>Annuler </button>
        </div>
			</form>
	</div>
</div>
@stop