<div id="sidebar" class="sidebar responsive">
  <script type="text/javascript">
    try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
  </script>
  <div class="sidebar-shortcuts" id="sidebar-shortcuts">
    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
      <button class="btn btn-success"><i class="ace-icon fa fa-signal"></i></button>
      <button class="btn btn-info"><i class="ace-icon fa fa-pencil"></i></button>
      <!-- #section:basics/sidebar.layout.shortcuts -->
      <button class="btn btn-warning"><i class="ace-icon fa fa-users"></i></button>
      <button class="btn btn-danger"><i class="ace-icon fa fa-cogs"></i></button>
<!-- /section:basics/sidebar.layout.shortcuts -->
    </div>
    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
      <span class="btn btn-success"></span><span class="btn btn-info"></span><span class="btn btn-warning"></span><span class="btn btn-danger"></span>
    </div>
    </div><!-- /.sidebar-shortcuts -->
    <li>
      <a href="home">
        <i class="menu-icon fa fa-picture-o"></i>
        <span class="menu-text">Gestion Patients</span>
      </a>
      <b class="arrow"></b>
    </li>
    <ul class="nav nav-list">
      <li class="">
        <a href="{{ route('rdvHospi.index') }}">
            <i class="menu-icon fa fa-university"></i>
            <span class="menu-text">Accueil</span>
        </a>
        <b class="arrow"></b>
      </li>
      <li>
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-h-square"></i>
          <span class="menu-text">Hospitalisation</span>
          <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li class="">     
            <a href="{{ route('hospitalisation.index') }}">
              <i class="menu-icon fa fa-caret-right"></i>Liste des hospitalisations
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
            <a href="{{ route('rdvHospi.index') }}" title="ajouter un Rendez-Vous">
              <i class="menu-icon fa fa-plus"></i>Ajouter un rendez-vous
            </a>
            <b class="arrow"></b>
          </li>
          <li><a href="/listeRDVs"><i class="menu-icon fa fa-clock-o"></i>Liste des rendez-vous</a><b class="arrow"></b></li>
        </ul>
      </li>
      <li class="">
        <a href="#" class="dropdown-toggle"> {{--  <i class="menu-icon fa fa-calendar"></i> --}}
             <i class="menu-icon fa fa-bed" aria-hidden="true"></i>
              <span class="menu-text">Gestion des lits</span>
             <b class="arrow fa fa-angle-down"></b>
        </a>
        <ul class="submenu">
          <li class="">
            <a href="{{ route('reservation.index') }}" title="Reserver  un lit">
              <i class="menu-icon fa fa-plus"></i>Reserver un lit
            </a>
            <b class="arrow"></b>
          </li>
          <li class="">
            <a href="/bedAffectation" title="Affecter in lit"> {{-- {{ route('litAffecter', 0) }} --}}
              <i class="menu-icon fa fa-plus"></i>Affecter un lit
            </a>
            <b class="arrow"></b>
          </li>
          {{-- <li class=""><a href="/404"><i class="menu-icon fa fa-clock-o"></i>Liste des lits</a><b class="arrow"></b></li> --}}
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
                          if( ! isEmpty($('#lit').val()))
                          {
                            $('#serviceh option[value=0]').prop('selected', true);
                            $("#serviceh").trigger("change"); 
                          }
               });
               $("#numberDays").on('click keyup', function() {
                      addDays();
                       if( ! isEmpty($('#lit').val()))
                       {
                               $('#serviceh option[value=0]').prop('selected', true);
                            $("#serviceh").trigger("change"); 
                       }
              });
              $(".serviceHosp").change(function(){
                if($(this ).val() != 0)
                {  
                      var attr = $('.salle').attr('disabled');
                      if (typeof attr !== typeof undefined && attr !== false) {
                        $('.salle').removeAttr("disabled");
                      }
                      $('.lit_id option[value=0]').prop('selected', true);
                      $('.lit_id').attr('disabled', 'disabled');
                      
                      var formData = { 
                          ServiceID: $(this).val(), 
                          Affect :$('.affect').val(),
                          demande_id: $('.demande_id').val(),
                      };
                     if($('.affect').val() == '0')
                      {
                            formData.StartDate =$('#dateEntree').val();
                            formData.EndDate = $("#dateSortiePre").val();//200-12-25
                      } 
                  $.ajax({
                        url : '/getsalles',
                        type:'GET',
                        data:formData, //dataType : 'json',
                        success: function(data, textStatus, jqXHR){
                              var select = $('.salle').empty();
                              if(data.length != 0){
                                      select.append("<option value='0'>Selectionnez une salle</option>");   
                                    $.each(data,function(){
                                          select.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                                   });
                              }else
                                    select.append('<option value="" selected disabled>Pas de salle</option>');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert("error")
                        }
                    });   
                }else
                {
                        $('.salle option[value=0]').prop('selected', true);
                        $(".salle").trigger("change"); 
                }                 
        });
        $(".salle").change(function(){
              if($(this ).val() != 0)
             {  
                      var attr = $('.lit_id').attr('disabled');
                     if (typeof attr == typeof undefined && attr == false)
                              $('.lit_id').attr('disabled', 'disabled');
                      $('.lit_id').removeAttr("disabled");
                      var rdvId = typeof($('#id').val())  !== "undefined" ? $('#id').val(): null;  
                      var formData = { 
                               SalleId:  $(this).val(), 
                              Affect :$('.affect').val(),
                     };
                     if($('.affect').val() == '0')
                     {
                            formData.StartDate =$('#dateEntree').val();
                            formData.EndDate = $("#dateSortiePre").val();
                            formData.rdvId   = rdvId;
                      } 
              $.ajax({
               url : '/getlits',
               type : 'GET', //dataType : 'json', 
                data:formData,
                success: function(data, textStatus, jqXHR){                  
                      var selectLit = $('.lit_id').empty();                      
                      if(data.length != 0){
                            selectLit.append("<option value=''>Selectionnez un lit</option>");
                            $.each(data,function(){
                                     selectLit.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                            });
                            $('#AffectSave').removeAttr("disabled");
                    }else
                    {
                      selectLit.append('<option value="" selected disabled>Pas de Lit libre</option>');
                    }      
                },
                error: function (jqXHR, textStatus, errorThrown) {
                },
            });    
          }
          else
               $('#lit_id option[value=0]').prop('selected', true);
        });
         $(".lit_id").change(function(){
                if($(".btn-submit").prop('disabled') == true)
                       $('.btn-submit').removeAttr("disabled");
         });
        jQuery('body').on('click', '.bedAffect', function (event) {
               $('.demande_id').val($(this).val());
              $('#patient_id').val($(this).attr('data-Pid'));
               jQuery('#bedAffectModal').modal('show');
               $('#bedAffectModal').on('hidden.bs.modal', function (e) {
                      $('#bedAffectModal form')[0].reset();
                });
        });
        jQuery('body').on('click', '#AffectSave', function (e) {
               e.preventDefault();
               var formData = {
                      demande_id : jQuery('.demande_id').val(),
                      lit_id     : $('#lit_id').val()
              };
               $.ajax({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url : '{{ route ("lit.affecter") }}',
                      type:'POST',
                      data:formData,//dataType: 'json',
                      success: function (data) {
                             $("#demande" + formData['demande_id']).remove();
                              jQuery('#bedAffectModal').trigger("reset");
                             jQuery('#bedAffectModal').modal('hide');
                      }
             });
        });
      })
    </script>
</div>
