@extends('app')
@section('main-content')
<div class="page-header"><h1>Détails de : {{ $user->name }}</h1>
<div class="pull-right">
	<a href="{{ route('users.edit',$user->id )}}" class="btn btn-info btn-sm" data-toggle="tooltip" title="modifier">
		<i class="fa fa-edit fa-xs" aria-hidden="true" ></i>Edit
	</a>
	<a href="{{ route('users.destroy',$user->id )}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-sm btn-danger">
		<i class="fa fa-trash-o fa-xs"></i>Supprimer
	</a>
</div>
</div>
<div class="tabbable">
	<ul class="nav nav-tabs padding-16">
		<li class="active">
			<a data-toggle="tab" href="#info-general"><i class="green ace-icon fa fa-book bigger-125"></i>Informations Géneral</a>
		</li>
		<li>
			<a data-toggle="tab" href="#info-compte"><i class="red ace-icon fa fa-users bigger-125"></i>Informations du compte</a>
		</li>
		<li>
			<a data-toggle="tab" href="#edit-info">	<i class="purple ace-icon fa fa-cog bigger-125"></i>Modification</a>
		</li>
	</ul>
	<div class="tab-content profile-edit-tab-content">
		<div id="info-general" class="tab-pane in active">
			<h4 class="header blue bolder smaller">Informations administratives</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Nom</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->nom }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Prénom</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->prenom }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Date Naissance</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Date_Naiss }}</label> </div>
					</div>
				</div>
				<div class="vspace-12-sm"></div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Lieu Naissance</b></label>
						<div class="col-sm-8">	<label class="blue">{{ $user->employ->Lieu_Naissance }}</label>	</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Genre</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->sexe == "M" ? "Masculin" : "Féminin" }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Adresse</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Adresse }}</label></div>
					</div>
				</div>
			</div>
			<h4 class="header blue bolder smaller">Contacts</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Tél mobile</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->tele_mobile }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Tél Fixe</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Tele_fixe }}</label>	</div>
				  </div>
				</div>
			</div>
			<h4 class="header blue bolder smaller">Informations du poste</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Matricule</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Matricule_dgsn }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Service</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Service->nom }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><strong>Spécialité:</strong></label>
						<div class="col-sm-8"><label class="blue">{{ $user->employ->Specialite->nom }}</label></div>
					</div>
				</div>
			</div>
			<h4 class="header blue bolder smaller">Informations d'assurance</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>N° Sécurité Sociale</b></label>
						<div class="col-sm-8">	<label class="blue">{{$user->employ->NSS }}</label>	</div>
					</div>
				</div>
			</div>
		</div>
		<div id="info-compte" class="tab-pane">
			<div class="space-12"></div>	
			<h4 class="header blue bolder smaller">Informations du compte</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Nom d'utilisateur</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->name }}</label></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>E-Mail</b></label>
						<div class="col-sm-8"><label class="blue">{{ $user->email }}</label>	</div>
					</div>
				</div>
			</div>
		</div>								
		<div id="edit-info" class="tab-pane">
			<div class="space-10"></div>	
			<form class="form-horizontal" action="{{route('users.update', $user->id)}}" method="POST">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<h4 class="header blue bolder smaller">Informations adminstratives</h4>
				<div class="row">
					<div class="vspace-12-sm"></div>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
							<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Nom</b></label>
							<div class="col-sm-8">
								<input class="col-xs-12 col-sm-10" type="text" id="nom" name="nom" value="{{ $user->employ->nom }}" placeholder="Nom..."/>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
							<label class="col-sm-4 control-label no-padding-right" for="prenom"><b>Prénom</b></label>
							<div class="col-sm-8">
								<input class="col-xs-12 col-sm-10" type="text" id="prenom" name="prenom" value="{{ $user->employ->prenom }}" placeholder="Prénom..."/>
							</div>
						</div>
					</div>
					<br/><br/><br/>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
							<label class="col-sm-4 control-label no-padding-right" for="datenaissance"><b>Date Naissance</b></label>
							<div class="col-sm-8">
								<input class="col-xs-12 col-sm-10 date-picker" type="text" id="datenaissance" name="datenaissance" value="{{ $user->employ->Date_Naiss }}" placeholder="Date Naissance..." data-date-format="yyyy-mm-dd"/>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
							<label class="col-sm-4 control-label no-padding-right" for="lieunaissance"><b>Lieu Naissance</b></label>
							<div class="col-sm-8">
								<input class="col-xs-12 col-sm-10" type="text" id="lieunaissance" name="lieunaissance" value="{{ $user->employ->Lieu_Naissance }}" placeholder="Lieu Naissance..."/>
							</div>
						</div>
					</div>
				</div>
				<div class="space-8"></div>
				<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
					<label class="col-sm-3 control-label no-padding-right"><b>Sexe</b></label>
					<div class="col-sm-9">
						<label class="inline">
							<input name="sexe" value="M" type="radio" class="ace" {{ $user->employ->sexe == "M" ? "checked" : "" }}/>
							<span class="lbl middle"> Masculin</span>
						</label>
						&nbsp; &nbsp; &nbsp;
						<label class="inline">
							<input name="sexe" value="F" type="radio" class="ace" {{ $user->employ->sexe == "F" ? "checked" : "" }}/>
							<span class="lbl middle"> Féminin</span>
						</label>
					</div>
				</div>
				<hr>
				<h4 class="header blue bolder smaller">Contacts</h4>
				<div class="row">
					<div class="vspace-12-sm"></div>
					<div class="col-xs-12 col-sm-6">
						<div class="{{ $errors->has('adresse') ? "has-error" : "" }}">
							<label for="adresse"><b>Adresse</b></label>
							<textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse...">{{ $user->employ->Adresse }}</textarea>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('mobile') ? "has-error" : "" }}">
							<label for="mobile"><b>Tél mobile</b></label>
							<input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->employ->tele_mobile }}" placeholder="Tél mobile...">
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('fixe') ? "has-error" : "" }}">
							<label for="fixe"><b>Tél Fixe</b></label>
							<input type="text" class="form-control" id="fixe" name="fixe" value="{{ $user->employ->Tele_fixe }}" placeholder="Tél Fixe...">
						</div>
					</div>
				</div>
				<h4 class="header blue bolder smaller">Information de poste</h4>
				<div class="row">
					<div class="vspace-12-sm"></div>
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('mat') ? "has-error" : "" }}">
							<label for="mat"><b>Matricule</b></label>
							<input type="text" class="form-control" id="mat" name="mat" value="{{ $user->employ->Matricule_dgsn }}" placeholder="Matricule...">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('service') ? "has-error" : "" }}">
							<label for="service"><b>Service</b></label>
							<select class="form-control" id="service" name="service">
								<option value="{{ $user->employ->service }}">{{ $user->employ->Service->nom }}</option>
								@foreach ($services as $key=>$service)
									<option value="{{ $service->id }}"> {{ $service->nom }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div>
							<label for="specialite"><b>Spécialité</b></label>
							<select class="form-control" id="specialite" name="specialite">
								<option value="{{ $user->employ->specialite}}">{{ $user->employ->Specialite->nom }}</option>
								@foreach ($specialites as $specialite)
									<option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
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
							<label for="nss"><b>N° Sécurité Sociale</b></label>
							<input type="text" class="form-control" id="nss" name="nss" value="{{ $user->employ->NSS }}" placeholder="N° Sécurité Sociale...">
						</div>
					</div>
				</div>
				<h4 class="header blue bolder smaller">Informations de compte</h4>
				<div class="row">
					<div class="space-12"></div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('username') ? "has-error" : "" }}">
							<label for="username"><b>Nom d'utilisateur</b></label>
							<input type="text" class="form-control" id="username" name="username" value="{{ $user->name }}" placeholder="Nom d'utilisateur...">
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('mail') ? "has-error" : "" }}">
							<label for="mail"><b>E-Mail</b></label>
							<input type="email" class="form-control" id="mail" name="mail" value="{{ $user->email }}" placeholder="E-Mail...">
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('role') ? "has-error" : "" }}">
							<label for="role"><b>Role</b></label>
							<select id="role" name="role" class="form-control">
								<option value="{{ $user->role_id }}">{{ App\modeles\rol::where("id", $user->role_id)->get()->first()->role }}</option>
								@foreach($roles as $role)
									<option value="{{ $role->id }}">{{ $role->role }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="form-actions center">
					<button type="submit" class="btn btn-sm btn-success">	Valider	<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i></button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection