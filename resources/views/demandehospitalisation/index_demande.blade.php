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
						<th><strong>Patient</strong></th>
						<th><strong>Age</strong></th>
						<th><strong>Date De La Demande</strong></th>
						<th><strong>Motif de l'hospitalisation</strong>/th>
						<th><strong>Service</strong></th>
						<th><strong>Etat</strong></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach( $demandehospitalisations as $demande)
						<tr>
							<td>{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }}</td>
							<td>{{ Jenssegers\Date\Date::parse($demande->consultation->patient->Dat_Naissance)->age }}Ans</td>
							<td>{{ $demande->consultation->Date_Consultation }}</td>
							<td>{{ $demande->consultation->Motif_Consultation }}</td>
							<td>{{ $demande->Service->nom }}</td>
							<td>
							@switch($demande->etat)
    							@case("en attente")
        						<span class="label label-sm label-danger">
        						@break
         					@case("valide")
          					<span class="label label-sm label-primary">
         						@break	
                  @case("programme")
        						<span class="label label-sm label-primary">	
        						@break
        					@case("annule")
        						<span class="label label-sm label-danger">	
        						@break	
							@endswitch	
							{{ $demande->etat }}</span>
							
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
