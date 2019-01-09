@extends('app_recep')
@section('main-content')
	<div class="page-header">
		<h1>Ajouter Un Patient :</h1>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<form class="form-horizontal" action="{{ route('patient.store') }}" method="POST" role="form" autocomplete="off">
				{{ csrf_field() }}
				<div class="col-sm-12">
					<h3 class="header smaller lighter blue">
					<b>Informations administratives</b>
					</h3>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-12">
					<div class="form-group">
						@if (count($errors) > 0)
					          		<div class="alert alert-danger">
						          <ul>
						           @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						           @endforeach
						          </ul>
							</div>
						@endif
					</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label no-padding-right" for="nom">
							<b>Nom :</b> 
						</label>
						<div class="col-sm-9">
							<input type="text" id="nom" name="nom" placeholder="Nom..." class="col-xs-12 col-sm-6" autocomplete= "off" required alpha/>
							{!! $errors->first('datenaissance', '<small class="alert-danger">:message</small>') !!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label no-padding-right" for="prenom">
							<b>Prénom :</b>
						</label>
						<div class="col-sm-9">
							<input type="text" id="penom" name="prenom" placeholder="Prénom..." class="col-xs-12 col-sm-6" autocomplete="off" required/>
							{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label no-padding-right" for="datenaissance">
							<b>Né(e) le :</b>
						</label>
						<div class="col-sm-9">
						<input class="col-xs-12 col-sm-6 date-picker" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required/>
						 {!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
						
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label no-padding-right" for="lieunaissance">
							<b class="text-nowrap">Lieu de naissance :</b>
						</label>
						<div class="col-sm-9">
							<input type="text" id="lieunaissance" name="lieunaissance" placeholder="Lieu de naissance..."  autocomplete = "off" class="col-xs-12 col-sm-6" required/>
							 {!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label no-padding-right" for="sexe">
							<b>Sexe :</b>
						</label>
						<div class="col-sm-9">
							<div class="radio">
							<label>
								<input name="sexe" value="M" type="radio" class="ace" checked />
								<span class="lbl"> Masculin</span>
							</label>
							<label>
								<input name="sexe" value="F" type="radio" class="ace" />
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
								<option value="">------</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="AB">AB</option>
								<option value="O">O</option>
							</select>
						</div>
						<label class="col-sm-3 control-label no-padding-right" for="rh">
							<b>Rhésus :</b>
						</label>
						<div class="col-sm-2">
							<select id="rh" name="rh">
								<option value="">----</option>
								<option value="+">+</option>
								<option value="-">-</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="sf">
						<b class="text-nowrap">Situation familiale :</b>
						</label>
						<div class="col-sm-4">
							<select class="form-control" id="sf" name="sf">
								<option value="">------</option>
								<option value="célibataire">Célibataire</option>
								<option value="marié">Marié</option>
								<option value="divorcé">divorcé</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<h3 class="header smaller lighter blue">
						<b>Contact</b>
					</h3>
				</div>
				<div class="space-12"></div>		
				<div class="col-sm-12">
					<div class="col-sm-6">
						<div >
							<label for="adresse"><b>Adresse :</b></label>
							<textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse..."></textarea>
						</div>
					</div>
					<div class="col-sm-3">
						<div>
						<i class="fas fa-phone"></i>
							<label for="mobile1"><b>Tél-mob1 :</b></label>
							<br/>
							<div class="col-sm-4">
						           <select name="operateur1" id="operateur1" class="form-control" required="">
						           <option value=""> Choisir </option>
						         	<option value="05">05</option>         
						   	<option value="06">06</option>
						           <option value="07">07</option>
                       					</select>
          							</div>
							<input id="mobile1" name="mobile1"  maxlength =8 minlength =8  name="mobile1" type="tel" autocomplete="off"
           								pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"   placeholder="XXXXXXXX"required>
    								<span class="tel validity"></span>
						</div>
					</div>
					<div class="col-sm-3">
						<div>
							<i class="fas fa-phone"></i>
							<label for="adresse"><b>Tél-mob2 :</b></label>
							<br/>
							<div class="col-sm-4">
						           <select name="operateur2" id="operateur2" class="form-control">
						           <option value=""> Choisir </option>
						         	<option value="05">05</option>         
						   	<option value="06">06</option>
						           <option value="07">07</option>
                       					</select>
          							</div>
							<input id="mobile2" name="mobile2"  maxlength =8 minlength =8  type="tel" autocomplete="off"
           						pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"   placeholder="XX XX XX XX">
							<span class="tel validity"></span>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<h3 class="header smaller lighter blue">
						<b>Qualité Patient</b>
					</h3>
				</div>
				<div class="col-sm-12"><br>	</div>
				<div class="row">
					 <div class="form-group">
						<div class="col-sm-2">
						</div>	
						<div class="col-sm-1">
							<label class="control-label no-padding-right pull-right" style=" padding-top: 0px;"><b>Type :</b></label>
						</div>
						<div class="col-sm-9">
						<label class="line-height-1 blue">
							<input id="fonc" name="type" value="Assure" type="radio" class="ace" onclick="typepCreation()" Checked
							/>
							<span class="lbl"> Assuré(e)</span>
						</label>
						&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="ayant" name="type" value="Ayant_droit" type="radio" class="ace" onclick="typepCreation()"/>
								<span class="lbl"> Ayant droit</span>
						</label>
						&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="ayant" name="type" value="Autre" type="radio" class="ace" onclick="typepCreation()"/>
								<span class="lbl"> Autre</span>
						</label>	
						</div>
					</div>
				</div>
				<div class="space-12"></div>
				<div class="row">
					<div class="starthidden">
						<label for=""><b>Autre information :</b></label>
						<textarea class="form-control" id="description" name="description" placeholder="Description du la dérogation" >
						</textarea>
					</div>
				</div>
				<div class="space-12"></div>	
				<div id="foncinput" class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="service">
							<b>Service :</b>
						</label>
						<div class="col-sm-9">
							<select id="service" name="service" class="col-xs-12 col-sm-6"/>
								<option value="">Sélectionner...</option>
								<option value="Agent civile">Agent civile</option>
								<option value="Sécurité publique">Sécurité publique</option>
								<option value="Police judiciaire (PJ)">Police judiciaire (PJ)</option>
								<option value=" Brigade mobile de la police judiciaire (BMPJ)">
									Brigade mobile de la police judiciaire (BMPJ)
								</option>
								<option value="Service protection et sécurité des personnalités (SPS)">
									Service protection et sécurité des personnalités (SPS)
								</option>
								<option value="L'Unité aérienne de la sûreté nationale">L'Unité aérienne de la sûreté nationale</option>
								<option value="Unités républicaines de sécurité (URS)">Unités républicaines de sécurité (URS)</option>
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
					<br><br>
				</div>	{{-- foncinput --}}
				<div id="gradeinput" class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="grade">
							<b>Grade :</b>
						</label>
						<div class="col-sm-9">
							<select id="grade" name="grade" class="col-xs-12 col-sm-6"/>
								<option value="">Sélectionner...</option>
								<option value="Agent de police AP">Agent de police AP</option>
								<option value="Brigadier de police BP">Brigadier de police BP</option>
								<option value="Brigadier-Chef">Brigadier-Chef</option>
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
					<br><br>
				</div>{{-- gradeinput --}}
				<div id="etatinput" class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="etat">
							<b>Etat :</b>
						</label>
						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input name="etat" value="En exercice" type="radio" class="ace" checked/>
									<span class="lbl"> En exercice</span>
								</label>
								<label>
									<input name="etat" value="Retraité" type="radio" class="ace" />
									<span class="lbl"> Retraité</span>
								</label>
								<label>
									<input name="etat" value="Invalide" type="radio" class="ace" />
									<span class="lbl"> Invalide</span>
								</label>
								<label>
									<input name="etat" value="Mise en disponibilité" type="radio" class="ace" />
									<span class="lbl"> Mise en disponibilité</span>
								</label>
							</div>
						</div>
					</div>
					<br><br>
				</div>	{{-- etatinput --}}
				{{-- ad nmgsn	 --}}
				<div id="nssinput" class="col-sm-12">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="nmgsnAss"><b>NMGSN :</b></label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
						<input type="text" id="nmgsnAss" name="nmgsnAss" class="col-xs-12 col-sm-6" placeholder="N°  Mutuelle..." title="vote numéro mutuelle" autocomplete="off" />
							</div>
						</div>
					</div>
					<br><br>
				</div>{{-- fin nmgsn --}}
				<div id="nssAssinput" class="col-sm-12">
					<div class="form-group" {{ $errors->has('nss1') ? 'has-error' : ''}}">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url"><b>NSS :</b></label>
						<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
						<input type="text" id="nss1" name="nss1" class="col-xs-12 col-sm-6"  placeholder="XX XXXX XXXX XX" title="numéro de sécurité sociale du patient"/>
						{!! $errors->first('nss1', '<p class="alert-danger">:message</p>') !!}
						{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2} $" --}}
						</div>
						</div>
					</div>
					<br>
					<div class="space-12"></div>
				</div>{{-- nssAssinput --}}
				<div id="matinput" class="col-sm-12">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url"><b>Matricule :</b></label>
						<div class="col-xs-12 col-sm-9">
							<div class="clearfix">
								<input type="text" id="mat" name="mat" class="col-xs-12 col-sm-6" placeholder="Matricule..."  title="votre matricule de police"/>
							</div>
						</div>
					</div>
					<br><br>
				</div>
				<div id="foncform" style="display: none;">
					{{-- //////////////				 --}}
					<div id="typepp" class="col-sm-12" style="display: none;">
						<div class="col-sm-6">
					                     <div class="form-group">
						 		<label class="col-sm-3 control-label no-padding-right" for="lieunaissancef">
									<b>Type :</b>
								</label>
								<div class="col-sm-9">
									<select class="form-control col-xs-12 col-sm-6" id="Type_p" name="Type_p">
										<option value="">------</option>
										<option value="Ascendant">Ascendant</option>
										<option value="Descendant">Descendant</option>
										<option value="Conjoint">Conjoint</option>
									</select>
								</div>
							</div>				
						</div>	
						<div class="col-sm-6">
							<div class="form-group">
						 		<label class="col-sm-4 control-label no-padding-right" for="lieunaissancef">
									<b>NSS (patient):</b>
								</label>
								<div class="col-sm-8">
								<input type="text" class="form-control col-xs-12 col-sm-6" id="nsspatient" name="nsspatient"
								pattern="^\[0-9]{2}+' '+\[0-9]{4} +' '+\[0-9]{4}+' '+[0-9]{2}$"  placeholder="XX XXXX XXXX XX" />
								</div>
							</div>			
						</div>	
					</div>
					{{-- //////////////// --}}
					<div class="col-sm-12">
						<h3 class="header smaller lighter blue">
							<b>Information L'Assuré(e)</b>
						</h3>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="nomf">
								<b>Nom :</b> 
							</label>
							<div class="col-sm-9">
								<input type="text" id="nomf" name="nomf" placeholder="Nom..." class="col-xs-12 col-sm-6" />
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
							<input type="text" id="penomf" name="prenomf" placeholder="Prénom..." class="col-xs-12 col-sm-6" />
						</div>
						<br>
					</div>
					<br>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="datenaissancef">
						<b class="text-nowrap">Né(e) le :</b>
						</label>
						<div class="col-sm-9">
							<input class="col-xs-12 col-sm-6 date-picker" id="datenaissancef" name="datenaissancef" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." />
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right " for="lieunaissancef">
						<span class="text-nowrap"><b>Lieu de naissance :</b></span>
						</label>
						<div class="col-sm-9">
							<input type="text" id="lieunaissancef" name="lieunaissancef" placeholder="Lieu de naissance..." class="col-xs-12 col-sm-6" autocomplete= "off" />
						</div>
						<br>
					</div>
					<br>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="sexe">
							<b>Sexe :</b>
						</label>
						<div class="col-sm-9">
							<div class="radio">
							<label>
								<input name="sexef" value="M" type="radio" class="ace" checked />
								<span class="lbl"> Masculin</span>
							</label>
							<label>
								<input name="sexef" value="F" type="radio" class="ace" />
								<span class="lbl"> Féminin</span>
							</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="servicef">
							<b>Service :</b>
						</label>
						<div class="col-sm-9">
							<select id="servicef" name="servicef" class="col-xs-12 col-sm-6"/>
								<option value="">Sélectionner...</option>
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
									L'Unité aérienne de la sûreté nationale</option>
								<option value="Unités républicaines de sécurité (URS)">
									Unités républicaines de sécurité (URS)
								</option>
								<option value="Police scientifique et technique">
									Police scientifique et technique
								</option>
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
						<br>
					</div>
					<br>
				</div>
				<div class="space-12"></div>
				<br><br>		
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="gradef">
							<b>Grade :</b>
						</label>
						<div class="col-sm-9">
							<select id="gradef" name="gradef" class="col-xs-12 col-sm-6"/>
								<option value="">Sélectionner...</option>
								<option value="Agent de police AP">Agent de police AP</option>
								<option value="Brigadier de police BP">Brigadier de police BP</option>
								<option value="Brigadier-Chef">Brigadier-Chef</option>
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
				{{-- debut nmgsn	 --}}
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="NMGSN">
							<b>NMGSN :</b>
						</label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-6" placeholder="numéro mutuel" />
							</div>
						</div>
					</div>
					<br><br>
				</div>
				{{-- fin nmgdn --}}
				<div class="col-sm-6" id="statut">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="etatf">
							<b>Etat :</b>
						</label>
						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input name="etatf" value="En exercice" type="radio" class="ace" checked/>
									<span class="lbl"> En exercice</span>
								</label>
								<label>
									<input name="etatf" value="Retraité" type="radio" class="ace" />
									<span class="lbl"> Retraité</span>
								</label>
								<label>
									<input name="etatf" value="Invalide" type="radio" class="ace" />
									<span class="lbl"> Invalide</span>
								</label>
								<label>
									<input name="etatf" value="Mise en disponibilité" type="radio" class="ace" />
									<span class="lbl"> Mise en disponibilité</span>
								</label>
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
							<input type="text" id="nss2" name="nss2" class="col-xs-12 col-sm-6" placeholder="XX XXXX XXXX XX"/>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2}$" --}}
							</div>
						</div>
					</div>
					<br><br>
				</div>
				
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="matf">
							<b>Matricule :</b>
						</label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-6" placeholder="Matricule..." />
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
				<br><br>
				</div>
				</div>
				<div class="hr hr-dotted"></div>
                                         
				<div class="center">
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
				</div>
			</form>
		</div>
	</div>
@endsection
