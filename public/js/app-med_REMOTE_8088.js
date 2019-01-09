function IMC(){
	var imc =  $('#poids').val() /($('#taille').val()*$('#taille').val());
	var imc = Math.round(imc).toFixed(0);

	try {	
 		 $("#imc").attr("value", imc);

	}
	catch(err) 
	{
    	$("#imc").attr("value", err.message);
    }
     		
    if(imc < 16.5)
	{
		$("#interpretation").attr("value", "Anorexie");	        		
	      	
    }
    else
	    if( imc > 16.5 && imc < 18.5)
		{
		    $("#interpretation").attr("value", "migreur");
		}
		else
		if ( imc > 18.5 &&  imc < 25 )
		{
		    $("#interpretation").attr("value", "normale"); 		
		}else  	
		    if ( imc > 25 &&  imc < 30 )
		    {
		        $("#interpretation").attr("value", "surpois");    			
		    }
		    else
		    if ( imc > 30 && imc <35)
		    {
			    $("#interpretation").attr("value", "obésité  moderée");		
		    }
		    else
		   	if ( imc > 35 && imc <40 )
		   	{
		        $("#interpretation").attr("value", "obésité  elevé");
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

	function addTable()
	{	
		
		$("#divmodeprise").find("table").remove();
		var j  = $('#nbprise').val();
		var html = '<table><th>';
		 for(i = 0 ; i < j ; i++)
	      	         	html += '<td>'+'prise '+ (i+1) +'</td>';
	      	html+='</th><tr>';
		var select= `<td><select id="temps" class="form-control" id="form-field-select-3">
                     			<option value="">Choisir...</option>
                        		<option value="Le matin">Le matin</option>
                        		<option value="à midi">à midi</option>
                        		<option value="Le Soir">Le Soir</option>
                        	</select></td>`;
  		
		for(i = 0 ; i < j ; i++)
	      	{
	            	html += select;
	      	}    
	       	html += '</tr></table>';
	          $("#divmodeprise").append(html);
  	
	}

	// function addAntecedant()
	// {

	// 	//  var type = $('#Antecedant').val();
	// 	//  var date = $('#dateAntcd').val();
	// 	  var description = $('#description').val();
	// 	alert(description);
	// 	// var tbody = $("#ants-tab").find('tbody').
	// 	// // //Then if no tbody just select your table 
	// 	// var table = tbody.length ? tbody : $('#myTable');
	// 	// // var row = '<tr>'+
 //  //   			'<td>'.type.'</td>'+
 //  //  			 '<td>{{name}}</td>'+
 //  //  			 '<td>{{phone}}</td>'+
	// 	// 	'</tr>';
	// }
	function ajaxATCD(patientid){
		 var type = $('#Antecedant').val();
		 var date = $('#dateAntcd').val();

		var description = $('#description').val();
	}


	

	



