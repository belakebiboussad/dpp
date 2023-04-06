@extends('app')
@section('page-script')
 @include('rdv.scripts.calendar')
 @include('rdv.scripts.js')
<script>
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
              selectHelper: true,
              editable: true,
              eventLimit: true, 
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
                        title : '{{ $rdv->patient->full_name  }} ' +', ('+{{ $rdv->patient->age }} +' ans)',
                        start : '{{ $rdv->date }}',
                        end:   '{{ $rdv->fin }}',
                        id :'{{ $rdv->id }}',
                        idPatient:'{{$rdv->patient->id}}',
                        tel:'{{$rdv->patient->tele_mobile1}}',
                        age:{{ $rdv->patient->age }},
                        specialite: {{ $rdv->specialite_id }},
                        medecin : (isEmpty({{ $rdv->employ_id}}))? "": '{{ $rdv->employ_id}}',
                        fixe:  {{ $rdv->fixe }},
                        etat : '{{ $rdv->Etat_RDV }}',   
                    },
                   @endforeach 	
                ],
                eventRender: function (event, element, webData) {
      	         
                  if(event.id == {{$rdv->id}})
                    if(event.fixe)
                      element.css('background-color', '#3A87AD'); 
                    else
                      element.css('background-color', '#D6487E');   
                  else
                    element.css('background-color', '#D3D3D3');
                  element.css("padding", "5px");
                },
                eventClick: function(calEvent, jsEvent, view) {
                    if(Date.parse(calEvent.start) > today && (calEvent.etat != 1) &&  (calEvent.id == {{$rdv->id}}))
                    {      
                        if( new Date(calEvent.start).setHours(0, 0, 0, 0) > today) //(calEvent.fixe) &&
                        {
                          $('#printRdv').attr("data-id",calEvent.id);
                          $('#printRdv').removeClass('hidden'); 
                        }
                        if($('#fixe').length &&(calEvent.fixe))
                          $("#fixe"). prop("checked", true);
                        $('#idRDV').val(calEvent.id);
                        ajaxEditEvent(calEvent,false);
                    }
               },
                eventAllow: function(dropLocation, draggedEvent) {
                       if (draggedEvent.id != {{$rdv->id}} || (draggedEvent.start < today))  
                             return false;
                 },
                eventDrop: function(event, delta, revertFunc)
                {
                      jQuery('#btnclose').click(function(){
                           revertFunc();
                      });
                      if($('#fixe').length &&(event.fixe))
                              $("#fixe"). prop("checked", true);
                      ajaxEditEvent(event,true);
                },
               select: function(start, end) {
                   $('.calendar1').fullCalendar('unselect');
               }, 	
         }).fullCalendar('gotoDate','{{ $rdv->date }}');
  });
</script>
@stop
@section('main-content')
<div class="page-header">
	<h4>Modifier le  rendez-vous du patient &quot;{{ $rdv->patient->getCivilite() }} {{ $rdv->patient->full_name }}&quot;
 	</h4>
    <div class="pull-right">
      <a href="{{ route('patient.show',$rdv->patient->id) }}" class="btn btn-white btn-info btn-bold">
        <i class="ace-icon fa fa-hand-o-up"></i> Patient</a>
      </a>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
      <div class="left">Modifier le rendez-vous du <span class= "blue">{{ $rdv->date->format('Y-m-d') }}</span></div>
      </div>
	    <div class="panel-body"><div class="calendar1"></div></div>
	    	<div class="panel-footer">
          <span class="badge label-info"><small>RDV fixe</small></span>
          <span class="badge label-pink"><small>RDV à fixé</small></span>
		    </div>
		</div>
  </div>
</div>
<div class="row"> @include('rdv.ModalFoms.edit') </div>
@stop