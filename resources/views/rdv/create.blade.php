@extends('app')
@section('style')
	<style>
  .make-scrolling {
    overflow-y: scroll; 
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
@section('page-script') {{-- src="http://192.168.1.194:90/Scripts/jquery.signalR-1.1.3.min.js" --}}
<script type="text/javascript" src="{{asset('/js/jquery.signalR.min.js')}}"></script>
<!-- <script type="text/javascript" src="http://192.168.1.194:90/myhubs/hubs" onerror="console.log('error hubs!');loaded=false;" onload="loaded=true;"></script> -->
<!-- <script  src="http://192.168.1.244:90/myhubs/hubs" onerror="console.log('error hubs!');loaded=false;" onload="loaded=true;"></script> -->
<script type="text/javascript" src="{{ $borneIp }}/myhubs/hubs" onerror="console.log('error hubs!');loaded=false;" onload="loaded=true;"></script>
@include('rdv.scripts.print')
<script>
function resetPation()
{
  $("#livesearch").html("");//$("#btnSave").attr("disabled", true);
  $("#pat-search").val("");
}
var loaded;
function reset_in(){
  $("#filtre").val('');
  $("#pat-search").attr("disabled", true);
  $("#btnSave").attr("disabled", true);
  if('{{ Auth::user()->role_id == 2 }}')
  {
    $('#specialite').val('');
    $("#filtre").attr("disabled", true);
  }
  resetPation();
}
function getPatient()
{
  var spec ='{{  in_array(Auth::user()->role->id,[1,13,14]) }}' ? '{{ Auth::user()->employ->specialite }}' : $("#specialite") .val(); 
  var field = $("select#filtre option").filter(":selected").val();
  var ajaxurl = '{{ URL::to('getPatients') }}';
  $.ajax({
        url : ajaxurl,
        data: {    
            "field":field,
            "value":$("#pat-search").val(),
            "specialite":spec,
        },//dataType: "json",
        success: function(html) {
          
          $("#livesearch").html(html).show();
          document.getElementById("livesearch").style.border="1px solid #A5ACB2";
        },
        error: function() {
          console.log("can't connect to db");
        }
  });
}
$(function () {//alert('{{ $borneIp }}');
  if(loaded)
  {
    $.connection.hub.url = '{{ $borneIp}}/myhubs';
    // $.connection.hub.url = 'http://192.168.1.194:90/myhubs';// $.connection.hub.url = 'http://192.168.1.244:90/myhubs';
    // Connect Hubs without the generated proxy
    var chatHubProxy = $.connection.myChatHub;
    $.connection.hub.start().done(function (e) {
           console.log("Hub connected.");
            $("#printTck").click(function(){
              var spec = $('#specialite').find(":selected").val();
              var barcode = $("#civiliteCode").val()+ $("#idRDV").val()+"|"+$("#specialiteId").val()+"|"+$("#daterdvHidden").val();
              //alert(barcode);
              chatHubProxy.server.send(barcode);       
            });
      }).fail(function () {
        console.log("Could not connect to Hub.");
      });
  }
});
$(function() {
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
        navLinks: true,
        selectable: true,
        selectHelper: true, 
        eventColor: '#87CEFA',
        editable: true,
        eventLimit: true,     
       // hiddenDays: [ 5, 6 ],
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
                    title : '{{ $rdv->patient->full_name  --}} ' +', ('+{{ $rdv->patient->age }} +' ans)',
                    start : '{{ $rdv->date }}',
                    end:   '{{ $rdv->fin }}',
                    id :'{{ $rdv->id }}',
                    idPatient:'{{ $rdv->patient->id}}',
                    fixe:  {{ $rdv->fixe }},
                    tel:'{{$rdv->patient->tele_mobile1}}',
                    age:{{ $rdv->patient->age }}, //specialite: (isEmpty({{-- $rdv->employe["specialite"] --}}))? "":'',
                    specialite: {{ $rdv->specialite_id }},
                    civ : {{ $rdv->patient->civ }},
                    // key :(isEmpty({{-- $rdv->employ_id --}}))? "":'{{-- $key --}}'
                },
               @endforeach   
        ], 
        select: function(start, end) {
                var minutes = end.diff(start,"minutes"); 
                if( (minutes == 15) && (start >=today ))//CurrentDate
                {
                  if('{{ in_array(Auth::user()->role->id,[1,13,14]) }}')                                  
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
                        showCloseButton: true
                    }).then((result) => {
                      if(!isEmpty(result.value))//result.value indique rdv fixe ou pas
                      {
                        if(('{{ $patient->id}}' !== null) && ('{{ $patient->id}}' !== ""))
                          createRDVModal(start,end,'{{ $patient->id }}',result.value);
                        else
                          createRDVModal(start,end,0,result.value);
                      }
                    })
                  }else
                  {
                    if('{{ $patient->id}}' != '') 
                      createRDVModal(start,end,'{{ $patient->id }}',1);
                    
                    else
                      createRDVModal(start,end,0,1);
                    
                  }
                  resetPation();
                }else
          $('.calendar').fullCalendar('unselect');
        },
        eventClick: function(calEvent, jsEvent, view) {
            if(Date.parse(calEvent.start) > today)
            {
              $("#lien").attr("href", '/patient/'+calEvent.idPatient);
              $('#lien').text(calEvent.title); 
              $('#specialiteId').val(calEvent.specialite).change();
              $('#patient_tel').html(calEvent.tel);
              $('#agePatient').html(calEvent.age); 
              $('#idRDV').val(calEvent.id);
              $("#daterdv").val(calEvent.start.format('YYYY-MM-DD HH:mm'));
              $("#daterdvHidden").val(calEvent.start.format('DDMMYY'));//$('#specialite option[value="' + calEvent.specialite + '"]').attr("selected", "selected").change();   
              $('#specialite option').removeAttr('selected');
              $('#specialite option[value="' + calEvent.specialite + '"]').attr("selected", true).change();   
              (calEvent.fixe==1) ? $("#fixecbx").prop('checked', true):$("#fixecbx").prop('checked', false); 
              $('#civiliteCode').val(calEvent.civ);
              $('#btnConsulter').attr('href','/consultations/create/'.concat(calEvent.idPatient));
              if($('#printRdv').hasClass( "hidden" ))
              {
                $('#printRdv').attr("data-id",calEvent.id);
                $('#printRdv').removeClass('hidden');
              }         
              if(new Date(calEvent.start).setHours(0, 0, 0, 0)  ==  today )
              {
                if(loaded)
                {
                  if($('#printTck').hasClass( "hidden" ))
                    $('#printTck').removeClass('hidden');
                }
                if(!$('#printRdv').hasClass( "hidden" ))
                  $('#printRdv').addClass('hidden');
              }else
              {
                if(!$('#printTck').hasClass( "hidden" ))
                  $('#printTck').addClass('hidden');
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
                              element.css('background-color', '#87CEFA'); //#378006
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
    $('#btnSave').on('click keyup', function(e) {
          url ="{{ route('rdv.store') }}";
          var formData = {
              date:$('#date').val(),
              fin:$('#fin').val(),
              id_patient:$('#pat_id').val(),
              fixe :$('#fixe').val()
          }
          if('{{ Auth::user()->role_id }}' == 2)
          {
            formData.specialite = $('#specialite').val();
          }
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:url,
            data:formData,
            success:function(data){      
                    var color = (data['rdv']['fixe'] > 0) ? '#87CEFA':'#378006';
                   $('.calendar').fullCalendar( 'renderEvent', {
                      title: data['patient']['full_name']+" ,("+data['age']+" ans)",
                      start: formData.date,
                      end: formData.fin,
                      id : data['rdv']['id'],
                      idPatient:data['patient']['id'],
                      fixe: data['rdv']['fixe'],
                      tel:data['patient']['tele_mobile1'] ,
                      age:data['age'],
                      specialite: data['rdv']['specialite_id'],
                      civ:data['patient']['civ'],         
                      //allDay: false,
                      color:color,
                  });
              resetPation();
            },//success
      })
    });
  });
</script>
@endsection
@section('main-content')
  <div class="row mt-20"><div class="col-sm-12"> <h4><strong>Ajouter un rendez-vous</strong></h4></div></div>
  <div class="row"> <div class="col-sm-12 calendar" id=''></div></div>
  <div class="row">
    <div class="col-sm-12 col-sm-12">
      <span class="badge" style="background-color:#87CEFA">&nbsp;&nbsp;&nbsp;</span><h7><strong>&nbsp;RDV fixe</strong></h7>
      <span class="badge" style="background-color:#378006">&nbsp;&nbsp;&nbsp;</span><h7>&nbsp;RDV à fixer<strong></strong></h7>
    </div>
  </div>
  <div class="row">@include('rdv.ModalFoms.add')</div><div class="row">@include('rdv.ModalFoms.show')</div>
@endsection