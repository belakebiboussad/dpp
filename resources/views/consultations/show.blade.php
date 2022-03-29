@extends('app')
@section('main-content')
<div class="row" width="100%">
      <div class="col-sm-12" style="margin-top: -1%;"><?php $patient = $consultation->patient; ?> @include('patient._patientInfo', $patient)</div>
</div>
 <div class="pull-right">
      <a href="{{route('consultations.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Consultations</a>
</div>
<div class="row"><h4>Détails de la Consultation du {{ $consultation->date}} :</h4></div> 
  <div class="tabbable"  class="user-profile">
    <ul class="nav nav-tabs padding-18">
        <li class="active"><a data-toggle="tab" href="#Intero">Interrogatoire</a></li>
          @if(isset($consultation->examensCliniques) )
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
            <li><i class="ace-icon fa fa-caret-right blue"></i><span class="f-16">Date de la consultation :</span> <span class="badge badge-pill badge-success">{{ $consultation->date }}</span></li>
            <li><i class="ace-icon fa fa-caret-right blue"></i><span  class="f-16">Motif de la consultation : <blockquote>{{ $consultation->motif }}</blockquote></span></li>
            <li><i class="ace-icon fa fa-caret-right blue"></i><span  class="f-16">Histoire de la maladie : </span><span>{{ $consultation->histoire_maladie }} </span></li>
            <li><i class="ace-icon fa fa-caret-right blue"></i><span  class="f-16">Diagnostic :</span><span>{{ $consultation->Diagnostic }}</span> </li>
            <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Résumé :</span><span> {{ $consultation->Resume_OBS }}</span></li>
          </ul>
          </div>
          </div>{{-- Intero --}}
          @if(isset($consultation->examensCliniques) )
          <div id="ExamClin" class="tab-pane">
            <div class="row">
               <h4 > Paramétres généreaux</h4>
              <ul class="list-unstyled spaced">
                @if(isset($consultation->examensCliniques->consts))
                       @foreach(json_decode($specialite->consConst ,true) as $const)
                       <?php $obj = App\modeles\Constante::FindOrFail($const) ; $nom = $obj->nom   ?>
                      @if($consultation->examensCliniques->consts[$obj->nom ] != null)  
                              <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">{{  $obj ->description }}</span>
                                     <span class="badge badge-pill badge-primary">{{ $consultation->examensCliniques->Consts->$nom }}</span>&nbsp;({{$obj ->unite }})
                              </li>
                       @endif
                     @endforeach
                @endif
              <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Etat général du patient  :</span>{{ $consultation->examensCliniques->Etat }}</li>
                <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Peau et phanéres  : {{ $consultation->examensCliniques->peaupha  }}</span>&nbsp;</li>
                 <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Autre : {{ $consultation->examensCliniques->autre  }}</span>&nbsp;</li>
               </ul>
            </div>
            @if($consultation->examensCliniques->examsAppareil->count()>0)
              <div class="row">
               <h4 >Examens Appareils</h4>
               <ul class="list-unstyled spaced">
                @foreach($consultation->examensCliniques->examsAppareil as $examAppareil)
                      <li><i class="ace-icon fa fa-caret-right blue"></i><span  class="f-16">Appareil {{ $examAppareil->Appareil->nom }} : <blockquote>{{ $examAppareil->description}}</blockquote></span></li>
                @endforeach
               </ul>
               </div>
             @endif 
          </div>
          @endif
          @if((isset($consultation->demandeexmbio)) || (isset($consultation->examensradiologiques)) || (isset($consultation->examenAnapath)) ||(isset($consultation->ordonnances)))
           <div id="ExamCompl" class="tab-pane"><div class="space-12 hidden-xs"></div> 
                @if(isset($consultation->demandeexmbio))
                <div class="row">
                    <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
                      <strong><span style="font-size:18px;">Demande d'examen biologique</span></strong>
                    </div>
                </div>
                <div class="row">
                     <div class="col-xs-11 widget-container-col" id="widget-container-col-2">
                          <div class="widget-box widget-color-blue" id="widget-box-2">
                          <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande d'examens biologique</h5></div>
                          <div class="widget-body">
                               <div class="widget-main no-padding">
                               <table class="table table-striped table-bordered table-hover">
                               <thead class="thin-border-bottom">
                                  <tr>
                                    <th class="center"><strong>Date</strong></th> <th class="center"><strong>Etat</strong></th>
                                    <th class="center"><em class="fa fa-cog"></em></th>
                                   </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>{{ $consultation->date }}</td>
                                    <td>
<span class="badge badge-{{( $consultation->demandeexmbio->getEtatID($consultation->demandeexmbio->etat)) === 0 ? 'warning':'primary' }}">
                {{ $consultation->demandeexmbio->etat }}</span>
                                    </td>
                                    <td class="center">
                                      <a href="{{ route('demandeexb.show', $consultation->demandeexmbio->id) }}" class="btn btn-secondary btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
                                      @if($consultation->medecin->id == Auth::user()->employ->id)
                                        @if($consultation->demandeexmbio->etat == "En Cours")
                                        <a href="{{ route('demandeexb.edit', $consultation->demandeexmbio->id) }}" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil"></i></a>
                                        <a href="{{ route('demandeexb.destroy', $consultation->demandeexmbio->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o"></i></a>
                                        @endif
                                      <a href="/dbToPDF/{{ $consultation->demandeexmbio->id }}" target="_blank" class="btn btn-info btn-xs"><i class="ace-icon fa fa-print"></i>&nbsp;</a> 
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
                @if(isset($consultation->examensradiologiques))
                <div class="row">
                      <div class="col-xs-11 label label-lg label-danger arrowed-in arrowed-right">
                          <strong><span style="font-size:18px;">Demande d'examen d'imagerie</span></strong>
                      </div>
                </div>
                <div class="row">
                     <div class="col-xs-11 widget-container-col" id="widget-container-col-2">
                     <div class="widget-box widget-color-pink" id="widget-box-2">
                          <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande d'examen d'imagerie</h5></div>
                          <div class="widget-body">
                               <div class="widget-main no-padding">
                                <table class="table table-striped table-bordered table-hover">
                                <thead class="thin-border-bottom">
                                      <tr>
                                            <th class="center"><strong>Date</strong></th>
                                            <th class="center"><strong>Etat</strong></th>
                                            <th class="center"><em class="fa fa-cog"></em></th>
                                      </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td>{{ $consultation->date }}</td>
                                <td>
                                  <span class="badge badge-{{( $consultation->examensradiologiques->getEtatID($consultation->examensradiologiques->etat)) === 0 ? 'warning':'primary' }}">{{ $consultation->examensradiologiques->etat }}</span>
                                </td>
                                <td class="center">
                                    <a href="{{ route('demandeexr.show', $consultation->examensradiologiques->id) }}" class="btn btn-info btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
                                    @if(!$consultation->examensradiologiques->hasResult())
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