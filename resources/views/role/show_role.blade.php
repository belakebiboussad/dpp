@extends('app')
@section('main-content')
<div class="page-header">
	<h1><strong>Détails du rôle : {{ $role->role }}</strong></h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="space-10"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
				<strong> Nom du rôle </strong>
			</label>
			<div class="col-sm-9">
				<label class="blue">{{ $role->role }}</label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
				<strong> Nombre d'utilisateurs </strong>
			</label>
			<div class="col-sm-9">
				<label class="blue">{{ App\User::where("role_id",$role->id)->get()->Count() }}</label>
			</div>
		</div>
	</div>
</div>
@endsection