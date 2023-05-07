function activaTab(tab){
  $('.nav-pills a[href="#' + tab + '"]').tab('show');
}
function printSuccessMsg(form ,msg) {
  var $success_msg = $(".print-success-msg");
  $success_msg.html(msg);
  $success_msg.css('display','block');
  $success_msg.delay(3000).fadeOut(350);
  $('.modal').modal('hide');
}
function printErrorMsg (form, msg) {
  var $error_msg = $(".print-error-msg");
  $error_msg.find("ul").html('');
  $error_msg.css('display','block');//$.each( msg, function( key, value ) { //});
  $error_msg.find("ul").append('<li>'+msg+'</li>');
  $error_msg.delay(3000).fadeOut(350);
}
function formSubmit(form, e, callBack) {
  var $success_msg = $(".print-success-msg");
  var $error_msg = $(".print-error-msg");
  var $form = $(form);
  var url = $form.attr("action");
  formData = new FormData(form);
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url:url,
    type:$form.attr("method"),
    data:formData,
    dataType: "json",
    processData : false,
    contentType: false,
    cache : false,
    success: function(data) {
      $form.trigger("reset");
      if($.isEmptyObject(data.errors))
        printSuccessMsg(form, data.success);
      else
        printErrorMsg(form, data.errors);
    }
  })
}
function copyPatient(){ 
  $("#asdemogData").addClass('hidden');
  $("#foncform").addClass('hidden');
}
  function checkPatient()
  {
    var erreur =true;
    var nom = $('#nom').val();
    var prenom = $('#prenom').val();
    var type = $('#type').val();
    var inputAssVal = new Array(type,prenom,nom);
    var inputMessage = new Array('Type',"Prenom","Nom");
    $('.error').each(function(i, obj) {
      $(obj).next().remove();
      $(obj).detach();
    });
    jQuery.each( inputAssVal, function( i, val ) {
      if(val =="" )
      {
        erreur =false;
        $('#error').after('<span class="error">Veuiller remplir le(la) ' + inputMessage[i]+' du Patient </span>'+'<br/>');
      }
   });
   return erreur;
  }
  function checkAssure()
  {
    var erreur =true;
    var nss = $('#nss').val();
    var inputAssVal = new Array(nss);
    var inputMessage = new Array("Numèro de Secruté Social");
    if($("#type").val() != 1)
    {
      var prenomf = $('#prenomf').val();
      var nomf = $('#nomf').val();
      inputAssVal.push(prenomf,nomf);
      inputMessage.push("Prenom","Nom");
    }
    $('.error').each(function(i, obj) { $(obj).next().remove(); $(obj).detach();  });
    jQuery.each( inputAssVal, function( i, val ) {
      if(val =="" )
      {
        erreur =false;
        $('#error').after('<span class="error">Veuiller remplir le(la) ' + inputMessage[i]+' du l\'Assure </span>'+'<br/>');
      }
    });
    return erreur;
  }
  function checkHomme(){
      var erreur =true;
      var nomA = $('#nomA').val();var prenomA = $('#prenomA').val();
      var type_piece_id = $('#type_piece_id').val();
      var npiece_id = $('#npiece_id').val();
      mobileA = $('#mobileA').val();
      var inputHomVal = new Array(npiece_id,type_piece_id,mobileA,prenomA,nomA);
      var inputHomMessage = new Array("Numero de la pièce","Type de la pièce","Téléphone mobile","Prenom","Nom");
      $('.error').each(function(i, obj) {
            $(obj).next().remove();
            $(obj).detach();
     });
      jQuery.each( inputHomVal, function( i, val ) {
        if(val =="" )
        {
          erreur =false;
          $('#error').after('<span class="error">Veuiller remplir le(la) ' + inputHomMessage[i]+' du Correspondant</span>'+'<br/>');
       }
      });   
     return erreur;
    }