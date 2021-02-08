<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>
    <script type="text/javascript" src="{{ asset('js/app-med.js') }}"></script>
     <div class="sidebar-shortcuts" id="sidebar-shortcuts">
          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success"><i class="ace-icon fa fa-signal"></i></button>
                <button class="btn btn-info"><i class="ace-icon fa fa-pencil"></i></button><!-- #section:basics/sidebar.layout.shortcuts -->
                <button class="btn btn-warning"><i class="ace-icon fa fa-users"></i></button>
                <button class="btn btn-danger"><i class="ace-icon fa fa-cogs"></i></button> <!-- /section:basics/sidebar.layout.shortcuts -->
           </div>
           <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>  <span class="btn btn-info"></span><span class="btn btn-warning"></span>
                <span class="btn btn-danger"></span>
          </div>
    </div><!-- /.sidebar-shortcuts -->
     <li class=""><a href="home"><i class="menu-icon fa fa-picture-o"></i><span class="menu-text">Gestion des Admissions</span></a><b class="arrow"></b></li>
     <ul class="nav nav-list">
          <li class=""> <a href="{{route('home_admission')}}"><i class="menu-icon fa fa-tachometer"></i><span class="menu-text"> Acceuil</span></a>
          <b class="arrow"></b></li>
          <li class=""> <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-users"></i><span class="menu-text">Admissions</span>
                <b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b>
                <ul class="submenu">
                     <li class=""><a href="{{ route('admission.index') }}"><i class="menu-icon fa fa-eye pink"></i> Admissions</a><b class="arrow"></b></li>
                     <li class=""><a href="{{ route('hospitalisation.index') }}"><i class="menu-icon fa fa-eye pink"></i>Presents</a><b class="arrow"></b> </li> 
                     <li class=""><a href="{{ route('admission.sortieAdm')}}"><i class="menu-icon fa fa-eye pink"></i>Sorties</a><b class="arrow"></b></li>
                </ul>
        </li>
    </ul><!-- /.nav-list -->
    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
      try{ace.settings.check('sidebar' , 'collapsed')}catch(e){} // function getAdmissions() { }
      const areSameDate = (first, second) =>
        first.getFullYear() === second.getFullYear() &&
        first.getMonth() === second.getMonth() &&
        first.getDate() === second.getDate(); 
    </script>
</div>
