@extends('app_recep')
@section('page-script')
	 $('#patients').dataTable();
@endsection
@section('main-content')
	<div class="page-header">
		<h1>Liste Des Patients :</h1>
	</div>
	<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div>
						<table id="patients" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th hidden>CODE_BARRE</th>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Date De Naissance</th>
									<th>Sexe</th>	
									<th>Dossier créer le</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($patients as $patient)
									<tr>
										<td hidden>{{ $patient->code_barre }}</td>
										<td class="center">{{ $patient->Nom  }}</td>
										<td class="center">{{ $patient->Prenom }}</td>
										<td class="center">{{ $patient->Dat_Naissance }}</td>
										<td class="center">{{ $patient->Sexe =="M" ? "Masculin" : "Féminin" }}</td>
										<td class="center">{{ $patient->Date_creation }}</td>
										<td class="center">
											<a href="{{ route('patient.show', $patient->id) }}" class="btn btn-white">
												<i class="ace-icon fa fa-info-circle"></i>
												Détails
											</a>
											<a href="{{ route('patient.edit', $patient->id)}}" class="btn btn-white btn-success">
												<i class="ace-icon fa fa-pencil-square-o"></i>
												Modifier
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection