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
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Hospitalisations</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th class="center">Patient</th>
								<th class="center">Mode Admission</th>
								<th class="center">Date Entrée</th>
								<th class="center">Date Sortie Prévue</th>
								<th class="center">Date Sortie</th>
								<th class="center">Médecin</th>
								<th class="center">Etat</th>
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
							  	<td><span class="badge badge-pill badge-success">{{ $hosp->etat_hosp }}</span></td>
							  	<td class="center">
							  		<a href="{{ route('hospitalisation.edit',$hosp->id)}}" class="btn btn-xs btn-info"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></a>
		                @if(Auth::user()->role->id != 9)
							  	   	@if(Auth::user()->role->id == 1)
							  	  		<a href="/visite/create/{{ $hosp->id }}" class ="btn btn-primary btn-xs"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>&nbsp;Visite</a>
							  	  		<a href="" class ="btn btn-info btn-xs"><i class="fa fa-out"></i>&nbsp;Sortir</a>
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