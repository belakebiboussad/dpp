@extends('app')
@section('main-content')
<div class="row">
	<h3>Modification de : {{ $user->name }}</h3>
</div>
<div class="row">
	<div class="col-sm-8 col-xs-12">
		<div id="edit-info">
			<form class="form-horizontal" role="form" action="{{route('employs.update', $user->employ->id)}}" method="POST">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<input type="hidden" name="id" value="{{ $user->employ->id }}">
				<h4 class="header blue bolder smaller">Informations adminstratives</h4>
				<div class="row">
					<div class="col-xs-6 col-sm-6">
						<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
							<label class="col-sm-5 control-label no-padding-right" for="nom"><b>Nom:</b></label>
							<div class="col-sm-7">
								<input class="col-xs-12 col-sm-12" type="text" id="nom" name="nom" value="{{ $user->employ->nom }}" placeholder="Nom..."/>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6">
					<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}" >
						<label class="col-sm-5 control-label no-padding-right" for="prenom"><b>Prénom:</b></label>
						<div class="col-sm-7">
							<input class="col-xs-12 col-sm-12" type="text" id="prenom" name="prenom" value="{{ $user->employ->prenom }}" placeholder="Prénom..."/>
						</div>
					</div>
				</div>
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-6 col-sm-6">
						<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
							<label class="col-sm-5 control-label no-padding-right" for="datenaissance"><b class="text-nowrap">Date Naissance:</b></label>
							<div class="col-sm-7">
								<input class="col-xs-12 col-sm-12 date-picker" type="text" id="datenaissance" name="datenaissance" value="{{ $user->employ->Date_Naiss }}" placeholder="Date Naissance..." data-date-format="yyyy-mm-dd"/>
							</div>	
						</div>
					</div>
					<div class="col-xs-6 col-sm-6">
						<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
							<label class="col-sm-5 control-label no-padding-right" for="lieunaissance"><b>Lieu Naissance:</b></label>
							<div class="col-sm-7">
									<input class="col-xs-12 col-sm-12" type="text" id="lieunaissance" name="lieunaissance" value="{{ $user->employ->Lieu_Naissance }}" placeholder="Lieu Naissance..."/>
							</div>	
						</div>
					</div>
				</div><!-- row -->
				.space-
				<div class="row">
					<div class="col-xs-6 col-sm-6">
						<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
							<div class="col-sm-3 ml-auto align-top">
								<label class="inline control-label pull-right" style="padding-top: 0px;"><b>Genre:</b></label>
							</div>		  
							<div class="col-sm-9">
								<label class="inline">
								<input name="sexe" value="M" type="radio" class="ace" {{ $user->employ->sexe == "M" ? "checked" : "" }}/>
								<span class="lbl middle"> Masculin</span>
								</label>&nbsp; &nbsp; &nbsp;
								<label class="inline">
								<input name="sexe" value="F" type="radio" class="ace" {{ $user->employ->sexe == "F" ? "checked" : "" }}/>
								<span class="lbl middle"> Féminin</span>
								</label>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6">
					</div>
				</div>
			</form>
			<div class="space-12"></div>
		</div>
	</div><!-- col-sm-8 -->
	<div class="col-sm-4 col-xs-12 well well-sm">	<!-- style="text-align: center;" -->
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
			  <select class="col-xs-11 col-sm-11" name="role">
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
		<div class="form-group">
			<div class="col-sm-12 input-group">
			@if( $user->active)
			<label class ="pull-right">
				<strong>Désactiver le Compte :&nbsp;</strong>
				<input type="checkbox" name="desactiveCompt" class="collapse" checked data-toggle="toggle" data-on="Non" data-off="Oui" data-size="mini" data-onstyle="primary" data-offstyle="danger" data-style="slow" value="0"> 
			</label>
			@else
				<label class ="pull-right">
				<b>Activer le Compte:</b>&nbsp;
				<input type="checkbox" name="activeCompt" class="collapse" checked data-toggle="toggle" data-on="<i class='fa fa-play'></i> Oui" data-off="<i class='fa fa-pause'></i> Non" data-size="mini" data-onstyle="primary" data-offstyle="danger" data-style="slow" value="1">
				</label>
			@endif
			</div>
		</div>
		<div class="form-actions center">
			<button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp;
			<button class="btn" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
		</div>

  </form>
	</div>	
</div>
@endsection