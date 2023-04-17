<div class="servive-block servive-block-grey">
<div class="widget-header">
	<h5 class="widget-title bigger lighter">
		<i class="ace-icon fa fa-table"></i>
		<span><b>Liste des lis</b></span>
	</h5>
</div>
<div class="widget-body">
	<div class="widget-main no-padding">
	<table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
			<th>Numéro</th>
			<th>Nom </th>
			<th>Bloqué</th>
			<th>Affectation</th>
		</tr>
		</thead>
		<tbody >
		@foreach ($lits as $key=>$lit)
			<tr>
				<th>{{$lit->num}}</th>
				<th>{{$lit->nom}}</th>
				<th>{{ $lit->etat == 1 ? "Non Bloqué" : "Bloqué" }}</th>
		    	<th>{{ $lit->affectation == 0 ? "Non Affecté" : "Affecté" }}</th>
			</tr>


		@endforeach
		<tr></tr>	
		</tbody>
				</table>
				</div>	{{-- widget-main--}}
			</div>{{-- widget-body --}}
			</div> 