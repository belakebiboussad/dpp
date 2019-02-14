<!-- #section:basics/sidebar -->
<div id="sidebar" class="sidebar                  responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <!-- #section:basics/sidebar.layout.shortcuts -->
            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>

            <!-- /section:basics/sidebar.layout.shortcuts -->
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <li class="">
        <a href="home">
            <i class="menu-icon fa fa-picture-o"></i>
            <span class="menu-text">MENU Gestion Patients</span>
        </a>

        <b class="arrow"></b>
    </li>

    <ul class="nav nav-list">
        <li class="">
            <a href="/home_dele">
                <i class="menu-icon fa fa-university"></i>
                <span class="menu-text"> Acceuil </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-h-square"></i>
                            <span class="menu-text">
                                Colloques
                            </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
                @php $i = 1 @endphp
              {{--   @php $j = 2 @endphp --}}
                
            <ul class="submenu">
                <li class="">
                    <a href="/listecolloques/{{ $i }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Colloques Médicaux
                    </a>
                    <b class="arrow"></b>
                </li>
                <li>
                    <a href="/listecolloques/{{ ++$i }}">Colloques Chirurgicaux</a>
                </li>
                <li class="">
                    <a href="{{ route('colloque.create')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Nouveau colloque
                    </a>
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
    </script>
</div>

<!-- /section:basics/sidebar -->