<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <title>@yield('title','Dossier patient')</title>
  @include('partials.htmlheader')
  @yield('style')
</head>
<body class="no-skin">
      @include('partials.navbar')
      @include('partials.scripts')
      @include('flashy::message')
      <div class="main-container" id="main-container">
      <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        function HommeConfcopy(id)
        {
          $.get('/hommeConfiance/'+id+'/edit', function (data) {
            $('#patientId').val(data.id_patient);
            $('#typeH option').each(function() {
              if($(this).val() == data.type) 
                $(this).prop("selected", true);
            });  
            $('#hom_id').val(data.id);  $('#nom_h').val(data.nom);$('#prenom_h').val(data.prenom);
            $('#datenaissance_h').val(data.date_naiss);  $('#lien_par').val(data.lien_par).change();    
            $('#lien_par option').each(function() {
              if($(this).val() == data.lien_par) 
                $(this).prop("selected", true);
            });
            switch(data.type_piece)
            {
              case "0":
                $('#CNI').prop('checked',true);
                break;
              case "1":
                $('#Permis').prop('checked',true);
                break;
              case "2":
                $('#Passeport').prop('checked',true);
                break;
              default:
                break;
            }
            $('#num_piece').val(data.num_piece);
            $('#date_piece_id').val(data.date_deliv);
            $('#adresse_h').val(data.adresse);
            $('#mobile_h').val(data.mob);
            jQuery('#gardeMalade').modal('show');
          });
        }
        $(function(){
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
            $('#btn-addCores').click(function () { 
                if( $('#EnregistrerGardeMalade').is(":hidden"))
                  $('#EnregistrerGardeMalade').show();
                $('#EnregistrerGardeMalade').val("add"); $('#addGardeMalade').trigger("reset");
                $('#CoresCrudModal').html("Ajouter un Correspondant(e)"); $('#gardeMalade').modal('show');   
            });  
            jQuery('body').on('click', '.show-modal', function () {
              HommeConfcopy($(this).val());
              jQuery('#EnregistrerGardeMalade').hide();
              $('#CoresCrudModal').html("Détails du Correspondant(e)");
              $('#addGardeMalade').find('input, textarea, select').attr('disabled','disabled');
            });
            jQuery('body').on('click', '.open-modal', function () {
              HommeConfcopy($(this).val());
              if( $('#EnregistrerGardeMalade').is(":hidden"))
                $('#EnregistrerGardeMalade').show();
              jQuery('#EnregistrerGardeMalade').val("update"); 
              $('#CoresCrudModal').html("Editer un Correspondant(e)");
               $('#gardeMalade').modal('toggle');
           });
           $("#EnregistrerGardeMalade").click(function (e) {
                $('#gardeMalade').modal('toggle');
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
                      type:$('#typeH').val(),
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
           $('#addGardeMalade').trigger("reset");
             $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function (data) { //$('#gardeMalade').hide();   //jQuery('#gardeMalade').modal('hide');
                      if($('.dataTables_empty').length > 0)
                      {
                        $('.dataTables_empty').remove();
                      }
                      switch(data.lien_par){
                        case "0":
                              lien='<span class="label label-sm label-success"><strong>Conjoint(e)</strong></span>';
                              break;
                         case "1":
                               lien='<span class="label label-sm label-success"><strong>Père</strong></span>';
                              break;
                         case "2":
                              lien='<span class="label label-sm label-success"><strong>Mère</strong></span>';
                              break;
                         case "3":
                              lien='<span class="label label-sm label-success"><strong>Frère</strong></span>';
                               break;
                         case "4":
                              lien='<span class="label label-sm label-success"><strong>Soeur</strong></span>';
                              break;
                        case "5":
                              lien='<span class="label label-sm label-success"><strong>Ascendant</strong></span>';
                              break;
                        case "6":
                              lien='<span class="label label-sm label-success"><strong>Grand-parent</strong></span>';
                              break; 
                        case "7":
                               lien='<span class="label label-sm label-success"><strong>Membre de famille</strong></span>';
                              break;
                        case "8":
                              lien=' <span class="label label-sm label-success"><strong>Ami</strong></span>';
                              break;              
                        case "9":
                              lien='<span class="label label-sm label-success"><strong>Collègue</strong></span>';
                              break; 
                        case "10":
                              lien='<span class="label label-sm label-success"><strong>Employeur</strong></span>';
                              break; 
                        case "11":
                              lien='span class="label label-sm label-success"><strong>Employé</strong></span>';
                              break; 
                        case "12":
                              lien='<span class="label label-sm label-success"><strong>Tuteur</strong></span>';
                              break; 
                       case "13":
                              lien='<span class="label label-sm label-success"><strong>Autre</strong></span>';
                              break; 
                       default:
                              break;
                    }
                    switch(data.type_piece)
                    {
                        case "0":
                               type='<span class="label label-sm label-success"><strong>Carte nationale d\'identité</strong></span>';
                              break;
                         case "1":
                              type='<span class="label label-sm label-success"><strong>Permis de Conduire</strong></span>';
                              break;
                         case "2":
                              type='<span class="label label-sm label-success"><strong>Passeport</strong></span>';
                              break;
                        default:
                              break;
                    }
                    var homme = '<tr id="garde' + data.id + '"><td class="hidden">' + data.id_patient + '</td><td>' + data.nom + '</td><td>' + data.prenom
                              + '</td><td>'+ data.date_naiss+'</td><td>' + data.adresse + '</td><td>'+ data.mob + '</td><td>' + lien + '</td><td>'
                               + type + '</td><td>' + data.num_piece + '</td><td>' +  data.date_deliv + '</td>';
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
           }) 
           jQuery('body').on('click', '.delete-garde', function () {////----- DELETE a Garde and remove from the page -----////
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
        function activaTab(tab){
          $('.nav-pills a[href="#' + tab + '"]').tab('show');
        }
        function createRDVModal(debut, fin, pid = 0, fixe=1)
        { 
            var debut = moment(debut).format('YYYY-MM-DD HH:mm'); 
            var fin = moment(fin).format('YYYY-MM-DD HH:mm');
            if(pid !== 0)
            {
              if('{{ in_array(Auth::user()->role->id,[1,13,14]) }}') 
              {
                var formData = { id_patient:pid,date:debut, fin:fin, fixe:fixe  };
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                  }
                }); 
                var url = "{{ route('rdv.store') }}"; 
                $.ajax({
                    type : 'POST',
                    url :url,
                    data:formData,//dataType: 'json',
                    success:function(data){         
                      var color = (data['rdv']['fixe'] > 0) ? '#87CEFA':'#378006';
                      $('.calendar').fullCalendar( 'renderEvent',  {
                              title: data['patient']['full_name']+" ,("+data['age']+" ans)",
                              start: debut,
                              end: fin,
                              id : data['rdv']['id'],
                              idPatient:data['patient']['id'],
                              fixe: data['rdv']['fixe'],
                              tel:data['patient']['tele_mobile1'] ,
                              age:data['age'],
                              specialite: data['rdv']['specialite_id'],
                              civ : data['patient']['civ'],
                              allDay: false,
                              color:color
                      } );//calendar1
                    },
                    error: function (data) {
                      console.log('Error:', data);
                    }
                });
              }else
              {
                showRdvModal(debut,fin,pid,fixe); 
              }
            }else
            {
              showRdvModal(debut,fin,0,fixe); 
            }
        }
        function copyPatient(){ 
          $("#nomf").val($("#nom").val());
          $("#prenomf").val($("#prenom").val());
          $("#datenaissancef").val($("#datenaissance").val());$("#lieunaissancef").val($("#lieunaissance").val()); 
          $("#idlieunaissancef").val($("#idlieunaissance").val());var sexe = $('input[name=sexe]:radio:checked').val();$('#sexef').val(sexe);
          $('#adressef').val($('#adresse').val());
          $('#communef').val($('#commune').val()); $('#idcommunef').val($('#idcommune').val());$('#idwilayaf').val( $('#idwilaya').val()); 
          $('#wilayaf').val($('#wilaya').val()); $('#SituationFamille').val($('#sf').val());
          $("#foncform").addClass('hidden'); 
          if ($("#gs option:selected").val() === ""){
            $(gsf).attr("disabled", false);
            $("#rhf" ).attr("disabled", false);
          }
          else{
            $("#gsf").val($("#gs option:selected").val());
            $("#rhf").val($("#rh option:selected").val());
            $(gsf).attr("disabled", true);
            $("#rhf" ).attr("disabled", true);     
          }
        }
        function emptyPatient(){ 
          $("#nomf").val("");$("#prenomf").val("");$("#datenaissancef").val("");$("#lieunaissancef").val("");$("#idlieunaissancef").val("");$('#adressef').val("");$('#communef').val("");
          $('#idcommunef').val("");$('#idwilayaf').val("");$('#wilayaf').val("");
          $("#gsf").val("");
          $("#rhf").val("");
          if($("#gsf").prop('disabled') == true)
            $('#gsf').attr("disabled", false);
          if($("#gsf").prop('disabled') == true)
            $("#rhf" ).attr("disabled", false);
          $('.asdemogData').attr('disabled', '');
        }
        function checkPatient()
        {
          var erreur =true;
          var nom = $('#nom').val();
          var prenom = $('#prenom').val();//var idlieunaissance = $('#idlieunaissance').val();var mobile1 = $('#mobile1').val();mobile1,"Téléphone mobile 1", //var datenaissance = $('#datenaissance').val();
          var type = $('#type').val();
          var inputAssVal = new Array(type,prenom,nom);
          var inputMessage = new Array('Type',"Prenom","Nom");
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
          var erreur =true;//var NMGSN = $('#NMGSN').val();var idlieunaissancef = $('#idlieunaissancef').val();"Lieu de Naissance",
          var nomf = $('#nomf').val();
          var prenomf = $('#prenomf').val();//var datenaissance = $('#datenaissancef').val(); 
          var gs = $('#gsf').val();
          var rh = $('#rhf').val();
          var nss = $('#nss').val();
          var position = $('#Position').val();//var inputAssVal = new Array(nss,gsf,idlieunaissancef,datenaissance,prenomf,nomf);
          var inputAssVal = new Array(nss,position,rh,gs,prenomf,nomf);//var inputMessage = new Array("Numèro de Secruté Social","Groupe Sanguin","Date de Naissance","Prenom","Nom");
          var inputMessage = new Array("Numèro de Secruté Social","position","Rhésus","Groupe Sanguin","Prenom","Nom");
          $('.error').each(function(i, obj) { $(obj).next().remove(); $(obj).detach();  });
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
            var type_piece_id = $('#type_piece_id').val();
            var npiece_id = $('#npiece_id').val();
            mobileA = $('#mobileA').val();
            var inputHomVal = new Array(npiece_id,type_piece_id,mobileA,prenomA,nomA);
            var inputHomMessage = new Array("Numero de la pièce","Type de la pièce","Téléphone mobile","Prenom","Nom");
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
        function getProducts(id_gamme, id_spec=0,med_id = 0)
        {
          var html = '<option value="">Sélectionner...</option>';
          $.ajax({
              url : '/getproduits/'+id_gamme+'/'+id_spec,
              type : 'GET',
              dataType : 'json',
              success : function(data){
                  $.each(data, function(){
                    html += "<option value='"+this.id+"'>"+this.nom+"</option>";
                  });
                  $('#produit').html(html);
                  if(med_id != 0)
                    $('#produit').val(med_id);
              },
              error : function(){
                  console.log('error');
              }
          });
        }
        $(function () {
          $( "#Position" ).change(function() {
                if($(this).val() != "Activité")
                {
                    $('#serviceFonc').addClass('invisible'); $('#service option:eq(0)').prop('selected', true);
                }
                else
                  $('#serviceFonc').removeClass('invisible');   
          });
        });
       $(function(){
         $('#gamme').change(function(){
              switch($(this).val())
              {
                case "0":
                  $('#specPrd').val(0);
                  $('#specPrd').prop('disabled', 'disabled');
                  $('#produit').val(0);
                  $('#produit').prop('disabled', 'disabled');
                  break
                case "1":
                  if($("#specialiteDiv").is(":hidden"))
                    $("#specialiteDiv").show();
                    $("#specPrd").removeAttr("disabled");
                    $("#produit").removeAttr("disabled");
                    break;
                case "2":
                    if(!$("#specialiteDiv").is(":hidden"))
                      $("#specialiteDiv").hide();
                      $("#produit").removeAttr("disabled");
                      getProducts(2);
                    break;
                case "3":
                  if(!$("#specialiteDiv").is(":hidden"))
                    $("#specialiteDiv").hide();
                    getProducts(3);
                    break;
                case "4":
                  $("#specialiteDiv").hide();
                  $("#produit").removeAttr("disabled");
                  getProducts(4);
                  break;
                default:
                  break; 
              }
          });
         $('#specPrd').change(function(){
             if($(this).val() != "0" )
             {
                $("#produit").removeAttr("disabled");
                var id_gamme = $('#gamme').val();
                var id_spec = $(this).val();
                getProducts(id_gamme,id_spec);
              }else
              {
                $("#produit").val(0);
                $("#produit").prop('disabled', 'disabled');
              }
          });
          $('#produit').change(function(){
             $("#ajoutercmd").removeAttr("disabled");
          });
       });
      $(document).ready(function(){
          $("select.groupeSanguin").change(function(){//var gs = $(this).children("option:selected").val();
            if($(this).children("option:selected").val() !=="")
            {
            if($(this).attr('name') === "gs")
            {
              $("#rh" ).attr("disabled", false);/*if($("#type").val() =="0")  $("#gsf").val($("#gs option:selected").val()); */ 
            }else
            {
              $("#rhf" ).attr("disabled", false);/*if($("#type").val() =="0") $("#gs").val($("#gsf option:selected").val());*/
            } 
          }else
          {
            if($(this).attr('name') === "gs")
            {
              $("#rh" ).attr("disabled", true);
              $("select#rh").val(''); 
            }
            else
            {
              $("#rhf" ).attr("disabled", true);
              $("select#rhf").val(''); 
            }
          }
        });
        $("select.rhesus").change(function(){
            if($(this).children("option:selected").val() =="")
               if($(this).attr('name') === "rh")
                $("select#gs").val(''); 
              else
                 $("select#gsf").val('');             
        });
        if($("#Position").val() != "Activité" )
          $('#serviceFonc').addClass('invisible');
        $(document).on('click', '.selctetat', function(event){
          event.preventDefault();
          var formData = {
            class_name: $('#className').val(),    
            obj_id: $('#objID').val(),
            selectDocm :$(this).val(),
          };
          $.ajax({
            type : 'get',
            url : '{{URL::to('reportprint')}}',
            data:formData,
              success(data){
              $('#EtatSortie').modal('hide');
            },
          });
       });
      }) 
     </script>
        @yield('page-script')
        @if( Auth::user()->role_id == 1)
            @include('partials.sidebar_med')
        @elseif( Auth::user()->role_id == 2)
            @include('partials.sidebar_rec')
        @elseif(Auth::user()->role_id == 4)
            @include('partials.sidebar')
        @elseif(Auth::user()->role_id == 5)
            @include('partials.sidebar_sur')    
        @elseif(Auth::user()->role_id == 6) 
            @include('partials.sidebar_dele')
         @elseif(Auth::user()->role_id == 8) 
            @include('partials.sidebar_dir')           
        @elseif(Auth::user()->role_id == 9)
            @include('partials.sidebar_agent_admis')
        @elseif(Auth::user()->role_id == 10)
            @include('partials.sidebar_pharm')
        @elseif(Auth::user()->role_id == 13)
            @include('partials.sidebar_chef_ser') 
        @elseif(Auth::user()->role_id == 3)
            @include('partials.sidebar_inf')
         @elseif(Auth::user()->role_id == 11)
            @include('partials.sidebar_laboanalyses')    
        @elseif(Auth::user()->role_id == 12)
            @include('partials.sidebar_radiologue')
        @elseif(Auth::user()->role_id == 14)
            @include('partials.sidebar_med')           
        @endif
        <div class="main-content">
            <div class="main-content-inner"> {{-- @include('partials.breadcrumbs') --}}
                <div class="page-content">
                  @include('flashy::message')
              	  @yield('main-content')
                </div><!-- /page-content -->
            </div><!-- /main-content-inner -->
        </div><!-- /main-content -->
        <div>{{-- @include('partials.footer') --}}
        </div>
    </div><!-- /main-container -->
</body>
</html>
