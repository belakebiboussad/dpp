@extends('app')
@section('main-content')
<div class="page-header">
	<h1>Choix du patient :</h1>
</div>
<table id="choixp" class="table  table-bordered table-hover">
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
			{{-- style="width:100%;" --}}
				 <a  href="/consultations/create/{{$patient->id}}" class="btn  btn-primary" >
				   	<div class="fa fa-plus-circle pull-left"></div>
					<span class="bigger-120">Consultation </span>
				</a>  
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection