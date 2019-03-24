@extends('app')
@section('main-content')
<div class="page-header" width="100%">
{{--    <div class="row">
    <div class="col-sm-12">
      <div class="widget-box">
        <div class="widget-body">
          <div class="widget-main">
            <label class="inline">
            <span class="blue"><strong>Nom :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Nom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Prénom :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Prenom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Sexe :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Date Naissance :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Dat_Naissance }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Age :</strong></span>
            <span class="lbl"> {{ Jenssegers\Date\Date::parse($demande->consultation->patient->Dat_Naissance)->age }} ans</span>
          </label>
          </div>
        </div>
      </div>
    </div>
</div>
  @include('partials._patientInfo', array('patient')
 --}}
     <h1><strong>Résumé  du Consultation Pour :</h1>
     <?php $patient = $demande->consultation->patient; ?>
    @include('partials._patientInfo', $patient)         
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
        <i class="fa fa-eye"></i>&nbsp;
        Visualiser Demande examens biologiques
      </a>
    </div>
  </div>
</div>
@endsection
