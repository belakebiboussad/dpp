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
      // $.each(data, function(key, value){
      //   alert(key +":"+ value);
      // })
      $form.trigger("reset");
      if($.isEmptyObject(data.errors))
        printSuccessMsg(form, data.success);
      else
        printErrorMsg(form, data.errors);
    }
  })
}