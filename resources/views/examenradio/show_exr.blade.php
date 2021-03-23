@extends('app')
@section('page-script')
<script src="{{ asset('/js/Dicom/cornerstone.min.js') }}"></script>
<script src="{{ asset('/js/Dicom/cornerstone.js') }}"></script> 
<script src="{{ asset('/js/Dicom/cornerstoneMath.min.js') }}"></script> 
<script src="{{ asset('/js/Dicom/cornerstoneTools.min.js') }}"></script> 
<script src="{{ asset('/js/Dicom/dicomParser.min.js') }}"></script> 
<script src="{{ asset('/js/Dicom/dicomParser.js') }}"></script>
<script src="{{ asset('/js/Dicom/uids.js') }}"></script> 
 <script src="{{ asset('/js/Dicom/cornerstoneWADOImageLoader.js') }}"></script>       
<script crossorigin  src="{{ asset('react-dom.production.min.js') }}"></script> 
<script  crossorigin src="{{ asset('react.production.min.js') }}"></script> 
<script type="text/javascript">
  function getTransferSyntax() {
    const value = image.data.string('x00020010');
    return value + ' [' + uids[value] + ']';
  }
  function getSopClass() {
    const value = image.data.string('x00080016');
    return value + ' [' + uids[value] + ']';
  }
  function getPixelRepresentation() {
      const value = image.data.uint16('x00280103');
      if(value === undefined) {
          return;
      }
      return value + (value === 0 ? ' (unsigned)' : ' (signed)');
  }
  function getPlanarConfiguration() {
    const value = image.data.uint16('x00280006');
    if(value === undefined) {
        return;
    }
    return value + (value === 0 ? ' (pixel)' : ' (plane)');
  }
  function loadAndViewImage(imageId)
  {
    var element = document.getElementById('dicomImage');
    try {
          var start = new Date().getTime();
          cornerstone.loadAndCacheImage(imageId).then(function(image) {
            console.log(image);
            var viewport = cornerstone.getDefaultViewportForImage(element, image);
            document.getElementById('toggleModalityLUT').checked = (viewport.modalityLUT !== undefined);
            document.getElementById('toggleVOILUT').checked = (viewport.voiLUT !== undefined);
            cornerstone.displayImage(element, image, viewport);
            if(loaded === false) {
                cornerstoneTools.mouseInput.enable(element);
                cornerstoneTools.mouseWheelInput.enable(element);
                cornerstoneTools.wwwc.activate(element, 1); // ww/wc is the default tool for left mouse button
                cornerstoneTools.pan.activate(element, 2); // pan is the default tool for middle mouse button
                cornerstoneTools.zoom.activate(element, 4); // zoom is the default tool for right mouse button
                cornerstoneTools.zoomWheel.activate(element); // zoom is the default tool for middle mouse wheel
                loaded = true;
            }
            document.getElementById('transferSyntax').textContent = getTransferSyntax();
            document.getElementById('sopClass').textContent = getSopClass();
            document.getElementById('samplesPerPixel').textContent = image.data.uint16('x00280002');
            document.getElementById('photometricInterpretation').textContent = image.data.string('x00280004');
            document.getElementById('numberOfFrames').textContent = image.data.string('x00280008');
            document.getElementById('planarConfiguration').textContent = getPlanarConfiguration();
            document.getElementById('rows').textContent = image.data.uint16('x00280010');
            document.getElementById('columns').textContent = image.data.uint16('x00280011');
            document.getElementById('pixelSpacing').textContent = image.data.string('x00280030');
            document.getElementById('rowPixelSpacing').textContent = image.rowPixelSpacing;
            document.getElementById('columnPixelSpacing').textContent = image.columnPixelSpacing;
            document.getElementById('bitsAllocated').textContent = image.data.uint16('x00280100');
            document.getElementById('bitsStored').textContent = image.data.uint16('x00280101');
            document.getElementById('highBit').textContent = image.data.uint16('x00280102');
            document.getElementById('pixelRepresentation').textContent = getPixelRepresentation();
            document.getElementById('windowCenter').textContent = image.data.string('x00281050');
            document.getElementById('windowWidth').textContent = image.data.string('x00281051');
            document.getElementById('rescaleIntercept').textContent = image.data.string('x00281052');
            document.getElementById('rescaleSlope').textContent = image.data.string('x00281053');
            document.getElementById('basicOffsetTable').textContent = image.data.elements.x7fe00010.basicOffsetTable ? image.data.elements.x7fe00010.basicOffsetTable.length : '';
            document.getElementById('fragments').textContent = image.data.elements.x7fe00010.fragments ? image.data.elements.x7fe00010.fragments.length : '';
            document.getElementById('minStoredPixelValue').textContent = image.minPixelValue;
            document.getElementById('maxStoredPixelValue').textContent = image.maxPixelValue;
            var end = new Date().getTime();
            var time = end - start;
            document.getElementById('totalTime').textContent = time + "ms";
            document.getElementById('loadTime').textContent = image.loadTimeInMS + "ms";
            document.getElementById('decodeTime').textContent = image.decodeTimeInMS + "ms";
          }, function(err) {
               alert(err);
        });
        }
        catch(err) {
            alert(err);
        }
    }
  $(document).ready(function(){
    var loaded = false;
    $('body').on('click', '.open-modal', function () { //jQuery('#afficherDicom').modal('show');    
      jQuery('#dicom').show();
      cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
      cornerstoneWADOImageLoader.configure({
        beforeSend: function(xhr) {// Add custom headers here (e.g. auth tokens);//xhr.setRequestHeader('APIKEY', 'my auth token');
        }
      });
    let url = document.getElementById('wadoURL').value;
          
        // prefix the url with wadouri: so cornerstone can find the image loader
        url = "wadouri:" + url;
//alert(url);
        // image enable the dicomImage element and activate a few tools
        loadAndViewImage(url);
    

    cornerstone.events.addEventListener('cornerstoneimageloadprogress', function(event) {
        const eventData = event.detail;
        const loadProgress = document.getElementById('loadProgress');
        loadProgress.textContent = `Image Load Progress: ${eventData.percentComplete}%`;
    });

    function getUrlWithoutFrame() {
        var url = document.getElementById('wadoURL').value;
        var frameIndex = url.indexOf('frame=');
        if(frameIndex !== -1) {
            url = url.substr(0, frameIndex-1);
        }
        return url;
    }

    var element = document.getElementById('dicomImage');
    cornerstone.enable(element);

    document.getElementById('downloadAndView').addEventListener('click', function(e) {
        downloadAndView();
    });
    document.getElementById('load').addEventListener('click', function(e) {
        var url = getUrlWithoutFrame();
        cornerstoneWADOImageLoader.wadouri.dataSetCacheManager.load(url);
    });
    document.getElementById('unload').addEventListener('click', function(e) {
        var url = getUrlWithoutFrame();
        cornerstoneWADOImageLoader.wadouri.dataSetCacheManager.unload(url);
    });

    document.getElementById('purge').addEventListener('click', function(e) {
        cornerstone.imageCache.purgeCache();
    });

    const form = document.getElementById('form');
    form.addEventListener('submit', function() {
        downloadAndView();
        return false;
    });

    document.getElementById('toggleModalityLUT').addEventListener('click', function() {
        var applyModalityLUT = document.getElementById('toggleModalityLUT').checked;
        console.log('applyModalityLUT=', applyModalityLUT);
        var image = cornerstone.getImage(element);
        var viewport = cornerstone.getViewport(element);
        if(applyModalityLUT) {
            viewport.modalityLUT = image.modalityLUT;
        } else {
            viewport.modalityLUT = undefined;
        }
        cornerstone.setViewport(element, viewport);
    });
    document.getElementById('toggleVOILUT').addEventListener('click', function() {
        var applyVOILUT = document.getElementById('toggleVOILUT').checked;
        console.log('applyVOILUT=', applyVOILUT);
        var image = cornerstone.getImage(element);
        var viewport = cornerstone.getViewport(element);
        if(applyVOILUT) {
            viewport.voiLUT = image.voiLUT;
        } else {
            viewport.voiLUT = undefined;
        }
        cornerstone.setViewport(element, viewport);
    });
    document.getElementById('toggleCollapseInfo').addEventListener('click', function() {
        if (document.getElementById('collapseInfo').style.display === 'none') {
            document.getElementById('collapseInfo').style.display = 'block';
        } else {
            document.getElementById('collapseInfo').style.display = 'none';
        }
    });



        });
      });

</script>
@endsection
@section('main-content')
<div class="page-header" width="100%"><?php $patient = $demande->consultation->patient; ?>@include('patient._patientInfo')</div>
<div class="content">
  <div class="row">
    <div class="col-sm-3"></div> <div class="col-sm-3"></div> <div class="col-sm-3"></div>
    <div class="col-sm-3">
      <a href="/showdemandeexr/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-primary pull-right" title="Imprimer">
         <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
      </a>
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right">
        <i class="ace-icon fa fa-backward"></i>&nbsp; precedant
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 widget-container-col" id="consultation">
      <div class="widget-box" id="infopatient">
        <div class="widget-header">
          <h4 class="widget-title"><b>Détails de la demande des examens Radiologiques :</b></h4>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="row">
              <div class="col-xs-12">
                  <label><b>Date Demande:</b></label>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ $demande->Date }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <label><b>Informations cliniques pertinentes :</b></label>
                &nbsp;&nbsp;<span>{{ $demande->InfosCliniques }}.</span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label><b>Explication de la demande de diagnostic :</b></label>
                 &nbsp;&nbsp;<span>{{ $demande->Explecations }}.</span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label><b>Informations supplémentaires pertinentes :</b></label>
                <div>
                  <ul class="list-inline"> 
                    @foreach($demande->infossuppdemande as $index => $info)
                      <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label><b>Examen(s) proposé(s) :</b></label>
                <div>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="center" width="10%">#</th>
                        <th class="center"><strong>Nom</strong></th>
                        <th class="center"><strong>Type</strong></th>
                        <th class="center"><strong>Afficher</strong></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($demande->examensradios as $index => $examen)
                    <tr>
                      <td class="center">{{ $index + 1 }}</td>
                      <td>{{ $examen->nom }}</td>
                      <td>
                        <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
                        @foreach($exams as $id)
                        <span class="badge badge-success">{{ App\modeles\exmnsrelatifdemande::FindOrFail($id)->nom}}</span>
                        @endforeach
                      </td>
                      <td>
                        <button type="submit" class="btn btn-info btn-sm open-modal"><i class="ace-icon fa fa-save bigger-110"></i>Dicom</button>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!-- row -->
          </div><!-- widget-main -->
        </div>
      </div>
     </div>
  </div>
    <!-- dicom -->
  <div id="dicom"class="container" hidden="true">
   <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">image dicom </h3></div></div>
    <div class="row">
      <form id="form" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-8">
            <input class="form-control" type="hidden" id="wadoURL" placeholder="Enter WADO URL" value="http://localhost:8000/imagedicom/{{$demande->resultat}}">
          </div>
        </div>
         <div class="form-group">
              <div class="col-sm-2">
                  <button class="form-control" type="button" id="load" class="btn btn-primary">Load</button>
              </div>
              <div class="col-sm-2">
                  <button class="form-control" type="button" id="unload" class="btn btn-primary">Unload</button>
              </div>
              <div class="col-sm-2">
                  <button class="form-control" type="button" id="purge" class="btn btn-primary">Purge Cache</button>
              </div>
          </div>
        </form>
      </div>  
         <input type="checkbox" id="toggleModalityLUT">Apply Modality LUT</input>
    <input type="checkbox" id="toggleVOILUT">Apply VOI LUT</input>
    <br>
    <div class="row">
      <div class="col-md-6">
          <div style="width:450px;height:512px;position:relative;color: white;display:inline-block;border-style:solid;border-color:black;"
               oncontextmenu="return false"
               class='disable-selection noIbar'
               unselectable='on'
               onselectstart='return false;'
               onmousedown='return false;'>
              <div id="dicomImage"
                   style="width:450px;height:512px;top:0px;left:0px; position:absolute">
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <span>Transfer Syntax: </span><span id="transferSyntax"></span><br>
          <span>SOP Class: </span><span id="sopClass"></span><br>
          <span>Samples Per Pixel: </span><span id="samplesPerPixel"></span><br>
          <span>Photometric Interpretation: </span><span id="photometricInterpretation"></span><br>
          <span>Number Of Frames: </span><span id="numberOfFrames"></span><br>
          <span>Planar Configuration: </span><span id="planarConfiguration"></span><br>
          <span>Rows: </span><span id="rows"></span><br>
          <span>Columns: </span><span id="columns"></span><br>
          <span>Pixel Spacing: </span><span id="pixelSpacing"></span><br>
          <span>Row Pixel Spacing: </span><span id="rowPixelSpacing"></span><br>
          <span>Column Pixel Spacing: </span><span id="columnPixelSpacing"></span><br>
          <span>Bits Allocated: </span><span id="bitsAllocated"></span><br>
          <span>Bits Stored: </span><span id="bitsStored"></span><br>
          <span>High Bit: </span><span id="highBit"></span><br>
          <span>Pixel Representation: </span><span id="pixelRepresentation"></span><br>
          <span>WindowCenter: </span><span id="windowCenter"></span><br>
          <span>WindowWidth: </span><span id="windowWidth"></span><br>
          <span>RescaleIntercept: </span><span id="rescaleIntercept"></span><br>
          <span>RescaleSlope: </span><span id="rescaleSlope"></span><br>
          <span>Basic Offset Table Entries: </span><span id="basicOffsetTable"></span><br>
          <span>Fragments: </span><span id="fragments"></span><br>
          <span>Max Stored Pixel Value: </span><span id="minStoredPixelValue"></span><br>
          <span>Min Stored Pixel Value: </span><span id="maxStoredPixelValue"></span><br>
          <span>Total Time: </span><span id="totalTime"></span><br>
          <span>Load Time: </span><span id="loadTime"></span><br>
          <span>Decode Time: </span><span id="decodeTime"></span><br>
      </div>
    </div> <!-- row -->
    <div class="row">
    <div class="col-sm-12">
      <label>Résultat :</label>&nbsp;&nbsp;
      @isset($demande->resultat)
        <span><a href='/download/{{ $demande->resultat }}'>{{ $demande->resultat }} &nbsp;<i class="fa fa-download"></i></a></span>
      @endisset
    </div>
  </div>
</div>
@endsection
