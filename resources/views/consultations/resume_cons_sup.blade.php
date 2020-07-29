@extends('app')
@section('main-content')
<div class="page-header">
<h1><strong>Résumé  du Consultation Pour :</h1>
<?php $patient = $consultation->patient; ?>
  @include('patient._patientInfo', $patient)
</div>
<div class="row" style = "margin-top:-2%">
	<div class="col-sm-7" id="consultDetail">
	 @include('consultations.inc_consult')
	</div>
	<div class="col-sm-5">
		<div class="page-header" style="margin-top:5px;">
  		<h4>Liste des Consulations :</h4>
		</div>	
		<table id="consultList" class="display dataTable table table-striped table-bordered table-condensed" width="100%" data-page-length="25" role="grid">
		<thead>
		<tr role="row">
			<th class="sorting_asc center" tabindex="0"  aria-sort="ascending" aria-label="Position: activate to sort column descending" style="width:20%">Date</th>
			<th class="center sorting_disabled" width="45%">Medecin</th>
			<th class="center sorting_disabled" width="45%">Service</th>
			<th width="10%" ></th>
		</tr>
		</thead>
		<tbody>
		@foreach($consultation->patient->Consultations as $consult)
		<tr  role="row" class="even">
			<td class="center" width="20%">
				{{$consult->Date_Consultation}}
			</td>
			<td width="30%">
				<span>{{ $consult->docteur->Nom_Employe }} {{ $consult->docteur->Prenom_Employe }}</span>
			</td>
			<td width="45%">
				<span >{{$consult->docteur->service->nom}}</span>
			</td>
			<td class="center sorting_disabled"  width="8%">
				<button class="btn btn-primary btn-xs" onclick="showConsult({{ $consult->id }});"> 
						  <i class="fa fa-hand-o-up"></i>
			  </button>		 
			</td>	
		</tr>
		@endforeach
		</tbody>
		</table>	
	</div>
</div>
@endsection