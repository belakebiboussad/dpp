<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>
    <script type="text/javascript" src="{{ asset('js/app-med.js') }}"></script>
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
      <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
        <button class="btn btn-success"><i class="ace-icon fa fa-signal"></i></button>
        <button class="btn btn-info"><i class="ace-icon fa fa-pencil"></i></button>
        <button class="btn btn-warning"><i class="ace-icon fa fa-users"></i></button>
        <button class="btn btn-danger"><i class="ace-icon fa fa-cogs"></i></button>
      </div>
      <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
        <span class="btn btn-success"></span><span class="btn btn-info"></span><span class="btn btn-warning"></span>
        <span class="btn btn-danger"></span>
      </div>
    </div>
    <ul class="nav nav-list">
      <li>
        <a href="{{ route('patient.index') }}"><i class="menu-icon fa fa-tachometer"></i><span class="menu-text">Accueil</span></a>
        <b class="arrow"></b>
      </li>
      @if(in_array(Auth::user()->role->id,[13,14]))
      <li class="">
        <a href="{{ route('stat.index') }}"><i class="menu-icon fa fa-picture-o"></i><span class="menu-text">Tableau de bord</span></a><b class="arrow"></b>
      </li>
      @endif
      <li>
        <a href="#" class="dropdown-toggle">
          <i class="menu-icon fa fa-users"></i><span class="menu-text">Patients</span><b class="arrow fa fa-angle-down"></b>
        </a><b class="arrow"></b>
        <ul class="submenu">
          <li>
            <a href="{{ route('patient.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter un patient</a><b class="arrow"></b>
          </li>
          <li><a href="{{ route('patient.index') }}"><i class="menu-icon fa fa-eye pink"></i>Liste des patients</a><b class="arrow"></b></li>
        </ul>
      </li>
      <li>
        <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-users"></i><span class="menu-text"> Fonctionnaires</span><b class="arrow fa fa-angle-down"></b>
        </a><b class="arrow"></b>
        <ul class="submenu">
          <li><a href="{{ route('assur.index') }}"><i class="menu-icon fa fa-eye pink"></i> Liste des fonctionnaires</a><b class="arrow"></b>
          </li>
        </ul>
        </li>
        <li>
          <a href="#" class="dropdown-toggle">
             <i class="menu-icon fa fa-user-md"></i> <span class="menu-text"> Consultations </span><b class="arrow fa fa-angle-down"></b>
          </a><b class="arrow"></b>
          <ul class="submenu">
            </li>
            <li><a href="{{ route('consultations.index')}}"><i class="menu-icon fa fa-eye pink"></i> Liste des consultations</a><b class="arrow"></b>
            </li>
          </ul>
        </li>
        <li>
          <a href="#" class="dropdown-toggle"><i class="menu-icon fa fa-hospital-o"></i>
            <span class="menu-text" data-toggle="tooltip" data-placement="top" title="hospitalisations du service">Hospitalisations </span>
            <b class="arrow fa fa-angle-down"></b>
          </a><b class="arrow"></b>
          <ul class="submenu">
            <li>
              <a href="{{ route('hospitalisation.index') }}"  data-toggle="tooltip" data-placement="top" title=" Liste d'hospitalisation du service">
                <i class="menu-icon fa fa-eye pink"></i>Liste des hospitalisations
              </a><b class="arrow"></b>
            </li>
          </ul>
        </li>
        <li>
                <a href="#" class="dropdown-toggle">
                  <i class="menu-icon fa fa-table"></i><span class="menu-text">Rendez-Vous</span><b class="arrow fa fa-angle-down"></b>
                </a><b class="arrow"></b>
                <ul class="submenu">
                  <li>
                    <a href="{{ route('rdv.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter RDV</a> <b class="arrow"></b>
                  </li>
                  <li>
                    <a href="{{ route('rdv.index') }}"><i class="menu-icon fa fa-eye pink"></i>Liste RDVs</a><b class="arrow"></b>
                  </li>
                  <li>
                    <a href=""><i class="menu-icon fa fa-eye pink"></i>Planning</a><b class="arrow"></b>
                  </li>
                </ul>
          </li>
        <li>
                <a href="#" class="dropdown-toggle">
                     <i class="menu-icon fa fa-table"></i><span class="menu-text">Demandes Hospi</span><b class="arrow fa fa-angle-down"></b>
                </a><b class="arrow"></b>
                <ul class="submenu">
                     <li>
                            <a href="{{ route('demandehosp.index') }}"><i class="menu-icon fa fa-eye pink"></i>Liste des demandes</a> <b class="arrow"></b>
                     </li>
                </ul>
        </li>
        @if(Auth::user()->role_id == "10")
        <li class="">
          <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-stethoscope"></i><span class="menu-text">Produits de la pharmacie</span><b class="arrow fa fa-angle-down"></b>
          </a><b class="arrow"></b>
          <ul class="submenu">
            <li>
              <a href="{{ route('demandeproduit.create') }}"><i class="menu-icon fa fa-plus purple"></i>Demande produit</a>
              <b class="arrow"></b>
            </li>
          </ul>
        </li>
        @endif
        @if(Auth::user()->is(14))
        <li class="">
          <a href="#" class="dropdown-toggle">
            <i class="menu-icon fa fa-medkit" aria-hidden="true"></i><span class="menu-text">Produits</span>
            <b class="arrow fa fa-angle-down"></b>
          </a>
          <b class="arrow"></b>
          <ul class="submenu">
            <li class="">
              <a href="{{ route('demandeproduit.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter une demande</a><b class="arrow"></b>
            </li>
            <li>
              <a href="{{ route('demandeproduit.index') }}"><i class="menu-icon fa fa-eye pink"></i> Liste des demandes</a>
              <b class="arrow"></b>
          </li>              
        </ul>
        </li>
        @endif
        @if(in_array(Auth::user()->role->id,[13,14]))
        <li>
          <a href="{{ route('params.index')}}"><i class="menu-icon fa fa-cog"></i><span class="menu-text">Paramètres</span></a>
          <b class="arrow"></b>
        </li>
        @endif
    </ul><!-- /.nav-list -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
      <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
    @include('examenradio.scripts.cr')
    <script type="text/javascript">
      try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
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
      if ($("#addGardeMalade").length > 0) {  ////avoir
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
      function showHosp(hospId) //a voir ce lui den haut
      {
        url= '{{ route ("hospdetailsXHR", ":slug") }}',
        url = url.replace(':slug',hospId);
         $.ajax({
            type : 'GET',
            url:url,
            success:function(data,status, xhr){
              $('#hospDetail').html(data.html);
            },
            error:function (data){
              console.log('Error:', data);
            }
         });             
      }
    function addCIMCode(code,field)
    {
      $("#"+field).val(code);
      $('#liste_codesCIM').empty();  $("#chapitre").val($("#chapitre option:first").val());$("#schapitre").val($("#schapitre option:first").val());
      $('#cim10Modal').trigger("reset");$('#cim10Modal').modal('toggle');  
    }
    function examsBioSave(patientName, ipp, med,fieldName, fieldValue){
      var exams=[];
      $('.examsBio input.ace:checkbox:checked').each(function(index, value) {
        exams.push($(this).val());
      });
      var formData = {
        _token: CSRF_TOKEN,
        exams:JSON.stringify(exams),
      };  
      formData[fieldName] = fieldValue;
      var type = "POST";
      url ="{{ route('demandeexb.store') }}";
      $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
              examsBioprint(patientName, ipp, med);
            },
            error : function(data){
              console.log("data");
            }
      });
    }
    function examsBioprint(patientName, ipp, med){
      var fileName ='examsBio-' + patientName +'.pdf'; 
      ol = document.getElementById('listBioExam');
      ol.innerHTML = '';
      $('.examsBio input.ace:checkbox:checked').each(function(index, value) {
        $("ol").append('<li><span class="pieshare"></span>'+ this.nextElementSibling.innerHTML +'</li>');
      });
      var pdf = new jsPDF('p', 'pt', 'a4');
      JsBarcode("#barcode",ipp,{
        format: "CODE128",
        width: 2,
        height: 30,
        textAlign: "left",
        fontSize: 12, 
        text: "IPP: " + ipp
      });
      var canvas = document.getElementById('barcode');
      var jpegUrl = canvas.toDataURL("image/jpeg");
      pdf.addImage(jpegUrl, 'JPEG', 25, 175);
      pdf.setFontSize(12);
      pdf.text(320,730, 'Docteur : ' + med);
      generate(fileName,pdf,'bioExamsPdf');
  }
  function addExamsImg(form)
  {
      var arrayLignes = document.getElementById("ExamsImg").rows , ExamsImg = [];
      if(arrayLignes.length > 0)
      {
        for(var i=0; i< arrayLignes.length ; i++)
        {
          ExamsImg[i] = { acteId: arrayLignes[i].cells[0].innerHTML, type: arrayLignes[i].cells[2].innerHTML }   
        }
        var champ = $("<input type='text' name ='ExamsImg' value='"+JSON.stringify(ExamsImg)+"' hidden>");
        champ.appendTo(form);
      }
    }
    function IMC1(){
        var poids = $("#poids").val();
        var taille = $("#taille").val();
        if(poids==""){
          alert("STP, saisir le poids");  // $("#poids").focus();
        return 0;
      }else if (isNaN(poids)) {
        alert("poids doit être un nombre!");  
        $("#poids").select();
        return 0;
      }
      if(taille==""){
        alert("STP, Saisir la taille");
        return 0;
      }else if (isNaN(taille)) {
        alert("taille doit être un nombre!");  
        $("#txtaltura").select();
        return 0;
      }
      var imc = poids / Math.pow(taille/100,2);
      var imc = Math.round(imc).toFixed(2);
      $("#imc").attr("value", imc);
          if(imc<17){
          $("#interpretation").attr("value", "Anorexie");
          }else if(imc>=17.1 && imc<=18.49){
          $("#interpretation").attr("value", "Migreur");
          }else if(imc>=18.5 && imc<=24.99){
          $("#interpretation").attr("value", "Poids Normale");
          }else if(imc>=25 && imc<=29.99){
          $("#interpretation").attr("value", "surpois");
          }else if(imc>=30 && imc<=34.99){
          $("#interpretation").attr("value", "Obésité I");
        }else if(imc>=35 && imc<=39.99){
          $("#interpretation").attr("value", "Obésité II (sévère)");  
        }else if(imc>=40){
          $("#interpretation").attr("value", "Obésité III (morbide)");  
          }
      }
      function storeord()
      {
        var arrayLignes = document.getElementById("ordonnance").rows;
        var longueur = arrayLignes.length; var ordonnance = []; 
        for(var i=1; i<longueur; i++)
        {
          ordonnance[i-1] = { med: arrayLignes[i].cells[0].innerHTML, posologie: arrayLignes[i].cells[4].innerHTML }
        }
        var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(ordonnance)+"' hidden>");
        champ.appendTo('#consultForm');
      }//save input modal to input form
      function OrientationSave() {//$('#specialite').val($('#specialiteOrient').val());$('#motifOr').val($('#motifOrient').val()); // $('#medecin').val($('#medecinOrient').val());
        var orientations = document.getElementById("orientationsList").rows;
        var longueur = orientations.length; var orientationliste = []; 
        for(var i=1; i<longueur; i++)
        {
          orientationliste[i-1] = { specialite: orientations[i].cells[0].innerHTML, motif: orientations[i].cells[2].innerHTML, examen: orientations[i].cells[3].innerHTML }
        }
        var champ = $("<input type='text' name ='orients' value='"+JSON.stringify(orientationliste)+"' hidden>");
        champ.appendTo('#consultForm');
      }
      $(document).ready(function () {
          $('.select2').css('width','50%').select2({allowClear:true});
          $('#examensradio').on('select2:select', function (e) { 
              if($("input[name='exmns']").is(":checked"))
                $(".disabledElem").removeClass("disabledElem").addClass("enabledElem");
          });
          $('#examensradio').on('select2:unselecting', function(event) {
             $(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
          });
          $('input[type=radio][name=exmns]').change(function() {
            if(! isEmpty($('#examensradio').val()))
               $(".disabledElem").removeClass("disabledElem").addClass("enabledElem");
            else
            $(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
          });
          $('#btnclose').click(function(){
           $("#examensradio").select2("val", "");$(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
          })
          $('input[type=radio][name=sexe]').change(function(){
            if(this.value == "M")
            {
              $('#Div-nomjeuneFille').attr('hidden','');
              $('#nom_jeune_fille').val(''); 
            }else
              if(($("#sf").val() ==="M")|| ($("#sf").val() =="V"))
                $('#Div-nomjeuneFille').removeAttr('hidden');
          });
          $( "#sf" ).change(function() {
              var sex =  $('input[name=sexe]:checked').val();
              if(sex == "F" && ((this.value ==="M") ||(this.value ==="V") ))
                 $('#Div-nomjeuneFille').removeAttr('hidden');
              else
                $('#Div-nomjeuneFille').attr('hidden', true);
          });/*$('#cim10Modal').on('shown.bs.modal', function (e) {$(this).trigger("reset"); });*/ 
          $('body').on('click', '.CimCode', function (event) {
            $('#cim10Modal').trigger("reset");
            $('#inputID').val($(this).val());
            $('#cim10Modal').modal('show');
          });
          $('#chapitre').click(function(){
            if(! isEmpty($("#chapitre").val()) && $("#chapitre").val()!=0)
            {
                  $.ajax({
                       type : 'get',
                       url : '{{URL::to('schapitres')}}',
                      data:{'search':$("#chapitre").val()},
                      success:function(data,status, xhr){
                            $( "#schapitre" ).prop( "disabled", false );
                            var select = $('#schapitre').empty();
                            select.append("<option value='0'>Selectionnez une Sous Chapitre</option>");   
                            $.each(data,function(){
                                  select.append("<option value='"+this.C_S_CHAPITRE+"'>"+this.TITRE_S_CHAPITRE+"</option>");
                            });
                      }
                  });
            }else
              $( "#schapitre" ).prop( "disabled", true );
          });
          $('#schapitre').click(function(){
              var fieldname = $('#inputID').val();
              $('#liste_codesCIM tbody').empty();
              if($("#schapitre").val() != 0)
              {
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('maladies')}}',
                    data:{'search':$("#schapitre").val()},
                    success:function(data,status, xhr){
                          $(".numberResult").html(Object.keys(data).length);//$("#liste_codesCIM tbody").html(data);
                          $('#liste_codesCIM' ).DataTable( {
                               processing: true,
                              bInfo : false,
                              pageLength: 5,
                              destroy: true,
                              "language": { "url": '/localisation/fr_FR.json' },
                              "data" : data,
                              columns: [ 
                                   {  data: 'CODE_DIAG'},
                                   {  data: 'NOM_MALADIE'},
                                   {      data: null, title :'<em class="fa fa-cog"></em>', orderable: false, searchable: false,
                                        "render": function(data,type,full,meta){
                                              if( type === 'display' ) {
                                                return '<button class="btn btn-xs btn-primary" data-dismiss="modal" onclick="addCIMCode(\''+ data.CODE_DIAG+'\',\''+fieldname+'\')"><i class="ace-icon fa fa-plus-circle"></i></button>';
                                              }
                                              return data;
                                       }       
                                   }
                              ],
                              "columnDefs": [
                                    {"targets": 1 ,  className: "dt-head-center" },
                                    {"targets": 2 ,  className: "dt-head-center dt-body-center","orderable": false },
                              ]
                        });    
                    },
                    error:function(){
                          console.log("error");
                    },
                });
            }
          });
          $("#deletepod").click(function(){
             $("tr:has(input:checked)").remove();
          }); 
          $('body').on('click', '.delete-atcd', function (e) {
            event.preventDefault();
            var atcd_id = $(this).val();
            $.ajaxSetup({
              headers: {
               'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
              type: "DELETE",
                url: '/atcd/' + atcd_id,
              success: function (data) {
                    $("#atcd" + atcd_id).remove();
                 },
                error: function (data) {
                   console.log('Error:', data);
                }
            });
          });
  }) 
</script>
</div>