<script  type="text/javascript" charset="utf-8" async defer>
function showNssPat(bool)
{
  if(bool)
  {
    $("#foncform").removeClass('hidden');
    $('#nsspatient').prop('disabled', false);
  }else
  {
    $("#foncform").addClass('hidden');
    $('#nsspatient').attr('disabled', false);
  }
}
function copyPatient(){ 
  alert("ici");
  $("#foncform").addClass('hidden');
  $("#asdemogData").addClass('hidden');
}
function assurHide()
{
  var active_tab_selector = $('#menuPatient a[href="#Assure"]').attr('href');
  $('#menuPatient a[href="#Assure"]').parent().addClass('hide');
  $(active_tab_selector).removeClass('active').addClass('hide');
  $('.nav-pills a[href="#Patient"]').tab('show');
  $("#otherPat").removeClass('hidden');
}
function showTypeAdd(type, i)
{ 
  switch(type){
    case "1":
      if ($('ul#menuPatient li:eq(1)').hasClass("hide"))
        assureShow();
      copyPatient();
      if(i !=1)
        $(".asProfData").val('');
      break;
    case "2": case "3": case "4": case "5":
      if ($('ul#menuPatient li:eq(1)').hasClass("hide"))
        assureShow();
      if($("#asdemogData").hasClass("hidden")) 
        $("#asdemogData").removeClass('hidden'); 
      if($("#foncform").hasClass('hidden'))
        showNssPat(true);
      if(i != 1)
        $(".asProfData").val('');
      if(type == "2")
      {
        $("#sf").prop("selectedIndex", 2).change();
        $("#SituationFamille").prop("selectedIndex", 2).change();
      }
      break;
    case "6":
      assurHide();
      resetAsInp();
      if(!$("#foncform").hasClass('hidden'))
        showNssPat(false);
      break;
    default:
      break;
  }
}
</script>