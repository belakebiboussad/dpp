@extends('app_med')
@section('main-content')
<?php $patient = $consultation->patient; ?><div class="row">@include('patient._patientInfo', $patient)</div>
<div class="pull-right">
  <a href="{{route('consultations.edit',$consultation->id )}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-edit bigger-120 blue"></i>Edit</a>
</div>
<div class="row"><h3>Détails  du la Consultation :</h3> </div> 
<div class="tabbable"  class="user-profile">
      <ul class="nav nav-tabs padding-18">
          <li class="active"><a data-toggle="tab" href="#Intero"><i class="green ace-icon fa fa-user bigger-120"></i>Interogatoire</a></li>
      {{--     @if(isset($consultation->examensCliniques) ) --}}
              <li ><a data-toggle="tab" href="#ExamClin"><i class="green ace-icon fa fa-user bigger-120"></i>Examen Clinique</a> </li>
        {{--   @endif --}}
          @if(isset($consultation->demandeexmbio))
              <li ><a data-toggle="tab" href="#ExamBio"><i class="green ace-icon fa fa-user bigger-120"></i>Demande Examens Biologique</a> </li>
          @endif
          @if(isset($consultation->examensradiologiques))
              <li ><a data-toggle="tab" href="#Conslt"><i class="green ace-icon fa fa-user bigger-120"></i>Demande Examens Imagerie</a> </li>
          @endif
     </ul>
     <div class="tab-content no-border padding-24">
          <div id="Intero" class="tab-pane in active">
          <div class="row">
          <ul class="list-unstyled spaced">
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Date de la Consultation :</span> <span class="badge badge-pill badge-success">{{ $consultation->Date_Consultation }}</span></li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:16px;">Motif de la Consultation : <blockquote>{{ $consultation->Motif_Consultation }}</blockquote></span></li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Histoire de la maladie : </span><span>{{ $consultation->histoire_maladie }} </span></li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Diagnostic :</span><span>{{ $consultation->Diagnostic }}</span> </li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Résumé :</span><span> {{ $consultation->Resume_OBS }}</span></li>
          </ul>
          </div>
          </div>{{-- Intero --}}
          {{-- @if(isset($consultation->examensCliniques) ) --}}
          <div id="ExamClin" class="tab-pane in active"><div class="space-12"></div> 
          <div class="row">
                <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
                     <strong><span style="font-size:18px;">Demande Examens Biologique</span></strong>
              </div>
          </div>
          <div class="row">
                <div class="col-xs-11 widget-container-col" id="widget-container-col-2">
                <div class="widget-box widget-color-blue" id="widget-box-2">
                <div class="widget-header">
                  <h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande Examens Biologique</h5>
                </div>
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
                                        <span class="badge badge-success">Rejeté</span>   
                                     @endif
                                </td>
                                <td class="center">
                                     <a href="{{ route('demandeexb.show', $consultation->demandeexmbio->id) }}"><i class="fa fa-eye"></i></a>
                                    <a href="/showdemandeexb/{{ $consultation->demandeexmbio->id }}" target="_blank" class="btn btn-xs">
                                        <i class="ace-icon fa fa-print"></i>&nbsp;
                                     </a>
                                </td>
                          </tr>
                     </tbody>
                     </table>
                     </div>  
                </div>
                </div>
                </div>
          </div>
          </div>{{-- ExamClin --}}
          {{-- @endif --}}
      </div>
@endsection