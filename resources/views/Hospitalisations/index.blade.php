@extends('app')
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
								<th>Etat</th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach( $hospitalisations as $hosp)
								<tr>
									<td>
										@if(Auth::user()->role->id == 1)
											<a href="/patient/{{ $hosp->admission->demandeHospitalisation->consultation->patient->id}}/edit">
												{{ $hosp->admission->demandeHospitalisation->consultation->patient->Nom }}
												{{ $hosp->admission->demandeHospitalisation->consultation->patient->Prenom }}
											</a>
											@else
											{{ $hosp->admission->demandeHospitalisation->consultation->patient->Nom }}
											{{ $hosp->admission->demandeHospitalisation->consultation->patient->Prenom }}
										@endif
									</td>
									<td>{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</td>
									<td><span class ="text-danger">{{ $hosp->Date_entree }}</span></td>
								  <td><span class ="text-danger">{{ $hosp->Date_Prevu_Sortie }}</span></td>
							  	<td>{{ $hosp->Date_Sortie == null ? "Pas encore" : $hosp->Date_Sortie }}</td>
							  	<td>
							  		{{ $hosp->admission->demandeHospitalisation->DemeandeColloque->medecin->Nom_Employe }}
							  		{{ $hosp->admission->demandeHospitalisation->DemeandeColloque->medecin->Prenom_Employe }}
							  	</td>
							  	<td><span class="label label-info arrowed">{{ $hosp->etat_hosp }}</span></td>
							  	<td>
							  	  @if(Auth::user()->role->id != 9)
							  	  	
							  	  	@if(Auth::user()->role->id == 1)
							  	  		<a href="/visite/create/{{ $hosp->id }}" class ="btn btn-primary btn-xs"><i class="fa fa-plus"></i>&nbsp;Visit</a>
							  	  		<a href="" class ="btn btn-warning btn-xs"><i class="fa fa-out"></i>&nbsp;Sortir</a>
							  	  	@endif
							  	  	@if((Auth::user()->role->id == 5) && ($hosp->etat_hosp == 'en cours'))
							  	  		<a class="btn btn-secondary btn-xs"><i class="ace-icon glyphicon glyphicon-print">&nbsp;Ticket</i></a>
							  	  	@endif			
							  	  @endif
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