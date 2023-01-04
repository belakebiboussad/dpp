<div class="page-header mt-5" ><h5>Résumé du l'hospitalisation :</h5></div>
<div class="row">
  <div class="col-xs-12 label label-lg label-primary arrowed-in arrowed-right"><span style="font-size:16px;">Hospitalisation</span></div>
</div>
<div class="row">
  <div class="col-sm-12">
  <ul class="nav navbar-nav list-inline">
    <li class="list-inline-item" style="width:200px;">
      <i class="ace-icon fa fa-caret-right blue"></i>Spécialité :{{ $hosp->admission->demandeHospitalisation->Specialite->nom }}
    </li>
    <li class="list-inline-item" style="width:300px;">
      <i class="ace-icon fa fa-caret-right blue"></i>Mode d'admission:
      <span class="badge badge-{{($hosp->admission->demandeHospitalisation->getModeAdmissionID($hosp->admission->demandeHospitalisation->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</span>
    </li>
    <li class="list-inline-item" style="width:300px;">
      <i class="ace-icon fa fa-caret-right blue"></i>Médecin Traitant:
    {{ (isset($hosp->medecin)) ? $hosp->medecin->full_name : ''  }}  
    </li>
    <li class="list-inline-item" style="width:270px;">
     <i class="ace-icon fa fa-caret-right blue"></i>Date d'entrée : {{ $hosp->date->format('Y-m-d') }}
     
    </li>
    <li class="list-inline-item" style="width:270px;"><i class="ace-icon fa fa-caret-right blue">
        </i>Date sortie prévue :
        {{ $hosp->Date_Prevu_Sortie->format('Y-m-d') }}
      </li>
    <li><i class="ace-icon fa fa-caret-right blue"></i>Etat :
      <span class="badge badge-{{( $hosp->etat_id == 1 ) ? 'primary':'success' }}">{{ $hosp->etat }}</span>
    </li>
  </ul>
  </div>
</div>
@if($hosp->etat_id == 1)
<div class="space-12"></div>
<div class="row">
  <div class="col-xs-12 label label-lg label-primary arrowed-in arrowed-right"><span style="font-size:16px;">Sortie d'hospitalisation</span></div>
</div>
<div class="row">
  <div class="col-sm-12">
  <ul class="nav navbar-nav list-inline">
    <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i>Date de sortie :{{ $hosp->Date_Sortie->format('y-m-d') }}
    </li>
    <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i>heure de sortie :{{ $hosp->Heure_sortie }}</li>
    <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i>Résumé de sortie :{{ $hosp->resumeSortie }}</li>
    <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i>Etat à la sortie : {{ $hosp->etatSortie }}</li> 
    <li class="list-inline-item">
      <i class="ace-icon fa fa-caret-right blue"></i>Mode de sortie :
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
              Décès
              @break
            @case(3)
              Reporter
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
 <div class="space-12"></div>
 @isset($hosp->modeSortie)
      @switch($hosp->modeSortie)
      @case(0)
             <div class="row">
                   <div class="col-xs-12 label label-lg label-primary arrowed-in arrowed-right"><span style="font-size:16px;">Transfert</span></div>
               </div>
               <ul class="nav navbar-nav list-inline">
                      <li class="list-inline-item">
                      <i class="ace-icon fa fa-caret-right blue"></i>Structure :  {{ $hosp->Transfert->structure}}   </li>
                     <li class="list-inline-item">
                      <i class="ace-icon fa fa-caret-right blue"></i>Motif du transfert :  {{ $hosp->Transfert->motif }}  </li>
                </ul>
              @break
       @case(1)
              Contre avis médicale
              @break
       @case(2)
               <div class="space-12"></div>
    <div class="row">
      <div class="col-xs-12 label label-lg label-blank arrowed-in arrowed-right"><span style="font-size:16px;">Décès</span></div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <ul class="nav navbar-nav list-inline">
          <li class="list-inline-item">
            <i class="ace-icon fa fa-caret-right blue"></i>Date décès :
              {{ $hosp->Dece->date->format('d/m/Y') }}
          </li>
          <li class="list-inline-item">
            <i class="ace-icon fa fa-caret-right blue"></i>Heure décès :
              {{ $hosp->Dece->heure }}
          </li>
          <li class="list-inline-item">
            <i class="ace-icon fa fa-caret-right blue"></i>Médecin constatant décès :
              {{ $hosp->Dece->Medecin->full_name }}
          </li>
          <li class="list-inline-item">
            <i class="ace-icon fa fa-caret-right blue"></i>Cause décès :
              {{ $hosp->Dece->cause }}
          </li>
        </ul>
      </div>
    </div>
              @break
           @default
              @break
          @endswitch
        @endisset
@endif
@isset($hosp->garde_id)
<div class="space-12"></div>
<div class="row">
  <div class="col-xs-12 label label-lg label-warning arrowed-in arrowed-right"><span style="font-size:16px;">Garde Malade</span>
  </div>
</div>
<div class="row">
    <ul class="nav navbar-nav list-inline">
      <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i>Nom & Prénom :{{ $hosp->garde->full_name}}</li>
      <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i>Né(e) le : {{ $hosp->garde->date_naiss }}</li>          
      <li>
         <i class="ace-icon fa fa-caret-right blue list-inline-item"></i>Âge :<span class="badge badge-info">{{ Jenssegers\Date\Date::parse($hosp->garde->date_naiss)->age }}</span> ans
          </li>
      <li> <i class="ace-icon fa fa-caret-right blue list-inline-item"></i>Qualité :<span class="badge badge-success">{{ $hosp->garde->lienP }}</li>
            <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i>Téléphone :<span class="badge badge-danger">{{ $hosp->garde->mob }}</li>   
    </ul>
</div>
@endisset