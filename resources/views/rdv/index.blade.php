@extends('app')
@section('style')
<style>
     .fc-agendaWeek-view tr {
          height: 40px;
      }
     .fc-agendaDay-view tr {
          height: 40px;
     }
     .es-list { 
            max-height: 160px !important;
            margin-left: 0px;
            margin-right: -1  px; 
             overflow-y: scroll;
     }
     .es-list li {
                list-style: none;
      }
     .input-group.md-form.form-sm.form-1 input{
            border: 1px solid #bdbdbd;
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
      }
     </style>

@endsection
@section('page-script') {{-- {!! $planning->script() !!} --}}
      <script>
      function createRDVModal(debut,fin)
      {        
                var CurrentDate = (new Date()).setHours(0, 0, 0, 0);
                var GivenDate = (new Date(debut)).setHours(0, 0, 0, 0);
                if( CurrentDate <= GivenDate )
                { 
                     debut = moment(debut).format('YYYY-MM-DD HH:mm'); //debut = moment.tz(debut, "America/Los_Angeles").format('YYYY-MM-DD HH:mm');
                     fin = moment(fin).format('YYYY-MM-DD HH:mm');     //fin = moment.tz(fin, "Europe/London").format('YYYY-MM-DD HH:mm');
                      var heur= moment(debut).format('HH:mm:ss');
                     $('#date_RDV').val(debut); $('#date_Fin').val(fin); $('#Temp_rdv').val(heur);
                     $('#myModal').modal({
                                 show: 'true'
                      }); 
               }
      }
      //reccherche par nom
     function remoteSearch(field,value) {

            $.ajax({
                url : '{{URL::to('getPatients')}}',
                data: {    
                    "field":field,
                    "value":value,
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
                     $("#daterdv").val(event.start.format('YYYY-MM-DD HH:mm'));
                     $("#datefinrdv").val(event.end.format('YYYY-MM-DD HH:mm'));
                     $('#btnConsulter').attr('href','/consultations/create/'.concat(event.idPatient));
                     $('#btnDelete').attr('href','/rdv/'.concat(event.id));   //$('#updateRdv').attr('action','/rdv/'.concat(event.idrdv));
                     var url = '{{ route("rdv.update", ":slug") }}';
                     url = url.replace(':slug',event.id);
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
     function reset_in()
     {
           $('.es-list').val('');
           $('#listePatient').val('');
     }
     function layout()
     {
           reset_in(); 
           var field = $("select#filtre option").filter(":selected").val();
           if(field == "Dat_Naissance")
              {
                $('#listePatient').datepicker().format("YYYY-MM-DD");
                $("#btnSave").attr("disabled",false);
              }
           else
           { 
                $("#btnSave").attr("disabled", true);
                $("#listePatient").datepicker("destroy");
           }
               
     }
  	$(document).ready(function() {
           var CurrentDate = (new Date()).setHours(0, 0, 0, 0); 
       	$('.calendar1').fullCalendar({
                header: {
                      left: 'prev,next today',
                      center: 'title',
                      right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'agendaWeek',  //weekends: false,
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
                eventLimit: true, // allow "more" link when too many events      // displayEventEnd: true,       
                hiddenDays: [ 5, 6 ],
               weekNumberCalculation: 'ISO',
                views: {},
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
       	}); // calendar
           $('#listePatient').editableSelect({
               effects: 'default', 
                editable: false, 
           }).on('select.editable-select', function (e, li) {
                     $('#last-selected').html(
                             li.val() + '. ' + li.text()
                      );
                     $("#btnSave").removeAttr("disabled");
           });
           $("#listePatient").on("keyup", function() {
                var field = $("select#filtre option").filter(":selected").val();
                if(field != "Dat_Naissance")
                      remoteSearch(field,$("#listePatient").val());        //to call ajax
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
                <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                          <div class="modal-header" style="padding:35px 50px;">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                                <h4 id="modalTitle" class="modal-title"><span class="glyphicon glyphicon-bell"></span> Ajouter Rendez-Vous</h4>
                           </div>
                           <form id ="addRdv" role="form" action="/createRDV" method="POST">
                                      {{ csrf_field() }}
                                      <input type="datetime" id="date_RDV" name="date_RDV" data-date-format='yyyy-mm-dd' value="" style="display:none;">
                                      <input type="datetime" id="date_Fin" name="date_Fin" data-date-format='yyyy-mm-dd' value="" style="display:none;">
                                      <input type="time" id="Temp_rdv" name="Temp_rdv"  value=""  min="8:00" max="18:00" style="display:none;" >
                                      <div id="modalBody" class="modal-body" style="padding:40px 50px;">
                                           <div class="panel panel-default">
                                                <div class="panel-heading" style="">
                                                      <span class="glyphicon glyphicon-user"></span>Rechercher un Patient
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
                                                                           <option value="code_barre">Code</option>
                                                                           <option value="Dat_Naissance">Date Naisssance</option>
                                                                           </select>
                                                                </div>
                                                                </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                <span class="input-icon" style="margin-right: -190px;">

                                                                <select  placeholder="Rechercher... " class="nav-search-input" id="listePatient" name ="listePatient" autocomplete="off" style="width:300px;" data-date-format="yyyy-mm-dd">
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
                                           <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"onclick="reset_in();"><i class="fa fa-undo" aria-hidden="true"  ></i>Fermer</button>
                                     </div>   
                           </form> 
                      </div>
                </div>
          </div>
    </div>
    <div class="row">
      <!-- Modal --> 
<div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog modal-lg" role="document">
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
                     <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" class="blue"></span>
                </div>
                <div class="col-sm-6">
                     <strong>Age:&nbsp;</strong>
                     <span id="agePatient" class="blue"></span> <small>Ans</small>
                </div>
              </div>
     </div>
      <div class="modal-body">
           <form id ="updateRdv" role="form" action="" method="POST">      {{-- {{route('rdv.update',5)}} /rdv/5--}}
                {{ csrf_field() }}
                {{ method_field('PUT') }}
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
      <div class="modal-footer">
      @if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role =="Medecine")
      <a type="button" id="btnConsulter" class="btn btn btn-sm btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
     <button type="button" class="btn btn-sm btn-primary" onclick="update();">
                @if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role !="Receptioniste") 
                        <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer</button>
                 @endif       
      <a  href=""  id="btnDelete" class="btn btn-bold btn-sm btn-danger" data-method="DELETE" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal">
                <i class="fa fa-trash" aria-hidden="true"></i> Annuler
     </a>
     <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
           <i class="fa fa-undo" aria-hidden="true" ></i> Fermer</button>
     @endif
      </div>
    </div>
  </div>
</div>{{-- modal --}}
    </div>

@endsection

