@extends('app_recep')
@section('main-content')
<div class="page-header">
	<h1>Détails De La Demande d'hospitalisation :</h1>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="space-6"></div>
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="widget-box transparent">
						<div class="widget-header widget-header-large">
							<h3 class="widget-title grey lighter">
								<i class="ace-icon fa fa-leaf green"></i>
								Détails :
							</h3>
							<div class="widget-toolbar hidden-480">
								<a href="{{ route('demandehosp.index') }}">
									<i class="ace-icon fa fa-hand-o-left"></i>
									<strong>Liste Des Demandes</strong>
								</a>
								&nbsp;&nbsp;&nbsp;
								@if(Auth::User()->employee_id == $demande->Employe_ID_Employe)
								<a href="{{ route('demandehosp.edit',$demande->id) }}">
									<i class="ace-icon fa fa-pencil-square-o"></i>
									<strong>Modifier</strong>
								</a>
								&nbsp;&nbsp;&nbsp;
								@endif
								<a href="#">
									<i class="ace-icon fa fa-print"></i>
									<strong>Imprimer</strong>
								</a>
							</div>
						</div>
						<div class="widget-body">
							<div class="widget-main padding-24">
								<div class="row">
									<div class="col-sm-6">
										<div class="row">
											<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
												<b>Les Informations Du Patient :</b>
											</div>
										</div>
										<div>
											<ul class="list-unstyled spaced">
												<li>
													<i class="ace-icon fa fa-caret-right blue"></i><strong>Nom :</strong>
													<b class="green">{{ $patient->Nom }}</b>
												</li>
												<li>
													<i class="ace-icon fa fa-caret-right blue"></i><strong>Prénom :</strong>
													<b class="green">{{ $patient->Prenom }}</b>
												</li>
												<li>
													<i class="ace-icon fa fa-caret-right blue"></i><strong>Date Naissance :</strong>
													<b class="green">{{ $patient->Dat_Naissance }}</b>
												</li>
												<li>
													<i class="ace-icon fa fa-caret-right blue"></i>
													<strong>Sexe :</strong>
													<b class="green">{{ $patient->Sexe == "F" ? "Femme" : "Homme" }}</b>
												</li>
												<li class="divider"></li>
												<li>
													<i class="ace-icon fa fa-caret-right blue"></i>
													<strong>Age :</strong>
													<b class="green">{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</b>
												</li>
											</ul>
										</div>
									</div><!-- /.col -->
									<div class="col-sm-6">
										<div class="row">
											<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
												<b>Les Informations De La Demande :</b>
											</div>
										</div>
										<div>
											<ul class="list-unstyled  spaced">
												<li>
													<i class="ace-icon fa fa-caret-right green"></i><strong>Motif :</strong>
													<b class="blue">{{ $demande->motif }}</b>
												</li>
												<li>
													<i class="ace-icon fa fa-caret-right green"></i><strong>Date Consultation :</strong>
													<b class="blue">{{ $consultation->Date_Consultation }}</b>
												</li>
												<li>
													<i class="ace-icon fa fa-caret-right green"></i><strong>Date Demande :</strong>
													<b class="blue">{{ $demande->Date_demande }}</b>
												</li>
													<li>
													<i class="ace-icon fa fa-caret-right green"></i><strong>Service :</strong>
													<b class="blue">{{ $demande->service }}</b>
												</li>
												<li>
													<i class="ace-icon fa fa-caret-right green"></i><strong>Degrée D'urgence :</strong>
													<b class="blue">{{ $demande->degree_urgence }}</b>
												</li>
												<li class="divider"></li>
												<li>
													<i class="ace-icon fa fa-caret-right green"></i>
													<strong>Nom De medcin traitant :</strong>
													<b class="blue">
												{{ App\modeles\employ::where("id",$consultation->Employe_ID_Employe)->get()->first()->Nom_Employe }}
												{{ App\modeles\employ::where("id",$consultation->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
													</b>
												</li>
											</ul>
										</div>
									</div><!-- /.col -->
								</div><!-- /.row -->
								<div class="row">
									<div class="col-sm-12 widget-container-col" id="widget-container-col-12">
										<div class="widget-box transparent" id="widget-box-12">
											<div class="widget-header">
												<h4 class="widget-title lighter"><strong>Description :</strong></h4>
											</div>
											<div class="widget-body">
												<div class="widget-main padding-6 no-padding-left no-padding-right">
													<p>
														{{ $demande->description }}
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

@endsection