if( $("#type").val() == "0")
  {
  	if(i !=0)
	{
		$('#Assure').find('input').val('');
	 	$('#Assure').find("select").prop("selectedIndex",0);
	 	$('#description').val('');
	 	addRequiredAttr();
	}
			$("#foncform").addClass('hide');
		}else if(jQuery.inArray($('#type').val(), [1,2,3,4]) !== -1)
  	{
  		if(i !=0)
		  {
		  	if(('{{ $patient->Type }}' == "0"))
		  	{
		  		$('#Assure').find('input').val('');
				 	$('#Assure').find("select").prop("selectedIndex",0);
				 	$('#description').val('');
				 	$('#Assure').removeClass('hidden');			
		  		$('#Assure').addClass("active");
		  		$('#Assure').addClass("in");
		  		$('#Patient').removeClass('active');
		  		$('#Patient').removeClass('in');
				}
				if(jQuery.inArray('{{ $patient->Type }}', [5,6]) !== -1)	
			 	{
		  		$("ul#menuPatient li:eq(1)" ).removeClass( "active" );
		  		$( "ul#menuPatient li:eq(0)" ).addClass( "active" );
		  		$('#Assure').removeClass('hidden');
		  		$('#Assure').addClass("active");
		  		$('#Assure').addClass("in");
		  		$('#Patient').removeClass('active');
		  		$('#Patient').removeClass('in');
		  	}
		  }
			$('.Asdemograph').find('*').each(function () { $(this).attr("disabled", false); });
			$("#foncform").removeClass('hide');
			$('#nsspatient').attr('disabled', false); 
			addRequiredAttr();
		}else
  	{

			$(".starthidden").show(250);$('#description').attr('disabled', false); 
			$("#foncform").addClass('hide'); 
			if(! ($( "ul#menuPatient li:eq(0)" ).hasClass("hidden")))
				$( "ul#menuPatient li:eq(0)" ).addClass("hidden");
			if(($( "ul#menuPatient li:eq(0)" ).hasClass("active")))
				$( "ul#menuPatient li:eq(0)" ).removeClass("active");
			$( "ul#menuPatient li:eq(1)" ).addClass( "active" );
			$('#Assure').addClass("hidden");
			$('#Patient').addClass("active");
		  $('#Patient').addClass("in");
			$('#Assure').find('input').prop("required",false);
			$('#Assure').find("select").prop("required",false);
			$('#nsspatient').attr('disabled', true);  
  	}