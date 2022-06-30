@extends('app')
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
    introduction
    </div>
    @isset($consultation->demandeHospitalisation) 
    <div id="DH" class="tab-pane">
    demande d'hospitalisat
    </div>
    @endisset
    @isset($consultation->examensCliniques) 
    <div id="ExamClin" class="tab-pane">
    clinique
    </div>
    @endisset
    @if((isset($consultation->demandeexmbio)) || (isset($consultation->demandExmImg)) || (isset($consultation->examenAnapath)) || (isset($consultation->ordonnances)))
    <div id="ExamCompl" class="tab-pane"><div class="space-12 hidden-xs"></div> 
    complement
    </div>
    @endisset
    @isset($consultation->lettreOrintation)
    <div id="Orients" class="tab-pane"><div class="space-12 hidden-xs"></div> 
      cdcdcdc
    </div><!-- orients -->
    @endisset
  </div> <!-- tab-content  -->
</div><!-- tabbable -->
</div><!-- container-fluid -->
@endsection