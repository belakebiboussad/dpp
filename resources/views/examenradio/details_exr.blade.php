@extends('app_radiologue')
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
            <span class="lbl"> {{ $demande->consultation->patient->Nom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Prénom :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Prenom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Sexe :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Date Naissance :</strong></span>
            <span class="lbl"> {{ $demande->consultation->patient->Dat_Naissance }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Age :</strong></span>
            <span class="lbl"> {{ Jenssegers\Date\Date::parse($demande->consultation->patient->Dat_Naissance)->age }} ans</span>
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
            <h5 class="widget-title"><b>Détails d'un examen radiologique :</b></h5>
          </div>
          <div class="widget-body">
            <div class="widget-main">
              <div class="row">
                <div class="col-xs-12">
                    <label><b>Date :</b></label>&nbsp;&nbsp;<span>{{ $demande->Date }}</span>
                    <br><br>
                    <label><b>Informations cliniques pertinentes :</b></label>
                    &nbsp;&nbsp;<span>{{ $demande->InfosCliniques }}.</span>
                    <br><br>
                    <label><b>Explication de la demande de diagnostic :</b></label>
                    &nbsp;&nbsp;<span>{{ $demande->Explecations }}.</span>
                    <br><br>
                    <label><b>Informations supplémentaires pertinentes :</b></label>
                    <div>
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class="center" width="10%">#</th>
                            <th>Nom</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($demande->infossuppdemande as $index => $info)
                            <tr>
                              <td class="center">{{ $index + 1 }}</td>
                              <td>{{ $info->nom }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <br>
                    <label><b>Examen(s) proposé(s) :</b></label>
                    <div>
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class="center" width="10%">#</th>
                            <th>Nom</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($demande->examensradios as $index => $examen)
                            <tr>
                              <td class="center">{{ $index + 1 }}</td>
                              <td>{{ $examen->nom }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <br>
                    <label>
                      <b>Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic :</b>
                    </label>
                    <div>
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class="center" width="10%">#</th>
                            <th>Nom</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($demande->examensrelatifsdemande as $index => $exm)
                            <tr>
                              <td class="center">{{ $index + 1 }}</td>
                              <td>{{ $exm->nom }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <form class="form-horizontal" method="POST" action="/uploadexr" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
                      <div class="form-group">
                        <div class="col-xs-2">
                          <label><b>Upload Résultat :</b></label>
                        </div>
                        <div class="col-xs-8">
                          <input type="file" id="id-input-file-2" name="resultat" />
                        </div>
                      </div>
                      <div class="clearfix form-actions">
                        <div class="col-md-offset-5 col-md-7">
                          <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Enregistrer
                          </button>
                        </div>
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
@endsection
