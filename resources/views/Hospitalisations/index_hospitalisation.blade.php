@extends('app_sur')
@section('main-content')
	<div class="page-header">
		<h1>
			<strong>Liste Des Hospitalisations :</strong>
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
								<th>Mode Admission</th>
								<th>Date Entrée</th>
								<th>Date Sortie Prévue</th>
								<th>Date Sortie</th>
								<th>Médecin</th>
								<th><i class="ace-icon glyphicon glyphicon-signal"></i></th>
							</tr>
						</thead>
						<tbody>
							@foreach( $hospitalisations as $hosp)
								<tr>
									<td>
										{{ $hosp->admission->demandeHospitalisation->consultation->patient->Nom }}
										{{ $hosp->admission->demandeHospitalisation->consultation->patient->Prenom }}
									</td>
									<td>{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</td>
									<td><span class ="text-danger">{{ $hosp->Date_entree }}</span></td>
								  <td><span class ="text-danger">{{ $hosp->Date_Prevu_Sortie }}</span></td>
							  	<td>{{ $hosp->Date_Sortie == null ? "Pas encore" : $hosp->Date_Sortie }}</td>
							  	<td>
							  		{{ $hosp->admission->demandeHospitalisation->DemeandeColloque->medecin->Nom_Employe }}
							  		{{ $hosp->admission->demandeHospitalisation->DemeandeColloque->medecin->Prenom_Employe }}
							  	</td>
							  	<td>
							  	  <button><i class="ace-icon glyphicon glyphicon-share"> &nbsp;Sortir</i></button>

							  	</td>	
								</tr>
							@endforeach
						</tbody>
					</table>
				</div><!-- widget-main -->
		  	</div>	<!-- widget-body -->
		 </div> <!-- widget-box -->
	</div>
@endsection