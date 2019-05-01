<!-- basic scripts -->

<!--[if !IE]> -->
<script src="{{asset('/js/jquery-2.2.4.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/jspdf.debug.js') }}"></script>
<script src="{{ asset('/js/html2pdf.js') }}"></script>
        <!-- <![endif]-->

        <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
 <script type="text/javascript">
     if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
</script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
{{-- <script src="{{asset('/js/angular.min.js')}}"></script> --}}
<script src="{{asset('/js/jquery-ui.custom.min.js')}}"></script>
<script src="{{asset('/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('/js/jquery.sparkline.index.min.js')}}"></script>
<script src="{{asset('/js/jquery.flot.min.js')}}"></script>
<script src="{{asset('/js/jquery.flot.pie.min.js')}}"></script>
<script src="{{asset('/js/jquery.flot.resize.min.js')}}"></script>
<script src="{{asset('/js/bootbox.js')}}"></script>
<script src="{{asset('/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{ asset('/js/jquery.gritter.min.js') }}"></script>
<script src="{{ asset('/js/spin.js') }}"></script>
<script src="{{ asset('/js/moment.min.js') }}"></script>
 <!-- ace scripts -->
<script src="{{asset('/js/ace-elements.min.js')}}"></script>
<script src="{{asset('/js/ace.min.js')}}"></script>
<!-- ace scripts -->
<script src="{{ asset('/js/larails.js') }}"></script>
<script src="{{ asset('/js/datatables.js') }}"></script>
<script src="{{ asset('/js/wizard.min.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('/js/select2.min.js') }}"></script>
<script src="{{ asset('/js/ace.min.js') }}"></script>
<script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('/js/autosize.min.js') }}"></script>
<script src="{{ asset('/js/jquery.inputlimiter.min.js') }}"></script>
<script src="{{ asset('/js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('/js/jquery.hotkeys.index.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/js/multiselect.min.js') }}"></script>
<script src="{{ asset('/js/prettify.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('/js/ace-extra.min.js') }}"></script>
<script src="{{ asset('/js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/locale/fr.js') }}"></script>
<script src="{{ asset('/js/jquery-editable-select.js') }}"></script>
{{-- <script src="{{ asset('/js/moment-timezone.js') }}"></script>
 --}}
 <script type="text/javascript">
$(document).ready(function(){
    $('#avis').change(function(){
        if($(this).val() == "R")
        {
            $("#motifr").show();
        }
        else
        {
            $("#motifr").hide();
        }
    });
    $("#validerdmd").click(function(){
        var arrayLignes = document.getElementById("cmd").rows;
        var longueur = arrayLignes.length;
        var produits = [];
        for(var i=1; i<longueur; i++)
        {
            produits[i] = { produit: arrayLignes[i].cells[1].innerHTML, gamme: arrayLignes[i].cells[2].innerHTML, spec: arrayLignes[i].cells[3].innerHTML, qte: arrayLignes[i].cells[4].innerHTML}
        }
        var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(produits)+"' hidden>");
        champ.appendTo('#demandform');
        $('#demandform').submit();
    });
    $("#deletepod").click(function(){
        $("tr:has(input:checked)").remove();
    });
    $("#validerdmd").click(function(){
        var arrayLignes = document.getElementById("cmd").rows;
                var longueur = arrayLignes.length;
                var tab = [];
                for(var i=1; i<longueur; i++)
                {
        tab[i]=arrayLignes[i].cells[1].innerHTML +" "+arrayLignes[i].cells[2].innerHTML+" "+arrayLignes[i].cells[4].innerHTML;
                }
        var champ = $("<input type='text' name ='liste' value='"+tab.toString()+"' hidden>");
        champ.appendTo('#dmdprod');
        $('#dmdprod').submit();
    });
    $("#ajoutercmd").click(function() {
         $('#cmd').append("<tr><td class='center'><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td>"+$('#produit').val()+"</td><td>"+$('#gamme option:selected').text()+"</td><td>"+$('#specialite option:selected').text()+"</td><td class='center'>"+$("#quantite").val()+"</td></tr>");
    });
    $('#gamme').change(function(){
        var id_gamme = $(this).val();
        var html_code = '<option value="">Sélectionner</option>';
         $.ajax({
            url : '/getspecialite/'+id_gamme,
            type : 'GET',
            dataType : 'json',
            success : function(data){
                $.each(data, function(){
                  html_code += "<option value='"+this.id+"'>"+this.specialite_produit+"</option>";
                });
                $('#specialite').html(html_code);
            },
        });
    });
    $('#specialite').change(function(){
        var id_gamme = $('#gamme').val();
        var id_spec = $(this).val();
        var html = '';
        $.ajax({
            url : '/getproduits/'+id_gamme+'/'+id_spec,
            type : 'GET',
            dataType : 'json',
            success : function(data){
                $.each(data, function(){
                  html += "<option value='"+this.dci+"'>"+this.dci+"</option>";
                });
                $('#produit').html(html);
            },
            error : function(){
                console.log('error');
            }
        });
    });
});  
</script>


<script type="text/javascript">
    //And for the first simple table, which doesn't have TableTools or dataTables
    //select/deselect all rows according to table1 header checkbox
    var active_class = 'active';
    $('#table1 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
        var th_checked = this.checked;//checkbox inside "TH" table header
        $(this).closest('table').find('tbody > tr').each(function(){
        var row = this;
        if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
        else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
        });
    });
                
                //select/deselect a row table1 when the checkbox is checked/unchecked
                $('#table1').on('click', 'td input[type=checkbox]' , function(){
                    var $row = $(this).closest('tr');
                    if($row.is('.detail-row ')) return;
                    if(this.checked) $row.addClass(active_class);
                    else $row.removeClass(active_class);
                });
                //add horizontal scrollbars to a simple table
            /*  $('#table1').css({'width':'50px', 'max-width': 'none'}).wrap('<div style="width: 50px;" />').parent().ace_scroll(
                  {
                    horizontal: true,
                    styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
                    size: 50,
                    mouseWheelLock: true
                  }
                ).css('padding-top', '12px');*/

                //select/deselect all rows according to table2 header checkbox
                
                $('#table2 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                    var th_checked = this.checked;//checkbox inside "TH" table2 header
                    
                    $(this).closest('table').find('tbody > tr').each(function(){
                        var row = this;
                        if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                        else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                    });
                });
                
                //select/deselect a row when the checkbox is checked/unchecked
                $('#table2').on('click', 'td input[type=checkbox]' , function(){
                    var $row = $(this).closest('tr');
                    if($row.is('.detail-row ')) return;
                    if(this.checked) $row.addClass(active_class);
                    else $row.removeClass(active_class);
                });
                //add horizontal scrollbars to a simple table
                /*$('#table2').css({'width':'50px', 'max-width': 'none'}).wrap('<div style="width: 50px;" />').parent().ace_scroll(
                  {
                    horizontal: true,
                    styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
                    size: 50,
                    mouseWheelLock: true
                  }
                ).css('padding-top', '12px');*/
</script>   

<script type="text/javascript">
    var active_class = 'active';
    var id_demh= new Array();
    var id_medt= new Array();
    var id_prio= new Array();
    var obs= new Array();
    
    function ajouterligne(){
        var lignes= new Array();
        nligne= new Array();//la nouvelle ligne
        lignes=document.getElementById("table1").getElementsByTagName("tr");
        //seling=ling.getElementsByClassName("active");
        tableau = document.getElementById("table2");
        for(var i=0;i<lignes.length;i++){
            if (lignes[i].className=='active')
                {
                    lignes[i].classList.remove(active_class);
                    var col=lignes[i].getElementsByTagName("td");
                    nligne = tableau.insertRow(-1);//on a ajouté une ligne

                    var colonne0 = nligne.insertCell(0);
                    colonne0.innerHTML += col[0].innerHTML;
                    colonne0.style.display='none';

                    var colonne1 = nligne.insertCell(1);
                    colonne1.innerHTML += col[1].innerHTML;

                    var colonne2 = nligne.insertCell(2);
                    colonne2.innerHTML += col[2].innerHTML; 

                    var colonne3 = nligne.insertCell(3);
                    colonne3.innerHTML += col[3].innerHTML;
                    colonne3.style.display='none';      

                    var colonne4 = nligne.insertCell(4);
                    colonne4.innerHTML += col[4].innerHTML;
                    colonne4.style.display='none';      

                    var colonne5 = nligne.insertCell(5);
                    var chm =col[5].getElementsByTagName("select");
                    var s = chm[0].selectedIndex;
                    colonne5.innerHTML += col[5].innerHTML;
                    chm=colonne5.getElementsByTagName("select");
                    chm[0].options[s].selected='selected';
                    chm[0].disabled=true;
                    id_medt.push(chm[0].options[s].value);
                    //colonne5.innerHTML += chm[0].options[s].text;

                    var colonne6 = nligne.insertCell(6);
                    colonne6.innerHTML += col[6].innerHTML;
                    chm=col[6].getElementsByTagName('input');
                    for(var j = 0;j < chm.length; j++){
                        if(chm[j].checked)s=j;}
                    chm=colonne6.getElementsByTagName('input');
                    chm[s].checked=true;
                    id_prio.push(chm[s].value);
                    colonne6.style.display='none';

                    var colonne7 = nligne.insertCell(7);
                    colonne7.innerHTML += col[7].innerHTML;
                    chm= col[7].getElementsByTagName('textarea');
                    s=chm[0].value;
                    chm=colonne7.getElementsByTagName('textarea');
                    chm[0].value=s;                 
                    obs.push(s);                        
                    colonne7.style.display='none';

                    id_demh.push(col[0].innerHTML); 
                    
                    
                                            
                    //$(lignes[i]).appendTo('#table2');
                    document.getElementById("table1").deleteRow(i);
                    
                }
            }
           lignes=null;

    }
      $('#table2 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                    var th_checked = this.checked;//checkbox inside "TH" table2 header
                    
                    $(this).closest('table').find('tbody > tr').each(function(){
                        var row = this;
                        if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                        else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                    });
                });
                
                //select/deselect a row when the checkbox is checked/unchecked
                $('#table2').on('click', 'td input[type=checkbox]' , function(){
                    var $row = $(this).closest('tr');
                    if($row.is('.detail-row ')) return;
                    if(this.checked) $row.addClass(active_class);
                    else $row.removeClass(active_class);
                });
  
  
    function suppligne(){
        var lignes= new Array();
        
        lignes=document.getElementById("table2").getElementsByTagName("tr");
        //seling=ling.getElementsByClassName("active");

        for(var i=0;i<lignes.length;i++){
            if (lignes[i].className=='active')
                {   //désactivé la ligne
                    lignes[i].classList.remove(active_class);
                    
                                        
                    var col=lignes[i].getElementsByTagName("td");

                    //activer la selection du medecin traitant
                    var chm =col[5].getElementsByTagName("select");
                    chm[0].disabled=false;
                    
                    //décocher le checkbox
                    var chm =col[1].getElementsByTagName("input");
                    chm[0].checked=false;

                    //afficher les colonnes cachées
                    for (var j = 1; j < col.length; j++) {
                        if (col[j].style.display === 'none') 
                            col[j].style.display='table-cell' ;}    
                            lignes[i].style.display='table-row';
                            var t=col[0].innerHTML;                         
                    var index=id_demh.indexOf(t);                   
                    id_demh.splice(index, 1);                   
                    id_medt.splice(index, 1);                   
                    id_prio.splice(index, 1);                           
                    obs.splice(index, 1);
                    console.log(id_medt);
      $(lignes[i]).appendTo('#table1');      
  }
           
        }lignes=null;
    }
    $('#detail_coll').submit(function(ev) {
    ev.preventDefault(); // to stop the form from submitting
    /* Validations go here */
    sel=document.getElementById("demh");
    med=document.getElementById("medt");
    pio=document.getElementById("prio");
    bs=document.getElementById("observation");
    console.log(sel.length);
    for (var i =0; i <id_demh.length ; i++) {
        sel.options[sel.options.length] = new Option (id_demh[i], id_demh[i],false,true);
        med.options[med.options.length] = new Option (id_demh[i], id_medt[i],false,true);
        pio.options[pio.options.length] = new Option (id_demh[i], id_prio[i],false,true);
        bs.options[bs.options.length] = new Option (id_demh[i], obs[i],false,true);
    }

    this.submit(); // If all the validations succeeded
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    // $('#patients_liste').dataTable();    // $('#choixpatientrdv').dataTable();  // $('#rdvs_liste').dataTable();    // $('#patients').dataTable();    // $('#choix-patient-atcd').dataTable();//$('#users').dataTable();
});
function addRequiredAttr()
{
             $(".starthidden").hide(250);   // $("ul#menuPatient li:not(.active) a").prop('disabled', false); 
             jQuery('input:radio[name="sexef"]').filter('[value="M"]').attr('checked', true);
              jQuery('input:radio[name="etat"]').filter('[value="En exercice"]').attr('checked', true);
              $("ul#menuPatient li:eq(1)").css('display', '');
}
function typepCreation()
{
    
    if($('#fonc').is(':checked'))
    {
           $('#NSSInput').addClass("hidden").hide().fadeIn();
           $('#AssureInputs').addClass("hidden").hide().fadeIn();
           $('#foncinput').css('display', 'block');
           $('#nssinput').css('display', 'block');
            $('#nssAssinput').removeClass("hidden").show();
           $('#matinput').css('display', 'block');
           $('#etatinput').css('display', 'block');
           $('#gradeinput').css('display', 'block');
           $('#foncform').css('display', 'none');
           $('#typepp').css('display', 'none');
            $(".starthidden").hide();
    }
    else
    {
        if($('#ayant').is(':checked'))
            {
                $('#NSSInput').removeClass("hidden").show();    
                $('#foncinput').css('display', 'none');
                $('#nssinput').css('display', 'none');
                $('#gradeinput').css('display', 'none');
                $('#nssAssinput').addClass("hidden").hide().fadeIn();
                $('#matinput').css('display', 'none');
                $('#etatinput').css('display', 'none');
                $('#foncform').css('display', 'block');  
                $('#typepp').css('display', 'block');
                $(".starthidden").hide();  
            }else
            {
                     $('#NSSInput').addClass("hidden").hide().fadeIn();
                     $('#AssureInputs').addClass("hidden").hide().fadeIn();
                     $('#foncform').css('display', 'none');
                     $('#typepp').css('display', 'none');
                     $('#foncinput').css('display', 'none');
                     $('#nssinput').css('display', 'none');
                     $('#gradeinput').css('display', 'none');
                     $('#nssAssinput').addClass("hidden").hide().fadeIn();
                     $('#matinput').css('display', 'none');
                     $('#etatinput').css('display', 'none');
                     $(".starthidden").show();
            }
    }
}
function typep()
{
    if($('#fonc').is(':checked'))
    {
           $('#foncform').addClass("hidden").hide().fadeIn();
           $('#NSSInput').addClass("hidden").hide().fadeIn();
            $('#descriptionDerog').addClass("hidden").hide().fadeIn();
           $('#AssureInputs').removeClass("hidden").show();   
           
    }
    else
    {
           if($('#ayant').is(':checked'))
           { 
                     $('#AssureInputs').addClass("hidden").hide().fadeIn();
                     $('#descriptionDerog').addClass("hidden").hide().fadeIn();
                     $('#foncform').removeClass("hidden").show();  
                     $('#NSSInput').removeClass("hidden").show();    
           }
           else
           {
                    $('#foncform').addClass("hidden").hide().fadeIn();
                    $('#NSSInput').addClass("hidden").hide().fadeIn();                  
                    $('#AssureInputs').addClass("hidden").hide().fadeIn();
                    $('#descriptionDerog').removeClass("hidden").show();
                  
           }
}
}
//end
$('#typeexm').on('change', function() {
    if($("#typeexm").val() == "CM")
    {
        $('#details').val('Je déclare que le patient nécessite un arrét de travail de 00 jours(s) a compter de '+$('#datedem').val());
    }
    else if($("#typeexm").val() == "AB")
    {
        $('#details').val('');
        $('#details').val('details');
    }
});
</script>
    <script type="text/javascript">
        $("#submitatcd").on('click', function() 
            {
             $("#addatcd").submit();
            });
        $("#submitexbio").on('click', function() 
            {
             $("#exbioform").submit();
            });
        $("#submiteximg").on('click', function() 
            {
             $("#exmimgform").submit();
            });
         $("#submitexmcln").on('click', function() 
            {
             $("#exmclnform").submit();
            });
    </script>
    <script>
            $('#flash-overlay-modal').modal();
            $(document).ready(function(){
             $(".tooltip-link").tooltip();//ajouter info bull
            }); 
</script>
        <script type="text/javascript">
           function medicm(med)
           {
                    $.ajax({
                        type: 'GET',
                        url: '/getmed/'+med,
                        dataType: "json",
                        success: function (result)
                            {
                                            $("#nommedic").val(result['Nom_com']+' '+result['Dosage']);
                                            $("#forme").val(result['Forme']);
                                            $("#medicamentId").val(result['id']);
                                            $("#conditionnement").val(result['Conditionnement']);
                                            $(".disabledElem").removeClass("disabledElem").addClass("enabledElem"); //$('#Ordonnance').reset();
                            }
                      });
               }
                function medicmV1(med)
           {
                    $.ajax({
                        type: 'GET',
                        url: '/getmed/'+med,
                        dataType: "json",
                        success: function (result)
                            {
                                            $("#nommedic").val(result['Nom_com']);
                                            $("#forme").val(result['Forme']);
                                             $("#dosage").val(result.Dosage);
                                            $("#id_medicament").val(result['id']);
                                            $(".disabledElem").removeClass("disabledElem").addClass("enabledElem"); //$('#Ordonnance').reset();
                            }
                      });
               }
               function addmidifun()
                {
                            //$("#posologie").val( $("#nbprise").val()+' fois par '+$("#fois").val()+' Pendant '+$("#duree").val()+' '+$("#dureefois").val()+'. ');//+$("#temps").val()+'.'
                            //$("#ordonnance").append("<tr><td class='center'><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td id='nom_medec'>" + $("#nommedic").val() + "</td><td id='form_medec'>" + $("#forme").val() + "</td><td  id='qte_medec'>" + $("#qte").val() +"</td><td id='posolog_medec'>"+$("#pos").val()+"</td><td style='display:none;' id='id_medec'>"+$("#medicamentId").val()+"</td></tr>");
                             $("#ordonnance").append("<tr><td class='center'><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td hidden>"+$("#id_medicament").val()+"</td><td>"+$("#nommedic").val()+"</td><td>"+$("#forme").val()+"</td><td>"+$("#dosage").val()+"</td><td>"+$("#posologie_medic").val()+"</td></tr>");
                             $(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
                             clearInput();
                     
            }
            function supcolonne()
            {
                $("tr:has(input:checked)").remove(); 
            }

            function sexefan()
            {
                if( $('#sexef').is(':checked') )
                    {
                        $('#civ').css('display','block');
                    } 
                else
                    {
                        $('#civ').css('display','none');
                    }
            }
            function civilitefan()
            {
                if( $('#mdm').is(':checked') )
                    {
                        $('#njfid').css('display','block');
                    } 
                else
                    {
                        $('#njfid').css('display','none');
                    }
            }
            function typepatientfan()
            {
                if( $('#ass').is(':checked') )
                    {
                        $('#matass').css('display','block');
                        $('#te').css('display','none');
                        $('#infoass').css('display','none');
                        $('#prof').css('display','none');
                    } 
                else
                    {s
                        $('#matass').css('display','none');
                        $('#prof').css('display','block');
                        $('#infoass').css('display','block');
                        $('#te').css('display','block');
                    }
            }
            function atcd()
            {  
                  $('#description').text(" ");
                   resetField();
                   if($('#Antecedant').val() == 'Personnels')
                    {
                          $('#sous_type').css('display','block');
                    }
                else
                    {
                        $('#sous_type').css('display','none');
                        $('#atcdsstypehide').css('display','none');
                        $('#PhysiologieANTC').css('display','none');
                        $('#typeAntecedant').val(null);
                    }
           }
           function resetField()
           {
                $("#description").val(' ');
                $('#dateAntcd').val('');
                   
           }

           function ajaxfunc(patientid)
           {        
                     var habitudeAlim = null; var tabac=null ; var ethylisme = null;
                     var soustype=null;
                     var antecedant = $('#Antecedant').val();
                     var typeAntecedant = $('#typeAntecedant').val();
                     soustype = $('#sstypeatcdc').val();                  
                      if(typeAntecedant =="Physiologiques")
                     {
                            habitudeAlim= $('#habitudeAlim').val();
                            tabac = $("#tabac").is(":checked") ? 1:0;
                            ethylisme = $("#ethylisme").is(":checked") ? 1:0;
                     }
                     var dateATCD = $('#dateAntcd').val()
                    var description = $("#description").val(); 
                     $.ajax({
                                 headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                 },
                               type:'POST',
                                url:'/AddANTCD',
                                data:{ antecedant:antecedant,typeAntecedant:typeAntecedant,soustype:soustype,dateATCD:dateATCD,description:description,patientid:patientid,habitudeAlim:habitudeAlim,tabac:tabac,ethylisme:ethylisme },
                                   success:function(data){
                                      $("#msg").html(data.msg);
                                   }
                                });
                       $('#ants-tab').append("<tr><td>"+$('#Antecedant').val()+"</td><td>"
                         +$('#dateAntcd').val()+"</td><td>"+$('#description').val()+
                         "</td><td></td></tr>"); 
          }
          function atcdhide()

           {        
                     // $('#description').text(" ");
                     resetField(); 
                     if($('#typeAntecedant').val() == "Pathologiques" )
                     {
                             $('#atcdsstypehide').show();$('#PhysiologieANTC').hide();
                             $('#habitudeAlim').val(null);$('#tabac').prop('checked', false); 
                             $('#ethylisme').prop('checked', false);   
                     }
                    else
                     {
                            $('#atcdsstypehide').hide();$('#PhysiologieANTC').show();
                            $('#sstypeatcdc').prop("selectedIndex", 1);
                    }
           }
        </script>
        <script>
           $('document').ready(function(){
                    $("#dexbio").on("hidden.bs.modal", function () {
                           var selected = $("#selectedoption").val();
                           var arrayOfSelected = selected.split(",");
                           for(var i=0;i<arrayOfSelected.length;i++){
                               $('input[type=checkbox][value='+arrayOfSelected[i]+']').prop('checked',true);
                                }
                });
           });          
        function lettreoriet(nommedt,prenommedt,servmedt,telmedt,nompatient,prenompatient,agepatient)
        {
           var specialite = $( "#specialite option:selected" ).text().trim();
           var medecin =  $("#medecin option:selected").text().trim();
           $('#lettreorientation').show();
           $('#lettreorientation').removeClass("hidden");
            var d = new Date();
            var dd = d.getDate();
            var mm = d.getMonth()+1; 
            var yyyy = d.getFullYear();
            var lettre = new jsPDF({orientation: "p", lineHeight: 1.5})
            lettre.setFontSize(18);
            lettre.lineHeightProportion = 100;
            lettre.text(105,20, 'DIRECTION GENERAL DE LA SURETE NATIONALE', null, null, 'center');
            lettre.text(105,28, 'HOPITAL CENTRAL DE LA SURETE NATIONALE "LES GLYCINES"', null, null, 'center');
            lettre.text(105,36, '12, Chemin des Glycines - ALGER', null, null, 'center');
            lettre.text(105,44, 'Tél : 23-93-34 - 23-93-58', null, null, 'center');
            lettre.text(200,58, 'Alger,le : '+dd+'/'+mm+'/'+yyyy, null, null, 'right');
            
            lettre.text(20,68, 'Emetteur : '+nommedt+' '+prenommedt, null, null);
            lettre.text(20,76, 'Tél : '+telmedt, null, null);
            lettre.text(200,68, 'Destinataire : '+medecin , null, null, 'right');
            lettre.text(200,76, 'Specialite : '+specialite , null, null,'right');
            lettre.setFontType("bold");
            lettre.text(105,90, "Lettre d'orientation", null, null, 'center');
            var text = "permettez moi de vous adresser le(la) patient(e) sus-nommé(e), "+nompatient+" "+prenompatient+" âgé(e) de "+agepatient+" ans, qui s'est présenté ce jour pour  "+$('#motifOrient').val()+"  . je vous le confie pour prise en charge spécialisé. respectueusement confraternellement.";
            lines = lettre.splitTextToSize(text, 185);
            lettre.text(20,110,lines,null,null);
            lettre.text(200,180,'signature',null,null,'right');
            var string = lettre.output('datauristring');
            $('#lettreorientation').attr('src', string);
        }
        function createord(nompatient,nommedcin) {
            var pdf = new jsPDF()
            pdf.text(105,20, 'DIRECTION GENERAL DE LA SURETE NATIONALE', null, null, 'center');
            pdf.text(105,26, 'HOPITAL CENTRAL DE LA SURETE NATIONALE "LES GLYCINES"', null, null, 'center');
            pdf.text(105,32, '12, Chemin des Glycines - ALGER', null, null, 'center');
            pdf.text(105,38, 'Tél : 23-93-34 - 23-93-58', null, null, 'center');
            pdf.text(200,50, 'Alger,le : '+$('#dateord').val(), null, null, 'right');
            pdf.text(20,60, 'Docteur : '+nommedcin, null, null);
            pdf.text(200,60, 'Patient : '+nompatient, null, null, 'right');
            pdf.setFontType("bold");
            pdf.text(105,70, 'ORDONNANCE', null, null, 'center');
            var arrayLignes = document.getElementById("ordonnance").rows;
            var longueur = arrayLignes.length;
            for(var i=1; i<longueur; i++)
            {
            pdf.text(30,73+(i*(20)), arrayLignes[i].cells[1].innerHTML +" "+arrayLignes[i].cells[2].innerHTML, null, null);
            pdf.text(30,80+(i*(20)), arrayLignes[i].cells[4].innerHTML, null, null);
            }
            var string = pdf.output('datauristring');
            $('#ordpdf').attr('src', string);

            }
            function storeord()
            {   
                var arrayLignes = document.getElementById("ordonnance").rows;
                var longueur = arrayLignes.length;
                var tab = [];
                for(var i=1; i<longueur; i++)
                {
					tab[i]=arrayLignes[i].cells[1].innerHTML +" "+arrayLignes[i].cells[2].innerHTML+" "+arrayLignes[i].cells[4].innerHTML;
                }
                var champ = $("<input type='text' name ='liste' value='"+tab.toString()+"' hidden>");
                champ.appendTo('#ordonnace_form');
                //console.log(JSON.stringify(tab));
                $('#ordonnace_form').submit();
            }

           function createexbio(nomp,prenomp){      
                     var exbio = new jsPDF();
                     var d = new Date();
                     var dd = d.getDate();
                     var mm = d.getMonth()+1; 
                     var yyyy = d.getFullYear();
                     exbio.text(200,20, 'Date : '+dd+'/'+mm+'/'+yyyy, null, null, 'right');
                     exbio.text(20,25, 'Nom : '+nomp, null, null);
                     exbio.text(20,35, 'Prénom : '+prenomp, null, null);
                     exbio.text(20,45, 'Age : 30 ans', null, null);
                     exbio.setFontType("bold");
                     exbio.text(105,55, 'Priére de faire', null, null, 'center');
                     exbio.setFontSize(14);
                     exbio.text(45,65,'Analyses Demandées :',null,null,'center');
                     exbio.setFontSize(13);
                     var i =0;
                       $('input.ace:checkbox:checked').each(function() {
                              exbio.text(25,72+i,$(this).attr('value')+", ");
                        i=i+10;
                    });
                    var autresex = $("#autr").tagsinput('items');
                    var long = autresex.length; 
                    for (var j = 0;  j< long; j++) {
                        exbio.text(25,72+i,autresex[j]+", ");
                        i=i+10;
                    }
                    var string = exbio.output('datauristring');
                    $('#exbiopdf').attr('src', string);
           }
          function createeximg(nomp,prenomp){
                     var d = new Date();
                      var yyyy = d.getFullYear().toString();
                      var mm = (d.getMonth()+1).toString();
                      var dd  = d.getDate().toString();  
                      var date=  yyyy + "/" + (mm[1]?mm:"0"+mm[0]) + "/" + (dd[1]?dd:"0"+dd[0]);
                     var exbio = new jsPDF();
                     exbio.text(200,20, 'Date :' +date , null, null, 'right');
                     exbio.text(20,25, 'Nom : '+nomp, null, null);
                     exbio.text(20,35, 'Prénom : '+prenomp, null, null);
                      exbio.text(20,45, 'Age :........................................', null, null);
                     exbio.setFontType("bold");
                     exbio.text(105,55, 'Priére de faire', null, null, 'center');
                      exbio.setFontSize(14);
                      exbio.text(45,65,'Analyses Demandées :',null,null,'center');
                     exbio.setFontSize(13);
                      var i =0;
                        // $(".imgExam").each(function() {
                        //     alert($(this).attr('value'));
                        // });
                     var selected = "";
                     $("input[class='imgExam']:checked").each(function() {
                            exbio.text(25,72+i,$(this).attr('data-checkbox-text')+", ");
                            selected = selected + $(this).val()+", ";
                            i=i+10;
                     });
                     $('#selectedoption').val(selected); 
                     var autreexamRadio = $("#examRadAutr").tagsinput('items');  
                     for (var j = 0;  j< autreexamRadio.length; j++) {
                            exbio.text(25,72+i,autreexamRadio[j]+", ");
                            i=i+10;
                     }
                     // Autre Echographe
                     var examautECHO = $("#examRadAutECHO").tagsinput('items');  
                     for (var j = 0;  j< examautECHO.length; j++) {
                            exbio.text(25,72+i,examautECHO[j]+", ");
                            i=i+10;
                     }
                     //autre scanner
                     var examautCT = $("#examRadAutCT").tagsinput('items');  
                     for (var j = 0;  j< examautCT.length; j++) {
                            exbio.text(25,72+i,examautCT[j]+", ");
                            i=i+10;
                     }
                      //autre IRM
                     var examautIRM = $("#examRadAutRMN").tagsinput('items');  
                     for (var j = 0;  j< examautIRM.length; j++) {
                            exbio.text(25,72+i,examautIRM[j]+", ");
                            i=i+10;
                     }
                      var string = exbio.output('datauristring');
                        $('#exbiopdf').attr('src', string);
                        $("input[type='checkbox']:checked").each(function() {
                            $(this).attr('checked', false);
                        });
            }

        </script>

        <script>
            $('#users-table').DataTable({
                 processing: true,
                serverSide: true,
                ordering: true,
                 "bInfo" : false,
                 searching: false,
                 "language": {
                "url": '/localisation/fr_FR.json'},
                ajax: 'http://localhost:8000/getAddEditRemoveColumnData',
                columns: [
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'action2', name: 'action2', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        </script>
           <script>
            $('#patient-table-atcd').DataTable({
                 processing: true,
                serverSide: true,
                ordering: true,
                 "bInfo" : false,
                 searching: false,
                 "language": {
                "url": '/localisation/fr_FR.json'},
                ajax: 'http://localhost:8000/getpatientatcd',
                columns: [
                    {data: 'code_barre'},
                    {data: 'Nom'},
                    {data: 'Prenom'},
                    {data: 'Dat_Naissance'},
                    {data: 'Sexe'},
                    {data: 'Type'},
                    {data: 'Adresse'},
                    {data: 'Date_creation'},
                    {data: 'action2', name: 'action2', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "columnDefs": 
                    [
                        {
                            "targets": [ 0 ],
                            "visible": false,
                        }
                    ]
            });
        </script>
        <!-- inline scripts related to this page -->
        <script type="text/javascript">

            $('.show-details-btn').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').next().toggleClass('open');
                    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                });
           jQuery(function($) {
                $('#id-disable-check').on('click', function() {
                    var inp = $('#form-input-readonly').get(0);
                    if(inp.hasAttribute('disabled')) {
                        inp.setAttribute('readonly' , 'true');
                        inp.removeAttribute('disabled');
                        inp.value="This text field is readonly!";
                    }
                    else {
                        inp.setAttribute('disabled' , 'disabled');
                        inp.removeAttribute('readonly');
                        inp.value="This text field is disabled!";
                    }
                });
            
            
                if(!ace.vars['touch']) {
                    $('.chosen-select').chosen({allow_single_deselect:true}); 
                    //resize the chosen on window resize
            
                    $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function() {
                        $('.chosen-select').each(function() {
                             var $this = $(this);
                             $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
                    //resize chosen on sidebar collapse/expand
                    $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                        if(event_name != 'sidebar_collapsed') return;
                        $('.chosen-select').each(function() {
                             var $this = $(this);
                             $this.next().css({'width': $this.parent().width()});
                        })
                    });
            
            
                    $('#chosen-multiple-style .btn').on('click', function(e){
                        var target = $(this).find('input[type=radio]');
                        var which = parseInt(target.val());
                        if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                         else $('#form-field-select-4').removeClass('tag-input-style');
                    });
                }
            
            
                $('[data-rel=tooltip]').tooltip({container:'body'});
                $('[data-rel=popover]').popover({container:'body'});
            
                autosize($('textarea[class*=autosize]'));
                
                $('textarea.limited').inputlimiter({
                    remText: '%n character%s remaining...',
                    limitText: 'max allowed : %n.'
                });
            
                $.mask.definitions['~']='[+-]';
                $('.input-mask-date').mask('99/99/9999');
                $('.input-mask-phone').mask('(999) 999-9999');
                $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
                $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
            
            
            
                $( "#input-size-slider" ).css('width','200px').slider({
                    value:1,
                    range: "min",
                    min: 1,
                    max: 8,
                    step: 1,
                    slide: function( event, ui ) {
                        var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                        var val = parseInt(ui.value);
                        $('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
                    }
                });
            
                $( "#input-span-slider" ).slider({
                    value:1,
                    range: "min",
                    min: 1,
                    max: 12,
                    step: 1,
                    slide: function( event, ui ) {
                        var val = parseInt(ui.value);
                        $('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
                    }
                });
            
            
                
                //"jQuery UI Slider"
                //range slider tooltip example
                $( "#slider-range" ).css('height','200px').slider({
                    orientation: "vertical",
                    range: true,
                    min: 0,
                    max: 100,
                    values: [ 17, 67 ],
                    slide: function( event, ui ) {
                        var val = ui.values[$(ui.handle).index()-1] + "";
            
                        if( !ui.handle.firstChild ) {
                            $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                            .prependTo(ui.handle);
                        }
                        $(ui.handle.firstChild).show().children().eq(1).text(val);
                    }
                }).find('span.ui-slider-handle').on('blur', function(){
                    $(this.firstChild).hide();
                });
                
                
                $( "#slider-range-max" ).slider({
                    range: "max",
                    min: 1,
                    max: 10,
                    value: 2
                });
                
                $( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
                    // read initial values from markup and remove that
                    var value = parseInt( $( this ).text(), 10 );
                    $( this ).empty().slider({
                        value: value,
                        range: "min",
                        animate: true
                        
                    });
                });
                
                $("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
            
                
                $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change',
                    droppable:false,
                    onchange:null,
                    thumbnail:false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
                });
                //pre-show a file name, for example a previously selected file
                //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
            
            
                $('#id-input-file-3').ace_file_input({
                    style: 'well',
                    btn_choose: 'Drop files here or click to choose',
                    btn_change: null,
                    no_icon: 'ace-icon fa fa-cloud-upload',
                    droppable: true,
                    thumbnail: 'small'//large | fit
                    //,icon_remove:null//set null, to hide remove/reset button
                    /**,before_change:function(files, dropped) {
                        //Check an example below
                        //or examples/file-upload.html
                        return true;
                    }*/
                    /**,before_remove : function() {
                        return true;
                    }*/
                    ,
                    preview_error : function(filename, error_code) {
                        //name of the file that failed
                        //error_code values
                        //1 = 'FILE_LOAD_FAILED',
                        //2 = 'IMAGE_LOAD_FAILED',
                        //3 = 'THUMBNAIL_FAILED'
                        //alert(error_code);
                    }
            
                }).on('change', function(){
                    //console.log($(this).data('ace_input_files'));
                    //console.log($(this).data('ace_input_method'));
                });
                
                
                //$('#id-input-file-3')
                //.ace_file_input('show_file_list', [
                    //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
                    //{type: 'file', name: 'hello.txt'}
                //]);
            
                
                
            
                //dynamically change allowed formats by changing allowExt && allowMime function
                $('#id-file-format').removeAttr('checked').on('change', function() {
                    var whitelist_ext, whitelist_mime;
                    var btn_choose
                    var no_icon
                    if(this.checked) {
                        btn_choose = "Drop images here or click to choose";
                        no_icon = "ace-icon fa fa-picture-o";
            
                        whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
                        whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
                    }
                    else {
                        btn_choose = "Drop files here or click to choose";
                        no_icon = "ace-icon fa fa-cloud-upload";
                        
                        whitelist_ext = null;//all extensions are acceptable
                        whitelist_mime = null;//all mimes are acceptable
                    }
                    var file_input = $('#id-input-file-3');
                    file_input
                    .ace_file_input('update_settings',
                    {
                        'btn_choose': btn_choose,
                        'no_icon': no_icon,
                        'allowExt': whitelist_ext,
                        'allowMime': whitelist_mime
                    })
                    file_input.ace_file_input('reset_input');
                    
                    file_input
                    .off('file.error.ace')
                    .on('file.error.ace', function(e, info) {
                                
                    });
             });
            
                $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
                .closest('.ace-spinner')
                .on('changed.fu.spinbox', function(){
                    //console.log($('#spinner1').val())
                }); 
                $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
                $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
                $('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
            
                $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
            
                //or change it into a date range picker
                $('.input-daterange').datepicker({autoclose:true});
            
                $('#simple-colorpicker-1').ace_colorpicker();
                
                var tag_input = $('#form-field-tags');
                try{
                    tag_input.tag(
                      {
                        placeholder:tag_input.attr('placeholder'),
                        //enable typeahead by specifying the source array
                        source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
                      
                      }
                    )
            
                    //programmatically add/remove a tag
                    var $tag_obj = $('#form-field-tags').data('tag');
                    $tag_obj.add('Programmatically Added');
                    
                    var index = $tag_obj.inValues('some tag');
                    $tag_obj.remove(index);
                }
                catch(e) {
                    //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
                    tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
                    //autosize($('#form-field-tags'));
                }
                
                
                /////////
                $('#modal-form input[type=file]').ace_file_input({
                    style:'well',
                    btn_choose:'Drop files here or click to choose',
                    btn_change:null,
                    no_icon:'ace-icon fa fa-cloud-upload',
                    droppable:true,
                    thumbnail:'large'
                })
                
                //chosen plugin inside a modal will have a zero width because the select element is originally hidden
                //and its width cannot be determined.
                //so we set the width after modal is show
                $('#modal-form').on('shown.bs.modal', function () {
                    if(!ace.vars['touch']) {
                        $(this).find('.chosen-container').each(function(){
                            $(this).find('a:first-child').css('width' , '210px');
                            $(this).find('.chosen-drop').css('width' , '210px');
                            $(this).find('.chosen-search input').css('width' , '200px');
                        });
                    }
                })
                /**
                //or you can activate the chosen plugin after modal is shown
                //this way select element becomes visible with dimensions and chosen works as expected
                $('#modal-form').on('shown', function () {
                    $(this).find('.modal-chosen').chosen();
                })
                */

                $(document).one('ajaxloadstart.page', function(e) {
                    autosize.destroy('textarea[class*=autosize]')
                    
                    $('.limiterBox,.autosizejs').remove();
                    $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
                });
            
            });


          function showConsult(consultId,index)
          {
                
                      // $.each( consults[index], function( key, value ) {
                      //                 $("#"+key).val(consults[index][key]);
                                        
                      //                   // $("#histoire_maladie").val(consults[index]['histoire_maladie']);
                      //     });
                     // $("#Resume_OBS").val(consults[index]['Resume_OBS']);
                     // $("#histoire_maladie").val(consults[index]['histoire_maladie']);

                     $.ajax({
                               type : 'get',
                               url : '{{URL::to('/consultations/detailcons/consultId')}}',
                              // data:{'search':nom,'prenom':prenom,'code_barre':code_barre,'Dat_Naissance':date_Naiss},
                               success:function(data,status, xhr){
                                        // $('#liste_patients tbody').html(data);
                                        // $(".numberResult").html(xhr.getResponseHeader("count"));
                                        alert('sdf');
                               }
                     });
                   
          }
         
           $('#user-profile-3').ready(function(){
                     if (window.location.hash == '#edit-password') {
                               $('.nav-tabs li.active').removeClass('active');
                               $('div#edit-basic').removeClass('active');
                               $('li.edit-password').addClass('active');
                               $('div#edit-password').addClass('in active');
                     }
           });
            </script>
            

