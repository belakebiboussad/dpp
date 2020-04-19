@extends('app')
@section('style')
	<style>
    /*#dialog { display: none; }*/
  .make-scrolling {
   overflow-y: scroll;
    height: 100px;
  }
  .wrapper{
    width:200px;
    padding:20px;
    height: 150px;
  }
  </style>
@endsection
@section('page-script')
<script>
var rdvs = @json($rdvs);
function resetaddModIn()
{
  $('.es-list').val(''); $('#patient').val(''); $('#medecin').val(''); $('#specialite').val('');  $("#medecin").attr("disabled", true);   
}
function resetPrintModIn()
{
  $('#doctor').val('');$('#printRdv').addClass('hidden')
}
$(document).ready(function() {
       var CurrentDate = (new Date()).setHours(23, 59, 59, 0); 
      var today = (new Date()).setHours(0, 0, 0, 0); 
   	$('#calendar').fullCalendar({
              header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
              },
             timeZone: 'local',
             defaultView: 'agendaWeek',
              firstDay: 0, 
              slotDuration: '00:15:00',
              minTime:'08:00:00',
              maxTime: '17:00:00',
              navLinks: true,
              selectable: true,
              selectHelper: true, 
              eventColor: '#87CEFA',
              editable: true,
              eventLimit: true,     
              hiddenDays: [ 5, 6 ],
              allDaySlot: false,
              weekNumberCalculation: 'ISO',
              aspectRatio: 1.5,        // disableDragging: true,
              eventStartEditable : false,
              eventDurationEditable : false,  // columnHeaderFormat: 'dddd',//affichelndi/mardi 
              weekNumbers: true,
              aspectRatio: 2,
              displayEventTime : false,
              views: {},
              events :[
                        @foreach($rdvs as $key =>   $rdv)
                        {
                          title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
                          start : '{{ $rdv->Date_RDV }}',
                          end:   '{{ $rdv->Fin_RDV }}',
                          id :'{{ $rdv->id }}',
                          idPatient:'{{$rdv->patient->id}}',
                          tel:'{{$rdv->patient->tele_mobile1}}',
                          age:{{ $rdv->patient->getAge() }},
                          specialite: {{ $rdv->specialite}},
                          key :(isEmpty({{ $rdv->Employe_ID_Employe }}))? "":'{{ $key }}',
                          fixe:  {{ $rdv->fixe }},
                        },
                        @endforeach   
              ], 
              select: function(start, end) {
                        if(start >= CurrentDate){                                           
                          @if(Auth::user()->role_id == 1)
                          Swal.fire({
                                 title: 'Confimer vous  le Rendez-Vous ?',
                                 html: '<br/><h4><strong id="dateRendezVous">'+start.format('dddd DD-MM-YYYY')+'</strong></h4>',
                                 input: 'checkbox',
                                 inputPlaceholder: 'Redez-Vous Fixe',
                                 showCancelButton: true,
                                 confirmButtonColor: '#3085d6',
                                 cancelButtonColor: '#d33',
                                 confirmButtonText: 'Oui',
                                 cancelButtonText: "Non",
                          }).then((result) => {
                               if(!isEmpty(result.value))
                                {                                
                                       @if(Auth::user()->role_id == 1)
                                            createRDVModal(start,end,0,result.value);
                                       @else
                                             createRDVModal(start,end);
                                       @endif          
                                }
                        })
                        @else
                          createRDVModal(start,end);
                        @endif  
/*var myDialog = $('#dialog');myDialog.data('btnValue', start.format('dddd DD-MM-YYYY'));$(myDialog).dialog({dialogClass: "no-close",closeText: "Fermer",closeOnEscape: false,dialogClass: "alert",draggable: true,modal:true,resizable: true,overlay: "background-color: red; opacity: 0.5",classes: {"ui-dialog": "classes.ui-dialog"},open: function() {
$('#dateRendezVous').text($(this).data('btnValue')); },buttons: [{text: "Oui",icon: "ui-icon-heart",click: function() {   {{-- @if(Auth::user()->role_id == 1)--}}{var fixe = $('#dialog :checkbox').is(':checked') ? 1 :0; createRDVModal(start,end,0,fixe);{{-- }@else--}}createRDVModal(start,end);{{--    @endif --}}$('#dialog :checkbox').prop('checked', false);$( this ).dialog( "close" );
} },{text: "Non",icon: "ui-icon-heart",click: function(){$('#dialog :checkbox').prop('checked', false);$( this ).dialog( "close" );}}], _allowInteraction: function( event ) {if (!jQuery.ui.dialog.prototype._allowInteractionModifed){jQuery.ui.dialog.prototype._allowInteraction = function(e) {if (typeof e !== "undefined") {if (jQuery(e.target).closest('.select2-drop').length) {return true;}jQuery.ui.dialog.prototype._allowInteractionModifed = true;return (typeof this._super === "function") ? this._super(e) : this;} }}}});*/
                    }else
                          $('#calendar').fullCalendar('unselect');   
              },
              eventClick: function(calEvent, jsEvent, view) {
                    if(Date.parse(calEvent.start) > today )
                    {
                          $('#lien').text(calEvent.title); 
                          $('#patient_tel').text(calEvent.tel);
                          $('#agePatient').text(calEvent.age); 
                          $('#idRDV').val(calEvent.id);
                          if($('#doctor').length && !(isEmpty(calEvent.key)))
                                 $('#doctor').val(rdvs[calEvent.key]['employe'].Nom_Employe+" "+rdvs[calEvent.key]['employe'].Prenom_Employe);
                          $("#daterdv").val(calEvent.start.format('YYYY-MM-DD HH:mm'));
                          (calEvent.fixe==1) ? $("#fixecbx").prop('checked', true):$("#fixecbx").prop('checked', false); 
                          $('#btnConsulter').attr('href','/consultations/create/'.concat(calEvent.idPatient)); 
                           if(calEvent.fixe &&(!(isEmpty(calEvent.key))))
                                $('#printRdv').removeClass('hidden');
                          $('#fullCalModal').modal({ show: 'true' });
                    }
              },
             eventRender: function (event, element, webData) {
                      if(event.start < today)  // element.css("font-size", "1em");
                        element.css('background-color', '#D3D3D3');  
                      else
                      {
                        if(event.fixe)
                          element.css('background-color', '#87CEFA'); 
                        else
                          element.css('background-color', '#378006');   
                        element.css("padding", "5px");
                      }
                    element.popover({
                                 delay: { "show": 500, "hide": 100 },  // title: event.title,
                                content: event.tel,
                                 trigger: 'hover',
                                animation:true,
                                placement: 'bottom',
                                container: 'body',
                                template:'<div class="popover" role="tooltip"><div class="arrow"></div><h6 class="popover-header">'+event.tel+'</h6><div class="popover-body"></div></div>',
                    });       
             },
             eventMouseover: function(event, jsEvent, view) {
             }
       });//calendar
      $('#patient').editableSelect({
             effects: 'default', 
             editable: false, 
       }).on('select.editable-select', function (e, li) {
              $('#last-selected').html(
                    li.val() + '. ' + li.text()
              ); 
             @if(Auth::user()->role_id == 1)
                   $("#btnSave").removeAttr("disabled");
            @else
            {
                    $('#medecin').val() != '';
                    $("#btnSave").removeAttr("disabled");
            }
             @endif
       });
      $("#patient").on("keyup", function() {
        var field = $("select#filtre option").filter(":selected").val();
        if(field != "Dat_Naissance")
          //patientSearch(field,$("#patient").val()); //to call ajax
          ////////////////////////////
          $.ajax({
                  url : '{{URL::to('getPatients')}}',
                  data: {    
                        "field":field,
                        "value":$("#patient").val(),
                  },
                  dataType: "json",// recommended response type
                  success: function(data) {
                    $(".es-list").html("");//remove list
                    $(".es-list").addClass("make-scrolling");
                    $.each(data['data'], function(i, v) {
                      $(".es-list").append($('<li></li>').attr('value', v['id']).attr('class','es-visible list-group-item option').text(v['code_barre']+"-"+v['Nom']+"-"+v['Prenom']));
                    })
                    //
                     
                    //
                    
                  },
                  error: function() {
                    alert("can't connect to db");
                  }
            });
          ////////////////////////

       });
      $( "#medecin" ).change(function() {
              if($('#patient').val())
                    $("#btnSave").removeAttr("disabled"); 
      });
      $('#printRdv').click(function(){
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                   }
             });
             $.ajax({
                    type : 'GET',
                    url :'/rdv/print/'+$('#idRDV').val(),
                    success:function(data){
                    },
                    error:function(data){
                      console.log("error");
                    }
             });
       })  
});
  // });
 </script>
@endsection
@section('main-content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      &nbsp;&nbsp;&nbsp;&nbsp; 
      <div class="panel-heading" style="margin-top:-20px">
        <div class="left"> <strong>Ajouter un Rendez-Vous</strong></div>
      </div>
      <div class="panel-body">
        <div id='calendar'></div>
      </div>
      <div class="panel-footer">
        <span class="badge" style="background-color:#87CEFA">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px"><strong>&nbsp;RDV fixe</strong></span>
        <span class="badge" style="background-color:#378006">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px">&nbsp;RDV à fixer<strong></strong></span> 
      </div>
    </div>
  </div>
</div>
<div class="row">   
  <div id="addRDVModal" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
        </div>
        <form id ="addRdv" role="form" action="/createRDV" method="POST">
          {{ csrf_field() }}
          <input type="hidden" id="Debut_RDV" name="Debut_RDV" value="">
          <input type="hidden" id="Fin_RDV" name="Fin_RDV"  value="" >
          <input type="hidden" id="fixe" name="fixe"  value="" >
          <!-- <input type="time" id="Temp_rdv" name="Temp_rdv"  value=""  min="8:00" max="18:00" style="display:none;" > -->
          <div id="modalBody" class="modal-body" style="padding:40px 50px;">
             <div class="panel panel-default">
                <div class="panel-heading"> <i class="ace-icon fa fa-user"></i><span>Selectionner un Patient</span></div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label class="control-label col-sm-3" for=""> <strong>Filtre: </strong></label>
                          <div class="col-sm-9">          
                            <select class="form-control" placeholder="choisir le filtre" id="filtre" onchange="layout();">
                              <option value="Nom">Nom</option>
                              <option value="Prenom">Prenom</option>
                              <option value="code_barre">IPP</option>
                              <option value="Dat_Naissance">Date Naisssance</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <span class="input-icon" style="margin-right: -190px;">
                        <select placeholder="Rechercher... " class="nav-search-input" id="patient" name ="patient" autocomplete="off" style="width:300px;" data-date-format="yyyy-mm-dd" required>
                          @if(isset($patient))
                            <option value="{{$patient->id}}" selected>{{ $patient->code_barre }}-{{ $patient->Nom }}-{{ $patient->Prenom }}</option>
                          @endif
                        </select>
                        <i class="ace-icon fa fa-search nav-search-icon"></i>   
                        </span>   
                      </div>                               
                </div>                                                  
              </div> {{-- panel-body --}}
              <div class="space-12"></div>
              @if(Auth::user()->role_id == 2)
              <div class="panel-heading">
                <i class="ace-icon fa  fa-user-md bigger-110"></i><span>Selectionner un Medecin</span>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for=""> <strong>Specilité: </strong></label>
                      <div class="col-sm-9 overflow-auto">
                        <select class="form-control" placeholder="choisir la specialite" id="specialite" name="specialite" onchange="getMedecinsSpecialite($(this).val());">
                          <option value="" disabled selected>Selectionner....</option>
                          @foreach($specialites as $specialite)
                          <option value="{{ $specialite->id}}">{{  $specialite->nom }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <span class="input-icon" style="margin-right: -190px;">
                      <select  placeholder="Selectionner... " class="" id="medecin" name ="medecin" autocomplete="off" style="width:300px;" disabled>
                        <option value="" disabled selected>Selectionner....</option>
                      </select>
                    </span>   
                  </div>                               
                </div>                                                 
              </div> {{-- panel-body --}}
              @endif
            </div>{{-- panel --}}
          </div>{{-- modalBody --}}
          <div class="modal-footer">
            <button class="btn btn-xs btn-primary" type="submit" id ="btnSave" disabled><i class="ace-icon fa fa-save bigger-110" ></i>Enregistrer  </button>                     
            <button type="button" class="btn btn-xs btn-default" data-dismiss="modal" onclick="resetaddModIn();"><i class="fa fa-close" aria-hidden="true"  ></i>Fermer</button>
          </div>   
        </form> 
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  {{-- Modal --}}
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header"  style="padding:35px 50px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            <h5 class="modal-title" id="myModalLabel">
              <span class="glyphicon glyphicon-bell"></span>Imprimer le Rendez-Vous du <q><a href="" id="lien"><span id="patient" class="blue"> </span></a></q>
            </h5>
            <hr>
            <div class="row">
              <div class="col-sm-6">    
                <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" class="blue"></span>
              </div>
              <div class="col-sm-6">
                <strong>Âge:&nbsp;</strong><span id="agePatient" class="blue"></span> <small>Ans</small>
              </div>
            </div>
          </div>
        <form id ="updateRdv" role="form" action="" method="POST"> 
             <div class="modal-body">
                    <input type="hidden" id="idRDV">         
                    <div class="well">      
                          <div class="row">
                                <label for="doctor"><i class="ace-icon fa  fa-user-md bigger-130"></i><strong>&nbsp;Medecin:</strong></label>
                                 <div class="input-group">
                                     <input type="text" id="doctor" name ="doctor" style="width:300px;" disabled/>
                                 </div>
                    </div>
                    </div>
                   <div class="well">
                         <div class="row">
                                <div class="col-sm-6">
                                       <fieldset class="scheduler-border">
                                             <legend class="scheduler-border">Rendez-Vous</legend>
                                              <div class="control-group">
                                                <label class="control-label input-label" for="startTime">Date :</label>
                                                <div class="controls bootstrap-timepicker">
                                                  <input type="text" class="datetime" id="daterdv" name="daterdv" data-date-format="yyyy-mm-dd HH:mm" readonly   />
                                                  <span class="glyphicon glyphicon-time fa-lg"></span> 
                                                </div>
                                              </div>
                                       </fieldset>
                                </div>
                                <div class="col-sm-6">
                                       <fieldset class="scheduler-border"   style="height:126px;">
                                             <legend class="scheduler-border">Type Rendez-Vous</legend>
                                             <div class="form-group">
                                                   <div class="form-check">
                                                    <br>
                                                    <label class="block">
                                                      <input type="checkbox" class="ace" id="fixecbx" name="fixecbx" disabled/>
                                                      <span class="lbl">Fixe </span>
                                                    </label>
                                                    </div>
                                             </div>
                                      </fieldset>      
                                       <br>
                                </div> 
                          </div>
                    </div>
              </div>  
            <div class="modal-footer">
            @if(Auth::user()->role->id == 1)
             <a  id="btnConsulter" class="btn btn btn-xs btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
            @endif 
             <a  href ="#" id="printRdv" class="btn btn-success btn-xs hidden"  data-dismiss="modal">
                <i class="ace-icon fa fa-print"></i>Imprimer
             </a>
             <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"  id ="btnclose" onclick="resetPrintModIn();">
                <i class="fa fa-close" aria-hidden="true" ></i> Fermer
             </button>
          </div>
        </form>  
    </div>  {{-- modal-content --}}
  </div> {{-- modal-dialog --}}
</div>{{-- modal --}}
</div>
@include('rdv.Dialogs.rdvDlg')
@endsection
