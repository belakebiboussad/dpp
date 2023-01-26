<div class="page-header mt-5"><h5>Résumé du l'hospitalisation :</h5></div>
<div class="row"><div class="col-xs-12 label label-lg label-primary arrowed-in arrowed-right">
  <span class="ft16"> Hospitalisation</span></div>
</div>
<div class="row">
  <div class="col-sm-12">
  <ul class="list-unstyled spaced">
    <li><i class="ace-icon fa fa-caret-right blue"></i>Spécialité : {{ $hosp->admission->demandeHospitalisation->Specialite->nom }}</li>
    <li><i class="ace-icon fa fa-caret-right blue"></i>Mode d'admission:
      <span class="badge badge-{{($hosp->admission->demandeHospitalisation->getModeAdmissionID($hosp->admission->demandeHospitalisation->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</span></li>
    <li><i class="ace-icon fa fa-caret-right blue"></i>Médecin Traitant:
     {{ (is_null($hosp->medecin)) ? '' : $hosp->medecin->full_name  }}</li> 
    <li><i class="ace-icon fa fa-caret-right blue"></i>Date d'entrée : {{$hosp->date->format('Y-m-d') }}</li>     
    <li><i class="ace-icon fa fa-caret-right blue"></i>Date sortie prévue : {{ $hosp->Date_Prevu_Sortie->format('Y-m-d') }}</li>
    <li><i class="ace-icon fa fa-caret-right blue"></i>Etat : {!! format_stat($hosp) !!}</li>
  </ul>
  </div>
</div>
@if(!empty($hosp->getEtatID()))
<div class="row">
  <div class="col-xs-12 label label-lg label-primary arrowed-in arrowed-right">
    <span class="ft16">Sortie d'hospitalisation</span></div>
</div>
<div class="row">
  <div class="col-sm-12">
  <ul class="list-unstyled spaced">
    <li><i class="ace-icon fa fa-caret-right blue"></i>Date de sortie :{{ $hosp->Date_Sortie->format('y-m-d') }}</li>
    <li><i class="ace-icon fa fa-caret-right blue"></i>heure de sortie : {{ $hosp->heur_sor_formatted }}</li>
    <li><i class="ace-icon fa fa-caret-right blue"></i>Résumé de sortie : {{ $hosp->resumeSortie }}</li>
    <li><i class="ace-icon fa fa-caret-right blue"></i>Etat à la sortie : {{ $hosp->etatSortie }}</li> 
    <li><i class="ace-icon fa fa-caret-right blue"></i>Mode de sortie :
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
@if(!is_null($hosp->modeSortie))
@switch($hosp->modeSortie)
  @case(0)
    <div class="row">
    <div class="col-xs-12 label label-lg label-primary arrowed-in arrowed-right"><span class="ft16">Transfert</span></div>
    </div>
    <ul class="list-unstyled spaced">
      <li><i class="ace-icon fa fa-caret-right blue"></i>Structure : {{ $hosp->Transfert->structure}}  </li>
     <li><i class="ace-icon fa fa-caret-right blue"></i>Motif du transfert : {{ $hosp->Transfert->motif }}</li>
    </ul>
    @break
  @case(1)
    Contre avis médicale
    @break
  @case(2)
    <div class="row">
    <div class="col-xs-12 label label-lg label-blank arrowed-in arrowed-right"><span class="ft16">Décès</span></div>
    </div>
    <div class="row">
    <div class="col-sm-12">
      <ul class="list-unstyled spaced">
<li><i class="ace-icon fa fa-caret-right blue"></i>Date décès : {{ $hosp->Dece->date->format('Y-m-d') }}</li>
        <li><i class="ace-icon fa fa-caret-right blue"></i>Heure décès : {{ $hosp->Dece->heur_formatted }}</li>
        <li><i class="ace-icon fa fa-caret-right blue"></i>Médecin constatant décès :
        {{ $hosp->Dece->Medecin->full_name }}</li>
        <li> <i class="ace-icon fa fa-caret-right blue"></i>Cause décès : {{$hosp->Dece->cause}}</li>
      </ul>
      </div>
    </div>
    @break
  @default
    @break
@endswitch
@endif
@endif
@if(!is_null($hosp->garde_id))
<div class="row">
<div class="col-xs-12 label label-lg label-warning arrowed-in arrowed-right"><span class="ft16">Garde Malade</span></div>
</div>
<div class="row">
  <ul class="list-unstyled spaced">
    <li><i class="ace-icon fa fa-caret-right blue"></i>Nom & Prénom : {{ $hosp->garde->full_name}}</li>
    <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i>Né(e) le : {{ $hosp->garde->date_naiss }}</li>          
    <li><i class="ace-icon fa fa-caret-right blue"></i>Âge : <span class="badge badge-info">{{ $hosp->garde->age }} ans</span></li>
    <li> <i class="ace-icon fa fa-caret-right blue"></i>Qualité :<span class="badge badge-success">{{ $hosp->garde->lienP }}</li>
    <li><i class="ace-icon fa fa-caret-right blue"></i>Téléphone :<span class="badge badge-danger">{{ $hosp->garde->mob }}</li>   
    </ul>
</div>
@endif
