function activaTab(tab){
      $('.nav-pills a[href="#' + tab + '"]').tab('show');
}
function printSuccessMsg(form ,msg) {
  var $success_msg = $(".print-success-msg");
  $success_msg.html(msg);
  $success_msg.css('display','block');
  $success_msg.delay(1000).fadeOut(350);//
  setTimeout("$('.modal').modal('hide');",1000);
}
function printErrorMsg (msg) {//form=null, 
  var $error_msg = $(".print-error-msg");
  $error_msg.find("ul").html('');
  $error_msg.css('display','block');
  $.each( msg, function( key, value ) {
    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
  });
  $error_msg.delay(1000).fadeOut(350);
}
function cancelMeeting(id,callBack)
{
  var eventDelete = confirm("êtes-vous sûr ?");
  if(eventDelete)
  {
    $.ajax({
      type: "DELETE",
      url : '/rdv/' + id,
      data: { _token: CSRF_TOKEN},
      success: function (data) {
        callBack(data);  
      }
    });
  } 
}
function formSubmit(form, e, callBack) {
  var $success_msg = $(".print-success-msg");
  var $error_msg = $(".print-error-msg");
  var $form = $(form);
  var formData = new FormData(form);
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: $form.attr("action"),
    type:$form.attr("method"),
    data: formData,
    processData : false,
    contentType: false,
    cache : false,
    success: function(data,status, xhr) {
      $form.trigger("reset");
      if( $.isEmptyObject(data.errors))
        printSuccessMsg(form, data.success);    
      else
        printErrorMsg(data.errors);  
      callBack(status,data);
    }
  })
}
  function checkHomme(){
      var errors =[];
      var nomH = $('#nom_h').val();var prenomH = $('#prenom_h').val();
      var type_piece_id = $('#type_piece_id').val();  var npiece_id = $('#num_piece').val();
      mobileH = $('#mobile_h').val();
      var inputHomVal = new Array(nomH,prenomH,type_piece_id,npiece_id,mobileH);
      var inputHomMessage = new Array("Nom","Prenom","Type de la pièce","Numero de la pièce","Téléphone mobile");
      $('.error').each(function(i, obj) {
        $(obj).next().remove();
        $(obj).detach();
      });
      jQuery.each( inputHomVal, function( i, val ) {
        if(val =="" )
        { 
          errors.push('Veuiller remplir le ' + inputHomMessage[i]+' du Correspondant');
        }
      });   
      return errors;
  }