<div class="col-xs-12 col-sm-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Visites & Contrôles</h5>
			@if(in_array(Auth::user()->role_id,[1,13,14]))
			<div class="widget-toolbar widget-toolbar-light no-border">
			     <a href="/visite/create/{{ $hosp->id}}"><i class="fa fa-plus-circle bigger-180"></i></a>
			</div>
			@endif
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table id="consultList" class="display dataTable table table-striped table-bordered table-condensed" width="100%" data-page-length="25" role="grid">
					<thead class="thin-border-bottom">
						<tr>
							<th class ="center">Médecin</th>
							<th class="center">Date</th>
              <th class="center">Heure</th>
							<th class ="center">Examens Biologique</th>
							<th class ="center">Examens Imageries</th>
							<th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					 @foreach($hosp->visites as $visite)
					<tr  role="row" class="even">
            <td>{{ $visite->medecin->full_name }}</td>
						<td>{{ $visite->date_formated }}</td>
            <td>{{ $visite->heure }}</td>
						<td class="center">{!! $formatStat
($visite->demandeexmbio) !!}</td>
            <td>{!! $formatStat
($visite->demandExmImg) !!}</td>
					  <td class="center">
              <a href="{{ route('visites.show', $visite->id) }}" class="btn btn-success btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
              @if($visite->date->isToday())
              @if(($loop->first) && (Auth::user()->employ->isServHead(Auth::user()->employ->service_id) || $visite->id_employe == Auth::user()->employe_id))
              <a href="{{ route('visites.edit', $visite->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit fa-xs"></i></a>
              @endif
              @endif
            </td>
					</tr>
					@endforeach 
					</tbody>
				</table>
			</div>
		</div><!-- widget-body -->
	</div>
</div><div class="col-sm-7" id="consultDetail"></div>