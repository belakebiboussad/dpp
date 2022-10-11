<div id="navbar" class="navbar navbar-default" style="background-color:#19e2f9">
     <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
     </script>
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
          <span class="sr-only">Toggle sidebar</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left" >
          <a href="#" class="navbar-brand"><small> <i class="ace-icon fa fa-h-square"></i>
            <b>Dossier Médical Electronique &quot;{{ Session('etabAcr')}}&quot;</b></small></a> 
         </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
          <ul class="nav ace-nav"> 
            <li class="light-blue">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                <img class="nav-user-photo" src="{{ asset('/avatars/user.jpg') }}" alt="admins's Photo"/>
			          <span class="user-info"><small>Bienvenue,</small> {{ Auth::user()->name }}</span> <i class="ace-icon fa fa-caret-down"></i>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                      <li><a href="#"><i class="ace-icon fa fa-cog"></i>Réglages</a></li> 
                      <li><a href="/profile/{{Auth::user()->id}}"><i class="ace-icon fa fa-user"></i>Profil</a> </li>  <li class="divider"></li>
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
                </li>
            </ul>
        </div>

    </div>
</div>