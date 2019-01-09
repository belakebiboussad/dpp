@extends('app_med')
@section('main-content')
<div class="page-content">
	<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-12">
				<div class="center">
					<h1 class="blue">
						Bienvenue
						{{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe }}
					{{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}}
					</h1>
				</div>
				<br>
				<div class="col-sm-6">
					<h4 class="blue" style="display: inline;">Rechercher un patient :</h4>
					<div class="pull-right" style="display: inline;">
						<input type="text" class="input-sm" id="search" name="search" placeholder="Rechercher...">
						<select id="param" name="param">
							<option value= "0">Code patient</option>
							<option value= "1">Nom</option>
							<option value= "2">Prénom</option>
							<option value= "3">Date Naissance</option>
						</select>
					</div>
					<hr>
					<table id="patients_liste" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th hidden>code</th>
								<th>Nom</th>
								<th>Prénom</th>
								<th>Date Naissance</th>
								<th>Sexe</th>
								<th>Age</th>
								<th>Type</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($patients as $patient)
								<tr >
									<td hidden>{{ $patient->code_barre }}</td>
									<td>{{ $patient->Nom }}</td>
									<td>{{ $patient->Prenom }}</td>
									<td>{{ $patient->Dat_Naissance }}</td>
									<td>{{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</td>
									<td>{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</td>
									<td>{{ $patient->Type }}</td>
									<td class="center">
										<a href="{{route('patient.show', $patient->id)}}" class="btn btn-white btn-pink btn-sm">
											<i class="ace-icon fa fa-hand-o-up bigger-120"></i>
											Détails
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<div class="hr hr8 hr-double hr-dotted"></div>
					<div class="row">
					 	<div class="col-sm-5 pull-right">
							<span class="pull-right">
								<b>Nombre Total des Patients :</b>
								<span class="red">{{ App\modeles\patient::all()->count() }}</span>
							</span>
						</div>
						<div class="col-sm-7 pull-left"> 
							<b>Nombre des Ayant droit :</b> 
							<span class="blue">
								{{ App\modeles\patient::where("Type","Ayant droit")->get()->count() }}
							</span>
							&nbsp;&nbsp;&nbsp;
							<b>Nombre des assuré :</b>
							<span class="blue">
								{{ App\modeles\patient::where("Type","Fonctionnaire")->get()->count() }}
							</span>
						</div>
					</div>
				</div>
				<br><br>
				<div class="col-sm-6">
					<h4 class="blue">Actualités :</h4>
					<hr>
					<div class="widget-box" id="widget-box-10">
						<div class="widget-header widget-header-small">
							<div class="widget-toolbar no-border">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active">
										<a data-toggle="tab" href="#rdv">
											<i class="blue ace-icon fa fa-calendar-o bigger-120"></i>
											<b>Rendez-vous</b>
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="#consutation">
											<i class="green ace-icon fa fa-stethoscope bigger-120"></i>
											<b>Consultations</b>
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="#hospitalisation">
											<i class="red ace-icon fa fa-h-square bigger-120"></i>
											<b>Hospitalisations</b>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main padding-6">
								<div class="tab-content">
									<div id="rdv" class="tab-pane in active">
										<div class="row">
											<div class="col-sm-12">
												<div class="col-sm-12">
													<span class="red">
														<b>Vous avez {{ $rdvs->count() }} rendez vous aujourd'hui.</b>
													</span>
												</div>
												<br><br>
												<div>
													<h5 class="blue">
														<b>Liste des rendez-vous d'aujourd'hui :</b>
													</h5>
													<hr>
													<table class="table table-striped table-bordered">
														<thead>
															<tr>
																<th>Order</th>
																<th>Patient</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
															@foreach($rdvs as $rdv)
															<tr>
																<td>{{ $rdv->num_order }}</td>
																<td>
																	{{ App\modeles\patient::where("id",$rdv->id_patient)->get()->first()->Nom }}
																	 {{ App\modeles\patient::where("id",$rdv->id_patient)->get()->first()->Prenom }}
																</td>
																<td class="center">
																	<a href="{{ route("patient.show", $rdv->id_patient) }}" class="btn btn-white btn-inverse btn-sm">Détails</a>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div id="consutation" class="tab-pane">
										<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
									</div>
									<div id="hospitalisation" class="tab-pane">
										<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection