<div id="sidebar" class="sidebar responsive">
	<script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
  </script>
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success"> <i class="ace-icon fa fa-signal"></i>  </button>
           <button class="btn btn-info"> <i class="ace-icon fa fa-pencil"></i></button>
            <button class="btn btn-warning"> <i class="ace-icon fa fa-users"></i></button>
              <button class="btn btn-danger"><i class="ace-icon fa fa-cogs"></i></button>
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span> <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span><span class="btn btn-danger"></span>
        </div>
  </div><!-- /.sidebar-shortcuts -->
  <li class="">
        <a href="home">
            <i class="menu-icon fa fa-picture-o"></i>    <span class="menu-text">Gestion des colloques</span> 
        </a>
        <b class="arrow"></b>
  </li>
  <ul class="nav nav-list">
    <li class="">
        <a href="/home_dele">
                <i class="menu-icon fa fa-university"></i><span class="menu-text">Accueil</span>
        </a>

        <b class="arrow"></b>
    </li>
    <li class="">
          <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-h-square"></i>
                <span class="menu-text">Colloques en cours</span>
                <b class="arrow fa fa-angle-down"></b>
          </a>
          <b class="arrow"></b>
          <ul class="submenu">
                <li class="">
                    <a href="/listecolloques/0">
                        <i class="menu-icon fa fa-eye pink"></i>
                        Colloques médicaux
                    </a>
                    <b class="arrow"></b>
                </li>
                <li>
                    <a href="/listecolloques/1">  <i class="menu-icon fa fa-eye pink"></i> Colloques chirurgicaux  </a>   
                </li>
                <li class="">
                    <a href="{{ route('colloque.create')}}"> <i class="menu-icon fa fa-plus purple"></i> Ajouter un colloque </a>
                    <b class="arrow"></b>
                </li>              
            </ul>
    </li><!-- colloques en cours -->
    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-user-md"></i>
            <span class="menu-text">Colloques cloturé</span>
            <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
              <li class="">
                    <a href="/listecolloquesCloture/0">
                        <i class="menu-icon fa fa-eye pink"></i>  Colloques médicaux </a>  <b class="arrow"></b>
                   </li>

                <li class="">
                    <a href="/listecolloquesCloture/1"> <i class="menu-icon fa fa-eye pink"></i> Colloques chirurgicaux  </a>
                   <b class="arrow"></b>
                </li>
        </ul>
    </li>
    <li class="">
        <a href="#" class="dropdown-toggle">  <!-- <i class="ace-icon glyphicon glyphicon-file md"></i>  -->
             <i class="menu-icon fa fa-hospital-o"></i> <span class="menu-text">Demandes hosp</span>
        </a>
           <b class="arrow"></b>
        <ul class="submenu">
           @php $x = 0 @endphp
          <li class="">             
              <a href="/demandehosp/listedemandes/{{ $x }}">                 
                   <i class="menu-icon fa fa-eye pink"></i>Demandes médicales
              </a>
              <b class="arrow"></b>
          </li>
          <li class="">
              <a href="/demandehosp/listedemandes/{{ ++$x }}">
                  <i class="menu-icon fa fa-eye pink"></i>Demandes chirurgicales
              </a>
              <b class="arrow"></b>
          </li>
        </ul>       
    </li>
    </ul> <!-- nav-list -->
  <br>  <br>    
  <!-- #section:basics/sidebar.layout.minimize -->
  <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
  </div>
      <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div><!-- sidebar -->