@extends('app_med')
@section('page-script')
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
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Rechercher un Patient:</h3>
		</div>
		<div class="panel-body">
			<div class="form-group   has-feedback">
				<label class="control-label" for="nomPatient" >Nom du Patient :</label>
			           <input type="text" class="form-control" id="nomPatient" name="nomPatient"  placeholder="Rechercher..."/>
				 <span class="glyphicon glyphicon-search form-control-feedback"></span>
			</div>
				
		</div>
	</div>
</div>
<div class="space-12"></div>
<div class="space-12"></div>
<div class="row">
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
</div>
@endsection