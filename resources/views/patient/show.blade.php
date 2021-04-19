@extends('app')
@section('page-script')
<script type="text/javascript">
$('document').ready(function(){
   $("#accordion" ).accordion({
      collapsible: true ,
      heightStyle: "content",
      animate: 250,
      header: ".accordion-header"
  }).sortable({
      axis: "y",
      handle: ".accordion-header",
      stop: function( event, ui ) {
        ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
      }
  });
	var table = $('#consultList').DataTable({
     		"searching":false,
      	"processing": true,
        	"scrollY":"450px",
       	"scrollCollapse": true,
        	"paging":false,
        	"language": {
          		"url": '/localisation/fr_FR.json'
        	},      
    });

    $('#consultList tbody').on( 'click', 'tr', function () {
        	if ( $(this).hasClass('selected') ) {
          		$(this).removeClass('selected');
        	}else {
           	table.$('tr.selected').removeClass('selected');
            	$(this).addClass('selected');
        	}
    });

    var CurrentDate = (new Date()).setHours(23, 59, 59, 0);
		var today = (new Date()).setHours(0, 0, 0, 0);
		jQuery('#addRdv').click(function () {
			jQuery('#RDV').modal('show');
		});

    $('#calendar1').fullCalendar({//calendar  
       	plugins: [ 'dayGrid', 'timeGrid' ],
       	header: {
		          left: 'prev,next today',
		          center: 'title,dayGridMonth,timeGridWeek',
		          right: 'month,agendaWeek,agendaDay'//
		},
		defaultView: 'agendaDay',
		 height: 650,
		firstDay: 0,
		slotDuration: '00:15:00',
	 	minTime:'08:00:00',
    		maxTime: '17:00:00',
  	   	navLinks: true,
           selectable: true,
          selectHelper: true,//eventColor  : '#87CEFA',
          editable: true,
       	hiddenDays: [ 5, 6 ],
       	weekNumberCalculation: 'ISO',
     		aspectRatio: 1.5,
     		eventLimit: true,
    		allDaySlot: false,
   		eventDurationEditable : false,
  		weekNumbers: true,
   		events: [
		     @foreach($employe->rdvs as $rdv)
		     {	
		     		title : '{{ $rdv->patient->Nom . ' ' . $rdv->patient->Prenom . ' ('.$rdv->patient->getAge().'ans)' }}',
		       	start : '{{ $rdv->Date_RDV }}',
				end:   '{{ $rdv->Fin_RDV }}',
				id :'{{ $rdv->id }}',
			     	idPatient:{{$rdv->patient->id}},
			     	tel:'{{$rdv->patient->tele_mobile1}}',
			     	age:{{ $rdv->patient->getAge() }},
			     	specialite: {{ $rdv->employe["specialite"] }},
			     	fixe:  {{ $rdv->fixe }}
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
  });//fincalendar
});
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="pull-right">
		<a href="{{ route('patient.index') }}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-search bigger-120 blue"></i>Chercher</a>
		<a href="{{route('patient.destroy',$patient->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-white btn-warning btn-bold">
	    		<i class="ace-icon fa fa-trash-o bigger-120 orange"> Supprimer</i>
	   	</a>
	 </div>
</div>
<div>
	<div  class="user-profile">
		<div class="tabbable">
			<ul class="nav nav-tabs padding-18">
				<li class="active">
					<a data-toggle="tab" href="#home"><i class="green ace-icon fa fa-user bigger-120"></i>Informations Administratives</a>
				</li>
				@if(in_array(Auth::user()->role_id,[1,14]))
				<li>
					 <a data-toggle="tab" href="#Ants">
					 	<i class="fa fa-history fa-1x"></i>&nbsp;<span>Antecedants</span>&nbsp;<span class="badge badge-primary">
					 	{{$patient->antecedants->count() }}</span>
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#Cons">
						<i class="orange ace-icon fa fa-stethoscope bigger-120"></i>Consultations&nbsp;
						<span class="badge badge-warning">{{ $patient->consultations->count() }}</span>
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#Hosp"><i class="pink ace-icon fa fa-h-square bigger-120"></i>
						Hospitalisations&nbsp;<span class="badge badge-pink">{{ $patient->hospitalisations->count() }}</span>
					</a>
				</li>
				@endif
				<li>
					<a data-toggle="tab" href="#rdvs">
						<i class="blue ace-icon fa fa-calendar-o bigger-120"></i>RDV&nbsp;<span class="badge badge-info">{{ $patient->rdvs->count() }}</span>
					</a>
				</li>
				@if (!is_null($correspondants))
				<li><a data-toggle="tab" href="#homme_conf"><i class="green ace-icon fa fa-user bigger-120"></i>Homme de confiance</a></li>
				@endif
			</ul>
			<div class="tab-content no-border padding-24">
				<div id="home" class="tab-pane in active">
				<div id="home" class="tab-pane in active"> @include('patient.patientInfo')</div>
					<!--  -->
					</div><div class="space-12"></div><!-- /.row -->
				</div><!-- /#home -->
				<div id="Ants" class="tab-pane">@include('antecedents.ants_Widget')</div><!-- Ants -->
				<div id="Cons" class="tab-pane">@include('consultations.liste')</div><!-- /#Cons -->
				<div id="rdvs" class="tab-pane">
					<div class="row">@include('rdv.liste')</div>
					<div class="row">@include('rdv.rendezVous')</div>
				</div>	{{-- rdvs --}}
				<div id="Hosp" class="tab-pane">@include('hospitalisations.liste')	</div><!-- /#Hosp -->
				<div id="homme_conf" class="tab-pane"><!--homme_conf -->
						<div class="row">@include('corespondants.widget')</div><div class="row">@include('corespondants.add')</div>
				</div><!-- /#homme_conf -->	
			</div>
		</div>
	</div>
</div>
<div id="ticket" class="modal fade" role="dialog">
  	<div class="modal-dialog"><!-- Modal content-->
  		<div class="modal-content">
  		<form action="{{ route('ticket.store') }}" method="POST" role="form">
			{{ csrf_field() }}
			<input type="text" name="id_patient" value="{{ $patient->id }}" hidden>
			<div class="modal-header">
	    			<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><strong>Ajouter Ticket:</strong></h4>
	    		</div>
	    		<div class="modal-body">
	    			<div class="row">
					<div  class="col-sm-12 form-group">
						<label for="typecons"><b>Type de consultation:</b></label>
						<select class="form-control" id="typecons" name="typecons" required>
							<option value="Normale">Normale</option>
							<option value="Urgente">Urgente</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div  class="col-sm-12 form-group">
						<label for="document"><b>Document:</b></label>
						<select class="form-control" id="document" name="document" required>
							<option value="Rendez-vous">Rendez-vous</option>
							<option value="Lettre d'orientation">Lettre d'orientation</option>
							<option value="Consultation généraliste">Consultation généraliste</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div  class="col-sm-12 form-group">
						<label for="spesialite"><b>Spécialité:</b></label>
						<select class="form-control" id="spesialite" name="spesialite">
							<option value="0">Selectionner la spécialité</option>
							@foreach($specialites as $specialite)
							<option value="{{ $specialite->id}}"> {{ $specialite->nom}}</option>
							@endforeach
						</select>
					</div>
				</div>	
	    		</div>
	    		<div class="modal-footer">
    				<button type="submit" class="btn btn-primary"><i class="ace-icon fa fa-copy"></i>Générer un ticket</button>	
    				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
    			</div>
	    	</form>
    		</div>
    	</div>
</div>
@endsection