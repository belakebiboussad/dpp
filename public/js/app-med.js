	function IMC1(){
		
		var poids = $("#poids").val();
		var taille = $("#taille").val();
		if(poids==""){
      			alert("STP, saisir le poids");
     			$("#poids").focus();
      			return 0;
    		}
    		else if (isNaN(poids)) {
      			alert("poids doit être un nombre!");  
      			$("#poids").select();
      			return 0;
    		}
 		if(taille==""){
      			alert("STP, Saisir la taille");
-      			$("#taille").focus();
      			return 0;
    		}
    		else if (isNaN(taille)) {
      			alert("taille doit être un nombre!");  
      			$("#txtaltura").select();
      			return 0;
    		}
    		var imc = poids / Math.pow(taille,2);
    		var imc = Math.round(imc).toFixed(2);
		$("#imc").attr("value", imc);
                     var resultado;
                     if(imc<17){
                           $("#interpretation").attr("value", "Anorexie");
                      }
                      else if(imc>=17.1 && imc<=18.49){
                           $("#interpretation").attr("value", "Migreur");
                     }
                     else if(imc>=18.5 && imc<=24.99){
                           $("#interpretation").attr("value", "Poids Normale");
                     }
                     else if(imc>=25 && imc<=29.99){
                           $("#interpretation").attr("value", "surpois");
                      }
                      else if(imc>=30 && imc<=34.99){
			$("#interpretation").attr("value", "Obésité I");
	           }
                     else if(imc>=35 && imc<=39.99){
                       	$("#interpretation").attr("value", "Obésité II (sévère)");	
                      }
                     else if(imc>=40){
                       	$("#interpretation").attr("value", "Obésité III (morbide)");	
                     }
	}
	function IMC(){
		try {	

			if($('#poids').val() != null && $('#taille').val() != null && $('#taille').val() != 0 )
			{
				// var imc =  $('#poids').val() /($('#taille').val()*$('#taille').val());
				var imc =  $('#poids').val() /(Math.pow($('#taille').val(), 2));
				var imc = Math.round(imc).toFixed(0);
				$("#imc").attr("value", imc);	
			}
		
		}
		catch(err) 
		{
	    		$("#imc").attr("value", err.message);
	   	 }
	     	switch (true)
	     	 {
			case (imc <= 16.5) :
			           $("#interpretation").attr("value", "Anorexie");
			           break;
			case (imc <= 18.5) :
			           $("#interpretation").attr("value", "migreur");
			           break;
			case (imc <= 25) :
			           $("#interpretation").attr("value", "normale"); 
			           break;
			case (imc <= 30) :
			          $("#interpretation").attr("value", "surpois"); 
			           break;
			case (imc <= 35) :
			           $("#interpretation").attr("value", "obésité  moderée"); 
			          break;
			case (imc<= 40):
			           $("#interpretation").attr("value", "obésité  elevé"); 
			           break;
			default:
			           break;
		}		

	}
	function Shows(id)
	{
		$('#multiselect').addClass("hidden").hide().fadeIn();
		$('#multiselectRMN').addClass("hidden").hide().fadeIn();
		$('#multiselectRX').addClass("hidden").hide().fadeIn();
		$('#multiselectEchographie').addClass("hidden").hide().fadeIn();
		switch(id) {
		    case "CT":
		               	$('#multiselect').removeClass("hidden").show();
		        		break;
		     case "RMN":
		        		$('#multiselectRMN').removeClass("hidden").show();	
		       	 	break;
		   case "RX":
		   		$('#multiselectRX').removeClass("hidden").show();	
		       		break;
		   	
		    case "Echographie":
				$('#multiselectEchographie').removeClass("hidden").show();	
		       	 	break; 	
		    default:
		        //code block
		        break;
		}	

	}
	function addTable ()
	{
		$("#divmodeprise").find("table").remove();
		var j  = $('#nbprise').val();
     		var words = new Array();
      		for(var i = 1 ; i <= j ; i++){
          			 words.push("Prise ("+i+")");
    		}
     		var html = '<table border="1"><tr>';
     		$.each(words, function(i, word) {
          			 html += '<td colspan="1" rowspan="1" class="text-center" >' + word + '</td>';
      		});
      		html += '</tr><tr>'
      		var select= `<td><select id="temps" class="form-control" id="form-field-select-3"> 
		                <option value="Le matin">Le matin</option>
		                <option value="à midi">à midi</option>
		                <option value="Le Soir">Le Soir</option>
	                </select></td>`;

		$.each(words, function(i, word) {
            	html += select;
    		});
    		html += '</tr></table>';
		 $("#divmodeprise").append(html);
	}
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
       	function InverserUl()
       	{
       		var section = $("ul#menuPatient li:not(.active) a").prop('href').split("#")[1];
       		if(section == "Assure")
       		{
       			var liNonActive =$("ul#menuPatient li:not(.active)");
       			var section = $("ul#menuPatient li:not(.active) a").prop('href').split("#")[1];
  			var sectionActive = $("ul#menuPatient li.active a").prop('href').split("#")[1];
  			$('ul#menuPatient li.active').removeClass('active');
  			liNonActive.addClass('in active');
  			$('div#' + section).addClass('in active');
  			$('div#' + sectionActive).removeClass('active');
       		}
       		/*******/
       		if(section == "Homme_C")
       		{
       			var liNonActive =$("ul#menuPatient li:not(.active)");
       			var section = $("ul#menuPatient li:not(.active) a").prop('href').split("#")[2];
  			var sectionActive = $("ul#menuPatient li.active a").prop('href').split("#")[2];
  			$('ul#menuPatient li.active').removeClass('active');
  			liNonActive.addClass('in active');
  			$('div#' + section).addClass('in active');
  			$('div#' + sectionActive).removeClass('active');
       		}
  		
       	}	
       	function checkFormAddPAtient()
       	{
       	           InverserUl();	
       	           var nomf = $('#nomf').val();
       		var prenomf = $('#prenomf').val();
       		var NMGSN = $('#NMGSN').val();
       		var nss = $('#nss').val();
       		var inputVal = new Array(nomf,prenomf,NMGSN,nss);
     		var inputMessage = new Array("nom","prenom","Matricule(NMGSN)","numèro secruté");
     		$('.error').each(function(i, obj) {
                		$(obj).next().remove();
   			$(obj).detach();
		});
     		var erreur =true;
     		if(!($('#autre').is(':checked'))){ 
		  	jQuery.each( inputVal, function( i, val ) {
	  			if(val =="" )
	  			{
	  				erreur =false;
	  				InverserUl();
	  				$('#error').after('<span class="error"> STP, saisir le ' + inputMessage[i]+' du l\'ssure '  + '</span>'+'<br/>');
	     			}
			});
		}
     
  	return erreur;
  }
	function storeord1()
	{
		var arrayLignes = document.getElementById("ordonnance").rows;
    var longueur = arrayLignes.length; 
    var ordonnance = [];
    for(var i=1; i<longueur; i++)
    {
      ordonnance[i-1] = { med: arrayLignes[i].cells[1].innerHTML, posologie: arrayLignes[i].cells[5].innerHTML }
    }
    var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(ordonnance)+"' hidden>");
    champ.appendTo('#consultForm');
  }
	function demandehosp()
	{
		($("#motifhosp").appendTo('#consultForm')).hide();
		($("#service").appendTo('#consultForm')).hide();
		($("#degreurg").appendTo('#consultForm')).hide();
		($("#specialiteDemande").appendTo('#consultForm')).hide(); //ajouter specialite
		($("#modeAdmission").appendTo('#consultForm')).hide();
		$('#demandehosp').modal('hide');
	}
	function lettreorientation()
	{
		($('#specialite').appendTo('#consultForm')).hide();
		($('#medecin').appendTo('#consultForm')).hide();
		($('#motifOrient').appendTo('#consultForm')).hide();
	}
	function addAppareils(appareil)
	{
		$("#"+appareil).each(function(i){
			if(($(this).find(".wysiwyg-editor").text()) !=" ");
				$('input:hidden[name="' + appareil + '"]').val($(this).find(".wysiwyg-editor").text());
		});
	}
	function removeAppareilsContent(appareil)
	{
		$("#"+appareil).each(function(i){
			$(this).find(".wysiwyg-editor").text("");
		});
	}  