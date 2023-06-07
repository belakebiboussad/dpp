<script  type="text/javascript" charset="utf-8" async defer>
function showNssPat(bool)
{
  if(bool)
  {
    $("#foncform").removeClass('hidden');
    $('#nsspatient').attr('disabled', false);
  }else
  {
    $("#foncform").addClass('hidden');
    $('#nsspatient').attr('disabled', true);
  }
}
function assureShow(type)
{
  if($('.nav-pills li').eq(1).hasClass( "hidden" ))
     $('.nav-pills li').eq(1).removeClass('hidden');
  if($("div#Assure").hasClass( "hidden" ))
    $("div#Assure").removeClass('hidden');
  if(!$('#otherPat').hasClass( "hidden" ))
  {
    $("#otherPat").addClass('hidden');
    $('#description').val('');
  }
  if($('#assProfData').hasClass( "hidden" ))
    $("#assProfData").removeClass('hidden');
  switch(type){
    case "1":
      if(!$('#asdemogData').hasClass( "hidden" ))
      {
        $("#asdemogData").addClass('hidden');
        $("#asdemogData").find('input').attr('disabled', true);
      } 
      break;
    case  "2": case "3": case "4": case "5":
      if($('#asdemogData').hasClass( "hidden" ))
      {
        $("#asdemogData").removeClass('hidden');
        $("#asdemogData").find('input').attr('disabled', false);
      } 
      break;
  }  
}
function assurHide()
{
  var active_tab_selector = $('#menuPatient a[href="#Assure"]').attr('href');
  $('#menuPatient a[href="#Assure"]').parent().addClass('hidden');
  $(active_tab_selector).removeClass('active').addClass('hidden');
  //$(active_tab_selector).find('input').attr('disabled', true);
  $('.nav-pills a[href="#Patient"]').tab('show');
  $("#otherPat").removeClass('hidden');
}
function patTypeChange(type)
{
  switch(type){
       case "1":
          assureShow(type);
        if(!$("#foncform").hasClass('hidden'))
          showNssPat(false);
        break;
      case  "2": case "3": case "4": case "5":
          assureShow(type);
        if($("#foncform").hasClass('hidden'))
           showNssPat(true);
        break;
      case "6":
        assurHide();
        if(!$("#foncform").hasClass('hidden'))
          showNssPat(false);
        break; 
      default:
      break;   
  }
} 
/*
function showTypeEdit(type,i)
{
  if(i == 0)
  {
    switch(type){
      case "1":
        assureShow(type);
        if(!$("#foncform").hasClass('hidden'))
          showNssPat(false)
        break;
      case "2": case "3": case "4": case "5":
        assureShow(type);
        if($("#foncform").hasClass('hidden'))
          showNssPat(true);
        break;
      case "6":
        assurHide();
        if(!$("#foncform").hasClass('hidden'))
          showNssPat(false);
        break;
      default:
        break; 
    }   
  }else
    patTypeChange($('#type').val());
}
*/
/*function resetAsInp(){$('#Assure').find('input').val('');  $('#Assure').find("select").prop("selectedIndex",0);}*/
</script>