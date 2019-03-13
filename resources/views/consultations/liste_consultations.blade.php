@extends('app_mscriptsed')
@section('page-script')
<script>
    $('#consultations').dataTable({
        ordering: true,
        "language": 
            {
                "url": '/localisation/fr_FR.json'
            }, 
    });
</script>
@endsection

@section('main-content')
<div class="page-header">
	<h1>Liste Des Consultations :</h1>
</div>
<div class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="widget-box transparent">
						<div class="widget-body">
							<div class="widget-main padding-24">
								<div>
									<table id="consultations" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Date</th>
												<th class="hidden-xs">Motif</th>
												<th class="hidden-480">Patient</th>
												<th>Medecin traitant</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach($consultations as $index => $consultation)
											<tr>
												<td class="center">{{ $index + 1 }}</td>
												<td>{{ $consultation->Date_Consultation }}</td>
												<td>{{ $consultation->Motif_Consultation }}</td>
												<td>
												{{ $consultation->patient->Nom }} {{ $consultation->patient->Prenom }}
												</td>
												<td>
												{{ $consultation->docteur->Nom_Employe }} {{ $consultation->docteur->Prenom_Employe }}
												</td>
												<td class="center">
													<a  href="{{ route('consultations.show', $consultation->id) }}" class="btn btn-xs btn-primary">
				 										<i class="fa fa-info"></i>
														&nbsp;&nbsp;Détails
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
		</div>
	</div>
</div>
@endsection