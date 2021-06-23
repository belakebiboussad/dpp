@extends('app_recep')
@section('main-content')
  <div class="page-header">
      <h1 style="display: inline;"><strong>Choix du patient :</strong></h1>
  </div>
  <table id="patient-table-visite" class="table  table-bordered table-hover">
    <thead>
        <tr>

            <th>Nom</th>
            <th>Prénom</th>
            <th>Genre</th>
            <th>Age</th>
             <th>Date hospitalisation</th>
             <th>Date prévue sortie </th>
            <th></th>
        </tr>

    </thead>
    <tbody>
     @foreach($patients as $p)
     <tr>
        <td> {{ $p->Nom }}</td>
        <td>{{ $p->Prenom }}</td>
        <td>{{ $p->Sexe }}</td>
        <td>{{ $p->Dat_Naissance }}</td>
        <td>{{ $p->Date_entree }}</td>
        <td>{{ $p->Date_Prevu_Sortie }}</td>
        <td>
          <a href="/visite/create/{{$p->id}}" class="btn btn-xs btn-success">
            <i class="ace-icon fa fa-sign-in bigger-120"></i>Ajouter une visite
          </a>
        </td>
      </tr>
      @endforeach 
    </tbody>
  </table>
@endsection