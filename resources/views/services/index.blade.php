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
          	$('#ajaxPart').html(data.html);
        }
    });
}
$(function(){
  $("#serv-add").click(function(e){
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

  $(".serv-show").click(function(e){
    e.preventDefault();
    var formData = {
      _token: CSRF_TOKEN,// id:$(this).val()
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
  $(".serv-edit").click(function(e){
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
  $(".serv-delete").click(function(e){
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
@endsection
@section('main-content')
<div class="row"><h4><strong>Services de l'hôpital</strong></h4></div>
<div class="row">
	<div class="col-sm-7 col-xs-12 widget-container-col">
		<div class="widget-box widget-color-blue">
		{{-- 	<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>liste des services</h5>
				 <a href="{{ route('service.create') }}"><i class="fa fa-plus-circle bigger-180"></i></a>--}}
      <div class="widget-header">
        <h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i>liste des services</h5>
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
							<th class ="center">Type</th>
							<th class ="center">Chef de service</th>
							<th class ="center">Hébergement</th>
							<th class ="center  priority-4">Service d'urgence</th>
							<th class ="center"><em class="fa fa-cog"></em></th>
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
						<td>
              @switch($service->type)
               @case(0)
                    Médicale
                    @break
                @case(1)
                    Chirurgicale
                   @break
                @case(2)
                    Fonctionnel
                    @break
                @default
                  Médicale
                  @break
               @endswitch
            </td>				
						<td>
							@isset($service->responsable)
								{{ $service->responsable->full_name }}
							@endisset	
							</td>
						<td class="priority-4"> {{($service->hebergement) ?'Oui':'Non' }}</td>
						<td class="priority-4"> {{($service->urgence) ?'Oui':'Non' }}</td>
						<td class ="center">
              <button type="button" class="btn btn-xs btn-success serv-show" value="{{$service->id}}"><i class="fa fa-hand-o-up fa-xs"></i></button>
              <button type="button" class="btn btn-xs btn-info serv-edit" value="{{$service->id}}">
                <i class="ace-icon fa fa-pencil fa-xs"></i></button>
							@if($service->hebergement)
             	<a href="{{ route('salle.create', array('id' => $service->id) ) }}" class="btn btn-xs btn-grey" title="Ajouter une chambre">
								<i class="ace-icon fa fa-plus fa-xs"></i>
							</a>
							@endif
							{{-- <a href="{{ route('service.destroy', $service->id) }}"  data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger" title="supprimer"><i class="ace-icon fa fa-trash-o fa-xs"></i></a> --}}
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
@endsection