@extends('app_sur')
@section('main-content')
<div class="col-xs-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des admission de la semaine</h5></div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center"><h5><strong>Patient</strong></h5></th>
							<th class="center"><h5><strong>Mode d'admission</strong></h5></th>
							<th class="center"><h5><strong>Priorité</strong></h5></th>
							<th class="center"><h5><strong>Observation</strong></h5></th>
							<th class="center"><h5><strong>Date</strong></h5></th>
							<th class="center"><h5><strong>Etat</strong></h5></th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					<?php $d=Date::Now().' monday next week' ?>
					@foreach($demandes as $demande)
						@if(date('d M Y',strtotime(($demande->date).' monday next week')-1) == date('d M Y',strtotime($d)-1))
						<tr>
							<td>{{ $demande->demandeHosp->consultation->patient->full_name }}</td>
							<td>{{ $demande->modeAdmission }}</td>
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
								{{ $demande->demandeHosp->consultation->date }}
							</td>
							<td>{{ $demande->demandeHosp->etat }}</td>
							<td>
								<div class="hidden-sm hidden-xs btn-group">
									<a href="{{ route('createRdvHosp',['id' =>$demande->id_demande ]) }}" class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-bed bigger-120"></i>Créer un RDV d'hospitalisaton
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
</div>
@endsection