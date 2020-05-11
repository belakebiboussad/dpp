@extends('app_laboanalyses')
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
   <?php $patient = $demande->consultation->patient; ?> 
    @include('patient._patientInfo')    
</div>
<div class="content">
  <div class="row">
    <div class="col-sm-12">
      <div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="center">#</th>
              <th>Examen</th>
              <th><em class="fa fa-cog"></em></th>
            </tr>
          </thead>
          <tbody>
              @foreach($demande->examensbios as $index => $exm)
                <tr>
                  <td class="center">{{ $index + 1 }}</td>
                  <td>{{ $exm->nom_examen }}</td>
                  <td></td>
                </tr>
              @endforeach                         
          </tbody>
        </table>
      </div>
      <form class="form-horizontal" method="POST" action="/uploadresultat" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="text" name="id_demande" value="{{ $demande->id_demandeexb }}" hidden>
        <div class="form-group">
          <div class="col-xs-2">
            <label><b>Upload Résultat :</b></label>
          </div>
          <div class="col-xs-8">
            <input type="file" id="id-input-file-2" name="resultat" placeholder ="fichier..." class="form-control" required/>
          </div>
        </div>
        <div class="clearfix form-actions">
          <div class="col-md-offset-5 col-md-7">
            <button class="btn btn-info" type="submit">
             <!--  <i class="ace-icon fa fa-upload bigger-110"></i> -->
             <i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
              Démarrer l'envoie
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
