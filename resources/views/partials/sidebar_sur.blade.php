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
            <i class="menu-icon fa fa-university"></i><span class="menu-text">Accueil</span>
        </a><b class="arrow"></b>
      </li>
      <li>
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-h-square"></i>
          <span class="menu-text">Hospitalisation</span><b class="arrow fa fa-angle-down"></b>
        </a><b class="arrow"></b>
        <ul class="submenu">
          <li>     
            <a href="{{ route('hospitalisation.index') }}"><i class="menu-icon fa fa-caret-right"></i>Hospitalisations</a>
            <b class="arrow"></b>
          </li>
        </ul>
      </li>
      <li>
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-calendar"></i><span class="menu-text">Rendez-Vous</span>
          <b class="arrow fa fa-angle-down"></b></a><b class="arrow"></b>
        <ul class="submenu">
          <li>
            <a href="{{ route('rdvHospi.index') }}" title="ajouter un Rendez-Vous">
              <i class="menu-icon fa fa-plus"></i>Ajouter un rendez-vous</a><b class="arrow"></b>
          </li>
          <li><a href="/listeRDVs"><i class="menu-icon fa fa-clock-o"></i>Rendez-Vous</a><b class="arrow"></b></li>
        </ul>
      </li>
      <li>
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-bed" aria-hidden="true"></i>
          <span class="menu-text">Réservations des lits</span><b class="arrow fa fa-angle-down"></b>
        </a>
        <ul class="submenu">
          <li>
            <a href="{{ route('reservation.create') }}" title="Reserver  un lit">
              <i class="menu-icon fa fa-plus"></i>Ajouter  une réservation</a><b class="arrow"></b>
          </li>
          <li><a href="{{ route('reservation.index') }}"><i class="menu-icon fa fa-caret-right"></i>Réservations</a><b class="arrow"></b></li>
        </ul>
      </li><!-- begin affectation -->
      <li>
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-bed" aria-hidden="true"></i>
          <span class="menu-text">Affectation des lits</span><b class="arrow fa fa-angle-down"></b>
        </a>
        <ul class="submenu">
          <li>
            <a href="{{ route('bedAffectation.create') }}" title="Reserver un lit">
              <i class="menu-icon fa fa-plus"></i>Ajouter  une Affectation</a><b class="arrow"></b>
          </li>
          <li><a href="{{ route('bedAffectation.index') }}"><i class="menu-icon fa fa-caret-right"></i>Affectations</a><b class="arrow"></b></li>
         </ul>
      </li><!-- end affectation -->
    </ul><!-- /.nav-list -->
    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
      <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
      try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
      $(function(){
        $(".filelink" ).click( function( e ) {
            e.preventDefault();  
        });
        $(".serviceHosp").change(function(){
          if($(this ).val() != "")
          {
            var attr = $('.salle').attr('disabled');
            if($(".salle").prop('disabled') == true)
              $(".salle" ).attr("disabled", false);/*  $('.lit_id option[value=""]').prop('selected', true);  $('.lit_id').attr('disabled', 'disabled');         */
            var formData = { 
                ServiceID: $(this).val(), 
                Affect :$('.affect').val(),
                demande_id: $('.demande_id').val(),
            };
            if($('.affect').val() == '0')
            {
              formData.StartDate =$('#dateEntree').val();
              formData.EndDate = $("#dateSortiePre").val();
            }
            $.ajax({
              url : '/getsalles',
              type:'GET',
              data:formData,
              success: function(data, textStatus, jqXHR){
                var select = $('.salle').empty();
                if(data.length != 0){
                      select.append('<option value="">Selectionnez une salle</option>');   
                      $.each(data,function(){
                        select.append('<option value="'+this.id+'">'+this.nom+'</option>');
                     });
                }else
                  select.append('<option value="" selected disabled>Pas de salle</option>');
              },
              
            });   
          }else
          {
            $(".salle").prop("selectedIndex", 0);
            $(".salle").trigger("change");
            $(".salle" ).attr("disabled", true); 
          }               
        });
        $(".salle").change(function(){
          if($(this ).val() != "")
          { 
            var attr = $('.lit_id').attr('disabled');/*if(typeof attr == typeof undefined && attr == false)$('.lit_id').attr('disabled', 'disabled'); */
            $('.lit_id').removeAttr("disabled");
            var rdvId = typeof($('#id').val())  !== "undefined" ? $('#id').val(): null;  
            var formData = { 
              SalleId:  $(this).val(), 
              Affect :$('.affect').val(),
            };
            if($('.affect').val() == "0" || $('.affect').val() == "undefined")
            {
              formData.StartDate =$('#dateEntree').val();
              formData.EndDate = $("#dateSortiePre").val();
              formData.rdvId   = rdvId;
            } 
            $.ajax({
                   url : '/getNotResBeds',
                   type : 'GET',
                    data:formData,
                    success: function(data, textStatus, jqXHR){                  
                      /*$.each(data[0], function(key, value){ alert(key + ":" + value); })*/
                      var selectLit = $('.lit_id').empty();                      
                      if(data.length != 0){
                        selectLit.append("<option value=''>Selectionnez un lit</option>");
                        $.each(data,function(){
                          selectLit.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                        });
                        $('#AffectSave').removeAttr("disabled");
                      }else
                        selectLit.append('<option value="" selected disabled>Pas de Lit libre</option>');
                    },
             });    
          }else
          {
            $(".lit_id").prop("selectedIndex", 0);
            $(".lit_id" ).attr("disabled", true); 
          }
        });
        $(".lit_id").change(function(){
            if($(".btn-submit").prop('disabled') == true)
              $('.btn-submit').removeAttr("disabled");
        });
      })
    </script>
</div>