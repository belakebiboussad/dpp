@extends('app_recep')
@section('main-content')
<div class="row">
	<div class="col-xs-12">
		<div class="space-6"></div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-large">
						<h3 class="widget-title grey lighter">
							<i class="ace-icon fa fa-heartbeat green"></i>
							Détails du l'antécédants :
						</h3>
					</div>
					<div class="widget-body">
						<div class="widget-main padding-24">
							<div class="row">
								<div class="col-sm-6">
									<div class="row">
										<div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
											<b>Info du patients</b>
										</div>
									</div>
									<div>
										<ul class="list-unstyled spaced">
											<li>
												<i class="ace-icon fa fa-caret-right blue"></i><strong>Nom :</strong>
												<b class="blue">{{ $patient->Nom }}</b>
											</li>
											<li>
												<i class="ace-icon fa fa-caret-right blue"></i><strong>Prénom :</strong>
												<b class="blue">{{ $patient->Prenom }}</b> 
											</li>
											<li>
												<i class="ace-icon fa fa-caret-right blue"></i><strong>Date Naissance :</strong>
												<b class="blue">{{ $patient->Dat_Naissance }}</b>
											</li>
											<li>
												<i class="ace-icon fa fa-caret-right blue"></i>
												<strong>Sexe:</strong>
												<b class="blue">{{ $patient->Sexe =="M" ? "Homme" : "Femme"}}</b>
											</li>
											<li class="divider"></li>
											<li>
												<i class="ace-icon fa fa-caret-right blue"></i>
												<strong>Age :</strong>
												<b class="blue">{{ $dt = Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</b>
											</li>
										</ul>
									</div>
								</div><!-- /.col -->
								<div class="col-sm-6">
									<div class="row">
										<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
											<b>Info du l'antécédant</b>
										</div>
									</div>
									<div>
										<ul class="list-unstyled  spaced">
											<li>
												<i class="ace-icon fa fa-caret-right green"></i><strong>Type :</strong>
												<b class="green">{{ $atcd->Antecedant }}</b>
											</li>
											<li>
												<i class="ace-icon fa fa-caret-right green"></i><strong>Sous Type :</strong>
												<b class="green">{{ $atcd->typeAntecedant }}</b>
											</li>
											<li>
												<i class="ace-icon fa fa-caret-right green"></i><strong>Date :</strong>
												<b class="green">{{ $atcd->date }}</b>
											</li>
											<li class="divider"></li>
											<li>
												<i class="ace-icon fa fa-caret-right green"></i>
												<strong>Description :</strong>
												<b class="green">{{ $atcd->descrioption }}</b>
											</li>
										</ul>
									</div>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div>
					</div>
					<hr>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection