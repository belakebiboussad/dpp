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
            <i class="menu-icon fa fa-users"></i><span class="menu-text"> Patients </span>
            <b class="arrow fa fa-angle-down"></b>
          </a>
          <b class="arrow"></b>
          <ul class="submenu">
            <li class="">
              <a href="{{ route('patient.create') }}"><i class="menu-icon fa fa-plus purple"></i>  Ajouter Patient</a>
              <b class="arrow"></b>
            </li>
            <li class="">
              <a href="{{ route('patient.index') }}"><i class="menu-icon fa fa-eye pink"></i>  Liste Patients</a>
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
                    <a href="/createConsultation">
                        <i class="menu-icon fa fa-plus purple"></i>Ajouter Consultation   
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{ route('consultations.index')}}">
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
                <i class="menu-icon fa fa-plus purple"></i>Ajouter Hospitalisation
              </a>
              <b class="arrow"></b>
            </li>
            <li class="">
              <a href="{{ route('hospitalisation.index') }}"  data-toggle="tooltip" data-placement="top" title=" Liste d'hospitalisation du service">
                <i class="menu-icon fa fa-eye pink"></i> Liste Hospitalisations
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
                        <i class="menu-icon fa fa-eye pink"></i>Liste RDVs
                    </a>
                    <b class="arrow"></b>
                </li>
                 <li class="">
                    <a href="">
                        <i class="menu-icon fa fa-eye pink"></i>Planning
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
        @if( Auth::user()->role_id == 14)
        <li class="">
          <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-h-square"></i><span class="menu-text">Produits</span>
            <b class="arrow fa fa-angle-down"></b>
          </a>
        <b class="arrow"></b>
        <ul class="submenu">
          <li class="">
            <a href="{{ route('demandeproduit.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter Demande</a>
            <b class="arrow"></b>
          </li>
          <li class="">
            <a href="{{ route('demandeproduit.index') }}"><i class="menu-icon fa fa-eye pink"></i> Liste Demandes</a>
            <b class="arrow"></b>
          </li>              
        </ul>
      </li>
        @endif

    </ul><!-- /.nav-list -->
    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
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
      function InverserUl()
      {
        var section = $("ul#menuPatient li:not(.active) a").prop('href').split("#")[1];
        if(section == "Assure")
        {
            var liNonActive =$("ul#menuPatient li:not(.active)"); //var section = $("ul#menuPatient li:not(.active) a").prop('href').split("#")[i]; 
           
            var sectionActive = $("ul#menuPatient li.active a").prop('href').split("#")[1];
            $('ul#menuPatient li.active').removeClass('active');
            liNonActive.addClass('in active');
            $('div#' + section).addClass('in active');
            $('div#' + sectionActive).removeClass('active');
         }
      }
      /*
      function checkPatientavecRadio()
      {var erreur =true; var nom = $('#nom').val(); var prenom = $('#prenom').val();var idlieunaissance = $('#idlieunaissance').val();
        var datenaissance = $('#datenaissance').val();  var mobile1 = $('#mobile1').val(); 
        var inputAssVal = new Array(mobile1,idlieunaissance,datenaissance,prenom,nom);
        var inputMessage = new Array("Téléphone mobile 1","Lieu de Naissance","Date de Naissance","Prenom","Nom");
        if($("input[type=radio][name='type']:checked").val() == "Ayant_droit")
        {inputAssVal.unshift($("#Type_p").val()); inputMessage.unshift("Type"); }
         $('.error').each(function(i, obj) { $(obj).next().remove();$(obj).detach();});
        jQuery.each( inputAssVal, function( i, val ) {
        if(val =="" ){erreur =false; $('#error').after('<span class="error"> SVP, Veuiller remplir le(la) ' + inputMessage[i]+' du Patient </span>'+'<br/>');
        }});return erreur;
      }
      */
      function checkPatient()
      {
        var erreur =true;
        var nom = $('#nom').val(); var prenom = $('#prenom').val();
        var idlieunaissance = $('#idlieunaissance').val();
        var datenaissance = $('#datenaissance').val();//var mobile1 = $('#mobile1').val();mobile1,"Téléphone mobile 1",  
        var type = $('#type').val();
        var inputAssVal = new Array(idlieunaissance,datenaissance,prenom,nom);
        var inputMessage = new Array('Type',"Lieu de Naissance","Date de Naissance","Prenom","Nom");
        $('.error').each(function(i, obj) {
          $(obj).next().remove();
          $(obj).detach();
        });
        jQuery.each( inputAssVal, function( i, val ) {
          if(val =="" )
          {
            erreur =false;
            $('#error').after('<span class="error"> SVP, Veuiller remplir le(la) ' + inputMessage[i]+' du Patient </span>'+'<br/>');
          }
       });
       return erreur;
      }
      function checkAssure()
      {
        var erreur =true;
        var nomf = $('#nomf').val(); var prenomf = $('#prenomf').val();  var datenaissance = $('#datenaissancef').val(); 
        var idlieunaissancef = $('#idlieunaissancef').val();var NMGSN = $('#NMGSN').val();var nss = $('#nss').val(); 
        
        var inputAssVal = new Array(nss,NMGSN,gsf,idlieunaissancef,datenaissance,prenomf,nomf);
        var inputMessage = new Array("Numèro de Secruté Social","Matricule(NMGSN)","Groupe Sanguin","Lieu de Naissance","Date de Naissance","Prenom","Nom");
        $('.error').each(function(i, obj) {$(obj).next().remove(); $(obj).detach();  });
        jQuery.each( inputAssVal, function( i, val ) {
          if(val =="" )
          {
                 erreur =false;
                 $('#error').after('<span class="error"> SVP, Veuiller remplir le(la) ' + inputMessage[i]+' du l\'Assure </span>'+'<br/>');
          }
       });
       return erreur;
      }
      function  checkHomme(){
          var erreur =true;
          var nomA = $('#nomA').val();var prenomA = $('#prenomA').val();
          var type_piece_id = $('#type_piece_id').val();var npiece_id = $('#npiece_id').val();mobileA = $('#mobileA').val();
          var inputHomVal = new Array(npiece_id,mobileA,type_piece_id,prenomA,nomA);
          var inputHomMessage = new Array("Numero de la Pièce","Type de la Pièce","Telephone mobile","Prenom","Nom");
          $('.error').each(function(i, obj) {
                $(obj).next().remove();
                $(obj).detach();
         });
          jQuery.each( inputHomVal, function( i, val ) {
               if(val =="" )
              {
                     erreur =false;
                    $('#error').after('<span class="error"> SVP, Veuiller remplir le(la) ' + inputHomMessage[i]+' du Correspondant</span>'+'<br/>');
               }
          });   
         return erreur;
      }
      function checkConsult()
      {
        var erreur =true;
        var motif = $('#motif').val();  var resume = $('#resume').val();
        var inputAssVal = new Array(resume,motif);
        var inputMessage = new Array("Résume","Motif");
        if($('#' + 'isOriented').is(":checked"))
        {
          inputAssVal.unshift($("#lettreorientaioncontent").val());
          inputMessage.unshift("Résume de la lettre d'orientation");
          
        }
        $('.error').each(function(i, obj) {
          $(obj).next().remove();
          $(obj).detach();
       });
        jQuery.each( inputAssVal, function( i, val ) {
          if(val =="" )
          {
            erreur =false;
            $('#error').after('<span class="error"> SVP, Veuiller remplir le(la) ' + inputMessage[i]+' de la Consultation </span>'+'<br/>');
          }
       });
       return erreur;
      }
      function activaTab(tab){
        $('.nav-pills a[href="#' + tab + '"]').tab('show');
      }
      function copyPatient(){ 
              $("#nomf").val($("#nom").val()); $("#prenomf").val($("#prenom").val());
              $("#datenaissancef").val($("#datenaissance").val());$("#lieunaissancef").val($("#lieunaissance").val()); 
              $("#idlieunaissancef").val($("#idlieunaissance").val());$("input[name=sexef][value=" + $('input[name=sexe]:radio:checked').val() + "]").prop('checked', true);
              $( "#gsf" ).val($( "#gs" ).val());$( "#rhf" ).val($( "#rh" ).val());$('#adressef').val($('#adresse').val());
              $('#communef').val($('#commune').val());$('#idcommunef').val($('#idcommune').val());$('#idwilayaf').val( $('#idwilaya').val()); $('#wilayaf').val($('#wilaya').val());
              //$("#foncform").addClass('hide');  // $('#Type_p').attr('required', false);  //$('#nsspatient').attr('disabled', true);
              $('.Asdemograph').find('*').each(function () { $(this).attr("disabled", true); });
              addRequiredAttr();
       }
      if ($("#addGardeMalade").length > 0) {
        $("#addGardeMalade").validate({
            rules: {
                mobile_h: { required: true,  digits:true,  minlength: 10,  maxlength:10 }   
          },
          messages: {
            mobile_h: {
                required: "Please enter contact number",
                minlength: "The contact number should be 10 digits",
                digits: "Please enter only numbers",
                maxlength: "The contact number should be 12 digits",
            }
          }
        });
      }
      function showConsult(consultId)
      {
        url= '{{ route ("consultdetailsXHR", ":slug") }}',
        url = url.replace(':slug',consultId);
         $.ajax({
            type : 'GET',
            url:url,
            success:function(data,status, xhr){
              $('#consultDetail').html(data.html);
            },
            error:function (data){
              console.log('Error:', data);
            }
         });             
      }
      function HommeConfcopy(id)
      {
        $.get('/hommeConfiance/'+id+'/edit', function (data) {
          $('#patientId').val(data.id_patient);
          $('#type option').each(function() {
          if($(this).val() == data.type) 
              $(this).prop("selected", true);
          });  
          $('#hom_id').val(data.id);  $('#nom_h').val(data.nom);$('#prenom_h').val(data.prenom);
          $('#datenaissance_h').val(data.date_naiss);  $('#lien_par').val(data.lien_par).change();    
          $('#lien_par option').each(function() {
            if($(this).val() == data.lien_par) 
              $(this).prop("selected", true);
          });       
          $('#' + data.type_piece).prop('checked',true); $('#num_piece').val(data.num_piece);
          $('#date_piece_id').val(data.date_deliv);
          $('#adresse_h').val(data.adresse);$('#mobile_h').val(data.mob);
          jQuery('#gardeMalade').modal('show');
        });
      }
      $(document).ready(function () {
        $('input[type=radio][name=sexe]').change(function(){
          if($(this).val() == "M")
          {
            $('#Div-nomjeuneFille').attr('hidden','');
            $('#nom_jeune_fille').val('');
          }
          else
          {
            var civilite= $("select.civilite option").filter(":selected").val();
            if((civilite =="marie")|| (civilite =="veuf"))
              $('#Div-nomjeuneFille').removeAttr('hidden');
          }
        });
        $( ".civilite" ).change(function() {
          var sex =  $('input[name=sexe]:checked').val();
          if(sex == "F")
          {
            var civilite= $("select.civilite option").filter(":selected").val();
            if((civilite =="marie")|| (civilite =="veuf"))
                $('#Div-nomjeuneFille').removeAttr('hidden');
              else
                $('#Div-nomjeuneFille').attr('hidden','');  
          }else
            $('#Div-nomjeuneFille').attr('hidden','');      
        });
       $( "#etatf" ).change(function() {
             if($(this).val() != "Activite" && ($(this).val() != "Activite"))
             {
                   $('#serviceFonc').addClass('invisible');
                   $('#service option:eq(0)').prop('selected', true);
             }
            else
                    $('#serviceFonc').removeClass('invisible');   
      });
       if($( "#etatf" ).val() != "Activite"  )
           $('#serviceFonc').addClass('invisible');
      $('#listeGardes').DataTable({ //homme/garde  
          colReorder: true,
          stateSave: true,
          searching:false,
          'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['nosort']
          }],
          "language": {
                      "url": '/localisation/fr_FR.json'
          },
      });
      jQuery('body').on('click', '.show-modal', function () {
        HommeConfcopy($(this).val());
        jQuery('#EnregistrerGardeMalade').hide();
        $('#addGardeMalade *').prop('disabled', true);
      });
      jQuery('body').on('click', '.open-modal', function () {
        HommeConfcopy($(this).val());
        jQuery('#EnregistrerGardeMalade').val("update");
        if($('#EnregistrerGardeMalade').is(":hidden"))
            jQuery('#EnregistrerGardeMalade').show();
      });
      $("#EnregistrerGardeMalade").click(function (e) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
        });
        e.preventDefault();
        var formData = {
            id_patient:$('#patientId').val(),
            nom:$('#nom_h').val(),
            prenom : $('#prenom_h').val(),
            date_naiss : $('#datenaissance_h').val(),
            type:$('#type').val(),
            lien_par : $('#lien_par').val(),
            type_piece : $("input[name='type_piece']:checked").val(),
            num_piece : $('#num_piece').val(),
            date_deliv : $('#date_piece_id').val(),
            adresse : $('#adresse_h').val(),
            mob : $('#mobile_h').val(),
            created_by: $('#userId').val()
        };
        var state = jQuery('#EnregistrerGardeMalade').val();
        var type = "POST";var hom_id = jQuery('#hom_id').val();var ajaxurl = 'hommeConfiance';
        if (state == "update") {
          type = "PUT"; ajaxurl = '/hommeConfiance/' + hom_id;
        }
        if (state == "add") {
          ajaxurl ="{{ route('hommeConfiance.store') }}";
        }
        $('#hom_id').val("");$('#nom_h').val("");$('#prenom_h').val("");$('#datenaissance_h').val("");$('#num_piece').val("");  $('#date_piece_id').val("");
        $('#adresse_h').val("");$('#mobile_h').val("");
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('#gardeMalade').hide();
                jQuery('#gardeMalade').modal('hide');
                if($('.dataTables_empty').length > 0)
                {
                  $('.dataTables_empty').remove();
                }
                var homme = '<tr id="garde' + data.id + '"><td class="hidden">' + data.id_patient + '</td><td>' + data.nom + '</td><td>' + data.prenom + '</td><td>'+ data.date_naiss +'</td><td>' + data.adresse + '</td><td>'+ data.mob + '</td><td>' + data.lien_par + '</td><td>' + data.type_piece + '</td><td>' + data.num_piece + '</td><td>' +  data.date_deliv + '</td>';
                homme += '<td class ="center"><button type="button" class="btn btn-xs btn-success show-modal" value="' + data.id + '"><i class="ace-icon fa fa-hand-o-up fa-xs"></i></button>&nbsp;'; 
                homme += '<button type="button" class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
                homme += '<button type="button" class="btn btn-xs btn-danger delete-garde" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
                if (state == "add") {
                  $("#listeGardes tbody").append(homme);
                } else {
                  $("#garde" + hom_id).replaceWith(homme);      
                }
                
            },
            error: function (data) {
              console.log('Error:', data);
            }
        }); 
      }) ////----- DELETE a Garde and remove from the page -----////
      jQuery('body').on('click', '.delete-garde', function () {
            var hom_id = $(this).val();
            $.ajaxSetup({
              headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                  }
            });
            $.ajax({
                  type: "DELETE",
                  url: '/hommeConfiance/' + hom_id,
                  success: function (data) {
                      $("#garde" + hom_id).remove();
                  },
                  error: function (data) {
                         console.log('Error:', data);
                  }
            });
      });
      $('#gardeMalade').on('hidden.bs.modal', function () {
        $('#gardeMalade form')[0].reset();
        $('#addGardeMalade *').prop('disabled', false);
      });
    }) 
    </script>
</div><!-- /section:basics/sidebar -->