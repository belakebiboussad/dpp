@extends('app_recep')
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>Liste Des RDV :</strong></h1>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div>
					<table id="rdvs_liste" class="table  table-bordered table-hover">
						<thead>
							<tr>
								<th>Date RDV</th>
								<th>Etat RDV</th>
								<th>Nom Patient</th>
								<th>Nom médecine</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($rdvs as $rdv)
							<tr>
								<td class="center">{{ $rdv->Date_RDV }}</td>
								<td class="center">{{ $rdv->Etat_RDV }}</td>
								<td class="center">
									{{ App\modeles\patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Nom }}
									{{ App\modeles\patient::where("id",$rdv->Patient_ID_Patient)->get()->first()->Prenom }}
								</td>
								<td class="center">
									{{ App\modeles\employ::where("id", $rdv->Employe_ID_Employe)->get()->first()->Nom_Employe }}
									{{ App\modeles\employ::where("id", $rdv->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
								</td>
								<td class="center">
									<a href="/consultations/create/{{$rdv->Patient_ID_Patient}}" class="btn btn-white">
										<i class="ace-icon fa fa-stethoscope"></i>
										Consultation
									</a>
									<a href="/rdv/reporter/{{$rdv->id}}" class="btn btn-white btn-primary">
										<i class="ace-icon fa fa-calendar-o"></i>
										Reporter
									</a>
									<a href="{{route('rdv.show', $rdv->id)}}" class="btn btn-white btn-warning">
										<i class="ace-icon fa fa-square-o"></i>
										Détails
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