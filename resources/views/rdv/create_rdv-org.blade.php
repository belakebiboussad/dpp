@extends('app_recep')
@section('style')
	<style>
	
	</style>
@endsection
@section('page-script')
	<script>

		var fcSources = {
		        loadEvents: {
		           url: "/get-all-events",
		           type: "GET",
		           color: "#65a9d7",
		           textColor: "#3c3d3d",
		           cache: true,
		           className: "events",
		           data:
		           {
		                 start: "start",
		                 end: "end",
		                 id: "id",
		                 title: "title"

		           },
		           success: function(doc) { 

		           },
		            error: function() {
		                console.log("Error in loadEvents: ");
		            },
		        },
	           };
		var events = [];
		$(function() {
                              $('#calendar-{{$planning->getId()}}').fullCalendar({
                              	           selectable: true,
	                                defaultView: 'agendaWeek',
	                                weekNumbers: true,
	                                firstDay: 7,
	                                // minTime:'08:00:00',
	                                 //maxTime:'18:00:00',
	                                // weekends: false,
	                                theme: true,	
	                                events:[
	                              		@foreach($data as $rdv)
              				{
              					title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
              					start : '{{ $rdv->getAsDate() }}',
              				},
              				@endforeach
	                                ],		
	                                dayClick: function(date) {
	                                     alert('clicked ' + date.format());
	                                },
	                               select: function(startDate, endDate) {
	                                	alert('selected ' + startDate.format() + ' to ' + endDate.format());
	                                }
	                     });
       		});
	</script>	
@endsection
@section('main-content')
<div class="page-header" width="100%">
  @include('patient._patientInfo')
</div>
{{-- <div class="row"><h5 class="widget-title"><strong>Ajouter un Rendez-Vous </strong></h5></div> --}}
<div class="page-header">
	<h1>Ajouter un Rendez-Vous</h1>
</div>
<hr>
<form role="form" method="POST" action="{{route('rdv.store')}}">
	{{ csrf_field() }}

	<input type="text" name="id_patient" value="{{$patient->id}}" hidden>
	<label for="date"><b>Date :</b></label>
	<div class="row">
		<div class="col-xs-3{{ $errors->has('daterdv') ? "has-error" : "" }}">
			<div class="input-group">
				<input class="form-control date-picker" id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd" required />
				<span class="input-group-addon">
					<i class="fa fa-calendar bigger-110"></i>
				</span>
			</div>
		</div>
		<div>
			<button type="submit" class="btn btn-sm btn-primary">
				<i class="ace-icon fa fa-calendar-o"></i>
				Valider rdv
			</button>
		</div>
	</div>
	<div class="row">
		<div class="panel-body">    {!! $planning->calendar() !!}</div >    
	</div>

</form>
</div>
@endsection