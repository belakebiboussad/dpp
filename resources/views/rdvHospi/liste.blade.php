@extends('app_sur')
@section('main-content')
<div class="row"> <h2><strong>Liste des Rendez-Vous d'hospitalisation :</strong></h2></div><!-- /.page-header -->
<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
     <div class="widget-box widget-color-blue" id="widget-box-2">
           <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Rendez-Vous</h5></div>
                <div class="widget-body">
                    <div class="widget-main no-padding">
                      <table class="table table-striped table-bordered table-hover">
                        <thead class="thin-border-bottom">
                          <tr>
                            <th rowspan="2" hidden></th>
                            <th class="text-center" width="3%"  rowspan="2"  ></th>
                            <th class="text-center" rowspan="2" width="11%"><h5><strong>Patient</strong></h5></th>
                            <th class="text-center" colspan="2"><h5><strong>Entrée</strong></h5></th>
                            <th class="text-center" colspan="2"><h5><strong>Sortie Prévue</strong></h5></th>
                            <th class="font-weight-bold text-center" rowspan="2"><h5><strong>Medecin Traitant</strong></h5></th>
                            <th class="text-center" colspan="3"><h5><strong>Lit Réservé</strong></h5></th>
                            {{-- <th class="font-weight-bold text-center" rowspan="2"><strong>Lit</strong></th>
                            <th class="font-weight-bold text-center" rowspan="2"><strong>Salle</strong></th>
                            <th class="font-weight-bold text-center" rowspan="2"><strong>Service</strong></th> --}}
                            <th class="detail-col text-center" rowspan="2"><em class="fa fa-cog"></em></th>
                          </tr>
                          <tr>
                            <th class="text-center"><h5><strong>Date</strong></h5></th>
                            <th class="text-center"><h5><strong>Heure</strong></h5></th>
                            <th class="text-center"><h5><strong>Date</strong></h5></th>
                            <th class="text-center"><h5><strong>Heure</strong></h5></th>
                            <th class="font-weight-bold text-center"><strong>Lit</strong></th>
                            <th class="font-weight-bold text-center"><strong>Salle</strong></th>
                            <th class="font-weight-bold text-center"><strong>Service</strong></th>
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
                            <td>
                                 {{ $rdv->demandeHospitalisation->consultation->patient->Nom }}&nbsp;{{$rdv->demandeHospitalisation->consultation->patient->Prenom }}  
                            </td>
                            <td class ="text-danger"><strong>{{ $rdv->date_RDVh }}</strong></td>
                            <td><strong>{{ \Carbon\Carbon::parse($rdv->heure_RDVh)->format('H:i') }}</strong></td>
                            <td class="center text-danger"><strong>{{ $rdv->date_Prevu_Sortie }}</strong></td>
                            <td class="center text-danger">
                              <strong>{{ \Carbon\Carbon::parse($rdv->heure_Prevu_Sortie)->format('H:i') }}</strong>
                            </td>
                            <td><strong>{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->nom }}&nbsp;{{ $rdv->demandeHospitalisation->DemeandeColloque->medecin->prenom }}</strong></td>
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