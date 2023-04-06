@extends('app')
@section('page-script')
<script type="text/javascript">
function getServiceRoom(id)
{
  var url = '{{ route("salle.index") }}';
  $.ajax({
        type : 'get',
        url :url,
        data:{   id :  id  },
        success:function(data,status, xhr){
          	$('#ajaxPart').html(data);
        }
    });
}
function getActions(data){
  var actions = '<button type="button" class="btn btn-xs btn-success serv-show" value="' + data.id + '"><i class="fa fa-hand-o-up fa-xs"></i></button>';
      actions += '<button type="button" class="btn btn-xs btn-info serv-edit" value="' + data.id + '"><i class="ace-icon fa fa-pencil fa-xs"></i></button>';
  if(data.hebergement)
      actions += '<a href="salle/create?id='+ data.id +'" class="btn btn-xs btn-grey" title="Ajouter une chambre"><i class="ace-icon fa fa-plus fa-xs"></i></a>';
  actions += '<button type="button" class="btn btn-xs btn-danger serv-delete" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>';
  return actions;            
}
$(function(){
  $('body').on('click', '#serv-add', function (e) {
      e.preventDefault();
      var formData = {
        _token: CSRF_TOKEN,
      };
      var url = "{{ route('service.create') }}"; 
      $.ajax({
          type: "GET",
          url: url,
          data: formData,
          success: function (data) {
            $('#ajaxPart').html(data);
          } 
      });
  });
  $('body').on('click', '#serv-save', function (e) {
    e.preventDefault();
    var formData = {
      _token : CSRF_TOKEN,
      nom    : $('#nom').val(),
      type    : $('#type').val(),
      responsable_id    : $('#responsable_id').val(),
      hebergement    : $("input[name='hebergement']:checked").val(),
      urgence    : $("input[name='urgence']:checked").val(),
    };
     var url = "{{ route('service.store') }}";
     $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (data) {
                var type= "";
                switch(data.type)
                {
                  case "0":
                    type="Médicale";
                    break;
                  case "1":
                    type="Chirurgicale";
                    break;
                  case "2":
                    type="Fonctionnel";
                    break;
                  default:
                    break;
                }
                var medecin = (isEmpty(data.responsable)) ? '' : data.responsable.full_name;
                var heberg = (data.hebergement == 1) ? "Oui" : "Non", urg = (data.urgence == 1) ? "Oui" : "Non" ;
                var service = '<tr id="' + data.id + '"><td>'+ data.nom + '</td><td>' + type +'</td><td>'+ medecin +'</td><td>'+ heberg
                    service +='</td><td>' + urg +'</td><td class = "center">' +  getActions(data) + '</td></tr>';
               
                $('#serivesTable' +' tbody').append(service);

                $('#ajaxPart').html("");
            }
      });  
  });
  $('body').on('click', '.serv-show', function (e) {
    e.preventDefault();
    var formData = {
      _token: CSRF_TOKEN,
    };
    var url = "{{ route('service.show',':slug') }}"; 
    url = url.replace(':slug',$(this).val());
     $.ajax({
            type: "GET",
            url: url,
            data: formData,
            success: function (data) {
              $('#ajaxPart').html(data);
            }
      }); 
  });
  $('body').on('click', '.serv-edit', function (e) {
    e.preventDefault();
    var formData = {
      _token: CSRF_TOKEN,
    };
    var url = "{{ route('service.edit',':slug') }}"; 
    url = url.replace(':slug',$(this).val());
     $.ajax({
            type: "GET",
            url: url,
            data: formData,
            success: function (data) {
              $('#ajaxPart').html(data);
            }
      }); 
  });
  $('body').on('click', '.serv-delete', function (e) {
    e.preventDefault();
    var formData = {
      _token: CSRF_TOKEN,
    };
    var url = "{{ route('service.destroy',':slug') }}"; 
    url = url.replace(':slug',$(this).val());
    $.ajax({
            type: "DELETE",
            url: url,
            data: formData,
            success: function (data) {
              $("#" + data).remove();
            }
    }); 
  });
})	
</script>
@stop
@section('main-content')
<page-header><h1>Services de l'hôpital</h1>
</page-header>
<div class="row">
	<div class="col-sm-7 col-xs-12 widget-container-col">
		<div class="widget-box widget-color-blue">
      <div class="widget-header">
        <h5 class="widget-title"><i class="ace-icon fa fa-table"></i>Services</h5>
        <div class="widget-toolbar widget-toolbar-light no-border">
          <a href="#" id ="serv-add" class="align-middle"><i class="fa fa-plus-circle bigger-180"></i></a>
        </div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover" id="serivesTable">
					<thead>
						<tr>
							<th class ="center">Nom</th>
							<th class ="center" width="7%">Type</th>
							<th class ="center">Chef de service</th>
							<th class ="center" width="5%">Hébergement</th>
							<th class ="center  priority-4" width="5%">Service d'urgence</th>
							<th class ="center" width="20%"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($services as $service)
					<tr id='{{ $service->id}}'>
						<td>
							@if($service->hebergement && ( $service->salles->count() > 0))
								<a href="#" id ={{ $service->id }}  onclick="getServiceRoom({{ $service->id }});" title="afficher les chambres">{{ $service->nom }}</a>
							@else
								{{ $service->nom }}
							@endif
						</td>
						<td width="7%">{{ $service->type }} </td>  
						<td>
							@isset($service->responsable)
								{{ $service->responsable->full_name }}
							@endisset	
							</td>
						<td class="priority-4" width="5%"> {{($service->hebergement) ?'Oui':'Non' }}</td>
						<td class="priority-4" width="5%"> {{($service->urgence) ?'Oui':'Non' }}</td>
						<td class ="center" width="20%">
              <button type="button" class="btn btn-xs btn-success serv-show" value="{{$service->id}}"><i class="fa fa-hand-o-up fa-xs"></i></button>
              <button type="button" class="btn btn-xs btn-info serv-edit" value="{{$service->id}}">
                <i class="ace-icon fa fa-pencil fa-xs"></i></button>
							@if($service->hebergement)
             	<a href="{{ route('salle.create', array('id' => $service->id) ) }}" class="btn btn-xs btn-grey" title="Ajouter une chambre"><i class="ace-icon fa fa-plus fa-xs"></i>

							</a>
							@endif
							<button type="button" class="btn btn-xs btn-danger serv-delete" value="{{ $service->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
						</td>
					</tr>
					@endforeach
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class ="col-sm-5 col-xs-12" id="ajaxPart"></div> 
</div>
@stop