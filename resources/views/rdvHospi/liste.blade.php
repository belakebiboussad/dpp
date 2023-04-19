@extends('app_sur')
@section('main-content')
<div class="page-header"><h1>Liste des rendez-vous d'hospitalisation</h1></div>
<div class="col-xs-12 widget-container-col">
<div class="widget-box widget-color-blue">
<div class="widget-header"><h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Rendez-vous</h5></div>
<div class="widget-body">
  <div class="widget-main no-padding">
    <table class="table table-striped table-bordered table-hover">
      <thead class="thin-border-bottom">
            <tr>
              <th rowspan="2" hidden></th>
               <th class="center" width="3%"  rowspan="2"></th>
               <th class="center" rowspan="2" width="11%">Patient</th>
               <th class="center" rowspan="2">Genre</th>
               <th class="center" rowspan="2">Mode d'admission</th>
               <th class="center" colspan="2">Entrée</th>
               <th class="center" colspan="2">Sortie prévue</th>
                <th class="font-weight-bold center" rowspan="2">Médecin traitant</th>
              <th class="center" colspan="3">Lit réservé</th>
              <th class="detail-col center" rowspan="2" width="15%"><em class="fa fa-cog"></em></th>
        </tr>
        <tr>
          <th class="center">Date</th>
          <th class="center">Heur</th>
          <th class="center">Date</th>
          <th class="center">Heure</th>
          <th class="font-weight-bold center">Lit</th>
          <th class="font-weight-bold center">Salle</th>
          <th class="font-weight-bold center">Service</th>
        </tr>
      </thead>
      <tbody id ="rendez-VousBody" class="bodyClass">
        <?php $j = 0; ?>
        @foreach( $rdvHospis as $i=>$rdv)
        <tr>
          <td hidden>{{ $j }}</td>  
          <td class="center">
            <label class="pos-rel">
              <input type="checkbox" class="ace" name ="valider[]" value ="{{$rdv->id}}" /><span class="lbl"></span>   
            </label>
          </td>
          <td>{{ $rdv->demandeHospitalisation->consultation->patient->full_name }}</td>
          <td>{{ $rdv->demandeHospitalisation->consultation->patient->Sexe }}</td>
          <td><span class="badge badge-{{( $rdv->demandeHospitalisation->getModeAdmissionID($rdv->demandeHospitalisation->modeAdmission)) == 2 ? 'warning':'primary' }}">
             {{ $rdv->demandeHospitalisation->modeAdmission }}</span>
          </td>
          <td class ="red">{{ $rdv->date->format('y-m-d') }}</td>
          <td>{{ $rdv->heur_formatted }}</td>
          <td class="center red">{{ $rdv->date_Prevu_Sortie }}</td>
          <td class="center red">{{ $rdv->heur_prev_sort_formatted}}</td>
          <td>
            {{ isset($specialite->dhValid, $rdv->demandeHospitalisation->DemeandeColloque ) ? $rdv->demandeHospitalisation->DemeandeColloque->medecin->full_nam: $rdv->demandeHospitalisation->consultation->medecin->full_name}}
          </td>
          <td class="center">
            @if(isset($rdv->bedReservation->id_lit)) {{ $rdv->bedReservation->lit->nom }} @endif    
          </td>
          <td>
            @if(isset($rdv->bedReservation->id_lit)) {{ $rdv->bedReservation->lit->salle->nom }} @endif    
            {{ $rdv->nomsalle }}
          </td>
          <td>
            @if(isset($rdv->bedReservation->id_lit)) {{ $rdv->bedReservation->lit->salle->service->nom }} @endif  
          </td>
          <td class="center" width="15%"><!-- can't edit rdv with affectation -->
            <a href="{{ route('rdvHospi.edit',$rdv->id) }}" class="btn btn-success btn-xs"  title= "Reporer RDV" @if($rdv->demandeHospitalisation->bedAffectation()->exists()) disabled @endif>
              <i class="ace-icon fa fa-clock-o fa-xs"></i>
            </a>
            <a href="/rdvHospi/imprimer/{{ $rdv->id }}" class="btn btn-info btn-xs" title="Imprimer RDV" target="_blank">
              <i class="ace-icon fa fa-print fa-xs" ></i>
            </a> <!-- can't delete rdv with affectation -->
            <a href="{{ route('rdvHospi.destroy',$rdv->id) }}" class="btn btn-danger btn-xs" title="Annuler RDV" data-method="DELETE" data-confirm="Etes Vous Sur d'annuller le RDV?" @if($rdv->demandeHospitalisation->bedAffectation()->exists()) disabled @endif><i class="fa fa-trash-o fa-xs"></i></a>
            <a href="/rdvHospi/ticketPrint/{{ $rdv->demandeHospitalisation->consultation->patient->id}}" class="btn btn-info btn-xs" title="Imprimer Ticket"><i class="fa fa-file-pdf-o fa-xs"></i></a>
          </td>
        </tr>     
        @endforeach
      </tbody>
    </table>
  </div>
      </div>
    </div>
  </div>
@stop