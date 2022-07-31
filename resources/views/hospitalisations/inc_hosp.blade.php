<div class="page-header" style="margin-top:-5px;"><h5><strong>Résumé du l'hospitalisation :</strong></h5></div>
<div class="row">
	<div class="col-xs-12 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hospitalisation</span></strong></div>
</div>
<div class="row">
  <div class="col-sm-12">
  <ul class="nav navbar-nav list-inline">
{{-- <li class="list-inline-item" style="width:200px;"><i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Service->nom }}</li> --}}
    <li class="list-inline-item" style="width:200px;">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Spécialité :</strong>&nbsp;{{ $hosp->admission->demandeHospitalisation->Specialite->nom }}
    </li>
    <li class="list-inline-item" style="width:300px;">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Mode d'admission:</strong>&nbsp;
      <span class="badge badge-{{($hosp->admission->demandeHospitalisation->getModeAdmissionID($hosp->admission->demandeHospitalisation->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</span>
    </li>
    <li class="list-inline-item" style="width:300px;">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Médecin Traitant:</strong>&nbsp;
    {{ (isset($hosp->medecin)) ? $hosp->medecin->full_name : ''  }}  
    </li>
    <li class="list-inline-item" style="width:270px;">
     <i class="ace-icon fa fa-caret-right blue"></i><strong>Date d'entrée:</strong>&nbsp;
     {{ \Carbon\Carbon::parse($hosp->Date_entree)->format('d/m/Y') }}
    </li>
    <li class="list-inline-item" style="width:270px;"><i class="ace-icon fa fa-caret-right blue">
        </i><strong>Date sortie prévue:</strong>&nbsp;&nbsp;
        {{ \Carbon\Carbon::parse($hosp->Date_Prevu_Sortie)->format('d/m/Y') }}
      </li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Etat :</strong>
      <span class="badge badge-{{( $hosp->etat_id == 1 ) ? 'primary':'success' }}">{{ $hosp->etat }}</span>
    </li>
  </ul>
  </div>
</div>
@if($hosp->etat_id == 1)
<div class="space-12"></div>
<div class="row">
  <div class="col-xs-12 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:16px;">Sortie d'hospitalisation</span></strong></div>
</div>
<div class="row">
  <div class="col-sm-12">
  <ul class="nav navbar-nav list-inline">
    <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Date de sortie :</strong>&nbsp;&nbsp;
      {{ \Carbon\Carbon::parse($hosp->Date_Sortie)->format('d/m/Y') }}
    </li>
      <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>heure de sortie :</strong>&nbsp;&nbsp;
    {{ $hosp->Heure_sortie }}</li>
    <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Résumé de sortie :</strong>&nbsp;&nbsp;
    {{ $hosp->resumeSortie }}</li>
    <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Etat à la sortie :</strong>&nbsp;&nbsp;
    {{ $hosp->etatSortie }}</li> 
    <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Mode de sortie :</strong>&nbsp;&nbsp;
      @if(!(isset($hosp->modeSortie)))
          Domicile
        @else
          @switch($hosp->modeSortie)
            @case(0)
              Transfet
              @break
            @case(1)
              Contre avis médicale
              @break
            @case(2)
              Décés
              @break
            @case(3)
              reporter
              @break
            @default
              Domicile
              @break
          @endswitch
        @endif
    </li>  
</ul>
</div>
</div>
@endif
<div class="space-12"></div>
<div class="row">
	<div class="col-xs-12 label label-lg label-success arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hébergement</span></strong></div>
</div>
<div class="row">
  <div class="col-sm-12">
   <ul class="nav navbar-nav list-inline">
        <li class="list-inline-item" style="width: 300px;" >
            <i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;
        {{ $hosp->admission->demandeHospitalisation->bedAffectation->Lit->salle->service->nom }}
        </li>
        <li class="list-inline-item" style="width: 300px;"><i class="ace-icon fa fa-caret-right"></i><strong>Salle :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->nom }}</li>
        <li class="list-inline-item"style="width: 200px;"><i class="ace-icon fa fa-caret-right"></i><strong>Lit :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->nom }}</li>
    </ul>
  </div>
</div>

@if(isset($hosp->garde_id))
<div class="space-12"></div>
<div class="row">
	<div class="col-xs-12 label label-lg label-warning arrowed-in arrowed-right"><strong><span style="font-size:16px;">Garde Malade</span></strong>
	</div>
</div>
<div class="row">
    <ul class="nav navbar-nav list-inline">
      <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Nom & Prénom :</strong> {{ $hosp->garde->full_name}}</li>
      <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Né(e) le :</strong> {{ $hosp->garde->date_naiss }}</li>          
      <li>
         <i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Âge :</strong> <span class="badge badge-info">{{ Jenssegers\Date\Date::parse($hosp->garde->date_naiss)->age }}</span> ans
          </li>
      <li> <i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Qualité :</strong> <span class="badge badge-success">{{ $hosp->garde->lienP }}</li>
            <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Téléphone :</strong> <span class="badge badge-danger">{{ $hosp->garde->mob }}</li>   
    </ul>
</div>
@endif