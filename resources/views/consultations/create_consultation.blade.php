@extends('app')
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
           // Get the form fields and hidden div
           var checkbox = $("#isOriented");
           var hidden = $("#hidden_fields");
           // Setup an event listener for when the state of the 
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
});
</script>
@endsection
<<<<<<< HEAD
@section('title')
  Nouvelle Consultation
@endsection
=======
>>>>>>> ramzi
@section('main-content')
<div class="page-header" width="100%">
  @include('partials._patientInfo')
</div>
<div class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="widget-box">
        <div class="widget-body">
          <div class="widget-main">
            <form class="form-horizontal" method="POST" action="{{ route('consultations.store') }}">
              {{ csrf_field() }}
              <input type="text" name="id_patient" value="{{ $patient->id }}" hidden>
              <div class="form-group">
                  <div class="col-sm-9">
                    <div class="checkbox">
                      <label>
                        <input name="isOriented" type="checkbox" class="ace"/>
                        <span class="lbl"> Patient Orienté</span>
                      </label>
                    </div>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"> <b>Motif De Consultation :</b> </label>
                  <div class="col-sm-9">
                    <input type="text" id="motif" name="motif" placeholder="Motif De Consultation..." class="col-xs-10 col-sm-5"/>
                    <p class="col-xs-12">
                      {!! $errors->first('motif', '<small class="alert-danger"><b>:message</b></small>') !!}
                    </p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right"> <b>Histoire de la maladie :</b> </label>
                  <div class="col-sm-9">
                    <textarea id="histoire" name="histoire" class="col-xs-10 col-sm-5"></textarea>
                    <p class="col-xs-12">
                      {!! $errors->first('histoire', '<small class="alert-danger"><b>:message</b></small>') !!}
                    </p>
                  </div>
                </div>
                <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"> <b>Diagnostic :</b> </label>
                  <div class="col-sm-9">
                    <input type="text" id="diag" name="diag" placeholder="Diagnostic..." class="col-xs-10 col-sm-5" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right"> <b>Résumé :</b> </label>
                  <div class="col-sm-9">
                    <textarea id="resume" name="resume" class="col-xs-10 col-sm-5"></textarea>
                    <p class="col-xs-12">
                      {!! $errors->first('resume', '<small class="alert-danger"><b>:message</b></small>') !!}
                    </p>
                  </div>
                </div>
                <div class="clearfix form-actions">
                  <div class="col-md-offset-4 col-md-8">
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
@endsection
