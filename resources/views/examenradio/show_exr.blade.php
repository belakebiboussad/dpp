@extends('app')
@section('page-script') 
  <script>
    window.ENVIRONMENT = 'production';
  </script>
    <script src="https://unpkg.com/hammerjs@2.0.8/hammer.js"></script>
    <script src="https://unpkg.com/dicom-parser@1.8.3/dist/dicomParser.min.js"></script>
    <!-- include the cornerstone library -->
    <script src="https://unpkg.com/cornerstone-core"></script>
   <script src="{{ asset('/js/Dicom/cornerstoneMath.js') }}"></script> 
    {{--<script src="https://unpkg.com/cornerstone-math"></script>--}}
    <script src="{{ asset('/js/Dicom/cornerstoneWADOImageLoader.min.js') }}"></script>  
    <script src="{{ asset('/js/Dicom/cornerstoneTools.js') }}"></script> <!--<script src="https://unpkg.com/cornerstone-tools@%5E4"></script>-->
    <title>   Length Tool  </title>
 <script>
     const convertMouseEventWhichToButtons = which => {
      switch (which) {
        // no button
        case 0:
          return 0;
        // left
        case 1:
          return 1;
        // middle
        case 2:
          return 4;
        // right
        case 3:
          return 2;
      }
      return 0;
    };
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
        // Externals
        cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
        cornerstoneWADOImageLoader.external.dicomParser = dicomParser;
        cornerstoneTools.external.cornerstoneMath = cornerstoneMath;
        cornerstoneTools.external.cornerstone = cornerstone;
        cornerstoneTools.external.Hammer = Hammer;
        // Image Loader
        const config = { //webWorkerPath: `${baseUrl}assets/image-loader/cornerstoneWADOImageLoaderWebWorker.min.js`,
          webWorkerPath:"{{ asset('/js/Dicom/cornerstoneWADOImageLoader.min.js') }}",
          taskConfiguration: {
              decodeTask: { //codecsPath: `${baseUrl}assets/image-loader/cornerstoneWADOImageLoaderCodecs.js`,cornerstoneWADOImageLoaderCodecs.min.js
                codecsPath: "{{ asset('/js/Dicom/cornerstoneWADOImageLoaderCodecs.min.js') }}",
              },
            },
        };
      cornerstoneWADOImageLoader.webWorkerManager.initialize(config);
    }
    function _initInterface() {
    initModeButtons();
  }
    $(document).ready(function(){
      document.addEventListener('DOMContentLoaded', () => {
        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {
          // Add a click event on each of them
          $navbarBurgers.forEach( el => {
            el.addEventListener('click', () => {
              // Get the target from the "data-target" attribute
              const target = el.dataset.target;
              const $target = document.getElementById(target);
              // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
              el.classList.toggle('is-active');
              $target.classList.toggle('is-active');
            });
          });
        }
      });
      _initCornerstone();
      const element = document.querySelector('.cornerstone-element');
      _initInterface();
      // Init CornerstoneTools
      cornerstoneTools.init(
      {
        showSVGCursors: true,
      });
      cornerstone.enable(element);
      const toolName = 'Length';
      const imageIds = [
        'wadouri:http://localhost:8000/imagedicom/CT_small.dcm',
        'wadouri:http://localhost:8000/imagedicom/IMG00005.dcm',
      ];
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
      });
      const LengthTool = cornerstoneTools.LengthTool;
      cornerstoneTools.addTool(LengthTool)
      cornerstoneTools.setToolActive('Length', { mouseButtonMask: 1 })
    });
</script> 

@endsection
@section('main-content')
<header role="banner">
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="/examples/">
        <img src="{{ asset('/img/logo.png') }}" height="28">
      </a>

      <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item" href="/">
          Docs
        </a>

        <a class="navbar-item" href="/api">
          API
        </a>

        <a class="navbar-item" href="/examples/">
          Examples
        </a>

        <a class="navbar-item" href="https://github.com/cornerstonejs/cornerstoneTools">
          GitHub
        </a>
      </div>

    </div>
  </nav>
</header>
<main class="page-content" aria-label="Content">
  <div class="wrapper">
        <section class="section">
  <div class="container">
    <h1 class="title is-1">Length Tool</h1>

    <div class="buttons mode-buttons">
      <button class="button set-tool-mode is-primary" data-action="Active">
          Active
      </button>
      <button class="button set-tool-mode" data-action="Passive">
          Passive
      </button>
      <button class="button set-tool-mode" data-action="Enabled">Enable</button>
      <button class="button set-tool-mode" data-action="Disabled">
          Disable
      </button>
    </div>

    <div class="cornerstone-element-wrapper">
      <div id="cornerstone-element" class="cornerstone-element" data-index="0" oncontextmenu="return false"></div>
    </div>
  </div>
</section>
</div>
</main>
<footer class="footer">
  <div class="content container">
    <p>CornerstoneTools.js is a light-weight solution for building Tools on top of Cornerstone.js. It&#39;s only dependencies are libraries within the Cornerstone family. Instead of trying to &quot;do everything&quot; it aims to be extensible and pluggable to aid in the rapid development of new tools. Ideally, tools created using cornerstone-tools can be easily shared, allowing for the creation of a broader ecosystem.</p>

    <p style="text-align: center;">
      <strong>CornerstoneTools.js</strong> is licensed
      <a href="https://opensource.org/licenses/mit-license.php">MIT</a>.
    </p>
  </div>
@endsection