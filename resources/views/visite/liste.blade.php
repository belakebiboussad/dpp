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
					 		@isset($visite->demandeexmbio)
							<span class="badge badge-{{( $visite->demandeexmbio->getEtatID($visite->demandeexmbio->etat)) === 0 ? 'warning':'primary' }}">
                {{ $visite->demandeexmbio->etat }}</span>
						  @endisset  
						</td>
						<td class="center">
					   	@isset($visite->demandExmImg)
  <span class="badge badge-{{( $visite->demandExmImg->getEtatID($visite->demandExmImg->etat)) === 0 ? 'warning':'primary' }}">
                {{ $visite->demandExmImg->etat }}</span>
					 	  @endisset 
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