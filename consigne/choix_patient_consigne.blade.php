@extends('app_recep')
@section('main-content')
    <div class="page-header">
        <h1 style="display: inline;"><strong>Choix Hospitalisation pour Patient :</strong></h1>
    </div>
     <!-- @if(session('info'))
                                          <div class="alert alert-success">
                                            {{session('info')}}
                                          </div>
                                          @endif-->
    <table id="patient-table-consigne" class="table  table-bordered table-hover">
    <thead>
        <tr>

            <th>Nom</th>
            <th>Prénom</th>
            <th>Sexe</th>
            <th>Age</th>
             <th>Date hospitalisation</th>
             <th>Date prévue sortie </th>
             <th>Date visite </th>
             <th>Heure visite</th>
             <th></th>
        </tr>
    </thead>
</table>
@endsection