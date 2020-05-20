<<<<<<< HEAD
@extends('app')
@section('page-script')
{{-- 
<script src="{{ asset('/js/select2.min.js') }}"></script> --}}
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
     $('.select2').css('width','400px').select2({allowClear:true})
           $('#select2-multiple-style .btn').on('click', function(e){
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                if(which == 2) $('.select2').addClass('tag-input-style');
                     else $('.select2').removeClass('tag-input-style');
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
=======
<!DOCTYPE html>
<html>
<head>
  <title>Demande examens biologiques</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}"/> <script src="{{ asset('/js/jquery.min.js') }}"></script>  <script src="{{asset('/js/bootstrap.min.js')}}"></script>
 --}}
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
  <h3 class="center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h3>
  <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE</h4>
  <h4 class="center">Chemin des Glycines - ALGER</h4>
  <h4 class="center">Tél : 23-93-34</h4>
  <br><br>
  <div class="center">
    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($demande->consultation->patient->IPP, 'C128')}}" alt="barcode" />
  </div>
  <br><br>
  <div class="page-header" width="100%">
>>>>>>> dev
   <div class="row">
    <div class="col-sm-12">
      <div class="widget-box">
        <div class="widget-body">
          <div class="widget-main">
            <label class="inline">
            <span class="blue"><strong>Nom :</strong></span>
<<<<<<< HEAD
            <span class="lbl"> {{ $consultation->patient->Nom }}</span>
=======
            <span class="lbl"> {{ $demande->consultation->patient->Nom }}</span>
>>>>>>> dev
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Prénom :</strong></span>
<<<<<<< HEAD
            <span class="lbl"> {{ $consultation->patient->Prenom }}</span>
=======
            <span class="lbl"> {{ $demande->consultation->patient->Prenom }}</span>
>>>>>>> dev
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Sexe :</strong></span>
<<<<<<< HEAD
            <span class="lbl"> {{ $consultation->patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
=======
            <span class="lbl"> {{ $demande->consultation->patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
>>>>>>> dev
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Date Naissance :</strong></span>
<<<<<<< HEAD
            <span class="lbl"> {{ $consultation->patient->Dat_Naissance }}</span>
=======
            <span class="lbl"> {{ $demande->consultation->patient->Dat_Naissance }}</span>
>>>>>>> dev
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Age :</strong></span>
<<<<<<< HEAD
            <span class="lbl"> {{ Jenssegers\Date\Date::parse($consultation->patient->Dat_Naissance)->age }} ans</span>
=======
            <span class="lbl"> {{ Jenssegers\Date\Date::parse($demande->consultation->patient->Dat_Naissance)->age }} ans</span>
>>>>>>> dev
          </label>
          </div>
        </div>
      </div>
    </div>
  </div>
<<<<<<< HEAD
</div>
<div class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="col-xs-12 widget-container-col" id="consultation">
        <div class="widget-box" id="infopatient">
          <div class="widget-header">
            <h5 class="widget-title"><b>Demande d'un examen radiologique :</b></h5>
          </div>
          <div class="widget-body">
            <div class="widget-main">
              <div class="row">
                <div class="col-xs-12">
                  <form method="POST" action="{{ route('demandeexr.store') }}">
                    {{ csrf_field() }}
                    <input type="text" name="id_consultation" value="{{ $consultation->id }}" hidden>
=======
  </div> <!-- page-header -->
  <div class="content">
      <div class="col-sm-12">
        <div class="col-xs-12 widget-container-col" id="consultation">
          <div class="widget-box" id="infopatient">
            <div class="widget-header">
              <h4 class="widget-title center "><b>Demande d'un examen radiologique</b></h4>
            </div>
            <div class="widget-body">
              <div class="widget-main">
                <div class="row">
                  <div class="col-xs-12">
                    <br>
>>>>>>> dev
                    <div>
                      <label for="infosc">
                        <b>Informations cliniques pertinentes</b>
                      </label>
<<<<<<< HEAD
                      <textarea class="form-control" id="infosc" name="infosc"></textarea>
                      {!! $errors->first('infosc', '<small class="alert-danger"><b>:message</b></small>')!!}
                    </div>
                    <br><br>
                    <div>
                      <label for="explication">
                        <b>Explication de la demande de diagnostic</b>
                      </label>
                      <textarea class="form-control" id="explication" name="explication"></textarea>
                      {!! $errors->first('explication', '<small class="alert-danger"><b>:message</b></small>')!!}
                    </div>
                    <br><br>
                    <div>
                      <label for="infos">
                        <b>Informations supplémentaires pertinentes</b>
                      </label>
                      <div class="row">
                        @foreach($infossupp as $info)
                        <div class="col-xs-2">
                          <div class="checkbox">
                            <label>
                              <input name="infos[]" type="checkbox" class="ace" value="{{ $info->id }}" />
                              <span class="lbl"> 
                                {{ $info->nom }}
                              </span>
                            </label>
                          </div>
                        </div>
                        @endforeach
                      </div>
                      {!! $errors->first('infos', '<small class="alert-danger"><b>:message</b></small>')!!}
                    </div>
                    <br><br>
                    <div>
                      <label for="explication">
                        <b>Examen(s) proposé(s)</b>
                      </label>
                      <select multiple="" name="examensradio[]" class="select2" data-placeholder="Séléctionner...">
                        @foreach($examensradio as $examenradio)
                        <option value="{{ $examenradio->id }}">
                          {{ $examenradio->nom }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    {!! $errors->first('examensradio', '<small class="alert-danger"><b>:message</b></small>')!!}
                    <br><br>
                    <div>
                      <label for="infos">
                        <b>Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic</b>
                      </label>
                      <div class="row">
                        @foreach($examens as $examen)
                        <div class="col-xs-2">
                          <div class="checkbox">
                            <label>
                              <input name="exmns[]" type="checkbox" class="ace" value="{{ $examen->id }}" />
                              <span class="lbl"> 
                                {{ $examen->nom }}
                              </span>
                            </label>
                          </div>
                        </div>
                        @endforeach
                      </div>
                      {!! $errors->first('exmns', '<small class="alert-danger"><b>:message</b></small>')!!}
                    </div>
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
        </div>
    </div>
  </div>
</div>
@endsection
=======
                      <textarea class="form-control" id="infosc" name="infosc" >{{ $demande->InfosCliniques }}</textarea>
                    </div>                    
                    <br>                  
                    <div>
                              <label for="infos">
                                <b>Informations supplémentaires pertinentes</b>
                              </label>
                              <textarea class="form-control" id="infosc" name="infosc" >{{ $demande->Explecations }}</textarea> 
                    </div>              
                     
                  
                    <br>
                    <div>
                        <label><b>Informations supplémentaires pertinentes</b></label>
                        <div>
                          <ul class="list-inline">
                              @foreach($demande->infossuppdemande as $index => $info)
                                  <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                              @endforeach
                          </ul>    
                        </div>
                    </div>
                    
                    <div>
                         <label><b>Examen(s) proposé(s)</b></label>
                        <div>
                          <table class="table table-borderless">
                         
                            
                              @foreach($demande->examensradios as $index => $examen)
                                <tr>
                                  <td class="center">{{ $index + 1 }}</td>
                                  <td>{{ $examen->nom }}</td>
                                </tr>
                              @endforeach
                          
                          </table>
                        </div>
                  </div>
                  <div>
                    <label>
                      <b>Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic</b>
                    </label>
                    <div>
                      <table class="table table-borderless">
                        
                          @foreach($demande->examensrelatifsdemande as $index => $exm)
                            <tr>
                              <td class="center">{{ $index + 1 }}</td>
                              <td>{{ $exm->nom }}</td>
                            </tr>
                          @endforeach
                        
                      </table>
                    </div>
                  </div>  
                   
              </div>
            </div><!-- .row -->
          </div>  
        </div>
      </div>
  </div>
  </div>
</div><!-- container-fluid -->
</body>
</html>
>>>>>>> dev
