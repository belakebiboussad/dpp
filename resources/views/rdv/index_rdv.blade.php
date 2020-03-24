@extends('app_recep')
@section('style')
        <style>
                #patient {        /*padding: 5px;*/ }
                .option {
                  padding: 5px;
                  display: none;
                  color: white;
                  background: orange;
                  cursor: hand;
                }
                .option:hover {
                  color: orange;
                  background: white;
                }
        
                .es-list {
               
                    max-height: 50px !important;
                    width:250px;
                     overflow:scroll;
                     -webkit-overflow-scrolling: touch;
                }
  </style>
@endsection
@section('page-script')
  {!! $planning->script() !!}
    <script>
          function  showModal1(id,title,date,idPatient,tel,age) {
                var CurrentDate = (new Date()).setHours(0, 0, 0, 0);
                GivenDate = (new Date(date)).setHours(0, 0, 0, 0);
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

      <script>
      $(document).ready(function(){
                $('#patient').editableSelect({
                      effects: 'slide', 
                      editable: false,  
                      // warpClass: 'ui-select-wrap',
                });
                $("#patient").on("keyup", function() {
                      //to call ajax
                      remoteSearch();    
                });
                $(".es-list").click(function(e) 
                { 
                });

     });
      function go(startDate, endDate, jsEvent, view, resource)
      {
              //var a= moment.tz(startDate, "Europe/London").format();
              //alert(startDate.time());
              // alert(calEvent.start.);
              //alert(endDate);
      }
     function showModal(date)
     {
                var a = moment.tz(date, "Africa/Algiers").format('YYYY-MM-DD HH:mm');
                var mydate = moment(a).format("YYYY-MM-DD");
               alert(mydate);
                var heur= moment(a).format('HH:mm:ss');
                var x = moment.tz(new Date(), "Africa/Algiers").format('YYYY-MM-DD HH:mm');
                var CurrentDate = moment(x).format("YYYY-MM-DD");            
                if (mydate >= CurrentDate  ) { 
                     $('#date_RDV').datepicker("setDate",mydate);//new Date(yyyy,mm,dd)
                     $('#Temp_rdv').val(heur);//new Date(yyyy,mm,dd)
                     $("#fullCalModal").modal();
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
                          $(".es-list").append($('<li></li>').attr('value', v['id']).attr('class','es-visible list-group-item option').text(v['code_barre']+" "+v['Nom']+" "+v['Prenom']));   
                    }); 
                },
                error: function() {
                  alert("can't connect to db");
                }
            });
      }
      </script>

 @endsection
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                   <div class="panel panel-default">
                   &nbsp;&nbsp;&nbsp;&nbsp; <div class="panel-heading" style="margin-top:-20px">
                    <div class="left"> <strong>Liste Des Rendez-Vous</strong></div>
        
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
                          @if(Auth::user()->role->id == 2) 
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
      @if(Auth::user()->role->id == 1)
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
            @if(Auth::user()->role->id !=2)  
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title">Ajouter Rendez-Vous</h4>
            </div>
           <form id ="addRdv" role="form" action="/createRDV"method="POST">
                {{ csrf_field() }}
                <input type="datetime" id="date_RDV" name="date_RDV" data-date-format='yyyy-mm-dd' value="">{{-- style="display:none;" --}}
                <input type="time" id="Temp_rdv" name="Temp_rdv"  value=""  min="8:00" max="18:00" >              {{-- style="display:none" --}}
                
                <div id="modalBody" class="modal-body">
                      <div class="row">
                           <fieldset class="inline-fields"> 
                                <label for="patient"><strong>Selectioner le patient :</strong></label>
                                <select id="patient" name ="patient" style="width:300px;" required></select>                        
                           </fieldset>
                      </div>
                      <div class="space-12"></div>
                </div>{{-- modalBody --}}
                <div class="modal-footer">
                      <button class="btn btn-primary" type="submit">Enregistrer</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                 </div>
        </div>
        </form> 
           @else
             @endif 
    </div>
</div>
@endsection
