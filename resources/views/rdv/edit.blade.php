@extends('app_recep')
@section('page-script')
<script>
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
        height:650,
        firstDay: 0, 
        slotDuration: '00:15:00',
        minTime:'08:00:00',
        maxTime: '17:00:00',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectHelper: true,// eventColor: '#87CEFA',//contentHeight: 700,//700
        editable: true,
        eventLimit: true, // allow "more" link when too many events      // displayEventEnd: true,       
        //hiddenDays: [ 5, 6 ],
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
                    title : '{{ $rdv->patient->full_name  }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
                    start : '{{ $rdv->date }}',
                    end:   '{{ $rdv->fin }}',
                    id :'{{ $rdv->id }}',
                    idPatient:'{{$rdv->patient->id}}',
                    tel:'{{$rdv->patient->tele_mobile1}}',
                    age:{{ $rdv->patient->getAge() }},
                    specialite: {{ $rdv->specialite_id }},
                    medecin : (isEmpty({{ $rdv->employ_id}}))? "": '{{ $rdv->employ_id}}',
                    fixe:  {{ $rdv->fixe }},
                    etat : '{{ $rdv->Etat_RDV }}',   
                },
               @endforeach 	
           ],
          eventRender: function (event, element, webData) {
        	     if(event.id == {{$Rdv->id}})
                       element.css('background-color', '#87CEFA'); 
                else{
                            element.css('background-color', '#D3D3D3');//  event.editable= false; 
                }
                element.css("padding", "5px");
          },
          eventAllow: function(dropLocation, draggedEvent) {
                if (draggedEvent.id != {{$Rdv->id}} || (draggedEvent.start < today))  
                       return false;
           },
          eventDrop: function(event, delta, revertFunc)
          {
                jQuery('#btnclose').click(function(){
                     revertFunc();
               });
                if($('#fixe').length &&(event.fixe))
                     $("#fixe"). prop("checked", true);
                ajaxEditEvent(event,true);// if( event.id == {{-- $Rdv->id--}} )
          },
           select: function(start, end) {
               $('.calendar1').fullCalendar('unselect');
           }, 	
    }).fullCalendar('gotoDate','{{ $Rdv->date }}');
  });
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>Modifier RDV du Patient :</strong>
  	<i class="ace-icon fa fa-angle-double-left" style="font-size:20px;"></i>
 		{{ $Rdv->patient->getCivilite() }} {{ $Rdv->patient->full_name }}
		<i class="ace-icon fa fa-angle-double-right" style="font-size:20px;"></i>
 	</h1>
    <div class="pull-right">
      <a href="{{ route('patient.show',$Rdv->patient->id) }}" class="btn btn-white btn-info btn-bold">
        <i class="ace-icon fa fa-hand-o-up"></i>&nbsp;Patient</a>
      </a>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
      <div class="left">Modifier le rendez-vous du&nbsp;<span class= "red"><strong>{{ $Rdv->date->format('Y-m-d') }}</strong></span></div>
      </div>
	    <div class="panel-body">
	    	<div class="calendar1"></div>
	    </div>
		    <div class="panel-footer">
		      <span class="badge" style="background-color:#87CEFA">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px"><strong>&nbsp;RDV fixe</strong></span>
		      <span class="badge" style="background-color:#378006">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px"><strong>&nbsp;RDV à fixer</strong></span> 
		    </div>
		</div>
  </div>
</div>
<div class="widget-footer widget-footer-large right">
		<div class="col-sm-12">
			<a href="{{ route('patient.show',$rdv->patient->id) }}" class="btn btn-info btn-bold">
				<i class="ace-icon fa fa-close bigger-110"></i>&nbsp;Fermer
			</a>
		</div>
</div>
<div class="row">@include('rdv.ajex_edit_event')</div>
@endsection