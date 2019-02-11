@extends('app_recep')
@section('page-script')
	 $('#choix-patient-atcd').dataTable();
@endsection
@section('main-content')
	<div class="page-header">
		<h1 style="display: inline;">Selectionner un  Patient</h1>
	</div>
	<table id="choix-patient-atcd" class="table  table-bordered table-hover">
	<thead>
		<tr>
			<th hidden>CODE_BARRE</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Date Naissance</th>
			<th>Sexe</th>
			<th>Type</th>
			<th>Date Création</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($patients as $patient)
			<tr>
				<td hidden>{{ $patient->code_barre }}</td>
				<td class="center">{{ $patient->Nom }}</td>
				<td class="center">{{ $patient->Prenom }}</td>
				<td class="center">{{ $patient->Dat_Naissance }}</td>
				<td class="center">{{ $patient->Sexe == "M" ? "Masculin" : "Féminin"}}</td>
				<td class="center">{{ $patient->Type }}</td>
				<td class="center">{{ $patient->Date_creation }}</td>
				<td class="center">
					<a href="/atcd/create/{{$patient->id}}" class="btn btn-white">
						<i class="ace-icon fa fa-lightbulb-o"></i>
						Ajouter antécédant
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endsection