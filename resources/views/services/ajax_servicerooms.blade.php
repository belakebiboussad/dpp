<div class="servive-block servive-block-grey" id="widget-box-2">
<div class="widget-header">
	<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i><span><b>les chambres du service &quot;{{ $service->nom }}&quot;</b></span></h5>
</div>
<div class="widget-body">
	<div class="widget-main no-padding">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Numéro</th>
				<th>Nom </th>
				<th>Nombre de lits</th>
        <th>Etat</th>
			</tr>
		</thead>
		<tbody >
			@foreach ($service->salles as $key=>$salle)
				<tr>
					<td>{{$salle->num}}</td>
					<td>{{$salle->nom}}</td>
					<td>{{count($salle->lits)}}</td>
          <th>
              @if(isset( $salle->etat ))
                <span class="label label-sm label-warning">
              @else
              <span class="label label-sm label-success">
                Non 
              @endif
              Bloquée</span>
          </th>
				</tr>
			@endforeach
		
		</tbody>
	</table>
	</div>	{{-- widget-main--}}
</div>{{-- widget-body --}}
</div> 