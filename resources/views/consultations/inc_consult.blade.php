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
<div class="page-header" style="margin-top:-5px;"> <h5><strong>Détails de la consulation :</strong></h5></div>
<div class="row">
  <div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right">
  <span class="f-16"><strong>Interrogatoire</strong></span></div>
</div>
<div class="row">
  <ul class="list-unstyled spaced">
    <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Date de la consultation  :</strong><span class="badge badge-pill badge-success">{{ $consultation->date }}</span></li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Motif de consultation :</strong><span>{{ $consultation->motif }}</span></li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Histoire de la maladie :</strong><span>{{ $consultation->histoire_maladie }}
    </span></li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Diagnostic :</strong><span>{{ $consultation->Diagnostic }}</span></li>
    <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Résumé :</strong> </span>{{ $consultation->Resume_OBS }}</li>
  </ul>
</div>
@if(isset($consultation->examensCliniques))
<div class="row">
  <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><span class="f-16"><strong>Examens clinique</strong></span></div>
</div>
<div class="row">
<ul class="list-unstyled spaced">
  @if(isset($consultation->examensCliniques))
  @if(isset($consultation->examensCliniques->consts))
       @foreach(json_decode($specialite->consConst ,true) as $const)
      <?php $obj = App\modeles\Constante::FindOrFail($const) ; $nom = $obj->nom?>
        @if($consultation->examensCliniques->consts[$obj->nom ] != null)
            <li><i class="message-star ace-icon fa fa-star orange2"></i><strong>{{  $obj ->description }} :</strong>
            <span class="badge badge-pill badge-primary">{{ $consultation->examensCliniques->consts->$nom }}</span>({{$obj->unite }})</li>
             @endif
        @endforeach
  @endif
    <li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Etat général du patient :</strong><span>{{ $consultation->examensCliniques->etat  }}</span></li>
    <li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Peau et phanéres  :</strong><span>{{ $consultation->examensCliniques->peaupha }}</span></li>
      <li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Autre :</strong>{{ $consultation->examensCliniques->autre  }}&nbsp;</li>
@endif
</ul>
</div>
@if($consultation->examensCliniques->examsAppareil->count()>0)
<div class="row">
  <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><span class="f-16"><strong>Examens Appareils</strong></span></div>
</div>
<div class="row">
  <div id="accordion" class="accordion-style2 ui-accordion ui-widget ui-helper-reset ui-sortable" role="tablist">
    <div class="group">
    @foreach($consultation->examensCliniques->examsAppareil as $examAppareil)
      @if(null !== $examAppareil )
      <h3 class="accordion-header ui-accordion-header ui-state-default ui-accordion-icons ui-sortable-handle ui-corner-all ui-state-hover" role="tab"  aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span> Appareil{{ $examAppareil->Appareil->nom }}</h3>
      <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom"  role="tabpanel" style="display: none;"  aria-hidden="true">
      <p>{{ $examAppareil->description}}</p>
    </div>  
    @endif
  @endforeach
        </div>
</div> <!-- fin -->
</div>
@endif
@endif
@if(isset($consultation->demandeexmbio))
<div class="row">
  <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><span class="f-16"><strong>Demande d'examen biologique</strong></span>
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
                <th class="center"><strong>Date</strong></th><th class="center"><strong>Etat</strong></th><th class="center"><em class="fa fa-cog"></em></th>
              </tr>
            </thead>
            <tbody>
              <tr id="{{ 'demandeBio'.$consultation->demandeexmbio->id }}">
                <td>{{ $consultation->date }}</td>
                <td>
                <span class="badge badge-{{( $consultation->demandeexmbio->getEtatID($consultation->demandeexmbio->etat)) === 0 ? 'warning':'primary' }}">
                {{ $consultation->demandeexmbio->etat }}</span>
                </td>
                <td class="center">
                  @if($consultation->medecin->id == Auth::user()->employ->id)
                    <a href="{{ route('demandeexb.show', $consultation->demandeexmbio->id) }}" class="btn btn-success btn-xs">
                      <i class="fa fa-hand-o-up fa-xs"></i>
                    </a>
                    @if($consultation->demandeexmbio->etat == "En Cours")
                    <a href="{{ route('demandeexb.edit', $consultation->demandeexmbio->id) }}" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-pencil" aria-hidden="true"></i></a>
                     <button type="button" class="btn btn-xs btn-danger delete-demandeBio" value="{{ $consultation->demandeexmbio->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
                    @endif
                     <a href="/dbToPDF/{{ $consultation->demandeexmbio->id }}" target="_blank" class="btn btn-xs"> <i class="ace-icon fa fa-print"></i></a> 
                  @endif
                </td>
            </tbody>
          </table>
        </div>  
      </div>
    </div>
  </div>
</div>
@endif
@if(isset($consultation->examensradiologiques)) 
<div class="row">
  <div class="col-xs-11 label label-lg label-danger arrowed-in arrowed-right"><span class="f-16"><strong>Demande d'examen d'imagerie</strong></span>
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
              <th class="center"><strong>Date</strong></th><th class="center"><strong>Etat</strong></th><th class="center"><em class="fa fa-cog"></em></th>
            </tr>
          </thead>
          <tbody>
            <tr id="{{ 'demandeRad'.$consultation->examensradiologiques->id }}">
              <td>{{ $consultation->date }}</td>
              <td>
              <span class="badge badge-{{( $consultation->examensradiologiques->getEtatID($consultation->examensradiologiques->etat)) === 0 ? 'warning':'primary' }}">
              {{ $consultation->examensradiologiques->etat }}
              </span>
              </td>
              <td class="center">
                @if(!$consultation->examensradiologiques->hasResult())
                  <a href="{{ route('demandeexr.edit', $consultation->examensradiologiques->id ) }}" class="btn btn-xs  btn-success">
                    <i class="ace-icon fa fa-pencil" aria-hidden="true"></i>
                  </a> 
                  <button type="button" class="btn btn-xs btn-danger delete-demandeRad" value="{{ $consultation->examensradiologiques->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
                @endif 
                  <a href="{{ route('demandeexr.show', $consultation->examensradiologiques->id) }}"><i class="fa fa-eye"></i></a>
                <a href="/drToPDF/{{ $consultation->examensradiologiques->id }}" target="_blank" class="btn btn-xs"><i class="ace-icon fa fa-print"></i></a>      
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
  <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><span class="f-16"><strong>Ordonnance</strong></span></div>
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
                <th class="center"><strong>Date</strong></th><th class="center"><em class="fa fa-cog"></em></th>
              </tr>
            </thead>
            <tbody>
              <tr id="{{ 'ordonnace'.$consultation->ordonnances->id }}">
                <td>{{ $consultation->ordonnances->date }}</td>
                <td class="center">
                  <button type="button" class="btn btn-xs btn-danger delete-ordonnance" value="{{ $consultation->ordonnances->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
                  <a href="{{ route('ordonnace.show',$consultation->ordonnances->id) }}"><i class="fa fa-eye"></i></a>
                  <a href="{{route("ordonnancePdf",$consultation->ordonnances->id)}}" target="_blank" class="btn btn-xs"><i class="fa fa-print"></i></a>
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
  <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><span class="f-16"><strong>Demande d'hospitalisation</span></strong>
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
@endisset
@if(isset($consultation->lettreOrintation))
<div class="row">
  <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><span class="f-16"><strong>Lettre d'Orientation</strong></span></div>
</div>
<div class="row">
  <div class="col-xs-11 widget-container-col">
    <div class="widget-box widget-color-blue">
      <div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Lettre</h5></div>
      <div class="widget-body">
        <div class="widget-main no-padding">
          <table class="table table-striped table-bordered table-hover">
            <thead class="thin-border-bottom">
              <tr>
                <th class="center"><strong>Date</strong></th>
                <th class="center"><strong>Spécilalité</strong></th>
                <th class="center"><em class="fa fa-cog"></em></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $consultation->date }}</td>
                <td>{{ $consultation->lettreOrintation->Specialite->nom }}</td>
                <td class="center">
                  <a href="#" class="green bigger-140 show-details-btn" title="Afficher Details" data-toggle="collapse"  data-target=".collapsed">
                    <i class="ace-icon fa fa-eye-slash"></i><span class="sr-only">Details</span>&nbsp;
                  </a>
                  <button type="button" class="btn btn-xs btn-success" onclick="orLetterPrint('{{$consultation->patient->Nom}}','{{ $consultation->patient->Prenom}}','{{$consultation->patient->age }}',    '{{$consultation->patient->IPP }}','{{$etablissement->tutelle }}','{{$etablissement->nom }}','{{$etablissement->adresse }}','{{$etablissement->tel }}','{{$etablissement->logo }}')"><i class="ace-icon fa fa-print"></i></button>
                </td>
              </tr>
              <tr class="collapse out budgets collapsed">
                <td colspan="12">
                  <div class="table-detail">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12"><div class="space visible-xs"></div>
                        <div class="profile-user-info profile-user-info-striped">
                          <div class="profile-info-row">
                            <div class="profile-info-name text-center"><strong>Motif:</strong></div>
                            <div class="profile-info-value">{{ $consultation->lettreOrintation->motif }}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
@include('examenradio.scripts.imgRequestdJS')
<div class="row"><canvas id="lettreorientation" height="1%"><img id='itfL'/></canvas></div>