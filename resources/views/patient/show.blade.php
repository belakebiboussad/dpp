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
    $.get('/hommeConfiance/'+ id +'/edit', function (data) {
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
}).fail(function () {console.log("Could not connect to Hub.");});});*/// $(function(){
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
      //var id = ;
      var url = '{{ route("hommeConfiance.destroy", ":slug") }}'; 
      url = url.replace(':slug',$(this).val());
      $.ajax({
            type: "DELETE",
            url: url,
            data: { _token: CSRF_TOKEN } ,
            success: function (data) {
              $("#garde" + data).remove();
            }
        });
    });
    $('#gardeMalade').on('hidden.bs.modal', function () {
      $('#gardeMalade form')[0].reset();
      $('#addGardeMalade *').prop('disabled', false);
    });
    $("#EnregistrerGardeMalade").click(function (e){
      if(! $.isEmptyObject(checkHomme()))
        printErrorMsg(checkHomme());
      else
      {
        var formData = {
            _token: CSRF_TOKEN, id_patient:$('#patientId').val(),
            nom:$('#nom_h').val(),prenom : $('#prenom_h').val(),
            date_naiss : $('#datenaissance_h').val(),type:$('#typeH').val(),
            lien_par : $('#lien_par').val(),type_piece : $("input[name='type_piece']:checked").val(),
            num_piece : $('#num_piece').val(),date_deliv : $('#date_piece_id').val(),adresse : $('#adresse_h').val(),
            mob : $('#mobile_h').val(),created_by: $('#userId').val() 
        };
        var state = jQuery('#EnregistrerGardeMalade').val();
        var type = "POST";var hom_id = jQuery('#hom_id').val();var ajaxurl = 'hommeConfiance';
        if (state == "update")
          type = "PUT"; ajaxurl = '/hommeConfiance/' + hom_id;
        if (state == "add")
          ajaxurl ="{{ route('hommeConfiance.store') }}";
        $.ajax({
          type: type,
          url: ajaxurl,
          data: formData,
          dataType: 'json',
          success: function (data) {
            var lien = "";
            if($('.dataTables_empty').length > 0)
              $('.dataTables_empty').remove();
            if(!$.isEmptyObject(data.errors))
              printErrorMsg(data.errors);
            else
            { 
              printSuccessMsg($('#addGardeMalade')[0], data.success);
              switch(data.homme.lien_par)
              {
                case "0":
                      lien ='Conjoint(e)';
                      break;
                case "1":
                      lien='Père';
                      break;
                  case "2":
                     lien='Mère';
                      break;
                  case "3":
                      lien='Frère';
                      break;
                  case "4":
                    lien='Soeur';
                    break;
                  case "5":
                    lien='Ascendant';
                    break;
                  case "6":
                    lien='Grand-parent';
                    break; 
                  case "7":
                     lien='Membre de famille';
                    break;
                  case "8":
                      lien='Ami';
                      break;              
                  case "9":
                          lien='Collègue';
                          break; 
                  case "10":
                          lien='Employeur';
                          break; 
                  case "11":
                          lien='Employé';
                          break; 
                  case "12":
                          lien='Tuteur';
                          break; 
                  case "13":
                          lien='Autre';
                          break; 
                  default:
                          break;

              }
              switch(data.homme.type_piece)
              {
                  case "0":
                         type='Carte nationale d\'identité';
                        break;
                   case "1":
                        type='Permis de Conduire';
                        break;
                   case "2":
                        type='Passeport';
                        break;
                  default:
                        break;
              }
              lien ='<span class="label label-sm label-success">'+lien+'</span>';
              type ='<span class="label label-sm label-info">'+type+'</span>';
              var dateLivr = (data.homme.date_deliv != null)? data.homme.date_deliv :'';
              var homme = '<tr id="garde' + data.homme.id + '"><td class="hidden">' + data.homme.id_patient + '</td><td>' + data.homme.nom + '</td><td>' + data.homme.prenom
                        + '</td><td>'+ data.homme.date_naiss+'</td><td>' + data.homme.adresse + '</td><td>'+ data.homme.mob + '</td><td>' + lien + '</td><td>'
                         + type + '</td><td>' + data.homme.num_piece + '</td><td>' + dateLivr + '</td>';
              homme += '<td class ="center"><button type="button" class="btn btn-xs btn-success show-modal" value="' + data.homme.id + '"><i class="ace-icon fa fa-hand-o-up fa-xs"></i></button> '; 
              homme +='<button type="button" class="btn btn-xs btn-info open-modal" value="' + data.homme.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true"></i></button> ';
              homme += '<button type="button" class="btn btn-xs btn-danger delete-garde" value="' + data.homme.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
              if (state == "add") 
                $("#listeGardes tbody").append(homme);
              else 
                $("#garde" + hom_id).replaceWith(homme);
              
            }
          }
        });
      }//else de checkhomme
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
			"language": {"url": '/localisation/fr_FR.json'},
  });
  $('.rdvDelete').on('click', function(e) {
    cancelMeeting($(this).val(),function(data) {
      var isFixe = (data.fixe)?'Oui':'Non';
      var rdv =  '<tr id="'+data.id+'"><td>'+data.start+'</td><td>'+ isFixe + '</td><td>'+ data.specialite.nom+'</td><td>'+data.employe.full_name +'</td><td class="center"><span class="badge badge-warning">'+ data.etat+'</span></td><td></td></tr>';
      $("#" + data.id).replaceWith(rdv);
    });   
  });
})
</script>
@stop
@section('main-content')
<div class="row">
	<div class="pull-right">
	<a href="{{ route('patient.index') }}" class="btn btn-xs btn-white"><i class="ace-icon fa fa-search blue"></i>Chercher</a>
	<a href="{{route('patient.destroy',$patient->id)}}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-warning"><i class="ace-icon fa fa-trash-o"> Supprimer</i></a>
	 </div>
</div>
<div class="row"><div class="col-sm-12">@include('patient._patientInfo')</div></div><br/>
<div>
	<div  class="user-profile">
		<div class="tabbable">
			<ul class="nav nav-tabs padding-18">
				<li class="active">
					<a data-toggle="tab" href="#patDemog"><i class="green ace-icon fa fa-user bigger-120"></i>Informations administratives</a>
				</li>
				@if(Auth::user()->isIn([1,13,14]))
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
				@if((Auth::user()->isIn([1,13,14,15])) && ($rdvs->count() > 0))
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
        @if(Auth::user()->isIn([1,13,14]))
        <li><a data-toggle="tab" href="#doc"><i class="yellow ace-icon fa fa-folder bigger-120"></i>Documents</a></li>
        @endif
			</ul>
			<div class="tab-content no-border padding-24">
				<div id="patDemog" class="tab-pane in active"> @include('patient.patientInfo')</div>
				@if( $patient->antecedants->count() >0 )
				<div id="Ants" class="tab-pane">@include('antecedents.ants_Widget')</div>
				@endif
				<div id="Cons" class="tab-pane">@include('consultations.liste')</div>
				@if( $patient->hospitalisations->count() >0 )
				<div id="Hosp" class="tab-pane">@include('hospitalisations.liste')	</div>
				@endif
				<div id="rdvs" class="tab-pane"><div class="row">@include('rdv.liste')</div></div>
				<div id="homme_conf" class="tab-pane">
				  <div class="row">@include('corespondants.widget')</div><div class="row">@include('corespondants.add')</div></div>
                           <div id="doc" class="tab-pane">
                           {{-- @include('teste')  --}}
                           @include('documents.index')
                           </div>
       </div>
		</div>
	</div>
</div>
@include('documents.ModalFoms.uploadModal')
@stop