<!-- basic scripts -->

<!--[if !IE]> -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jspdf.debug.js') }}"></script>
<script src="{{ asset('/js/html2pdf.js') }}"></script>
 <script type="text/javascript">
     if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
</script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/jquery-ui.custom.min.js')}}"></script>
<script src="{{asset('/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('/js/bootbox.js')}}"></script>
<script src="{{asset('/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('/js/jquery.gritter.min.js')}}"></script>
 <script src="{{asset('/js/spin.js')}}"></script>

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
<script src="{{ asset('/js/date-time/moment.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('/js/autosize.min.js') }}"></script>
<script src="{{ asset('/js/jquery.inputlimiter.min.js') }}"></script>
<script src="{{ asset('/js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('/js/jquery.hotkeys.index.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-tagsinput-angular.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-switch/main.js') }}"></script>
<script src="{{ asset('/js/bootstrap-switch/highlight.js') }}"></script>
<script type="text/javascript">
function typep()
{
    if($('#fonc').is(':checked'))
    {
        $('#foncinput').css('display', 'block');
        $('#nssinput').css('display', 'block');
        $('#matinput').css('display', 'block');
        $('#foncform').css('display', 'none');
        $('#typepp').css('display', 'none');
    }
    else
    {
           if('#ayant').is(':checked')
           {
                  $('#foncinput').css('display', 'none');
                  $('#nssinput').css('display', 'none');
                  $('#matinput').css('display', 'none');
                  $('#foncform').css('display', 'block');  
                 $('#typepp').css('display', 'block'); 
           }else
           {
                    $('#foncinput').css('display', 'none');
                    $('#nssinput').css('display', 'non');
                    $('#matinput').css('display', 'none');
                    $('#foncform').css('display', 'none');
                    $('#typepp').css('display', 'none');              
                    $('#matinput').css('display', 'block');
           }
            
    }
}
$('#typeexm').on('change', function() {
    if($("#typeexm").val() == "CM")
    {
        $('#details').val('Je déclare que le patient nécessite un arrét de travail de 00 jours(s) a compter de '+$('#datedem').val());
    }
    else if($("#typeexm").val() == "AB")
    {
        $('#details').val('');
        $('#details').val('dfgdgfggd');
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
                    
                    }
                 });
            }
            function posologiefun()
            {
                $("#pos").val( $("#nbprise").val()+' fois par '+$("#fois").val()+' Pendant '+$("#duree").val()+' '+$("#dureefois").val()+'. '+$("#temps").val()+'.');
                
            }
            // function addmidifun()
            // {
            //     $("#ordonnance").append("<tr><td class='center'><label class='pos-rel'><input type='checkbox' class='ace'/><span class='lbl'></span></label></td><td>" + $("#nommedic").text() + "</td><td>" + $("#forme").text() + "</td><td>" + $("#qte").val() +"</td><td>"+$("#pos").val()+"</td></tr>");
            // }
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
                    {
                        $('#matass').css('display','none');
                        $('#prof').css('display','block');
                        $('#infoass').css('display','block');
                        $('#te').css('display','block');
                    }
//function atcd(){if($('#type_atcd').val() == 'Personnels')$('#sous_type').css('display','block');else{$('#sous_type').css('display','none');$('#sous_type_atcd').val() = null;}} 
        </script>
        <script>
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
// function storeord() // { // var arrayLignes = document.getElementById("ordonnance").rows;//var longueur = arrayLignes.length; //var tab = [];//for(var i=1; i<longueur; i++)//{//tab[i]=arrayLignes[i].cells[1].innerHTML +" "+arrayLignes[i].cells[2].innerHTML+" "+arrayLignes[i].cells[4].innerHTML;//}// var champ = $("<input type='text' name ='liste' value='"+tab.toString()+"' hidden>");            //     champ.appendTo('#ordonnace_form');            //     $('#ordonnace_form').submit();            // }
            function createexbio(nomp,prenomp){
                var exbio = new jsPDF();
                exbio.text(200,20, 'Date :.....................', null, null, 'right');
                exbio.text(20,25, 'Nom : '+nomp, null, null);
                exbio.text(20,35, 'Prénom : '+prenomp, null, null);
                exbio.text(20,45, 'Age :........................................', null, null);
                exbio.setFontType("bold");
                exbio.text(105,55, 'Priére de faire', null, null, 'center');
                exbio.setFontSize(14);
                exbio.text(45,65,'Analyses Demandées :',null,null,'center');
                exbio.setFontSize(13);
                var i =0;
                $("input[type='checkbox']:checked").each(function() {
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
        </script>

        <script>
            $('#dynamic-table').DataTable({
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
                    {data: 'action1', name: 'action1', orderable: false, searchable: false},
                    {data: 'action2', name: 'action2', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        </script>
        <script>
            $('#medc_table').DataTable({
                 processing: true,
                serverSide: true,
                ajax: 'http://localhost:8000/getmedicaments',
                columns: [
                    {data: 'Nom_com'},
                    {data: 'Forme'},
                    {data: 'Dosage'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        </script>
        <script>
            // $('#rdv_table').DataTable({
            //      processing: true,
            //     serverSide: true,
            //     ajax: 'http://localhost:8000/getrdv',
            //     columns: [
            //         {data: 'action5', name: 'action', orderable: false, searchable: false},
            //         {data: 'action4', name: 'action', orderable: false, searchable: false},
            //         {data: 'action3', name: 'action', orderable: false, searchable: false},
            //         {data: 'action1', name: 'action', orderable: false, searchable: false},
            //         {data: 'action2', name: 'action', orderable: false, searchable: false},
            //         {data: 'action', name: 'action', orderable: false, searchable: false}
            //     ]
            // });
        </script>

        <script>
/*$('#listepatient-table').DataTable({ processing: true,serverSide: true,ajax: '/getpatient',columns: [{data: 'code_barre'},{data: 'Nom'},
{data: 'Prenom'},{data: 'Dat_Naissance'},{data: 'Sexe'},{data: 'Date_creation'},{data: 'action', name: 'action', orderable: false, searchable: false}
],"columnDefs":[{"targets": [ 0 ],"visible": false,}]});*/
        </script>
        <script>
            $('#patient-table').DataTable({
                 processing: true,
                serverSide: true,
                ajax: 'http://localhost:8000/getpatientcons',
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
        <script>
            $('#patient-table-rdv').DataTable({
                 processing: true,
                serverSide: true,
                ajax: 'http://localhost:8000/getpatientrdv',
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
         <script>
            $('#patient-table-atcd').DataTable({
                 processing: true,
                serverSide: true,
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
                        //console.log(info.file_count);//number of selected files
                        //console.log(info.invalid_count);//number of invalid files
                        //console.log(info.error_list);//a list of errors in the following format
                        
                        //info.error_count['ext']
                        //info.error_count['mime']
                        //info.error_count['size']
                        
                        //info.error_list['ext']  = [list of file names with invalid extension]
                        //info.error_list['mime'] = [list of file names with invalid mimetype]
                        //info.error_list['size'] = [list of file names with invalid size]
                        
                        
                        /**
                        if( !info.dropped ) {
                            //perhapse reset file field if files have been selected, and there are invalid files among them
                            //when files are dropped, only valid files will be added to our file array
                            e.preventDefault();//it will rest input
                        }
                        */
                        
                        
                        //if files have been selected (not dropped), you can choose to reset input
                        //because browser keeps all selected files anyway and this cannot be changed
                        //we can only reset file field to become empty again
                        //on any case you still should check files with your server side script
                        //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
                    });
                    
                    
                    /**
                    file_input
                    .off('file.preview.ace')
                    .on('file.preview.ace', function(e, info) {
                        console.log(info.file.width);
                        console.log(info.file.height);
                        e.preventDefault();//to prevent preview
                    });
                    */
                
                });
            
                $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
                .closest('.ace-spinner')
                .on('changed.fu.spinbox', function(){
                    //console.log($('#spinner1').val())
                }); 
                $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
                $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
                $('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
            
                //$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
                //or
                //$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
                //$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
            
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
            
                //or change it into a date range picker
                $('.input-daterange').datepicker({autoclose:true});
                $('#simple-colorpicker-1').ace_colorpicker();
                //$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
                //$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
                //var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
                //picker.pick('red', true);//insert the color if it doesn't exist
            
            
                // $(".knob").knob();
                
                
                var tag_input = $('#form-field-tags');
                try{
                    tag_input.tag(
                      {
                        placeholder:tag_input.attr('placeholder'),//enable typeahead by specifying the source array
                        source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
                        /**
                        //or fetch data from database, fetch those that match "query"
                        source: function(query, process) {
                          $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                          .done(function(result_items){
                            process(result_items);
                          });
                        }
                        */
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
            </script>
