@extends('app')
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
                    <div>
                      <label for="infosc">
                        <b>Informations cliniques pertinentes</b>
                      </label>
                      <textarea class="form-control" id="infosc" name="infosc">
                      </textarea>
                      {!! $errors->first('infosc', '<small class="alert-danger"><b>:message</b></small>')!!}
                    </div>
                    <br><br>
                    <div>
                      <label for="explication">
                        <b>Explication de la demande de diagnostic</b>
                      </label>
                      <textarea class="form-control" id="explication" name="explication">
                      </textarea>
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
