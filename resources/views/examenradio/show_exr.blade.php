@extends((( Auth::user()->role->id === 12) ? 'app_radiologue' : 'app_med' ))
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
           var checkbox = $("#isOriented");
           var hidden = $("#hidden_fields");
           checkbox.change(function() {
                if (checkbox.is(':checked')) {
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
});
</script>
@endsection
@section('main-content')
<div class="page-header" width="100%">
  <?php $patient = $demande->consultation->patient; ?> 
    @include('patient._patientInfo')        
</div>
<div class="content">
  <div class="row">
    <div class="col-sm-3"></div> <div class="col-sm-3"></div> <div class="col-sm-3"></div>
    <div class="col-sm-3">
      <a href="/showdemandeexr/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-primary pull-right" title="Imprimer">
         <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 widget-container-col" id="consultation">
      <div class="widget-box" id="infopatient">
        <div class="widget-header">
          <h5 class="widget-title"><b>Détails de la demande des examens Radiologiques :</b></h5>
        </div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="row">
              <div class="col-xs-12">
                  <label><b>Date Demande:</b></label>&nbsp;&nbsp;&nbsp;&nbsp;<span>{{ $demande->Date }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <label><b>Informations cliniques pertinentes :</b></label>
                &nbsp;&nbsp;<span>{{ $demande->InfosCliniques }}.</span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label><b>Explication de la demande de diagnostic :</b></label>
                 &nbsp;&nbsp;<span>{{ $demande->Explecations }}.</span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label><b>Informations supplémentaires pertinentes :</b></label>
                <div>
                  <ul class="list-inline"> 
                    @foreach($demande->infossuppdemande as $index => $info)
                      <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label><b>Examen(s) proposé(s) :</b></label>
                <div>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="center" width="10%">#</th>
                        <th class="center">Nom</th>
                        <th class="center">Type</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($demande->examensradios as $index => $examen)
                    <tr>
                      <td class="center">{{ $index + 1 }}</td>
                      <td>{{ $examen->nom }}</td>
                      <td>
                        <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
                        @foreach($exams as $id)
                        <span class="badge badge-success">{{ App\modeles\exmnsrelatifdemande::FindOrFail($id)->nom}}</span>
                        @endforeach
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div><!-- row -->
            @if(Auth::user()->role->id == 12)
            <div class="row">
              <div class="space-12">
                <form class="form-horizontal" method="POST" action="/uploadexr" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
                <div class="form-group">
                  <div class="col-xs-2">
                    <label><b>Upload Résultat :</b></label>
                  </div>
                  <div class="col-xs-8">
                    <input type="file" id="id-input-file-2" name="resultat" placeholder ="fichier..." class="form-control" accept="image/*,.pdf" required/>
                  </div>
                </div>
                <div class="clearfix form-actions">
                  <div class="col-md-offset-5 col-md-7">
                    <button class="btn btn-info" type="submit">
                    <i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
                    Démarrer l'envoie
                    </button>
                  </div>
                </div>
                </form>
              </div>
            </div>
             @endif
            <div class="row">
              <div class="space-12">
                <label>Résultat :</label>&nbsp;&nbsp;
                @isset($demande->resultat)
                  <span><a href='/download/{{ $demande->resultat }}'>{{ $demande->resultat }} &nbsp;<i class="fa fa-download"></i></a></span>
                @endisset
              </div>
            </div> 
        </div><!-- widget-main -->
      </div>
    </div>
  </div>
</div>
@endsection
