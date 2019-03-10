@extends('app')
@section('style')
<style>
     .fc-agendaWeek-view tr {
          height: 40px;
      }
     .fc-agendaDay-view tr {
          height: 40px;
     }
  /*   .fc-fri { background-color:yellow; }
     .fc-sat { background-color:red;  }*/
</style>

@endsection
@section('page-script')
  {{-- {!! $planning->script() !!} --}}
  <script>
     function createRDVModal(debut,fin)
      {        var CurrentDate = (new Date()).setHours(0, 0, 0, 0);
                var GivenDate = (new Date(debut)).setHours(0, 0, 0, 0);
               if( CurrentDate <= GivenDate )
               { 
                      debut = moment.tz(debut, "Europe/London").format('YYYY-MM-DD HH:mm');  //debut =moment.utc(debut).zone(-60).format();
                      fin = moment.tz(fin, "Europe/London").format('YYYY-MM-DD HH:mm');  //fin =moment.utc(fin).zone(-60).format();//
                     var heur= moment(debut).format('HH:mm:ss');
                     $('#date_RDV').val(debut); $('#date_Fin').val(fin); $('#Temp_rdv').val(heur);
                     $('#myModal').modal({
                                 show: 'true'
                      }); 
               }
      }
     function remoteSearch() {
            $.ajax({
                url : '{{URL::to('getPatients')}}',
                data: {
                  "nom": $("#listePatient").val() //search box value
                },
                dataType: "json", // recommended response type
                success: function(data) {
                    $(".es-list").html(""); //remove list
                    $.each(data['data'], function(i, v) {
                        $(".es-list").append($('<li></li>').attr('value', v['id']).attr('class','es-visible list-group-item option').text(v['code_barre']+"-"+v['Nom']+"-"+v['Prenom']));   });
                },
                error: function() {
                  alert("can't connect to db");
                }
            });
      }
     function edit(event)
     {
           var CurrentDate = (new Date()).setHours(0, 0, 0, 0);
           var GivenDate = (new Date(event.start)).setHours(0, 0, 0, 0); 
           if( CurrentDate <= GivenDate )
           {
                    $('#patient_tel').text(event.tel);
                     $('#agePatient').text(event.age);
                     $('#lien').attr('href','/patient/'.concat(event.idPatient)); 
                     $('#lien').text(event.title);
                      $("#id_rdv").val(event.id);
                     $("#daterdv").val(event.start.format('YYYY-MM-DD HH:mm'));
                     $("#datefinrdv").val(event.end.format('YYYY-MM-DD HH:mm'));
                     $('#btnConsulter').attr('href','/consultations/create/'.concat(event.idPatient));
                     $('#btnDelete').attr('href','/rdv/'.concat(event.idrdv));
                     //$('#updateRdv').attr('action','/rdv/'.concat(event.idrdv));
                     var url = '{{ route("rdv.update", ":slug") }}';
                     url = url.replace(':slug',event.id);
                     alert(url)
                     $('#updateRdv').attr('action',url);

                     $('#fullCalModal').modal({
                          show: 'true'
                     }); 
           }
     }
     function update()
     {
           $('form#updateRdv').submit();
     }
  	$(document).ready(function() {
           var CurrentDate = (new Date()).setHours(0, 0, 0, 0); 
       	$('.calendar1').fullCalendar({
                header: {
                      left: 'prev,next today',
                      center: 'title',
                      right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'agendaWeek',
                //weekends: false,
                firstDay: 0, 
                slotDuration: '00:15:00',
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectHelper: true,
                minTime:'08:00:00',
                maxTime: '17:00:00',
                eventColor: '#87CEFA',
                contentHeight: 700,
                editable: true,
                eventLimit: true, // allow "more" link when too many events
               // displayEventEnd: true,
               weekNumberCalculation: 'ISO',
                views: {
                      month: { // name of view
                          columnFormat: 'ddd'
                              // other view-specific options here
                      },
                      agendaWeek: {
                          columnFormat: 'ddd D'
                      },
                      agendaDay: {
                          columnFormat: 'ddd D'
                      },
                      listWeek: {
                          buttonText: 'list week'
                      }
                },
                select: function(start, end) {
                     if(start >= CurrentDate)
                           createRDVModal(start,end);
                      else
                         $('.calendar1').fullCalendar('unselect');   
                },
                events: [
                          @foreach($rdvs as $rdv)
                           {
                                title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
                                start : '{{ $rdv->Date_RDV }}',
                                end:   '{{ $rdv->Fin_RDV }}',
                                id :'{{ $rdv->id }}',
                                idPatient:'{{$rdv->patient->id}}',
                                tel:'{{$rdv->patient->tele_mobile1}}',
                                age:{{ $rdv->patient->getAge() }},   {{--url:'http://localhost:8000/patient/{{ $rdv->patient->id }}',--}}         
                           },
                           @endforeach 
                ],
                eventClick: function(calEvent, jsEvent, view) {
                     @if( App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role !="Receptioniste") 
                           //updateRDVModal(calEvent.id,calEvent.title,calEvent.start,calEvent.end,calEvent.idPatient,calEvent.tel,calEvent.age);
                           edit(calEvent);
                     @endif     
                },
                eventRender: function (event, element, webData) {
                      if(event.start < CurrentDate)
                      {
                           element.css('background-color', '#D3D3D3'); 
                      }
                      else
                      {
                           element.css("font-size", "1em");
                           element.css("padding", "5px");      
                      }
                },
                eventAllow: function(dropLocation, draggedEvent) {
                     if(draggedEvent.start < CurrentDate)
                      {
                           return false;
                      }      
                },
                eventDrop: function(event, delta, revertFunc) { // si changement de position
                     edit(event);
                },       
       	});
           $('#listePatient').editableSelect({
                effects: 'slide', 
                editable: false,            // warpClass: 'ui-select-wrap', 
           });
           $("#listePatient").on("keyup", function() {
                //to call ajax
                remoteSearch();    
           });
           $(".es-list").click(function(e) 
           {
                $("#btnSave").removeAttr("disabled")
           });
           $('[data-dismiss=modal]').on('click', function (e) {
                var $t = $(this),
                target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
                $(target)
                  .find("input,textarea,select")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
           });
     });
  </script>
@endsection
@section('main-content')
    <div class="row">
           <div class="col-md-12">
                <div class="panel panel-default">
                     &nbsp;&nbsp;&nbsp;&nbsp; 
                     <div class="panel-heading" style="margin-top:-20px">
                           <div class="left"> <strong>Liste Des Rendez-Vous</strong></div>
                     </div>
                     <div class="panel-body">
                   	      <div  class="calendar1"></div>
                     </div>
                </div>
           </div>
    </div>
    <div class="row">   
          <div id="myModal" class="modal fade">
                <div class="modal-dialog">
                     <div class="modal-content">
                          <div class="modal-header" style="padding:35px 50px;">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                                <h4 id="modalTitle" class="modal-title"><span class="glyphicon glyphicon-bell"></span> Ajouter Rendez-Vous</h4>
                           </div>
                           <form id ="addRdv" role="form" action="/createRDV"method="POST">
                                      {{ csrf_field() }}
                                      <input type="datetime" id="date_RDV" name="date_RDV" data-date-format='yyyy-mm-dd' value="" style="display:none;">
                                      <input type="datetime" id="date_Fin" name="date_Fin" data-date-format='yyyy-mm-dd' value="" style="display:none;">
                                      <input type="time" id="Temp_rdv" name="Temp_rdv"  value=""  min="8:00" max="18:00" style="display:none;" >
                                     <div id="modalBody" class="modal-body">
                                           <div class="row">
                                                 <label for="patient"><span class="glyphicon glyphicon-user"></span><strong> Selectioner le patient :</strong></label>
                                                 <div class="input-group col-sm-6">
                                                      <select id="listePatient" name ="listePatient" style="width:300px;" required></select>                        
                                                 </div> 
                                           </div>
                                           <div class="space-12"></div>
                                     </div>{{-- modalBody --}}
                                     <div class="modal-footer">
                                           <button class="btn btn-primary" type="submit" id ="btnSave">Enregistrer  </button>                                         
                                           <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                     </div>   
                           </form> 
                      </div>
                </div>
          </div>
    </div>
    <div class="row">
      <!-- Modal --> 
<div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
     <div class="modal-content">
     <div class="modal-header"  style="padding:35px 50px;">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
           <h5 class="modal-title" id="myModalLabel">
                <span class="glyphicon glyphicon-bell"></span>
                 Modifier Rendez-Vous du <q><a href="" id="lien"><span id="patient" class="blue"> </span></a></q>
           </h5>
           <hr>
           <div class="row">
                <div class="col-sm-6">    
                     <i class="fa fa-phone" aria-hidden="true"></i>tel:&nbsp;<span id="patient_tel" class="blue"></span>
                </div>
                <div class="col-sm-6">
                     Age:&nbsp;<span id="agePatient" class="blue"></span> <small>Ans</small>
                </div>
              </div>
     </div>
      <div class="modal-body">
           <form id ="updateRdv" role="form" action="" method="POST">      {{-- {{route('rdv.update',5)}} /rdv/5--}}
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="id_rdv" id ="id_rdv"/>
                <div class="well">
                     <div class="row">
                           <label for="date"><span class="glyphicon glyphicon-time fa-lg"></span><strong> Date Rendez-Vous :</strong></label>
                           <div class="input-group">
                                <input class="form-control" id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd HH:mm:ss" readonly/>
                           </div>
                     </div>
                     <div class="row" class= "invisible">
                           <div class="input-group">
                                <input class="form-control" id="datefinrdv" name ="datefinrdv" type="text" data-date-format="yyyy-mm-dd HH:mm:ss" style="display:none"/>
                           </div>
                      </div>             
                </div>  {{-- well --}}
           </form>   
      </div>
      <br>
      <div class="modal-footer center">
      @if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role =="Medecine")
      <a type="button" id="btnConsulter" class="btn btn btn-sm btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
     <button type="button" class="btn btn btn-sm btn-info" onclick="update();">
                @if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role !="Receptioniste") 
                        <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer</button>
                 @endif       
      <a  href=""  id="btnDelete" class="btn btn-bold btn-sm btn-danger" data-method="DELETE" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal">
                <i class="fa fa-trash" aria-hidden="true"></i> Annuler
     </a>
     <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">
           <i class="fa fa-undo" aria-hidden="true" ></i> Fermer</button>
     @endif
      </div>
    </div>
  </div>
</div>{{-- modal --}}
    </div>

@endsection

