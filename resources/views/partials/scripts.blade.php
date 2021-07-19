<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/jspdf.debug.js') }}"></script>
<script  src="{{ asset('/js/html2canvas.js') }}"></script>
<script  src="{{ asset('/js/html2pdf.bundle.min.js') }}"></script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/jquery-ui.min.js')}}"></script> 
<script src="{{asset('/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('/js/jquery.sparkline.index.min.js')}}"></script>
<script src="{{asset('/js/jquery.flot.min.js')}}"></script>
<script src="{{asset('/js/jquery.flot.pie.min.js')}}"></script>
<script src="{{asset('/js/jquery.flot.resize.min.js')}}"></script>
<script src="{{asset('/js/bootbox.min.js')}}"></script>
<script src="{{asset('/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{ asset('/js/jquery.gritter.min.js') }}"></script>
<script src="{{ asset('/js/spin.js') }}"></script>
<script src="{{ asset('/js/moment.min.js') }}"></script> <!-- ace scripts -->
<script src="{{asset('/js/ace-elements.min.js')}}"></script>
<script src="{{asset('/js/ace.min.js')}}"></script><!-- ace scripts -->
<script src="{{ asset('/js/larails.js') }}"></script>
<script src="{{ asset('/js/datatables.js') }}"></script>
<script src="{{ asset('/js/wizard.min.js') }}"></script>
<script src="{{ asset('/js/select2.min.js') }}"></script>
<script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/js/daterangepicker.min.js') }}"></script> 
<script src="{{ asset('/js/autosize.min.js') }}"></script>
<script src="{{ asset('/js/jquery.inputlimiter.min.js') }}"></script>
<script src="{{ asset('/js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('/js/jquery.hotkeys.index.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-multiselect.min.js') }}"></script>
<script src="{{ asset('/js/multiselect.min.js') }}"></script>
<script src="{{ asset('/js/prettify.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('/js/ace-extra.min.js') }}"></script>
<script src="{{ asset('/js/jquery.timepicker.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script src="{{ asset('/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/locale/fr.js') }}"></script>
<script src="{{ asset('/js/jquery-editable-select.js') }}"></script>
<script src="{{asset('/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/js/JsBarcode.all.min.js')}}"></script>
<script src="{{asset('/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('/js/jQuery.print.js')}}"></script>
<script src="{{asset('/js//chart.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/html2pdf.bundle.min.js') }}"></script>
<script type="text/javascript">
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $(document).ready(function(){
             $('.timepicker').timepicker({
                      timeFormat: 'HH:mm',
                      interval: 60,
                      minTime: '08',
                      maxTime: '17:00pm',
                      defaultTime: '08:00',   
                      startTime: '08:00',
                      dynamic: true,
                      dropdown: true,
                      scrollbar: true
              });
              $('.timepicker1').timepicker({
                      minuteStep:30,
                       minTime: '08',
                       maxTime: '18',
                      defaultTime: '08:00',   
                      startTime: '08:00',
                      showMeridian: false
              });
          $( ".autoCommune" ).autocomplete({
              source: function( request, response ) {
                    $.ajax({
                            url:"{{route('commune.getCommunes')}}",
                            type: 'post',
                            dataType: "json",
                            data: {
                               _token: CSRF_TOKEN,
                               search: request.term
                            },
                            success: function( data ) {
                               response( data );
                            }
                    });
              },
              minLength: 3,
             select: function (event, ui) { // Set selection
             $(this).val(ui.item.label); // display the selected text
             switch(event['target']['id'])
             {
                  case "lieunaissance":
                    $("#idlieunaissance").val(ui.item.value);// save selected id to input
                    break;
                  case "lieunaissancef":
                    $("#idlieunaissancef").val(ui.item.value);
                    break;
                  case "commune":
                    $("#idcommune").val(ui.item.value);
                    $("#idwilaya").val(ui.item.wvalue);
                    $("#wilaya").val(ui.item.wlabel);
                    break;
                  case "communef":   
                    $("#idcommunef").val(ui.item.value);
                    $("#idwilayaf").val(ui.item.wvalue);
                    $("#wilayaf").val(ui.item.wlabel);
                    console.log(ui.item.wlabel);
                    break;
                default:
                    break;   

              } 
              return false;
          }
        });
        $( ".autofield" ).autocomplete({
          source: function( request, response ) {
            $.ajax({
                url:"{{route('patients.autoField')}}",
                type: 'post',
                dataType: "json",
                data: {
                   _token: CSRF_TOKEN,
                    q: request.term,
                    field:$(this.element).prop("id"),
                },
                success: function( data ) {
                  response( data );
                }
            });
          },
          minLength: 3,
          select: function (event, ui) {
            $(this).val(ui.item.label);
            field =event['target']['id'];
          }
    });
    $( ".autoUserfield" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
                url:"{{route('users.autoField')}}",
                type: 'post',
                dataType: "json",
                data: {
                   _token: CSRF_TOKEN,
                    q: request.term,
                    field:$(this.element).prop("id"),
                },
                success: function( data ) {
                  response( data );
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {
          $(this).val(ui.item.label);
          field =event['target']['id'];
        }
    });
    $('#printRdv').click(function(){
          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
          });
          $.ajax({
                type : 'GET',
                url :'/rdvprint/'+$('#idRDV').val(),
                success:function(data){},
                error:function(data){
                  console.log("error");
                }
        });
    });
    // $('#printTck').click(function(){
    // })
  $(function() {
      var checkbox = $("#hommeConf");
      checkbox.change(function() {
          if(checkbox.is(":checked"))
            $("#hommelink").removeClass('invisible');
          else
            $("#hommelink").addClass('invisible');  
     })
  });
});
</script>
<script type="text/javascript">
       var active_class = 'active';
       $('#table1 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
        var th_checked = this.checked;//checkbox inside "TH" table header
        $(this).closest('table').find('tbody > tr').each(function(){
        var row = this;
        if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
        else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
        });
    });
     $('#table1').on('click', 'td input[type=checkbox]' , function(){
                    var $row = $(this).closest('tr');
                    if($row.is('.detail-row ')) return;
                    if(this.checked) $row.addClass(active_class);
                    else $row.removeClass(active_class);
                });
</script>   
<script type="text/javascript">
  function isNumeric (evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode (key);
    var regex = /[0-9]|\./;
    if ( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }
  function addRequiredAttr()
  { 
    var classList = $('ul#menuPatient li:eq(0)').attr('class').split(/\s+/);
    $.each(classList, function(index, item) {
      if (item === 'hidden') { 
         $( "ul#menuPatient li:eq(0)" ).removeClass( item );
      }
    });             
    if($('ul#menuPatient li:eq(0)').css('display') == 'none')
    {
      $('ul#menuPatient li:eq(0)').css('display', '');
    }
    $(".starthidden").hide(250);  //$('#description').attr('disabled', true);
    if($("#type").val() != 0)
      $('.Asdemograph').find('*').each(function () {$(this).attr("disabled", false);});
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
</script>
<script type="text/javascript">
  function civilitefan()
  {
      if( $('#mdm').is(':checked') )
           $('#njfid').css('display','block');
      else
           $('#njfid').css('display','none');
  }
  function typepatientfan()
  {
      if( $('#ass').is(':checked') )
          {
              $('#matass').css('display','block'); $('#te').css('display','none');
              $('#infoass').css('display','none');  $('#prof').css('display','none');
          } 
      else
          {
                $('#matass').css('display','none'); $('#prof').css('display','block');$('#infoass').css('display','block');
                $('#te').css('display','block');
          }
  }
 function efface_formulaire() {
           $('form').find("textarea, :text, select").val("").end().find(":checked").prop("checked", false);
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
</script><!-- inline scripts related to this page -->
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
        $(window)//resize the chosen on window resize
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
      });//"jQuery UI Slider"//range slider tooltip example
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
      $( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {  // read initial values from markup and remove that
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
          thumbnail:false //| true | large //whitelist:'gif|png|jpg|jpeg'//blacklist:'exe|php' //onchange:''
      });
      $('#id-input-file-3').ace_file_input({
          style: 'well',
          btn_choose: 'Drop files here or click to choose',
          btn_change: null,
          no_icon: 'ace-icon fa fa-cloud-upload',
          droppable: true,
          thumbnail: 'small' ,//large | fit
          preview_error : function(filename, error_code) {//name of the file that failed //error_code values //1 = 'FILE_LOAD_FAILED',//2 = 'IMAGE_LOAD_FAILED',//3 = 'THUMBNAIL_FAILED'   //alert(error_code);
          }
      }).on('change', function(){ });//console.log($(this).data('ace_input_files')); //console.log($(this).data('ace_input_method'));//dynamically change allowed formats by changing allowExt && allowMime function  
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
        .on('file.error.ace', function(e, info) { });
      });
      $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function(){ });
      $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
      $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
      $('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
      /*$('.date-picker').datepicker({autoclose: true,todayHighlight: true,dateFormat: 'yy-mm-dd',flat: true,calendars: 1,changeYear: true,//language: 'fr', })  .next().on(ace.click_event, function(){    //show datepicker when clicking on the icon $(this).prev().focus(); });*/
      $('.date-picker').datepicker({
              autoclose: true,
              todayHighlight: true,
              dateFormat: 'yy-mm-dd',
              flat: true,
              calendars: 1,//language: 'fr',
              changeYear: true,
              yearRange: "-120:+80"
      }).on('click', function(e) {
            e.preventDefault();
          $(this).attr("autocomplete", "off");  
       }).next().on(ace.click_event, function(){  //show datepicker when clicking on the icon
          $(this).prev().focus();
      });
      $( function() {
           $( ".ltnow" ).datepicker( "option", "maxDate", new Date );  //diable future date
      }); 
      //or change it into a date range picker
      $('.input-daterange').datepicker({autoclose:true});
      $('#simple-colorpicker-1').ace_colorpicker();
      var tag_input = $('#form-field-tags');
      try{
            tag_input.tag(
              {
                placeholder:tag_input.attr('placeholder'),
                source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
              }
            )
            var $tag_obj = $('#form-field-tags').data('tag');
            $tag_obj.add('Programmatically Added');
            var index = $tag_obj.inValues('some tag');
            $tag_obj.remove(index);
      }catch(e) {
           tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
      }
      $('#modal-form input[type=file]').ace_file_input({
          style:'well',
          btn_choose:'Drop files here or click to choose',
          btn_change:null,
          no_icon:'ace-icon fa fa-cloud-upload',
          droppable:true,
          thumbnail:'large'
      })
      $('#modal-form').on('shown.bs.modal', function () {
        if(!ace.vars['touch']) {
          $(this).find('.chosen-container').each(function(){
              $(this).find('a:first-child').css('width' , '210px');
              $(this).find('.chosen-drop').css('width' , '210px');
              $(this).find('.chosen-search input').css('width' , '200px');
          });
        }
      })
      //les maskes
      $('.mobile').mask('0999999999');// $('.mobile').mask('0-999-99-99-99');
      $('.mobileform').mask('99999999');
       $('.nssform').mask('999999999999');
      $('.telfixe').mask('099999999');// $('.telfixe').mask('099-99-99-99');
      $('.nssform').mask('999999999999');
      $(document).one('ajaxloadstart.page', function(e) {
          autosize.destroy('textarea[class*=autosize]')
          $('.limiterBox,.autosizejs').remove();
          $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
      });
    });
    function getMedecinsSpecialite(specialiteId = 0,medId='')
    {
      $('#medecin').empty();
      var specialiteId = 0 ?$('#specialite').val() : specialiteId;
      $.ajax({
              type : 'get',
              url : '{{URL::to('DocorsSearch')}}',
              data:{'specialiteId': specialiteId },
              dataType: 'json',
              success:function(data,status, xhr){
                var html ='<option value="">Selectionner...</option>';
                jQuery(data).each(function(i, med){
                  html += '<option value="'+med.id+'" >'+med.nom +" "+med.prenom+'</option>';
                });
                $('#medecin').removeAttr("disabled");  
                $('#medecin').append(html);//$("#medecin").val(medId);
                if($('#patient').val())
                  $("#btnSave").removeAttr("disabled"); 
              },
              error:function(data){
                console.log(data);
              }
    });   
    }      
      function edit(event)
      {       
        $('#patient_tel').text(event.tel);
        $('#agePatient').text(event.age);
        $('#lien').attr('href','/patient/'.concat(event.idPatient)); 
        $('#lien').text(event.title);
        $("#daterdv").val(event.start.format('YYYY-MM-DD HH:mm'));
        $("#datefinrdv").val(event.end.format('YYYY-MM-DD HH:mm'));
        $('#btnConsulter').attr('href','/consultations/create/'.concat(event.idPatient));
        $('#btnDelete').attr('href','/rdv/'.concat(event.id));
        $('#updateRdv').attr('action','/rdv/'.concat(event.idrdv));
        var url = '{{ route("rdv.update", ":slug") }}'; 
        url = url.replace(':slug',event.id);
        $('#updateRdv').attr('action',url);
       $('#fullCalModal').modal({ show: 'true' }); 
      }
       function ajaxEditEvent(event,bool)
       {
          $.get('/rdv/'+event.id +'/edit', function (data) {
              var html ='';
              $('#specialite').empty();
              jQuery(data.specialites).each(function(i, spec){
                  html += '<option value="'+spec.id+'" >'+spec.nom +'</option>';
              });
              $('#specialite').removeAttr("disabled");  
              $('#specialite').append(html);
              $("#specialite").val(data.rdv.specialite_id);                  
              $('#patient_tel').val(data.rdv.patient.tele_mobile1);
              $('#agePatient').val(event.age);
              $('#lien').attr('href','/patient/'.concat(data.rdv.patient.id)); 
              $('#lien').text(event.title);
              if(bool)
              {
                 $("#daterdv").val(event.start.format('YYYY-MM-DD HH:mm'));
                 $("#meetingdate").val(event.start.format('YYYY-MM-DD'));
                 $("#datefinrdv").val(event.end.format('YYYY-MM-DD HH:mm'));
              }else{
                var date = new Date(data.rdv.Date_RDV);
                $("#daterdv").val(data.rdv.Date_RDV);
                $("#meetingdate").val(date.getFullYear() +'-' + (date.getMonth() + 1) + '-' + date.getDate());
                $("#datefinrdv").val(data.rdv.Fin_RDV); 
              }
              $('#btnConsulter').attr('href','/consultations/create/'.concat(data.rdv.patient.id));
              $('#btnDelete').attr('href','/rdv/'.concat(data.rdv.id));
              var url = '{{ route("rdv.update", ":slug") }}';
              url = url.replace(':slug',data.rdv.id);
              $('#updateRdv').attr('action',url);
              $('#fullCalModal').modal({ show: 'true' });
          });
       } 
      function refrechCal()
      {  
        $('.calendar1').fullCalendar('refetchEvents');
        $('.calendar1').fullCalendar( 'refetchResources' );
        $('.calendar1').fullCalendar('prev');$('.calendar1').fullCalendar('next');    
        $('.calendar1').fullCalendar('rerenderEvents');
      }
      function isEmpty(value) {
        return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
      }
      function ImprimerEtat(className,objID)
      { 
              $("#className").val( className );
              $("#objID").val(objID);
              $('#EtatSortie').modal('show');
      }
      function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
          x.className += " responsive";
        } else {
          x.className = "topnav";
        }
      }
      function htmlspecialchars(str) {
         return str.replace('&', '&amp;').replace('&quot;', '"').replace("'", '&#039;').replace('<', '&lt;').replace('>', '&gt;');
      }
</script>