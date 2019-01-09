@extends('app_med')
@section('main-content')
<div class="page-header">
	<h1><strong>Détails du Consultation Pour :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title">Patient :</h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <label class="inline">
            <span class="blue"><strong>Nom :</strong></span>
            <span class="lbl"> {{ $patient->Nom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Prénom :</strong></span>
            <span class="lbl"> {{ $patient->Prenom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Sexe :</strong></span>
            <span class="lbl"> {{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Date Naissance :</strong></span>
            <span class="lbl"> {{ $patient->Dat_Naissance }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Age :</strong></span>
            <span class="lbl"> {{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans</span>
          </label>
        </div>
      </div>
    </div>
  </div>
</div>

  <div role= "tabpanel">
      <ul class = "nav nav-tabs nav-justified" role="tablist">
              <li role= "presentation" class="active"  style="padding-left: 5px; padding-right: 5px;">
                <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-primary">
                      <span class="bigger-130"> Interogatoire</span></a>
              </li>

              <li role= "presentation" style="padding-left: 5px; padding-right: 5px;">

                    <a href="#ExamClinique"  ria-controls="ExamClinique" role="tab" data-toggle="tab" class="btn btn-primary btn-lg   {{ ! isset($consultation) ? 'disabled' : 'enabled' }} " > 
                     <img height="20" width="30" class="thumbnail inline no-margin-bottom" alt="clinique" align="left" src="{{asset('/css/img/doctor-stethoscope.png')}}"/><span class="bigger-130">Examen Clinique</span></a>
              </li>

            
              <li role= "presentation"  style="padding-left: 5px; padding-right: 5px;">
                    <a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-primary btn-lg   {{ ! isset($consultation) ? 'disabled' : 'enabled' }} " >
                          <img height="20" width="30" class="thumbnail inline no-margin-bottom" alt="comp" align="left" src="{{asset('/css/img/medicine-flask.png')}}" />
                          <span class="bigger-130">Examen Complémentaire</span>
                    </a>
                </li>
              <li role= "presentation"  style="padding-left: 5px; padding-right: 5px;">
                <a href="#Prescription" aria-controls="AttachResultat" role="tab" data-toggle="tab"  class="btn btn-primary btn-lg {{ ! isset($consultation) ? 'disabled' : 'enabled' }} " >
                          
                <span class="bigger-130">Prescription</span></a>
              </li>
      </ul>
    <div class ="tab-content"  style = "border-style: none;" >
            <div role="tabpanel" class = "tab-pane active" id="Interogatoire"> 
                 <div class= "col-md-12 col-xs-12">
                     @include('consultations.Interogatoire')
                  </div>  {{--  <div class= "col-md-3 col-xs-9"> </div> --}}
            </div>
            
              <div role="tabpanel" class = "tab-pane" id="ExamClinique">
                      <div class= "col-md-12 col-xs-12">
                          @include('consultations.examenClinique')
                      </div>
                      {{-- <div class= "col-md-3 col-xs-9"></div> --}}
              </div> 

             <div role="tabpanel" class = "tab-pane" id="ExamComp">
                <div class= "col-md-12 col-xs-12">    
                 @if( !empty($consultation)) 
                        @include('consultations.ExamenCompl')
                 @endif
                   
                </div>
                {{-- <div class= "col-md-3 col-xs-9"> </div> --}}
            </div>
           <div role="tabpanel" class = "tab-pane" id="Prescription">
                <div class= "col-md-12 col-xs-12"> Prescription</div>  
               {{--  <div class= "col-md-3 col-xs-9"></div> --}}
                  @if( !empty($consultation)) 
                        @include('consultations.ExamenCompl.Ordonnance')
                 @endif
           </div>
    </div>
    </div>

@endsection