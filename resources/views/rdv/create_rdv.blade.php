@extends('app_recep')
@section('style')
	<style>
	</style>
@endsection
@section('page-script')
 <script>
 $(document).ready(function() {
 	$('#calendar').fullCalendar({// put your options and callbacks here
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
                          },
                         @endforeach 	
           	],
 	});	
 });
 </script>
@endsection
@section('main-content')
<div class="row">{{-- <div class="panel-body">    {!! $planning->calendar() !!}</div >     --}}
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
@endsection
