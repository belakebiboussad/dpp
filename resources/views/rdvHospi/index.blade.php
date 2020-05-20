@extends('app_sur')
@section('main-content')
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
						<i class="ace-icon fa fa-table"></i>Liste des admission de la semaine
				</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th>Patient</th>
								<th>Mode Admission</th>
								<th>Priorité</th>
								<th>Observation</th>
								<th>date</th>
								<th>Etat</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php $d=Date::Now().' monday next week' ?>
						@foreach($demandes as $demande)
							@if(date('d M Y',strtotime(($demande->date_colloque).' monday next week')-1) == date('d M Y',strtotime($d)-1))
							<tr>
								<td>{{ $demande->demandeHosp->consultation->patient->Nom }} {{ $demande->demandeHosp->consultation->patient->Prenom }}</td>
								<td>{{ $demande->demandeHosp->modeAdmission }}</td>
								<td>
										@switch($demande->ordre_priorite)
 										 @case(1)
   											<span class="label label-sm label-success">{{ $demande->ordre_priorite }}</span>
      											@break
  										@case(2)
     											<span class="label label-sm label-warning">{{ $demande->ordre_priorite }}</span>
      											 @break
      										@case(3)
      											<span class="label label-sm label-danger">{{ $demande->ordre_priorite }}</span>
      											@break
      								@default
      										<span class="label label-sm label-success">{{ $demande->ordre_priorite }}</span>
      											@break
								@endswitch
								</td>
								<td>{{ $demande->observation }}</td>
								<td>
									<span class="label label-sm label-{{$demande->degree_urgence == "Haut" ? "danger" : "warning"}}" style="color: black;">
										<strong>{{ $demande->degree_urgence }}</strong>
										</span>
										{{ $demande->demandeHosp->consultation->Date_Consultation }}
									</td>
									<td>{{ $demande->demandeHosp->etat }}</td>
									<td>
										<div class="hidden-sm hidden-xs btn-group">
										<!-- /admission/create/{{$demande->id_demande}}  route('createRdvHosp',['id' =>$demande->id_demande ])-->
											<a href="{{ route('rdvHospi.create',['id' =>$demande->id_demande ]) }}" class="btn btn-xs btn-success">
												<i class="ace-icon fa fa-bed bigger-120"></i>
												Créer Un RDV Hospitalisaton
											</a>
										</div>
									</td>
								</tr>
								@endif
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.span -->
@endsection