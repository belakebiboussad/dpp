@extends('app')
@section('title','Nouvelle Consultation')
@section('style')
 <link rel="stylesheet" href="{{ asset('css/print.css') }}" />	
 <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />  
<style>
	.modaldialog {
	  width:92%;
	}
	iframe {
	    display: block;
	    margin: 0 auto;
	    border: 0;
	    position:relative;
	    z-index:999;
	}
	.b{
		height:20px !important;
	}
	#content {
	  background: white;
	  width: 98%;
	  height: 100%;
	  margin: 5px auto;
	  border: 1px solid orange;
	  padding: 10px;
	}
</style>
@endsection
@section('page-script')
<script>
  $(function(){
  		imgToBase64("{{ asset('/img/entete.jpg') }}", function(base64) {
             base64Img = base64; 
  		});
      imgToBase64("{{ asset('/img/footer.jpg') }}", function(base64) {
             footer64Img = base64; 
   		}); 
  });
	function ajaxfunc(patientid)
	{        
		var habitudeAlim = null; var tabac=null ; var ethylisme = null;
		var antecedant = $('#Antecedant').val();
		var typeAntecedant = $('#typeAntecedant').val();
		var soustype = $('#sstypeatcdc').val();    
		var dateATCD = $('#dateAntcd').val()
		var description = $("#description").val();               
		if(typeAntecedant =="Physiologiques")
		{
			  habitudeAlim= $('#habitudeAlim').val();
			  tabac = $("#tabac").is(":checked") ? 1:0;
			  ethylisme = $("#ethylisme").is(":checked") ? 1:0;
		}
		if (description != "")
		{
		  $.ajax({
				   headers: {
						   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type:"POST",
					url:'/AddANTCD',
					data:{ antecedant:antecedant,typeAntecedant:typeAntecedant,soustype:soustype,dateATCD:dateATCD,description:description,patientid:patientid,habitudeAlim:habitudeAlim,tabac:tabac,ethylisme:ethylisme 
					},
					success:function(data){
							$("#msg").html(data.msg);
					}
			   }); 
			   $('#ants-tab').append("<tr><td>"+$('#Antecedant').val()+"</td><td>"+$('#dateAntcd').val()+"</td><td>"+$('#description').val()+"</td><td></td></tr>");  
				resetField(); 
		}
	}
	function resetField()
	{
		$("#description").val('');$('#dateAntcd').val('');
	}
	function print()
	{
		document.title = 'ordonnance-'+'{{ $patient->Nom }}'+'-'+'{{ $patient->Prenom}}';
		$('#iframe-pdf').get(0).contentWindow.print();
		document.title = 'Nouvelle Consultation';
	}
	function rdvDelete(rdvId)
	{
	  var url ="/rdv/"+rdvId;
	  $.ajaxSetup({
		  headers: {
					'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
		  }
		}); 
		var token = $("meta[name='csrf-token']").attr("content");
		$.ajax({
		  type : 'DELETE',
		  url : url,
		  data: {
				"id": rdvId,
				"_token": token,
				},
		  success:function(data){  	   		
			$('.calendar1').fullCalendar('removeEvents', data.id);              	
		  },
		  error:function(jqXHR, textStatus, errorThrown){
				console.log(errorThrown);
		  }
		});
	}
	function editMedicm(med)
  {
  	$.ajax({
  		  type: 'GET',
  		  url: '/getmed/'+med,
  		  dataType: "json",
  		  success: function (result)
  		  {
  			  $("#nommedic").val(result['Nom_com']); $("#forme").val(result['Forme']);
  			  $("#dosage").val(result.Dosage);$("#id_medicament").val(result['id']);
  			  $(".disabledElem").removeClass("disabledElem").addClass("enabledElem");
  		  }
   });
  }
  function addmidifun()
  {
		var med ='<tr id="'+$("#id_medicament").val()+'"><td hidden>'+$("#id_medicament").val()+'</td><td>'+$("#nommedic").val()+'</td><td class="priority-5">'+$("#forme").val()+'</td><td class="priority-5">'+$("#dosage").val()+'</td><td>'+$("#posologie_medic").val()+'</td>';
		med += '<td class ="bleu center"><button class="btn btn-xs btn-info open-modal" value="' + $("#id_medicament").val()+ '" onclick="editMedicm('+$("#id_medicament").val()+');rowDelete('+$("#id_medicament").val()+');"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
		med += '<button class="btn btn-xs btn-danger delete-atcd" value="' + $("#nommedic").val()+ '" onclick ="rowDelete('+$("#id_medicament").val()+')" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
		$("#ordonnance").append(med);
		$(".enabledElem").removeClass("enabledElem").addClass("disabledElem");
		$("#nommedic").val('');$("#forme").val('');$("#dosage").val('');$("#posologie_medic").val('');
  }
  function rowDelete(id)
  {
		$("#"+id).remove();
  }
$('document').ready(function(){
      var date = new Date('{{ $patient->Dat_Naissance }}');
      $( ".gdob" ).datepicker( "option", "minDate", date ); //great to date of bearth 
			$( 'ul.nav li' ).on( 'click', function() {
				$(this).siblings().addClass('filter');
			});
			$('.wysiwyg-editor').on('input',function(e){
				var a = $(this).parent().nextAll("div.clearfix");
				var i = a.find("button:button").each(function(){
					$(this).removeAttr('disabled');
				});
			});
      $('#select2-multiple-style .btn').on('click', function(e){
  			var target = $(this).find('input[type=radio]');
  		  var which = parseInt(target.val());
  			if(which == 2) 
  				$('.select2').addClass('tag-input-style');
  		  else
  			$('.select2').removeClass('tag-input-style');
		  });
			var checkbox = $("#isOriented");// Get the form fields and hidden div
			var hidden = $("#hidden_fields");// Setup an event listener for when the state of the    // checkbox changes.
			 checkbox.change(function() {
				if (checkbox.is(':checked')) {
					hidden.show();
				} else {
						hidden.hide();
						$("#lettreorientaioncontent").val("");
				 }
		})
	  $(".two-decimals").change(function(){
			this.value = parseFloat(this.value).toFixed(2);
	  });
/* pas sup pas verif $("button").click(function (event) {which = '';str ='send';which = $(this).attr("id");var which = $.trim(which);var str = $.trim(str);if(which==str){return true;}  });*/
		/*$("#btnCalc").click(function(event){event.preventDefault(); });*/
	  $('#medc_table').DataTable({
				processing: true,
				serverSide: true,
				ordering: true,
				bInfo : false,
				searching: true,
				pageLength: 5,
				bLengthChange: false,
				nowrap:true,
				"language": {
					"url": '/localisation/fr_FR.json'
				},
				ajax: '/getmedicaments',
				columns: [
				  {data: 'Nom_com'},
				  {data: 'Forme',className: "priority-3" , orderable: false},
				  {data: 'Dosage' , orderable: false},
				  {data: 'action', name: 'action', orderable: false, searchable: false}
				],
				columnDefs: [
				  { "targets": 3 ,  className: "dt-head-center dt-body-center" }
				],
	  });
	  $('#btn-add, #AntFamil-add').click(function () {//ADD
  	  $('#EnregistrerAntecedant').val("add");
  		$('#modalFormData').trigger("reset");
      $('#AntecCrudModal').html("Ajouter un antécédent");
  	  if(this.id == "AntFamil-add")
  		{
  			$("#EnregistrerAntecedant").attr('data-atcd','Famille'); 
  			if(! ($( "#atcdsstypehide" ).hasClass( "hidden" )))
  				$( "#atcdsstypehide" ).addClass("hidden");
  		}else{
  			$("#EnregistrerAntecedant").attr('data-atcd','Perso'); 
  			if(($( "#atcdsstypehide" ).hasClass( "hidden" )))
  				$('#atcdsstypehide').removeClass("hidden");
  		}
  		$('#antecedantModal').modal('show');
  	});
  	jQuery('#btn-addAntPhys').click(function () {//	//antecedant Physiologique
  			jQuery('#EnregistrerAntecedantPhys').val("add");
  			jQuery('#modalFormDataPhysio').trigger("reset");
  			jQuery('#AntecPhysCrudModal').html("Ajouter un antécédent");
  			jQuery('#antecedantPhysioModal').modal('show');
  	});	
  	jQuery('body').on('click', '.open-modal', function (event) {//EDIT
  		event.preventDefault();
  		var atcd_id = $(this).val();
  		$.get('/atcd/' + atcd_id, function (data) { 
  			$('#atcd_id').val(data.id);
  		    $('#typeAntecedant').val(data.typeAntecedant).change();
  			$('#sstypeatcdc').val(data.stypeatcd).change();//if(data.typeAntecedant   === 'Pathologiques')
  			if($( "#atcdsstypehide" ).hasClass( "hidden" ))
  				$( "#atcdsstypehide" ).removeClass("hidden"); 
  			$('#dateAntcd').val(data.date);
  			$('#cim_code').val(data.cim_code);
  			$('#description').val(data.description);
  			$("#EnregistrerAntecedant").attr('data-atcd',"Perso");
  			$('#AntecCrudModal').html("Editer un Antecedant");	
  			jQuery('#EnregistrerAntecedant').val("update");	
  			jQuery('#antecedantModal').modal('show');
  	  });
  	});
	jQuery('body').on('click', '.open-modalFamil', function (event) {
		event.preventDefault();
		var atcd_id = $(this).val();
		$.get('/atcd/' + atcd_id, function (data) { 
			$('#atcd_id').val(data.id);
			$('#dateAntcd').val(data.date);
			$('#cim_code').val(data.cim_code);
		  $('#description').val(data.description);
		  if(! ($( "#atcdsstypehide" ).hasClass( "hidden" )))
				$( "#atcdsstypehide" ).addClass("hidden"); 
			jQuery('#EnregistrerAntecedant').val("update");
			$("#EnregistrerAntecedant").attr('data-atcd',"Famille")	
			 jQuery('#antecedantModal').modal('show');
		});
	});
	jQuery('body').on('click', '.Phys-open-modal', function (event) {
		event.preventDefault();
		var atcd_id = $(this).val();
		$.get('/atcd/' + atcd_id, function (data) { 
			$('#atcdPhys_id').val(data.id);
			$('#dateAntcdPhys').val(data.date);
			$('#habitudeAlim').val(data.habitudeAlim);
			if(data.tabac)
				$('#tabac').prop('checked', true);
			if(data.ethylisme)
				$('#ethylisme').prop('checked', true);
			$('#phys_cim_code').val(data.cim_code);
		  $('#descriptionPhys').val(data.description);
			jQuery('#EnregistrerAntecedantPhys').val("update");
			jQuery('#antecedantPhysioModal').modal('show');
		});
	});
	$("#EnregistrerAntecedant").click(function (e) {
		e.preventDefault();
		if($("#EnregistrerAntecedant").attr('data-atcd') == "Perso")
		{
			var tabName = "antsTab";
			var formData = {
				pid      : '{{ $patient->id }}',
				Antecedant           : 'Personnels',//jQuery('#Antecedant').val()
				typeAntecedant       : '0',//jQuery('#typeAntecedant').val(),
				stypeatcd            : jQuery('#sstypeatcdc').val(),
				date                    : $('#dateAntcd').val(),
				cim_code			:$('#cim_code').val(),
				description         : $("#description").val()
			};
		}else
		{
			var tabName = "antsFamTab";
			var formData = {
				pid   : '{{ $patient->id }}',
				  Antecedant         : 'Familiaux',
				date               : $('#dateAntcd').val(),
				cim_code					 : $('#cim_code').val(),
				description       : $("#description").val()
			};
		}
		if(!($("#description").val() == ''))
	 	 {	
			if($('.dataTables_empty').length > 0)
				$('.dataTables_empty').remove();
			$.ajaxSetup({
		headers: {
					  'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
			}
		});
		var state = jQuery('#EnregistrerAntecedant').val();
		var type = "POST";
		var atcd_id = jQuery('#atcd_id').val();
		var ajaxurl = '/atcd';
		if (state == "update") {
			type = "PUT";
			ajaxurl = '/atcd/' + atcd_id;
	  }   
		$.ajax({
			   type: type,
			   url: ajaxurl,
			   data: formData,
			   dataType: 'json',
			   success: function (data) {
					if(data.Antecedant == "Personnels")
					{
						var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.pid + '</td><td>' + data.stypeatcd +'</td><td>'+ data.date +'</td><td>'+data.cim_code+ '</td><td>' + data.description + '</td>';
				  		atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
						atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
					}else
					{
						var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.pid + '</td><td>' + data.date + '</td><td>' +data.cim_code
							  +	'</td><td>'	+ data.description + '</td>';
						atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modalFamil" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
						atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
					}
			  		if (state == "add") { 
						jQuery('#' + tabName+' tbody').append(atcd);
			 		 } else {
						$("#atcd" + atcd_id).replaceWith(atcd);
			  		}	
					jQuery('#modalFormAnt').trigger("reset");
					jQuery('#antecedantModal').modal('hide');
			 	},
				error: function (data) {
					  console.log('Error:', data);
			   }
				});
		}          
		});
		$("#EnregistrerAntecedantPhys").click(function (e) {
			var habitudeAlim = null; var tabac=null ; var ethylisme = null;
			e.preventDefault();
			var formData = {
				pid   : '{{ $patient->id }}',
				Antecedant           : 'Personnels',//jQuery('#Antecedant').val()
				typeAntecedant       : '1',//jQuery('#typeAntecedant').val(),
				date                 : $('#dateAntcdPhys').val(),
				cim_code						 : $('#phys_cim_code').val(),
				description         : $("#descriptionPhys").val(),
				habitudeAlim 				 : $('#habitudeAlim').val()
		  };
  		formData.tabac = $("#tabac").is(":checked") ? 1:0;
  	  formData.ethylisme = $("#ethylisme").is(":checked") ? 1:0;
		  if($('.dataTables_empty').length > 0)
				$('.dataTables_empty').remove();
		  $.ajaxSetup({
			  headers: {
						  'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				}
		  });
		  var state = jQuery('#EnregistrerAntecedantPhys').val();
		  var type = "POST";
		  var atcd_id = jQuery('#atcdPhys_id').val();
		  var ajaxurl = '/atcd';
		  if (state == "update") {
		  	type = "PUT";
		    ajaxurl = '/atcd/' + atcd_id;
	    } 
		  $.ajax({
			  type: type,
			  url: ajaxurl,
			  data: formData,
			  dataType: 'json',
			  success: function (data) {
					var tabac = data.tabac != 0 ? 'Oui' : 'Non';
					var ethylisme = data.ethylisme !=0 ? 'Oui' : 'Non';
					var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.pid + '</td><td>'+data.date+'</td><td>'
									 + data.cim_code +'</td><td>'+data.description+ '</td><td>' + tabac + '</td><td>'+ ethylisme+'</td><td>'+ data.habitudeAlim +'</td>';
						atcd += '<td class ="center"><button class="btn btn-xs btn-info Phys-open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
						atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
				if (state == "add") { 
						jQuery('#antsPhysTab tbody').append(atcd);
				} else {
					$("#atcd" + atcd_id).replaceWith(atcd);
				}
				jQuery('#modalFormDataPhysio').trigger("reset");
				jQuery('#antecedantPhysioModal').modal('hide');
			  },
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
		var confirmed = false;
		$("#consultForm").submit(function(e){
			event.preventDefault();
			if(!checkConsult())
			{
				activaTab("Interogatoire");
				return false;
			}else
			 {
			 	if (!confirmed) {
			 	      Swal.fire({ //title: 'Enregistrer Vous la Consultation ?',
						  title:'<strong>êtes-vous sûr ?</strong>',
						  icon: 'warning',
						  type:'warning',
						  html: '<br/><h4><strong>'+"Attention! En appuyant sur ce boutton, Vous allez Clôturer la Consulatation en Cours "+'</strong></h4><br/><hr/> ',
						  showCancelButton: true,
						  allowOutsideClick: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Oui',
						  cancelButtonText: "Non",
						  closeOnConfirm: true, //timer: 2000,
              showCloseButton: true
					}).then((result) => {
           		if(result.value)
           		{
           			confirmed = true;
           			addExamsImg(this);
           			$("#consultForm").submit();
           		}else
           		 	return false;
          });
				}
			}	    
		});//calendrier  	
    var CurrentDate = (new Date()).setHours(23, 59, 59, 0);
    var today = (new Date()).setHours(0, 0, 0, 0);
		$('.calendar').fullCalendar({//plugins: [ 'dayGrid', 'timeGrid' ],
        header: {
          left: 'prev,next today',
          center: 'title',
         right: 'month,agendaWeek,agendaDay'
        },
        defaultView : 'basicWeek',//'agendaWeek',
		  	height: 650,//teste
        showAgendaButton: true,
        timeFormat: 'H:mm',
        axisFormat: 'H:mm',// teste
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
				weekNumberCalculation: 'ISO',
				aspectRatio: 2,
				eventLimit: true,
				allDaySlot: false,
       	eventDurationEditable : false,//weekNumbers: true,views: {},
		  	events: [
				 @foreach($employe->rdvs as $rdv)
				 {	
					title : '{{ $rdv->patient->full_name  }} ' +', ('+{{ $rdv->patient->age }} +' ans)',
					start : '{{ $rdv->date }}',
					end:   '{{ $rdv->fin }}',
					id :'{{ $rdv->id }}',
					idPatient:{{$rdv->patient->id}},
					tel:'{{$rdv->patient->tele_mobile1}}',
					age:{{ $rdv->patient->age }},
					specialite:{{ $rdv->specialite_id }}, 
					fixe:  {{ $rdv->fixe }},
				},
				@endforeach 
			],
		  eventRender: function (event, element, webData) {
			  if(event.start < today) // element.find('.fc-title').append("," + event.tel);// element.css("font-size", "1em");
				   element.css('background-color', '#D3D3D3');
				else
				{	
				       if(event.fixe>0)
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
			select: function(start, end,jsEvent, view) {
				var minutes = end.diff(start,"minutes"); 
				if((minutes == 15) && (start > today)) {
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
						 allowOutsideClick: false,  
					  }).then((result) => {
  						if(!isEmpty(result.value))
  							createRDVModal(start,end,'{{ $patient->id }}',result.value);					
			  		})
				}else
					$('.calendar').fullCalendar('unselect');//calendar1
			},
		  eventAllow: function(dropLocation, draggedEvent) {  return false; },
			eventDrop: function(event, delta, revertFunc) { revertFunc();	},
			eventDragStop: function (event, jsEvent, ui, view) {return false;} 
		});
		$(".apgar").ionRangeSlider({ min:0,max:10,step:1, values:5, grid:true, grid_num:10, postfix:"", skin:"big" });
    $(".shoutnbr").ionRangeSlider({ min:0,max:4,step:1, from:0, grid:true, grid_num:4, postfix:" fois", skin:"big" });
    $(".pcran").ionRangeSlider({ min:25,max:60,step:1, from:25, grid:true, grid_num:60, postfix:" cm", skin:"big" });
	  $("#drugsPrint").click(function(){
  	  var pid = '{{ $patient->id }}';
  	  var mid = '{{  Auth::User()->employ->id }}';
  	  var keys=[], meds=[];
  		$("#ordonnance thead tr th").each(function(){
				if(($(this).html() == "id") || ($(this).html() == "Posologie"))
					keys.push($(this).html());  
			});
			$("#ordonnance tbody tr").each(function(){
				var obj={}, i=0;
				$(this).children("td").each(function(index){
				  if((index == 0) || (index == 4) )
					{
						obj[keys[i]]=$(this).html();
						i++;
					}
				})
				meds.push(obj);	
			});
			var formData = {
				id_patient:pid,
				id_employe:mid,
				meds:JSON.stringify(meds),
			};
			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
					}
			});
			$.ajax({
				type: "POST",
				url: "/ordonnaces/print",
				data:formData,
				dataType: "json",
				success: function (data,status, xhr) {	  	
					$('#iframe-pdf').contents().find('html').html(data.html);
					$("#ordajax").modal();		       
				},	
				error: function (data) {
					console.log('Error:', data);
				}
			})
	  })//fin drug  print
    $(document).on("click","#rdvadd",function(){
      $(".calendar").fullCalendar( 'refetchEvents' );
      $('#RDV').modal("show");
    });
});// ready
</script>
@endsection
@section('main-content')
<div class="container-fluid">
	<div class="row"><div class="col-sm-12">@include('patient._patientInfo')</div></div>
	<div class="row">
	<form  class="form-horizontal" id ="consultForm" action="{{ route('consultations.store') }}" method="POST" role="form">
	  {{ csrf_field() }}
		<input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
		<div class="form-group" id="error" aria-live="polite">
		@if (count($errors) > 0)
		  <div class="alert alert-danger">
				<ul>
				 @foreach ($errors->all() as $error)
				  <li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
		@endif
		</div><!-- 		<div id="prompt"></div> -->
		<div class="tabpanel">
			<ul class = "nav nav-pills nav-justified list-group" role="tablist">
				<li role= "presentation" class="col-md-4 in active">
				  <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-secondary btn-lg">
				  <span class="bigger-160" style="font-size:10vw">Interrogatoire</span>
				  </a>
				</li>
				<li role= "presentation" class="col-md-4">
					<a href="#ExamClinique"  aria-controls="ExamClinique" role="tab" data-toggle="tab" class="btn btn-success btn-lg"> 
						<span class="bigger-160" style="font-size:10vw">Examens Cliniques</span></a>
				</li>
				<li role= "presentation" class="col-md-4">
		  			<a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-danger btn-lg">
						<span class="bigger-160" style="font-size:10vw">Examens Complémentaires</span>
					</a>
				</li>
			</ul>
			<div class ="tab-content no-border"><!-- tyle = "border-style: none;" -->
				<div role="tabpanel" class = "tab-pane active" id="Interogatoire">@include('consultations.Interogatoire')</div>
				<div role="tabpanel" class = "tab-pane" id="ExamClinique">@include('consultations.examenClinique')</div>
				<div role="tabpanel" class = "tab-pane" id="ExamComp">@include('ExamenCompl.index')</div>  
			</div>
		</div><!-- tabpanel -->
		<div class="row">
			<div class="col-sm12"><!-- les inputs de modal form(Demande Hospitalisation)  -->
				<input type="hidden" name="service" id="service">
        <input type="hidden" name="specialiteDemande" id="specialiteDemande">
				<input type="hidden" name="modeAdmission" id="modeAdmission">
        <input type="hidden" name="specialite" id="specialite">
				<input type="hidden" name="motifOr" id="motifOr">
				</div>
		</div>
		<div class="row">
			<div class="col-sm12">
				<div class="center" style="bottom:0px;">
					<button class="btn btn-info btn-sm" type="submit" id="send"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
					<a href="{{ route('patient.show',$patient->id) }}" class="btn btn-warning btn-sm"><i class="ace-icon fa fa-close bigger-110"></i>Annuler</a>
				</div>
			</div>
		</div>
	</form>
	</div>	
</div>
@include('antecedents.AntecedantModal')
@include('consultations.ModalFoms.LettreOrientation')
@include('consultations.ModalFoms.DemadeHospitalisation')
@include('antecedents.AntecedantModalPhysio')
@include('consultations.ModalFoms.Ordonnance')
@include('consultations.ModalFoms.imprimerOrdonnanceAjax')
<div class="row">@include('rdv.rendezVous')</div>
@include('cim10.cimModalForm')
<div id="OrientLetterPdf" class="hidden">@include('consultations.EtatsSortie.orienLetterImgPDF')</div>
<div id="bioExamsPdf" class="hidden"> @include('consultations.EtatsSortie.demandeExamensBioPDF')</div>
<div id="imagExamsPdf" class="hidden">@include('consultations.EtatsSortie.demandeExamensImgPDF')</div>
{{--
@include('consultations.ModalFoms.certificatDescriptif')
@include('examenradio.ModalFoms.crrPrint')
--}}
@endsection