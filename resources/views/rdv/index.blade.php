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
      defaultView: 'month',  //weekends: false,
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
        },
        @endforeach 
      ],
      select: function(start, end) {
        $('.calendar1').fullCalendar('unselect');
      },
      eventClick: function(calEvent, jsEvent, view) {
        if(Date.parse(calEvent.start) > today )
        {
            edit(calEvent);
        } 
      },
      eventRender: function (event, element, webData) {
        element.css("font-size", "1em");
        element.find('.fc-title').append("<br/>" + event.tel); 
        if(event.start < CurrentDate)
          element.css('background-color', '#D3D3D3'); 
        else       
          element.css("padding", "5px");      
      },
      eventAllow: function(dropLocation, draggedEvent) {
        var day = moment(draggedEvent.dueDate);
        var eventStart = moment(draggedEvent.start); // var locationtStart = moment(dropLocation.start);
        var day = moment(draggedEvent.dueDate);
        if (eventStart < day) {
            return false;
        }
      },
      eventDragStart:function( event, jsEvent, ui, view ) {
        if(event.start < today )
        {
          event.editable = false;
          resourceEditable: false;
        }
      },
      eventDrop: function(event, delta, revertFunc)
      { 
        // revertFunc();
        if( event.start >= today)
        {
          $('#updateRDV').removeClass('invisible');
          jQuery('#btnclose').click(function(){
            revertFunc();
          });
          edit(event);
        }
      },       
    }); // calendar
      /////////////////////////////////
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
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        &nbsp;&nbsp;&nbsp;&nbsp; 
        <div class="panel-heading" style="margin-top:-20px">
          <div class="left"> <strong>Liste Des Rendez-Vous</strong></div>
        </div>
        <div class="panel-body">
          <div  class="calendar1"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- Modal --> 
    <div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header"  style="padding:35px 50px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
      <h5 class="modal-title" id="myModalLabel">
        <span class="glyphicon glyphicon-bell"></span>
          Modifier Rendez-Vous du <q><a href="" id="lien"><span id="patient" class="blue"> </span></a></q>
      </h5>
      <hr>
           <div class="row">
                <div class="col-sm-6">    
                     <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" class="blue"></span>
                </div>
                <div class="col-sm-6">
                     <strong>Age:&nbsp;</strong>
                     <span id="agePatient" class="blue"></span> <small>Ans</small>
                </div>
              </div>
     </div>
     <div class="modal-body">
        <form id ="updateRdv" role="form" action="" method="POST">      {{-- {{route('rdv.update',5)}} /rdv/5--}}
          {{ csrf_field() }}
          {{ method_field('PUT') }}
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
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"  id ="btnclose" onclick="$('#updateRDV').addClass('hidden');">
         <!-- $('#updateRDV').addClass('hidden');refrechCal(); -->
            <i class="fa fa-close" aria-hidden="true" ></i> Fermer
         </button>
      </div>
      </form>  
    </div>
  </div>
</div>{{-- modal --}}
    </div>

@endsection

