@extends('app_med')

@section('main-content')
<div class="page-header">
	<h2><strong>Choix du patient :</strong></h2>
</div>
<div class="row">
	<div style="overflow-x:auto;">
		<div class="row"> 
			<div class="col-sm-4">
				<form action="" class="form-inline mb-3">
					<input type="text" class="form-control" name="q" value = "{{ request('q') }} ">
					<button class="btn btn-xs btn-primary "><i class="fa fa-search"></i>&nbsp;Rechercher</button>
				</form>
		     </div>
		   	
		     
		</div>
		<div class="space-12"></div>
		<div class="row">
			<table  id="example" class="table  table-bordered table-hover table-striped table-condensed table-responsive">
				<thead>
					<tr>
						<th class="text-center" width="45%"><strong>Motif Consultation</strong></th>
						<th class="text-center" width="15%">Date Consultation</th>
						<th class="text-center" width="15%"><strong>Patient</strong></th>
						<th class="text-center" width="15%">Médecine Traitant</th>
						<th width="10%"></th>
					</tr>
				</thead>
			</table>
			<div class="bodycontainer scrollable">
			<table class="table table-hover table-striped table-condensed table-scrollable">
			<tbody>
				@foreach($consultations as $consultation)
				<tr>
					<td class="center" width="45%">{{ $consultation->Motif_Consultation }}</td>
					<td class="center" width="15%">{{ $consultation->Date_Consultation }}</td>
					<td class="center" width="15%">
						{{ App\modeles\patient::where("id", $consultation->Patient_ID_Patient)->get()->first()->Nom }}
						{{ App\modeles\patient::where("id", $consultation->Patient_ID_Patient)->get()->first()->Prenom }}
					</td >
					<td class="center" width="15%">
						{{App\modeles\employ::where("id", $consultation->Employe_ID_Employe)->get()->first()->Nom_Employe }}
						{{App\modeles\employ::where("id", $consultation->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
					</td>
					<td  class="center" width="10%">
						<div class="hidden-sm hidden-xs btn-group">
		              		      <a class="btn btn-xs btn-success" href="{{ route('consultDetails', $consultation->id) }}">
		                 		       <i class="ace-icon fa fa-hand-o-up bigger-120"></i>Résumé
		              		      </a>
		           		     </div>
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