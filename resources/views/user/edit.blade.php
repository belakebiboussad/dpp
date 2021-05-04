@extends('app')
@section('main-content')
<div class="row">
	<h3>Modification de : {{ $user->name }}</h3>
</div>
<div class="row">
	<div class="col-sm-8 col-xs-12">
	dsqds
	</div>
	<div class="col-sm-4 col-xs-12 well well-sm">
	<!-- style="text-align: center;" -->
		<div class="w-120 p-3 mb-2" style="height:45px;"><h4 class="center">Information d'Authentification</h4></div>
		<form class="form-horizontal" action="{{route('users.update',$user->id)}}" method="POST">
			{{ csrf_field() }}
  		{{ method_field('PUT') }}
  		<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="username">
	   			<strong>Nom Utilisateur	 :</strong>
	   		</label>
				<div class="col-sm-9 input-group">
				  <div class="input-group-addon">
				  	<span class="glyphicon glyphicon-user"></span> 
				  </div>
				 	<input type="text" id="username" name="username" placeholder="Username" value="{{ $user->name }}" class="col-xs-11 col-sm-11" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="email">
					<strong>Email :</strong>
				</label>
				<div class="col-sm-9 input-group">
			  	<div class="input-group-addon">
			  		<span class="glyphicon glyphicon-envelope"></span>
			  	</div>
			    <input name="email" type="email" value="{{ $user->email }}" class="col-xs-11 col-sm-11"/>
			     <!-- class="form-control" -->
			  </div>
			</div>
			<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="role"><strong>Rôle :&nbsp;</strong></label>
			<div class="col-sm-9 input-group">
				<div class="input-group-addon"><i class="menu-icon fa fa-tags"></i></div>
			  <select class="col-xs-10 col-sm-12" name="role">
					@foreach ($roles as $key=>$role)
					<option value="{{ $key }}"
					 @if( $key == $user->role_id) selected @endif >
						{{ $role->role }}</option>
					@endforeach
				</select>
			</div>
		</div>
			<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="active"><strong>Compte :&nbsp;</strong></label>
			<div class="col-sm-9 input-group">
				<input type="checkbox"  {{ ($user->active) ?'checked':'' }} Disabled>
				@if( $user->active)
				<span class="label label-info arrowed">&nbsp; Active</span>
				@else
				<span class="label label-danger arrowed">&nbsp; Desactivé</span>
				@endif
			</div>
		</div>
  	</form>
	</div>	
</div>
@endsection