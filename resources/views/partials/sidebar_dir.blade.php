<div id="sidebar" class="sidebar  responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success"><i class="ace-icon fa fa-signal"></i></button>
            <button class="btn btn-info"><i class="ace-icon fa fa-pencil"></i></button> 
            <button class="btn btn-warning"><i class="ace-icon fa fa-users"></i></button>
            <button class="btn btn-danger"><i class="ace-icon fa fa-cogs"></i></button>
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div>
    <li>
        <a href="home"><i class="menu-icon fa fa-picture-o"></i><span class="menu-text">Gestion Patient</span></a>
        <b class="arrow"></b>
    </li>
    <ul class="nav nav-list">
      <li >
        <a href="{{ route('stat.index') }}"><i class="menu-icon fa fa-picture-o"></i><span class="menu-text">Tableau de bord</span></a><b class="arrow"></b>
      </li>
      <li>
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-users"></i>  <span class="menu-text"> Fonctionnaires </span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
          <ul class="submenu">
             <li>
                <a href="{{ route('assur.index') }}"><i class="menu-icon fa fa-eye pink"></i> Liste des fonctionnaires</a>
                <b class="arrow"></b>
              </li>
            </ul>
      </li>
      <li>
        <a href="{{ route('params.index')}}"><i class="menu-icon fa fa-cog"></i><span class="menu-text">Paramètres</span></a>
        <b class="arrow"></b>
      </li>
    </ul>
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>