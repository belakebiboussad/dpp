@extends('app')
@section('main-content')
<div class="row"><h4><strong>Liste des demande d'hospitalisation :</strong></h4></div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header"><h5 class="widget-title"><STRONG>Liste des demandes d'hospitalisation:</STRONG></h5></div>
			<table id="simple-table" class="table  table-bordered table-hover">
				<thead>
					<tr>
						<th class="center"><h5><strong>Patient</h5></strong></th>
						<th class="center" width="3%"><strong>Age(Ans)</strong></th>
						<th class="center"><strong>Date</strong></th>
						<th class="center"><strong>Mode Admission</strong></th>
						<th class="center"><strong>Spécialité</strong></th>
						<th class="center"><strong>Service</strong></th>
						<th class="center"><strong>Motif d'hospitalisation</strong></th>
						<th class="center"><strong>Etat</strong></th>
						<th class="center"><em class="fa fa-cog"></em></th>
					</tr>
				</thead>
				<tbody>
					@foreach( $demandes as $demande)
						<tr>
							<td>{{ $demande->consultation->patient->full_name }}</td>
							<td><span class="badge badge-{{ $demande->consultation->patient->age < 18 ? 'danger':'success' }}">{{ $demande->consultation->patient->age }}</span>
							</td>
							<td>{{ $demande->consultation->date }}</td>
							<td><span class="badge badge-{{($demande->getModeAdmissionID($demande->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $demande->modeAdmission }}</span></td>
							<td>{{ $demande->Specialite->nom }}</td>
							<td>{{ $demande->Service->nom }}</td>
							<td>{{ $demande->consultation->motif }}</td>
							<td><span class="label label-sm label-success">{{ $demande->etat}}</span></td>
							<td class="center">
								<a href="{{route('demandehosp.show', $demande->id)}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Voir détails..." data-placement="bottom">
									<i class="ace-icon fa fa-hand-o-up bigger-120" aria-hidden="true"></i>
								</a>
                @if($demande->getEtatID($demande->etat) == null)
                  @if(Auth::User()->employee_id == $demande->consultation->employ_id)
                  <a href="{{ route('demandehosp.edit', $demande->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier la demande" data-placement="bottom">
                    <i class="ace-icon fa fa-pencil bigger-120" aria-hidden="true"></i>
                  </a>
                  @endif
								  @if(Auth::User()->employee_id == $demande->consultation->employ_id || (Auth::User()->role_id == 6))
  								 <a href="{{ route('demandehosp.destroy',$demande->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-110"></i></a>
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
