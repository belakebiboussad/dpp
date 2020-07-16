@extends('app')
@section('page.script')
<script>
	$('#choixp').dataTable({
		ordering: true,
		"language": 
		{
		   "url": '/localisation/fr_FR.json'
		},
	});
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1>Selectionner un  Patient</h1>
</div>
<table id="choixp" class="table  table-bordered table-hover">
	<thead>
		<tr>
			<th hidden>IPP</th>
			<th class="center"><strong>Nom</strong>	</th>
			<th class="center"><strong>Prénom</strong></th>
			<th class="center"><strong>Date Naissance</strong></th>
			<th class="center"><strong>Sexe</strong></th>
			<th class="center"><strong>Type</strong></th>
			<th class="center"><strong>Adresse</strong></th>
			<th class="center"><strong>Date Création</strong></th>
			<th class="center"><strong>Age(ans)</strong></th>
			<th class="center"><em class="fa fa-cog"></em></th>
		</tr>
	</thead>
	<tbody>
		@foreach($patients as $patient)
		<tr>
			<td hidden>{{ $patient->IPP }}</td>
			<td>{{ $patient->Nom }}</td>
			<td>{{ $patient->Prenom }}</td>
			<td>{{ $patient->Dat_Naissance }}</td>
			<td>{{ $patient->Sexe =="M" ? "Homme" : "Femme" }}</td>
			<td>{{ $patient->Type }}</td>
			<td>{{ $patient->Adresse }}</td>
			<td>{{ $patient->Date_creation }}</td>
			<td>{{ $patient->getAge( )}}</td>
			<td>
			{{-- style="width:100%;" --}}
				<a  href="/consultations/create/{{$patient->id}}" class="btn btn-xs btn-default">
				 	<i class="fa fa-stethoscope"></i>
					&nbsp;&nbsp;Consultation
				</a>  
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection