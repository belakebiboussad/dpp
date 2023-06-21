@extends('app')
@section('style')
<style type="text/css" >
  td
  {
     max-width: 100px;
     overflow: hidden;
     text-overflow: ellipsis;
     white-space: nowrap;
  }
</style>
@stop
@section('main-content')
 <div class="container-fluid">
<div class="row"><div class="col-sm-12"> @include('patient._patientInfo',['patient'=>$consultation->patient])</div></div>
 <div class="pull-right">
      <a href="{{route('consultations.index')}}" class="btn btn-white btn-info"><i class="ace-icon fa fa-list bigger-120 blue"></i>Consultations</a>
</div><div class="space-12"></div>
<div class="page-header"><h1>Détails de la Consultation du &quot;{{ $consultation->date->format('Y-m-d')}}&quot;</h1></div> 
  <div class="tabbable"  class="user-profile">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#Intero">Interrogatoire</a></li>
        @isset($consultation->demandeHospitalisation) 
        <li ><a data-toggle="tab" href="#DH">Demande d'hospitalisation</a> </li>
        @endisset
        @isset($consultation->examensCliniques) 
          <li ><a data-toggle="tab" href="#ExamClin">Examens cliniques</a> </li>
        @endisset
        @if($consultation->examsAppareil->count() > 0) 
          <li ><a data-toggle="tab" href="#ExamApp">Examens appareils</a> </li>
        @endif
        @if((isset($consultation->demandeexmbio)) || (isset($consultation->demandExmImg)) || (isset($consultation->examenAnapath)) || (isset($consultation->ordonnances)))
          <li ><a data-toggle="tab" href="#ExamCompl">Examen Complémentaire /Ordonnance</a></li>
        @endif
        @if($consultation->lettreOrintation->count() > 0)
          <li ><a data-toggle="tab" href="#Orients">Lettres d'orientations</a></li> 
        @endif
    </ul>
    <div class="tab-content no-border">
      <div id="Intero" class="tab-pane in active">
        <div class="row">
          <ul class="list-unstyled spaced">
            <li><i class="ace-icon fa fa-caret-right"></i><span>Spécialite de la consultation :</span>
             <span class="badge badge-pill badge-success">
              @if(isset($consultation->medecin->specialite))
              {{ $consultation->medecin->Specialite->nom }}
              @else
              {{ $consultation->medecin->Service->Specialite->nom }}
              @endif
             </span>
             </li>
            <li><i class="ace-icon fa fa-caret-right"></i><span>Motif de la consultation : <blockquote>{{ $consultation->motif }}</blockquote></span></li>
            <li><i class="ace-icon fa fa-caret-right"></i><span>Histoire de la maladie : </span><span>{{ $consultation->histoire_maladie }} </span></li>
            <li><i class="ace-icon fa fa-caret-right"></i><span>Diagnostic :</span><span>{{ $consultation->Diagnostic }}</span> </li>
            <li><i class="ace-icon fa fa-caret-right"></i><span>Résumé :</span><span> {{ $consultation->Resume_OBS }}</span></li>
          </ul>
        </div>
      </div>{{-- Intero --}}
       @isset($consultation->demandeHospitalisation) 
      <div id="DH" class="tab-pane">
       <div class="row">
          <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right"><span class="ft16">Demande d'hospitalisation</span></div>
        </div>
        <div class="row">
        <div class="col-xs-12 widget-container-col" >
        <div class="widget-box widget-color-blue">
          <div class="widget-header"><h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Demande d'hospitalisation</h5></div>
            <div class="widget-body">
            <div class="widget-main no-padding">
            <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="center">Mode Admission</th><th class="center">Spécialité</th>
                <th class="center">Service</th><th class="center">Etat</th>
                <th class="center"><em class="fa fa-cog"></em></th>
                  
              </tr>
            </thead>
            <tbody>
            <tr id="{{ 'dh-'.$consultation->demandeHospitalisation->id }}">
            <td>{{ $consultation->demandeHospitalisation->modeAdmission }}</td>
            <td>{{$consultation->demandeHospitalisation->Specialite->nom}}</td>
            <td>{{$consultation->demandeHospitalisation->Service->nom}}</td>
            <td class="center">{!! $formatStat
($consultation->demandeHospitalisation->etat) !!}</td>
            <td class="center">
         <a href="{{ route('demandehosp.show', $consultation->demandeHospitalisation->id) }}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Détails demande" data-placement="bottom">
          <i class="fa fa-hand-o-up fa-xs" aria-hidden="true"></i></a>
        <a href="{{ route('demandehosp.edit', $consultation->demandeHospitalisation->id) }}" class="btn btn-xs btn-success{!! $isInprog($consultation->demandeHospitalisation) !!}" data-toggle="tooltip" title="Modifier la demande" data-placement="bottom"><i class="ace-icon fa fa-pencil"></i></a>
<button type="button" class="dh-delete btn btn-xs btn-danger{!! $isInprog($consultation->demandeHospitalisation) !!}" value='{{ $consultation->demandeHospitalisation->id }}' data-confirm="Etes Vous Sur ?"><i class="fa fa-trash-o fa-xs"></i></button>
    </td>
      </tbody>
  </table>
                       </div>
                      </div>
                    </div>
              </div>
      </div>
      </div> {{-- DH --}}
        @endisset
        @isset($consultation->examensCliniques) 
        <div id="ExamClin" class="tab-pane">
          <div class="row">
            <h4> Paramétres généreaux</h4>
             <ul class="list-unstyled spaced">
               @isset($consultation->examensCliniques->consts)
                    @foreach($specialite->Consts  as $const)
                     <li><i class="ace-icon fa fa-caret-right blue"></i><span>{{  $const ->description }}</span>
                      <span class="badge badge-pill badge-primary">{{ $consultation->examensCliniques->Consts[$const->nom] }}</span>
                       ({{ $const ->unite }})
                     </li>
                     @endforeach
             @endisset
              <li><i class="ace-icon fa fa-caret-right blue"></i><span>Etat général du patient  :</span>{{ $consultation->examensCliniques->Etat }}</li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span>Peau et phanéres  : {{ $consultation->examensCliniques->peaupha  }}</span></li>
                 <li><i class="ace-icon fa fa-caret-right blue"></i><span>Autre : {{ $consultation->examensCliniques->autre  }}</span></li>
               </ul>
            </div>
          </div>{{-- ExamClin --}}
          @endisset
          @if($consultation->examsAppareil->count()>0)
          <div id="ExamApp" class="tab-pane"><div class="space-12 hidden-xs"></div> 
            <div class="row">
             <h4 >Examens Appareils</h4>
             <ul class="list-unstyled spaced">
              @foreach($consultation->examsAppareil as $examAppareil)
                <li><i class="ace-icon fa fa-caret-right blue"></i>
                <span>Appareil {{ $examAppareil->nom }} : <blockquote>{{ $examAppareil->pivot->description}}</blockquote></span></li>
              @endforeach
             </ul>
            </div>
          </div><!-- ExamApp -->
          @endif 
          @if((isset($consultation->demandeexmbio)) || (isset($consultation->demandExmImg)) || (isset($consultation->examenAnapath)) || (isset($consultation->ordonnances)))
          <div id="ExamCompl" class="tab-pane"><div class="space-12 hidden-xs"></div> 
            @if(isset($consultation->demandeexmbio))
            <div class="row">
              <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><span class="ft16">Demande d'examen biologique</span> </div>
            </div>
            <div class="row">
              <div class="col-xs-12 widget-container-col" >
                  <div class="widget-box widget-color-blue">
                  <div class="widget-header"><h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Demande d'examens biologique</h5></div>
                  <div class="widget-body">
                       <div class="widget-main no-padding">
                       <table class="table table-striped table-bordered table-hover">
                       <thead class="thin-border-bottom">
                          <tr>
                            <th class="center">Date</th><th class="center">Etat</th>
                            <th class="center"><em class="fa fa-cog"></em></th>
                           </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ $consultation->date->format('Y-m-d') }}</td>
                            <td>{!! $formatStat
($consultation->demandeexmbio->etat) !!}</td>
                            <td class="center">
                            <a href="{{ route('demandeexb.show', $consultation->demandeexmbio->id) }}" class="btn btn-secondary btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
                            @if(($consultation->medecin->id) === (Auth::user()->employ->id))
                            <a href="{{ route('demandeexb.edit', $consultation->demandeexmbio->id) }}" class="btn btn-primary btn-xs{!!$isInprog($consultation->demandeexmbio)!!}"><i class="ace-icon fa fa-pencil"></i></a>
                            <a href="{{ route('demandeexb.destroy', $consultation->demandeexmbio->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-danger btn-xs{!!$isInprog($consultation->demandeexmbio)!!}"><i class="ace-icon fa fa-trash-o"></i></a>
                            <a href="/dbToPDF/{{ $consultation->demandeexmbio->id }}" target="_blank" class="btn btn-info btn-xs"><i class="ace-icon fa fa-print"></i></a> 
                              @endif
                            </td>
                        </tbody>
                      </table>
                       </div>  
                  </div>
                  </div>
                  </div>
                </div><div class="space-12"></div>{{-- biologique --}}  
                @endif
                @if(isset($consultation->demandExmImg))
                <div class="row"><div class="col-xs-11 label label-lg label-danger arrowed-in arrowed-right"> <span class="ft16">Demande d'examen d'imagerie</span></div>
                </div>
                <div class="row">
                  <div class="col-xs-12 widget-container-col">
                  <div class="widget-box widget-color-pink">
                    <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande d'examen d'imagerie</h5></div>
                      <div class="widget-body">
                        <div class="widget-main no-padding">
                        <table class="table table-striped table-bordered table-hover">
                          <thead class="thin-border-bottom">
                              <tr>
                                <th class="center">Date</th><th class="center">Etat</th>
                                <th class="center"><em class="fa fa-cog"></em></th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr id="{{ 'demandeRad'.$consultation->demandExmImg->id }}">
                            <td>{{ $consultation->date->format('Y-m-d') }}</td>
                            <td>{!! $formatStat
($consultation->demandExmImg->etat) !!}</td>
                            <td class="center">
                              <a href="{{ route('demandeexr.show', $consultation->demandExmImg->id) }}" class="btn btn-info btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
                              @if(!$consultation->demandExmImg->hasResult())
                              <a href="{{ route('demandeexr.edit', $consultation->demandExmImg->id) }}" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil"></i></a>
                              <button type="button" class="btn btn-xs btn-danger delete-demandeRad" value="{{ $consultation->demandExmImg->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
                              @endif
                              <a href="/drToPDF/{{ $consultation->demandExmImg->id }}" target="_blank" class="btn btn-xs"><i class="ace-icon fa fa-print"></i></a>
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
                <div class="row"><div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><span class="ft16">Ordonnance</span></div></div>
                 <div class="row">
                  <div class="col-xs-12 widget-container-col">
                    <div class="widget-box widget-color-blue">
                      <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ordonnance</h5></div>
                        <div class="widget-body">
                          <div class="widget-main no-padding">
                            <table class="table table-striped table-bordered table-hover">
                              <thead class="thin-border-bottom">
                                <tr>
                                  <th class="center">Date</th>
                                  <th class="center">Médecin prescripteur</th>
                                  <th class="center"><em class="fa fa-cog"></em></th>
                               </tr>
                               </thead>
                               <tbody>
                                <tr>
                                  <td>{{ $formatDate($consultation->date) }}</td>
                                   <td>{{ $consultation->medecin->full_name }}</td>
                                  <td class="center">
                                  <a href="{{ route('ordonnace.show', $consultation->ordonnances->id) }}" class ="btn btn-secondary btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
                                  <a href="{{route("print",$consultation->ordonnances->id)}}" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
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
          </div>      {{-- ExamCompl --}}
          @endif
          @isset($consultation->lettreOrintation)
          <div id="Orients" class="tab-pane">
            <div class="row">
              <div class="col-xs-12 widget-container-col">
                <div class="widget-box widget-color-blue">
                  <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ordonnance</h5> </div>
                  <div class="widget-body">
                    <div class="widget-main no-padding">
                      <table class="table table-striped table-bordered table-hover">
                        <thead class="thin-border-bottom">
                          <tr>
                            <th class="center">Spécialité</th>  <th class="center">Motif</th>
                            <th class="center">Examen</th>
                            <th class="center"><em class="fa fa-cog"></em></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($consultation->lettreOrintation as $orient)
                        <tr id="{{ 'orient-'.$orient->id }}">
                          <td>{{ $orient->Specialite->nom }}</td>
                          <td>{{ $orient->motif }}</td>
                          <td>{{ $orient->examen }}</td>
                          <td class="center">
                          <button class="btn btn-xs btn-success open-orient" data-toggle="tooltip" title="Modifier la lettre" data-placement="bottom" value='{{ $orient->id }}'><i class="ace-icon fa fa-pencil" aria-hidden="true"></i> 
                          </button>
                          <button type="button" class="orient-delete btn btn-xs btn-danger" value='{{ $orient->id }}' data-confirm="Etes Vous Sur ?"><i class="fa fa-trash-o fa-xs"></i></button>
                          </td>
                        </tr>   
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- orients -->
          <div class="row">@include('consultations.ModalFoms.LettreOrientationAdd',['patient'=>$consultation->patient])</div>
          @endisset
         </div>{{-- tab-content  --}}
    </div>  {{-- tabbable --}}
</div>    {{-- container-fluid --}}
@stop
@section('page-script')
@include('consultations.scripts.functions')
@include('examenradio.scripts.imgRequestdJS')
<script>
  $(function(){
    $('body').on('click', '.orient-delete', function (e) {  
      event.preventDefault();
      var id = $(this).val(); 
      $.ajax({
        type: "DELETE",
        url: '/orientLetter/' + id,
        dataType: 'json',
        data: { _token: CSRF_TOKEN },
        success: function (data) {
          $("#orient-" + data.id).remove(); 
        },
        error: function (data) {
          console.log('Error:', data); 
        } 
      }); 
    });
  })
 </script>
@stop
