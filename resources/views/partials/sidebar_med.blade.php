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
      <li class="">
        <a href="home"><i class="menu-icon fa fa-picture-o"></i><span class="menu-text">Gestion Patients</span></a><b class="arrow"></b>
      </li>
      <li>
        <a href="{{ route('patient.index') }}"><i class="menu-icon fa fa-tachometer"></i><span class="menu-text">Accueil</span></a>
        <b class="arrow"></b>
      </li>
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
            <li><a href="/createConsultation"><i class="menu-icon fa fa-plus purple"></i>Ajouter une consultation</a><b class="arrow"></b>
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
            <li><a href="{{ route('hospitalisation.create') }}"><i class="menu-icon fa fa-plus purple"></i>Ajouter une hospitalisation
              </a><b class="arrow"></b>
            </li>
            <li>
              <a href="{{ route('hospitalisation.index') }}"  data-toggle="tooltip" data-placement="top" title=" Liste d'hospitalisation du service">
                <i class="menu-icon fa fa-eye pink"></i> Liste des hospitalisations
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
        @if(Auth::user()->is(14)) {{-- @if( Auth::user()->role_id == 14) --}}
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
    </ul><!-- /.nav-list -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
      <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
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
      function showConsult(consultId) //a voir ce lui den haut
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
      function getProducts(id_gamme, id_spec=0,med_id = 0)
      {
         var html = '<option value="0">Sélectionner...</option>';
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
      function addCIMCode(code,field)
      {
        $("#"+field).val(code);
        $('#liste_codesCIM').empty();  $("#chapitre").val($("#chapitre option:first").val());$("#schapitre").val($("#schapitre option:first").val());
        $('#cim10Modal').trigger("reset");$('#cim10Modal').modal('toggle');  
      }
      function createexbioOrg(nomp,prenomp,age,ipp){  
        var img = new Image();
        img.src = '{{ asset("/img/logo.png") }}';
        img.onload = function () {
           createexbioF(img,nomp,prenomp,age,ipp);
        };
      } 
    function lettreoriet(logo,nomP,prenomP,ageP,ipp,ett,etn,etadr,ettel,etlogo)
    {
      var specialite = $( "#specialiteOrient option:selected" ).text().trim();
      var medecin =  $("#medecinOrient option:selected").text().trim();
      html2canvas($("#lettreorientation"), {
        onrendered: function(canvas) {         
          moment.locale('fr');// var formattedDate = moment(new Date()).format("l");
          var d = new Date();
          var formattedDate = formatDate(d);
          var doc = new jsPDF({orientation: "p", lineHeight: 2});
          doc.text(105,10,ett, null, null, 'center');
          doc.setFontSize(13);
          doc.text(105,18,etn, null, null, 'center');
          doc.setFontSize(12);
          doc.text(105,24,etadr, null, null, 'center');
          doc.text(105,30, ettel, null, null, 'center');
          doc.addImage(logo, 'JPEG', 95, 33, 20, 20);
          doc.setFontSize(14);
          JsBarcode("#itfL", ipp.toString(), {
            lineColor: "#000",
            width:4,
            height:45,
            displayValue: true,
            text:"IPP :"+ipp.toString(),
            fontSize : 28,
            textAlign: "left"
          });
          const img = document.querySelector('img#itfL');
          doc.text(200,58, formattedDate , null, null, 'right');        
          doc.text(20,68, 'Docteur : {{ Auth::User()->employ->nom }} {{Auth::User()->employ->prenom }}', null, null);
          doc.text(20,76, 'Tél : {{Auth::User()->employ->tele_mobile }}', null, null);
          doc.text(200,68, 'Specialite : '+specialite , null, null,'right');// doc.text(200,76, 'Destinataire : '+medecin , null, null, 'right');
          doc.setFontType("bold");doc.setFontSize(16);
          doc.text(105,90, "Lettre d'Orientation", null, null, 'center');
          doc.addImage(img.src, 'JPEG', 20, 96, 50, 15);
          doc.setFontType("normal");doc.setFontSize(12);
          var text = "Permettez moi de vous adresser le(la) patient(e) sus-nommé(e), "+nomP+" "+prenomP+" âgé(e) de "+ageP+" ans, qui s'est présenté ce jour pour  "+$('#motifOrient').val()+"  . je vous le confie pour prise en charge spécialisé. respectueusement confraternellement.";
          lines = doc.splitTextToSize(text, 185);
          doc.text(20,130,lines,null,null);
          doc.text(160,260,'signature',null,null,'right');
          doc.save('orientLettre-'+nomP+'-'+prenomP+'.pdf');// var string = doc.output('datauristring');// $('#lettreorientation').attr('src', string);
        }
      })
    }
    //function createeximgOrg(nomp,prenomp,age, ipp){var img = new Image();img.src = '{{ asset("/img/logo.png") }}';img.onload = function (){//JsBarcode("#itf",IPP); //bonne(img,nomp,prenomp,age,ipp);};} 
    function createexbioF(image,nomp,prenomp,age,ipp){ 
            html2canvas($("#dos"), {
          onrendered: function(canvas) {
              moment.locale('fr');//var IPP = ipp.toString();
              var formattedDate = moment(new Date()).format("l");                     
              var doc = new jsPDF('p', 'mm');
              doc.text(105,9,'{{ Session::get('etabTut') }}', null, null, 'center');
              doc.setFontSize(13);
              doc.text(105,16,'{{ Session::get('etabname') }}'.replace(/&quot;/g,'"'), null, null, 'center');
              doc.setFontSize(12);
              doc.text(105,21,'{{ Session::get('etabAdr') }}', null, null, 'center');
              doc.text(105,26, 'Tél : {{ Session::get("etabTel") }} - {{ Session::get("etabTel") }}', null, null, 'center');//doc.text(105,26, 'Tél : 023-93-34 - 23-93-58', null, null, 'center');
              doc.addImage(image, 'JPEG', 95, 27, 20, 20);
              doc.setFontSize(14);
              JsBarcode("#itf", ipp.toString(), {
                lineColor: "#000",
                width:4,
                height:40,
                displayValue: true,
                text:"IPP :"+ ipp.toString(),
                fontSize : 28,
                textAlign: "left"
              });
              doc.text(200,60, formattedDate , null, null, 'right'); 
              doc.text(10,63, 'Nom : '+nomp, null, null);
              doc.text(10,68, 'Prénom : '+prenomp, null, null);
              doc.text(10,73, 'Age : '+ age+' ans', null, null); 
              const img = document.querySelector('img#itf');
              doc.addImage(img.src, 'JPEG', 10, 75, 50, 15);
              doc.text(10,100, 'Prière de faire', null, null);
              doc.setFontSize(16);
              doc.text(10,115,'Analyses Demandées :',null,null) 
              var i =0;
              $('input.ace:checkbox:checked').each(function(index, value) {
                doc.text(10,125+i, ++index + ' : '+this.nextElementSibling.innerHTML+" . ");
                i=i+10;
              });
              doc.setFontSize(12);
              doc.text(100,275, 'Docteur : {{ Auth::user()->employ->nom}} {{ Auth::user()->employ->prenom}}', null, null); 
              doc.save('ExamBiolo-'+nomp+'-'+prenomp+'.pdf');
          }
        });
    }
    function createexbio(nomp,prenomp,age,ipp){ 
      ol = document.getElementById('listBioExam');
      $('input.ace:checkbox:checked').each(function(index, value) {
         $("ol").append('<li><h4>-'+this.nextElementSibling.innerHTML+'</h4></li>');
      }); 
      $("#bioExamsPdf").removeClass('invisible'); 
      var element = document.getElementById('bioExamsPdf');
      var options = {
        filename:'ExamBio-'+nomp+'-'+prenomp+'.pdf'
      };
      var exporter = new html2pdf(element, options);
      $("#bioExamsPdf").addClass('invisible');
      exporter.getPdf(true).then((pdf) => {
        console.log('pdf file downloaded');
      });
      exporter.getPdf(false).then((pdf) => {// Get the jsPDF object to work with it
        console.log('doing something before downloading pdf file');
        pdf.save();
      });
    }
    function createeximg(nomp,prenomp,age,ipp)
    {
      $( "#ExamsImgtab" ).clone().appendTo( "#imgExams" );
      $('#imgExams tr').find('th:last-child, td:last-child').remove()
      $("#imagExamsPdf").removeClass('invisible'); 
       var element = document.getElementById('imagExamsPdf');
       var options = {
              filename:'ExamRadio-'+nomp+'-'+prenomp+'.pdf'
        };
       var exporter = new html2pdf(element, options);
      $("#imagExamsPdf").addClass('invisible');
      exporter.getPdf(true).then((pdf) => {// Download the PDF or...
               console.log('pdf file downloaded');
       });
      exporter.getPdf(false).then((pdf) => {// Get the jsPDF object to work with it
               console.log('doing something before downloading pdf file');
              pdf.save();
       });
    }
    function printExamCom(nom, prenom, age, ipp)
    {
      var interest = $('ul#compl').find('li.active').data('interest');
      switch(interest){
            case 0:
              createexbio(nom, prenom, age, ipp);
              break;
            case 1:
              createeximg(nom, prenom, age, ipp);
              break;
            case 2:
                break;
      }
      }
      function addExamsImg(form)
      {
            var ExamsImg = [];
            var arrayLignes = document.getElementById("ExamsImg").rows;
            for(var i=0; i< arrayLignes.length; i++)
            {
              ExamsImg[i] = { acteImg: arrayLignes[i].cells[0].innerHTML, types: arrayLignes[i].cells[2].innerHTML }
            }
            var champ = $("<input type='text' name ='ExamsImg' value='"+JSON.stringify(ExamsImg)+"' hidden>");
            champ.appendTo(form);
      }
      function orLetterPrint(nomP,prenomP,ageP,ipp,ett,etn,etadr,ettel,etlogo) {
        $("#OrientLetterPdf").removeClass('invisible');

        $("#orSpecialite").text($( "#specialiteOrient option:selected" ).text().trim());
        $("#motifCons").text($( "#motifC" ).val());
        $("#motifO").text($( "#motifOrient" ).val());
        var element = document.getElementById('OrientLetterPdf');
        var options = {
          filename:'lettreOrient-'+nomP+'-'+nomP+'.pdf'
        };
        var exporter = new html2pdf(element, options);
        $("#OrientLetterPdf").addClass('invisible');
        exporter.getPdf(true).then((pdf) => {
            console.log('pdf file downloaded');
        });
        exporter.getPdf(false).then((pdf) => {
            console.log('doing something before downloading pdf file');
            pdf.save();
        });
      }
      function orLetterPrintOrg(nomP,prenomP,ageP,ipp,ett,etn,etadr,ettel,etlogo) {
        var img = new Image();img.src = '{{ asset("/img/logo.png") }}';img.onload = function () {
          lettreoriet(img,nomP,prenomP,ageP,ipp,ett,etn,etadr,ettel,etlogo);
        };
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
        var longueur = arrayLignes.length; 
        var ordonnance = [];
        for(var i=1; i<longueur; i++)
        {
          ordonnance[i-1] = { med: arrayLignes[i].cells[0].innerHTML, posologie: arrayLignes[i].cells[4].innerHTML }
        }
        var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(ordonnance)+"' hidden>");
        champ.appendTo('#consultForm');
      }//save input modal to input form
      function lettreorientation() {
        $('#specialite').val($('#specialiteOrient').val());// $('#medecin').val($('#medecinOrient').val());
        $('#motifOr').val($('#motifOrient').val()); }
      function demandehosp()
      {
        $('#modeAdmission').val($('#modeAdmissionHospi').val());// $("#degreurg").appendTo('#consultForm');
        $('#specialiteDemande').val($('#specialiteHospi').val()); 
        $('#service').val($('#serviceHospi').val());
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
          $('#btn-addImgExam').click(function(){
              var selected = []; var array = [];
              $('#ExamIgtModal').modal('toggle');
              $.each($("input[name='exmns']:checked"), function(){
                selected.push($(this).next('label').text());
                array.push($(this).val());  //$(this). prop("checked", false);
              });   
              var exam = '<tr id="acte-'+$("#examensradio").val()+'"><td id="idExamen" hidden>'+$("#examensradio").val()+'</td><td>'+$("#examensradio option:selected").text()+'</td><td id ="types" hidden>'+array+'</td><td>'+selected+'</td><td class="center" width="5%">';
                 exam += '<button type="button" class="btn btn-xs btn-danger delete-ExamImg" value="'+$("#examensradio").val()+'" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';     
              $('#ExamsImg').append(exam);
              $('#examensradio').val(' ').trigger('change');
              $(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
          });
          jQuery('body').on('click', '.delete-ExamImg', function () {
             $("#acte-" + $(this).val()).remove();
          });
          $('input[type=radio][name=sexe]').change(function(){
            if($(this).val() == "M")
            {
              $('#Div-nomjeuneFille').attr('hidden','');
              $('#nom_jeune_fille').val(''); 
            }else {
              var civilite= $("select.civilite option").filter(":selected").val();
              if((civilite ==="M")|| (civilite =="V"))
                $('#Div-nomjeuneFille').removeAttr('hidden');
            }
          });
          $( ".civilite" ).change(function() {
              var sex =  $('input[name=sexe]:checked').val();
              if(sex == "F")
              {
                var civilite= $("select.civilite option").filter(":selected").val(); 
                if((civilite ==="M")|| (civilite ==="V"))
                  $('#Div-nomjeuneFille').removeAttr('hidden');
                else
                  $('#Div-nomjeuneFille').attr('hidden','');  
              }else
                $('#Div-nomjeuneFille').attr('hidden','');      
          });
/*$( "#Position" ).change(function(){if($(this).val() != "Activité"){$('#serviceFonc').addClass('invisible'); $('#service option:eq(0)').prop('selected', true);}else$('#serviceFonc').removeClass('invisible');});if($( "#Position" ).val() != "Activité" )$('#serviceFonc').addClass('invisible');*/ 
          jQuery('body').on('click', '.CimCode', function (event) {
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
        jQuery('body').on('click', '.delete-atcd', function (e) {
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