@extends('app_recep')
@section('style')
@endsection
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
                   <div class="panel panel-default">
                   &nbsp;&nbsp;&nbsp;&nbsp; <div class="panel-heading" style="margin-top:-20px">Liste Des Rendez-Vous <a href="/addEvent" class ="btn btn-success" align="right">Creé Rendez-vous</a></div>

                  <div class="panel-body">
                        {{--     {!! $planning->calendar() !!} --}}
                        <div id="calendar"></div>
                          
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
{{-- {!! $planning->script() !!} --}}
    <script type="text/javscript">
              $('#calendar').fullCalendar({
  events: [
    {
      title:  'My Event',
      start:  '2010-01-01T14:30:00',
      allDay: false
    }
    // other events here...
  ],
  timeFormat: 'H(:mm)' // uppercase H for 24-hour clock
});
    </script>
 @endsection