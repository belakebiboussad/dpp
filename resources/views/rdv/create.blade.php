@extends('app')
@section('style')
	<style> /*#dialog { display: none; }*/
  .make-scrolling {/* overflow-y: scroll; height: 100px;*/
    overflow-y: scroll; /*overflow: hidden;*/
    max-height: 100px;
    margin-left:-0.7%;
  }
  .es-list option{
    padding:5px 0;
   }
  .es-list li{
    padding:5px 0;
  }
  </style>
@endsection
@section('page-script')
{{--<script type="text/javascript" src="http://192.168.1.60:90/Scripts/jquery-1.6.4.min.js"></script><script src="{{asset('/js/jquery.signalR.min.js')}}"></script> --}}
<script type="text/javascript" src="http://192.168.1.60:90/Scripts/jquery.signalR-1.1.3.min.js" onerror="console.log('error signalR!');" onload="loaded=true;"></script>
<script type="text/javascript" src="http://192.168.1.60:90/myhubs/hubs" onerror="console.log('error hubs!');loaded=false;" onload="loaded=true;"></script>
<script>
var rdvs = @json($rdvs);
 var loaded = false;
function resetaddModIn()
{
        $('.es-list').val(''); 
        $('#patient').val(''); 
        $('#medecin').val('');
        $('#specialite').val(''); 
        $("#medecin").attr("disabled", true);   
}
function resetPrintModIn()
{
      $('#doctor').val('');$('#printRdv').addClass('hidden')
}
function reset_in()
{
  $('#medecin').val('');//$('.es-list').html('');  $('#patient').val('');
  $('#specialite').val('');
  $('#patient').editableSelect('clear');
}
function layout()
{
      reset_in(); 
      resetaddModIn();//var field = $("select#filtre option").filter(":selected").val();
      $("#btnSave").attr("disabled", true);
}
function getPatient()
{
        var field = $("select#filtre option").filter(":selected").val();//patientSearch(field,$("#patient").val()); //to call ajax
        $.ajax({
             url : '{{URL::to('getPatients')}}',
             data: {    
                   "field":field,
                   "value":$("#patient").val(),
             },
             dataType: "json",
             success: function(data) {
               $(".es-list").html("");//remove list
               $(".es-list").addClass("make-scrolling");
               $.each(data['data'], function(i, v) {
                      $(".es-list").append($('<li></li>').attr('value', v['id']).attr('class','es-visible list-group-item option').text(v['IPP']+"-"+v['Nom']+"-"+v['Prenom']));
               });
             },
            error: function() {
               alert("can't connect to db");
            }
        });
}
$(function () {
       if(loaded)
       {
               $.connection.hub.url = 'http://192.168.1.60:90/myhubs';
               // Connect Hubs without the generated proxy
               var chatHubProxy = $.connection.myChatHub;
              $.connection.hub.start().done(function (e) {
               console.log("Hub connected.");
              $("#printTck").click(function(){
                       var barcode = $("#civiliteCode").val()+ $("#idRDV").val()+"|"+$("#specialite").val()+"|"+$("#daterdvHidden").val();
                      chatHubProxy.server.send(barcode);       
                });
        }).fail(function () {
                console.log("Could not connect to Hub.");
         });
    }
});
$(document).ready(function() {
    var CurrentDate = (new Date()).setHours(23, 59, 59, 0); 
    var today = (new Date()).setHours(0, 0, 0, 0); 
    $('#calendar').fullCalendar({//calendar
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
              editable: true,
              eventLimit: true,     
              //hiddenDays: [ 5, 6 ],
              allDaySlot: false,
              weekNumberCalculation: 'ISO',
              aspectRatio: 1.5,        // disableDragging: true,
              eventStartEditable : false,
              eventDurationEditable : false,  // columnHeaderFormat: 'dddd',//affichelndi/mardi 
              weekNumbers: true,
              aspectRatio: 2,
              displayEventTime : false,
              views: {},
              events :[
                      @foreach($rdvs as $key =>   $rdv)
                      {
                              title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
                              start : '{{ $rdv->Date_RDV }}',
                              end:   '{{ $rdv->Fin_RDV }}',
                              id :'{{ $rdv->id }}',
                              idPatient:'{{ $rdv->patient->id}}',
                              tel:'{{$rdv->patient->tele_mobile1}}',
                              age:{{ $rdv->patient->getAge() }}, //specialite: (isEmpty({{-- $rdv->employe["specialite"] --}}))? "":'',
                              specialite: {{ $rdv->specialite_id }},
                              civ : {{ $rdv->patient->getCiviliteCode() }},
                              key :(isEmpty({{ $rdv->Employe_ID_Employe }}))? "":'{{ $key }}',
                              fixe:  {{ $rdv->fixe }},
                      },
                     @endforeach   
              ], 
              select: function(start, end) {
                    var minutes = end.diff(start,"minutes"); 
                    if( (minutes == 15) && (start >=today ))//CurrentDate
                    {                                    
                      if('{{ Auth::user()->role_id }}' == 1)
                      {
                         Swal.fire({
                                 title: 'Confimer vous  le Rendez-Vous ?',
                                 html: '<br/><h4><strong id="dateRendezVous">'+start.format('dddd DD-MM-YYYY')+'</strong></h4>',
                                 input: 'checkbox',
                                 inputPlaceholder: 'Redez-Vous Fixe',
                                 showCancelButton: true,
                                 confirmButtonColor: '#3085d6',
                                 cancelButtonColor: '#d33',
                                 confirmButtonText: 'Oui',
                                 cancelButtonText: "Non",
                                 allowOutsideClick: false,
                          }).then((result) => {
                              if(!isEmpty(result.value))//result.value indique rdv fixe ou pas
                              {
                                    if('{{ $patient->id}}' != null)
                                             createRDVModal(start,end,'{{ $patient->id }}',result.value);
                                    else
                                           createRDVModal(start,end,0,result.value);
                              }
                          })
                        }else
                        {
                          if('{{ $patient}}' != null)
                            createRDVModal(start,end,'{{ $patient->id }}');
                          else
                            createRDVModal(start,end,0,result.value);//createRDVModal(start,end);  
                        }
                    }else
                      $('#calendar').fullCalendar('unselect');
                },
                eventClick: function(calEvent, jsEvent, view) {
                      if(Date.parse(calEvent.start) > today )
                     {
                              $("#lien").attr("href", "{{ route('patient.show',$rdv->patient->id )}}");
                              $('#lien').text(calEvent.title); 
                              $('#patient_tel').val(calEvent.tel);
                              $('#agePatient').val(calEvent.age); 
                              $('#idRDV').val(calEvent.id);
                              if($('#doctor').length && !(isEmpty(calEvent.key)))
                                    $('#doctor').val(rdvs[calEvent.key]['employe'].nom+" "+rdvs[calEvent.key]['employe'].prenom);
                              $("#daterdv").val(calEvent.start.format('YYYY-MM-DD HH:mm'));
                              $("#daterdvHidden").val(calEvent.start.format('DDMMYY'));
                              $("#specialite").val(calEvent.specialite);
                              $('#specialite option[value="' + calEvent.specialite+ '"]').attr("selected", "selected");   
                              (calEvent.fixe==1) ? $("#fixecbx").prop('checked', true):$("#fixecbx").prop('checked', false); 
                              $('#civiliteCode').val(calEvent.civ);
                              $('#btnConsulter').attr('href','/consultations/create/'.concat(calEvent.idPatient)); //if(calEvent.fixe &&(!(isEmpty(calEvent.key)))  )
                              if( calEvent.fixe && (new Date(calEvent.start).setHours(0, 0, 0, 0) > today) )
                              {
                                     if($('#printRdv').hasClass( "hidden" ))
                                           $('#printRdv').removeClass('hidden');
                                     if(!$('#printTck').hasClass( "hidden" ))
                                            $('#printTck').addClass('hidden');
                              }
                              if(new Date(calEvent.start).setHours(0, 0, 0, 0)  ==  today )
                                      if(loaded)
                                            if($('#printTck').hasClass( "hidden" ))
                                                    $('#printTck').removeClass('hidden');
                                    $('#fullCalModal').modal({ show: 'true' });
                             }
              },
              eventRender: function (event, element, webData) {
                      if(event.start < today)
                        element.css('background-color', '#D3D3D3');  
                      else
                      {
                        if(event.fixe)
                          element.css('background-color', '#87CEFA'); 
                        else
                          element.css('background-color', '#378006');   
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
    });//calendar //fincalendar 
    $('#patient').editableSelect({
      effects: 'default', 
      editable: true,
    }).on('select.editable-select', function (e, li) {
        $('#last-selected').html(
              li.val() + '. ' + li.text()
        ); 
        @if(Auth::user()->role_id == 1)
                 $("#btnSave").removeAttr("disabled");//if(! isEmpty($("#medecin").val()))
        @else
        {
               if($('#specialite').val() != null)
                      $("#btnSave").removeAttr("disabled");
        }
        @endif
    });
    $("#patient").on("keyup", function() {
         getPatient(); 
    });  /* $( "#medecin" ).change(function() { if($('#patient').val())  $("#btnSave").removeAttr("disabled");   });*/
     $( "#specialite" ).change(function() {
               if(  $('#patient').val() )
                    $("#btnSave").removeAttr("disabled"); 
                });
      });
</script>
@endsection
@section('main-content')
<div class="row mt-20"><div class="col-sm-12"> <h4>Ajouter un Rendez-Vous</h4></div></div>
<div class="row"> <div class="col-sm-12" id='calendar'></div></div>
<div class="row">
  <div class="col-sm-12 col-sm-12">
    <span class="badge" style="background-color:#87CEFA">&nbsp;&nbsp;&nbsp;</span><h7><strong>&nbsp;RDV fixe</strong></h7>
    <span class="badge" style="background-color:#378006">&nbsp;&nbsp;&nbsp;</span><h7>&nbsp;RDV à fixer<strong></strong></h7>
  </div>
</div>
<div class="row">@include('rdv.ModalFoms.add')</div><div class="row">@include('rdv.ModalFoms.show')</div>
@endsection