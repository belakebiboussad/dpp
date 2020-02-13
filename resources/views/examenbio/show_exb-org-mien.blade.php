@extends('app')
@section('main-content')
<div class="page-header" width="100%">
     <h1><strong>Résumé  du Consultation Pour :</h1>
     <?php $patient = $demande->consultation->patient; ?>
    @include('patient._patientInfo', $patient)         
</div>
<div class="content">
  <div class="row">
    <div class="col-sm-12">
      <div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="center">#</th>
              <th>Examen</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
              @foreach($demande->examensbios as $index => $exm)
                <tr>
                  <td class="center">{{ $index + 1 }}</td>
                  <td>{{ $exm->nom_examen }}</td>
                  <td></td>
                </tr>
              @endforeach                         
          </tbody>
        </table>
      </div>
      <label>Résultat :</label>&nbsp;&nbsp;
      <span><a href='/download/{{ $demande->resultat }}'>{{ $demande->resultat }}</a></span>
      <a href="/showdemandeexb/{{ $demande->id_demandeexb }}" target="_blank" class="btn btn-primary pull-right">
        <i class="fa fa-print"></i>&nbsp;Imprimer
      </a>
    </div>
  </div>
</div>
@endsection
