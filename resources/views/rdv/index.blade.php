@extends('app')
@section('style')
<style>
     .fc-agendaWeek-view tr {
          height: 25px;
      }
     .fc-agendaDay-view tr {
          height: 25px;
     }
     .es-list { 
            max-height: 160px !important;
            margin-left: 0px;
            margin-right: -1  px; 
             overflow-y: scroll;
     }
     .es-list li {
                list-style: none;
      }
     .input-group.md-form.form-sm.form-1 input{
            border: 1px solid #bdbdbd;
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
      }
 </style>
@endsection
@section('page-script') {{-- {!! $planning->script() !!} --}}
<script>
function reset_in()
{
      $('.es-list').val(''); $('#patient').val(''); $('#medecin').val('');
      $('#printRdv').addClass('hidden');
      $("#fixe").prop("checked", false);
}
$(document).ready(function() {
        var today = (new Date()).setHours(0, 0, 0, 0);
       $('.calendar1').fullCalendar({
             header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
             },
              timeZone: 'local',
              defaultView: 'agendaWeek',  //weekends: false,
              firstDay: 0, 
              slotDuration: '00:15:00',
              minTime:'08:00:00',
              maxTime: '17:00:00',
              navLinks: true, // can click day/week names to navigate views
              selectable: true,
              selectHelper: true,// eventColor: '#87CEFA',//contentHeight: 700,//700
              editable: true,
              eventLimit: true, // allow "more" link when too many events      // displayEventEnd: true,       
              hiddenDays: [ 5, 6 ],
              allDaySlot: false,
              weekNumberCalculation: 'ISO',
              aspectRatio: 1.5,
              disableDragging: false,
              eventDurationEditable : false,
               displayEventTime : false,
              views: {},
              events: [
                      @foreach($rdvs as $rdv)
                      {
                            title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
                            start : '{{ $rdv->Date_RDV }}',
                            end:   '{{ $rdv->Fin_RDV }}',
                            id :'{{ $rdv->id }}',
                            idPatient:'{{$rdv->patient->id}}',
                            tel:'{{$rdv->patient->tele_mobile1}}',
                            age:{{ $rdv->patient->getAge() }},
                            specialite: {{ $rdv->specialite }},
                            medecin : (isEmpty({{ $rdv->Employe_ID_Employe}}))? "": '{{ $rdv->Employe_ID_Employe}}',
                            fixe:  {{ $rdv->fixe }},
                            etat : '{{ $rdv->Etat_RDV }}',
                      },
                   @endforeach 
              ],
              select: function(start, end) {
                    $('.calendar1').fullCalendar('unselect');
              },
              eventClick: function(calEvent, jsEvent, view) {
                      if(Date.parse(calEvent.start) > today && (calEvent.etat != 1) ) 
                      {
                          reset_in(); 
                          if(calEvent.fixe &&(!(isEmpty(calEvent.medecin))))
                                $('#printRdv').removeClass('hidden'); 
                         
                          if($('#fixe').length &&(calEvent.fixe))
                                $("#fixe"). prop("checked", true);
                          $('#idRDV').val(calEvent.id);
                          ajaxEditEvent(calEvent,false);
                    }
              },
              eventRender: function (event, element, webData) {
                      if((event.start < today) || (event.etat == 1))
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
              eventAllow: function(dropLocation, draggedEvent) {
                   if (draggedEvent.start < today)  
                          return false;
              },
             eventDragStart:function( event, jsEvent, ui, view ) {
              },
             eventDrop: function(event, delta, revertFunc)
             { 
                if( event.start-delta >= today)
                { 
                       jQuery('#btnclose').click(function(){
                          revertFunc();
                        });
                       if($('#fixe').length &&(event.fixe))
                               $("#fixe"). prop("checked", true);
                        ajaxEditEvent(event,true);          
              }
              else
              {
                    revertFunc();
              }
              },  
             eventMouseover: function(event, jsEvent, view){
             },     
       }); // calendar
       $('#patient').editableSelect({
               effects: 'default', 
                editable: false, 
       }).on('select.editable-select', function (e, li) {
                     $('#last-selected').html(
                             li.val() + '. ' + li.text()
                      );
                     $("#btnSave").removeAttr("disabled");
       });
       $("#patient").on("keyup", function() {
             var field = $("select#filtre option").filter(":selected").val();
             if(field != "Dat_Naissance")
                    remoteSearch(field,$("#patient").val()); //to call ajax
       });
       });
  </script>
@endsection
@section('main-content')
<div class="row"  style="margin-left:-2%;">{{-- margin-top:-2%; --}}
  <div class="col-md-12">
    <div class="panel panel-default">
          <div class="panel-heading"><div class="left"> <strong>Liste des Rendez-Vous</strong></div></div>
          <div class="panel-body">
                <div  class="calendar1"></div>
          </div>
        <div class="panel-footer">
          <span class="badge" style="background-color:#87CEFA">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px"><strong>&nbsp;RDV fixe</strong></span>
          <span class="badge" style="background-color:#378006">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px"><strong>&nbsp;RDV à fixer</strong></span> 
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
            <span class="glyphicon glyphicon-bell"></span> Modifier le Rendez-Vous du
              <i class="ace-icon fa fa-angle-double-left" style="font-size:20px;"></i>
              <a href="" id="lien" style="color:#FFFFFF"> <p id="patient"></p></a>
              <i class="ace-icon fa fa-angle-double-right" style="font-size:20px;"></i>
          </h5><hr>
       <div class="row">
            <div class="col-sm-6">    
              <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong>
              <span id="patient_tel" style="color:#FFFFFF"></span>
            </div>
            <div class="col-sm-6">
              <strong>Âge:&nbsp;</strong><span id="agePatient" class="badge badge-info" ></span><small>Ans</small>
            </div>
          </div>
          </div> {{-- modal-header --}}
          <form id ="updateRdv" role="form" action="" method="POST"> 
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <input type="hidden" id="idRDV">
              <input  id="datefinrdv" name ="datefinrdv" type="hidden" />
              @if(Auth::user()->role->id == 2)
              <div class="well">
                <div class="row">
                  <div class="col-sm-12">                   
                    <label for="medecin"><i class="ace-icon fa  fa-user-md bigger-130"></i><strong>&nbsp;Medecin:</strong></label>
                    <div class="input-group">
                      <select  placeholder="Selectionner... " class="" id="medecin" name ="medecin" autocomplete="off" style="width:300px;">
                        <option value="">Selectionner....</option>
                      </select> 
                    </div> 
                  </div>
                </div>
              </div>
              @endif
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
                              <input type="checkbox" class="ace" id="fixe" name="fixe" />
                              <span class="lbl">Fixe </span>
                            </label>
                          </div>
                        </div>
                    </fieldset>      
                  <br>
                  </div> 
              </div>
            </div>  
            </div> {{-- modal-body --}} 
            <div class="modal-footer">
              @if(Auth::user()->role->id == 1)
              <a type="button" id="btnConsulter" class="btn btn btn-xs btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
              @endif 
              <button type="submit" id ="updateRDV" class="btn btn-primary btn-xs">
                <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer
              </button>
              @if(Auth::user()->role->id == 1)          
              <a  href="" id="btnDelete" class="btn btn-bold btn-xs btn-danger" data-method="DELETE" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal">
                <i class="fa fa-trash" aria-hidden="true"></i> Annuler
              </a>
              @endif
              <a  href ="#" id="printRdv" class="btn btn-success btn-xs hidden"  data-dismiss="modal">
                <i class="ace-icon fa fa-print"></i>Imprimer
              </a> 
              <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"  id ="btnclose" onclick="reset_in();">
                <i class="fa fa-close" aria-hidden="true" ></i> Fermer
              </button>
            </div> {{-- modal-header --}}
          </form>  
        </div>{{-- modal-content --}}
      </div>
    </div>{{-- modal --}}
</div>
@endsection

