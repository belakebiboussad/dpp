<div id="sidebar" class="sidebar responsive">
      @include('user.adm_scripts')
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
          <button class="btn btn-success"><i class="ace-icon fa fa-signal"></i></button><button class="btn btn-info"> <i class="ace-icon fa fa-pencil"></i>  </button>
          <button class="btn btn-warning"><i class="ace-icon fa fa-users"></i></button><button class="btn btn-danger">  <i class="ace-icon fa fa-cogs"></i>  </button>
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span> <span class="btn btn-info"></span><span class="btn btn-warning"></span><span class="btn btn-danger"></span>
         </div>
    </div><!-- /.sidebar-shortcuts -->
    <ul class="nav nav-list">
      <li class="">
        <a href="{{ route('home_admin') }}"> <i class="menu-icon fa fa-university"></i><span class="menu-text">Acceuil</span></a><b class="arrow"></b>
      </li>
      <li>
        <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-users"></i><span class="menu-text">Gestion Utilisateurs</span><b class="arrow fa fa-angle-down"></b></a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li class=""><a href="{{ route('users.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter Utilisateur </a><b class="arrow"></b></li>
          <li class=""><a href="{{ route('users.index') }}"><i class="menu-icon fa fa-eye pink"></i>Liste Utilisateurs</a></li>
        </ul>
      </li>
      <li>
        <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-tags"></i> <span class="menu-text">Gestion Des Roles</span><b class="arrow fa fa-angle-down"></b></a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li><a href="{{ route('role.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter  rôle</a><b class="arrow"></b></li>
          <li ><a href="{{ route('role.index') }}"><i class="menu-icon fa fa-eye pink"></i>Liste  Rôles </a><b class="arrow"></b></li>
         </ul>
      </li>
      <li>
        <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-users"></i>  <span class="menu-text"> Fonctionnaires</span><b class="arrow fa fa-angle-down"></b></a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li class=""> <a href="{{ route('assur.index') }}"><i class="menu-icon fa fa-eye pink"></i>Liste Fonctionnaires</a><b class="arrow"></b></li>          
        </ul>
      </li>
      <li>
        <a href="#" class="dropdown-toggle"> <i class="menu-icon fa fa-hospital-o"></i> <span class="menu-text">infrastructure</span><b class="arrow fa fa-angle-down"></b></a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li><a href="{{ route('etablissement.index') }}"><i class="menu-icon fa fa-eye pink"></i>Etablissement</a> <b class="arrow"></b></li>
          <li><a href="{{ route('service.index') }}"><i class="menu-icon fa fa-eye pink"></i></i>Services</a> <b class="arrow"></b></li>
          <li><a href="{{ route('salle.index') }}"><i class="menu-icon fa fa-eye pink"></i>Chambres  </a>  <b class="arrow"></b></li>
          <li class=""><a href="{{ route('lit.index') }}"><i class="menu-icon fa fa-eye pink"></i>Lits </a><b class="arrow"></b></li>
        </ul>
      </li>
    </ul><!-- /.nav-list -->
</div>