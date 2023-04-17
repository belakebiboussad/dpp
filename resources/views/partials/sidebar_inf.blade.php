<div id="sidebar" class="sidebar responsive">
  <div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
      <button class="btn btn-success"><i class="ace-icon fa fa-signal"></i></button>
      <button class="btn btn-info"><i class="ace-icon fa fa-pencil"></i></button>
      <!-- #section:basics/sidebar.layout.shortcuts -->
      <button class="btn btn-warning"><i class="ace-icon fa fa-users"></i></button>
      <button class="btn btn-danger"><i class="ace-icon fa fa-cogs"></i></button>
            <!-- /section:basics/sidebar.layout.shortcuts -->
    </div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
      <span class="btn btn-success"></span><span class="btn btn-info"></span>
      <span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
    </div>
    <ul class="nav nav-list">
      <li>
        <a href="{{ route('hospitalisation.index') }}"><i class="menu-icon material-icons">home</i>
          <span class="menu-text">Accueil</span>
        </a><b class="arrow"></b>
      </li>
      <li>
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-h-square"></i>
          <span class="menu-text">Hospitalisations</span><b class="arrow fa fa-angle-down"></b>
        </a><b class="arrow"></b>
        <ul class="submenu">
          <li>
            <a href="{{ route('hospitalisation.index') }}"> <i class="menu-icon fa fa-caret-right"></i>Hospitalisations</a><b class="arrow"></b>         
          </li>
        </ul>
      </li>
    </ul>
  </div><!-- shortcuts -->
</div>