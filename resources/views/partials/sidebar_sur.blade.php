<!-- #section:basics/sidebar -->
<div id="sidebar" class="sidebar responsive">
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
            <span class="menu-text">Gestion Patients</span>
        </a>

        <b class="arrow"></b>
    </li>

    <ul class="nav nav-list">
        <li class="">
            <a href="/home_sur">
                <i class="menu-icon fa fa-university"></i>
                <span class="menu-text"> Acceuil </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-h-square"></i>
                            <span class="menu-text">
                                Hospitalisations
                            </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
            <ul class="submenu">
                     <li class="">
                              {{-- <a href="{{ route('hospitalisation.index') }}"> --}}
                              <a href="{{ URL::route('hospitalisation.index') }}">
                                   <i class="menu-icon fa fa-caret-right"></i>
                                     Liste Hospitalisations
                            </a>
                            <b class="arrow"></b>
                    </li>
                    <li class="">
                            <a href="/affecterLit">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Affectation des Lits
                             </a>
                    <b class="arrow"></b>
                </li>
               
            </ul>
        </li>
           <li class="">
                     <a href="#" class="dropdown-toggle">
                     <i class="menu-icon fa fa-calendar"></i>
                            <span class="menu-text">
                                Rendez-Vous
                            </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                    <li class="">
                               <a href="/hospitalisation/addRDV">
                                    <i class="menu-icon fa fa-plus"></i>
                                    Ajouter Rendez-Vous
                                </a>
                                <b class="arrow"></b>
                    </li>
                    <li class="">
                               <a href="/hospitalisation/listeRDVs">
                                    <i class="menu-icon fa fa-clock-o"></i>
                                        Liste des Rendez-Vous
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
        function addDays()
        {
            var jsDate = $('#dateEntree').datepicker('getDate');
            jsDate.setDate(jsDate.getDate() + parseInt($('#numberDays').val()));
            var dateEnd = jsDate.getFullYear() + '-' + (jsDate.getMonth()+1) + '-' + jsDate.getDate();
            $("#dateSortie").datepicker("setDate", dateEnd);    
        }
        $('document').ready(function(){
            $('.filelink' ).click( function( e ) {
                e.preventDefault();  
            });
            $('#dateSortie').attr('readonly', true);
            $('#dateEntree').change(function(){
                $('#numberDays').val(0);                
                addDays();
            });
            $('#numberDays').on('click keyup', function() {
                addDays();
            });  
            $('#serviceh').change(function(){
                var attr = $('#salle').attr('disabled');
                if (typeof attr !== typeof undefined && attr !== false) {
                    $('#salle').removeAttr("disabled");
                }
                var attr = $('#lit').attr('disabled');
                if (typeof attr == typeof undefined && attr == false) {
                    $('#lit').attr('disabled', 'disabled');
                }
                $('#lit').attr('disabled', 'disabled');
                $('#lit option[value=0]').prop('selected', true);
                $.ajax({
                    url : '/getsalles/'+ $('#serviceh').val(),
                    type : 'GET',
                    dataType : 'json',
                    success : function(data){
                        var select = $('#salle').empty();
                        if(data.length != 0){
                            select.append("<option value=''>selectionnez la salle d'hospitalisation</option>");   
                            $.each(data,function(){
                                    select.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                            });
                        }
                        else
                        {      
                            select.append('<option value="" selected disabled>Pas de salle</option>');
                        }
                    },
                });
            });
            $('#salle').change(function(){
                $('#lit').removeAttr("disabled");
                $.ajax({
                        url : '/getlits/'+ $('#salle').val(),
                        type : 'GET',
                        dataType : 'json',
                        success : function(data){
                            var selectLit = $('#lit').empty();
                            if(data.length != 0){
                                selectLit.append("<option value=''>selectionnez le lit d'hospitalisation</option>");
                                $.each(data,function(){
                                    selectLit.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                                });
                            }
                            else
                            {
                                selectLit.append('<option value="" selected disabled>Pas de Lit</option>');
                            }
                        },
                });
            }); 
        })

    </script>
</div>

<!-- /section:basics/sidebar -->