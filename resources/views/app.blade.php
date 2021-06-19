<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
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
        function createRDVModal(debut, fin, pid = 0, fixe=1)
        { 
          var debut = moment(debut).format('YYYY-MM-DD HH:mm'); 
          var fin = moment(fin).format('YYYY-MM-DD HH:mm');  
          if(pid != 0)
          {
            if('{{ Auth::user()->role_id }}' == 1)
            {
              var formData = { id_patient:pid,Debut_RDV:debut, Fin_RDV:fin, fixe:fixe  };
              $.ajaxSetup({
                   headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
              }); 
              $.ajax({
                    type : 'POST',
                    url : '/createRDV',
                    data:formData,  //dataType: 'json',
                    success:function(data){         
                        var color = (data['rdv']['fixe'] != 1)? '#87CEFA':'#378006';
                        var event = new Object();
                        event = {
                                title: data['patient']['Nom'] + "  " + data['patient']['Prenom']+" ,("+data['age']+" ans)",
                                start: debut,
                                end: fin,
                                id : data['rdv']['id'],
                                idPatient:data['patient']['id'],
                                fixe: data['rdv']['fixe'],
                                tel:data['patient']['tele_mobile1'] ,
                                age:data['age'],         
                                allDay: false,   //color:color, //'#87CEFA'
                        };
                         $('.calendar1').fullCalendar( 'renderEvent', event );//, true
                    },
                    error: function (data) {
                          console.log('Error:', data);
                    }
              });
            }else{
                    $('#Debut_RDV').val(debut);
                    $('#Fin_RDV').val(fin);
                    $('#fixe').val(fixe);
                    $('#addRDVModal').modal({
                           show: 'true'
                    }); 
            }
          }else{
                $('#Debut_RDV').val(debut);
                $('#Fin_RDV').val(fin);
                $(".es-list").empty(); 
                $('#fixe').val(fixe);
                $('#addRDVModal').modal({
                      show: 'true'
                }); 
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
          if ( $("#gs option:selected").val() === "" ){
                $(gsf).attr("disabled", false);
                $("#rhf" ).attr("disabled", false);
          }
          else{
              $("#gsf").val($("#gs option:selected").val());
              $("#rhf").val($("#rh option:selected").val());
              $(gsf).attr("disabled", true);
              $("#rhf" ).attr("disabled", true);     
          }
          $('.Asdemograph').find('*').each(function () {
            $(this).attr("disabled", true); 
          });
          addRequiredAttr();
      }
      function copyPatientInfo(idP)
      {
        if($("#type").val() =="0")
          copyPatient();
        else
          if(idP == null)
            emptyPatient();
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
        $('.Asdemograph').find('*').each(function () {
          $(this).attr("disabled", false); 
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
              $('.filter').change(function() {
                      if (this.value.trim()) { 
                             field = $(this).prop("id"); 
                      }
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
        $("select.rhesus").change(function(){ //var rhval = $(this).children("option:selected").val();
            if($(this).children("option:selected").val() =="")
            { /*if($(this).attr('name') == "rh"){if($("#type").val() =="0")$("select#rhf").val($("#rh option:selected").val());}else{if($("#type").val() =="0")$("select#rh").val($("#rh option:selected").val());}*/
              if($(this).attr('name') === "rh")
                $("select#gs").val(''); 
              else
                 $("select#gsf").val('');             
            }
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
        @elseif(Auth::user()->role_id == 9)
            @include('partials.sidebar_agent_admis')
        @elseif(Auth::user()->role_id == 10)
            @include('partials.sidebar_pharm')
        @elseif(Auth::user()->role_id == 13)
            @include('partials.sidebar_chef_ser') 
        @elseif(Auth::user()->role_id == 3)
            @include('partials.sidebar_inf')
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
                </div>
                <!-- /page-content -->
            </div>
            <!-- /main-content-inner -->
        </div><!-- /main-content -->
        <div>
            {{-- @include('partials.footer') --}}
        </div>
    </div><!-- /main-container -->
</body>
</html>
