@extends('app')
@section('main-content')
<page-header><h1>Services de l'hôpital</h1>
</page-header>
<div class="row">
  <div class="col-sm-12 col-xs-12">
    <div class="alert alert-danger print-error-msg" style="display:none">
    <strong>Errors:</strong><ul></ul></div>
    <div class="alert alert-success print-success-msg" style="display:none"></div> 
  </div>
</div>
<div class="row">
	<div class="col-sm-7 col-xs-7 widget-container-col">
		<div class="widget-box widget-color-blue">
      <div class="widget-header">
        <h5 class="widget-title"><i class="ace-icon fa fa-table"></i>Services</h5>
        <div class="widget-toolbar widget-toolbar-light no-border"><a href="#" id ="servAdd" class="align-middle"><i class="fa fa-plus-circle bigger-180"></i></a>
        </div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover" id="serivesTable">
					<thead>
						<tr>
							<th class ="center">Nom</th><th class ="center" width="7%">Type</th>
							<th class ="center">Chef de service</th><th class ="center" width="5%">Hébergement</th>
							<th class ="center  priority-4" width="5%">Service d'urgence</th>
							<th class ="center" width="20%"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($services as $service)
					<tr id='{{ $service->id}}'>
						<td>
						<a href="#" title="Détails du service" class="servShow" data-id="{{$service->id}}">{{ $service->nom }}</a>
						</td>
						<td width="7%">{{ $service->TypeS }} </td>  
						<td>
							@isset($service->responsable)
								{{ $service->responsable->full_name }}
							@endisset	
							</td>
						<td class="priority-4" width="5%"> {{($service->hebergement) ?'Oui':'Non' }}</td>
						<td class="priority-4" width="5%"> {{($service->urgence) ?'Oui':'Non' }}</td>
						<td class ="center" width="20%">
              <button type="button" class="btn btn-xs btn-success servShow" data-id="{{$service->id}}"><i class="fa fa-hand-o-up fa-xs"></i></button>
              <button type="button" class="btn btn-xs btn-info servEdit" value="{{$service->id}}">
                <i class="ace-icon fa fa-pencil fa-xs"></i></button>
							@if($service->hebergement)
             	<a href="#" data-href="{{ route('salle.create', array('id' => $service->id) ) }}" class="btn btn-xs btn-grey" title="Ajouter une chambre" id="salleAdd"><i class="ace-icon fa fa-plus fa-xs"></i></a>
							@endif
							<button type="button" class="btn btn-xs btn-danger servDelete" value="{{ $service->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
						</td>
					</tr>
					@endforeach
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><div class ="col-sm-5 col-xs-5" id="ajaxPart"></div> 
</div>
@stop
@section('page-script')
@include('Salles.scripts')
<script type="text/javascript">
function getActions(data){
  var actions = '<button type="button" class="btn btn-xs btn-success servShow" value="' + data.id + '"><i class="fa fa-hand-o-up fa-xs"></i></button>';
      actions += '<button type="button" class="btn btn-xs btn-info servEdit" value="' + data.id + '"><i class="ace-icon fa fa-pencil fa-xs"></i></button>';
  if(data.hebergement)
    actions += '<a href="#" data-href="salle/create?id='+ data.id +'" class="btn btn-xs btn-grey" title="Ajouter une chambre" id="salleAdd"><i class="ace-icon fa fa-plus fa-xs"></i></a>';

  actions += '<button type="button" class="btn btn-xs btn-danger servDelete" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>';
  return actions;            
}
$(function(){
  $('body').on('change', '#type', function (e) {
    if($(this).val() == 2)
      $('.healthServ').hide();
    else
    {
      var html = '<option value="" selected disabled>Sélectionner...</option>';
      $.ajax({
        type : 'get',
        url : '{{ route("specialite.index") }}',
        data:{'type':$(this).val()},
        success:function(data,status, xhr){
          $.each(data, function(key, value){
            html += "<option value='"+this.id+"'>"+this.nom+"</option>";
          });
          $('#specialite_id').html(html);
        }
      });
      $('.healthServ').show();
    }
  });
  $('body').on('click', '#servAdd', function (e) {
      e.preventDefault();
      $.ajax({
          type: "GET",
          url: "{{ route('service.create') }}",
          data: { _token: CSRF_TOKEN },
          success: function (data) {
            $('#ajaxPart').html(data);
          } 
      });
  });
  $('body').on('click', '#serSave', function (e) {
    e.preventDefault();
    var state = jQuery('#serSave').val();
    formSubmit($('#serviceFrm')[0], this, function(status, data) {
     var medecin = (isEmpty(data.service.responsable_id)) ? '' : data.service.responsable.full_name;
      var heberg = (data.service.hebergement == 1) ? "Oui" : "Non";
      var urg = (data.service.urgence == 1) ? "Oui" : "Non" ;
      var service = '<tr id="' + data.service.id + '"><td><a href="#" title="Détails du service" class="servShow" data-id="'+ data.service.id +'">'+ data.service.nom + '</a></td><td>' + data.service.TypeS +'</td><td>'+ medecin +'</td><td>'+ heberg +'</td><td>' + urg +'</td><td class = "center">' +  getActions(data.service) + '</td></tr>';
      if (state == "add")
        $('#serivesTable' +' tbody').append(service);
      else
        $("#" + data.service.id).replaceWith(service);
      $('#ajaxPart').html("");      
    })
  });
  $('body').on('click', '.servShow', function (e) {
    e.preventDefault();
    var url = "{{ route('service.show',':slug') }}"; 
    url = url.replace(':slug',$(this).data('id'));
    $.ajax({
          type: "GET",
          url: url,
          data:{ _token: CSRF_TOKEN },
          success: function (data) {
            $('#ajaxPart').html(data);
          }
      }); 
  });
  $('body').on('click', '.servEdit', function (e) {
    e.preventDefault();
    var url = "{{ route('service.edit',':slug') }}"; 
    url = url.replace(':slug',$(this).val());
     $.ajax({
          type: "GET",
          url: url,
          data: { _token: CSRF_TOKEN },
          success: function (data) {
            $('#ajaxPart').html(data);
          }
      }); 
  });
  $('body').on('click', '.servDelete', function (e) {
    e.preventDefault();
    var url = "{{ route('service.destroy',':slug') }}"; 
    url = url.replace(':slug',$(this).val());
    $.ajax({
        type: "DELETE",
        url: url,
        data: {_token: CSRF_TOKEN },
        success: function (data) {
          $("#" + data).remove();
        }
    }); 
  });
})  
</script>
@stop