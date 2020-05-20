<<<<<<< HEAD
@extends('app_med')
@section('page-script')
<script src="{{asset('/js/jquery.min.js')}}"></script>
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
           // Get the form fields and hidden div
           var checkbox = $("#isOriented");
           var hidden = $("#hidden_fields");
           // Setup an event listener for when the state of the 
           // checkbox changes.
           checkbox.change(function() {
                if (checkbox.is(':checked')) {
                     // Show the hidden fields.
                     hidden.show();
                     // Populate the input.
                     // populate.val("Dude, this input got populated!");
                    } else {
                          // Make sure that the hidden fields are indeed
                          // hidden.
                          hidden.hide();
                          // This would do the job:
            //
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
});
</script>
@endsection
@section('main-content')
<div class="page-header" width="100%">
   <div class="row">
    <div class="col-sm-12">
      <div class="widget-box">
        <div class="widget-body">
          <div class="widget-main">
            <label class="inline">
            <span class="blue"><strong>Nom :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Nom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Prénom :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Prenom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Sexe :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Date Naissance :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Dat_Naissance }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Age :</strong></span>
            <span class="lbl"> {{ Jenssegers\Date\Date::parse($consultation->patient->Dat_Naissance)->age }} ans</span>
          </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="content">
  <div class="row">
    <div class="col-sm-12">
       <div class="col-sm-12 widget-container-col">
          @foreach($specialites as $specialite)
          <div class="widget-box transparent" id="widget-box-12">
            <div class="widget-header">
              <h4 class="widget-title lighter"> 
                {{ $specialite->specialite }}
              </h4>
            </div>
            <div class="widget-body">
              <div class="widget-main padding-6 no-padding-left no-padding-right">
                <div class="space-6"></div>
                  <div class="row">
                    <form method="POST" action="{{ route('demandeexb.store') }}">
                      {{ csrf_field() }}
                      <input name="id_consultation" value="{{ $consultation->id }}" hidden>
                      @foreach($specialite->examensbio as $exbio)
                      <div class="col-xs-3">
                        <div class="checkbox">
                          <label>
                            <input name="exm[]" type="checkbox" class="ace" value="{{ $exbio->id }}" />
                            <span class="lbl"> 
                              {{ $exbio->nom_examen }}
                            </span>
                          </label>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              <div class="clearfix form-actions">
                <div class="col-md-offset-5 col-md-7">
                  <button type="submit" class="btn btn-info">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Enregistrer
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
=======
<!DOCTYPE html>
<html>
<head>
  <title>Demande examens biologiques</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   {{--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}   {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}} {{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
     <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}"/>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
 <script src="{{asset('/js/bootstrap.min.js')}}"></script>
  <style type="text/css">
    table 
    {
        border-collapse: collapse;
    }
    table, th, td 
    {
        border: 1px solid black;
        padding: 5px;
    }
    .section
    {
      margin-bottom: 20px;
    }
    .sec-gauche
    {
      float: left;
    }
    .sec-droite
    {
      float: right;
    }
    .center
    {
      text-align: center;
    }
    .col-sm-12
    {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <h3 class="center">Direction Générale de la Sûreté Nationale</h3>
  <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE</h4>
  <h4 class="center">Tél : 23-93-34</h4>
  <br><br>
  <div class="center">
    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($demande->consultation->patient->IPP, 'C128')}}" alt="barcode" />
  </div>
  <br><br>
  <h4 class="center"><b>Demande examens biologiques</b></h4>
  <br><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-gauche">
          <b><u>Patient :</u></b> 
          {{ $demande->consultation->patient->Nom }} 
          {{ $demande->consultation->patient->Prenom }}
          &nbsp;
          {{ Jenssegers\Date\Date::parse($demande->consultation->patient->Dat_Naissance)->age }} ans
        </div>
        <div class="sec-droite">
          <b><u>Alger le :</u></b> {{ $demande->DateDemande }}.
        </div>
      </div>
    </div>
    <br><br>
    <div class="col-sm-12">
      <label>Liste Des examens :</label>
      <br><br>
      <ul>
        @foreach($demande->examensbios as $exb)
        <li>{{ $exb->nom_examen }}</li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
</body>
</html>
>>>>>>> dev
