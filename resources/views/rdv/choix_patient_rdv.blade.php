@extends('app_recep')
@section('page-script')
	<script>
		 $('#choixpatientrdv').dataTable();
	
	</script>
@endsection

@section('main-content')
<div class="page-header">
	<h1 style="display: inline;">Selectionner un  Patient</h1>
</div>
<hr>
<div class="space-12"></div>
<div class="row">
	<table id="choixpatientrdv" class="table  table-bordered table-hover">
	<thead>
		<tr>
			<th hidden>CODE_BARRE</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Date Naissance</th>
			<th>Sexe</th>
			<th>Type</th>
			<th>Adresse</th>
			<th>Date Création</th>
			<th>Age</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($patients as $patient)
			<tr>
				<td hidden>{{ $patient->code_barre }}</td>
				<td>{{ $patient->Nom }}</td>
				<td>{{ $patient->Prenom }}</td>
				<td>{{ $patient->Dat_Naissance }}</td>
				<td>{{ $patient->Sexe =="M" ? "Homme" : "Femme" }}</td>
				<td>{{ $patient->Type }}</td>
				<td>{{ $patient->Adresse }}</td>
				<td>{{ $patient->Date_creation }}</td>
				<td>{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</td>
				<td class="center">
					<a href="/rdv/create/{{ $patient->id }}" class="btn btn-white btn-sm">
						<i class="ace-icon fa fa-calendar-o"></i>
						Ajouter RDV
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>

@endsection