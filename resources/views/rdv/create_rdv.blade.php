@extends('app_recep')
@section('style')
	<style>
	</style>
@endsection
@section('page-script')
 <script>
 $(document).ready(function() {
 	$('#calendar').fullCalendar({
 		// put your options and callbacks here
           	timeZone: 'local',
           	aspectRatio: 1.5,
           	defaultView: 'agendaWeek',
           	events : [
           		@foreach($data as $rdv)
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
<div class="page-header" width="100%">
  {{-- @include('partials._patientInfo') --}}
</div>
<div class="row">
		{{-- <div class="panel-body">    {!! $planning->calendar() !!}</div >     --}}
		<div id='calendar'></div>
	</div>
@endsection
