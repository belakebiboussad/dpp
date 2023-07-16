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
  $error_msg.delay(2000).fadeOut(350);
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
function getProducts(url, callBack=null) {
  var html = '';
  $.ajax({
    url : url,
    type : 'GET',
    success : function(data){
      $.each(data, function(){
        html += "<option value='"+this.id+"'>"+this.nom+"</option>";
      });
      $('.produit').html(html);
      callBack(data);
    }
  });
}
function selectedSpecDrug(spec)
{
  getProducts('/drug?spec_id='+spec,function(){});
}
function commonError(data) {
  return "Une erreur s'est produite pendant l'opération. Veuillez réessayer";
}