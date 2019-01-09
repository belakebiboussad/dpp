@extends('app')
@section('main-content')
<div class="page-header">
	<h1>Détails de : {{ $user->name }}</h1>
</div>
<div class="tabbable">
	<ul class="nav nav-tabs padding-16">
		<li class="active">
			<a data-toggle="tab" href="#info-general">
				<i class="green ace-icon fa fa-book bigger-125"></i>
				Informations Géneral
			</a>
		</li>
		<li>
			<a data-toggle="tab" href="#info-compte">
				<i class="red ace-icon fa fa-users bigger-125"></i>
				Informations du compte
			</a>
		</li>
		<li>
			<a data-toggle="tab" href="#edit-info">
				<i class="purple ace-icon fa fa-cog bigger-125"></i>
				Modification
			</a>
		</li>
	</ul>
	<div class="tab-content profile-edit-tab-content">
		<div id="info-general" class="tab-pane in active">
			<h4 class="header blue bolder smaller">Informations administratives</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Nom</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Nom_Employe }}</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Prénom</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Prenom_Employe }}</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Date Naissance</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Date_Naiss_Employe }}</label>
						</div>
					</div>
				</div>
				<div class="vspace-12-sm"></div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Lieu Naissance</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Lieu_Naissance_Employe }}</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Sexe</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Sexe_Employe == "M" ? "Masculin" : "Féminin" }}</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Adresse</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Adresse_Employe }}</label>
						</div>
					</div>
				</div>
			</div>
			<h4 class="header blue bolder smaller">Contacts</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Tél mobile</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->tele_mobile }}</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Tél Fixe</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Tele_fixe }}</label>
						</div>
					</div>
				</div>
			</div>
			<h4 class="header blue bolder smaller">Informations du poste</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Matricule</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Matricule_dgsn }}</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Service</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Service_Employe }}</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Spécialité:</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->Specialite_Emploiye }}</label>
						</div>
					</div>
				</div>
			</div>
			<h4 class="header blue bolder smaller">Informations d'assurance</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>N° Sécurité Sociale</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $employe->NSS }}</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="info-compte" class="tab-pane">
			<div class="space-10"></div>	
			<h4 class="header blue bolder smaller">Informations du compte</h4>
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Nom d'utilisateur</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $user->name }}</label>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>E-Mail</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ $user->email }}</label>
						</div>
					</div>
				</div>
			{{-- 	<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="nom"><b>Role</b></label>
						<div class="col-sm-8">
							<label class="blue">{{ App\modeles\rol::where("id", $user->role_id)->get()->first()->role }}</label>
						</div>
					</div>
				</div> --}}
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
								<input class="col-xs-12 col-sm-10" type="text" id="nom" name="nom" value="{{ $employe->Nom_Employe }}" placeholder="Nom..."/>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
							<label class="col-sm-4 control-label no-padding-right" for="prenom"><b>Prénom</b></label>
							<div class="col-sm-8">
								<input class="col-xs-12 col-sm-10" type="text" id="prenom" name="prenom" value="{{ $employe->Prenom_Employe }}" placeholder="Prénom..."/>
							</div>
						</div>
					</div>
					<br/><br/><br/>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
							<label class="col-sm-4 control-label no-padding-right" for="datenaissance"><b>Date Naissance</b></label>
							<div class="col-sm-8">
								<input class="col-xs-12 col-sm-10 date-picker" type="text" id="datenaissance" name="datenaissance" value="{{ $employe->Date_Naiss_Employe }}" placeholder="Date Naissance..." data-date-format="yyyy-mm-dd"/>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
							<label class="col-sm-4 control-label no-padding-right" for="lieunaissance"><b>Lieu Naissance</b></label>
							<div class="col-sm-8">
								<input class="col-xs-12 col-sm-10" type="text" id="lieunaissance" name="lieunaissance" value="{{ $employe->Lieu_Naissance_Employe }}" placeholder="Lieu Naissance..."/>
							</div>
						</div>
					</div>
				</div>
				<div class="space-8"></div>
				<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
					<label class="col-sm-3 control-label no-padding-right"><b>Sexe</b></label>
					<div class="col-sm-9">
						<label class="inline">
							<input name="sexe" value="M" type="radio" class="ace" {{ $employe->Sexe_Employe == "M" ? "checked" : "" }}/>
							<span class="lbl middle"> Masculin</span>
						</label>
						&nbsp; &nbsp; &nbsp;
						<label class="inline">
							<input name="sexe" value="F" type="radio" class="ace" {{ $employe->Sexe_Employe == "F" ? "checked" : "" }}/>
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
							<textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse...">
								{{ $employe->Adresse_Employe }}
							</textarea>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('mobile') ? "has-error" : "" }}">
							<label for="mobile"><b>Tél mobile</b></label>
							<input type="text" class="form-control" id="mobile" name="mobile" value="{{ $employe->tele_mobile }}" placeholder="Tél mobile...">
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="{{ $errors->has('fixe') ? "has-error" : "" }}">
							<label for="fixe"><b>Tél Fixe</b></label>
							<input type="text" class="form-control" id="fixe" name="fixe" value="{{ $employe->Tele_fixe }}" placeholder="Tél Fixe...">
						</div>
					</div>
				</div>
				<h4 class="header blue bolder smaller">Information de poste</h4>
				<div class="row">
					<div class="vspace-12-sm"></div>
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('mat') ? "has-error" : "" }}">
							<label for="mat"><b>Matricule</b></label>
							<input type="text" class="form-control" id="mat" name="mat" value="{{ $employe->Matricule_dgsn }}" placeholder="Matricule...">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="{{ $errors->has('service') ? "has-error" : "" }}">
							<label for="service"><b>Service</b></label>
							<select class="form-control" id="service" name="service">
								<option value="{{ $employe->Service_Employe }}">{{ $employe->Service_Employe }}</option>
								<option value="Immunologie">Immunologie</option>
								<option value="Radiologie">Radiologie</option>
								<option value="Chirurgie">Chirurgie</option>
								<option value="Neurologie">Neurologie</option>
								<option value="Pneumologie">Pneumologie</option>
								<option value="Cardiologie">Cardiologie</option>
								<option value="Odontologie">Odontologie</option>
								<option value="Dermatologie">Dermatologie</option>
								<option value="Service d'accueil de traitement des urgences">
									Service d'accueil de traitement des urgences
								</option>
								<option value="traumatologie">traumatologie</option>
								<option value="Médecine interne">Médecine interne</option>
								<option value="Endocrinologie">Endocrinologie</option>
								<option value="Anatomo-pathologie">Anatomo-pathologie</option>
								<option value="Hématologie">Hématologie</option>
								<option value="Gastro-entérologie">Gastro-entérologie</option>
								<option value="Urologie">Urologie</option>
								<option value="Maternité">Maternité</option>
								<option value="Pédiatrie">Pédiatrie</option>
								<option value="Service des grands brûlés">Service des grands brûlés</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div>
							<label for="specialite"><b>Spécialité</b></label>
							<select class="form-control" id="specialite" name="specialite">
								<option value="{{ $employe->Specialite_Emploiye }}">{{ $employe->Specialite_Emploiye }}</option>
								<option value="Allergologie">Allergologie</option>
								<option value="Anesthésiologie">Anesthésiologie</option>
								<option value="Andrologie">Andrologie</option>
								<option value="Cardiologie">Cardiologie</option>
								<option value="Chirurgie">Chirurgie</option>
								<option value="Dermatologie">Dermatologie</option>
								<option value="Endocrinologie">Endocrinologie</option>
								<option value="Gastro-entérologie">Gastro-entérologie</option>
								<option value="Gériatrie">Gériatrie</option>
								<option value="Gynécologie">Gynécologie</option>
								<option value="Hématologie">Hématologie</option>
								<option value="Hépatologie">Hépatologie</option>
								<option value="Infectiologie">Infectiologie</option>
								<option value="Médecine aiguë">Médecine aiguë</option>
								<option value="Médecine du travail">Médecine du travail</option>
								<option value="Médecine générale">Médecine générale</option>
								<option value="Médecine interne">Médecine interne</option>
								<option value="Médecine nucléaire">Médecine nucléaire</option>
								<option value="Médecine palliative">Médecine palliative</option>
								<option value="Médecine physique">Médecine physique</option>
								<option value="Médecine préventive">Médecine préventive</option>
								<option value="Néonatologie">Néonatologie</option>
								<option value="Néphrologie">Néphrologie</option>
								<option value="Neurologie">Neurologie</option>
								<option value="Odontologie">Odontologie</option>
								<option value="Oncologie">Oncologie</option>
								<option value="Obstétrique">Obstétrique</option>
								<option value="Ophtalmologie">Ophtalmologie</option>
								<option value="Orthopédie">Orthopédie</option>
								<option value="Oto-rhino-laryngologie">Oto-rhino-laryngologie</option>
								<option value="Pédiatrie">Pédiatrie</option>
								<option value="Pneumologie">Pneumologie</option>
								<option value="Psychiatrie">Psychiatrie</option>
								<option value="Radiologie">Radiologie</option>
								<option value="Radiothérapie">Radiothérapie</option>
								<option value="Rhumatologie">Rhumatologie</option>
								<option value="Urologie">Urologie</option>
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
							<input type="text" class="form-control" id="nss" name="nss" value="{{ $employe->NSS }}" placeholder="N° Sécurité Sociale...">
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
					<button type="submit" class="btn btn-sm btn-success">
						Valider
						<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
					</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection