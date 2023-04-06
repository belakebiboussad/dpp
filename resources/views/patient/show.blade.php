@extends('app')
@section('page-script')
<script type="text/javascript">
function deleteDemandeHospi(id)
{
  event.preventDefault();
	$.ajax({
			type: "DELETE",
			url: '/demandehosp/' + id,
      data: { _token: CSRF_TOKEN } ,
	    success: function (data) {
					$(".dh").remove();
			}
	});
  }
  function showConsult(id) //a voir ce lui den haut
  { 
    url= '{{ route ("consultations.edit", ":slug") }}',//consultdetailsXHR
    url = url.replace(':slug',id);
    $.ajax({
          type : 'GET',
          url:url,
          success:function(data,status, xhr){
            $('#consultDetail').html(data);
          }
    });             
  }
  function HommeConfcopy(id)
  {
    var url = '{{ route("hommeConfiance.edit", ":slug") }}'; 
    url = url.replace(':slug',id);
    $.get(url, function (data) {
      $('#patientId').val(data.id_patient);
      $('#typeH option').each(function() {
        if($(this).val() == data.type) 
          $(this).prop("selected", true);
      });  
      $('#hom_id').val(data.id);  $('#nom_h').val(data.nom);$('#prenom_h').val(data.prenom);
      $('#datenaissance_h').val(data.date_naiss);  $('#lien_par').val(data.lien_par).change();    
      $('#lien_par option').each(function() {
        if($(this).val() == data.lien_par) 
          $(this).prop("selected", true);
      });
      switch(data.type_piece)
      {
        case "0":
          $('#CNI').prop('checked',true);
          break;
        case "1":
          $('#Permis').prop('checked',true);
          break;
        case "2":
          $('#Passeport').prop('checked',true);
          break;
        default:
          break;
      }
      $('#num_piece').val(data.num_piece);
      $('#date_piece_id').val(data.date_deliv);
      $('#adresse_h').val(data.adresse);
      $('#mobile_h').val(data.mob);
      jQuery('#gardeMalade').modal('show');
    });
  }
 /*$(function () {$.connection.hub.url = 'http://192.168.1.60:90/myhubs'; // Connect Hubs without the generated proxy
var chatHubProxy = $.connection.myChatHub;$.connection.hub.start().done(function () {console.log("Hub connected.");
$(".ordreticketPrint").click(function(){// barcode à envoyer var barcode = "1600|1|030621"; // Fonction d'envoie chatHubProxy.server.send(barcode);});
}).fail(function () {console.log("Could not connect to Hub.");});});*/// $('document').ready(function(){
$(function(){
    $('#listeGardes').DataTable({ 
        colReorder: true,
        stateSave: true,
        searching:false,
        'aoColumnDefs': [{
          'bSortable': false,
          'aTargets': ['nosort']
        }],
        "language": {
                    "url": '/localisation/fr_FR.json'
        },
    });
    $('#btn-addCores').click(function () { 
        if( $('#EnregistrerGardeMalade').is(":hidden"))
          $('#EnregistrerGardeMalade').show();
        $('#EnregistrerGardeMalade').val("add"); $('#addGardeMalade').trigger("reset");
        $('#CoresCrudModal').html("Ajouter un Correspondant(e)"); $('#gardeMalade').modal('show');   
    }); 
    jQuery('body').on('click', '.show-modal', function () {
      HommeConfcopy($(this).val());
      jQuery('#EnregistrerGardeMalade').hide();
      $('#CoresCrudModal').html("Détails du Correspondant(e)");
      $('#addGardeMalade').find('input, textarea, select').attr('disabled','disabled');
    });
    jQuery('body').on('click', '.open-modal', function () {
      HommeConfcopy($(this).val());
      if( $('#EnregistrerGardeMalade').is(":hidden"))
        $('#EnregistrerGardeMalade').show();
      jQuery('#EnregistrerGardeMalade').val("update"); 
      $('#CoresCrudModal').html("Editer un Correspondant(e)");
      $('#gardeMalade').modal('toggle');
    });
    jQuery('body').on('click', '.delete-garde', function () {
      var id = $(this).val();
      var url = '{{ route("hommeConfiance.destroy", ":slug") }}'; 
      url = url.replace(':slug',id);
      $.ajax({
            type: "DELETE",
            url: url,
            data: { _token: CSRF_TOKEN } ,
            success: function (data) {
                $("#garde" + id).remove();
            }
        });
    });
    $('#gardeMalade').on('hidden.bs.modal', function () {
      $('#gardeMalade form')[0].reset();
      $('#addGardeMalade *').prop('disabled', false);
    });
    $("#EnregistrerGardeMalade").click(function (e){
        $('#gardeMalade').modal('toggle');
        e.preventDefault();
        var formData = {
            _token: CSRF_TOKEN,
            id_patient:$('#patientId').val(),
            nom:$('#nom_h').val(),
            prenom : $('#prenom_h').val(),
            date_naiss : $('#datenaissance_h').val(),
            type:$('#typeH').val(),
            lien_par : $('#lien_par').val(),
            type_piece : $("input[name='type_piece']:checked").val(),
            num_piece : $('#num_piece').val(),
            date_deliv : $('#date_piece_id').val(),
            adresse : $('#adresse_h').val(),
            mob : $('#mobile_h').val(),
            created_by: $('#userId').val()
        };
        var state = jQuery('#EnregistrerGardeMalade').val();
        var type = "POST";var hom_id = jQuery('#hom_id').val();var ajaxurl = 'hommeConfiance';
        if (state == "update") {
          type = "PUT"; ajaxurl = '/hommeConfiance/' + hom_id;
        }
        if (state == "add") {
              ajaxurl ="{{ route('hommeConfiance.store') }}";
        }
        $('#addGardeMalade').trigger("reset");
        $.ajax({
          type: type,
          url: ajaxurl,
          data: formData,
          dataType: 'json',
          success: function (data) {
              var lien =  "";
              if($('.dataTables_empty').length > 0)
              {
                $('.dataTables_empty').remove();
              }
              switch(data.lien_par){
                case "0":
                      lien='<span class="label label-sm label-success"><b>Conjoint(e)</b></span>';
                      break;
                case "1":
                       lien='<span class="label label-sm label-success"><b>Père</b></span>';
                      break;
                case "2":
                      lien='<span class="label label-sm label-success"><b>Mère</b></span>';
                      break;
                case "3":
                      lien='<span class="label label-sm label-success"><b>Frère</b></span>';
                       break;
                case "4":
                      lien='<span class="label label-sm label-success"><b>Soeur</b></span>';
                      break;
                case "5":
                      lien='<span class="label label-sm label-success"><b>Ascendant</b></span>';
                      break;
                case "6":
                      lien='<span class="label label-sm label-success"><b>Grand-parent</b></span>';
                      break; 
                case "7":
                       lien='<span class="label label-sm label-success"><b>Membre de famille</b></span>';
                      break;
                case "8":
                        lien=' <span class="label label-sm label-success"><b>Ami</b></span>';
                        break;              
                case "9":
                        lien='<span class="label label-sm label-success"><b>Collègue</b></span>';
                        break; 
                case "10":
                        lien='<span class="label label-sm label-success"><b>Employeur</b></span>';
                        break; 
                case "11":
                        lien='span class="label label-sm label-success"><b>Employé</b></span>';
                        break; 
                case "12":
                        lien='<span class="label label-sm label-success"><b>Tuteur</b></span>';
                        break; 
                case "13":
                        lien='<span class="label label-sm label-success"><b>Autre</b></span>';
                        break; 
                default:
                        break;
              }
              switch(data.type_piece)
              {
                  case "0":
                         type='<span class="label label-sm label-success"><b>Carte nationale d\'identité</b></span>';
                        break;
                   case "1":
                        type='<span class="label label-sm label-success"><b>Permis de Conduire</b></span>';
                        break;
                   case "2":
                        type='<span class="label label-sm label-success"><b>Passeport</b></span>';
                        break;
                  default:
                        break;
              }
              var dateLivr = (data.date_deliv != null)? data.date_deliv :'';
              var homme = '<tr id="garde' + data.id + '"><td class="hidden">' + data.id_patient + '</td><td>' + data.nom + '</td><td>' + data.prenom
                        + '</td><td>'+ data.date_naiss+'</td><td>' + data.adresse + '</td><td>'+ data.mob + '</td><td>' + lien + '</td><td>'
                         + type + '</td><td>' + data.num_piece + '</td><td>' + dateLivr + '</td>';
              homme += '<td class ="center"><button type="button" class="btn btn-xs btn-success show-modal" value="' + data.id + '"><i class="ace-icon fa fa-hand-o-up fa-xs"></i></button> '; 
              homme +='<button type="button" class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true"></i></button> ';
              homme += '<button type="button" class="btn btn-xs btn-danger delete-garde" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
              if (state == "add") 
                $("#listeGardes tbody").append(homme);
              else 
                $("#garde" + hom_id).replaceWith(homme);          
          },
        }); 
    }); 
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
	$('.tablist').DataTable({
			"searching":false,
      "pageLength" : 10,
      bLengthChange: false,
      "info" : false,
			"language": {
          			"url": '/localisation/fr_FR.json'
      			}, 
	});
 /* $('#specialiteTick').change(function(){ if($(this).val() =="")       
$('#print').prop('disabled', 'disabled');else$('#print').removeAttr("disabled");});*/
      $('#print').click(function(e){
        e.preventDefault();
        $("#ticket").hide();
      	var formData = {
          _token: CSRF_TOKEN,
			  	specialite:$('#specialiteTick').val(),
			  	typecons:$('#typecons').val(),
			  	document:$('#document').val(), 
			  	id_patient:$('#id_patient').val()
		    };
        $.ajax({
            type : 'POST',
            url : '/createTicket',
            data:formData,
            success:function(data){ 
            	location.reload(true);
            }
        });
	 })
  });
</script>
@stop
@section('main-content')
<div class="row">
	<div class="pull-right">
	<a href="{{ route('patient.index') }}" class="btn btn-xs btn-white btn-info"><i class="ace-icon fa fa-search blue"></i>Chercher</a>
	<a href="{{route('patient.destroy',$patient->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-trash-o"> Supprimer</i></a>
	 </div>
</div>
<div class="row"><div class="col-sm-12">@include('patient._patientInfo')</div></div>
<br/>
<div>
	<div  class="user-profile">
		<div class="tabbable">
			<ul class="nav nav-tabs padding-18">
				<li class="active">
					<a data-toggle="tab" href="#home"><i class="green ace-icon fa fa-user bigger-120"></i><b>Informations administratives</b></a>
				</li>
				@if(in_array(Auth::user()->role_id,[1,13,14]))
					@if( $patient->antecedants->count() >0)
					<li>
						 <a data-toggle="tab" href="#Ants">
						 	<i class="fa fa-history fa-1x"></i>&nbsp;<span>Antécédents</span>&nbsp;<span class="badge badge-primary">
						 	{{ $patient->antecedants->count() }}</span>
						</a>
					</li>
					@endif
					<li>
						<a data-toggle="tab" href="#Cons">
							<i class="orange ace-icon fa fa-stethoscope bigger-120"></i>Consultations&nbsp;
							<span class="badge badge-warning">{{ $patient->consultations->count() }}</span>
						</a>
					</li>
					@if( $patient->hospitalisations->count() >0 )
					<li>
						<a data-toggle="tab" href="#Hosp"><i class="pink ace-icon fa fa-h-square bigger-120"></i>
							Hospitalisations&nbsp;<span class="badge badge-pink">{{ $patient->hospitalisations->count() }}</span>
						</a>
					</li>
					@endif
				@endif	
				@if((in_array(Auth::user()->role_id,[1,13,14,15]))&& $rdvs->count() > 0 )
				<li><a data-toggle="tab" href="#rdvs">
					<i class="blue ace-icon fa fa-calendar-o bigger-120"></i>Rendez-vous <span class="badge badge-info">{{ $rdvs->count() }}</span>
					</a>
				</li>
				@endif
				@if (!is_null($correspondants))
					<li><a data-toggle="tab" href="#homme_conf"><i class="green ace-icon fa fa-user bigger-120"></i>Homme de confiance
          &nbsp;<span class="badge badge-success">{{ $patient->hommesConf->count() }}</span>
          </a></li>
				@endif
        @if(in_array(Auth::user()->role_id,[1,13,14]))
        <li><a data-toggle="tab" href="#doc"><i class="yellow ace-icon fa fa-folder bigger-120"></i>Documents</a></li>
        @endif
			</ul>
			<div class="tab-content no-border padding-24">
				<div id="home" class="tab-pane in active"> @include('patient.patientInfo')</div>
				@if( $patient->antecedants->count() >0 )
				<div id="Ants" class="tab-pane">@include('antecedents.ants_Widget')</div>
				@endif
				<div id="Cons" class="tab-pane">@include('consultations.liste')</div>
				@if( $patient->hospitalisations->count() >0 )
				<div id="Hosp" class="tab-pane">@include('hospitalisations.liste')	</div>
				@endif
				<div id="rdvs" class="tab-pane"><div class="row">@include('rdv.liste')</div></div>
				<div id="homme_conf" class="tab-pane">
				  <div class="row">@include('corespondants.widget')</div><div class="row">@include('corespondants.add')</div>
				</div>
        <div id="doc" class="tab-pane">@include('documents.index')</div>
       </div>
		</div>
	</div>
</div>
<div id="ticket" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<input type="text" name="id_patient" id="id_patient" value="{{ $patient->id }}" hidden>
		<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter un ticket d'enregistrement</h4>
    </div>
    <div class="modal-body">
    	<div  class="form-group">
				<label for="typecons" class="form-label">Type de Consultation :</label>
				<select class="form-control" id="typecons" required>
					<option value="" selected disabled>Séléctionner...</option>
          <option value="Normale">Normale</option>
					<option value="Urgente">Urgente</option>
					<option value="controle">Contrôle</option>
					<option value="specialise">Spécialisée</option>
				</select>
			</div>
			<div  class=" form-group">
				<label for="document" class="form-label">Document :</label>
				<select class="form-control" id="document" required>
          <option value="" selected disabled>Séléctionner...</option>
					<option value="Rendez-vous">Rendez-vous</option>
					<option value="Lettre d'orientation">Lettre d'orientation</option>
					<option value="Consultation généraliste">Consultation généraliste</option>
					<option value="autre">Autre</option>
				</select>
			</div>
			<div  class="form-group">
				<label for="specialite" class="form-label">Spécialité :</label>
				<select class="form-control" id="specialiteTick" disabled required>
					@foreach($specialites as $specialite)
<option value="{{ $specialite->id}}" '{{($specialite->id == Auth::User()->employ->specialite) ?"selected disabled":'' }}'> {{ $specialite->nom}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" id ="print"><i class="ace-icon fa fa-copy"></i> Générer un ticket</button>	
			<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i> Fermer</button>
		</div>
    	
  		</div>
  	</div>
</div>
@stop