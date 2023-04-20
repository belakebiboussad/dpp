<div id="navbar" class="navbar navbar-default" style="background-color:#19e2f9">
     <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
     </script>
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
          <span class="sr-only">Toggle sidebar</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left" >
          <a href="#" class="navbar-brand"><small><i class="ace-icon fa fa-h-square"></i>
            <b>Dossier Médical Electronique &quot;{{ Session('etabAcr')}}&quot;</b></small></a> 
         </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
          <ul class="nav ace-nav"> 
            <li class="light-blue">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                <img class="nav-user-photo" src="{{ asset('/avatars/user.jpg') }}" alt="admins's Photo"/>
			         <span class="user-info"><small>Bienvenue,</small> {{ Auth::user()->username }}</span> <i class="ace-icon fa fa-caret-down"></i>
                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                  <li>
                  <a data-toggle="modal" data-target="#resetPwd" href="#">
                    <i class="ace-icon fa fa-cog"></i> Changer le mot de passe
                  </a>
                  </li> 
                  <li><a href="/profile/{{Auth::id() }}"><i class="ace-icon fa fa-user"></i>Profil</a></li><li class="divider"></li>
                  <li>
                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="ace-icon fa fa-power-off"></i> Déconnexion</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="invisible">{{ csrf_field() }} 
                      </form>
                  </li>
                </ul>
                </a>
                </li>
            </ul>
        </div>

    </div>
</div>
@include("user.ModalFoms.resetPwd")