<div class="modal fade" id="RDV" role="dialog" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog  modaldialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h5 class="modal-title" id="myModalLabel"><strong>Ajouter un rendez-vous</strong></h5>
      </div>
      <div class="modal-body bodyodal">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default"> &nbsp;&nbsp;&nbsp;&nbsp; 
              <div class="panel-heading" style="margin-top:-20px"> <div class="left"></div></div>
              <div class="panel-body"><div class="calendar"></div> </div>
              <div class="panel-footer">
                <span class="badge" style="background-color:#87CEFA">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px"><strong>&nbsp;RDV fixe</strong></span>
                <span class="badge" style="background-color:#378006">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px"><strong>&nbsp;RDV à fixer</strong></span> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        <h5 class="modal-title" id="myModalLabel">
          <span class="glyphicon glyphicon-bell"></span>&nbsp;Modifier le rendez-vous du <q><a href="" id="lien" style="color: inherit;"></a></q>
        </h5><hr>
      </div>
      <div class="modal-body"><div class="space-12"></div>
          <div class="row">
            <div class="col-sm-6">    
              <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" class="green"></span>
            </div>
            <div class="col-sm-6"><strong>Age:&nbsp;</strong><span id="agePatient" class="blue"></span><small>Ans</small></div>
          </div>
          <div class="space-12"></div>
          <div class="row">   
          <form id ="updateRdv" role="form" action="" method="POST"> 
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" id="idRDV">
            <div class="well">
            <div class="row">
              <div class="col-sm-6"> 
                <label for="date"><span class="glyphicon glyphicon-time fa-lg"></span><strong> Date Rendez-Vous :</strong></label>
                <div class="input-group">
                 <input class="form-control" id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd HH:mm:ss" readonly/>
                </div>
              </div>
              <div class="col-sm-6">
                <label for="date"><span class="glyphicon glyphicon-time fa-lg"></span><strong> Type Rendez-Vous :</strong></label>
                <div class="input-group">
                  <label class="block"><input type="checkbox" class="ace" id="fixecbx" name="fixecbx"/><span class="lbl">Fixe </span></label>
                </div> 
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
    </div>
    <br>
    <div class="modal-footer">
      @if(Auth::user()->role->id == 1)
        @if( empty($patient))
          <a type="button" id="btnConsulter" class="btn btn btn-sm btn-primary"><i class="fa fa-file-text" aria-hidden="true"></i> Consulter </a>
         @endif
        @if(Auth::user()->role->id  != 2)  
          <button type="button" id ="updateRDV" class="btn btn-sm btn-primary" type ="submit"><i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer
        </button>
      @endif
      <a href ="#" id="printRdv" class="btn btn-success btn-sm"  data-dismiss="modal"> <i class="ace-icon fa fa-print"></i>Imprimer </a>
      <a href="#"  id="btnRdvDelete" class="btn btn-bold btn-sm btn-danger" data-method="DELETE" data-dismiss="modal" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?">  <i class="fa fa-trash" aria-hidden="true"></i> Annuler
      </a>
      <button type="button" class="btn btn-sm btn-default" id ="btnclose" data-dismiss="modal"><!-- onclick="$('#updateRDV').addClass('invisible');" -->
           <i class="fa fa-close" aria-hidden="true" ></i> Fermer
      </button>
     @endif
      </div>
    </div>
  </div>
</div>{{-- modal --}}
<div class="modal fade" id="dlg" tabindex="-1" role="dialog" >
     <div class="modal-dialog modal-lg" role="document"> <div class="modal-content">@include('rdv.Dialogs.rdvDlg')</div> </div> 
</div>
<script>
  $(function(){//calendrier  
    var CurrentDate = (new Date()).setHours(23, 59, 59, 0);var today = (new Date()).setHours(0, 0, 0, 0);
    $('.calendar').fullCalendar({//plugins: [ 'dayGrid', 'timeGrid' ],
        header: {
          left: 'prev,next today',
          center: 'title',
         right: 'month,agendaWeek,agendaDay'
        },
        defaultView : 'basicWeek',//'agendaWeek',
        height: 650,//teste
        showAgendaButton: true,
        timeFormat: 'H:mm',
        axisFormat: 'H:mm',// teste
        firstDay: 0,
        slotDuration: '00:15:00',
        minTime:'08:00:00',
        maxTime: '17:00:00',
        navLinks: true,
        selectable: true,
        selectHelper: true,
        eventColor  : '#87CEFA',
        editable: true,
        hiddenDays: [ 5, 6 ],
        weekNumberCalculation: 'ISO',
        aspectRatio: 2,
        eventLimit: true,
        allDaySlot: false,
        eventDurationEditable : false,//weekNumbers: true,views: {},
        events: [
         @foreach($employe->rdvs as $rdv)
         {  
          title : '{{ $rdv->patient->full_name  }} ' +', ('+{{ $rdv->patient->age }} +' ans)',
          start : '{{ $rdv->date }}',
          end:   '{{ $rdv->fin }}',
          id :'{{ $rdv->id }}',
          idPatient:{{$rdv->patient->id}},
          tel:'{{$rdv->patient->tele_mobile1}}',
          age:{{ $rdv->patient->age }},
          specialite:{{ $rdv->specialite_id }}, 
          fixe:  {{ $rdv->fixe }},
        },
        @endforeach 
      ],
      eventRender: function (event, element, webData) {
        if(event.start < today) // element.find('.fc-title').append("," + event.tel);// element.css("font-size", "1em");
           element.css('background-color', '#D3D3D3');
        else
        { 
               if(event.fixe>0)
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
      select: function(start, end,jsEvent, view) {
        var minutes = end.diff(start,"minutes"); 
        if((minutes == 15) && (start > today)) {
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
              if(!isEmpty(result.value))
                createRDVModal(start,end,'{{ $patient->id }}',result.value);          
            })
        }else
          $('.calendar').fullCalendar('unselect');//calendar1
      },
      eventAllow: function(dropLocation, draggedEvent) {  return false; },
      eventDrop: function(event, delta, revertFunc) { revertFunc(); },
      eventDragStop: function (event, jsEvent, ui, view) {return false;} 
    });
  })
</script>