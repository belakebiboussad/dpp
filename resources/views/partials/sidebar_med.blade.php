<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>
    <script type="text/javascript" src="{{ asset('js/app-med.js') }}"></script>
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">  <i class="ace-icon fa fa-signal"></i>   </button>
            <button class="btn btn-info"> <i class="ace-icon fa fa-pencil"></i>  </button> <!-- #section:basics/sidebar.layout.shortcuts --> 
            <button class="btn btn-warning"> <i class="ace-icon fa fa-users"></i>   </button>
            <button class="btn btn-danger">        <i class="ace-icon fa fa-cogs"></i>  </button>   <!-- /section:basics/sidebar.layout.shortcuts -->
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span><span class="btn btn-info"></span><span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->
    <li class="">
        <a href="home">
            <i class="menu-icon fa fa-picture-o"></i> <span class="menu-text">Gestion Patients</span>
        </a>
        <b class="arrow"></b>
    </li>
    <ul class="nav nav-list">
        <li class="">
               <a href="{{ route('patient.index') }}">
                         <i class="menu-icon fa fa-tachometer"></i>    <span class="menu-text"> Acceuil </span>  
            </a>
            <b class="arrow"></b>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-users"></i> <span class="menu-text"> Patients
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="{{ route('patient.create') }}">
                        <i class="menu-icon fa fa-plus purple"></i>  Ajouter Patient
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ route('patient.index') }}">
                        <i class="menu-icon fa fa-eye pink"></i>  Liste Patients
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li  class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-users"></i>  <span class="menu-text"> Fonctionnaires </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="{{ route('patient.create') }}">
                        <i class="menu-icon fa fa-plus purple"></i>  Ajouter Fonctinnaire
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ route('assur.index') }}">
                        <i class="menu-icon fa fa-eye pink"></i> Liste Fonctionnaires
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
               <i class="menu-icon fa fa-user-md"></i> <span class="menu-text"> Consultations </span>
               <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="/choixpat">
                        <i class="menu-icon fa fa-plus purple"></i>Ajouter Consultation   
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="/listcons">
                        <i class="menu-icon fa fa-eye pink"></i> Liste Consultations
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
              <a href="#" class="dropdown-toggle">
                     <i class="menu-icon fa fa-hospital-o"></i>
                      <span class="menu-text" data-toggle="tooltip" data-placement="top" title="hospitalisations du service">Hospitalisations </span>
                      <b class="arrow fa fa-angle-down"></b>
              </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                        <a href="{{ route('hospitalisation.create') }}">
                            <i class="menu-icon fa fa-plus purple"></i>Ajouter   Hospitalisation
                        </a>
                        <b class="arrow"></b>
                    </li>
                <li class="">
                    <a href="{{ route('hospitalisation.index') }}"  data-toggle="tooltip" data-placement="top" title=" Liste d'hospitalisation du service">
                        <i class="menu-icon fa fa-eye pink"></i> Liste des Hospitalisations
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-table"></i><span class="menu-text">Rendez-Vous</span>
               <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="{{ route('rdv.create') }}">
                        <i class="menu-icon fa fa-plus purple"></i>Ajouter un RDV
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ route('rdv.index') }}">
                        <i class="menu-icon fa fa-eye pink"></i>Liste des RDVs
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        @if(Auth::user()->role_id == "10")
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-stethoscope"></i><span class="menu-text">Produits pharmacie</span><b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="{{ route('demandeproduit.create') }}">
                        <i class="menu-icon fa fa-plus purple"></i>Demande Produit
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        @endif
        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-stethoscope"></i><span class="menu-text">Gestion des visites</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="/choixpatvisite"><i class="menu-icon fa fa-plus purple"></i>Ajouter visite</a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-file-o"></i><span class="menu-text" data-toggle="tooltip" data-placement="top" title=" Demandes d'hospitalisation">Demandes</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="{{route('demandehosp.index')}}"  data-toggle="tooltip" data-placement="top" title=" Liste Demandes d'hospitalisation"><i class="menu-icon fa fa-eye pink"></i>Liste Demandes</a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
    </ul><!-- /.nav-list -->
    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
       $(function() {
              var checkbox = $("#hommeConf");
              checkbox.change(function() {
                      if(checkbox.is(":checked"))
                              $("#hommelink").removeClass('invisible');
                      else
                             $("#hommelink").addClass('invisible');  
            })
        });
    </script>
</div><!-- /section:basics/sidebar -->