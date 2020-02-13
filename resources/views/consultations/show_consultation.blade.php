@extends('app_med')
@section('main-content')
<div class="page-header">
<<<<<<< HEAD
	<h1><strong>Détails du Consultation Pour :</strong> 
    {{ $consultation->patient->Nom }} {{ $consultation->patient->Prenom }}
  </h1>
=======
	<h1><strong>Résumé  du Consultation Pour :</h1>
    <?php $patient = $consultation->patient; ?>
     @include('patient._patientInfo', $patient)   
</div>
>>>>>>> dev
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
            <span class="lbl"> {{ $consultation->patient->Nom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Prénom :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Prenom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Sexe :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Date Naissance :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Dat_Naissance }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Age :</strong></span>
            <span class="lbl"> {{ Jenssegers\Date\Date::parse($consultation->patient->Dat_Naissance)->age }} ans</span>
          </label>
        </div>
      </div>
    </div>
  </div>
</div>
<<<<<<< HEAD
<div class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="widget-box">
        <div class="widget-body">
          <div class="widget-main">
            <div>
              <div id="user-profile-2" class="user-profile">
                <div class="tabbable">
                  <ul class="nav nav-tabs padding-18">
                    <li class="active">
                      <a data-toggle="tab" href="#home">
                        <i class="green ace-icon fa fa-heartbeat bigger-120"></i>
                        Détails Consultation
                      </a>
                    </li>
                    <li>
                      <a data-toggle="tab" href="#feed">
                        <i class="orange ace-icon fa fa-medkit bigger-120"></i>
                        Ordonnances
                      </a>
                    </li>
                    <li>
                      <a data-toggle="tab" href="#friends">
                        <i class="blue ace-icon fa fa-file-pdf-o bigger-120"></i>
                        Examens biologiques
                      </a>
                    </li>
                    <li>
                      <a data-toggle="tab" href="#pictures">
                        <i class="pink ace-icon fa fa-picture-o bigger-120"></i>
                        Examens radiologiques
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content no-border padding-24">
                    <div id="home" class="tab-pane in active">
                      <div class="row">
                        <div class="col-xs-12 col-sm-3 center">
                          <span class="profile-picture">
                            <img class="editable img-responsive" src="{{ asset('avatars/profile-pic.jpg') }}"/>
                          </span>
                          <div class="space space-4"></div>
                          <div class="profile-contact-info">
                            <div class="profile-contact-links align-left">
                              <a href="/ordonnace/create/{{ $consultation->id }}" class="btn btn-link">
                                <i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
                                Ordonnance
                              </a>

                              <a href="/demandeexbio/{{ $consultation->id }}" class="btn btn-link">
                                <i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
                                Demande examen biologique
                              </a>
=======
<div role= "tabpanel">
      <ul class = "nav nav-tabs nav-justified" role="tablist">
              <li role= "presentation" class="active"  style="padding-left: 5px; padding-right: 5px;">
                <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-primary">
                      <span class="bigger-130"> Interogatoire</span></a>
              </li>
>>>>>>> dev

                              <a href="/createexr/{{ $consultation->id }}" class="btn btn-link">
                                <i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
                                 Demande examen radiologique
                              </a>
                            </div>

<<<<<<< HEAD
                             <div class="space-6"></div>

                           </div>
                        </div><!-- /.col -->
                        <div class="col-xs-12 col-sm-9">
                          <div class="profile-user-info">
                            <div class="profile-info-row">
                              <div class="profile-info-name"> Date </div>
                              <div class="profile-info-value">
                                <span>{{ $consultation->Date_Consultation }}</span>
                              </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name"> Motif </div>
                              <div class="profile-info-value">
                                <span>{{ $consultation->Motif_Consultation }}</span>
                              </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name"> Histoire </div>
                              <div class="profile-info-value">
                                <span>{{ $consultation->histoire_maladie }}</span>
                              </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name"> Diagnostic </div>
                              <div class="profile-info-value">
                                <span>{{ $consultation->Diagnostic }}</span>
                              </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name"> Résumé </div>
                              <div class="profile-info-value">
                                <span>{{ $consultation->Resume_OBS }}</span>
                              </div>
                            </div>
                            <div class="profile-info-row">
                              <div class="profile-info-name"> Médecin </div>
                              <div class="profile-info-value">
                                <span>
                                  {{ $consultation->docteur->Nom_Employe }} {{ $consultation->docteur->Prenom_Employe }}
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="hr hr-8 dotted"></div>
                        </div><!-- /.col -->
                      </div><!-- /.row -->
                    </div><!-- /#home -->
                    <div id="feed" class="tab-pane">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class="center">#</th>
                            <th>Date</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($consultation->ordonnaces as $index => $ordonnace)
                          <tr>
                            <td class="center">{{ $index + 1 }}</td>
                            <td>{{ $ordonnace->date }}</td>
                            <td class="center">
                              <a href="{{ route('ordonnace.show', $ordonnace->id) }}">
                                <i class="fa fa-eye"></i>
                              </a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div><!-- /#feed -->
                    <div id="friends" class="tab-pane">
                      <div>
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th class="center">#</th>
                              <th>Date</th>
                              <th>Etat</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($consultation->demandeexmbio as $index => $demande)
                            <tr>
                              <td class="center">{{ $index +1 }}</td>
                              <td>{{ $demande->DateDemande }}</td>
                              <td>
                                @if($demande->etat == "E")
                                  En Attente
                                @elseif($demande->etat == "V")
                                  Validé
                                @else
                                  Rejeté
                                @endif
                              </td>
                              <td class="center">
                                <a href="{{ route('demandeexb.show', $demande->id_demandeexb) }}">
                                  <i class="fa fa-eye"></i>
                                </a>
                              </td>
                            </tr>
                          @endforeach               
                          </tbody>
                        </table>
=======
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
>>>>>>> dev
                      </div>
                    </div><!-- /#friends -->
                    <div id="pictures" class="tab-pane">
                      <div>
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th class="center">#</th>
                              <th>Date</th>
                              <th>Etat</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($consultation->examensradiologiques as $index => $exr)
                            <tr>
                              <td class="center">{{ $index + 1 }}</td>
                              <td>{{ $exr->Date }}</td>
                              <td>
                                @if($exr->etat == "E")
                                  En Attente
                                @elseif($exr->etat == "V")
                                  Validé
                                @else
                                  Rejeté
                                @endif
                              </td>
                              <td class="center">
                                <a href="{{ route('demandeexr.show', $exr->id) }}">
                                  <i class="fa fa-eye"></i>
                                </a>
                              </td>
                            </tr>
                            @endforeach               
                          </tbody>
                        </table>
                      </div>
                    </div><!-- /#pictures -->
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection