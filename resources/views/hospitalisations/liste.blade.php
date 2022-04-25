<div class="row">
	<div class="col-sm-5 col-xs-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Listes des hospitalisations :</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th><strong>Médecin traitant</strong></th><th><strong>Date d'entrée</strong></th>
							<th><strong>Date sortie prévue</strong></th><th><strong>Date sortie</strong></th>				
							<th><strong>Etat</strong></th><th><em class="fa fa-cog"></em></th>				
						</tr>
					</thead>
					<tbody>
					@if($patient->hospitalisations->count()>0)
						@foreach($patient->hospitalisations as $hosp)
						<tr>
							<td>{{ $hosp->medecin->full_name }}</td>
							<td>{{ $hosp->Date_entree }}</td>
							<td>{{ $hosp->Date_Prevu_Sortie }}</td>
							<td>{{ $hosp->Date_Sortie == null ? '' : $hosp->Date_Sortie }}</td>
							<td>
               <span class="badge badge-{{( $hosp->getEtatID($hosp->etat)) === 1 ? 'primary':'success' }}">{{ $hosp->etat }}</span>
              </td>
							<td><button class="btn btn-primary btn-xs" onclick="showHosp({{ $hosp->id }});"><i class="fa fa-hand-o-up"></i></button></td>
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