<div class="page-header" style="margin-top:-5px;"><h5><strong>Détails de l'hospitalisation :</strong></h5></div>
<div class="row">
	<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hospitalisation</span></strong></div>
</div>
<div class="row">
  <div class="col-sm-12">
  <ul class="nav navbar-nav list-inline">
{{-- <li class="list-inline-item" style="width:200px;"><i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Service->nom }}</li> --}}
    <li class="list-inline-item" style="width:200px;">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Spécialité :</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Specialite->nom }}
    </li>
    <li class="list-inline-item" style="width:300px;">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Mode d'admission:</strong>&nbsp;&nbsp;
      <span class="badge badge-{{($hosp->admission->demandeHospitalisation->getModeAdmissionID($hosp->admission->demandeHospitalisation->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</span>
    </li>
    <li class="list-inline-item" style="width:300px;">
      <i class="ace-icon fa fa-caret-right blue"></i><strong>Médecin Traitant:</strong>&nbsp;&nbsp;
    {{ $hosp->medecin->nom }} {{$hosp->medecin->prenom}}    
    </li>
    <li class="list-inline-item" style="width:270px;">
     <i class="ace-icon fa fa-caret-right blue"></i><strong>Date d'entrée:</strong>&nbsp;&nbsp;{{ $hosp->Date_entree }}
    </li>
    @if($hosp->etat == 1 )
    <li class="list-inline-item" style="width:270px;"><i class="ace-icon fa fa-caret-right blue">
      </i><strong>Date sortie:</strong>&nbsp;&nbsp;{{ $hosp->Date_Sortie }}
    </li>
    @else
      <li class="list-inline-item" style="width:270px;"><i class="ace-icon fa fa-caret-right blue">
        </i><strong>Date sortie prévue:</strong>&nbsp;&nbsp;{{ $hosp->Date_Prevu_Sortie }}
      </li>
    @endif
    <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Etat :</strong>
      <span class="badge badge-{{( $hosp->etat_id == 1 ) ? 'primary':'success' }}">{{ $hosp->etat }}</span>
    </li>
  </ul>
  </div>
</div>
@if($hosp->etat_id == 1)
<div class="space-12"></div>
<div class="row">
  <div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:16px;">Sortie d'hospitalisation</span></strong></div>
</div>
<div class="row">
  <div class="col-sm-12">
  <ul class="nav navbar-nav list-inline">
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

@endif
<div class="space-12"></div>
<div class="row">
	<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hébergement</span></strong></div>
</div>
<div class="row">
  <div class="col-sm-12">
   <ul class="nav navbar-nav list-inline">
        <li class="list-inline-item" style="width: 300px;" >
            <i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;
        {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->service->nom }}
        </li>
        <li class="list-inline-item" style="width: 300px;"><i class="ace-icon fa fa-caret-right"></i><strong>Salle :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->nom }}</li>
        <li class="list-inline-item"style="width: 200px;"><i class="ace-icon fa fa-caret-right"></i><strong>Lit :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->nom }}</li>
    </ul>
  </div>
</div>

@if(isset($hosp->garde_id))
<div class="space-12"></div>
<div class="row">
	<div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><strong><span style="font-size:16px;">Garde Malade</span></strong>
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
{{--				  <th class="center"><strong>Traitement</strong></th>	
				@if($hosp->visites->count() > 0)
<div class="space-12"></div>
<div class="row"><div class="col-xs-11 label label-lg label-purple arrowed-in arrowed-right"><strong><span style="font-size:16px;">Visites & Contrôles</span></strong></div>
</div>

<div class="row">
  <div class="col-xs-11 widget-container-col">
    <div class="widget-box widget-color-blue">
      <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Visites & Contrôles</h5></div>
      <div class="widget-body">
        <div class="widget-main no-padding">
          <table class="table table-striped table-bordered table-hover">
            <thead class="thin-border-bottom">
              <tr>
                <th class="center"><strong>Date</strong></th><th class="center"><strong>Médecin</strong></th>
                <th class="center"><strong>Actes</strong></th>
      			  <th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						@foreach($hosp->visites as $visite)
						 <tr>
							 <td>{{ $visite->date}}</td>
							 <td> <span>{{ $visite->medecin->full_name }}</span></td>
							 <td class="text-primary">
							 @foreach($visite->actes as $acte)
							 	{{ $acte->nom }} <br>
							 @endforeach
							 </td>
							 <td class="text-primary">
							 	@foreach($visite->traitements as $trait)
							 		{{ $trait->medicament->nom }} <br>
							 	@endforeach
							</td>
							 	<td class="center"><a href="{{ route('visites.show', $visite->id) }}"><i class="fa fa-eye"></i></a></td>
						 </tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endif--}}
