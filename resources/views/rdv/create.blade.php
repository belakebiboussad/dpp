@extends('app')
@section('style')
	<style>
	</style>
@endsection
@section('page-script')
<script>
  $(document).ready(function() {
    var CurrentDate = (new Date()).setHours(23, 59, 59, 0); 
    var today = (new Date()).setHours(0, 0, 0, 0); 
   	$('#calendar').fullCalendar({
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
      navLinks: true,
      selectable: true,
      selectHelper: true,
      eventColor: '#87CEFA',
      contentHeight: 700,
      editable: true,
      eventLimit: true,     
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
      select: function(start, end) {
        if(start >= CurrentDate)
          createRDVModal(start,end);
        else
          $('#calendar').fullCalendar('unselect');   
        },
      eventRender: function (event, element, webData) {
        element.css("font-size", "1em");
        if(event.start < CurrentDate)
          element.css('background-color', '#D3D3D3');  
        else
          element.css("padding", "5px");      
        
      },
      eventAllow: function(dropLocation, draggedEvent) {
        // var day = moment(draggedEvent.dueDate);
        // var eventStart = moment(draggedEvent.start); // var locationtStart = moment(dropLocation.start);
        // var day = moment(draggedEvent.dueDate);
        // if (eventStart < day) {
        //   return false;
        // }
        return false;
      },
      eventDragStart:function( event, jsEvent, ui, view ) {
       return false;
      },
      eventDrop: function(event, delta, revertFunc)
      { 
        return false;
      },       
 	  });//calendar
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
  // });
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
<div class="row">   
  <div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
          <h4 id="modalTitle" class="modal-title"><span class="glyphicon glyphicon-bell"></span> Selectionner un Patient</h4>
        </div>
        <form id ="addRdv" role="form" action="/createRDV" method="POST">
          {{ csrf_field() }}
          <input type="hidden" id="Debut_RDV" name="Debut_RDV" value="">
          <input type="hidden" id="Fin_RDV" name="Fin_RDV"  value="" >
          <input type="time" id="Temp_rdv" name="Temp_rdv"  value=""  min="8:00" max="18:00" style="display:none;" >
          <div id="modalBody" class="modal-body" style="padding:40px 50px;">
          <div class="panel panel-default">
            <div class="panel-heading" style="">
              <span class="glyphicon glyphicon-search"></span>Rechercher un Patient
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for=""> <strong>Filtre: </strong></label>
                    <div class="col-sm-10">          
                      <select class="form-control" placeholder="choisir le filtre" id="filtre" onchange="layout();">
                        <option value="Nom">Nom</option>
                        <option value="Prenom">Prenom</option>
                        <option value="code_barre">IPP</option>
                        <option value="Dat_Naissance">Date Naisssance</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <span class="input-icon" style="margin-right: -190px;">
                    <select  placeholder="Rechercher... " class="nav-search-input" id="patient" name ="patient" autocomplete="off" style="width:300px;" data-date-format="yyyy-mm-dd">
                    @if(isset($patient))
                      <option value="{{$patient->id}}" selected>{{ $patient->code_barre }}-{{ $patient->Nom }}-{{ $patient->Prenom }}</option>
                    @endif
                    </select>
                    <i class="ace-icon fa fa-search nav-search-icon"></i>   
                  </span>   
                </div>                               
              </div>                                                  
            </div> {{-- panel-body --}}
          </div>{{-- panel --}}
          </div>{{-- modalBody --}}
          <div class="modal-footer">
            <button class="btn btn-sm btn-primary" type="submit" id ="btnSave" disabled><i class="ace-icon fa fa-save bigger-110" ></i>Enregistrer  </button>                     
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"onclick="reset_in();"><i class="fa fa-close" aria-hidden="true"  ></i>Fermer</button>
          </div>   
        </form> 
      </div>
    </div>
  </div>
</div>
@endsection
