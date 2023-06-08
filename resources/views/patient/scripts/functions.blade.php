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
    $('#nsspatient').prop('disabled', true);
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
        $("#otherPat").addClass('hidden'); $('#description').val('');
  }
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
  $(active_tab_selector).removeClass('active').addClass('hidden');  //$(active_tab_selector).find('input').attr('disabled', true);
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
} /*function resetAsInp(){$('#Assure').find('input').val('');  $('#Assure').find("select").prop("selectedIndex",0);}*/
function validPatient()
{
   var erreur =false;
    var nom = $('#nom').val();
     var prenom = $('#prenom').val();
    var type = $('#type').val();
    var inputAssVal = new Array(type,prenom,nom);
    var inputMessage = new Array('Type',"Prenom","Nom");
    $('.error').each(function(i, obj) {
          $(obj).next().remove(); $(obj).detach();
    });
    jQuery.each( inputAssVal, function( i, val ) {
         if((val =="") || ( val== null))
         {
               if(!erreur) 
                      erreur =true;
                $('#error').after('<span class="error">Veuiller remplir le(la) ' + inputMessage[i]+' du Patient </span>'+'<br/>');
          }
   });
   return erreur;
}
 function validAssure()
 {
   var erreur =false;
   var type =$("#type").val();
   if(type ==6)
        return erreur;
    var nss = $('#nss').val();
    var inputAssVal = new Array(nss);
      var inputMessage = new Array("Numèro de Secruté Social");
       if(type != 1)
        {
              var prenomf = $('#prenomf').val();var nomf = $('#nomf').val();
              inputAssVal.push(prenomf,nomf); inputMessage.push("Prenom","Nom");
        }
         $('.error').each(function(i, obj) { $(obj).next().remove(); $(obj).detach();  });
          jQuery.each( inputAssVal, function( i, val ) {
        if(val =="" )
        {
                if(!erreur) 
                      erreur =true;
              $('#error').after('<span class="error">Veuiller remplir le(la) ' + inputMessage[i]+' du l\'Assure </span>'+'<br/>');
        }
      });
      return erreur;
  }
</script>