@extends('app')
@section('page-script')
<script type="text/javascript">
function getServiceRoom(id)
{
	$.ajax({
	        type : 'get',
	        url : '{{URL::to('serviceRooms')}}',
	        data:{'search':$id},
	        success:function(data,status, xhr){
	        	 $('#serviceRooms').html(data.html);
	        }
      });
}	
</script>
@endsection
@section('main-content')
<div class="row"><h4><strong>Services de l'hôpital</strong></h4></div>
<div class="row">
	<div class="col-sm-7 col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Détails des services</h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
					<a href="{{ route('service.create') }}"><i class="fa fa-plus-circle bigger-180" style="color:black"></i>	</a>
				</div>
			</div><!-- widget-header -->
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
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
					<tr>
						<td>
							@if($service->hebergement && ( $service->salles->count() > 0))
								<a href="#" id ={{ $service->id }}  onclick="getServiceRoom({{ $service->id }});">{{ $service->nom }}</a>
							@else
								{{ $service->nom }}
							@endif
						</td>
						<td>{{ ($service->type ==0) ?'médicale':'chirurgicale' }}	</td>				
						<td>
							@isset($service->responsable)
								{{ $service->responsable->nom }} {{ $service->responsable->prenom }}
							@endisset	
							</td>
						<td class="priority-4"> {{($service->hebergement) ?'Oui':'Non' }}</td>
						<td class="priority-4"> {{($service->urgence) ?'Oui':'Non' }}</td>
						<td class ="center">
							<a href="{{ route('service.show',$service->id) }}" class="btn btn-xs btn-success smalltext">
									<i class="fa fa-hand-o-up fa-xs"></i>	
							</a>
							<a href="{{ route('service.edit', $service->id) }}" class="btn btn-xs btn-info smalltext">
								<i class="ace-icon fa fa-pencil fa-xs"></i>
							</a>
							@if($service->hebergement)
							<a href="/salle/create/{{ $service->id }}" class="btn btn-xs btn-grey smalltext" title="Ajouter une chambre">
								<i class="ace-icon fa fa-plus fa-xs"></i>
							</a>
							@endif
							<a href="{{ route('service.destroy', $service->id) }}"  data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger smalltext"><i class="ace-icon fa fa-trash-o fa-xs"></i></a>
						</td>
					</tr>
					@endforeach
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class ="col-sm-5 col-xs-12" id="serviceRooms"></div> 
</div>
@endsection