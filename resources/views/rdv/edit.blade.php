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
                    specialite: {{ $rdv->employe["specialite"] }},
                    medecin : (isEmpty({{ $rdv->Employe_ID_Employe}}))? "": '{{ $rdv->Employe_ID_Employe}}',
                    fixe:  {{ $rdv->fixe }},
                    etat : '{{ $rdv->Etat_RDV }}',
                  
                },
               @endforeach 	
        ],
        eventRender: function (event, element, webData) {
        	 
        	  if(event.id == {{$rdv->id}})
              element.css('background-color', '#87CEFA'); 
            else
            {
              element.css('background-color', '#D3D3D3');   
              event.draggable = false;
              event.editable= false; 
            }
            element.css("padding", "5px");
        },
        eventAllow: function(dropLocation, draggedEvent) {
          if (draggedEvent.id != {{$rdv->id}}  )  
            return false;
        },
        eventDrop: function(event, delta, revertFunc)
        {

        	if( event.id == {{ $Rdv->id}} )
          {
            ajaxEditEvent(event,true);
          } 
        },
        select: function(start, end) {
          $('.calendar1').fullCalendar('unselect');
        }, 	
    });
  });
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>Modifier RDV du Patient :</strong>
  	<i class="ace-icon fa fa-angle-double-left" style="font-size:20px;"></i>
 		{{ $Rdv->patient->getCivilite() }} {{ $Rdv->patient->Nom }} {{ $Rdv->patient->Prenom }}
		<i class="ace-icon fa fa-angle-double-right" style="font-size:20px;"></i>
 	</h1>
    <div class="pull-right">
      <a href="{{ route('patient.show',$Rdv->patient->id) }}" class="btn btn-white btn-info btn-bold">
        <i class="ace-icon fa fa-hand-o-up"></i>&nbsp;Patient</a>
      </a>
    </div>
</div>
{{--
<div class="col-xs-11"><form class="form-horizontal" role="form" action="{{route('rdv.update',$rdv->id)}}" method="POST">
{{ csrf_field() }}{{ method_field('PUT') }}<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="type"><strong> Date RDV : </strong></label>
<div class="col-sm-9"><input class="col-sm-3 date-picker" id="daterdv" type="text" name="daterdv" value="{{ \Carbon\Carbon::parse($rdv->Date_RDV)->format('Y-m-d') }}" data-date-format="yyyy-mm-dd" required/>
</div></div><div class="clearfix form-actions"><div class="col-md-offset-3 col-md-9">
<button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
</div></div></form></div>--}}
<div class="row">{{-- style="margin-left:-2%;"margin-top:-2%; --}}
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
      <div class="left">
      	Modifier le Rendez-Vous du&nbsp;<span class= "red"><strong>{{ $Rdv->Date_RDV->format('Y-m-d') }}</strong></span>
      </div>
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