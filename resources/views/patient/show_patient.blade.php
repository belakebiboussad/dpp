@extends('app')
@section('page-script')
<script type="text/javascript">
	$('document').ready(function(){
		var table = $('#consultList').DataTable({
       "searching":false,
       "processing": true,
        "scrollY":"450px",
        "scrollCollapse": true,
        "paging":false,
        "language": {
            "url": '/localisation/fr_FR.json'
        },      
      });
      $('#consultList tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
      });
	});
</script>
@endsection
@section('main-content')
	<div >@include('patient._patientInfo')</div>
	<div class="page-header">
		<div class="pull-right">
			<a href="{{ route('patient.index') }}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-search bigger-120 blue"></i>Chercher
			</a>
			<a href="{{route('patient.destroy',$patient->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-white btn-warning btn-bold">
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
							<i class="green ace-icon fa fa-user bigger-120"></i>	Informations Administratives
						</a>
					</li>
					@if( Auth::user()->role->id == 1)
					 <li>
					 	<a data-toggle="tab" href="#Ants">
					 		<i class="fa fa-history fa-1x"></i>&nbsp;<span>Antecedants</span>&nbsp;<span class="badge badge-primary">{{$patient->antecedants->count() }}
							</span>
					 	</a>
					 </li>
					<li>
						<a data-toggle="tab" href="#Cons">
							<i class="orange ace-icon fa fa-stethoscope bigger-120"></i>Consultations&nbsp;
							<span class="badge badge-warning">{{ $patient->consultations->count() }}</span>
						</a>
					</li>
					<li>
					<a data-toggle="tab" href="#Hosp">
						<i class="pink ace-icon fa fa-h-square bigger-120"></i>
						Hospitalisations&nbsp;<span class="badge badge-pink">{{ $patient->hospitalisations->count() }}</span>
						</a>
					</li>
					@endif
					<li>
						<a data-toggle="tab" href="#rdvs">
							<i class="blue ace-icon fa fa-calendar-o bigger-120"></i>
							RDV&nbsp;<span class="badge badge-info">{{ $patient->rdvs->count() }}</span>
						</a>
					</li>
					@if (!is_null($correspondants))
					<li >
						<a data-toggle="tab" href="#homme_conf"><i class="green ace-icon fa fa-user bigger-120"></i>Homme de confiance</a>
					</li>
					@endif
				</ul>
				<div class="tab-content no-border padding-24">
					<div id="home" class="tab-pane in active">
						<div class="row">
							<div class="col-xs-12 col-sm-3 center">
								<span class="profile-picture">
									<img class="editable img-responsive" alt="Avatar" id="avatar2" src="{{asset('/avatars/profile-pic.jpg')}}" />
								</span>
								<div class="space space-4"></div>
								<a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-sm btn-block btn-success">
									<i class="ace-icon fa fa-pencil bigger-120"></i><span class="bigger-110">Modifier Les Informations</span>
								</a>
								<a class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#ticket">
									<i class="ace-icon fa fa-plus bigger-120"></i><span class="bigger-110">Ajouter Ticket</span>
								</a>
							</div><!-- /.col -->
							<div class="col-xs-12 col-sm-9">
								<h4 class="blue">
									<span class="middle">{{ $patient->getCivilite()}} {{ $patient->Nom }} {{ $patient->Prenom }}</span>
									<span class="label label-purple arrowed-in-right">
										<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>	{{ $patient->Type }}
									</span>
								</h4>
								<div class="profile-user-info">
									<div class="profile-info-row">
										<div class="profile-info-name">Nom</div>
										<div class="profile-info-value"><span>{{ $patient->Nom }}</span></div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Prénom</div>
										<div class="profile-info-value"><span>{{ $patient->Prenom }}</span></div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Sexe </div>
										<div class="profile-info-value">	<span>{{ $patient->Sexe =="M" ? "Homme" : "Femme" }}</span></div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">né(e) le  </div>
										<div class="profile-info-value"><span>{{ $patient->Dat_Naissance }}</span></div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Âge </div>
										<div class="numberCircle">{{ $patient->getAge() }}</div> <span class="blue">Ans</span>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Lieu Naissance </div>
										<div class="profile-info-value">
											<i class="fa fa-map-marker light-orange bigger-110"></i><span>{{ $patient->lieuNaissance->nom_commune }}</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Civilité </div>
										<div class="profile-info-value"><span>{{ $patient->situation_familiale }}</span></div>
									</div>
									@if(($patient->Sexe =="F") && ($patient->situation_familiale == "marie"))
									<div class="profile-info-row">
										<div class="profile-info-name"> Nom Fille </div>
										<div class="profile-info-value"><span>{{ $patient->nom_jeune_fille }}</span></div>
									</div>
									@endif
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
										<div class="profile-info-value"><span>{{ $patient->tele_mobile1 }}</span></div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"><i class="fa fa-phone"></i>Télé mobile 2 </div>
										<div class="profile-info-value"><span>{{ $patient->tele_mobile2 }}</span></div>
									</div>
									@if($patient->Fonction != null)
									<div class="profile-info-row">
										<div class="profile-info-name"> Service </div>
										<div class="profile-info-value"><span>{{ $patient->Fonction }}</span></div>
									</div>
									@endif
									@if($patient->Grade != null)
									<div class="profile-info-row">
										<div class="profile-info-name"> Grade </div>
										<div class="profile-info-value"><span>{{ $patient->Grade }}</span></div>
									</div>
									@endif
									@if($patient->etat != null)
									<div class="profile-info-row">
										<div class="profile-info-name"> Etat </div>
										<div class="profile-info-value"><span>{{ $patient->etat }}</span></div>
									</div>
									@endif
									<div class="profile-info-row">
										<div class="profile-info-name"> Groupe Sang</div>
										<div class="profile-info-value"><span>{{ $patient->group_sang }}</span></div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Rhésus </div>
										<div class="profile-info-value"><span>{{ $patient->Rihesus == "+" ? "Positif" : "Négatif" }}</span></div>
									</div>
									@if($patient->matricule != null)
									<div class="profile-info-row">
										<div class="profile-info-name">Matricule</div>
										<div class="profile-info-value"><span>{{ $patient->matricule }}</span></div>
									</div>
									@endif
									<div class="profile-info-row">
										<div class="profile-info-name">Date Création</div>
										<div class="profile-info-value"><span>{{ $patient->Date_creation }}</span></div>
									</div>
								</div>
								<div class="hr hr-8 dotted"></div>
								@if($patient->Type == "Ayant_droit")
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
															<span class="lbl blue"> {{ $patient->assure->Nom}} </span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Prénom :</b></span>
															<span class="lbl blue"> {{ $patient->assure->Prenom}} </span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Date de naissance :</b></span>
															<span class="lbl blue"> {{ $patient->assure->Date_Naissance }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Lieu de naissance :</b></span>
															<span class="lbl blue">{{ $patient->assure->commune->nom_commune}} </span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Sexe :</b></span>
															<span class="lbl blue"> {{ $patient->assure->Sexe == "H" ? "Masculin" : "Féminin" }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Matricule :</b></span>
															<span class="lbl blue"> {{ $patient->assure->Matricule }}</span>
														</label>
													</div>
													<div class="col-sm-6">
														<label class="inline">
															<span><b>Service :</b></span><span class="lbl blue"> {{ $patient->assure->Service }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Grade :</b></span>	<span class="lbl blue"> {{ $patient->assure->grade->nom }}</span>
														</label>
													</div>
													<div class="col-sm-3">
														<label class="inline">
															<span><b>Etat :</b></span>
															<span class="lbl blue"> {{ $patient->assure->Etat }}</span>
														</label>
													</div>
													<div class="col-sm-6">
														<label class="inline">
															<span><b>N° sécurité sociale :</b></span>
															<span class="lbl blue"> {{ $patient->assure->NSS }}</span>
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
					<div id="Ants" class="tab-pane">@include('antecedents.ants_Widget')</div><!-- Ants -->
					<div id="Cons" class="tab-pane">@include('consultations.liste')</div><!-- /#Cons -->
					<div id="rdvs" class="tab-pane">
						<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
							<div class="widget-box widget-color-blue" id="widget-box-2">
								<div class="widget-header">
									<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste Des RDV :</h5>
									<div class="widget-toolbar widget-toolbar-light no-border">
										<div class="fa fa-plus-circle"></div><a href="#"><b>Ajouter un RDV</b></a>
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
												@if($patient->rdvs->count() > 0)
													@foreach($patient->rdvs as $rdv)
														<tr>
															<td>{{ $rdv->Date_RDV }}</td>
															<td>
																{{ $rdv->employe->Nom_Employe }} {{ $rdv->employe->Prenom_Employe }}
															</td>
															<td class="center">
																<span class="label label-{{$rdv->Etat_RDV == "en attente" ? "warning" : "success"}}" style="color: black;">	<b>{{ $rdv->Etat_RDV }}</b></span>
															</td>
															<td class="center">
																<div class="hidden-sm hidden-xs btn-group">
												                            		<a class="btn btn-xs btn-success" href="{{ route('rdv.show', $rdv->id) }}">
												                              	<i class="ace-icon fa fa-hand-o-up bigger-120"></i>Détails</a>
																</div>
											                           </td>
														</tr>
													@endforeach
												@endif
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /#rdvs -->
					<div id="Hosp" class="tab-pane">
						<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
							<div class="widget-box widget-color-blue" id="widget-box-2">
								<div class="widget-header">
									<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Listes Des Hospitalisations :</h5>
								</div>
								<div class="widget-body">
									<div class="widget-main no-padding">
										<table class="table table-striped table-bordered table-hover">
											<thead class="thin-border-bottom">
												<tr>
													<th><strong>Medecin Traitant</strong></th>
													<th><strong>Date d'entrée</strong></th>				
													<th><strong>date de sortie prévue</strong></th>				
													<th><strong>Date de sortie</strong></th>
													<th><strong>Service</strong></th>
													<th><strong>Salle</strong></th>
													<th><strong>lit</strong></th>
													<th><strong>Etat</strong></th>
													<th><em class="fa fa-cog"></em></th>				
												</tr>
											</thead>
											<tbody>
												@foreach($patient->hospitalisations as $hosp)
												<tr>
													<td>{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->Nom_Employe }}
						  						</td>
													<td>{{ $hosp->Date_entree }}</td>
													<td>{{ $hosp->Date_Prevu_Sortie }}</td>
													<td>{{ $hosp->Date_Sortie == null ? '/' : $hosp->Date_Sortie }}</td>
													<td></td>
													<td></td>
													<td></td>
													<td><span class="badge badge-danger">{{ $hosp->etat_hosp }}</span> </td>
													<td></td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /#Hos^p -->
					<div id="homme_conf" class="tab-pane"><!--homme_conf -->
						<div class="row">@include('corespondants.widget')</div>
						<div class="row">@include('corespondants.add')</div>
					</div><!-- /#homme_conf -->	
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
    				<h4 class="modal-title"><strong>Ajouter Ticket:</strong></h4>
    			</div>
    			<div class="modal-body">
    				<div class="row">
    					<div class="col-sm-12">
    						<form action="{{ route('ticket.store') }}" method="POST" role="form">
							{{ csrf_field() }}
							<input type="text" name="id_patient" value="{{ $patient->id }}" hidden>
    						<div class="col-sm-12">
								<label for="typecons"><b>Type de consultation:</b></label>
								<select class="form-control" id="typecons" name="typecons" required>
								<!-- 	<option value="">--------</option> -->
									<option value="Normale">Normale</option>
									<option value="Urgente">Urgente</option>
								</select>
							</div>
							<br/><br/><br/><br/>
    						<div class="col-sm-12">
							<label for="document"><b>Document:</b></label>
							<select class="form-control" id="document" name="document" required>
								<option value="Rendez-vous">Rendez-vous</option><!-- 	<option value="">--------</option> -->
								<option value="Lettre d'orientation">Lettre d'orientation</option>
								<option value="Consultation généraliste">Consultation généraliste</option>
							</select>
						</div><br/><br/><br/><br/>
						<div class="col-sm-12">
							<label for="spesialite"><b>Spécialité:</b></label>
							<select class="form-control" id="spesialite" name="spesialite">
								<option value="0">Selectionner la spécialité</option>
								@foreach($specialites as $specialite)
								<option value="{{ $specialite->id}}"> {{ $specialite->nom}}</option>
								@endforeach
							</select>
						</div><br/><br/><br/><br/><br/><br/>	
    					</div>
    				</div>
    			<div class="modal-footer">
    				<button type="submit" class="btn btn-primary">
    					<i class="ace-icon fa fa-copy"></i>Générer un ticket	
    				</button>
    				<button type="button" class="btn btn-default" data-dismiss="modal">
    					<i class="ace-icon fa fa-close bigger-110"></i>Fermer
    				</button>
    			</div>
    		</div>
 	</div>
 	</form>
 	</div>
</div>
@endsection