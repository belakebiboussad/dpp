<script type="text/javascript">
$('document').ready(function(){
  $("#accordion" ).accordion({
    collapsible: true ,
    heightStyle: "content",
    animate: 250,
    header: ".accordion-header"
  }).sortable({
    axis: "y",
    handle: ".accordion-header",
    stop: function( event, ui ) {
      ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
    }
  });
  $('body').on('click', '.delete-demandeBio', function (e) {
      event.preventDefault();
      var demande_id = $(this).val();
      $.ajaxSetup({
          headers: {
           'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        type: "DELETE",
        url: '/demandeexb/' + demande_id,
        success: function (data) {
          $("#demandeBio" + demande_id).remove();
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
  });
  jQuery('body').on('click', '.delete-ordonnance', function (e) {
      event.preventDefault();
      var ord_id = $(this).val();
      $.ajaxSetup({
            headers: {
             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
      });
      $.ajax({
          type: "DELETE",
          url: '/ordonnace/' + ord_id,
          success: function (data) {
            $("#ordonnace" + ord_id).remove();
          },
          error: function (data) {
            console.log('Error:', data);
          }
      });
  });
});
</script>
<div class="page-header mt-5"><h5>Résumé de la consulation :</h5></div>
<div class="row">
  <div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right">
  <span class="ft16"><b>Interrogatoire</b></span></div>
</div>
<div class="row">
  <ul class="list-unstyled spaced">
    <li><i class="ace-icon fa fa-caret-right blue"></i><b>Date de la consultation  :</b><span class="badge badge-pill badge-success">&nbsp;{{ $consultation->date->format('Y-m-d') }}</span></li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><b>Medecin de la consultation  :</b>&nbsp;{{ $consultation->medecin->full_name }}</li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><b>Spécialite de la consultation  :</b>&nbsp;
    @if(isset($consultation->medecin->specialite))
      {{ $consultation->medecin->Specialite->nom }}
    @else
      {{ $consultation->medecin->Service->Specialite->nom }}
    @endif
    </li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><b>Motif de consultation :</b><span>&nbsp;{{ $consultation->motif }}</span></li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><b>Histoire de la maladie :</b><span>&nbsp;{{ $consultation->histoire_maladie }}
    </span></li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><b>Diagnostic :</b><span>{{ $consultation->Diagnostic }}</span></li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><b>Résumé :</b> </span>{{ $consultation->Resume_OBS }}</li>
  </ul>
</div>
@if(isset($consultation->examensCliniques))
<div class="row">
  <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><span class="ft16"><b>Examens clinique</b></span></div>
</div>
<div class="row">
<ul class="list-unstyled spaced">
  @if(isset($consultation->examensCliniques))
    @if(isset($consultation->examensCliniques->consts))
       @foreach(json_decode($specialite->consConst ,true) as $const)
      <?php $obj = App\modeles\Constante::FindOrFail($const) ; $nom = $obj->nom?>
        @if($consultation->examensCliniques->consts[$obj->nom ] != null)
            <li><i class="message-star ace-icon fa fa-star orange2"></i><b>{{  $obj ->description }} :</b>
            <span class="badge badge-pill badge-primary">{{ $consultation->examensCliniques->consts->$nom }}</span>({{$obj->unite }})</li>
             @endif
        @endforeach
    @endif
    <li><i class="message-star ace-icon fa fa-star orange2"></i><b>Etat général du patient :</b><span>{{ $consultation->examensCliniques->etat  }}</span></li>
    <li><i class="message-star ace-icon fa fa-star orange2"></i><b>Peau et phanéres  :</b><span>{{ $consultation->examensCliniques->peaupha }}</span></li>
      <li><i class="message-star ace-icon fa fa-star orange2"></i><b>Autre :</b>{{ $consultation->examensCliniques->autre  }}&nbsp;</li>
  @endif
</ul>
</div>
@endif
@if($consultation->examsAppareil->count() > 0)
<div class="row">
  <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><span class="ft16"><b>Examens Appareils</b></span></div>
</div>
<div class="row">
  <div id="accordion" class="accordion-style2 ui-accordion ui-widget ui-helper-reset ui-sortable" role="tablist">
    <div class="group">
    @foreach($consultation->examsAppareil as $examAppareil)
      @if(null !== $examAppareil )
      <h3 class="accordion-header ui-accordion-header ui-state-default ui-accordion-icons ui-sortable-handle ui-corner-all ui-state-hover" role="tab"  aria-selected="false" aria-expanded="false">
      <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
       Appareil{{ $examAppareil->nom }}</h3>
      <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" role="tabpanel" style="display: none;"  aria-hidden="true">
      <p>{{ $examAppareil->pivot->description}}</p>
    </div>  
    @endif
    @endforeach
    </div>
</div> 
</div>
@endif
@if(isset($consultation->demandeexmbio))
<div class="row">
  <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><span class="ft16"><b>Demande d'examen biologique</b></span>
  </div>
</div>
<div class="row">
  <div class="col-xs-11 widget-container-col">
    <div class="widget-box widget-color-blue">
      <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Demande d'examen biologique</h5></div>
      <div class="widget-body">
        <div class="widget-main no-padding">
          <table class="table table-striped table-bordered table-hover">
            <thead class="thin-border-bottom">
              <tr>
                <th class="center"><b>Date</b></th>
                <th class="center"><b>Etat</b></th>
                <th class="center" width="19%"><em class="fa fa-cog"></em></th>
              </tr>
            </thead>
            <tbody>
              <tr id="{{ 'demandeBio'.$consultation->demandeexmbio->id }}">
                <td>{{ $consultation->date->format('Y-m-d') }}</td>
                <td class="center">
                <span class="badge badge-{{( $consultation->demandeexmbio->getEtatID($consultation->demandeexmbio->etat)) === 0 ? 'warning':'primary' }}">
                {{ $consultation->demandeexmbio->etat }}</span>
                </td>
                <td class="center">{{-- @if($consultation->medecin->id == Auth::user()->employ->id)@endif --}}
                    <a href="{{ route('demandeexb.show', $consultation->demandeexmbio->id) }}" class="btn btn-success btn-xs">
                      <i class="fa fa-hand-o-up fa-xs"></i>
                    </a>
                    @if($consultation->medecin->id == Auth::user()->employ->id)
                    @if($consultation->demandeexmbio->etat == "En Cours")
                    <a href="{{ route('demandeexb.edit', $consultation->demandeexmbio->id) }}" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil" aria-hidden="true"></i></a>
                     <button type="button" class="btn btn-xs btn-danger delete-demandeBio" value="{{ $consultation->demandeexmbio->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
                    @endif
                    @endif
                     <a href="/dbToPDF/{{ $consultation->demandeexmbio->id }}" target="_blank" class="btn btn-xs"> <i class="ace-icon fa fa-print"></i></a> 
                  
                </td>
            </tbody>
          </table>
        </div>  
      </div>
    </div>
  </div>
</div>
@endif
@if(isset($consultation->demandExmImg)) 
<div class="row">
  <div class="col-xs-11 label label-lg label-danger arrowed-in arrowed-right"><span class="ft16"><b>Demande d'examen d'imagerie</b></span>
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
              <th class="center">Date</th>
              <th class="center">Etat</th>
              <th class="center" width="19%"><em class="fa fa-cog"></em></th>
            </tr>
          </thead>
          <tbody>
            <tr id="{{ 'demandeRad'.$consultation->demandExmImg->id }}">
              <td>{{ $consultation->date->format('Y-m-d') }}</td>
              <td class="center">
              <span class="badge badge-{{( $consultation->demandExmImg->getEtatID($consultation->demandExmImg->etat)) === 0 ? 'warning':'primary' }}">
              {{ $consultation->demandExmImg->etat }}
              </span>
              </td>
              <td class="center">
                <a href="{{ route('demandeexr.show', $consultation->demandExmImg->id) }}" class="btn btn-success btn-xs">
                <i class="fa fa-hand-o-up fa-xs"></i></a>
                @if($consultation->medecin->id == Auth::user()->employ->id)
                @if(!$consultation->demandExmImg->hasResult())
                  <a href="{{ route('demandeexr.edit', $consultation->demandExmImg->id ) }}" class="btn btn-xs btn-primary">
                    <i class="ace-icon fa fa-pencil" aria-hidden="true"></i>
                  </a> 
                  <button type="button" class="btn btn-xs btn-danger delete-demandeRad" value="{{ $consultation->demandExmImg->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
                @endif
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
</div>
@endif
@if(isset($consultation->ordonnances))
<div class="row">
  <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><span class="ft16"><b>Ordonnance</b></span></div>
</div>
<div class="row">
  <div class="col-xs-11 widget-container-col">
    <div class="widget-box widget-color-blue">
      <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Ordonnance</h5></div>
      <div class="widget-body">
        <div class="widget-main no-padding">
          <table class="table table-striped table-bordered table-hover">
            <thead class="thin-border-bottom">
              <tr>
                <th class="center"><b>Date</b></th><th class="center"><em class="fa fa-cog"></em></th>
              </tr>
            </thead>
            <tbody>
              <tr id="{{ 'ordonnace'.$consultation->ordonnances->id }}">
                <td>{{ $consultation->ordonnances->date }}</td>
                <td class="center">
                  <a href="{{ route('ordonnace.show',$consultation->ordonnances->id) }}"><i class="fa fa-eye-slash"></i></a>
                  <a href="{{route("ordonnancePdf",$consultation->ordonnances->id)}}" target="_blank" class="btn btn-xs"><i class="fa fa-print"></i></a>
                  <button type="button" class="btn btn-xs btn-danger delete-ordonnance" value="{{ $consultation->ordonnances->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
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
@isset($consultation->demandeHospitalisation)
<div class="row dh">
  <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><span class="ft16"><b>Demande d'hospitalisation</span></b>
  </div>
</div>
<div class="row dh">
  <div class="col-xs-11 widget-container-col">
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
              <td class="center">
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
@endisset
@if($consultation->lettreOrintation->count()>0)
<div class="row">
  <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><span class="ft16"><b>Lettres d'Orientation</b></span></div>
</div>
<div class="row">
  <div class="col-xs-11 widget-container-col">
    <div class="widget-box widget-color-blue">
      <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Lettres d'orientation</h5></div>
      <div class="widget-body">
        <div class="widget-main no-padding">
          <table class="table table-striped table-bordered table-hover">
            <thead class="thin-border-bottom">
              <tr>
                <th class="center"><b>Spécilalité</b></th>
                <th class="center" width="12%"><em class="fa fa-cog"></em></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($consultation->lettreOrintation as $orient)
                <td>{{ $orient->Specialite->nom }}</td>
                <td class="center">
                  <a href="#" class="btn btn-success btn-xs show-details-btn" title="Afficher Details" data-toggle="collapse"  data-target=".{{ $orient->id }}collapsed">
                    <i class="ace-icon fa fa-eye-slash fa-xs"></i><span class="sr-only">Details</span>
                  </a>
                  <a href="{{route("orientLetToPDF",$orient->id)}}" target="_blank" class="btn btn-xs"><i class="fa fa-print"></i></a>
                </td>
              </tr>
              <tr class="collapse out budgets {{ $orient->id }}collapsed">
                <td colspan="12">
                  <div class="table-detail">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12"><div class="space visible-xs"></div>
                        <div class="profile-user-info profile-user-info-striped">
                          <div class="profile-info-row">
                            <div class="profile-info-name text-center"><b>Motif:</b></div>
                            <div class="profile-info-value">{{ $orient->motif }}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-xs-12 col-sm-12"><div class="space visible-xs"></div>
                        <div class="profile-user-info profile-user-info-striped">
                          <div class="profile-info-row">
                            <div class="profile-info-name text-center"><b>Examen:</b></div>
                            <div class="profile-info-value">{{ $orient->examen }}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
@endif
@include('examenradio.scripts.imgRequestdJS')
<div class="row"><canvas id="lettreorientation" height="1%"><img id='itfL'/></canvas></div>