@extends('app')
@section('main-content')
<div class="page-header"><h1>Modifier le rôle :</h1></div>
<div class="row">
	<div class="col-sm-12">
		<div class="space-10"></div>
			<form role="form" method="POST" action="{{ route('role.update',$role->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group row">
					<label class="col-sm-3 control-label" for="form-field-1">Nom</label>
					<div class="col-sm-9">
						<input type="text" id="rolename" name="rolename" placeholder="Nom du role" class="col-xs-10 col-sm-5"  value="{{ $role->nom }}" required/>
					</div>
				</div>
         <div class="form-group row">
          <label class="col-sm-3 control-label" for="rolename">Type {{$role->type}}</label>
          <div class="col-sm-9">
            <select type="text"  name="type"  class="col-xs-10 col-sm-5" required>
              <option value="0" @if($role->type == 'Médical') selected @endif>Médicale</option>
              <option value="" @if($role->type == 'Paramédicale') selected @endif>Paramédicale</option>
              <option value="1"  @if($role->type == 'Administratif') selected @endif>Administratif</option>
             </select>
          </div>
        </div>
        <div class="hr hr-dotted"></div>
				<div class="center row">
      		<button class="btn btn-sm btn-primary" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer 
      		</button>
      		<button class="btn btn-sm btn-warning" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler
      		</button>
    	</div>
			</form>
	</div>
</div>
@stop