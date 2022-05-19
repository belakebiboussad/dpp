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
@endsection
@section('page-script')
<script>
  $(function(){
    $('body').on('click', '.orient-delete', function (e) {  
      event.preventDefault();
      var id = $(this).val(); 
      $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') }
      });
     
      $.ajax({
        type: "DELETE",
        url: '/orientLetter/' + id,
        dataType: 'json',
        success: function (data) {
          $("#orient-" + data.id).remove(); 
        },
        error: function (data) {
          console.log('Error:', data); 
        } 
      }); 
    });
    $('body').on('click', '.open-orient', function (event) {
      event.preventDefault();
      var id = $(this).val();
      $.get('/orientLetter/' + id, function (data) { 
        alert(data.id);
        /*
        $('#acc_id').val(data.id);
        $('#lieu').val(data.etablisement);
        $('#terme').val(data.terme);
        $('#presentation').val(data.presentation);
        $('#eggopenduration').val(data.eggopenduration);
        $('#workduration').val(data.workduration);
        $('#expulsduration').val(data.expulsduration);
        $('#incident').val(data.incident);
        $('#type').val(data.typeId).change();
        $('#motiftype').val(data.motif);
        $('#accouchSave').val("update");
        $('#accouchementModal').modal('show');
        */
      }); 
    });
  })
 </script>
@endsection 
@section('main-content')
 <div class="container-fluid">
<div class="row"><div class="col-sm-12"> @include('patient._patientInfo',['patient'=>$consultation->patient])</div></div>
 <div class="pull-right">
      <a href="{{route('consultations.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Consultations</a>
</div><div class="space-12"></div>
<div class="row"><h4>Détails de la Consultation du {{ $consultation->date}} :</h4></div> 
  <div class="tabbable"  class="user-profile">
    <ul class="nav nav-tabs padding-24">
      <li class="active"><a data-toggle="tab" href="#Intero">Interrogatoire</a></li>
        @isset($consultation->demandeHospitalisation) 
        <li ><a data-toggle="tab" href="#DH">Demande d'hospitalisation</a> </li>
        @endisset
        @isset($consultation->examensCliniques) 
          <li ><a data-toggle="tab" href="#ExamClin">Examen clinique</a> </li>
        @endisset
        @if((isset($consultation->demandeexmbio)) || (isset($consultation->demandExmImg)) || (isset($consultation->examenAnapath)) || (isset($consultation->ordonnances)))
          <li ><a data-toggle="tab" href="#ExamCompl">Examen Complémentaire /Ordonnance</a></li>
        @endif
        @isset($consultation->lettreOrintation)
          <li ><a data-toggle="tab" href="#Orients">Lettres d'orientations</a></li> 
        @endif
    </ul>
    <div class="tab-content no-border padding-24">
      <div id="Intero" class="tab-pane in active">
        <div class="row">
          <ul class="list-unstyled spaced">
            <li><i class="ace-icon fa fa-caret-right blue"></i><span class="f-16">Date de la consultation :</span> <span class="badge badge-pill badge-success">{{ $consultation->date }}</span></li>
            <li><i class="ace-icon fa fa-caret-right blue"></i><span class="f-16">Spécialite de la consultation :</span> <span class="badge badge-pill badge-success">{{ $consultation->medecin->Specialite->nom }}</span></li>
            <li><i class="ace-icon fa fa-caret-right blue"></i><span  class="f-16">Motif de la consultation : <blockquote>{{ $consultation->motif }}</blockquote></span></li>
            <li><i class="ace-icon fa fa-caret-right blue"></i><span  class="f-16">Histoire de la maladie : </span><span>{{ $consultation->histoire_maladie }} </span></li>
            <li><i class="ace-icon fa fa-caret-right blue"></i><span  class="f-16">Diagnostic :</span><span>{{ $consultation->Diagnostic }}</span> </li>
            <li><i class="ace-icon fa fa-caret-right blue"></i><span style="font-size:15px;">Résumé :</span><span> {{ $consultation->Resume_OBS }}</span></li>
          </ul>
        </div>
      </div>{{-- Intero --}}
       @isset($consultation->demandeHospitalisation) 
      <div id="DH" class="tab-pane">
       <div class="row">
          <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
            <strong><span style="font-size:18px;">Demande d'hospitalisation</span></strong>
          </div>
        </div>
        <div class="row">
        <div class="col-xs-11 widget-container-col" >
        <div class="widget-box widget-color-blue">
          <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande d'hospitalisation</h5></div>
            <div class="widget-body">
            <div class="widget-main no-padding">
            <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="center">Mode Admission</th>
                <th class="center">Spécialité</th>
                <th class="center">Service</th>
                <th class="center">Etat</th>
                @if($consultation->demandeHospitalisation->getEtatID($consultation->demandeHospitalisation->etat) == null)
                <th class="center"><em class="fa fa-cog"></em></th>
                @endif
              </tr>
            </thead>
            <tr>
              <td>
       <span class="badge badge-{{( $consultation->demandeHospitalisation->getModeAdmissionID($consultation->demandeHospitalisation->modeAdmission)) == 2 ? 'warning':'primary' }}">
          {{ $consultation->demandeHospitalisation->modeAdmission }}
      </span>
      </td>
      <td>{{$consultation->demandeHospitalisation->Specialite->nom}}</td>
      <td>{{$consultation->demandeHospitalisation->Service->nom}}</td>
      <td>
        <span class="badge badge-pill badge-primary">{{ $consultation->demandeHospitalisation->etat }}</span>
      </td>
      @if($consultation->demandeHospitalisation->getEtatID($consultation->demandeHospitalisation->etat) == null)
      <td class="center">
        <a href="{{ route('demandehosp.show', $consultation->demandeHospitalisation->id) }}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Détails demande" data-placement="bottom">
          <i class="fa fa-hand-o-up fa-xs" aria-hidden="true"></i>
        </a>
        <a href="{{ route('demandehosp.edit', $consultation->demandeHospitalisation->id) }}" class="btn btn-xs btn-success" data-toggle="tooltip" title="Modifier la demande" data-placement="bottom">
          <i class="ace-icon fa fa-pencil" aria-hidden="true"></i>
        </a>
        <button type="button" class="dh-delete btn btn-xs btn-danger" value='{{ $consultation->demandeHospitalisation->id }}' data-confirm="Etes Vous Sur ?"><i class="fa fa-trash-o fa-xs"></i></button>
      </td>
      @endif
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
          </div>{{-- ExamClin --}}
          @endisset
          @if((isset($consultation->demandeexmbio)) || (isset($consultation->demandExmImg)) || (isset($consultation->examenAnapath)) || (isset($consultation->ordonnances)))
          <div id="ExamCompl" class="tab-pane"><div class="space-12 hidden-xs"></div> 
           @if(isset($consultation->demandeexmbio))
                <div class="row">
                    <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
                      <strong><span style="font-size:18px;">Demande d'examen biologique</span></strong>
                    </div>
                </div>
                <div class="row">
                     <div class="col-xs-11 widget-container-col" >
                          <div class="widget-box widget-color-blue">
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
                                        <span class="badge badge-{{( $consultation->demandeexmbio->getEtatID($consultation->demandeexmbio->etat)) === 0 ? 'warning':'primary' }}"> {{ $consultation->demandeexmbio->etat }}</span>
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
                @if(isset($consultation->demandExmImg))
                <div class="row">
                      <div class="col-xs-11 label label-lg label-danger arrowed-in arrowed-right">
                          <strong><span style="font-size:18px;">Demande d'examen d'imagerie</span></strong>
                      </div>
                </div>
                <div class="row">
                  <div class="col-xs-11 widget-container-col">
                    <div class="widget-box widget-color-pink">
                          <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande d'examen d'imagerie</h5></div>
                          <div class="widget-body">
                               <div class="widget-main no-padding">
                                <table class="table table-striped table-bordered table-hover">
                                <thead class="thin-border-bottom">
                                      <tr>
                                        <th class="center"><strong>Date</strong></th><th class="center"><strong>Etat</strong></th>
                                            
                                            <th class="center"><em class="fa fa-cog"></em></th>
                                      </tr>
                                </thead>
                                <tbody>
                                <tr id="{{ 'demandeRad'.$consultation->demandExmImg->id }}">
                                <td>{{ $consultation->date }}</td>
                                <td>
                                  <span class="badge badge-{{( $consultation->demandExmImg->getEtatID($consultation->demandExmImg->etat)) === 0 ? 'warning':'primary' }}">{{ $consultation->demandExmImg->etat }}</span>
                                </td>
                                <td class="center">
                                    <a href="{{ route('demandeexr.show', $consultation->demandExmImg->id) }}" class="btn btn-info btn-xs"><i class="fa fa-hand-o-up fa-xs"></i></a>
                                    @if(!$consultation->demandExmImg->hasResult())
                                    <a href="{{ route('demandeexr.edit', $consultation->demandExmImg->id) }}" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil"></i></a>
                                    <!-- <a href="{{ route('demandeexr.destroy', $consultation->demandExmImg->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o"></i></a> -->
                                    <button type="button" class="btn btn-xs btn-danger delete-demandeRad" value="{{ $consultation->demandExmImg->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
                                    @endif
                                    <a href="/drToPDF/{{ $consultation->demandExmImg->id }}" target="_blank" class="btn btn-xs"><i class="ace-icon fa fa-print"></i>&nbsp;</a>
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
                  <div class="col-xs-11 widget-container-col">
                    <div class="widget-box widget-color-blue">
                      <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ordonnance</h5> </div>
                        <div class="widget-body">
                          <div class="widget-main no-padding">
                            <table class="table table-striped table-bordered table-hover">
                              <thead class="thin-border-bottom">
                                <tr>
                                   <th class="center"><strong>Date</strong></th>
                                  <th class="center"><em class="fa fa-cog"></em></th>
                               </tr>
                               </thead>
                               <tbody>
                                <tr>
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
          </div>      {{-- ExamCompl --}}
          @endif
          @isset($consultation->lettreOrintation)
          <div id="Orients" class="tab-pane">
            <div class="row">
              <div class="col-xs-11 widget-container-col">
                <div class="widget-box widget-color-blue">
                  <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ordonnance</h5> </div>
                  <div class="widget-body">
                    <div class="widget-main no-padding">
                      <table class="table table-striped table-bordered table-hover">
                        <thead class="thin-border-bottom">
                          <tr>
                            <th class="center"><strong>Spécialité</strong></th>
                            <th class="center"><strong>Motif</strong></th>
                            <th class="center"><strong>Examen</strong></th>
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
                          <a href="{{ route('orientLetter.edit', $orient->id) }}" class="btn btn-xs btn-success open-orient" data-toggle="tooltip" title="Modifier la lettre" data-placement="bottom">
                            <i class="ace-icon fa fa-pencil" aria-hidden="true"></i>
                          </a>
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
          @endisset
         </div>{{-- tab-content  --}}
    </div>  {{-- tabbable --}}
</div>    {{-- container-fluid --}}
<div class="row">@include('consultations.ModalFoms.LettreOrientationAdd',['patient'=>$consultation->patient])</div>
@endsection
@section('page-script')
@include('examenradio.scripts.imgRequestdJS')
@endsection
