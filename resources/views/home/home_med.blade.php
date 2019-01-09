
@extends('app_med')
@section('main-content')
<div class="page-content">
	<div class="space-12"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="center">
				<h1 class="blue">
					Bienvenue Docteur:
					{{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe }}
					{{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}}
				</h1>
			</div>
		</div>		
	</div>	{{-- row --}}
	<div class="space-12"></div>
	<div class="row">
		<div class="space-6"></div>
		<div class="col-sm-7 infobox-container">
			<div class="infobox infobox-green">
				<div class="infobox-icon">
					<i class="ace-icon fa fa-users"></i>
				</div>
				<div class="infobox-data">
					<span class="infobox-data-number">{{ App\modeles\patient::all()->count() }}</span>
					<div class="infobox-content"><b>Patients</b></div>
				</div>
			</div>
			<div class="infobox infobox-blue">
				<div class="infobox-icon">
					<i class="ace-icon fa fa-user-md"></i>
				</div>
				<div class="infobox-data">
					<span class="infobox-data-number">{{ App\modeles\consultation::all()->count() }}</span>
					<div class="infobox-content"><b>Consultations</b></div>
				</div>
			</div>
			<div class="infobox infobox-pink">
				<div class="infobox-icon">
					<i class="ace-icon fa fa-table"></i>
				</div>
				<div class="infobox-data">
					<span class="infobox-data-number">{{ App\modeles\rdv::all()->count() }}</span>
					<div class="infobox-content"><b>Rendez-vous</b></div>
				</div>
			</div>
			<div class="infobox infobox-red">
				<div class="infobox-icon">
					<i class="ace-icon fa fa-hospital-o"></i>
				</div>
				<div class="infobox-data">
					<span class="infobox-data-number">{{ App\modeles\hospitalisation::all()->count() }}</span>
					<div class="infobox-content"><b>Hospitalisations</b></div>
				</div>
			</div>
			<div class="space-6"></div>
		</div>
		<div class="vspace-12-sm"></div>
		<div class="col-sm-5">
			<div class="widget-box">
				<div class="widget-header widget-header-flat widget-header-small">
					<h5 class="widget-title">
						<i class="ace-icon fa fa-signal"></i>
						Statistiques
					</h5>
					<div class="widget-toolbar no-border">
						<div class="inline dropdown-hover">
							<button class="btn btn-minier btn-primary">
								Cette semaine
								<i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
							</button>
							<ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
								<li class="active">
									<a href="#" class="blue">
										<i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
										Cette semaine
									</a>
								</li>
								<li>
									<a href="#">
										<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
										Derniere semaine
									</a>
								</li>
								<li>
									<a href="#">
										<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
										Cette mois
									</a>
								</li>
								<li>
									<a href="#">
										<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
										Dernier mois
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div id="piechart-placeholder"></div>
							<div class="hr hr8 hr-double"></div>
								<div class="clearfix">
									<div class="grid3">
										<span class="grey">
											<i class="ace-icon fa fa-users blue"></i>
											&nbsp; <b>Patients</b>
										</span>
										<h4 class="bigger pull-right">{{ App\modeles\patient::all()->count() }}</h4>
									</div>
									<div class="grid3">
										<span class="grey">
											<i class="ace-icon fa fa-mars fa-2x purple"></i>
											&nbsp; Masculin
										</span>
										<h4 class="bigger pull-right">
											{{ App\modeles\patient::where('Sexe','M')->get()->count()}}
										</h4>
									</div>
									<div class="grid3">
										<span class="grey">
											<i class="ace-icon fa fa-venus fa-2x red"></i>
											&nbsp; Féminin
										</span>
										<h4 class="bigger pull-right">
											{{ App\modeles\patient::where('Sexe','F')->get()->count()}}
										</h4>
									</div>
								</div>
							</div><!-- /.widget-main -->
						</div><!-- /.widget-body -->
					</div><!-- /.widget-box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
			<div class="hr hr32 hr-dotted"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div>
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
					</div>
				</div>
			</div>
		</div>
	</div>	{{-- end row --}}
</div>{{-- end page-content --}}
</div>
@endsection