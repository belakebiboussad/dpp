@extends('app')
@section('main-content')
<div class="row" width="100%">
  <div class="col-sm-12" style="margin-top: -1%;">
    <?php $patient = $consultation->patient; ?> @include('patient._patientInfo', $patient)
  </div>
</div>
 <div class="pull-right">
   <a href="{{route('consultations.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Consultations</a>
</div>
<div class="row"><h4>Détails du la Consultation du "{{ $consultation->Date_Consultation}}" :</h4></div> 
  <div class="tabbable"  class="user-profile">
    <ul class="nav nav-tabs padding-18">
        <li class="active"><a data-toggle="tab" href="#Intero">Interogatoire</a></li>
          @if(isset($consultation->examensCliniques->id) )
        <li ><a data-toggle="tab" href="#ExamClin">Examen Clinique</a> </li>
          @endif
          @if((isset($consultation->demandeexmbio)) || (isset($consultation->examensradiologiques)) || (isset($consultation->examenAnapath)) || (isset($consultation->ordonnances)))
          <li ><a data-toggle="tab" href="#ExamCompl">Examen Complémentaire /Ordonnance</a></li>
          @endif
     </ul>
      <div class="tab-content no-border padding-24">
          <div id="Intero" class="tab-pane in active">
          <div class="row">
          <ul class="list-unstyled spaced">
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Date de la Consultation :</span> <span class="badge badge-pill badge-success">{{ $consultation->Date_Consultation }}</span></li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:16px;">Motif de la Consultation : <blockquote>{{ $consultation->motif }}</blockquote></span></li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Histoire de la maladie : </span><span>{{ $consultation->histoire_maladie }} </span></li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Diagnostic :</span><span>{{ $consultation->Diagnostic }}</span> </li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Résumé :</span><span> {{ $consultation->Resume_OBS }}</span></li>
          </ul>
          </div>
          </div>{{-- Intero --}}
          @if(isset($consultation->examensCliniques->id) )
          <div id="ExamClin" class="tab-pane">
              <div class="row">
                     <ul class="list-unstyled spaced">
                          <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Taille : <span class="badge badge-pill badge-primary"> {{ $consultation->examensCliniques->taille  }}</span></span>&nbsp;(m)</li>
                          <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Poids : <span class="badge badge-pill badge-danger"> {{ $consultation->examensCliniques->poids  }}</span></span>&nbsp;(kg)</li>
                          <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">IMC : <span class="badge badge-pill badge-danger"> {{ $consultation->examensCliniques->IMC  }}</span></span>&nbsp;</li>
                          <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Températeur : {{ $consultation->examensCliniques->temp  }}</span>&nbsp;&deg;C</li>
                          <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Autre : {{ $consultation->examensCliniques->autre  }}</span>&nbsp;</li>
                          <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Etat Géneral du patient  :</span>{{ $consultation->examensCliniques->Etat }}</li>
                          <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Peau et phanéres  : {{ $consultation->examensCliniques->peaupha  }}</span>&nbsp;</li>
                     </ul>
                </div>
          </div>{{-- ExamClin --}}
          @endif
          @if((isset($consultation->demandeexmbio)) || (isset($consultation->examensradiologiques)) || (isset($consultation->examenAnapath)) ||(isset($consultation->ordonnances)))
           <div id="ExamCompl" class="tab-pane"><div class="space-12 hidden-xs"></div> 
                @if(isset($consultation->demandeexmbio))
                <div class="row">
                    <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
                      <strong><span style="font-size:18px;">Demande Examens Biologique</span></strong>
                    </div>
                </div>
                <div class="row">
                     <div class="col-xs-11 widget-container-col" id="widget-container-col-2">
                          <div class="widget-box widget-color-blue" id="widget-box-2">
                          <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande Examens Biologique</h5></div>
                          <div class="widget-body">
                               <div class="widget-main no-padding">
                               <table class="table table-striped table-bordered table-hover">
                               <thead class="thin-border-bottom">
                                    <tr>
                                          <th class="center"><strong>#</strong></th>
                                          <th class="center"><strong>Date</strong></th>
                                          <th class="center"><strong>Etat</strong></th>
                                          <th class="center"><em class="fa fa-cog"></em></th>
                                     </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td class="center"></td>
                                    <td>{{ $consultation->Date_Consultation }}</td>
                                    <td>
                                    @if($consultation->demandeexmbio->etat == "E")
                                      <span class="badge badge-danger"> En Attente</span>
                                    @elseif($consultation->demandeexmbio->etat == "V")
                                      <span class="badge badge-success">Validé</span>       
                                    @else
                                      <span class="badge badge-danger">Rejeté</span>   
                                    @endif
                                    </td>
                                    <td class="center">
                                      <a href="{{ route('demandeexb.show', $consultation->demandeexmbio->id) }}" class="btn btn-secondary btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
                                      @if($consultation->demandeexmbio->etat == "E")
                                        <a href="{{ route('demandeexb.edit', $consultation->demandeexmbio->id) }}" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil"></i></a>
                                        <a href="{{ route('demandeexb.destroy', $consultation->demandeexmbio->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o"></i></a>
                                      @endif
                                      <a href="/dbToPDF/{{ $consultation->demandeexmbio->id }}" target="_blank" class="btn btn-info btn-xs"><i class="ace-icon fa fa-print"></i>&nbsp;</a> 
                                    </td>
                                </tbody>
                              </table>
                               </div>  
                          </div>
                          </div>
                     </div>
                </div><div class="space-12"></div>{{-- biologique --}}  
                @endif
                @if(isset($consultation->examensradiologiques))
                <div class="row">
                      <div class="col-xs-11 label label-lg label-danger arrowed-in arrowed-right">
                          <strong><span style="font-size:18px;">Demande Examens Imagerie</span></strong>
                      </div>
                </div>
                <div class="row">
                     <div class="col-xs-11 widget-container-col" id="widget-container-col-2">
                     <div class="widget-box widget-color-pink" id="widget-box-2">
                          <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande Examens Imagerie</h5></div>
                          <div class="widget-body">
                               <div class="widget-main no-padding">
                                <table class="table table-striped table-bordered table-hover">
                                <thead class="thin-border-bottom">
                                      <tr>
                                            <th class="center"><strong>#</strong></th>
                                            <th class="center"><strong>Date</strong></th>
                                            <th class="center"><strong>Etat</strong></th>
                                            <th class="center"><em class="fa fa-cog"></em></th>
                                      </tr>
                                </thead>
                                <tbody>
                                      <tr>
                                      <td class="center"></td>
                                      <td>{{ $consultation->Date_Consultation }}</td>
                                      <td>
                                        @if($consultation->examensradiologiques->etat == "E")
                                               <span class="badge badge-warning"> En Attente</span>
                                        @elseif($consultation->examensradiologiques->etat == "V")
                                              <span class="badge badge-success">Validé</span>   
                                        @else
                                                <span class="badge badge-danger">Rejeté</span>
                                        @endif
                                      </td>
                                      <td class="center">
                                          <a href="{{ route('demandeexr.show', $consultation->examensradiologiques->id) }}" class="btn btn-info btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
                                          @if($consultation->examensradiologiques->etat == "E")
                                          <a href="{{ route('demandeexr.edit', $consultation->examensradiologiques->id) }}" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil"></i></a>
                                          <a href="{{ route('demandeexr.destroy', $consultation->examensradiologiques->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o"></i></a>
                                          @endif
                                           <a href="/drToPDF/{{ $consultation->examensradiologiques->id }}" target="_blank" class="btn btn-xs"><i class="ace-icon fa fa-print"></i>&nbsp;
                                            </a>
                                      </td>
                                     </tr>
                                </tbody>
                                </table>
                              </div>  
                          </div>
                     </div>
                     </div>
                </div><div class="space-12"></div>{{-- radiologique --}}
                @endif
                @if(isset($consultation->ordonnances))
                <div class="row">
                     <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"> <strong><span style="font-size:18px;">Ordonnance</span></strong></div>
                </div>
                <div class="row">
                  <div class="col-xs-11 widget-container-col" id="widget-container-col-2">
                    <div class="widget-box widget-color-blue" id="widget-box-2">
                      <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ordonnance</h5> </div>
                        <div class="widget-body">
                          <div class="widget-main no-padding">
                            <table class="table table-striped table-bordered table-hover">
                              <thead class="thin-border-bottom">
                               <tr>
                                  <th class="center"><strong>#</strong></th>
                                  <th class="center"><strong>Date</strong></th>
                                  <th class="center"><em class="fa fa-cog"></em></th>
                               </tr>
                               </thead>
                               <tbody>
                                <tr>
                                  <td></td>
                                  <td>{{ $consultation->ordonnances->date }}</td>
                                  <td class="center">
                                    <a href="{{ route('ordonnace.show', $consultation->ordonnances->id) }}" class ="btn btn-secondary btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
                                    <a href="{{route("ordonnancePdf",$consultation->ordonnances->id)}}" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-print"></i>&nbsp;</a>
                                  </td>
                                </tr>
                               </tbody>
                               </table>
                          </div>
                          </div>
                     </div>
                     </div>
                </div>
                @endif
           </div> {{-- ExamCompl/Ord --}}
          @endif
     </div> {{-- tab-content  --}}
</div>{{-- tabbable --}}
@endsection