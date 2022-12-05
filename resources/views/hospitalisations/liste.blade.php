<div class="row">
	<div class="col-sm-5 col-xs-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Hospitalisations :</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="display table-responsive tablist" id="hosptList"> <!-- table table-striped table-bordered table-hover -->
					<thead class="thin-border-bottom">
						<tr>
							<th class="center">Date d'entrée</th><th class="center sorting_disabled">Médecin traitant</th>
              <th class="center">Date(sort/Prév)</th>				
						  <th class="center sorting_disabled">Etat</th><th class="center sorting_disabled"><em class="fa fa-cog"></em></th>				
						</tr>
					</thead>
					<tbody>
					@if($patient->hospitalisations->count()>0)
						@foreach($patient->hospitalisations as $hosp)
						<tr>
							<td>{{ $hosp->date }}</td><td>{{ $hosp->medecin->full_name }}</td>
							<td>{{ ($hosp->etat_id == 1 ) ? $hosp->Date_Sortie : $hosp->Date_Prevu_Sortie }}</td>
							<td>
               <span class="badge badge-{{ ( $hosp->etat_id == 1) ? 'primary':'success' }}">{{ $hosp->etat }}</span>
              </td>
							<td>
                <button class="btn btn-primary btn-xs" onclick="showHosp({{ $hosp->id }});">
                 <i class="ace-icon fa fa-eye-slash fa-2x"></i></button>
                <a href = "{{ route('hospitalisation.show',$hosp->id)}}" style="cursor:pointer" class="btn btn-success btn-xs" data-toggle="tooltip" title="voir hospitalisation"><i class="ace-icon fa fa-hand-o-up fa-2xs"></i></a>
              </td>
						</tr>
						@endforeach
					@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div><div class="col-sm-7 col-xs-12" id="hospDetail"></div>
</div>