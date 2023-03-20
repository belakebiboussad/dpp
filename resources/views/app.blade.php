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
        function activaTab(tab){
          $('.nav-pills a[href="#' + tab + '"]').tab('show');
        }
        function createRDVModal(debut, fin, pid = 0, fixe=1)
        { 
            var debut = moment(debut).format('YYYY-MM-DD HH:mm'); 
            var fin = moment(fin).format('YYYY-MM-DD HH:mm');
            if(pid !== 0)
            {
              if('{{ in_array(Auth::user()->role_id,[1,13,14]) }}')
              {
                var formData = { _token: CSRF_TOKEN, pid:pid, date:debut, fin:fin, fixe:fixe  };
                var url = "{{ route('rdv.store') }}"; 
                $.ajax({
                    type : 'POST',
                    url :url,
                    data:formData,
                    success:function(data){         
                      var color = (data['rdv']['fixe'] > 0) ? '#3A87AD':'#D6487E';
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
                      });//calendar1
                    },
                    error: function (data) {
                      console.log('Error:', data);
                    }
                });
              }else
                showRdvModal(debut,fin,pid,fixe); 
            }else
              showRdvModal(debut,fin,0,fixe); 
        }
        function copyPatient(){ 
/*$("#nomf").val($("#nom").val()); $("#prenomf").val($("#prenom").val());         
$("#datenaissancef").val($("#datenaissance").val());$("#lieunaissancef").val($("#lieunaissance").val());
$("#idlieunaissancef").val($("#idlieunaissance").val());var sexe = $('input[name=sexe]:radio:checked').val();$('#sexef').val(sexe);$('#adressef').val($('#adresse').val());
$('#communef').val($('#commune').val()); $('#idcommunef').val($('#idcommune').val());
$('#idwilayaf').val( $('#idwilaya').val());$('#wilayaf').val($('#wilaya').val()); $('#SituationFamille').val($('#sf').val()); $("#foncform").addClass('hidden');$("#gsf").val($("#gs option:selected").val());$("#rhf").val($("#rh option:selected").val());*/
          $("#asdemogData").addClass('hidden');
          $("#foncform").addClass('hidden');
        }
        function checkPatient()
        {
          var erreur =true;
          var nom = $('#nom').val();
          var prenom = $('#prenom').val();
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
        function checkAssureOrg()
        {
          var erreur =true;
          var nss = $('#nss').val();
          var prenomf = $('#prenomf').val();
          var nomf = $('#nomf').val();
          inputAssVal = new Array(nss,prenomf,nomf);
          inputMessage.push("Numèro de Secruté Social", "Prénom","Nom");
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
        function checkAssure()
        {
          var erreur =true;
          var nss = $('#nss').val();
          var inputAssVal = new Array(nss);
          var inputMessage = new Array("Numèro de Secruté Social");
          if($("#type").val() != 0)
          {
            var prenomf = $('#prenomf').val();
            var nomf = $('#nomf').val();
            inputAssVal.push(prenomf,nomf);
            inputMessage.push("Prenom","Nom");
          }
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
          var html = '<option value="" selected disabled>Sélectionner...</option>';
          $.ajax({
              url : '/getproduits/'+id_gamme+'/'+id_spec,
              type : 'GET',
              dataType : 'json',
              success : function(data){
                  $.each(data, function(){
                    html += "<option value='"+this.id+"'>"+this.nom+"</option>";
                  });
                  $('#med_id').html(html);
                  if(med_id != 0)
                    $('#med_id').val(med_id);
              }
          });
        }
        function addDays()
        {
          var datefin = new Date($('.date').val());
          datefin.setDate(datefin.getDate() + parseInt($('.numberDays').val(), 10));
          $(".date_end").val(moment(datefin).format("YYYY-MM-DD"));        
        }
        function updateDureePrevue()//a fusionner updateDureePrevue
        { 
          var iDaysDelta = 0;
          var dEntree = $('.date').datepicker('getDate');
          var dSortie = $('.date_end').datepicker('getDate');
          if (dEntree && dSortie && (dSortie >= dEntree)) 
          {
            iDaysDelta = Math.floor((dSortie.getTime() - dEntree.getTime()) / 86400000);
            if(iDaysDelta < 0)            
              $(".date_end").datepicker("setDate", dEntree); 
          }else
            $(".date_end").datepicker("setDate", $('.date').datepicker('getDate'));
          $('.numberDays').val(iDaysDelta ); 
        }
       $(function(){
         $('#gamme').change(function(){
            switch($(this).val())
            {
              case "1":
                if($("#specialiteDiv").is(":hidden"))
                  $("#specialiteDiv").show();
                  break;
              case "2":
                  if(!$("#specialiteDiv").is(":hidden"))
                    $("#specialiteDiv").hide();
                    if($("#med_id").prop('disabled') == true)
                      $("#med_id").prop('disabled',false);
                    getProducts(2);
                  break;
              case "3":
                if(!$("#specialiteDiv").is(":hidden"))
                  $("#specialiteDiv").hide();
                  getProducts(3);
                  break;
              case "4":
                $("#specialiteDiv").hide();
                if($("#med_id").prop('disabled') == true)
                      $("#med_id").prop('disabled',false);
                getProducts(4);
                break;
              default:
                break; 
            }
          });
         $('#specPrd').change(function(){
            getProducts($('#gamme').val(),$(this).val());
          });
          $('#med_id').change(function(){
             $("#ajoutercmd").removeAttr("disabled");
          });
       });
      $(document).ready(function(){
          $("select.groupeSanguin").change(function(){//var gs = 
          if($(this).children("option:selected").val() !=="")
          {
           if($(this).attr('name') === "gs")
                  $("#rh" ).attr("disabled", false);
            else
            $("#rhf" ).attr("disabled", false);  
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
        });/* with button*/    
       $(document).on('click', '.selctetat', function(event){
        var data = '';
        $.ajax({
            type: 'GET',
            url: '/pdf/generate',
            data: data,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response){
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Sample.pdf";
                link.click();
            },
            error: function(blob){
                console.log(blob);
            }
        });
        });
/*$(document).on('click', '.selctetat', function(event){event.preventDefault();var formData = {        class_name: $('#className').val(), obj_id: $('#objID').val(),selectDocm :$(this).val(),};
$.ajax({type : 'get',url : '{{URL::to('reportprint')}}',data:formData,success(data){$('#EtatSortie').modal('hide');},});});*/
      }) 
     </script>
        @yield('page-script')
        @if( Auth::user()->role_id == 1)
               @include('partials.sidebar_med')
        @elseif(in_array( Auth::user()->role_id,[2,15]))
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
            @include('partials.sidebar_med')<!-- sidebar_chef_ser -->
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
            <div class="main-content-inner">{{-- @include('partials.breadcrumbs') --}}
                <div class="page-content">
                  @include('flashy::message')
              	  @yield('main-content')
                </div>
            </div>
        </div><!-- /main-content -->
        <div>{{-- @include('partials.footer') --}}
        </div>
    </div><!-- /main-container -->
</body>
</html>
