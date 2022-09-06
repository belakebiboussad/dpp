<div id="navbar" class="navbar navbar-default" style="background-color:#19e2f9">
     <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
     </script>
     <div class="navbar-container" id="navbar-container"> <!-- #section:basics/sidebar.mobile.toggle -->
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
          <span class="sr-only">Toggle sidebar</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </button><!-- /section:basics/sidebar.mobile.toggle -->
        <div class="navbar-header pull-left" >  <!-- #section:basics/navbar.layout.brand -->
          <a href="#" class="navbar-brand"><small> <i class="ace-icon fa fa-h-square"></i>
            <strong>Dossier Médical Electronique EHSN</strong></small></a> 
         </div> <!-- #section:basics/navbar.dropdown --> 
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
          <ul class="nav ace-nav"> <!-- #section:basics/navbar.user_menu -->    
            <li class="light-blue">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                <img class="nav-user-photo" src="{{ asset('/avatars/user.jpg') }}" alt="admins's Photo"/>
			          <span class="user-info"><small>Bienvenue,</small> {{ Auth::user()->name }}</span> <i class="ace-icon fa fa-caret-down"></i>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                      <li><a href="#"><i class="ace-icon fa fa-cog"></i>Réglages</a></li> 
                      <li><a href="/profile/{{Auth::user()->id}}"><i class="ace-icon fa fa-user"></i> Profil</a> </li>
                      <li class="divider"></li>
                      <li>
                          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                              <i class="ace-icon fa fa-power-off"></i> Déconnexion
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                              </form>
                          </a>
                      </li>
                    </ul>
                    </a>
                </li><!-- /section:basics/navbar.user_menu -->
            </ul>
        </div>
        <!-- /section:basics/navbar.dropdown -->
    </div><!-- /.navbar-container -->
</div>