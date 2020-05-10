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
      <span class="btn btn-success"></span><span class="btn btn-info"></span><span class="btn btn-warning"></span><span class="btn btn-danger"></span>
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
          <span class="menu-text">Hospitalisation</span>
          <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li class="">     
            <a href="{{ URL::route('hospitalisation.index') }}">{{-- <a href="{{ route('hospitalisation.index') }}"> --}}
              <i class="menu-icon fa fa-caret-right"></i>Liste des Hospitalisations
            </a>
            <b class="arrow"></b>
          </li>
          <li class="">
            <a href="/affecterLit">
              <i class="menu-icon fa fa-caret-right"></i>Affectation des Lits
            </a>
            <b class="arrow"></b>
          </li>
        </ul>
      </li>
      <li class="">
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-calendar"></i><span class="menu-text">Rendez-Vous</span>
          <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li class="">
            <a href="/hospitalisation/addRDV">
              <i class="menu-icon fa fa-plus"></i>Ajouter Rendez-Vous
            </a>
            <b class="arrow"></b>
          </li>
          <li class="">
            <a href="/hospitalisation/listeRDVs">
              <i class="menu-icon fa fa-clock-o"></i>Liste des Rendez-Vous     
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
/*var jsDate = $('#dateEntree').datepicker('getDate');jsDate.setDate(jsDate.getDate() + parseInt($('#numberDays').val()));
var dateEnd = jsDate.getFullYear() + '-' + (jsDate.getMonth()+1) + '-' + jsDate.getDate(); $("#dateSortiePre").datepicker("setDate", dateEnd);*/
          var datefin = new Date($('#dateEntree').val());
          datefin.setDate(datefin.getDate() + parseInt($('#numberDays').val(), 10));
          $("#dateSortiePre").val(moment(datefin).format("YYYY-MM-DD"));        
        }
        $("document").ready(function(){
            $(".filelink" ).click( function( e ) {
                e.preventDefault();  
            });
             $("#dateSortie").attr('readonly', true);
             $("#dateEntree").change(function(){
                    $('#numberDays').val(0);                
                    addDays();
            });
            $("#numberDays").on('click keyup', function() {
                addDays();
            });
            $("#serviceh").change(function(){
                   if($(this ).val() != 0)
                   {  
                          var attr = $('#salle').attr('disabled');
                          if (typeof attr !== typeof undefined && attr !== false) {
                              $('#salle').removeAttr("disabled");
                          }
                          $('#lit option[value=0]').prop('selected', true);
                          $('#lit').attr('disabled', 'disabled');
                          var serviceID = $('#serviceh').val();
                          var start = $('#dateEntree').val(); //var start =$('#dateEntree').datepicker('getDate');
                          var end = $("#dateSortiePre").val(); //var end = $('#dateSortiePre').datepicker('getDate');
                          if(end !== null  && end !== '')
                          {
                                 $.ajax({
                                       url : '/getsalles',
                                       type:'GET',
                                       data: { 
                                              ServiceID: serviceID , 
                                              StartDate: start, 
                                              EndDate: end,
                                       }, //dataType : 'json',
                                       success: function(data, textStatus, jqXHR){
                                              var select = $('#salle').empty();
                                             if(data.length != 0){
                                                    select.append("<option value='0'>Selectionnez une salle</option>");   
                                                    $.each(data,function(){
                                                          select.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                                                    });
                                             }else
                                             {      
                                                    select.append('<option value="" selected disabled>Pas de salle</option>');
                                              }
                                       },
                                       error: function (jqXHR, textStatus, errorThrown) {
                                              alert("error")
                                       }
                                });   
                          }
                    }else
                    {
                          $('#salle option[value=0]').prop('selected', true);
                          $('#lit option[value=0]').prop('selected', true);
                    }                 
             });
             $("#salle").change(function(){
                   if($(this ).val() != 0)
                   {  
                            var attr = $('#lit').attr('disabled');
                            if (typeof attr == typeof undefined && attr == false) {
                                  $('#lit').attr('disabled', 'disabled');
                           }
                        $('#lit').removeAttr("disabled");
                        var start = $('#dateEntree').val();
                        var end = $("#dateSortiePre").val();
                        var salleID =  $('#salle').val();
                        $.ajax({
                              url : '/getlits',
                              type : 'GET',
                              data: { 
                                    SalleID: salleID , 
                                    StartDate: start, 
                                    EndDate: end,
                              }, //dataType : 'json', 
                              success: function(data, textStatus, jqXHR){
                                      //$.each( data, function( key, value ) {//alert( key + ": " + value );// });      
                                                     
                                   
                                    var selectLit = $('#lit').empty();                          
                                    if(data.length != 0){
                                            selectLit.append("<option value='0'>Selectionnez un lit</option>");
                                            $.each(data,function(){
                                                selectLit.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                                            });
                                    }else
                                    {
                                           selectLit.append('<option value="" selected disabled>Pas de Lit libre</option>');
                                    }  
                              
                              },
                            error: function (jqXHR, textStatus, errorThrown) {
                            },
                        });
                   }
            });
            // $("#salle").trigger("change"); 
        })
    </script>
</div>

<!-- /section:basics/sidebar -->