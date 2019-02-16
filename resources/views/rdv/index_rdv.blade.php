@extends('app_recep')
{{-- @section('style') --}}
{{-- @endsection --}}
@section('page-script')
  {!! $planning->script() !!}
    <script>
          function  showModal(id,title,date,idPatient,tel,age) {
                var CurrentDate = (new Date()).setHours(0, 0, 0, 0);
                GivenDate = (new Date(date)).setHours(0, 0, 0, 0);;
                if( CurrentDate <= GivenDate )
                {
                     $('#patient').text(title);
                     $('#updateRdv').attr('action','/rdv/'.concat(id));
                     $('#lien').attr('href','/patient/'.concat(idPatient));
                     $('#btnConsulter').attr('href','/consultations/create/'.concat(idPatient));
                     $('#btnDelete').attr('href','/rdv/'.concat(id));
                     $("#id_rdv").val(id);
                      $('#patient_tel').text(tel);
                      $('#agePatient').text(age);
                     $("#daterdv").val(date.format('Y-MM-DD'));
                     $('#myModal').modal({
                           show: 'true'
                     }); 
                }
          }
          function envoie()
          {
                $('form#updateRdv').submit();
          }
       </script>

       <script>/*
                $(function() {
                              $('#calendar-{{$planning->getId()}}').fullCalendar({
                              selectable: true,
                              header: {
                              left: 'prev,next today',
                              center: 'title',
                              right: 'month,agendaWeek,agendaDay'
                              },
                              dayClick: function(date) {
                              alert('clicked ' + date.format());
                              },
                              select: function(startDate, endDate) {
                              alert('selected ' + startDate.format() + ' to ' + endDate.format());
                              }
                              });

                });*/

         //////////////

      //<![CDATA[
        $(document).ready(function(){
          $('#editable-select').editableSelect({
  // // enable filter
  // filter: true,
  // // default, fade or slide
  // effects: 'default',
  // // fast, slow or [0-9]+
  // duration: 'fast',
  // // Where to append the dropdown list.
  // appendTo: 'body',
  // // "focus" or "manual"
  // trigger: 'focus',
  // // callback events
  // onCreate: function () {},
  // onShow: function () {},
  // onHide: function () {},
  // onSelect: function (element) {}
    warpClass: 'ui-select-wrap',
  editable: true


          });
          });
      //]]>
    

         ///////////////////
       </script>

 @endsection
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
                   <div class="panel panel-default">
                   &nbsp;&nbsp;&nbsp;&nbsp; <div class="panel-heading" style="margin-top:-20px">
                    <div class="left"> <strong>Liste Des Rendez-Vous</strong></div>
                    <div class="right" style ="margin-top:-25px"><a href="/choixpatient" class ="btn btn-sm btn-success" class="right"><i class="ace-icon  fa fa-plus-circle bigger-120"></i>&nbsp;Rendez-vous</a></div>
                   
                   </div>
                  <div class="panel-body">
                            {!! $planning->calendar() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal --> 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                             Age:&nbsp;<span id="agePatient" class="blue"></span>
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
                                  <input class="form-control" id="daterdv" type="text" data-date-format="yyyy-mm-dd" desable readonly /><span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i> 
                           @else
                               <input class="form-control date-picker" id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd" required 
                                /><span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i>    
                          </span> 
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

<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title">Ajouter Rendez-Vous</h4>
            </div>
            <div id="modalBody" class="modal-body">
                    @if(App\modeles\rol::where("id",Auth::User()->role_id)->get()->first()->role !="Receptioniste") 
                        <form id ="addRdv" role="form" action="" method="POST">
                       {{ csrf_field() }}
                      <div class="row">
                              <label for="patient"><b>Selectioner le patient :</b></label>
                              <div class="input-group col-sm-6">
                                      {{-- <input class="form-control" id="patient" name="patient" type="text" required />     --}}
                                   {{--   <select class=" col-sm-12 combobox optional overall classes" id="patient" name="patient" 
                                            data-btn-class="option toggle classes" required>
                                                  <option value="">Choisir un Patient...</option>
                                     </select> --}}
                                  <select id="editable-select">
                                            <option>Alfa Romeo</option>
                                            <option>Audi</option>
                                            <option>BMW</option>
                                            <option>Citroen</option>
                                </select>   
                               </div>    
                      </div>
                      <div class="space-12"></div>
                       <div class="row">
                                <label for="dadaterdvte"><b>Date Rendez-Vous :</b></label>
                                <div class="input-group col-sm-6">
                                      <input class="form-control date-picker " id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd" required 
                                          /><span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i>    
                                    </span>    
                               </div>
                       </div>
           </form> 
           @else
           @endif 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button>
            </div>
        </div>
    </div>
</div>
@endsection
