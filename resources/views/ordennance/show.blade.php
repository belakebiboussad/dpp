@extends('app')
@section('main-content')
<div class="row">
 <div class="col-sm-12" style="margin-top: -1%;">
    <?php $patient = $ordonnance->consultation->patient; ?> @include('patient._patientInfo', $patient)
    </div>
</div><div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
<div class="row">
  <div class="col-sm-12" style="margin-top: -2%;">
    <h3>Détails du l'ordonnance du " {{ $ordonnance->consultation->Date_Consultation }}" :</h3>
  </div>
</div><div class="space-12 hidden-xs"></div>
<div class="row">
  <div class="col-sm-12">
    <div class="widget-box">
      <div class="widget-body">
        <div class="widget-main">
          <div class="row">
            <div class="col-xs-12">
              <table class="table table-striped table-bordered">
                <thead>
                     <tr>
                          <th class="center">#</th>
                          <th  class="center"><strong>Nom</strong></th>
                          <th  class="center"><strong>Dosage</strong></th>
                          <th  class="center"><strong>Forme</strong></th>
                          <th  class="center">Posologie</th>
                          <th class="center"><em class="fa fa-cog"></em></th>
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
                    @if($loop->first)
                    <td rowspan ="{{ $ordonnance->medicamentes->count()}}" class="center align-middle"><a href="/showordonnance/{{ $ordonnance->id }}" target="_blank" class="btn btn-primary">
                      <i class="fa fa-print"></i>&nbsp;
                      </a>
                    </td>
                    @endif
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
@endsection