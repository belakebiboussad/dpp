@extends('app')
@section('page-script')
<script src="{{ asset('/js/Dicom/hammer.min.js') }}"></script>
<script src="{{ asset('/js/Dicom/dicomParser.min.js') }}"></script>
<!-- include the cornerstone library -->
<script src="{{ asset('/js/Dicom/cornerstone.min.js') }}"></script>
<script src="{{ asset('/js/Dicom/cornerstoneMath.js') }}"></script>
<script src="{{ asset('/js/Dicom/cornerstoneWADOImageLoader.min.js') }}"></script>  
<script src="{{ asset('/js/Dicom/cornerstoneTools.js') }}"></script>
<!-- Why we're all here ;) -->
 <!-- <script src="https://unpkg.com/cornerstone-tools@%5E4"></script>-->
<script type="text/javascript">
    var loaded = false;
    function getTransferSyntax(image) {
      const value = image.data.string('x00020010');
      return value + ' [' + uids[value] + ']';
    }
    function getPlanarConfiguration(image) {
      const value = image.data.uint16('x00280006');
      if(value === undefined) {
        return;
      }
      return value + (value === 0 ? ' (pixel)' : ' (plane)');
    }
    function getSopClass(image) {
      const value = image.data.string('x00080016');
      return value + ' [' + uids[value] + ']';
    }
     function getPixelRepresentation(image) {
      const value = image.data.uint16('x00280103');
      if(value === undefined) {
          return;
      }
      return value + (value === 0 ? ' (unsigned)' : ' (signed)');
    }
    function loadAndViewImage(imageId) {
    var element = document.getElementById('dicomImage');
    try {
            var start = new Date().getTime();
            cornerstone.loadAndCacheImage(imageId).then(function(image) {
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
            document.getElementById('institution').textContent =  image.data.string('x00080080'); 
            document.getElementById('patientName').textContent =  image.data.string('x00100010');
            document.getElementById('patientId').textContent =  image.data.string('x00100020'); 
            document.getElementById('date').textContent =  image.data.string('x00080032'); 
            document.getElementById('machine').textContent = image.data.string('x00081010');
            document.getElementById('genre').textContent = image.data.string('x00100040');
            document.getElementById('age').textContent = image.data.string('x00101010');
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
      // image enable the dicomImage element and activate a few tools
      loadAndViewImage(url);
      cornerstone.events.addEventListener('cornerstoneimageloadprogress', function(event) {
        const eventData = event.detail;
        const loadProgress = document.getElementById('loadProgress');
        loadProgress.textContent = `Image Load Progress: ${eventData.percentComplete}%`;
      });
    var element = document.getElementById('dicomImage');
    cornerstone.enable(element);
    // document.getElementById('downloadAndView').addEventListener('click', function(e) {  //     downloadAndView();  // });
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
    // const form = document.getElementById('form');  // form.addEventListener('submit', function() {   //     downloadAndView();  //     return false;  // });
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
    // document.getElementById('toggleCollapseInfo').addEventListener('click', function() {
    //     if (document.getElementById('collapseInfo').style.display === 'none') {
    //         document.getElementById('collapseInfo').style.display = 'block';
    //     } else {
    //         document.getElementById('collapseInfo').style.display = 'none';
    //     }
    // });
    function getUrlWithoutFrame() {
      var url = document.getElementById('wadoURL').value;
      var frameIndex = url.indexOf('frame=');
      if(frameIndex !== -1) {
          url = url.substr(0, frameIndex-1);
      }
      return url;
  }
  });//.open-modal
});
</script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div class="row no-gutters">
    <div class="col-lg-6">
    </div>  
    <div class="col-lg-6 container"  id="dicom"  hidden="true"><!--  <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">image dicom</h3></div></div> -->
        <div id="loadProgress">Image Load Progress:</div>
      <!--   <button id='toggleCollapseInfo' class="btn btn-primary" type="button">             Click for more info        </button> -->
      <div class="row">
        <form id="form" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-8">
              <input class="form-control" type="hidden" id="wadoURL" placeholder="Enter WADO URL" value="http://localhost:8000/imagedicom/{{$demande->resultat}}">
            </div>
          </div>

        </form>
      </div><!-- row -->
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
      </div>
    </div><!-- col-lg-6  -->
  </div>
</div>
@endsection
