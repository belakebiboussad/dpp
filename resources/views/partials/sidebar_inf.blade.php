<div id="sidebar" class="sidebar responsive">
  <script type="text/javascript">
  </script>
  <div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <!-- #section:basics/sidebar.layout.shortcuts -->
            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>

            <!-- /section:basics/sidebar.layout.shortcuts -->
    </div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
      <span class="btn btn-success"></span>
      <span class="btn btn-info"></span>
      <span class="btn btn-warning"></span>
      <span class="btn btn-danger"></span>
    </div>
    <ul class="nav nav-list">
      <li class="">
        <a href="{{ route('hospitalisation.index') }}">
          <i class="menu-icon fa fa-university"></i><span class="menu-text"> Acceuil </span>
        </a>
        <b class="arrow"></b>
      </li>
      <li class="">
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-h-square"></i>
          <span class="menu-text">Hospitalisations</span>
          <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li class="">
            <a href="{{ route('hospitalisation.index') }}"> <i class="menu-icon fa fa-caret-right"></i>Liste Hospitalisations</a>          
            <b class="arrow"></b>
          </li>
        </ul>
      </li>
    </ul>
  </div><!-- shortcuts -->
</div>