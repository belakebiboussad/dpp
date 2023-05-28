@extends('app')
@section('main-content')
<div class="page-header"><h1>Détails du rôle &quot;{{ $role->nom }}&quot;</h1></div>
	<div class="form-group"><label class="col-sm-3 control-label">Nom</label>
		<div class="col-sm-9"><p class = "form-control-static">{{ $role->nom }}</p></div>
	</div>
  <div class="form-group"><label class="col-sm-3 control-label">Type</label>
    <div class="col-sm-9"><p class = "form-control-static">{{ $role->type }}</p></div>
  </div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Nombre d'utilisateurs</label>
    <div class="col-sm-9"><p class = "form-control-static">{{ $role->users->count()}}</p></div>
	</div>
@stop