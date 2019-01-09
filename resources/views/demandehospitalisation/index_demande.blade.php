@extends('app_med')
@section('main-content')
<div class="page-header">
	<h1>Liste Des Demande d'hospitalisation :</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Liste Des Demande d'hospitalisation :</h4>
			</div>
			<br/>
			<table id="simple-table" class="table  table-bordered table-hover">
				<thead>
					<tr>
						<th>Patient</th>
						<th>Age</th>
						<th>Date De La Demande</th>
						<th>Motif de l'hospitalisation</th>
						<th>Degrée D'urgence</th>
						<th>Service</th>
						<th>Médecin traitant</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach( $demandehospitalisation as $demande)
						<tr>
							<td>{{ $demande->Nom }} {{ $demande->Prenom }}</td>
							<td>{{ Jenssegers\Date\Date::parse($demande->Dat_Naissance)->age }}</td>
							<td>{{ $demande->Date_demande }}</td>
							<td>{{ $demande->motif }}</td>
							<td>{{ $demande->degree_urgence }}</td>
							<td>{{ $demande->service }}</td>
							<td>
								{{ App\modeles\employ::where("id",$demande->Employe_ID_Employe)->get()->first()->Nom_Employe }}
								{{ App\modeles\employ::where("id",$demande->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
							</td>
							<td>
								<div class="hidden-sm hidden-xs btn-group">
									<a href="{{route('demandehosp.show', $demande->id)}}" class="btn btn-xs btn-success">
										<i class="ace-icon fa fa-sign-in bigger-120"></i>
										Afficher
									</a>
								@if(Auth::User()->employee_id == $demande->Employe_ID_Employe)
									<a href="{{route('demandehosp.edit', $demande->id)}}" class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
										Modifier
									</a>
								@endif
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
