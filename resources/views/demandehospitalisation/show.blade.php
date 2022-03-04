@extends('app')
@section('main-content')
<div class="page-header"><h1>Détails de la demande d'hospitalisation :</h1></div>
<div class="row">
	<div class="col-xs-12">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-large">
						<h3 class="widget-title grey lighter"><i class="ace-icon fa fa-leaf green"></i>Détails :</h3>
						<div class="widget-toolbar hidden-480">
						@if( Auth::user()->role->id == 1)
							<a href="{{ route('demandehosp.index') }}"><i class="ace-icon fa fa-hand-o-left"></i><strong>Liste des demandes</strong></a>
						@endif
						&nbsp;&nbsp;&nbsp;
						@if(Auth::User()->employee_id == $demande->employ_id)
							<a href="{{ route('demandehosp.edit',$demande->id) }}"><i class="ace-icon fa fa-pencil-square-o"></i><strong>Modifier</strong></a>
								&nbsp;&nbsp;&nbsp;
						@endif
						<a href="#"><i class="ace-icon fa fa-print"></i><strong>Imprimer</strong></a>
						</div>
					</div>
					<div class="widget-body">
						<div class="widget-main padding-24">
							<div class="row">
								<div class="col-sm-6">
								<div class="row"><div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right"><b>Les informations du patient :</b></div></div>
								<div>
									<ul class="list-unstyled spaced">
										<li>
											<i class="ace-icon fa fa-caret-right blue"></i><strong>Nom :</strong><b class="green">{{ $demande->consultation->patient->Nom }}</b>
										</li>
										<li>
										<i class="ace-icon fa fa-caret-right blue"></i><strong>Prénom :</strong><b class="green">{{ $demande->consultation->patient->Prenom }}</b>
										</li>
										<li>
											<i class="ace-icon fa fa-caret-right blue"></i><strong>Date de naissance :</strong><b class="green">{{ $demande->consultation->patient->Dat_Naissance }}</b>
										</li>
										<li>
											<i class="ace-icon fa fa-caret-right blue"></i>
											<strong>Genre :</strong><b class="green">{{ $demande->consultation->patient->Sexe == "F" ? "Féminin" : "Masculin" }}</b>
									       </li>
										<li class="divider"></li>
										<li>
											<i class="ace-icon fa fa-caret-right blue"></i>
											<strong>Age :</strong><b class="green">{{ $demande->consultation->patient->age }} ans</b>
										</li>
									</ul>
								</div>
							       </div><!-- /.col -->
								<div class="col-sm-6">
								<div class="row">
									<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><b>Les informations de la demande :</b></div>
								</div>
								<div>
								<ul class="list-unstyled  spaced">
									<li>
										<i class="ace-icon fa fa-caret-right green"></i><strong>Motif de consultation:</strong>
										<b class="blue">{{ $demande->consultation->motif }}</b>
									</li>
									<li>
										<i class="ace-icon fa fa-caret-right green"></i><strong>Date de consultation :</strong>
													<b class="blue">{{ $demande->consultation->date }}</b>
												</li>
												<li>
													<i class="ace-icon fa fa-caret-right green"></i><strong>Service :</strong>
													<b class="blue">{{ $demande->Service->nom }}</b>
												</li>
												<li>
													<i class="ace-icon fa fa-caret-right green"></i><strong>Spécialité :</strong>
													<b class="blue">{{ $demande->Specialite->nom }}</b>
												</li>
												<li class="divider"></li>
												<li>
													<i class="ace-icon fa fa-caret-right green"></i>
													<strong>Nom du médecin traitant :</strong>
													<b class="blue">{{ $demande->consultation->docteur->full_name}}</b>
												</li>
											</ul>
										</div>
									</div><!-- /.col -->
								</div><!-- /.row -->
							</div>
					</div>
				</div>
			</div>
	</div>
</div>
@endsection