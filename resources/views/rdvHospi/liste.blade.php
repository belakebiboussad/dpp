@extends('app_sur')
@section('main-content')
<div class="row"> <h3><strong>Liste des rendez-vous d'hospitalisation :</strong></h3></div>
<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
     <div class="widget-box widget-color-blue" id="widget-box-2">
           <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Rendez-vous</h5></div>
                <div class="widget-body">
                    <div class="widget-main no-padding">
                      <table class="table table-striped table-bordered table-hover">
                        <thead class="thin-border-bottom">
                              <tr>
                                    <th rowspan="2" hidden></th>
                                     <th class="center" width="3%"  rowspan="2"  ></th>
                                     <th class="center" rowspan="2" width="11%"><h5><strong>Patient</strong></h5></th>
                                     <th class="center" colspan="2"><h5><strong>Entrée</strong></h5></th>
                                     <th class="center" colspan="2"><h5><strong>Sortie prévue</strong></h5></th>
                                      <th class="font-weight-bold center" rowspan="2"><h5><strong>Médecin traitant</strong></h5></th>
                                    <th class="center" colspan="3"><h5><strong>Lit réservé</strong></h5></th>
                                    {{-- <th class="font-weight-bold center" rowspan="2"><strong>Lit</strong></th>
                                    <th class="font-weight-bold center" rowspan="2"><strong>Salle</strong></th>
                                    <th class="font-weight-bold center" rowspan="2"><strong>Service</strong></th> --}}
                                    <th class="detail-col center" rowspan="2"><em class="fa fa-cog"></em></th>
                          </tr>
                          <tr>
                            <th class="center"><h5><strong>Date</strong></h5></th>
                            <th class="center"><h5><strong>Heure</strong></h5></th>
                            <th class="center"><h5><strong>Date</strong></h5></th>
                            <th class="center"><h5><strong>Heure</strong></h5></th>
                            <th class="font-weight-bold center"><strong>Lit</strong></th>
                            <th class="font-weight-bold center"><strong>Salle</strong></th>
                            <th class="font-weight-bold center"><strong>Service</strong></th>
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
                            <td class ="text-danger"><strong>{{ $rdv->date }}</strong></td>
                            <td><strong>{{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}</strong></td>
                            <td class="center text-danger"><strong>{{ $rdv->date_Prevu_Sortie }}</strong></td>
                            <td class="center text-danger">
                              <strong>{{ \Carbon\Carbon::parse($rdv->heure_Prevu_Sortie)->format('H:i') }}</strong>
                            </td>
                            <td><strong>{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->full_name }}</strong></td>
                            <td class="center">
                              @if(isset($rdv->bedReservation->id_lit)) {{ $rdv->bedReservation->lit->nom }} @else <strong>/</strong>  @endif    
                            </td>
                            <td>
                              @if(isset($rdv->bedReservation->id_lit)) {{ $rdv->bedReservation->lit->salle->nom }} @else <strong>/</strong> @endif    
                              {{ $rdv->nomsalle }}
                            </td>
                            <td>
                              @if(isset($rdv->bedReservation->id_lit)) {{ $rdv->bedReservation->lit->salle->service->nom }}  @else <strong>/</strong> @endif  
                            </td>
                            <td class="center">
                              <a href="{{ route('rdvHospi.edit',$rdv->id) }}" class="btn btn-success btn-xs"  title= "Reporer RDV" >
                                <i class="ace-icon fa fa-clock-o"></i>
                              </a>
                              <a href="/rdvHospi/imprimer/{{ $rdv->id }}" class="btn btn-info btn-xs" title="Imprimer RDV">
                                <i class="ace-icon fa fa-print" ></i>
                              </a>
                              <a href="{{ route('rdvHospi.destroy',$rdv->id) }}" class="btn btn-danger btn-xs" title="Annuler RDV" data-method="DELETE" data-confirm="Etes Vous Sur d'annuller le RDV?"><i class="fa fa-trash-o fa-xs"></i></a>
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
@endsection