@extends('app_recep')
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
               }else
               {
                  //alert("Non");
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
                   ;
                    $.each(data['data'], function(i, v) {
                        $(".es-list").append($('<li></li>').attr('value', v['id']).attr('class','es-visible list-group-item option').text(v['code_barre']+"-"+v['Nom']+"-"+v['Prenom']));   
                      });
                },
                error: function() {
                  alert("can't connect to db");
                }
            });
      }

      function updateRDVModal(id,title,beginDate,endDate,idPatient,tel,age)
      {

      }
  	$(document).ready(function() {
       	$('.calendar1').fullCalendar({
                header: {
                      left: 'prev,next today',
                      center: 'title',
                      right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '2019-03-12',
                defaultView: 'agendaWeek',
                firstDay: 7, 
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectHelper: true,
               minTime:'08:00:00',
                maxTime: '20:00:00',
                themeButtonIcons: {
                     prev: 'fa fa-caret-left',
                     next: 'fa fa-caret-right',
                },
                select: function(start, end) {
                     createRDVModal(start,end);
                },
                dayClick: function(date, allDay, jsEvent, view)
                {
                      //alert(date); // Gives Sat Nov 21 2015 19:00:00 GMT+0000
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
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
                                     {{--url:'http://localhost:8000/patient/{{ $rdv->patient->id }}',--}}
                           },
                           @endforeach 
                ],
                eventClick: function(calEvent, jsEvent, view) {
                      updateRDVModal(calEvent.id,calEvent.title,calEvent.start,calEvent.end,calEvent.idPatient,calEvent.tel,calEvent.age);
                },       
       	});
           $('#listePatient').editableSelect({
                effects: 'slide', 
                editable: false,  
                      // warpClass: 'ui-select-wrap',
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
                          <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                                <h4 id="modalTitle" class="modal-title">Ajouter Rendez-Vous</h4>
                           </div>
                           <form id ="addRdv" role="form" action="/createRDV"method="POST">
                                      {{ csrf_field() }}
                                      <input type="datetime" id="date_RDV" name="date_RDV" data-date-format='yyyy-mm-dd' value="" style="display:none;">{{-- style="display:none;" --}}
                                      <input type="datetime" id="date_Fin" name="date_Fin" data-date-format='yyyy-mm-dd' value="" style="display:none;">
                                      <input type="time" id="Temp_rdv" name="Temp_rdv"  value=""  min="8:00" max="18:00" style="display:none;" >
                                     <div id="modalBody" class="modal-body">
                                           <div class="row">
                                                 <label for="patient"><b>Selectioner le patient :</b></label>
                                                 <div class="input-group col-sm-6">
                                                      <select id="listePatient" name ="listePatient" style="width:300px;" required></select>                        
                                                 </div> 
                                           </div>
                                           <div class="space-12"></div>
                                     </div>{{-- modalBody --}}
                                     <div class="modal-footer">
                                           <button class="btn btn-primary" type="submit" id ="btnSave" disabled>Enregistrer  </button>                                         
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
     <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
          <h5 class="modal-title" id="myModalLabel">
              Modifier Rendez-Vous <q><a href="" id="lien"><span id="patient" class="blue"></span></a> </q>
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
      {{-- {{route('rdv.update',5)}} /rdv/5--}}
           <form id ="updateRdv" role="form" action="" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="id_rdv" id ="id_rdv"/>
                <div class="row">
                      <label for="date"><b>Date Rendez-Vous :</b></label>
                      <div class="input-group">
                          @if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role =="Receptioniste") 
                                  <input class="form-control" id="daterdv" type="text" data-date-format="yyyy-mm-dd" desable readonly />
                           @else
                               <input class="form-control date-picker" id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd" required 
                                /><span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span> 
                           @endif 
                     </div>
                </div>
           </form>   
      </div>
 
      <div class="modal-footer center">
      @if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role =="Medecine")
      <a type="button" id="btnConsulter" class="btn btn btn-sm btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
     <button type="button" class="btn btn btn-sm btn-info" onclick="envoie();">
          <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer</button>
      <a  href=""  id="btnDelete" class="btn btn-bold btn-sm btn-danger" data-method="DELETE" data-confirm="Etes Vous Sur ?" data-dismiss="modal">
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

