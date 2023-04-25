function printSuccessMsg(msg) {
  $success_msg.html(msg);
  $success_msg.css('display','block');
  $success_msg.delay(5000).fadeOut(350);
  $('#changePWD')[0].reset();
}
function printErrorMsg (msg) {
  var $success_msg = $(".print-success-msg");
  var $error_msg = $(".print-error-msg");
  $error_msg.find("ul").html('');
  $error_msg.css('display','block');
  $.each( msg, function( key, value ) {
      $error_msg.find("ul").append('<li>'+value+'</li>');
  });
  $error_msg.delay(5000).fadeOut(350);
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
      //alert(data.errors);
      //alert(data);//.success
      if($.isEmptyObject(data.errors))
      {
        printSuccessMsg(data.success);
      } 
      else
      {
        printErrorMsg(data.errors);
      }
    }
  })
}