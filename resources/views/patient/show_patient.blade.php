@extends('app_recep')
@section('main-content')
	<div >
		@include('patient._patientInfo')
	</div>
	<div class="page-header">
	{{-- 	<h1 style="display: inline;"><strong>Détails Du Patient :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1> --}}
		
		<div class="pull-right">
			<a href="{{ route('patient.index') }}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>
				Rechercher un Patient
			</a>
			<a href="{{route('patient.destroy',$patient->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-white btn-warning btn-bold"">
        				<i class="ace-icon fa fa-trash-o bigger-120 orange"> Supprimer</i>
        			</a>
       		 </div>
	</div>
	<div>
		<div id="user-profile-2" class="user-profile">
			<div class="tabbable">
				<ul class="nav nav-tabs padding-18">
					<li class="active">
						<a data-toggle="tab" href="#home">
							<i class="green ace-icon fa fa-user bigger-120"></i>
							Informations Administratives
						</a>
					</li>
					@if (!is_null($homme_c))
					<li >
						<a data-toggle="tab" href="#homme_conf">
							<i class="green ace-icon fa fa-user bigger-120"></i>
							Homme de confiance
						</a>
					</li>
					@endif
					@if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role =="Medecine")
					<li>
						<a data-toggle="tab" href="#feed">
						<i class="orange ace-icon fa fa-stethoscope bigger-120"></i>Consultations&nbsp;<span class="badge badge-warning">{{ $consultations->count() }}
							</span>
						</a>
					</li>
					@endif
					@if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role =="Medecine")
					<li>
					<a data-toggle="tab" href="#pictures">
						<i class="pink ace-icon fa fa-h-square bigger-120"></i>
						Hospitalisations&nbsp;<span class="badge badge-pink">{{ $hospitalisations->count() }}</span>
						</a>
					</li>
					@endif
					<li>
						<a data-toggle="tab" href="#friends">
							<i class="blue ace-icon fa fa-calendar-o bigger-120"></i>
							RDV&nbsp;<span class="badge badge-info">{{ $rdvs->count() }}</span>
						</a>
					</li>
				</ul>
				<div class="tab-content no-border padding-24">
					<div id="home" class="tab-pane in active">
						<div class="row">
							<div class="col-xs-12 col-sm-3 center">
								<span class="profile-picture">
								<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="{{asset('/avatars/profile-pic.jpg')}}" />
								</span>
								<div class="space space-4"></div>
								<a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-sm btn-block btn-success">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
									<span class="bigger-110">Modifier Les Informations</span>
								</a>
								<a class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#ticket">

									<i class="ace-icon fa fa-plus bigger-120"></i>
									<span class="bigger-110">Ajouter Ticket</span>

								</a>
							</div><!-- /.col -->
							<div class="col-xs-12 col-sm-9">
								<h4 class="blue">
									<span class="middle">{{ $patient->Nom }} {{ $patient->Prenom }}</span>
									<span class="label label-purple arrowed-in-right">
										<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
										{{ $patient->Type }}
									</span>
								</h4>
								<div class="profile-user-info">
									<div class="profile-info-row">
										<div class="profile-info-name">Nom</div>
										<div class="profile-info-value">
											<span>{{ $patient->Nom }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Prénom</div>
										<div class="profile-info-value">
											<span>{{ $patient->Prenom }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Sexe </div>
										<div class="profile-info-value">
											<span>{{ $patient->Sexe =="M" ? "Homme" : "Femme" }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Date Naissance </div>
										<div class="profile-info-value">
											<span>{{ $patient->Dat_Naissance }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Age </div>
										<div class="numberCircle">{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }}
										</div>
										 <span class="blue">Ans</span>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Lieu Naissance </div>
										<div class="profile-info-value">
											<i class="fa fa-map-marker light-orange bigger-110"></i>
											<span>{{ $patient->lieuNaissance->nom_commune }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Situ familiale </div>
										<div class="profile-info-value">
											<span>{{ $patient->situation_familiale }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Adresse </div>
										<div class="profile-info-value">
											<i class="fa fa-map-marker light-orange bigger-110"></i>
											<span>
												{{ $patient->Adresse }} ,{{ $patient->commune->nom_commune}} , {{ $patient->wilaya->nom_wilaya }}
											</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"><i class="fa fa-phone"></i>Télé mobile 1 </div>
										<div class="profile-info-value">
											<span>{{ $patient->tele_mobile1 }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"><i class="fa fa-phone"></i>Télé mobile 2 </div>
										<div class="profile-info-value">
											<span>{{ $patient->tele_mobile2 }}</span>
										</div>
									</div>
									@if($patient->Fonction != null)
									<div class="profile-info-row">
										<div class="profile-info-name"> Service </div>
										<div class="profile-info-value">
											<span>{{ $patient->Fonction }}</span>
										</div>
									</div>
									@endif
									@if($patient->Grade != null)
									<div class="profile-info-row">
										<div class="profile-info-name"> Grade </div>
										<div class="profile-info-value">
											<span>{{ $patient->Grade }}</span>
										</div>
									</div>
									@endif
									@if($patient->etat != null)
									<div class="profile-info-row">
										<div class="profile-info-name"> Etat </div>
										<div class="profile-info-value">
											<span>{{ $patient->etat }}</span>
										</div>
									</div>
									@endif
									<div class="profile-info-row">
										<div class="profile-info-name"> Groupe Sang</div>
										<div class="profile-info-value">
											<span>{{ $patient->group_sang }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Rhésus </div>
										<div class="profile-info-value">
											<span>{{ $patient->Rihesus == "+" ? "Positif" : "Négatif" }}</span>
										</div>
									</div>
									@if($patient->matricule != null)
									<div class="profile-info-row">
										<div class="profile-info-name">Matricule</div>
										<div class="profile-info-value">
											<span>{{ $patient->matricule }}</span>
										</div>
									</div>
									@endif
									<div class="profile-info-row">
										<div class="profile-info-name">Date Création</div>
										<div class="profile-info-value">
											<span>{{ $patient->Date_creation }}</span>
										</div>
									</div>
								</div>
								<div class="hr hr-8 dotted"></div>
								@if($patient->Type == "Ayant droit")
									<div class="col-sm-12 widget-container-col" id="widget-container-col-12">
										<div class="widget-box transparent" id="widget-box-12">
											<div class="widget-header">
												<h4 class="widget-title lighter">Les Informations du fonctionnaire</h4>
											</div>
											<div class="widget-body">
												<div class="widget-main padding-6 no-padding-left no-padding-right">
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Nom :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->Nom }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Prénom :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->Prenom }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Date de naissance :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->Date_Naissance }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Lieu de naissance :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->lieunaissance }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Sexe :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->Sexe == "H" ? "Masculin" : "Féminin" }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Matricule :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->Matricule }}</span>
														</label>
													</div>
													<div class="col-sm-6">
														<label class="inline">
															<span><b>Service :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->Fonction }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Grade :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->Grade }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Etat :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->Etat }}</span>
														</label>
													</div>
													<div class="col-sm-6">
														<label class="inline">
															<span><b>N° sécurité sociale :</b></span>
															<span class="lbl blue"> {{ App\modeles\assur::where("id",$patient->Assurs_ID_Assure)->get()->first()->NSS }}</span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endif
							</div><!-- /.col -->
						</div><!-- /.row -->
						<div class="space-20"></div>
					</div><!-- /#home -->
					<!--homme_conf -->
					@if (!is_null($homme_c))
                
					<div id="homme_conf" class="tab-pane">
						<div class="row">
							<div class="col-xs-12 col-sm-3 center">
								<span class="profile-picture">
								<img class="editable img-responsive" alt="Alex's Avatar" id="avatar3" src="{{asset('/avatars/avatar-372-456324.png')}}" />
								</span>
								<div class="space space-4"></div>
								<a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-sm btn-block btn-success">
									<i class="ace-icon fa fa-pencil bigger-120"></i>
									<span class="bigger-110">Modifier Les Informations</span>
								</a>
							</div><!-- /.col -->
							<div class="col-xs-12 col-sm-9">
								<h4 class="blue">
									<span class="middle"> {{ $homme_c->nom }} {{ $homme_c->prénom }}</span>
									<span class="label label-purple arrowed-in-right">
										<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
										{{ $homme_c->mob }}
									</span>
								</h4>
								<div class="profile-user-info">
									<div class="profile-info-row">
										<div class="profile-info-name">Nom</div>
										<div class="profile-info-value">
											<span>{{ $homme_c->nom}}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Prénom</div>
										<div class="profile-info-value">
											<span>{{$homme_c->prénom }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Sexe </div>
										<div class="profile-info-value">
											<span>{{ $patient->Sexe =="M" ? "Homme" : "Femme" }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Date Naissance </div>
										<div class="profile-info-value">
											<span>{{ $homme_c->date_naiss }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Age </div>
										<div class="profile-info-value">
											<span>
												{{ Jenssegers\Date\Date::parse($homme_c->date_naiss)->age }} ans
											</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Lien de parenté </div>
										<div class="profile-info-value">
											<span>{{ $homme_c->lien_par }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Adresse </div>
										<div class="profile-info-value">
											<i class="fa fa-map-marker light-orange bigger-110"></i>
											<span>{{ $homme_c->adresse }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Télé mobile  </div>
										<div class="profile-info-value">
											<span>{{ $homme_c->mob }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Type de la pièce </div>
										<div class="profile-info-value">
											<span>@if ($homme_c->type_piece=="CNI") Carte d'identité nationale
											@elseif ($homme_c->type_piece=="Permis") Permis de Conduire
											@else Passeport
											@endif
											</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> N° pièce </div>
										<div class="profile-info-value">
											<span>{{ $homme_c->num_piece }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Délivré le </div>
										<div class="profile-info-value">
											<span>{{ $homme_c->date_deliv }}</span>
										</div>
									</div>
								
									<div class="profile-info-row">
										<div class="profile-info-name"> Créer par </div>
										<div class="profile-info-value">
											<span>{{ App\modeles\employ::where("id",$homme_c->created_by)->get()->first()->Nom_Employe }}  {{ App\modeles\employ::where("id",$homme_c->created_by)->get()->first()->Prenom_Employe }}</span>
										</div>
									</div>
								</div>
								
								
							</div><!-- /.col -->
						</div><!-- /.row -->
						<div class="space-20"></div>
					</div><!-- /#homme_conf -->
					@endif
					<div id="feed" class="tab-pane">
						<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
							<div class="widget-box widget-color-blue" id="widget-box-2">
								<div class="widget-header">
									<h5 class="widget-title bigger lighter">
										<i class="ace-icon fa fa-table"></i>
										Liste Des Consultations :
									</h5>
									<div class="widget-toolbar widget-toolbar-light no-border">
										{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
										<div class="fa fa-plus-circle"></div>
										<a href="/consultations/create/{{$patient->id}}">
											<b>Ajouter Une Consultation </b>
										</a>
									</div>
								</div>
								<div class="widget-body">
									<div class="widget-main no-padding">
										<table class="table table-striped table-bordered table-hover">
											<thead class="thin-border-bottom">
												<tr>
													<th>Motif De Consultation</th>
													<th>Date De Consultation</th>
													<th>Diagnostic</th>
													<th>Médecin Traitant</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												@foreach($consultations as $consultation)
													@if($consultation->Patient_ID_Patient == $patient->id)
													<tr>
														<td>{{ $consultation->Motif_Consultation }}</td>
														<td>{{ $consultation->Date_Consultation }}</td>
														<td>{{ $consultation->Diagnostic }}</td>
														<td>
														{{ App\modeles\employ::where("id",$consultation->Employe_ID_Employe)->get()->first()->Nom_Employe }}
														{{ App\modeles\employ::where("id",$consultation->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
														</td>
														<td>
															<div class="hidden-sm hidden-xs btn-group">
                            														<a class="btn btn-xs btn-success" href="/consultations/detailcons/{{$consultation->id}}">	
                            															<i class="ace-icon fa fa-hand-o-up bigger-120"></i>Détails
                           														</a>
                           													</div>
														</td>
													</tr>
													@endif
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>	
					</div><!-- /#feed -->
					<div id="friends" class="tab-pane">
						<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
							<div class="widget-box widget-color-blue" id="widget-box-2">
								<div class="widget-header">
									<h5 class="widget-title bigger lighter">
										<i class="ace-icon fa fa-table"></i>
										Liste Des RDV :
									</h5>
									<div class="widget-toolbar widget-toolbar-light no-border">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										<a href="#"><b>Ajouter Un RDV</b></a>
									</div>
								</div>
								<div class="widget-body">
									<div class="widget-main no-padding">
										<table class="table table-striped table-bordered table-hover">
											<thead class="thin-border-bottom">
												<tr>
													<th>Date RDV</th>
													<th>Nom Médcine Traitant</th>
													<th>Etat RDV</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												@foreach($rdvs as $rdv)
												@if($rdv->Patient_ID_Patient == $patient->id)
												<tr>
													<td>{{ $rdv->Date_RDV }}</td>
													<td>
														{{ App\modeles\employ::where("id",$rdv->Employe_ID_Employe)->get()->first()->Nom_Employe }}
														{{ App\modeles\employ::where("id",$rdv->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
													</td>
													<td class="center">
														<span class="label label-{{$rdv->Etat_RDV == "en attente" ? "warning" : "success"}}" style="color: black;">
															<b>{{ $rdv->Etat_RDV }}</b>
														</span>
													</td>
													<td class="center">
														<div class="hidden-sm hidden-xs btn-group">
                            								<a class="btn btn-xs btn-success" href="{{ route('rdv.show', $rdv->id) }}">
                                								<i class="ace-icon fa fa-hand-o-up bigger-120"></i>
                                								Détails
                           									</a>
                           								</div>
                           							</td>
												</tr>
												@endif
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /#friends -->
					<div id="pictures" class="tab-pane">
						<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
							<div class="widget-box widget-color-blue" id="widget-box-2">
								<div class="widget-header">
									<h5 class="widget-title bigger lighter">
										<i class="ace-icon fa fa-table"></i>
										Listes Des Hospitalisations :
									</h5>
								
								</div>
								<div class="widget-body">
									<div class="widget-main no-padding">
										<table class="table table-striped table-bordered table-hover">
											<thead class="thin-border-bottom">
												<tr>
													<th>Date d'entrée</th>				
													<th>date prévue de sortir</th>				
													<th>Date de sortir</th>
													<th></th>				
												</tr>
											</thead>
											<tbody>
												@foreach($hospitalisations as $hosp)
													<tr>
														<td>{{ $hosp->Date_entree }}</td>
														<td>{{ $hosp->Date_Prevu_Sortie }}</td>
														<td>{{ $hosp->Date_Sortie == null ? 'Pas Encore' : $hosp->Date_Sortie }}</td>
														<td></td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /#pictures -->
				</div>
			</div>
		</div>
	</div>
	<!-- Modal ramzi-->
	<div id="ticket" class="modal fade" role="dialog">
  		<div class="modal-dialog">
   			<!-- Modal content-->
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal">&times;</button>
    				<h4 class="modal-title">Ajouter Ticket :</h4>
    			</div>
    			<div class="modal-body">
    				<div class="row">
    					<div class="col-sm-12">
    						<div class="col-xs-6">
    							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
										<b> Nom: </b>
									</label>
									<div class="col-sm-9">
										<label>{{ $patient->Nom }}</label>
									</div>
								</div>
    						</div>
    						<div class="col-xs-6">
    							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
										<b> Prénom: </b>
									</label>
									<div class="col-sm-9">
										<label>{{ $patient->Prenom }}</label>
									</div>
								</div>
    						</div>
    						<div class="col-xs-6">
    							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
										<b> Age: </b>
									</label>
									<div class="col-sm-9">
										<label>{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</label>
									</div>
								</div>
    						</div>
    						<div class="col-xs-6">
    							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
										<b>Sexe:</b>
									</label>
									<div class="col-sm-9">
										<label>{{ $patient->Sexe =="M" ? "Masculin" : "Féminin" }}</label>
									</div>
								</div>
    						</div>
    						<br/><br/><br/><br/>
    						<form action="{{ route('ticket.store') }}" method="POST" role="form">
							{{ csrf_field() }}
							<input type="text" name="id_patient" value="{{ $patient->id }}" hidden>
    						<div class="col-sm-12">
								<label for="typecons"><b>Type de consultation:</b></label>
								<select class="form-control" id="typecons" name="typecons">
									<option value="">--------</option>
									<option value="Normale">Normale</option>
									<option value="Urgente">Urgente</option>
								</select>
							</div>
							<br/><br/><br/><br/>
    						<div class="col-sm-12">
								<label for="document"><b>Document:</b></label>
								<select class="form-control" id="document" name="document">
									<option value="">--------</option>
									<option value="Rendez-vous">Rendez-vous</option>
									<option value="Lettre d'orientation">Lettre d'orientation</option>
									<option value="Consultation généraliste">Consultation généraliste</option>
								</select>
							</div>
							<br/><br/><br/><br/>
    						<div class="col-sm-12">
								<label for="spesialite"><b>Spécialité:</b></label>
								<select class="form-control" id="spesialite" name="spesialite">
									<option value="0">Selectionner la spécialité</option>
									@foreach($specialites as $specialite)
									<option value="{{ $specialite->id}}"> {{ $specialite->nom}}</option>
									@endforeach
								</select>
							</div>
							<br/><br/><br/><br/><br/><br/>
    					</div>
    				</div>
    			<div class="modal-footer">

    				<button type="submit" class="btn btn-primary">
    					<i class="ace-icon fa fa-copy"></i>
    					Générer un ticket
    				</button>
    				<button type="button" class="btn btn-default" data-dismiss="modal">
    					<i class="ace-icon fa fa-plus bigger-110"></i>
    					Fermer
    				</button>
    			</div>
    		</div>
 	</div>
 	</form>
 	</div>

</div>
@endsection