@extends('app')
@section('main-content')
<div class="page-header">
	<h1><strong>Détails du Consultation Pour :</strong> 
		{{ $ordonnance->consultation->patient->Nom }} {{ $ordonnance->consultation->patient->Prenom }}
	</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<label><b>Date :</b></label>&nbsp;&nbsp;<span>{{ $ordonnance->date }}</span>
							<br><br>
							<table class="table table-striped table-bordered">
                                      <thead>
                                           <tr>
                                                <th class="center">#</th>
                                                <th><strong>Nom</strong></th>
                                                <th><strong>Dosage</strong></th>
                                                <th><strong>Forme</strong></th>
                                                <th>Posologie</th>
                                           </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($ordonnance->medicamentes as $index => $med)
                                        <tr>
                                          <td>{{ $index + 1 }}</td>
                                          <td>{{ $med->Nom_com }}</td>
                                          <td>{{ $med->Dosage }}</td>
                                          <td>{{ $med->Forme }}</td>
                                          <td>{{ $med->pivot->posologie }}</td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                    <a href="/showordonnance/{{ $ordonnance->id }}" target="_blank" class="btn btn-primary pull-right">
                                                        <i class="fa fa-eye"></i>&nbsp;Visualiser Ordonnance
                                            </a>
                      						</div>
                      					</div>
                      				</div>
                      			</div>
                      		</div>
                      	</div>
                      </div>
@endsection