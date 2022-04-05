<div class="servive-block servive-block-grey" id="widget-box-2">
<div class="widget-header">
	<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i><span><b>Liste des chambres</b></span></h5>
</div>
<div class="widget-body">
	<div class="widget-main no-padding">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Numéro</th>
				<th>Nom </th>
				<th>Nombre de lits</th>
        <th>Service</th>
				<th>Etat</th>
			</tr>
		</thead>
		<tbody >
			@foreach ($salles as $key=>$salle)
				<tr>
					<td>{{$salle->num}}</td>
					<td>{{$salle->nom}}</td>
					<td>{{count($salle->lits)}}</td>
          <td>{{ $salle->service->nom }}</td>
					<th>{{$salle->etat}}</th>
				</tr>
			@endforeach
		
		</tbody>
	</table>
	</div>	{{-- widget-main--}}
</div>{{-- widget-body --}}
</div> 