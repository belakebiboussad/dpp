
	function ajaxATCD(patientid){
  	var type = $('#Antecedant').val();
		var date = $('#dateAntcd').val();
 		var description = $('#description').val();
	}
  function checkForm(form)
  {
   	$('.nav-pills li.active').removeClass('active');
    $('div#ExamClinique').removeClass('active');
    $('div#ExamComp').removeClass('active');
    $('div#Interogatoire').addClass('in active');
    $( "li[name='motif']" ).addClass('active');
    $('div#ATCD').removeClass('active');
                     $('div#Motif').addClass('in active');
                	var lieu = $('#lieuc').val();
                	var motif = $('#motif').val();
                	var histoirem = $('#histoirem').val();
                	var resume = $('#resume').val();
                     var inputVal = new Array(lieu,motif,histoirem,resume);
     		var inputMessage = new Array("lieu","motif","histoire de la maladie","resumé");
                	$('.error').each(function(i, obj) {
                		$(obj).next().remove();
   			$(obj).detach();
		});
        		if(inputVal[0] == ""){
          			$('#error').after('<span class="error"> STP selection le ' + inputMessage[0]+' de la consultation '  + '</span>'+'<br/>');		
        		   	return false;
        		}
        		if(inputVal[1] == ""){
          			 $('#error').after('<span class="error"> STP saisir le ' + inputMessage[1]+' de la consultation '  + '</span>'+'<br/>');
     			return false;
                	}
                	if(inputVal[2] == ""){
          			 $('#error').after('<span class="error"> STP saisir le ' + inputMessage[2]+' de la consultation '  + '</span>'+'<br/>');
          			return false
          		}
          		if(inputVal[3] == ""){
          			 $('#error').after('<span class="error"> STP saisir le ' + inputMessage[3]+' de la consultation '  + '</span>'+'<br/>');
          			 return false;
          		}
				
        		return true; 
  }
	function addAppareils(appareil)
	{
  	       $("#"+appareil).each(function(i){
			if(($(this).find(".wysiwyg-editor").text()) !=" ");
				$('input:hidden[name="' + appareil + '"]').val($(this).find(".wysiwyg-editor").text());
                   $(this).collapse('hide');
		});
	}
	function removeAppareilsContent(appareil)
	{
		$("#"+appareil).each(function(i){
			$(this).find(".wysiwyg-editor").text("");
		});
	}  