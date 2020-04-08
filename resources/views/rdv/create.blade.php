@extends('app')
@section('style')
	<style>
          #dialog { display: none; }
      </style>
@endsection
@section('page-script')
<script>
function reset_in()
{
       $('.es-list').val('');  $('#patient').val(''); $('#medecin').val(''); $('#specialite').val(''); 
      $("#medecin").attr("disabled", true);   
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
              contentHeight: 700,
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
              events : [
               		      @foreach($rdvs as $rdv)
                                    {
                                            title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
                                            start : '{{ $rdv->Date_RDV }}',
                                            end:   '{{ $rdv->Fin_RDV }}',
                                            id :'{{ $rdv->id }}',
                                            idPatient:'{{$rdv->patient->id}}',
                                            tel:'{{$rdv->patient->tele_mobile1}}',
                                            age:{{ $rdv->patient->getAge() }},
                                            specialite: {{ $rdv->specialite}},
                                 },
                                  @endforeach 	
              ],
              select: function(start, end) {
                    if(start >= CurrentDate){
                          var myDialog = $('#dialog');
                          myDialog.data('btnValue', start.format('dddd DD-MM-YYYY'));
                          $(myDialog).dialog({
                                 dialogClass: "no-close",
                                 closeText: "Fermer",  // title: 'Confimer Rendez-Vous',
                                 closeOnEscape: false,
                                 dialogClass: "alert",
                                 draggable: true,
                                 modal:true,
                                 resizable: true,
                                 overlay: "background-color: red; opacity: 0.5",
                                 classes: {
                                       "ui-dialog": "classes.ui-dialog"
                                },
                                open: function() {
                                       $('#dateRendezVous').text($(this).data('btnValue')); 
                                },
                                buttons: [
                                       {
                                              text: "Oui",
                                              icon: "ui-icon-heart",
                                              click: function() {
                                                   @if(Auth::user()->role_id == 1)
                                                   {    
                                                           var fixe = $('#dialog :checkbox').is(':checked') ? 1 :0; 
                                                           createRDVModal(start,end,0,fixe);
                                                   }@else
                                                   {
                                                           createRDVModal(start,end);
                                                    }
                                                   @endif
                                                     $( this ).dialog( "close" );
                                             }
                                       },
                                       {
                                              text: "Non",
                                              icon: "ui-icon-heart",
                                              click: function() {
                                                    $( this ).dialog( "close" );
                                              }
                                       }
                                 ],
                                 _allowInteraction: function( event ) {
                                       if (!jQuery.ui.dialog.prototype._allowInteractionModifed) {
                                              jQuery.ui.dialog.prototype._allowInteraction = function(e) {
                                                    if (typeof e !== "undefined") {
                                                          if (jQuery(e.target).closest('.select2-drop').length) {
                                                                 return true;
                                                          }
                                                          jQuery.ui.dialog.prototype._allowInteractionModifed = true;
                                                          return (typeof this._super === "function") ? this._super(e) : this;
                                                    }
                                              }
                                       }
                                }
                           });
                    }else
                          $('#calendar').fullCalendar('unselect');   
             },
            eventClick: function(calEvent, jsEvent, view) {
                    if(Date.parse(calEvent.start) > today )
                    {
                         $('#btnConsulter').attr('href','/consultations/create/'.concat(calEvent.idPatient)); 
                          $('#lien').text(calEvent.title);
                          $("#daterdv").val(calEvent.start.format('YYYY-MM-DD HH:mm'));
                          $('#idRDV').val(calEvent.id);
                          $('#fullCalModal').modal({ show: 'true' });
                    }
              },
             eventRender: function (event, element, webData) {
                      if(event.start < today)  // element.css("font-size", "1em");
                            element.css('background-color', '#D3D3D3');  
                      else
                      {
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
                    patientSearch(field,$("#patient").val()); //to call ajax
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
              <div class="panel-heading" style="">
                <i class="ace-icon fa fa-user"></i><span>Selectionner un Patient</span>
              </div>
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
                    <select  placeholder="Rechercher... " class="nav-search-input" id="patient" name ="patient" autocomplete="off" style="width:300px;" data-date-format="yyyy-mm-dd" required>
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
              <div class="panel-heading" style="">
                <i class="ace-icon fa  fa-user-md bigger-110"></i><span>Selectionner un Medecin</span>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for=""> <strong>Specilité: </strong></label>
                      <div class="col-sm-9">          
                        <select class="form-control" placeholder="choisir le specialite" id="specialite" name="specialite" onchange="getMedecinsSpecialite($(this).val());">
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
            <button class="btn btn-sm btn-primary" type="submit" id ="btnSave" disabled><i class="ace-icon fa fa-save bigger-110" ></i>Enregistrer  </button>                     
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="reset_in();"><i class="fa fa-close" aria-hidden="true"  ></i>Fermer</button>
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
                    <span class="glyphicon glyphicon-bell"></span>
                      Imprimer le Rendez-Vous du <q><a href="" id="lien"><span id="patient" class="blue"> </span></a></q>
            </h5>
            <hr>
            <div class="row">
                    <div class="col-sm-6">    
                         <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" class="blue"></span>
                    </div>
                    <div class="col-sm-6">
                         <strong>Âge:&nbsp;</strong>
                         <span id="agePatient" class="blue"></span> <small>Ans</small>
                    </div>
             </div>
     </div>
      <div class="modal-body">
        <form id ="updateRdv" role="form" action="" method="POST"> 
             <input type="hidden" id="idRDV">         
             <div class="space-12"></div>
             <div class="well">      
                    <div class="row">
                            <label for="date"><span class="glyphicon glyphicon-time fa-lg"></span><strong> Date Rendez-Vous :</strong></label>
                            <div class="input-group">
                              <input class="form-control" id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd HH:mm:ss" readonly/>
                            </div>
                    </div>
                    <div class="row" class= "invisible">
                            <div class="input-group">
                                <input class="form-control" id="datefinrdv" name ="datefinrdv" type="text" data-date-format="yyyy-mm-dd HH:mm:ss" style="display:none"/>
                            </div>
                    </div>             
            </div>  {{-- well --}}
      </div>   
      <br>
      <div class="modal-footer">
            @if(Auth::user()->role->id == 1)
             <a  id="btnConsulter" class="btn btn btn-sm btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
            @endif 
             <a  href ="#" id="printRdv" class="btn btn-success btn-sm"  data-dismiss="modal">
                    <i class="ace-icon fa fa-print"></i>Imprimer
             </a>
             <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"  id ="btnclose" onclick="$('#updateRDV').addClass('hidden');">
                  <i class="fa fa-close" aria-hidden="true" ></i> Fermer
             </button>
      </div>
      </form>  
    </div>
  </div>
</div>{{-- modal --}}
</div>
</div>
@include('rdv.Dialogs.rdvDlg')
@endsection
