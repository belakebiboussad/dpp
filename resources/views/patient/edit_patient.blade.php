@extends('app_recep')
@section('main-content')
	<div class="page-header">
		<h1 style="display: inline;"><strong>modification Du Patient :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
		<div class="pull-right">
			<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>
				Retour a La Liste Des Patients
			</a>
		</div>
	</div>
	<form class="form-horizontal" action="{{ route('patient.update',$patient ->id) }}" method="POST">
		{{ csrf_field() }}
  		{{ method_field('PUT') }}
		<div class="col-sm-12">
			<h3 class="header smaller lighter blue">
				Informations administratives
			</h3>
		</div>
		<div class="row">
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label no-padding-right" for="nom">
					<b>Nom :</b> 
				</label>
				<div class="col-sm-9">
					<input type="text" id="nom" name="nom" value="{{ $patient->Nom }}" placeholder="Nom..." class="col-xs-12 col-sm-6"/>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label no-padding-right" for="prenom">
					<b>Prénom :</b>
				</label>
				<div class="col-sm-9">
					<input type="text" id="penom" name="prenom" value="{{ $patient->Prenom }}" placeholder="Prénom..." class="col-xs-12 col-sm-6"/>
				</div>
			</div>
		</div>
		</div>
		<div class="row">
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label no-padding-right" for="datenaissance">
					<b class="text-nowrap">Né(e) le :</b>
				</label>
				<div class="col-sm-9">
				<input class="col-xs-12 col-sm-6 date-picker" id="datenaissance" name="datenaissance" value="{{ $patient->Dat_Naissance }}" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label no-padding-right" for="lieunaissance">
					<span class="text-nowrap"><b>Lieu de naissance :</b></span>
				</label>
				<div class="col-sm-9">
					<input type="text" id="lieunaissance" name="lieunaissance" value="{{ $patient->Lieu_Naissance }}" placeholder="Lieu de naissance..." class="col-xs-12 col-sm-6" />
				
				</div>
			</div>
		</div>
		</div>
		<div class="row">
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label no-padding-right" for="sexe">
					<b>Sexe :</b>
				</label>
				<div class="col-sm-9">
					<div class="radio">
						<label>
							<input name="sexe" value="M" type="radio" class="ace" {{ $patient->Sexe == "M" ? "checked" : ""}}/>
							<span class="lbl"> Masculin</span>
						</label>
						<label>
							<input name="sexe" value="F" type="radio" class="ace" {{ $patient->Sexe == "F" ? "checked" : ""}}/>
							<span class="lbl"> Féminin</span>
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="gs">
					<b>Groupe sanguin :</b>
				</label>
				<div class="col-sm-2">
					<select class="form-control" id="gs" name="gs">
						<option value="{{ $patient->group_sang }}">{{ $patient->group_sang }}</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="AB">AB</option>
						<option value="O">O</option>
					</select>
				</div>
			
				<label class="col-sm-2 control-label" for="rh">
					<b>Rhésus:</b>
				</label>
				<div class="col-sm-4">
					<select id="rh" name="rh">
						<option value="{{ $patient->Rihesus }}">{{ $patient->Rihesus }}</option>
						<option value="+">+</option>
						<option value="-">-</option>
					</select>
				</div>
			</div>
		</div>
		</div>
		<div class="row">	
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="sf">
						<b>Situation Familliale: </b>
					</label>
					<div class="col-sm-4">
						<select class="form-control" id="sf" name="sf">
							<option value="{{ $patient->situation_familiale }}">
								{{ $patient->situation_familiale }}
							</option>
							<option value="célibataire">Célibataire</option>
							<option value="marié">Marié</option>
							<option value="divorcé">divorcé</option>
						</select>
					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">	
				<div class="col-sm-9">
					<div>
						<label class="line-height-1 blue">
						<input id="fonc" name="type" value="Assure" type="radio" class="ace" onclick="typep()" 
						{{ $patient->Type === "Assure" ? "Checked" : "" }}/>
							<span class="lbl"> Assuré(e)</span>
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="ayant" name="type" value="Ayant droit" type="radio" class="ace" onclick="typep()"
							{{ $patient->Type === "Ayant droit" ? "Checked" : "" }}
							/>
							<span class="lbl"> Ayant droit</span>
						</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="Autre" name="type" value="Autre" type="radio" class="ace" onclick="typep()"
							{{ $patient->Type === "Autre" ? "Checked" : "" }}
							/>
							<span class="lbl"> Autre</span>
						</label>

					</div>
			           </div>
				</div>
			</div>
		</div>
		<div class="row"  id ="NSSInput" {{ $patient->Type ==="Ayant droit" ? "":"hidden" }}>
			<div class="col-sm-6">
				<div class="form-group">	
					<label class="col-sm-3 control-label no-padding-right" for="sf">
						<b>Type : </b>
					</label>
					<div class="col-sm-9">
						<select id="service" name="service" class="col-xs-12 col-sm-6"/>
							<option value="Ascendant" {{ $patient->Type_p === "Ascendant" ? "Selected":"" }} >Ascendant</option>
							<option value="Descendant" {{ $patient->Type_p === "Descendant" ? "Selected":"" }} >Descendant</option>
							<option value="Conjoint" {{ $patient->Type_p === "Conjoint" ? "Selected":"" }} >Conjoint</option>
						</select>
					</div>	
				</div>	
			</div>

			<div class="col-sm-6" >
				<div class="form-group"  >		

					<label class="col-sm-2 control-label no-padding-right" for="NSS">
						<b>NSS (Patient):</b>
					</label>
					<div class="col-sm-9">
						<input type="text" name="NSS" id ="NSS" value="{{ $patient->NSS }}" />	
					</div>
				</div>
			</div>
		</div>
		{{-- afficher si est une derogation --}}
		{{-- {{ $patient->Type ==="Autre" ? "":"hidden" }} --}}
		<div class="row" id ="descriptionDerog" {{ $patient->Type ==="Autre" ? "":"hidden" }} >
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="matf">
						<span class= "text-nowrap"><b>Autre information :</b></span>
					</label>
					<div class="col-sm-9">
						<div class="clearfix">
							<textarea type="text" id="description" name="description" class="col-xs-12 col-sm-6">{{ $patient->description }}</textarea>
						</div>
					</div>
				</div>
			</div>
		
		</div>
		{{-- fin derogation --}}
		<div class="row">
			<div class="col-sm-12">
				<h3 class="header smaller lighter blue">
					Informations Contact
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div>
					<i class="fa fa-map-marker light-orange bigger-110"></i>
					<label for="adresse"><b>Adresse :</b></label>
					<textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse...">
						{{ $patient->Adresse }}
					</textarea>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group {{ $errors->has('mobile1') ? "has-error" : "" }}">
					<i class="fa fa-phone"></i>
					<label for="mobile1"><b>Tél-mob 1 : </b></label>
					<br/>
					<input type="tel" name="mobile1" value="{{ $patient->tele_mobile1 }}" placeholder="XX XX XX XX XX" autocomplete="off" maxlength="10" minlength="10"  pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" >
					<span class="tel validity"></span>
				</div>
			</div>
			<div class="col-sm-3">
				<div>
					<i class="fa fa-phone"></i>
					<label for="adresse"><b>Tél-mob 2 : </b></label>
					<br/>
					<input type="tel" name="mobile2" value="{{ $patient->tele_mobile2 }}" placeholder="XXXXXXXXXX" autocomplete="off" maxlength="10" minlength="10"  pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
					<span class="tel validity"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h3 class="header smaller lighter blue">
					Informations du l'assuré(e)
				</h3>
			</div>
		</div>
		{{-- @if($patient->Type !="Autre") --}}
		<div id ="AssureInputs" {{ $patient->Type ==="Assure" ? "":"hidden" }}>
			<div id="etatinput" class="col-sm-12">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etat">
						<b>Etat:</b>
					</label>
					<div class="col-sm-9">
						<div class="radio">
						<label>
							<input name="etatass" value="En exercice" type="radio" class="ace" {{ $assure->Etat ==="En exercice" ? "Checked":"" }} />
							<span class="lbl"> En exercice</span>
						</label>
						<label>
							<input name="etatass" value="Retraité" type="radio" class="ace" {{ $assure->Etat ==="Retraité" ? "Checked":"" }} />
							<span class="lbl"> Retraité</span>
						</label>
						<label>
							<input name="etatass" value="Invalide" type="radio" class="ace" {{ $assure->Etat ==="Invalide" ? "Checked":"" }} />
							<span class="lbl"> Invalide</span>
						</label>
						<label>
							<input name="etatass" value="Mise en disponibilité" type="radio" class="ace"  {{ $assure->Etat ==="Mise en disponibilité" ? "Checked":"" }} />
								<span class="lbl"> Mise en disponibilité</span>
						</label>
						</div>
					</div>
				</div>
			</div>
			<div id="foncinput" class="col-sm-12">
				<div class="form-group">
				         <br>
					<label class="col-sm-3 control-label no-padding-right" for="service">
						<b>Service:</b>
					</label>
					<div class="col-sm-9">
						<select id="service" name="service" class="col-xs-12 col-sm-6"/>
							<option value="{{ $assure->Service }}">{{ $assure->Service }}</option>
							<option value="Agent civile">Agent civile</option>
							<option value="Sécurité publique">Sécurité publique</option>
							<option value="Police judiciaire (PJ)">Police judiciaire (PJ)</option>
							<option value=" Brigade mobile de la police judiciaire (BMPJ)">
								Brigade mobile de la police judiciaire (BMPJ)
							</option>
							<option value="Service protection et sécurité des personnalités (SPS)">
								Service protection et sécurité des personnalités (SPS)
							</option>
							<option value="L'Unité aérienne de la sûreté nationale">
								L'Unité aérienne de la sûreté nationale
							</option>
							<option value="Unités républicaines de sécurité (URS)">
								Unités républicaines de sécurité (URS)
							</option>
							<option value="Police scientifique et technique">Police scientifique et technique</option>
							<option value="Police aux frontières et de l'immigration (PAF)">
								Police aux frontières et de l'immigration (PAF)
							</option>
							<option value="La Brigade de recherche et d'intervention (BRI)">
								La Brigade de recherche et d'intervention (BRI)
							</option>
							<option value="Le Groupe des opérations spéciales de la police (GOSP)">
								Le Groupe des opérations spéciales de la police (GOSP)
							</option>
						</select>
					</div>
				</div>
				
			</div>

			<div id="gradeinput" class="col-sm-12">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="grade">
						<b>Grade :</b>
					</label>
					<div class="col-sm-9">
						<select id="grade" name="grade" class="col-xs-12 col-sm-6"/>
							<option value="Agent de police AP" {{ $assure->Grade === "Agent de police AP" ? "Selected":"" }} >Agent de police AP</option>
							<option value="Brigadier de police BP" {{ $assure->Grade === "Brigadier de police BP" ? "Selected":"" }}>Brigadier de police BP</option>
							<option value="Brigadier-Chef" >Brigadier-Chef</option>
							<option value="Inspecteur de Police">Inspecteur de Police</option>
							<option value="Inspecteur Principal de Police">Inspecteur Principal de Police</option>
							<option value="Lieutenant de police">Lieutenant de police</option>
							<option value="Commissaire de Police">Commissaire de Police</option>
							<option value="Commissaire Principal de Police">Commissaire Principal de Police</option>
							<option value="Commissaire Divisionnaire de Police">Commissaire Divisionnaire de Police</option>
							<option value="Contrôleur de Police">Contrôleur de Police</option>
							<option value="Contrôleur Général de Police">Contrôleur Général de Police</option>
						</select>
					</div>
				</div>
				
			</div>	{{-- fin grade --}}

			<div id="nssinput" class="col-sm-12">
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url"><b>NMGSN :</b></label>
					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" id="nmgsnAss" name="nmgsnAss" value="{{ $assure->NMGSN }}" class="col-xs-12 col-sm-6" placeholder="N° Mutuelle..." />
						</div>
					</div>
					<br>
				</div>
				<br>
			</div>

			<div id="nssinput" class="col-sm-12">
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url"><b>NSS :</b></label>
					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" id="nss1" name="nss1" value="{{ $assure->NSS }}" class="col-xs-12 col-sm-6" placeholder="N° sécurité sociale..." />
						</div>
					</div>
					<br>
				</div>
				<br>
			</div>

			<div id="matinput" class="col-sm-12">
			
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url"><b>Matricule :</b></label>
					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" id="mat" name="mat" value="{{ $assure->Matricule }}" class="col-xs-12 col-sm-6" placeholder="Matricule..." />
						</div>
					</div>
				</div>
				<br>
			</div>
		</div>	{{-- fin AssureInputs --}}
		<div class="hr hr-dotted"></div>
		<div id="foncform" {{ $patient->Type ==="Ayant droit" ? "":"hidden" }}>
			
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="nomf">
							<b>Nom :</b> 
						</label>
						<div class="col-sm-9">
							<input type="text" id="nomf" name="nomf" value="{{ $assure->Nom }}" placeholder="Nom..." class="col-xs-12 col-sm-6" />
						</div>
						<br>
					</div>
					<br>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="prenomf">
							<b>Prénom :</b>
						</label>
						<div class="col-sm-9">
							<input type="text" id="penomf" name="prenomf" value="{{ $assure->Prenom }}" placeholder="Prénom..." class="col-xs-12 col-sm-6" />
						</div>
						<br>
					</div>
					<br>
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="datenaissancef">
							<span class="text-nowrap"><b>Date de naissance :</b></span>
						</label>
						<div class="col-sm-9">
							<input class="col-xs-12 col-sm-6 date-picker" id="datenaissancef" name="datenaissancef" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." value = {{ $assure->Date_Naissance }} />
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="lieunaissancef">
							<span class='text-nowrap'><b>Lieu de naissance :</b</span>
						</label>
						<div class="col-sm-9">
							<input type="text" id="lieunaissancef" name="lieunaissancef" value="{{ $assure->lieunaissance }}" placeholder="Lieu de naissance..." class="col-xs-12 col-sm-6" />
						</div>
						<br>
					</div>
					<br>
				</div>
		</div>{{-- fin foncform --}}
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="sexe">
						<b>Sexe</b>
					</label>
					<div class="col-sm-9">
						<div class="radio">
							<label>
								<input name="sexef" value="M" type="radio" class="ace" {{ $assure->Sexe === "M" ? "Checked" : "" }}/>
								<span class="lbl"> Masculin</span>
							</label>
							<label>
								<input name="sexef" value="F" type="radio" class="ace" {{  $assure->Sexe=== "F" ? "checked" : "" }} />
								<span class="lbl"> Féminin</span>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="servicef">
						<b>Service</b>
					</label>
					<div class="col-sm-9">
						<select id="servicef" name="servicef" class="col-xs-12 col-sm-6"/>
							<option value="Agent civile"
                                                                            {{ $assure->Service === "Agent civile" ? "Selected":"" }}>Agent civile</option>
							<option value="Sécurité publique"
							   {{ $assure->Service === "Sécurité publique" ? "Selected":"" }} >Sécurité publique</option>
							<option value="Police judiciaire (PJ)"
							 {{$assure->Service === "Police judiciaire (PJ)" ? "Selected":"" }} >Police judiciaire (PJ)</option>
							
							<option value=" Brigade mobile de la police judiciaire (BMPJ)"  {{ $assure->Service === "Brigade mobile de la police judiciaire (BMPJ)" ? "Selected":"" }} >Brigade mobile de la police judiciaire (BMPJ)					      </option>
							<option value="Service protection et sécurité des personnalités (SPS)" {{ $assure->Service === "Service protection et sécurité des personnalités (SPS)" ? "Selected":"" }} >Service protection et sécurité des personnalités (SPS)
							</option>
							<option value="L'Unité aérienne de la sûreté nationale" {{$assure->Service === "L'Unité aérienne de la sûreté nationale" ? "Selected":"" }} >L'Unité aérienne de la sûreté nationale</option>
							<option value="Unités républicaines de sécurité (URS)" {{ $assure->Service === "Unités républicaines de sécurité (URS)" ? "Selected":"" }} >Unités républicaines de sécurité (URS)</option>
							<option value="Police scientifique et technique"
							{{$assure->Service === "Police scientifique et technique" ? "Selected":"" }} >Police scientifique et technique</option>
							<option value="Police aux frontières et de l'immigration (PAF)" {{ $assure->Service === "Police aux frontières et de l'immigration (PAF)" ? "Selected":"" }} >Police aux frontières et de l'immigration (PAF)</option>
							<option value="La Brigade de recherche et d'intervention (BRI)" {{ $assure->Service === "La Brigade de recherche et d'intervention (BRI)" ? "Selected":"" }} >La Brigade de recherche et d'intervention (BRI)</option>
							<option value="Le Groupe des opérations spéciales de la police (GOSP)"  {{ $assure->Service === "Le Groupe des opérations spéciales de la police (GOSP)" ? "Selected":"" }} >Le Groupe des opérations spéciales de la police (GOSP)
							</option>
						</select>
					</div>
				</div>	
			</div>
		</div>	{{-- end row --}}
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="gradef">
						<b>Grade</b>
					</label>
					<div class="col-sm-9">
						<select id="gradef" name="gradef" class="col-xs-12 col-sm-6"/>
						<option value="Agent de police AP" {{ $assure->Grade === "Agent de police AP" ? "Selected":"" }} >Agent de police AP</option>
						<option value="Brigadier de police BP" {{ $assure->Grade === "Brigadier de police BP" ? "Selected":"" }}>Brigadier de police BP</option>
						<option value="Brigadier-Chef" >Brigadier-Chef</option>
						<option value="Inspecteur de Police">Inspecteur de Police</option>
						<option value="Inspecteur Principal de Police">Inspecteur Principal de Police</option>
						<option value="Lieutenant de police">Lieutenant de police</option>
						<option value="Commissaire de Police">Commissaire de Police</option>
						<option value="Commissaire Principal de Police">Commissaire Principal de Police</option>
						<option value="Commissaire Divisionnaire de Police">Commissaire Divisionnaire de Police</option>
						<option value="Contrôleur de Police">Contrôleur de Police</option>
						<option value="Contrôleur Général de Police">Contrôleur Général de Police</option>
					           </select>
					</div>
				</div>
			</div>
			<div class="col-sm-6" id="statut">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="etatf">
						<b>Etat</b>
					</label>
					<div class="col-sm-9">
						<div class="radio">
							<label>
								<input name="etat" value="En exercice" type="radio" class="ace" {{ $assure->Etat ==="En exercice" ? "Checked":"" }} />
								<span class="lbl"> En exercice</span>
							</label>
							<label>
								<input name="etat" value="Retraité" type="radio" class="ace" {{ $assure->Etat ==="Retraité" ? "Checked":"" }} />
								<span class="lbl"> Retraité</span>
							</label>
							<label>
								<input name="etat" value="Invalide" type="radio" class="ace" {{ $assure->Etat ==="Invalide" ? "Checked":"" }} />
								<span class="lbl"> Invalide</span>
							</label>
							<label>
								<input name="etat" value="Mise en disponibilité" type="radio" class="ace"  {{ $assure->Etat ==="Mise en disponibilité" ? "Checked":"" }} />
								<span class="lbl"> Mise en disponibilité</span>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>	{{-- end row --}}
		{{-- <div class="space-12"></div> --}}
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="nmgsnAss"><b>NMGSN :</b></label>
					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-6" value="{{ $assure->NMGSN }}" />
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="nss2">
						<b>NSS :</b>
					</label>
					<div class="col-sm-9">
						<div class="clearfix">
							<input type="text" id="nss2" name="nss2" value="{{ $assure->NSS }}" class=" col-sm-6" placeholder="N° sécurité sociale..."/>
					 	</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="matf">
						<b>Matricule</b>
					</label>
					<div class="col-sm-9">
						<div class="clearfix">
							<input type="text" id="matf" name="matf" value="{{ $assure->Matricule }}" class="col-xs-12 col-sm-6" placeholder="Matricule..."/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<br><br>
				</div>
			</div>
		</div>
	{{-- 	@endif --}}
	</div>

{{-- homme de confiance --}}
	<div class="row">
			<div class="col-sm-12">				
				<h3 class="header smaller lighter blue">
					Informations de l'homme de confiance
					&nbsp;&nbsp;&nbsp;
					 <a class="orange" href="#" id="edit_hc" ><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;
					 <a class="green" href="#" id="add_hc"><i class="glyphicon glyphicon-plus-sign"></i></a>
				</h3>

			</div>
		</div>
		<div id ="Homme_cInputs">
		<div class="row">
		<div class="col-sm-6">
			<div class="form-group ">
				<label class="col-sm-3 control-label no-padding-right" for="nom_h">
					<b>Nom :</b> 
				</label>
				<div class="col-sm-9">
					<input type="hidden" id="id_h" name="id_h" value="{{ $homme_c->id}}"/>
					<input type="hidden" id="etat_h" name="etat_h" value="actuel"/>
					<input type="text" id="nom_h" name="nom_h" value="{{ $homme_c->nom }}" placeholder="Nom..." class="col-xs-12 col-sm-6" readonly/>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group ">
				<label class="col-sm-3 control-label no-padding-right" for="prenom_h">
					<b>Prénom :</b>
				</label>
				<div class="col-sm-9">
					<input type="text" id="prenom_h" name="prenom_h" value="{{ $homme_c->prénom }}" placeholder="Prénom..." class="col-xs-12 col-sm-6" readonly/>
				</div>
			</div>
		</div>
		</div>
		<div class="row">
		<div class="col-sm-6">
			<div class="form-group ">
				<label class="col-sm-3 control-label no-padding-right" for="datenaissance_h">
					<b class="text-nowrap">Né(e) le :</b>
				</label>
				<div class="col-sm-9">
				<input class="col-xs-12 col-sm-6 date-picker" id="datenaissance_h" name="datenaissance_h" value="{{ $homme_c->date_naiss}}" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" readonly />
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group ">
				<label class="col-sm-3 control-label no-padding-right" for="lien_par">
					<b>lien de parenté :</b>
				</label>
				<div class="col-sm-5">
					<select class="form-control" id="lien_par" name="lien_par" placeholder="date de délivrance ..." readonly>
						<option value="{{ $homme_c->lien_par }}">{{ $homme_c->lien_par }}</option>
						<option value="conjoint">Conjoint(e)</option>
						<option value="père">Père</option>
						<option value="mère">Mère</option>
						<option value="frère">Frère </option>
						<option value="soeur">Soeur </option>
						<option value="membre_famille">Membre de famille </option>
						<option value="ami">Ami </option>
					</select>
				</div>
			</div>
		</div>		
		
		</div>
		<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="type_piece">
					<b>Type de la pièce d'identité :</b>
				</label>
				<div class="col-sm-9">					
					<div class="radio">
						<label>
							<input id="type_piece" name="type_piece" value="CNI" type="radio" class="ace" readonly {{ $homme_c->type_piece ==="CNI" ? "Checked":"" }}  />
							<span class="lbl">carte nationale d'identité</span>
						</label>
						<label>
							<input id="type_piece" name="type_piece" value="Permis" type="radio" class="ace" readonly {{ $homme_c->type_piece ==="Permis" ? "Checked":"" }} />
							<span class="lbl">Permis de Conduire</span>
						</label>
						<label>
							<input id="type_piece" name="type_piece" value="passeport" type="radio" class="ace" readonly {{ $homme_c->type_piece ==="passeport" ? "Checked":"" }} />
							<span class="lbl"> Passeport</span>
						</label>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="row">	
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="sf">
						<b>N° de la pièce: </b>
					</label>
					<div class="col-sm-9">
					<input type="text" id="num_piece" name="num_piece" value="{{ $homme_c->num_piece }}" placeholder="N° pièce..." class="col-xs-12 col-sm-6" readonly/>
				</div>
				</div>
			</div>
			<div class="col-sm-6">
			<div class="form-group ">
				<label class="col-sm-3 control-label no-padding-right" for="date_piece_id">
					<b class="text-nowrap">Délivré le :</b>
				</label>
				<div class="col-sm-9">
				<input class="col-xs-12 col-sm-6 date-picker" id="date_piece_id" name="date_piece_id" value="{{$homme_c->date_naiss}}" type="text" data-date-format="yyyy-mm-dd" placeholder="date de délivrance ..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" readonly/>
				</div>
			</div>
		</div>
	
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h3 class="header smaller lighter blue">
					Informations Contact
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div>
					<i class="fa fa-map-marker light-orange bigger-110"></i>
					<label for="adresse"><b>Adresse :</b></label>
					<textarea class="form-control" id="adresse_h" name="adresse_h" placeholder="Adresse..." readonly>
						{{ $homme_c->adresse }}
					</textarea>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<i class="fa fa-phone"></i>
					<label for="mobile_h"><b>Tél-mob : </b></label>
					<br/>
					<input type="tel" id="mobile_h" name="mobile_h" value="{{$homme_c->mob}}" placeholder="XX XX XX XX XX" autocomplete="off" maxlength="10" minlength="10"  pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"  readonly>
					<span class="tel validity"></span>
				</div>
			</div>			
		</div>
	</div>

{{-- fin info homme de confiance --}}		
{{-- ///////////////////////// --}}
		{{--  @endif  ancien fin foncform --}}
		
		<div class="hr hr-dotted"></div>
		<div class="col-sm-12 center">
			<br>
			<button class="btn btn-info" type="submit">
				<i class="ace-icon fa fa-save bigger-110"></i>
				Enregistrer
			</button>
			&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="ace-icon fa fa-undo bigger-110"></i>
				Réinitialiser
			</button>
			<br>
		</div>
	</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	
$("#edit_hc").click(function(e) { 
   
$('#nom_h').prop('readonly', false);
$('#nom_h').focus();
$('#prenom_h').attr('readonly', false);
$('#datenaissance_h').attr('readonly', false);
$('#lien_par').attr('readonly', false);
$('#type_piece').attr('readonly', false);
$('#num_piece').attr('readonly', false);
$('#date_piece_id').attr('readonly', false);
$('#adresse_h').attr('readonly', false);
$('#mobile_h').attr('readonly', false);
     
return false;
});
$("#add_hc").click(function(e) { 
   
$('#nom_h').prop('readonly', false);
$('#prenom_h').attr('readonly', false);
$('#datenaissance_h').attr('readonly', false);
$('#lien_par').attr('readonly', false);
$('#type_piece').attr('readonly', false);
$('#num_piece').attr('readonly', false);
$('#date_piece_id').attr('readonly', false);
$('#adresse_h').attr('readonly', false);
$('#mobile_h').attr('readonly', false);

$('#nom_h').val('');
$('#nom_h').focus();
//$('#id_h').val('');
$('#prenom_h').val('');
$('#datenaissance_h').val('');
$('#lien_par').val('');

$('input[name="type_piece"]').prop('checked', false);
$('#num_piece').val('');
$('#date_piece_id').val('');
$('#adresse_h').val('');
$('#mobile_h').val('');
$('#etat_h').val('archivé');

return false;
});
</script>@endsection