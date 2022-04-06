<div class="col-xs-12 col-sm-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Visites & Contrôles</h5>
			@if(in_array(Auth::user()->role_id,[1,13,14])){{-- med,chefser,medchef --}}
			<div class="widget-toolbar widget-toolbar-light no-border">
			     <a href="/visite/create/{{ $hosp->id}}"><i class="fa fa-plus-circle bigger-180" style="color:black"></i></a>
			</div>
			@endif
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table id="consultList" class="display dataTable table table-striped table-bordered table-condensed" width="100%" data-page-length="25" role="grid">
					<thead class="thin-border-bottom">
						<tr>
							<th class="">Date</th>
							<th class ="center sorting_disabled">Médecin</th>
							<th class ="center sorting_disabled">Examens Biologique</th>
							<th class ="center sorting_disabled">Examens Imageries</th>
							<th class="center sorting_disabled"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					 @foreach($hosp->visites as $visite)
					<tr  role="row" class="even">
						<td>{{ $visite->date }}</td>
						<td class ="center sorting_disabled">{{ $visite->medecin->full_name }}</td>
						<td class="center">
					 		@if(isset($visite->demandeexmbio))
								@if($visite->demandeexmbio->etat == null)
									<span class="badge badge-success">En Cours
								@elseif($demande->etat == 1)
									<span class="badge badge-primary">Validé	
								@elseif($demande->etat == 0)
									<span class="badge badge-warning">Rejeté
								@endif
								</span>
						  @endif  
						</td>
						<td class="center">
					   	@if(isset($visite->demandExmImg))
						   	@if($visite->demandExmImg->etat == null)
									<span class="badge badge-success">En Cours
								@elseif($demande->etat == 1)
									<span class="badge badge-primary">Validé	
								@elseif($demande->etat == 0)
									<span class="badge badge-warning">Rejeté
								@endif
								</span>
					 	  @endif 
						</td>
						<td class="center sorting_disabled"><a href="{{ route('visites.show', $visite->id) }}"><i class="fa fa-eye"></i></a></td>
					</tr>
					@endforeach 
					</tbody>
				</table>
			</div>
		</div><!-- widget-body -->
	</div>
</div>
<div class="col-sm-7" id="consultDetail">

</div>