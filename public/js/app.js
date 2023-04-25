function formSubmit(form, e, callBack) {
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
      alert(data.errors);
      /*
      if($.isEmptyObject(data.errors))
      {
        alert(data.errors);
        printSuccessMsg(data.success);
      } 
      else
      {
        alert(data.errors);
        printErrorMsg(data.errors);
      }
      */
    }
  })
}