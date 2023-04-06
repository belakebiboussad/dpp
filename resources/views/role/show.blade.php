@extends('app')
@section('main-content')
<div class="page-header"><h1>Détails du rôle : {{ $role->role }}</h1></div>
<div class="row">
	<div class="col-sm-12">
		<div class="space-10"></div>
		<div class="form-group"><label class="col-sm-3 control-label">Nom du rôle :</label>
			<div class="col-sm-9"><label>{{ $role->role }}</label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Nombre d'utilisateurs :</label>
			<div class="col-sm-9">
				<label>{{ App\User::where("role_id",$role->id)->get()->Count() }}</label>
			</div>
		</div>
	</div>
</div>
@stop