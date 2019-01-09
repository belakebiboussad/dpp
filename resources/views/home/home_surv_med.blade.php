@extends('app_sur')
@section('main-content')
		<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
			<div class="widget-box widget-color-blue" id="widget-box-2">
				<div class="widget-header">
					<h5 class="widget-title bigger lighter">
						<i class="ace-icon fa fa-table"></i>
						Liste des admission de la semaine
					</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thin-border-bottom">
								<tr>
									<th>Patient</th>
									<th>Motif</th>
									<th>Priorité</th>
									<th>Observation</th>
									<th>Degré/date</th>
								</tr>
							</thead>
							<tbody>
								<?php $d=Date::Now().' monday next week'
								?>
							@foreach($demandes as $demande)

								@if(date('d M Y',strtotime(($demande->date_colloque).' monday next week')-1) == date('d M Y',strtotime($d)-1))
								<tr>
									<td>{{ $demande->Nom }} {{$demande->Prenom }}</td>
									<td>{{ $demande->motif }}</td>
									<td>{{ $demande->ordre_priorite }}</td>
									<td>{{ $demande->observation }}</td>
									<td>
										<span class="label label-sm label-{{$demande->degree_urgence == "Haut" ? "danger" : "warning"}}" style="color: black;">
											<strong>{{ $demande->degree_urgence }}</strong>
										</span>
										{{ App\modeles\consultation::where("id",$demande->id_consultation)->get()->first()->Date_Consultation }}
									</td>								
									<td>
										<div class="hidden-sm hidden-xs btn-group">
											<a href="/admission/create/{{$demande->id}}" class="btn btn-xs btn-success">
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