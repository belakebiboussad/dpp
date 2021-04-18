@extends('app')
@section('page-script')
<script src="{{ asset('/js/Dicom/hammer.min.js') }}"></script>
<script src="{{ asset('/js/Dicom/dicomParser.min.js') }}"></script><!-- include the cornerstone library -->
<script src="{{ asset('/js/Dicom/cornerstone.min.js') }}"></script>
<script src="{{ asset('/js/Dicom/cornerstoneMath.min.js') }}"></script>
<script src="{{ asset('/js/Dicom/cornerstoneWADOImageLoader.min.js') }}"></script>  
<script src="{{ asset('/js/Dicom/cornerstoneTools.js') }}"></script>
<script type="text/javascript">
  const toolName = 'Length';
    function initModeButtons() {
      const nameSpace = `.mode-buttons`;
      const buttons = document.querySelectorAll(`${nameSpace} .set-tool-mode`);
      const handleClick = function(evt) {
        const action = this.dataset.action;
        const options = {
          mouseButtonMask:
            evt.buttons || convertMouseEventWhichToButtons(evt.which),
        };
        cornerstoneTools[`setTool${action}`](toolName, options);
        // Remove active style from all buttons
        buttons.forEach(btn => {
          btn.classList.remove('is-primary');
        });
        // Add active style to this button
        this.classList.add('is-primary');
        evt.preventDefault();
        evt.stopPropagation();
        evt.stopImmediatePropagation();
        return false;
      };
      buttons.forEach(btn => {
        btn.addEventListener('contextmenu', handleClick);
        btn.addEventListener('auxclick', handleClick);
        btn.addEventListener('click', handleClick);
      });
    }
	  function _initCornerstone() {
      cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
      cornerstoneWADOImageLoader.external.dicomParser = dicomParser;
      cornerstoneTools.external.cornerstoneMath = cornerstoneMath;
      cornerstoneTools.external.cornerstone = cornerstone;
      cornerstoneTools.external.Hammer = Hammer;
      const config = { // Image Loader
        webWorkerPath:"{{ asset('/js/Dicom/cornerstoneWADOImageLoader.min.js') }}",
        taskConfiguration: {
            decodeTask: {
              codecsPath: "{{ asset('/js/Dicom/cornerstoneWADOImageLoaderCodecs.min.js') }}",
            },
        },
    	};//cornerstoneWADOImageLoader.webWorkerManager.initialize(config);
  }
  function _initInterface() {
    initModeButtons();
  }
  $(document).ready(function(){
   	var loaded = false;
    $('body').on('click', '.open-modal', function () {
    	jQuery('#dicom').show();
    	_initCornerstone();
    	 const element = document.querySelector('#dicomImage');
      _initInterface();
      cornerstoneTools.init(
      {
        showSVGCursors: true,
      });
      cornerstone.enable(element);
      const toolName = 'Length';
      var APP_URL = {!! json_encode(url('/')) !!} +'/Patients/{{ $patient->Nom}}{{$patient->Prenom }}/examsRadio/{{$demande->id}}/'+$(this).val();
      var url = "wadouri:" + APP_URL;
      const imageIds = [  url  ];
      const stack = {
        currentImageIdIndex: 0,
        imageIds: imageIds,
      };
      element.tabIndex = 0;
      element.focus();
      cornerstone.loadImage(imageIds[0]).then(function(image) {
        cornerstoneTools.addStackStateManager(element, ['stack']);
        cornerstoneTools.addToolState(element, 'stack', stack);
        cornerstone.displayImage(element, image);
        document.getElementById('institution').textContent =  image.data.string('x00080080'); 
        document.getElementById('patientName').textContent =  image.data.string('x00100010');
        document.getElementById('patientId').textContent =  image.data.string('x00100020'); 
        document.getElementById('date').textContent =  image.data.string('x00080032'); 
        document.getElementById('machine').textContent = image.data.string('x00081010');
        document.getElementById('genre').textContent = image.data.string('x00100040');
        document.getElementById('age').textContent = image.data.string('x00101010');
        cornerstone.reset(element);
      });
      cornerstone.events.addEventListener('cornerstoneimageloadprogress', function(event) {
        const eventData = event.detail;
        const loadProgress = document.getElementById('loadProgress');
        loadProgress.textContent = `Image Load Progress: ${eventData.percentComplete}%`;
      });
      document.getElementById('zoomIn').addEventListener('click', function (e) {
        const viewport = cornerstone.getViewport(element);
        viewport.scale += 0.15;
        cornerstone.setViewport(element, viewport);
      });
      document.getElementById('zoomOut').addEventListener('click', function (e) {
        const viewport = cornerstone.getViewport(element);
        viewport.scale -= 0.15;
        cornerstone.setViewport(element, viewport);
      });
      document.getElementById('reset').addEventListener('click', function (e) {
        cornerstone.reset(element);
      });
      const LengthTool = cornerstoneTools.LengthTool;
      cornerstoneTools.addTool(LengthTool)
      cornerstoneTools.setToolActive('Length', { mouseButtonMask: 1 })
    });
 	});
</script>
@endsection
@section('main-content')
<div class="row" width="100%">@include('patient._patientInfo')</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4"><h3> Détails de la demande Radiologique</h3></div><div class="col-sm-5"></div>
      <a href="/showdemandeexr/{{ $demande->consultation->examensradiologiques->id }}" target="_blank" class="btn btn-sm btn-primary pull-right">
       <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
      </a>&nbsp;&nbsp;
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    </div>
  </div>     
  <div class="row no-gutters">
    <div class="col-lg-6">
      <div class="row align-items-center justify-content-center">
        <div class="col"><h4><label><b>Etat:</b></label>&nbsp;&nbsp;&nbsp;&nbsp;<span>
          @if($demande->etat == "E")
             <span class="badge badge-warning">En Cours</span>
          @elseif($demande->etat =="V")
            <span class="badge badge-success">Validé</span>
          @elseif($demande->etat =="R")
            <span class="badge badge-danger">Rejeté</span>
          @endif
         </span>
           </h4>
         </div>
      </div>
      <div class="row align-items-center justify-content-center">
        <div class="col"><h4><label><b>Date Demande:</b></label>&nbsp;&nbsp;&nbsp;&nbsp;<span>
          @if(isset($demande->consultation))
            {{ $demande->consultation->Date_Consultation }}
          @else
            {{ $demande->visite->date }}
          @endif  
         </span></h4></div>
      </div>
      <div class="row align-items-center justify-content-center">
        <div class="col"> <h4><label><b>Informations cliniques pertinentes :</b></label>&nbsp;&nbsp;<span>{{ $demande->InfosCliniques }}</span></h4></div>
      </div>
      <div class="row align-items-center justify-content-center">
        <div class="col"><h4><label><b>Explication de la demande de diagnostic :</b></label>&nbsp;&nbsp;<span>{{ $demande->Explecations }}</span></div></h4>
      </div>
      <div class="row align-items-center justify-content-center">
          <div class="col">
            <h4>
              <label><b>Informations supplémentaires pertinentes :</b></label>
              <div>
                <ul class="list-inline"> 
                  @foreach($demande->infossuppdemande as $index => $info)
                  <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                  @endforeach
                </ul>
              </div>
            </h4>  
          </div>
      </div><div class="space-12 hidden-xs"></div>
      <div class="row align-items-center justify-content-center">
          <div class="col">
            <label><b>Examen(s) proposé(s) :</b></label>
            <div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="center" width="5%">#</th>
                    <th class="center"><strong>Nom</strong></th>
                    <th class="center"><strong>Type</strong></th><!--  <th class="center"><strong>Resultats</strong></th> -->
                    <th class="center"><strong><em class="fa fa-cog"></em></strong></th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($demande->examensradios as $index => $examen)
                  <tr>
                    <td class="center" width="5%">{{ $index +1 }}</td>
                    <td>{{ $examen->nom }}</td>
                    <td >
                      <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
                      @foreach($exams as $id)
                      <span class="badge badge-success">{{ App\modeles\exmnsrelatifdemande::FindOrFail($id)->nom}}</span>
                      @endforeach
                    </td>
                    <td class="center">
                      <table width="100%" height="100%" class="table table-striped table-bordered">
                        @if($examen->pivot->etat == "1")
                          @foreach (json_decode($examen->pivot->resultat) as $k=>$f)
                          <tr>
                            <td width="70%">{{ $f }}</td>
                            <td width="30%">{{-- {{URL::to("/")}} --}}
                            <button type="submit" class="btn btn-info btn-xs open-modal" value="{{ $examen->pivot->id_examenradio."/".$f }}"><i class="ace-icon fa fa-eye-slash"></i></button>
                            <a href='/Patients/{{$patient->Nom}}{{$patient->Prenom}}/examsRadio/{{$demande->id}}/{{$examen->pivot->id_examenradio}}/{{ $f }}' class="btn btn-success btn-xs" target="_blank"> <i class="fa fa-download"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        @else
                          <span class="badge badge-warning">En Cours</span>
                        @endif
                    </table>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>  
    <div class="col-lg-6 container"  id="dicom"  hidden="true"><!--<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">image dicom</h3></div></div> -->
      <div id="loadProgress">Image Load Progress:</div><!--<button id='toggleCollapseInfo' class="btn btn-primary" type="button">Click for more info </button> -->
      <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
          <div col="col-md-12 col-sm-12" oncontextmenu="return false" class='disable-selection noIbar' unselectable='on' onselectstart='return false;' onmousedown='return false;'>
            <div id="dicomImage" style="height:512px"></div>
          </div>
        </div>
        <div class="col-md-4 col-sm-8 col-xs-12">
          <span>Institusion: </span><span id="institution"></span><br>
          <span>Nom patient: </span><span id="patientName"></span><br>
          <span>Code patient: </span><span id="patientId"></span><br>
          <span>Date: </span><span id="date"></span><br>
          <span>Genre: </span><span id="genre"></span><br>
          <span>Age: </span><span id="age"></span><br>
          <span>Machine: </span><span id="machine"></span><br>
        </div>
      </div><div class="space-12 hidden-xs"></div>
      <div class="row">
        <div class="col-sm-12">
          <button id="zoomIn" type="button" class="btn btn-default"><i class="fa fa-search-plus bigger-150" aria-hidden="true"></i></button>
          <button id="zoomOut" type="button" class="btn btn-default"><i class="fa fa-search-minus bigger-150" aria-hidden="true"></i></button>
          <button id="reset" type="button" class="btn btn-default"><i class="fa fa-undo bigger-150" aria-hidden="true"></i></button>
        </div>
      </div>
    </div><!-- col-lg-6  -->
  </div>
</div>
@endsection
