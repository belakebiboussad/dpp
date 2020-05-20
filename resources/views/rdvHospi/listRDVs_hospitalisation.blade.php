@extends('app_sur')
@section('main-content')
	<div class="page-header">
		<h2>
			<strong>Liste des Rendez-Vous d'hospitalisation :</strong>
		</h2>
	</div><!-- /.page-header -->
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Rendez-Vous</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th hidden></th>
								<th class="center" width="3%" ></th>
								<th class="text-center" width="11%"><h5><strong>Patient</strong></h5></th>
								<th class="text-center" width="15%"><h5><strong>Date RDV</strong></h5></th>
								<th class="text-center" width="10%">Heure RDV</th>
								<th width="12%" class="text-center"><strong>Date Sortie Prévue</strong></th>
							  <th width="12%" class="text-center"><strong>Heure Sortie Prévue</strong></th>
								<th class="font-weight-bold text-center"><strong>Medecin Traitant</strong></th>
								<th class="font-weight-bold text-center"><strong>Lit</strong></th>
								<th class="font-weight-bold text-center"><strong>Salle</strong></th>
								<th class="font-weight-bold text-center"><strong>Service</strong></th>
							 	<th class="detail-col text-center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody id ="rendez-VousBody" class="bodyClass">
							<?php $j = 0; ?>
							@foreach( $rdvHospis as $i=>$rdv)
						  	<tr>
								<td hidden>{{ $j }}</td>	
						   	<td class="center">
						  		<label class="pos-rel">
										<input type="checkbox" class="ace" name ="valider[]" value ="{{$rdv->id}}" /><span class="lbl"></span>   
						   		</label>
								</td>
								<td>
							   	 	 {{$rdv->demandeHospitalisation->consultation->patient->Nom }}&nbsp;{{$rdv->demandeHospitalisation->consultation->patient->Prenom }}	
								</td>
								<td class ="text-danger">
									<strong>{{ $rdv->date_RDVh }}</strong>
						    		</td>
							    	<td><strong>{{ $rdv->heure_RDVh }}</strong></td>
							    	<td class="center text-danger">
										<strong>{{ $rdv->date_Prevu_Sortie }}</strong>
								</td>
								<td class="center text-danger">
									<strong>{{ $rdv->heure_Prevu_Sortie }}</strong>
								</td>
							    	<td><strong>{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->Nom_Employe }}&nbsp;{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->Prenom_Employe }}</strong>
							    	</td>
								<td class="center">
								 	@if(isset($rdv->bedReservation->id_lit))	
										{{ $rdv->bedReservation->lit->nom }}
									@else
										<strong>/</strong>
									@endif		
								</td>
								<td>
									@if(isset($rdv->bedReservation->id_lit))	
										{{ $rdv->bedReservation->lit->salle->nom }}
									@else
										<strong>/</strong>
									@endif		
									{{ $rdv->nomsalle }}
								</td>
								<td>
									@if(isset($rdv->bedReservation->id_lit))	
										{{ $rdv->bedReservation->lit->salle->service->nom }}
									@else
										<strong>/</strong>
									@endif	
								 </td>
								<td class="center">
									<a href="{{ route('rdvHospi.edit',$rdv->id) }}" class="btn btn-success btn-xs"  title= "Reporer RDV" >
									 	<i class="ace-icon fa fa-clock-o"></i>
								  </a>
								  <a href="{{ route('rdvHospi.destroy',$rdv->id) }}" class="btn btn-danger btn-xs" title="Annuler RDV" data-method="DELETE" data-confirm="Etes Vous Sur d'annuller le RDV?"><i class="fa fa-trash-o fa-xs"></i></a><!-- onclick= "printRDV();" -->
								  <a href="/rdvHospi/imprimer/{{ $rdv->id }}" class="btn btn-info btn-xs" title="Imprimer RDV">
								   	<i class="ace-icon fa fa-print" ></i>
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
@endsection