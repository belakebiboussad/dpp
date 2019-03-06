@extends('app_recep')
@section('page-script')
  {{-- {!! $planning->script() !!} --}}
  <script>
  	// var initialize_calendar;
  	// initialize_calendar = function(){
  	// 	$(".calendar").each(function(){
  	// 		var calendar = $(this);
  	// 		calendar.fullCallendar({})
  	// 	})
  	// };
  	// $(document).on('turbolinks:load',initialize_calendar);
  	$(document).ready(function() {
 	$('.calendar1').fullCalendar({
 		header:{
 			left:'prev,next,today',
 			center:'title',
 			right:'month,agendaWeek,agendaDay',
 		},
 		selectable:true,
 		selectHelper:true,
 		editable:true,
           		aspectRatio: 1.5,
           		defaultView: 'agendaWeek',
           		events : [
           			@foreach($rdvs as $rdv)
              			{
              				title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
              				start : '{{ $rdv->getAsDate() }}',
              			},
              			@endforeach			
           	],
 
 	});	
 });
  </script>
@endsection
@section('main-content')
    <div class="row">
        <div class="col-md-12">
                   <div class="panel panel-default">
                   &nbsp;&nbsp;&nbsp;&nbsp; <div class="panel-heading" style="margin-top:-20px">
                    <div class="left"> <strong>Liste Des Rendez-Vous</strong></div>
                   </div>
                  <div class="panel-body">
                   	<div  class="calendar1"></div>
                </div>
        </div>
            </div>
    </div>
</div>
@endsection

