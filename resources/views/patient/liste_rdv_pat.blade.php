@extends('app_recep')
@section('main-content')
<div class="page-header">
		<h1 style="display: inline;"><strong>Liste Des RDV Pour Le Patient :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
		<div class="pull-right">
			<a href="{{ URL::previous() }}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>
				Retour a la fiche patient
			</a>
		</div>
</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-11">
					<table id="simple-table" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th class="hidden-480">Date</th>
								<th>
									<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
									Heure
								</th>
								<th class="hidden-480">Etat</th>
								<th>Médecin traitant</th>
							</tr>
						</thead>
						<tbody>
							@foreach($rdvs as $rdv)
							<tr>
								<td>{{$rdv->Date_RDV}}</td>
								<td>{{$rdv->Temp_rdv}}</td>
								<td>{{$rdv->Etat_RDV}}</td>
								<td>
									{{ App\modeles\employ::where("id",$rdv->Employe_ID_Employe)->get()->first()->Nom_Employe }}
									{{ App\modeles\employ::where("id",$rdv->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection