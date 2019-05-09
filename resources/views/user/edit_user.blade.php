@extends('app')
@section('main-content')
<div class="page-header">
	<h1>Modification de : {{ $user->name }}</h1>
</div>
<div class="col-md-8">
	<div id="edit-info" class="">
	<form class="form-horizontal" action="{{route('employs.update', $employe->id)}}" method="POST">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $employe->id }}">
		{{ method_field('PUT') }}
		<h4 class="header blue bolder smaller">Informations adminstratives</h4>
		<div class="space-12"></div>
		
		<div class="col-xs-6 col-sm-6">
			<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
				<label class="col-sm-5 control-label no-padding-right" for="nom"><b>Nom:</b></label>
				<div class="col-sm-7">
				<input class="col-xs-12 col-sm-10" type="text" id="nom" name="nom" value="{{ $employe->Nom_Employe }}" placeholder="Nom..."/>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-sm-6">
			<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}" >
				<label class="col-sm-5 control-label no-padding-right" for="prenom"><b>Prénom:</b></label>
				<div class="col-sm-7">
					<input class="col-xs-12 col-sm-10" type="text" id="prenom" name="prenom" value="{{ $employe->Prenom_Employe }}" placeholder="Prénom..."/>
				</div>
			</div>
		</div>
		{{-- row --}}
		<br/><br/><br/>
		<div class="col-xs-6 col-sm-6">
			<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
				<label class="col-sm-5 control-label no-padding-right" for="datenaissance"><b class="text-nowrap">Date Naissance:</b></label>
				<div class="col-sm-7">
					<input class="col-xs-12 col-sm-10 date-picker" type="text" id="datenaissance" name="datenaissance" value="{{ $employe->Date_Naiss_Employe }}" placeholder="Date Naissance..." data-date-format="yyyy-mm-dd"/>
				</div>	
			</div>
		</div>
		<div class="col-xs-6 col-sm-6">
			<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
				<label class="col-sm-5 control-label no-padding-right" for="lieunaissance"><b>Lieu Naissance:</b></label>
					<div class="col-sm-7">
						<input class="col-xs-12 col-sm-10" type="text" id="lieunaissance" name="lieunaissance" value="{{ $employe->Lieu_Naissance_Employe }}" placeholder="Lieu Naissance..."/>
				</div>
			
			</div>
		</div>
		<div class="col-xs-12 col-sm-12">
			<div class="row">
			<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
			<br>
				<div class="col-sm-3 ml-auto align-top">
				<label class="inline control-label pull-right" style="padding-top: 0px;"><b>Sexe:</b></label>
				</div>		  
				<div class="col-sm-9">
					<label class="inline">
					<input name="sexe" value="M" type="radio" class="ace" {{ $employe->Sexe_Employe == "M" ? "checked" : "" }}/>
					<span class="lbl middle"> Masculin</span>
					</label>&nbsp; &nbsp; &nbsp;
					<label class="inline">
					<input name="sexe" value="F" type="radio" class="ace" {{ $employe->Sexe_Employe == "F" ? "checked" : "" }}/>
					<span class="lbl middle"> Féminin</span>
					</label>
				</div>
			</div>
			</div>
		</div>
		<hr>
		<h4 class="header blue bolder smaller">Contacts:</h4>
				<div class="row">
					<div class="vspace-12-sm"></div>
					<div class="col-xs-12 col-sm-6">
						<div class="{{ $errors->has('adresse') ? "has-error" : "" }}">
							<i class="fa fa-map-marker light-orange bigger-110"></i>
							<label for="adresse"><b>Adresse:</b></label>
							<textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse...">{{ $employe->Adresse_Employe }}</textarea>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('mobile') ? "has-error" : "" }}">
						<i class="fa fa-phone"></i>
						<label for="mobile"><b>Tél mobile:</b></label>
						<input type="tel" class="form-control" id="mobile" name="mobile" value="{{ $employe->tele_mobile }}" placeholder="Tél mobile..." pattern="[0-9]{10}">
					</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('fixe') ? "has-error" : "" }}">
							<i class="fa fa-phone"></i>
							<label for="fixe"><b>Tél Fixe:</b></label>
							<input type="tel" class="form-control" id="fixe" name="fixe" value="{{ $employe->Tele_fixe }}" placeholder="Tél Fixe..."
							pattern="[0-9]{9}">
						</div>
					</div>
				</div>
				<h4 class="header blue bolder smaller">Information de poste</h4>
				<div class="row">
					<div class="vspace-12-sm"></div>
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('mat') ? "has-error" : "" }}">
							<label for="mat"><b>Matricule:</b></label>
							<input type="text" class="form-control" id="mat" name="mat" value="{{ $employe->Matricule_dgsn }}" placeholder="Matricule...">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('service') ? "has-error" : "" }}">
							<label for="service"><b>Service:</b></label>
							<select class="form-control" id="service" name="service">
								@foreach($services as $key=>$value)
								<option value="{{ $key }}" {{ ($employe->Service_Employe == $key)? 'Selected' :'' }}>{{ $value->nom }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div>
							<label for="specialite"><b>Spécialité:</b></label>
							<select class="form-control" id="specialite" name="specialite">
								@foreach($specialites as $key=>$value)
								<option value="{{ $key }}" {{ ($employe->Specialite_Emploiye == $key) ? 'Selected':'' }}>{{ $value->nom}}</option>	
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<h4 class="header blue bolder smaller">Informations d'assurance</h4>
				<div class="row">
					<div class="vspace-12-sm"></div>
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('nss') ? "has-error" : "" }}">
							<label for="nss"><b>N° Sécurité Sociale:</b></label>
							<input type="text" class="form-control" id="nss" name="nss" value="{{ $employe->NSS }}" placeholder="N° Sécurité Sociale...">
						</div>
					</div>
				</div>
				<div class="form-actions center">
					<button type="submit" class="btn btn-sm btn-success">
					<i class="ace-icon fa fa-save icon-on-left bigger-110"></i>
						Enregistrer
					</button>
				</div>
			</form>
			</div>
		</div>
	</div>
	<div class="space-12"></div>
	<div class="col-md-4 well well-lg">
		<div class="w-120 p-3 mb-2 bg-danger text-white" style="height:45px;">
		<h3 style="width:105%; text-align: center;">Information d'Authentification</h3>
		</div>	
		<hr>
		<form class="form-horizontal" action="{{route('users.update',$user->id)}}" method="POST">
		{{ csrf_field() }}
  		{{ method_field('PUT') }}
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="username"><b>User :&nbsp;</b></label>
			<div class="col-sm-9 input-group">
			  	<div class="input-group-addon">
			      		<span class="glyphicon glyphicon-user"></span> 
			    	</div>
			 	<input type="text" id="username" name="username" placeholder="Username" value="{{ $user->name }}" class="col-xs-12 col-sm-12" />
			  </div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="email"><b>Email:&nbsp;</b></label>
			<div class="col-sm-9 input-group">
			  	<div class="input-group-addon">
			      		{{-- <i class="fa fa-envelope"></i> --}}
			      		<span class="glyphicon glyphicon-envelope"></span> 
			    	</div>
			    	<input class="form-control" id="email" name="email" type="email" value="{{ $user->email }}" class="col-xs-12 col-sm-12"/>
			  </div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="role"><strong>Rôle :&nbsp;</strong></label>
			<div class="col-sm-9 input-group">
				<div class="input-group-addon">
			      		<i class="menu-icon fa fa-tags"></i>
			    	</div>
				<select id="role" class="col-xs-10 col-sm-12" name="role">
					@foreach ($roles as $key=>$role)
					<option value="{{ $key }}"
					 @if( $key == $user->role_id) selected @endif >
						{{ $role->role }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="space-12"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="active"><strong>Compte :&nbsp;</strong></label>
			<div class="col-sm-9 input-group">
				<input type="checkbox"  {{ ($user->active == '1') ?'checked':'' }} Disabled>
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
			<b>Désactiver le Compte:</b>&nbsp;
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
		<div class=form-actions center">
			<button class="btn btn-info" type="submit">
				<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
			</button>&nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="ace-icon fa fa-undo bigger-110"></i>Annuler
			</button>
		</div>			
	</form>				
	</div>	{{-- col-md-4 well well-lg --}}
@endsection