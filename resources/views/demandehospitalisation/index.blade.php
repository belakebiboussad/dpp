@extends('app')
@section('main-content')
<div class="page-header"><h1>Liste des demande d'hospitalisation :</h1></div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header"><h4 class="widget-title">Liste des demandes d'hospitalisation:</h4></div>	<br/>
			<table id="simple-table" class="table  table-bordered table-hover">
				<thead>
					<tr>
						<th class="center"><h5><strong>Patient</h5></strong></th>
						<th class="center" width="3%"><strong>Age(Ans)</strong></th>
						<th class="center"><strong>Date Demande</strong></th>
						<th class="center"><strong>Mode Admission</strong></th>
						<th class="center"><strong>Spécialité</strong></th>
						<th class="center"><strong>Service</strong></th>
						<th class="center"><strong>Motif de l'hospitalisation</strong></th>
						<th class="center"><strong>Etat</strong></th>
						<th class="center"><em class="fa fa-cog"></em></th>
					</tr>
				</thead>
				<tbody>
					@foreach( $demandehospitalisations as $demande)
						<tr>
							<td>{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }}</td>
							<td>
								<span class="badge badge-{{ $demande->consultation->patient->getAge() < 18 ? 'danger':'success' }}">{{ $demande->consultation->patient->getAge() }}</span>
							</td>
							<td>{{ $demande->consultation->Date_Consultation }}</td>
							<td>
								@switch($demande->modeAdmission)
    									@case("Ambulatoire")
        									<span class="label label-sm label-warning">
        									@break
         								@case("Urgence")
        									<span class="label label-sm label-danger">
        									@break
        								@case("programme")		
        									<span class="label label-sm label-success">
        									@break	
								@endswitch	
								{{ $demande->modeAdmission }}</span>
							</td>
							<td>{{ $demande->Specialite->nom }}</td>
							<td>{{ $demande->Service->nom }}</td>
							<td>{{ $demande->consultation->motif }}</td>
							<td>
							@switch($demande->etat)
    							@case("en attente")
        						<span class="label label-sm label-warning">
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
        					@case("admise")		
        						<span class="label label-sm label-success">
        						@break	
							@endswitch	
							{{ $demande->etat }}</span>
							</td>
							<td class="center">
								<a href="{{route('demandehosp.show', $demande->id)}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Voir détails..." data-placement="bottom">
									<i class="ace-icon fa fa-hand-o-up bigger-120" aria-hidden="true"></i>
								</a>
								@if(Auth::User()->employee_id == $demande->consultation->Employe_ID_Employe || (Auth::User()->role_id == 6))
								@if($demande->etat == 'en attente')	 
								<a href="{{ route('demandehosp.edit', $demande->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier la demande" data-placement="bottom">
									<i class="ace-icon fa fa-pencil bigger-120" aria-hidden="true"></i>
								</a>
								<a href="{{ route('demandehosp.destroy',$demande->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-110"></i>
								</a>
								@endif
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
