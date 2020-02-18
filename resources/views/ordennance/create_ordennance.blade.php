@extends('app')
@section('main-content')
<div class="page-header">
<h1><strong>Détails du Consultation Pour :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<table id="medc_table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="hidden-480">Médicament</th>
										<th class="hidden-480">Forme</th>
										<th class="hidden-480">Dosage</th>
										<th class="hidden-480"></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<div  class="col-xs-9">
								<label for="form-field-8">
									<strong>Médicament</strong>
								</label>
								<input id="nommedic" class="form-control" type="text"  placeholder="Médicament"/>
							</div>
							<div  class="col-xs-3">
								<label for="form-field-8">
									<strong>Présentation</strong>	
								</label>
								<input id="forme" class="form-control" type="text"  placeholder="Forme"/>
							</div>
							<br/><br/><br/><br/>
							<div  class="col-xs-3">
								<label for="form-field-8">
									<strong>Qte</strong>
								</label>
								<input id="qte" class="form-control" type="number"/>
							</div>
							<div class="col-xs-9">
								<label>
									<strong>Nombre de Prise</strong>
								</label>
								<br>
								<div class="col-xs-2">
									<input id="nbprise" class="form-control" type="number"/>
								</div>
								<div class="col-xs-4">
									<input class="form-control"  type="text" value="Fois Par" />
								</div>
								<div class="col-xs-4">
									<select id="fois" class="form-control" id="form-field-select-3">
										<option value="">Choose...</option>
										<option value="jour">jour</option>
										<option value="Semaine">Semaine</option>
										<option value="Mois">Mois</option>
									</select>
								</div>
							</div>
							<br/><br/><br/><br/>
							<div class="col-xs-7">
								<label>
									<strong>Pendant</strong>
								</label>
								<br/>
								<div class="col-xs-3">
									<input id="duree" class="form-control" type="number"/>
								</div>
								<div class="col-xs-4">
									<select id="dureefois" class="form-control" id="form-field-select-3">
										<option value="">Choose...</option>
										<option value="jour">jour</option>
										<option value="Semaine">Semaine</option>
										<option value="Mois">Mois</option>
									</select>
								</div>
							</div>
							<div>
							<div class="col-xs-3">
								<label for="form-field-8">
									<strong>à prendre</strong>
								</label>
								<select id="temps" class="form-control" id="form-field-select-3">
									<option value="">Choose...</option>
									<option value="Le matin">Le matin</option>
									<option value="à midi">à midi</option>
									<option value="Le Soir">Le Soir</option>
								</select>
							</div>
							<br/><br/><br/><br/>
							<div class="col-xs-12">
								<label for="form-field-8">
									<strong>Posologie</strong>
								</label>
								<button class="label label-success label-white middle" onclick="posologiefun()">
									<i class="fa fa-check-square-o" aria-hidden="true"></i>
									 Générer automatiquement
								</button>
								<input id="pos" type="text"  class="form-control">
							</div>
							<div>
								<br/><br/><br/><br/>
								<button class="btn btn-success" onclick="addmidifun()">Ajouter Médicament</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">Ordonnance :</h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
					<button type="button" onclick="supcolonne()" class="btn btn-white btn-danger btn-sm">
						<i class="ace-icon fa fa-trash-o bigger-120 orange"></i>
					</button>
					<button type="button" class="btn btn-white btn-purple btn-sm">
						<i class="ace-icon fa fa-pencil bigger-120 green"></i>
					</button>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<div class="widget-box">
								<div class="widget-body">
									<div class="widget-main">
										<div class="row">
											<div class="col-xs-12">
												<div class="col-xs-3">
													<form id="ordonnace_form" method="POST" action="{{ route('ordonnace.store') }}">
													{{ csrf_field() }}
													<input type="text" name="idcons" value="{{ $consultation->id }}" hidden>
													<label><strong>Date Ordonnance :</strong></label>
													<div class="input-group">
														<input id="dateord" name="dateord" class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="yyyy-mm-dd" />
														<span class="input-group-addon">
															<i class="fa fa-calendar bigger-110"></i>
														</span>
													</div>
												</div>
												<div class="col-xs-9">
													<label for="form-field-8">
														<strong>Pendant</strong>
													</label>
													<br/>
													<div class="col-xs-2">
														<input class="form-control" name="dureeefois" type="number"/>
													</div>
													<div class="col-xs-3">
														<select class="form-control" id="foisss" name="foisss">
															<option value="">Choose...</option>
															<option value="jour">jour</option>
															<option value="Semaine">Semaine</option>
															<option value="Mois">Mois</option>
														</select>
													</div>
												</div>
											</div>
										</div>			
									</div>
								</div>
							</div>
							<table id="ordonnance" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th></th>
										<th>Médicament</th>
										<th>Forme</th>
										<th>Quantité</th>
										<th>Posologie</th>
									</tr>
								</thead>
							</table>
							</form>
							<div class="pull-right">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ord" onclick="createord('{{ $patient->Nom }} {{ $patient->Prenom }}','{{ Auth::User()->employ->Nom_Employe }} {{ Auth::User()->employ->Prenom_Employe }}')">
									Terminer
								</button>
							</div>
						</div>
					</div>			
				</div>
			</div>
		</div>
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
</div>
<div id="ord" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Ordonnance :</b></h4>
			</div>
			<div class="modal-body">
				<iframe id="ordpdf1" class="preview-pane" type="application/pdf" width="100%" height="500" frameborder="0" style="position:relative;z-index:999"></iframe>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="storeord()">Enregistrer</button>
				<button type="button" class="btn btn-success" data-dismiss="modal">Enregistrer et Imprimer</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection