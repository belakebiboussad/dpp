@extends('app')
@section('style')
	<style>
  .make-scrolling {
    overflow-y: scroll; 
    max-height: 100px;
    margin-left:-0.7%;
  }
  .es-list option{ padding:5px 0; }
  .es-list li{
        padding:5px 0;
  }
  </style>
@stop
@section('page-script') {{-- src="http://192.168.1.194:90/Scripts/jquery.signalR-1.1.3.min.js" --}}
@include('rdv.scripts.js')
<script>
function resetPatient()
{
  $("#livesearch").html("");
  $("#pat-search").val("");
  $('#pid').val(''); 
}
var loaded;
function reset_in(){
  $("#pat-search").attr("disabled", true);
  $('#addRDVModal form')[0].reset(); 
  resetPatient();
}
function getPatient()
{
  var spec ='{{ Auth::user()->isIn([1,13,14])}}' ? '{{ Auth::user()->employ->specialite }}' : $("#specialite") .val(); 
  var field = $("select#filtre option").filter(":selected").val();
  var ajaxurl = '{{ URL::to('getPatients') }}';
  $.ajax({
        url : ajaxurl,
        data: {    
            "field":field,
            "value":$("#pat-search").val(),
            "specialite":spec,
        },
        success: function(html) {
          $("#livesearch").html(html).show();
        },
        error: function() {
          console.log("can't connect to db");
        }
  });
}
function createRDVModal(debut, fin, pid = 0, fixe=1)//pid 0 pas de patient
{ 
  var debut = moment(debut).format('YYYY-MM-DD HH:mm'); 
  var fin = moment(fin).format('YYYY-MM-DD HH:mm');
  if(pid !== 0)
  {
    if('{{ Auth::user()->isIn([1,13,14])}}')
    {
      var formData = { _token: CSRF_TOKEN, pid:pid, date:debut, fin:fin, fixe:fixe  };
      var url = "{{ route('rdv.store') }}"; 
      $.ajax({
          type : 'POST',
          url :url,
          data:formData,
          success:function(data){         
            var color = (data['rdv']['fixe'] > 0) ? '#3A87AD':'#D6487E';
            $('.calendar').fullCalendar( 'renderEvent',  {
                  title: data['patient']['full_name']+" ,("+data['age']+" ans)",
                  start: debut,
                  end: fin,
                  id : data['rdv']['id'],
                  idPatient:data['patient']['id'],
                  fixe: data['rdv']['fixe'],
                  tel:data['patient']['tele_mobile1'] ,
                  age:data['age'],
                  specialite: data['rdv']['specialite_id'],
                  civ : data['patient']['civ'],
                  allDay: false,
                  color:color
            });
          }
      });
    }else
      showRdvModal(debut,fin,pid,fixe); 
  }else
    showRdvModal(debut,fin,0,fixe); 
}
function checkRdv()
{
  var erreur =true;
  var specialite = $('#specialite').val();
  var pid = $('#pid').val();
  var inputRDVVal = new Array(pid,specialite);
  var inputRDVMessage = new Array("Patient", "Specialite médicale");
  if($('#medecinRequired').val() ==1)
  {
    var medecin = $('#employ_id').val();
    inputRDVVal.push(medecin);
    inputRDVMessage.push("Médecin");
  }
  $('.error').each(function(i, obj) {
    $(obj).next().remove();
    $(obj).detach();
  });
  jQuery.each( inputRDVVal, function( i, val ) {
    if(val =="" || val ==null )
    {
      erreur =false;
     $('#error').after('<span class="error">Veuiller remplir le(la) ' + inputRDVMessage[i]+'<br/>');
    }
  });   
  return erreur;
}
$(function() {
  if(loaded)
  {
    $.connection.hub.url = '{{-- $borneIp--}}/myhubs';// Connect Hubs without the generated proxy
    var chatHubProxy = $.connection.myChatHub;
    $.connection.hub.start().done(function (e) {
          console.log("Hub connected.");
          $("#printTck").click(function(){ //var spec = $('#specialite').find(":selected").val();
              var barcode = $("#civiliteCode").val()+ $("#idRDV").val()+"|" + $("#specialiteId").val()+"|" + $("#daterdvHidden").val();
              chatHubProxy.server.send(barcode);       
          });
      }).fail(function () {
        console.log("Could not connect to Hub.");
      });
  }
   $("#showfullCalModal").on('hide.bs.modal', function(){
        $('#specialiteId').val('');
        $('#printRdv').attr("data-id",'');
        $('#printRdv').addClass('hidden');
        $('#showfullCalModal form')[0].reset();
  });
  var CurrentDate = (new Date()).setHours(23, 59, 59, 0); 
  var today = (new Date()).setHours(0, 0, 0, 0); 
  $('.calendar').fullCalendar({
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
        timeFormat: 'H:mm',
        navLinks: true,
        selectable: true,
        selectHelper: true, 
        eventColor: '#3A87AD',
        editable: true,
        eventLimit: true,     
        hiddenDays: [ 5, 6 ],
        allDaySlot: false,
        weekNumberCalculation: 'ISO',
        eventStartEditable : false,
        eventDurationEditable : false,
        weekNumbers: true,
        aspectRatio: 1.5,
        displayEventTime : false,
        views: {},
        events :[
            @foreach($rdvs as $key =>   $rdv)
            {
                title : '{{ $rdv->patient->full_name }} ' +', ('+{{ $rdv->patient->age }} +' ans)',
                start : '{{ $rdv->date }}',
                end:   '{{ $rdv->fin }}',
                id :'{{ $rdv->id }}',
                idPatient:'{{ $rdv->patient->id}}',
                fixe:  {{ $rdv->fixe }},
                tel:'{{$rdv->patient->tele_mobile1}}',
                age:{{ $rdv->patient->age }},
                specialite: {{ $rdv->specialite_id }},
                civ : {{ $rdv->patient->civ }},
            },
           @endforeach   
        ], 
        select: function(start, end) {
          var minutes = end.diff(start,"minutes"); 
          if( (minutes == 15) && (start >=today ))//CurrentDate
          {
            if('{{ Auth::user()->isIn([1,13,14]) }}')                                
            {
              Swal.fire({
                  title: 'Confimer vous le Rendez-Vous?',
                  html: '<br/><h4><b id="dateRendezVous">'+start.format('dddd DD/MM/YYYY')+'</b></h4>',
                  input: 'checkbox',
                  inputValue: 1,
                  inputPlaceholder: 'Redez-Vous Fixe',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Oui',
                  cancelButtonText: "Non",
                  allowOutsideClick: false,
                  showCloseButton: true
              }).then((result) => {
                if(!isEmpty(result.value))//result.value indique rdv fixe ou pas
                {
                  if(('{{ $patient->id}}' !== null) && ('{{ $patient->id}}' !== ""))
                    createRDVModal(start,end,'{{ $patient->id }}',result.value);
                  else
                  {
                     createRDVModal(start,end,0,result.value);
                  } 
                }
              })
            }else
            {
              if('{{ $patient->id}}' != '') 
                createRDVModal(start,end,'{{ $patient->id }}',1);
              else
               createRDVModal(start,end,0,1);
               
            }
            //resetPatient();
          }else
            $('.calendar').fullCalendar('unselect');
        },
        eventClick: function(calEvent, jsEvent, view) {
            if(Date.parse(calEvent.start) > today)
            {
              getAppwithDocParamVal(3,calEvent.specialite);
              $.get('/rdv/'+ calEvent.id, function (data, status, xhr) {
                $("#lien").attr("href", '/patient/' + data.patient.id);
                $('#lien').text(calEvent.title); 
                $('#specialiteId').val(data.specialite.id);
                $('#nomPatient').val(data.patient.full_name);
                $('#patient_tel').val(data.patient.tele_mobile1);
                $('#agePatient').val(data.patient.age);
                $('#idRDV').val(calEvent.id);
                $("#daterdv").val(calEvent.start.format('YYYY-MM-DD HH:mm'));
                $("#daterdvHidden").val(calEvent.start.format('DDMMYY'));
                $('#specialiteName').val(data.specialite.nom);
                (data.employe != null) ?$('#medecinName').val(data.employe.full_name):'';
                (calEvent.fixe==1) ? $("#fixecbx").prop('checked', true):$("#fixecbx").prop('checked', false); 
                $('#civiliteCode').val(calEvent.civ);
                $('#btnConsulter').attr('href','/consultations/create/'.concat(data.patient.id));
                $('#printRdv').attr("href",'/rdvprint/'.concat(calEvent.id));      
              });
              if(new Date(calEvent.start).setHours(0, 0, 0, 0)  ==  today )
              {
                if(loaded)
                        if($('#printTck').hasClass( "hidden" ))
                             $('#printTck').removeClass('hidden');
                       if(!$('#printRdv').hasClass( "hidden" ))
                               $('#printRdv').addClass('hidden');
              }else
              {
                if(!$('#printTck').hasClass( "hidden" ))
                      $('#printTck').addClass('hidden');
                if($('#printRdv').hasClass( "hidden" ))
                     $('#printRdv').removeClass('hidden');
              }  
              $('#showfullCalModal').modal({ show: 'true' });
          }
      },
      eventRender: function (event, element, webData) {
        if(event.start < today)
              element.css('background-color', '#D3D3D3');  
        else
        {
          if(event.fixe>0)
                  element.css('background-color', '#3A87AD'); //#D6487E
          else
                  element.css('background-color', '#D6487E');

            element.css("padding", "5px");
        }
        element.popover({
            delay: { "show": 500, "hide": 100 },  // title: event.title,
            content: event.tel,
            trigger: 'hover',
            animation:true,
            placement: 'bottom',
            container: 'body',
            template:'<div class="popover" role="tooltip"><div class="arrow"></div><h6 class="popover-header">'+event.tel+'</h6><div class="popover-body"></div></div>',
      });       
      },
      eventMouseover: function(event, jsEvent, view) {
      }
    });//fincalendar 
    $('#rdvSaveBtn').on('click keyup', function(e) {
      if(!checkRdv())
        e.preventDefault();
      else
      {
        formSubmit($('#addRdv')[0], this, function(status, data) {
          if (status == "success") {
            $('.calendar').fullCalendar( 'renderEvent', {
                title: data.patient.full_name+" ,(" + data.patient.age + " ans)",
                start: data.date,
                end: data.fin,
                id : data.id,
                idPatient:data.patient.id,
                fixe: data.fixe,
                tel:data.patient.tele_mobile1 ,
                age:data.patient.age,
                specialite: data.specialite_id,
                civ:data.patient.civ,    
                color:(data.fixe > 0) ? '#3A87AD':'#D6487E',
              }); //$('#addRDVModal').modal('toggle'); 
              resetPatient();
          }
        });
      }
    });
  });
</script>
@stop
@section('main-content')
  <page-header><h1>Ajouter un rendez-vous</h1></page-header>
  <div class="row"><div class="col-sm-12 col-xs-12 calendar"></div></div>
  <hr>
  <div class="row">
    <div class="col-sm-12 col-xs-12">
      <span class="badge label-info"><small>RDV fixe</small></span>
      <span class="badge label-pink"><small>RDV à fixé</small></span>
    </div>
  </div>
  <div class="row">@include('rdv.ModalFoms.add')</div><div class="row">@include('rdv.ModalFoms.show')</div>
@stop