@extends('app')
@section('main-content')
<div class="page-header">
     @include('patient._patientInfo', ['patient'=>$ordonnance->consultation->patient])
</div>
<div class="row">
  <div class="col-sm-12">
    <h3>Détails de l'ordonnance du &quot; {{ $ordonnance->consultation->date->format('Y-m-d') }} &quot;</h3>
  </div>
</div>
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
                    <th class="center">#</th><th  class="center">Nom</th>
                    <th  class="center">Dosage</th> <th  class="center">Forme</th>
                    <th  class="center">Posologie</th><th class="center"><em class="fa fa-cog"></em></th>
                   </tr>
                </thead>
                <tbody>
                  @foreach($ordonnance->medicamentes as $index => $med)
                  <tr>
                    <td>{{ $index + 1 }}</td><td>{{ $med->Nom_com }}</td>
                    <td>{{ $med->Dosage }}</td><td>{{ $med->Forme }}</td>
                    <td>{{ $med->pivot->posologie }}</td>
                    @if($loop->first)
                    <td rowspan ="{{ $ordonnance->medicamentes->count()}}" class="center align-middle">
                      <a href="{{route("print",$ordonnance->id)}}" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
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
@stop