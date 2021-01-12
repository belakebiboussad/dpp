$('.calendar1').fullCalendar({
       	plugins: [ 'dayGrid', 'timeGrid' ],
	     	     header: {
		          left: 'prev,next today',
		          center: 'title,dayGridMonth,timeGridWeek',
		          right: 'agendaWeek,agendaDay'//
		     },
		     defaultView: 'agendaWeek',
		     height: 650, 
		     firstDay: 0,
	          slotDuration: '00:15:00',
	  	     minTime:'08:00:00',
	    	     maxTime: '17:00:00',
	       	navLinks: true,
	          selectable: true,
	          selectHelper: true,
	          eventColor  : '#87CEFA',
	          editable: true,
	       	hiddenDays: [ 5, 6 ],
	       	weekNumberCalculation: 'ISO',	//aspectRatio: 1.5,  	eventLimit: true,   allDaySlot: false,   eventDurationEditable : false,
	        	weekNumbers: true,
		     events: [
		    		@foreach($employe->rdvs as $rdv)
		        	{
			     		title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom }} ' +', ('+{{ $rdv->patient->getAge() }} +' ans)',
			       	start : '{{ $rdv->Date_RDV }}',
			       	end:   '{{ $rdv->Fin_RDV }}',
			       	id :'{{ $rdv->id }}',
			       	idPatient:{{$rdv->patient->id}},
			       	tel:'{{$rdv->patient->tele_mobile1}}',
			       	age:{{ $rdv->patient->getAge() }},
			       	specialite: {{ $rdv->employe["specialite"] }},
			       	fixe:  {{ $rdv->fixe }},          
			     },
		      	@endforeach 
		     ],
		     eventRender: function (event, element, webData) {
     				if(event.start < today) 
					element.css('background-color', '#D3D3D3');
				else{	
					if(event.fixe)
			 			element.css('background-color', '#87CEFA'); 
			   		else
			   			element.css('background-color', '#378006');
			   		element.css("padding", "5px"); 
				}
				element.popover({
						  		delay: { "show": 500, "hide": 100 },  // title: event.title,
					      		content: event.tel,
			 			        	trigger: 'hover',
			   			          animation:true,
						          placement: 'bottom',
						          container: 'body',
						          template:'<div class="popover" role="tooltip"><div class="arrow"></div><h6 class="popover-header">'+event.tel+'</h6><div class="popover-body"></div></div>',
				});		    
			}, 
			select: function(start, end) {
			 		var minutes = end.diff(start,"minutes"); 
				 	if(minutes == 15)
				 	{
				 		if(start > CurrentDate){
	          					Swal.fire({
	                             		title: 'Confimer vous  le Rendez-Vous ?',
	                             		html: '<br/><h4><strong id="dateRendezVous">'+start.format('dddd DD-MM-YYYY')+'</strong></h4>',
	                             		input: 'checkbox',
	                            		inputPlaceholder: 'Redez-Vous Fixe',
	                             		showCancelButton: true,
	                             		confirmButtonColor: '#3085d6',
	                             		cancelButtonColor: '#d33',
	                             		confirmButtonText: 'Oui',
	                             		cancelButtonText: "Non",
	              				}).then((result) => {
	                        			if(!isEmpty(result.value))
	                          			createRDVModal(start,end,'{{ $patient->id }}',result.value);	
	                 			})
						}else
							$('.calendar1').fullCalendar('unselect');
					}else
						$('.calendar1').fullCalendar('unselect');			
				},
				eventAllow: function(dropLocation, draggedEvent) {
					return false;
				},
  	});