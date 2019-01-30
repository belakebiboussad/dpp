<div class="servive-block servive-block-grey" id="widget-box-2">
<div class="widget-header">
	<h5 class="widget-title bigger lighter">
		<i class="ace-icon fa fa-table"></i>
		<span><b>Liste des chambres</b></span>
	</h5>
</div>
<div class="widget-body">
	<div class="widget-main no-padding">
	<table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
			<th>Numéro</th>
			<th>nom </th>
			<th>nombre de lits</th>
			<th>Etat</th>
		</tr>
		</thead>
		<tbody >
		@foreach ($salles as $key=>$salle)
			<tr>
				<th>{{$salle->num}}</th>
				<th>{{$salle->nom}}</th>
				<th>{{count($salle->lits)}}</th>
				<th>{{$salle->etat}}</th>
			</tr>
		@endforeach
		<tr></tr>	
		</tbody>
				</table>
				</div>	{{-- widget-main--}}
			</div>{{-- widget-body --}}
			</div> 