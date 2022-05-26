<div id="sidebar" class="sidebar responsive">
  <div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
      <button class="btn btn-success"><i class="ace-icon fa fa-signal"></i></button>
      <button class="btn btn-info"><i class="ace-icon fa fa-pencil"></i></button>
      <button class="btn btn-warning"><i class="ace-icon fa fa-users"></i></button>
      <button class="btn btn-danger"><i class="ace-icon fa fa-cogs"></i></button>
    </div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
      <span class="btn btn-success"></span><span class="btn btn-info"></span><span class="btn btn-warning"></span>
      <span class="btn btn-danger"></span>
    </div>
  </div>
  <ul class="nav nav-list">
    <li>
      <a href="{{ route('patient.index') }}"><i class="menu-icon fa fa-tachometer"></i><span class="menu-text">Accueil</span></a>
      <b class="arrow"></b>
    </li>
    @if(Auth::user()->role_id == "14")
    <li class="">
      <a href="{{ route('stat.index') }}"><i class="menu-icon fa fa-picture-o"></i><span class="menu-text">Tableau de bord</span></a><b class="arrow"></b>
    </li>
    @endif
    <li>
      <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-users"></i><span class="menu-text">Patients</span><b class="arrow fa fa-angle-down"></b>
      </a><b class="arrow"></b>
      <ul class="submenu">
        <li>
          <a href="{{ route('patient.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter un patient</a><b class="arrow"></b>
        </li>
        <li><a href="{{ route('patient.index') }}"><i class="menu-icon fa fa-eye pink"></i>Liste des patients</a><b class="arrow"></b></li>
      </ul>
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-users"></i><span class="menu-text"> Fonctionnaires</span><b class="arrow fa fa-angle-down"></b>
      </a><b class="arrow"></b>
      <ul class="submenu">
        <li><a href="{{ route('assur.index') }}"><i class="menu-icon fa fa-eye pink"></i> Liste des fonctionnaires</a><b class="arrow"></b>
        </li>
      </ul>
      </li>
      <li>
        <a href="#" class="dropdown-toggle">
           <i class="menu-icon fa fa-user-md"></i> <span class="menu-text"> Consultations </span><b class="arrow fa fa-angle-down"></b>
        </a><b class="arrow"></b>
        <ul class="submenu">
          </li>
          <li><a href="{{ route('consultations.index')}}"><i class="menu-icon fa fa-eye pink"></i> Liste des consultations</a><b class="arrow"></b>
          </li>
        </ul>
      </li>
      <li>
        <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-hospital-o"></i>
          <span class="menu-text" data-toggle="tooltip" data-placement="top" title="hospitalisations du service">Hospitalisations </span>
          <b class="arrow fa fa-angle-down"></b>
        </a><b class="arrow"></b>
        <ul class="submenu">
          <li>
            <a href="{{ route('hospitalisation.index') }}"  data-toggle="tooltip" data-placement="top" title=" Liste d'hospitalisation du service">
              <i class="menu-icon fa fa-eye pink"></i>Liste des hospitalisations
            </a><b class="arrow"></b>
          </li>
        </ul>
      </li>
      <li>
              <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-table"></i><span class="menu-text">Rendez-Vous</span><b class="arrow fa fa-angle-down"></b>
              </a><b class="arrow"></b>
              <ul class="submenu">
                <li>
                  <a href="{{ route('rdv.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter RDV</a> <b class="arrow"></b>
                </li>
                <li>
                  <a href="{{ route('rdv.index') }}"><i class="menu-icon fa fa-eye pink"></i>Liste RDVs</a><b class="arrow"></b>
                </li>
                <li>
                  <a href=""><i class="menu-icon fa fa-eye pink"></i>Planning</a><b class="arrow"></b>
                </li>
              </ul>
        </li>
      <li>
              <a href="#" class="dropdown-toggle">
                   <i class="menu-icon fa fa-table"></i><span class="menu-text">Demandes Hospi</span><b class="arrow fa fa-angle-down"></b>
              </a><b class="arrow"></b>
              <ul class="submenu">
                   <li>
                          <a href="{{ route('demandehosp.index') }}"><i class="menu-icon fa fa-eye pink"></i>Liste des demandes</a> <b class="arrow"></b>
                   </li>
              </ul>
      </li>
      @if(Auth::user()->role_id == "10")
      <li class="">
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-stethoscope"></i><span class="menu-text">Produits de la pharmacie</span><b class="arrow fa fa-angle-down"></b>
        </a><b class="arrow"></b>
        <ul class="submenu">
          <li>
            <a href="{{ route('demandeproduit.create') }}"><i class="menu-icon fa fa-plus purple"></i>Demande produit</a>
            <b class="arrow"></b>
          </li>
        </ul>
      </li>
      @endif
      @if(Auth::user()->is(14))
      <li class="">
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-medkit" aria-hidden="true"></i><span class="menu-text">Produits</span>
          <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li class="">
            <a href="{{ route('demandeproduit.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter une demande</a><b class="arrow"></b>
          </li>
          <li>
            <a href="{{ route('demandeproduit.index') }}"><i class="menu-icon fa fa-eye pink"></i> Liste des demandes</a>
            <b class="arrow"></b>
        </li>              
      </ul>
      </li>
      <li>
        <a href="{{ route('params.index')}}"><i class="menu-icon fa fa-cog"></i><span class="menu-text">Paramètres</span></a>
        <b class="arrow"></b>
      </li>
      @endif
  </ul><!-- /.nav-list -->
  <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
  </div>
  <script type="text/javascript">
  $(document).ready(function () {
    $('body').on('click', '.CimCode', function (event) {
      $('#cim10Modal').trigger("reset");
      $('#inputID').val($(this).val());
      $('#cim10Modal').modal('show');
    });
  })
  </script>
</div>