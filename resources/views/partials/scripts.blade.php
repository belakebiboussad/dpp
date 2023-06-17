<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/jspdf.debug.js') }}"></script>
<script  src="{{ asset('/js/html2canvas.js') }}"></script>
<script  src="{{ asset('/js/html2pdf.bundle.min.js') }}"></script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/jquery-ui.min.js')}}"></script> 
<script src="{{asset('/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('/js/jquery.jqGrid.min.js')}}"></script>
<script src="{{asset('/js/grid.locale-fr.js')}}"></script>
<script src="{{asset('/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('/js/jquery.sparkline.index.min.js')}}"></script>
<script src="{{asset('/js/jquery.flot.min.js')}}"></script>
<script src="{{asset('/js/jquery.flot.pie.min.js')}}"></script>
<script src="{{asset('/js/jquery.flot.resize.min.js')}}"></script>
<script src="{{asset('/js/bootbox.min.js')}}"></script>
<script src="{{asset('/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{ asset('/js/jquery.gritter.min.js') }}"></script>
<script src="{{ asset('/js/spin.js') }}"></script>
<script src="{{ asset('/js/moment.min.js') }}"></script> 
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
<script src="{{ asset('/js/tree.min.js') }}"></script>
<script src="{{ asset('/js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('/plugins/fullcalendar/locale/fr.js') }}"></script>
<script src="{{ asset('/js/jquery-editable-select.js') }}"></script>
<script src="{{asset('/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/js/JsBarcode.all.min.js')}}"></script>
<script src="{{asset('/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('/js/jQuery.print.js')}}"></script>
<script src="{{asset('/js/Chart-3-3-2.min.js')}}"></script> 
<script src="{{asset('/js/jquery.mobile.custom.min.js')}}"></script>
<script src="{{asset('/js/jquery-additional-methods.min.js')}}"></script>
<script src="{{asset('/js/bootbox.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/html2pdf.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{asset('/js/quagga.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/js/app.js')}}"></script>
<script type="text/javascript">
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var base64Img = null; 
  var footer64Img = null;
   margins = {
        top: 70,
        bottom: 40,
        left: 30,
        width: 550
  };
  function capturekey(e) {
    e = e || window.event;
    if (e.code == 'F5' || e.which == 17) {//ControlRight/ControlLeft
      e.preventDefault();e.stopPropagation();   
    }
  }
  $(function(){
    $('.timepicker1').timepicker({
              minuteStep:15,
              minTime: '08',
              maxTime: '18',
              defaultTime: '08:00',   
              startTime: '08:00',
              showMeridian: false
    });
    $('.autoCommune1').select2({
        placeholder: 'Selectionner la commune',
        minimumInputLength:3,
        tags: "true",
        width:"100%",
        ajax: {
          url: '{{route('commune.search')}}',
          dataType: 'json',
          type: "GET",
          data: function (data) {
            return {
                search: data.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: $.map(response, function (item) {
                return {
                  text: item.label,
                  id: item.value,
                  wilaya:item.wlabel
                }
              })
            };
          },
        } 
    }).on("select2:select", function (e,ui) {
        switch(e['target']['id'])
        {
            case "idcommune":
              $("#wilaya").val(e.params.data.wilaya);
              break;
            case "idcommunef":
              $("#wilayaf").val(e.params.data.wilaya);
              break;
            default:
                break;   
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
});
</script>
<script type="text/javascript">
       var active_class = 'active';
       $('#table1 > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
        var th_checked = this.checked;
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
<script>
  $('#flash-overlay-modal').modal();
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
          preview_error : function(filename, error_code) {//name of the 
          }
      }).on('change', function(){ });// 
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
              dateFormat: 'MM/DD/YYYY',
              flat: true,
              calendars: 1,
              changeYear: true,
              yearRange: "-120:+80"
      }).on('click', function(e) {
            e.preventDefault();
          $(this).attr("autocomplete", "off");  
       }).next().on(ace.click_event, function(){  //show datepicker when clicking on the icon
          $(this).prev().focus();
      });
      $( function() {
        $(".ltnow").datepicker( "option", "maxDate", new Date ); //disable future date
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
      })//les maskes
      $('.mobile').mask('0999999999');//$('.mobile').mask('0-999-99-99-99'); $('.mobileform').mask('99999999');
      $('.nssform').mask('999999999999');
      $('.telfixe').mask('099999999');//$('.telfixe').mask('099-99-99-99');
      $('.nssform').mask('999999999999');
      $(document).one('ajaxloadstart.page', function(e) {
        autosize.destroy('textarea[class*=autosize]')
        $('.limiterBox,.autosizejs').remove();
        $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
      });
    });
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
      var appointdoc; 
      function getAppwithDocParamVal(param_id, spec_id)
      {
        $('#employ_id').find('option').remove();
        $.get('/param/'+param_id +'/'+spec_id, function (data) {
          if(data.value)
          { 
            $('#employ_id').append('<option value="">Sélectionner...</option>');
            $.each(data.medecins, function(i, empl) {
              $('#employ_id').append($('<option>', {
                  value: empl.id,
                  text: empl.full_name
                }));
              })
            if($('.docPanel').hasClass( "hidden" ))
              $('.docPanel').removeClass('hidden');
            $("#medecinRequired").val(1);
          }else
          {
            $("#medecinRequired").val('');
              if(!$('.docPanel').hasClass( "hidden" ))
                $('.docPanel').addClass('hidden');
          }
        });
      }
      function ajaxEditEvent(event , bool)//bool true fixe else not fixe
      {
        getAppwithDocParamVal(3,event.specialite);
        $.get('/rdv/'+event.id +'/edit', function (data) {
          $("#specialite").val(data.specialite_id);                  
          $("#employ_id").val(data.employ_id);
          $('#nomPatient').val(data.patient.full_name);
          $('#patient_tel').val(data.patient.mob);
          $('#agePatient').val(data.patient.age);
          $('#lien').attr('href','/patient/'.concat(data.patient.id)); 
          $('#lien').text(event.title);
          if(bool)
          {
            $("#daterdv").val(event.start.format('YYYY-MM-DD HH:mm'));
            $("#meetingdate").val(event.start.format('YYYY-MM-DD'));
            $("#datefinrdv").val(event.end.format('YYYY-MM-DD HH:mm'));
          }else{
            var date = new Date(data.date);
            $("#daterdv").val(data.date);
            $("#meetingdate").val(date.getFullYear() +'-' + (date.getMonth() + 1) + '-' + date.getDate());
            $("#datefinrdv").val(data.fin); 
          }
          $('#btnConsulter').attr('href','/consultations/create/'.concat(data.patient.id));
          $('#btnDelete').attr('value',data.id);
          $('#updateRDV').attr('value',data.id); $('#fullCalModal').modal({ show: 'true' });
        });
      } 
      function isEmpty(value) {
        return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
      }
       function ImprimerEtat(type,className,objID)
      {  
             $("#etatsList").empty()
               $.ajax({
                      type: "GET",
                       url: '/gerReports/' + type,
                      success: function (data) {
                            $.each(data,function(key1,etat){
                                    $("#etatsList").append('<li><a class="list-link btn btn-group" target="_blank" href="reportprint/'+className+'/'+ objID+'/'+ etat['id'] + '" >'+ etat['nom'] + '</a></li><br/>');  
                                });  
                      },
                    error: function (data) {
                            console.log('Error:', data);
                    }
          });
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
      $(function(){
        $('.filter').change(function() {
           field = $(this).prop("id"); 
        });
      });
      function FindActiveDiv()
      {  
        var DivName = $('.nav-pills .active a').attr('href');  
        return DivName;
      }
      function ShowInitialTabContent()
      {//RemoveFocusNonActive();
        var DivName = FindActiveDiv();
        if (DivName)
        {
            $(DivName).addClass('active'); 
        } 
      }
      function SelectTab(tabindex)
      {// $('.nav-pills li ').removeClass('active');
        $('.nav-pills li').eq(tabindex).addClass('active'); 
        ShowInitialTabContent();
      }
      $(function(){  
        SelectTab(0); 
      })//pdf report
      function imgToBase64(url, callback, imgVariable) {
        if (!window.FileReader) {
          callback(null);
          return;
        }
        var xhr = new XMLHttpRequest();
        xhr.responseType = 'blob';
        xhr.onload = function() {
          var reader = new FileReader();
          reader.onloadend = function() {
                imgVariable = reader.result.replace('text/xml', 'image/jpeg');
                callback(imgVariable);
          };
          reader.readAsDataURL(xhr.response);
        };
        xhr.open('GET', url);
        xhr.send();
      }
      function header(doc)
      {      
        doc.setFontSize(40);
        doc.setTextColor(40);
        doc.setFontStyle('normal');
        if (base64Img)
          doc.addImage(base64Img, 'JPEG', margins.left, 10, 540,85);       
        //doc.line(10, 95, margins.width + 33,95); // horizontal line
      }
      function headerFooterFormatting(doc, totalPages)
      {
        for(var i = totalPages; i >= 1; i--)
        {    
          doc.setPage(i);                            
          header(doc);
          footer(doc, i);//, totalPages
          doc.page++; 
        }
      }
      function footer(doc, pageNumber){//, totalPages
        doc.setFontSize(40);
        doc.setTextColor(40);
        doc.setFontStyle('normal');
        if (footer64Img)
          doc.addImage(footer64Img, 'JPEG', margins.left, doc.internal.pageSize.height - 50, 540,50);       
      }
     function generate(fileName,pdf,pdfContent)
      {// var pdf = new jsPDF('p', 'pt', 'a4');
        pdf.setFontSize(18);
        pdf.fromHTML(document.getElementById(pdfContent), 
          margins.left,
          margins.top,
          {
            width: margins.width,// max width of content on PDF
          },function(dispose) {
            headerFooterFormatting(pdf, pdf.internal.getNumberOfPages());
            pdf.save(fileName);
          }, 
         margins);
      }
</script>