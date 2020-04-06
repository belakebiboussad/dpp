@extends('app')
@section('style')
<style>
     .fc-agendaWeek-view tr {
          height: 40px;
      }
     .fc-agendaDay-view tr {
          height: 40px;
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
<script>//reccherche par nom
function reset_in()
{
       $('.es-list').val('');
       $('#patient').val('');
       $('#medecin').val('');
}
function layout()
{
       reset_in(); 
       var field = $("select#filtre option").filter(":selected").val();
       if(field == "Dat_Naissance")
       {
            $('#patient').datepicker().format("YYYY-MM-DD");
            $("#btnSave").attr("disabled",false);
       }
      else
       { 
            $("#btnSave").attr("disabled", true);
            $("#patient").datepicker("destroy");
       }
}
$(document).ready(function() {
       var CurrentDate = (new Date()).setHours(23, 59, 59, 0); //.setHours(0, 0, 0, 0); 
       var today = (new Date()).setHours(0, 0, 0, 0); //.setHours(0, 0, 0, 0); 
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
              selectHelper: true,
              eventColor: '#87CEFA',
              contentHeight: 700,
              editable: true,
              eventLimit: true, // allow "more" link when too many events      // displayEventEnd: true,       
              hiddenDays: [ 5, 6 ],
              allDaySlot: false,
              weekNumberCalculation: 'ISO',
              aspectRatio: 1.5,
              disableDragging: false,
              eventDurationEditable : false,
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
                        specialite: {{ $rdv->specialite }}         
                   },
                   @endforeach 
              ],
              select: function(start, end) {
                    $('.calendar1').fullCalendar('unselect');
              },
             eventClick: function(calEvent, jsEvent, view) {
                    if(Date.parse(calEvent.start) > today )
                    {
                          @if(Auth::user()->role_id == 2)
                                $('#updateRDV').removeClass('hidden');
                          @endif
                          $('#idRDV').val(calEvent.id);
                          ajaxEditEvent(calEvent,false);
                    }
              },
              eventRender: function (event, element, webData) {
                   if(event.start < today)
                          element.css('background-color', '#D3D3D3'); 
                    else       
                          element.css("padding", "5px");
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
                          ajaxEditEvent(event,true); //edit(event);
                          $('#updateRDV').removeClass('hidden');
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
       $('#printRdv').click(function(){
             $.ajaxSetup({
                   headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                   }
             });
             $.ajax({
                    type : 'GET',
                    url :'/rdvprint/'+$('#idRDV').val(),
                    data:{id:$('#idRDV').val()},
                    success:function(data){
                    },
                    error:function(data){
                      alert("error");
                    }
             });
       })  
      });
  </script>
@endsection
@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        &nbsp;&nbsp;&nbsp;&nbsp; 
        <div class="panel-heading" style="margin-top:-20px">
          <div class="left"> <strong>Liste des Rendez-Vous</strong></div>
        </div>
        <div class="panel-body">
          <div  class="calendar1"></div>
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
                      Modifier le Rendez-Vous du <q><a href="" id="lien"><span id="patient" class="blue"> </span></a></q>
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
        <form id ="updateRdv" role="form" action="" method="POST">      {{-- {{route('rdv.update',5)}} /rdv/5--}}
            {{ csrf_field() }}
            {{ method_field('PUT') }}
             <input type="hidden" id="idRDV">
             @if(Auth::user()->role->id == 2)
             <div class="well">
                   <div class="row">
                          <label for="medecin"><i class="ace-icon fa  fa-user-md bigger-130"></i><strong>&nbsp;Medecin:</strong></label>
                          <div class="input-group">
                                 <select  placeholder="Selectionner... " class="" id="medecin" name ="medecin" autocomplete="off" style="width:300px;">
                                       <option value="">Selectionner....</option>
                                </select> 
                          </div> 
                    </div>
             </div>
             @endif
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
       <!-- </form>   --> 
      </div>   
      <br>
      <div class="modal-footer">
         @if(Auth::user()->role->id == 1)
            <a type="button" id="btnConsulter" class="btn btn btn-sm btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
        @endif 
         <button type="submit" id ="updateRDV" class="btn btn-sm btn-primary hidden">
              <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer
         </button>
          @if(Auth::user()->role->id == 1)          
              <a  href="" id="btnDelete" class="btn btn-bold btn-sm btn-danger" data-method="DELETE" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal">
                <i class="fa fa-trash" aria-hidden="true"></i> Annuler
              </a>
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
@endsection

