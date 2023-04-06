@extends('app_sur')
@section('main-content')
<div class="page-header"><h4>Affactations des lits</h4></div>
<div class="row">
  <div class="col-xs-12 widget-container-col">
    <div class="widget-box widget-color-blue">
      <div class="widget-header">
        <h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des demandes de la semaine</h5>
      </div>
      <div class="widget-body">
        <div class="widget-main no-padding">
          <table class="table table-striped table-bordered table-hover">
            <thead class="thin-border-bottom">
              <tr>
                <th class="center">Patient</th>
                <th class="center">Genre</th>
              <!--   <th class="center">Date d'entrée</th>  <th class="center">Date sortie prévue</th> -->
                <th class="center">Service</th>
                <th class="center">Salle</th>
                <th class="center">Lit</th>
                <th class="center"><em class="fa fa-cog"></em></th>
              </tr>
            </thead>
            <tbody>
            @foreach($affects as $affect)
            <tr id ="{{ 'affect-' . $affect->id }}">
              <td>{{ $affect->demandeHosp->consultation->patient->full_name }}</td>
              <td>{{ $affect->demandeHosp->consultation->patient->Sexe }}</td>
              <td>{{ $affect->Lit->salle->service->nom }}</td>
              <td>{{ $affect->Lit->salle->nom }}</td>
              <td>{{ $affect->Lit->nom }}</td>
              <td class="center">
              <a href="{{ route('bedAffectation.destroy', $affect->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
              <i class="ace-icon fa fa-trash-o"></i>
              </a> {{--   <a href="{{ route('bedAffectation.destroy', $affect->demande_id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o"></i> --}}
              </td>
            </tr>
            @endforeach 
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@stop
