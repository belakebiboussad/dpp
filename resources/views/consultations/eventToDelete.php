	events: [
             			$.each(data,function(index,rdv){
             		 		//title :'{{ $patient->Nom }}' + " " + '{{ $patient->Prenom}}' + ",("+ '{{ $patient->getAge() }}' +")",
             		    title :'gfgf',
             		    start :  rdv['Date_RDV'] ,
               		  end   :   rdv['Fin_RDV'],
               			id    :  rdv['id'],
                		idPatient:'{{ $patient->id }}',
                		tel:'{{ $patient->tele_mobile1 }}',
                		age: '{{ $patient->getAge() }}', 
              		});
              	];     

                  var event = new Object(); 
                  event.title ='{{ $patient->Nom }}' + " " + '{{ $patient->Prenom}}' + ",("+ '{{ $patient->getAge() }}' +")";
                  event.start = rdv['Date_RDV'];
                  event.end   = rdv['Fin_RDV'];
                  event.id    = rdv['id'];
                  event.idPatient = '{{ $patient->id }}';
                  event.tel ='{{ $patient->tele_mobile1 }}';
                  event.age = '{{ $patient->getAge() }}';
       
                  // $('.calendar1').fullCalendar('renderEvent', event); 
                  //$('.calendar1').fullCalendar( 'addEventSource', event);
                  $('.calendar1').addEvent(event);