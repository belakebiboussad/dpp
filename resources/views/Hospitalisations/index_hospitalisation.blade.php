@extends('app_sur')
@section('main-content')
	<div class="page-header">
		<h1>
			Liste Des Hospitalisations :
		</h1>
	</div><!-- /.page-header -->
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-table"></i>
					Liste Des Hospitalisations :
				</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th>Patient</th>
								<th>Motif De L'hospitalisation</th>
								<th>Date Entrée</th>
								<th>Date Prévue Pour La Sortie</th>
								<th>Date Sortié</th>
								<th>Médecin</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $hospitalisations as $hosp)
							<tr>
								<td>
									{{ App\modeles\patient::where("id",$hosp->Patient_ID_Patient)->get()->first()->Nom }}
									{{ App\modeles\patient::where("id",$hosp->Patient_ID_Patient)->get()->first()->Prenom }}
								</td>
								<td>{{ $hosp->motif }}</td>
								<td>{{ $hosp->Date_entree }}</td>
								<td>{{ $hosp->Date_Prevu_Sortie }}</td>
								<td>{{ $hosp->Date_Sortie == null ? "Pas encore" : $hosp->Date_Sortie }}</td>
								<td>
									{{ App\modeles\employ::where("id",$hosp->Employe_ID_Employe)->get()->first()->Nom_Employe }}
									{{ App\modeles\employ::where("id",$hosp->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection