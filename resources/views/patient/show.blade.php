@extends('app')
@section('page-script')
<script type="text/javascript">
 function deleteDemandeHospi(id)
 {
      event.preventDefault();
      $.ajaxSetup({
		headers: {
			 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
			type: "DELETE",
			url: '/demandehosp/' + id,
	        	 success: function (data) {
					$(".dh").remove();//$("#dh" + id).remove();
			},
			error: function (data) {
				 console.log('Error:', data);
			}
	});
  }
 /*$(function () {$.connection.hub.url = 'http://192.168.1.60:90/myhubs'; // Connect Hubs without the generated proxy
var chatHubProxy = $.connection.myChatHub;$.connection.hub.start().done(function () {console.log("Hub connected.");
$(".ordreticketPrint").click(function(){// barcode à envoyer var barcode = "1600|1|030621"; // Fonction d'envoie chatHubProxy.server.send(barcode);});
}).fail(function () {console.log("Could not connect to Hub.");});});*/
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
			"pageLength" : 10,
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
    $('#specialiteTick').change(function(){
        if($(this).val() =="")        	
         	$('#print').prop('disabled', 'disabled');
        else
        	$('#print').removeAttr("disabled");
  	});
	$('#print').click(function(e){//e.preventDefault();//$("#ticketForm").submit();
            	$("#ticket").hide();
      	   	  var formData = {
		  	specialite:$('#specialiteTick').val(),
		  	typecons:$('#typecons').val(),
		  	 document:$('#document').val(), 
		  	  id_patient:$('#id_patient').val()
	       };
              $.ajaxSetup({
                   headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
              }); 
              $.ajax({
                    type : 'POST',
                    url : '/createTicket',
                    data:formData,  //dataType: 'json',
                    success:function(data){         
                    	location.reload(true);
                    },
                    error: function (data) {
                          console.log('Error:', data);
                    }
              });
	})
  });
 /* var rows = document.getElementById("consultList").children[1].children;var selectedRow = 0;   document.body.onkeydown = function(e){//Prevent page scrolling on keypress
      e.preventDefault();//Clear out old row's color
      	rows[selectedRow].style.backgroundColor = "#FFFFFF"; //Calculate new row
	    if(e.keyCode == 38){selectedRow--;     } else if(e.keyCode == 40){//  selectedRow++;
	    }	    if(selectedRow >= rows.length){// selectedRow = 0;
	     } else if(selectedRow < 0){// selectedRow = rows.length-1;//   }//Set new row's color
	      rows[selectedRow].style.backgroundColor = "#8888FF";// 	showConsult(rows[selectedRow].getAttribute("id"));// 	     };//Set the first row to selected color// rows[0].style.backgroundColor = "#8888FF";*/
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="pull-right">
	<a href="{{ route('patient.index') }}" class="btn btn-xs btn-white btn-info btn-bold"><i class="ace-icon fa fa-search blue"></i>Chercher</a>
	<a href="{{route('patient.destroy',$patient->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-white btn-warning btn-bold"><i class="ace-icon fa fa-trash-o  orange"> Supprimer</i>
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
					 	<i class="fa fa-history fa-1x"></i>&nbsp;<span>Antécédents</span>&nbsp;<span class="badge badge-primary">
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
				<li><a data-toggle="tab" href="#rdvs">
					<i class="blue ace-icon fa fa-calendar-o bigger-120"></i>RDV&nbsp;<span class="badge badge-info">{{ $rdvs->count() }}</span>
					</a>
				</li>
				@if (!is_null($correspondants))
				<li><a data-toggle="tab" href="#homme_conf"><i class="green ace-icon fa fa-user bigger-120"></i>Homme de confiance</a></li>
				@endif
			</ul>
			<div class="tab-content no-border padding-24">
				<div id="home" class="tab-pane in active"> @include('patient.patientInfo')</div>
				<div id="Ants" class="tab-pane">@include('antecedents.ants_Widget')</div>
				<div id="Cons" class="tab-pane">@include('consultations.liste')</div>
				<div id="rdvs" class="tab-pane"><div class="row">@include('rdv.liste')</div></div>
				<div id="Hosp" class="tab-pane">@include('hospitalisations.liste')	</div>
				<div id="homme_conf" class="tab-pane">
				<div class="row">@include('corespondants.widget')</div><div class="row">@include('corespondants.add')</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="ticket" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">{{-- route('ticket.store') --}}
		{{-- <form  id ="ticketForm" action="#" method="POST" role="form">{{ csrf_field() }} --}}
		<input type="text" name="id_patient" id="id_patient" value="{{ $patient->id }}" hidden>
		<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><strong>Ajouter un ticket d'enregistrement</strong></h4>
    		</div>
    		<div class="modal-body">
	    		<div class="row">
				<div  class="col-sm-12 form-group">
					<label for="typecons"><b>Type de Consultation:</b></label>
					<select class="form-control" id="typecons" name="typecons" required>
						<option value="Normale">Normale</option>
						<option value="Urgente">Urgente</option>
						<option value="controle">Contrôle</option>
						<option value="specialise">Spécialisé</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div  class="col-sm-12 form-group">
					<label for="document"><b>Document:</b></label>
					<select class="form-control" id="document" name="document" id="document" required>
						<option value="Rendez-vous">Rendez-vous</option>
						<option value="Lettre d'orientation">Lettre d'orientation</option>
						<option value="Consultation généraliste">Consultation généraliste</option>
						<option value="autre">Autre</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div  class="col-sm-12 form-group">
					<label for="specialite"><b>Spécialité:</b></label>
					<select class="form-control" id="specialiteTick" name="specialite"  required>
						<option value="">Selectionner...</option>
						@foreach($specialites as $specialite)
						<option value="{{ $specialite->id}}"> {{ $specialite->nom}}</option>
						@endforeach
					</select>
				</div>
			</div>	
	    		</div>
	    		<div class="modal-footer">
    				<button type="submit" class="btn btn-primary" id ="print" disabled><i class="ace-icon fa fa-copy"></i>Générer un ticket</button>	
    				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
    			</div>
    	{{-- </form> --}}
  		</div>
  	</div>
</div>
@endsection