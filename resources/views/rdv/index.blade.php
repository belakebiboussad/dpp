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
@section('page-script')
@include('rdv.scripts.calendar')
@include('rdv.scripts.js')
<script>
function reset_in()
{
  $('.es-list').val('');$('#patient').val('');  $('#medecin').val('');
  $('#printRdv').addClass('hidden');$("#fixe").prop("checked", false);     
}
$(function(){
        var today = (new Date()).setHours(0, 0, 0, 0);
        $('.calendar1').fullCalendar({
            header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
            },
        timeZone: 'local',
        defaultView: 'agendaWeek',  //weekends: false,
        height:650,
        firstDay: 0,
        slotDuration: '00:15:00',
        minTime:'08:00:00',
        maxTime: '17:00:00',
        navLinks: true,
        selectable: true,
        selectHelper: true,// eventColor: '#3A87AD',//contentHeight: 700,//700
        editable: true,
        eventLimit: true, // allow "more" link when too many events      // displayEventEnd: true,       
        hiddenDays: [ 5, 6 ],
        allDaySlot: false,
        weekNumberCalculation: 'ISO',
        aspectRatio: 1.5,
        disableDragging: false,
        eventDurationEditable : false,
        displayEventTime : false, //themeSystem : "Cosmo",
        views: {},
        events: [
              @foreach($rdvs as $rdv)
              {
                  title : '{{ $rdv->patient->full_name }} ' + ', ('+{{ $rdv->patient->age }} +' ans)',
                  start : '{{ $rdv->date }}',
                  end:   '{{ $rdv->fin }}',
                  id :'{{ $rdv->id }}',
                  idPatient:'{{$rdv->patient->id}}',
                  tel:'{{$rdv->patient->tele_mobile1}}',
                  age:{{ $rdv->patient->age }},
                  specialite: {{ $rdv->specialite_id }},
                  medecin : (isEmpty({{ $rdv->employ_id}}))? "": '{{ $rdv->employ_id}}',
                  fixe:  {{ $rdv->fixe }},
                  etat : '{{ $rdv->etat }}',
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
                  if( new Date(calEvent.start).setHours(0, 0, 0, 0) > today)  //&&(!(isEmpty(calEvent.medecin)//(calEvent.fixe) &&
                  {
                           $('#printRdv').attr("href",'/rdvprint/'.concat(calEvent.id)); 
                          if($('#printRdv').hasClass( "hidden" ))
                                 $('#printRdv').removeClass('hidden'); 
                   }
                  if($('#fixe').length &&(calEvent.fixe))
                        $("#fixe"). prop("checked", true);
                  $('#idRDV').val(calEvent.id); 
                  ajaxEditEvent(calEvent,'{{ $appointDoc }}',false);
            }
          },
           eventRender: function (event, element, webData) {
                  if((event.start < today) || (event.etat == 1))
                    element.css('background-color', '#D3D3D3'); 
                  else 
                  {
                    if(event.fixe)
                           element.css('background-color', '#3A87AD'); 
                    else
                            element.css('background-color', '#D6487E');   
                    element.css("padding", "5px");
                  }  
                  element.popover({
                        delay: { "show": 500, "hide": 100 },
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
          eventDrop: function(event, delta, revertFunc)
          {  
            jQuery('#btnclose').click(function(){
                 revertFunc();
            });
            if($('#fixe').length &&(event.fixe))
              $("#fixe"). prop("checked", true);
            ajaxEditEvent(event,'{{ $appointDoc }}',true);          
          },      
        }); // calendar
        $("#specialite" ).change(function() {
          getDoctors($(this).val(),'{{ $appointDoc }}');
        });
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
})
</script>
@endsection
@section('main-content')
<div class="page-header"><h4 >Liste des rendez-vous:</h4></div>
<div class="row">
  <div class="col-md-12">
     <div class="panel panel-default">
          <div class="panel-heading">Rendez-vous</div>
          <div class="panel-body"><div class="calendar1"></div></div>
          <div class="panel-footer">
          <span class="badge label-info"><small>RDV fixe</small></span>
          <span class="badge label-pink"><small>RDV à fixé</small></span>
        </div>
    </div>
  </div>
</div>
<div class="row">@include('rdv.ModalFoms.edit')</div>
@endsection