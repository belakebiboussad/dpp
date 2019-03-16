@extends('app')
@section('style')
<style>
      .modal {
        width:105.3% !important;
        right:-16% !important;
        left:-2.5% !important;
        top:-3% !important;
    }
    .modal-body
    {
        top: -1px !important;
    }
    .dataTables_wrapper {
        font-family: tahoma;
        font-size: 10px;
        position: relative;
        clear: both;
        *zoom: 1;
        zoom: 1;
    }
  .btn-transparent {
      background: transparent;
      color: #F2F2F2;
      -webkit-transition: background .2s ease-in-out, border .2s ease-in-out;
      -moz-transition: background .2s ease-in-out, border .2s ease-in-out;
      -o-transition: background .2s ease-in-out, border .2s ease-in-out;
      transition: background .2s ease-in-out, border .2s ease-in-out;
      border: 2px solid #4992B7;
  }
    .btn-transparent:hover {
        color: white;
        background-color: rgba(255,255,255,0.2);
    }
    .my-right-float {
        margin-right: -10px;
    }
</style>
@endsection
@section('page-script')    
<script>
      $('document').ready(function(){
           $( 'ul.nav li' ).on( 'click', function() {
           $(this).siblings().addClass('filter');
      });
      $('.wysiwyg-editor').on('input',function(e){
            a = $(this).parent().nextAll("div.clearfix");
            var i = a.find("button:button").each(function(){
               $(this).removeAttr('disabled');
            });
      });
      $(function() {
           var checkbox = $("#isOriented");  // Get the form fields and hidden div
           var hidden = $("#hidden_fields");  // Setup an event listener for when the state of the 
           // checkbox changes.
           checkbox.change(function() {
                if (checkbox.is(':checked')) {
                     // Show the hidden fields.
                     hidden.show();
                    } else {
                                hidden.hide();
                                $("#lettreorientaioncontent").val("");
                      }
            })
      }); 
      $(".two-decimals").change(function(){
          this.value = parseFloat(this.value).toFixed(2);
      });
 function maxLengthCheck(object) {
      if (object.value.length > object.maxLength)
        object.value = object.value.slice(0, object.maxLength)
  }
  function isNumeric (evt) {
      var theEvent = evt || window.event;
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode (key);
      var regex = /[0-9]|\./;
      if ( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
  }
     $("button").click(function (event) {
           which = '';
           str ='send';
           which = $(this).attr("id");
           var which = $.trim(which);
           var str = $.trim(str);
           if(which==str){
                   return true;
          }
      });
     $("#btnCalc").click(function(event){
            event.preventDefault();
      });
        $('#medc_table').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                "bInfo" : false,
                searching: false,
                pageLength: 5,         
                bLengthChange: false,
                nowrap:true,
                "language": {
                      "url": '/localisation/fr_FR.json'
                },
                ajax: '/getmedicaments',
                      columns: [
                          {data: 'Nom_com'},
                          {data: 'Forme'},
                          {data: 'Dosage'},
                          {data: 'action', name: 'action', orderable: false, searchable: false}
                      ]
        });
        $('#Ordonnance').on('show.bs.modal', function () {
               $('.modal-content').css('height',$( window ).height()*1.4);
      });
   });

</script>
@endsection
@section('title')
  Nouvelle Consultation
@endsection
@section('main-content')
<div class="page-header" width="100%">
  @include('partials._patientInfo')
</div>
<div class="content">
<form action="/consultations/store/{{$patient->id}}" method="POST" role="form" id ="consultForm" class="passenger-validation" onsubmit="return checkForm(this);"  novalidate>
  {{ csrf_field() }}
  <div id="prompt"></div>
  <div class="tabpanel">
           <ul class = "nav nav-pills nav-justified list-group" role="tablist" id="menu">
                <li role= "presentation" class="active col-md-4">
                    <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-secondary btn-lg">
                     <i class="fa fa-commenting" aria-hidden="true"></i>
                      <span class="bigger-160"> Interogatoire</span></a>
                </li>
                <li role= "presentation"  class="col-md-4">
                    <a href="#ExamClinique"  ria-controls="ExamClinique" role="tab" data-toggle="tab" class="btn btn-success btn-lg"> 
                      <span class="bigger-160">Examen Clinique</span></a>
                </li>
                <li role= "presentation" class="col-md-4">
                      <a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-danger btn-lg" >
                          <span class="bigger-160">Examen Complémentaire</span>
                      </a>
                </li>
           </ul>
          <div class ="tab-content"  style = "border-style: none;" >
                    <div role="tabpanel" class = "tab-pane active " id="Interogatoire"> 
                          <div class= "col-md-12 col-xs-12">
                                @include('consultations.Interogatoire')
                          </div>  {{--  <div class= "col-md-3 col-xs-9"> </div> --}}
                    </div>
                 {{-- finexamenclinique --}}
                   <div role="tabpanel" class = "tab-pane" id="ExamClinique">
                          <div class="row">
                                <div class= "col-md-12 col-xs-12">
                                      @include('consultations.examenClinique')
                                </div>
                           </div>  {{-- row --}}
                   </div> {{-- finexamenclinique --}}
                   <div role="tabpanel" class = "tab-pane" id="ExamComp">
                         <div class= "col-md-12 col-xs-12">    
                              @include('consultations.ExamenCompl')   
                          </div>{{-- <div class= "col-md-3 col-xs-9"> </div> --}}
                  </div> 

  </div>
  
    <div class="space-12"></div>
   <div class="center">
   <br><br>
    <div id="error" aria-live="polite"></div>
   <div class="space-12"></div>
  <button class="btn btn-info" type="submit" id="send">
    <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
  </button>
  &nbsp; &nbsp; &nbsp;
  <button class="btn btn-info" type="button" id="annuler">
    <i class="ace-icon fa fa-undo-110"></i>Annuler
  </button> 
</div>
</div>
</form>
</div>
<!-- Modal -->
<div id="Ordonnance" class="modal" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
      <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Ordonnance</h4>
           @include('partials._patientInfo')
      </div>
      <div class="modal-body">
      {{--     <div class="container-fluid"></div>      --}}
                 @include('consultations.Ordonnance')    
      </div> 
    </div>

  </div>
</div>
{{-- endModal --}}

<!-- Modal -->

<div>
  @include('consultations.LettreOrientation')
</div>
{{-- endModal --}}
 
<!-- Modal -->
<div id="demandehosp" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content custom-height-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Demande d'hospitalisation</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <div class="row">
            <div class="col-md-12">
              <div>
        <label for="mode"><b>Mode Admission</b></label>
        <br/>
        <select class="form-control" id="modeAdmission" name="modeAdmission">
                <option value="">Sélectionner...</option>
           @foreach($modesAdmission as $mode =>$value)
                 <option value="{{ $mode}}">{{ $value }}</option>
           @endforeach
           </select>
        </div>
        <br/><br/><br/>
        <div>
          <label for="specialite"><b>Specialite:</b></label>
         <select class="form-control" id="specialiteDemande" name="specialiteDemande">
            <option value="">Sélectionner...</option>
           @foreach($specialites as $specialite)
             <option value="{{ $specialite->id}}">
              {{$specialite->nom}}
              </option>
           @endforeach 
          </select>
      </div>
          <br/><br/><br/>
          <div>
            <label for="degreurg"><b>Service</b></label>
            <select class="form-control" id="service" name="service">

              <option value="">Sélectionner...</option>

                     @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->nom }}</option>
                      @endforeach     
            </select>
          </div>
          <br/>

        </div>

      </div>
    </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="demandehosp()">
             <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
          </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">
               <i class="ace-icon fa fa-close bigger-110"></i>Fermer
           </button>
      </div>
    </div>
  </div>
</div>
@endsection
