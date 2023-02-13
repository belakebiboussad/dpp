<script src="{{ asset('/js/Dicom/hammer.min.js') }}"></script>
<script src="{{ asset('/js/Dicom/dicomParser.min.js') }}"></script>
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
      };
  }
  function _initInterface() {
    initModeButtons();
  }
  $(document).ready(function(){
    var loaded = false;
    $('body').on('click', '.dicom_viewer', function () {
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
      var APP_URL = "{{url('/files')}}" +"/" + $(this).val();
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
      cornerstoneTools.addTool(LengthTool);
      cornerstoneTools.setToolActive('Length', { mouseButtonMask: 1 });
    });
  });
</script>
<div class="row">
  <div class="col-sm-4 col-xs-12"><b>Institution :</b><span id="institution"></span></div> 
  <div class="col-sm-4 col-xs-12"><b>Nom patient :</b><span id="patientName"></span></div>
  <div class="col-sm-4 col-xs-12"><b>Code patient :</b><span id="patientId"></span></div>
</div>
<div class="row">
  <div class="col-sm-4 col-xs-12"><b>Date :</b><span id="date"></span>
  </div>
  <div class="col-sm-4 col-xs-12"><b>Genre :</b><span id="genre"></span>
  </div>
  <div class="col-sm-4 col-xs-12"<b>>Age :</b><span id="age"></span><br><!-- <span>Machine: </span><span id="machine"></span><br> -->
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-xs-12">
    <div col="col-md-12 col-sm-12" oncontextmenu="return false" class='disable-selection noIbar' unselectable='on' onselectstart='return false;' onmousedown='return false;'>
      <div id="dicomImage" style="height:512px"></div>
    </div>
  </div>
</div><div class="space-12 hidden-xs"></div>
<div class="row">
  <div class="col-sm-8">
    <button id="zoomIn" type="button" class="btn btn-default"><i class="fa fa-search-plus bigger-150" aria-hidden="true"></i></button>
    <button id="zoomOut" type="button" class="btn btn-default"><i class="fa fa-search-minus bigger-150" aria-hidden="true"></i></button>
    <button id="reset" type="button" class="btn btn-default"><i class="fa fa-undo bigger-150" aria-hidden="true"></i></button>
  </div>
  <div class="col-sm-4 pull-right" id="loadProgress">Image Load Progress: </div>

</div>