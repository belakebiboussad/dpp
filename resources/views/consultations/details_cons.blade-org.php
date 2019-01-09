@extends('app_med')
@section('main-content')
<div class="page-header">
	<h1><strong>Détails du Consultation Pour :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Informations Patient :</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<label class="inline">
						<span class="blue"><strong>Nom :</strong></span>
						<span class="lbl"> {{ $patient->Nom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Prénom :</strong></span>
						<span class="lbl"> {{ $patient->Prenom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Sexe :</strong></span>
						<span class="lbl"> {{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Date Naissance :</strong></span>
						<span class="lbl"> {{ $patient->Dat_Naissance }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Age :</strong></span>
						<span class="lbl"> {{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</span>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Détails de La Consultation :</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div id="user-profile-1" class="user-profile row">
						<div class="col-xs-12 col-sm-3 center">
							<div class="profile-contact-info">
								<div class="profile-contact-links align-left">
									<a data-toggle="modal" data-target="#ordModal" class="btn btn-link">
										<i class="ace-icon fa fa-file-archive-o bigger-120 green"></i>
										<b>Liste des Ordonnances</b>
									</a>
								</div>
								<div class="space-6"></div>	
							</div>
							<div class="profile-contact-info">
								<div class="profile-contact-links align-left">
									<a data-toggle="modal" data-target="#exclinModal" class="btn btn-link">
										<i class="ace-icon fa fa-file-archive-o bigger-120 blue"></i>
										<b>Examen Clinique</b>
									</a>
									<a data-toggle="modal" data-target="#exbioModal" class="btn btn-link">
										<i class="ace-icon fa fa-file-archive-o bigger-120 blue"></i>
										<b>Liste des Examens Biologiques</b>
									</a>
									<a data-toggle="modal" data-target="#exmimgModal" class="btn btn-link">
										<i class="ace-icon fa fa-file-archive-o bigger-120 blue"></i>
										<b>Liste des Examens Imagries</b>
									</a>
									<a href="#" class="btn btn-link">
										<i class="ace-icon fa fa-file-archive-o bigger-120 blue"></i>
										<b>Liste des Demandes de Transfert</b>
									</a>
									<a href="#" class="btn btn-link">
										<i class="ace-icon fa fa-file-archive-o bigger-120 blue"></i>
										<b>Liste des Lettres D'orientation</b>
									</a>
								</div>
								<div class="space-6"></div>	
							</div>
							<div class="hr hr12 dotted"></div>
						</div>
						<div class="col-xs-12 col-sm-9">
							<div class="profile-user-info profile-user-info-striped">
								<div class="profile-info-row">
									<div class="profile-info-name">Nom Médecin :</div>
									<div class="profile-info-value">
										<span class="editable" id="username">
											<strong>
											{{ App\modeles\employ::where("id",$consultation->Employe_ID_Employe)->get()->first()->Nom_Employe }}
											{{ App\modeles\employ::where("id",$consultation->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
											</strong>
										</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Motif : </div>
									<div class="profile-info-value">
										<span class="editable" id="city">
											<strong>{{ $consultation->Motif_Consultation }}</strong>
										</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Date : </div>
									<div class="profile-info-value">
										<span class="editable" id="city">
											<strong>{{ $consultation->Date_Consultation }}</strong>
										</span>
									</div>
								</div>
								<div class="profile-info-row">
									<div class="profile-info-name"> Lieu : </div>
									<div class="profile-info-value">
										<span class="editable" id="city">
											<strong>
												{{ App\modeles\Lieuconsultation::where("id",$consultation->id_lieu)->get()->first()->Nom }}
											</strong>
										</span>
									</div>
								</div>
							</div>
							<div class="space-6"></div>
							<div class="widget-box transparent">
								<div class="widget-body">
									<div class="widget-main padding-8">
										<div id="profile-feed-1" class="profile-feed">
											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon fa fa-h-square btn-info no-hover"></i>
													<span><strong> Histoire De La Maladie : </strong></span>
													<p style="text-align: justify;">
														{{ $consultation->histoire_maladie }}
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="space-4"></div>
							<div class="widget-box transparent">
								<div class="widget-body">
									<div class="widget-main padding-8">
										<div id="profile-feed-1" class="profile-feed">
											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon fa fa-stethoscope btn-info no-hover"></i>
													<span><strong> Diagnostic : </strong></span>
													<p style="text-align: justify;">
														{{ $consultation->Diagnostic }}
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="space-4"></div>
							<div class="widget-box transparent">
								<div class="widget-body">
									<div class="widget-main padding-8">
										<div id="profile-feed-1" class="profile-feed">
											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon fa fa-file btn-info no-hover"></i>
													<span><strong> Resumé : </strong></span>
													<p style="text-align: justify;">
														{{ $consultation->Resume_OBS }}
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
<!-- Modal -->
<div id="exbioModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Liste des Examens Biologiques :</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<table id="simple-table" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th>Type</th>
									<th>Date</th>
									<th>Description</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($examensbios as $exbio)
									<tr>
										<td>{{ $exbio->type }}</td>
										<td>{{ $exbio->Date }}</td>
										<td>{{ $exbio->description }}</td>
										<td>
											<a href="/exbio/{{$exbio->lien}}" target="_blank" class="btn btn-xs btn-success">
												<i class="ace-icon fa fa-hand-o-up bigger-120"></i>
												<strong>Voir l'examen</strong>
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div id="exmimgModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Liste des Examens Imagrie :</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<table id="simple-table" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th>Type</th>
									<th>Nom</th>
									<th>Date</th>
									<th>Description</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($examensimg as $exmimg)
									<tr>
										<td>{{ $exmimg->type }}</td>
										<td>{{ $exmimg->nom }}</td>
										<td>{{ $exmimg->date }}</td>
										<td>{{ $exmimg->description }}</td>
										<td>
											<a href="/exbio/{{$exmimg->lien}}" target="_blank" class="btn btn-xs btn-success">
												<i class="ace-icon fa fa-hand-o-up bigger-120"></i>
												<strong>Voir l'examen</strong>
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div id="exclinModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Détails de l'Examen Clinique :</h4>
			</div>
			<div class="modal-body">
				@if($exmclin != null)
				<div class="row">
					<div class="col-xs-12">
						<div class="col-xs-4">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
							 		<strong>Taille </strong> 
								</label>
								<div class="col-sm-8">
									{{ $exmclin->taille }} m
								</div>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
							 		<strong>Poids </strong> 
								</label>
								<div class="col-sm-8">
									{{ $exmclin->poids }} Kg
								</div>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
							 		<strong>IMC </strong> 
								</label>
								<div class="col-sm-8">
									{{ $exmclin->IMC }}
								</div>
							</div>
						</div>
						<br><br>
						<div class="col-xs-12">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
							 		<strong>Etat </strong> 
								</label>
								<div class="col-sm-8">
									<p>{{ $exmclin->Etat }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				@else
					<p>Pas d'Examen Clinique</p>
				@endif
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div id="ordModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Liste Des Ordennance :</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 
								<strong>Date :</strong>
							</label>
							<div class="col-sm-9">
								<span class="form-control blue">{{ $ordennances->date }}</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 
								<strong>Durée :</strong>
							</label>
							<div class="col-sm-9">
								<span class="form-control blue">{{ $ordennances->duree }}</span>
							</div>
						</div>
						<br/><br/><br/>
						<div class="form-group">
							<div class="col-sm-12">
								@foreach($medicaments as $key =>$value)
									<label>{{ $value }}</label>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection