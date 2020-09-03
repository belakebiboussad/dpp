@extends('app')
@section('page-script')
<script type="text/javascript">
function getServiceRoom($id)
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
<div class="page-header">
	<h1>Services du l'Hôpital</h1>
</div>
<div class="row">
	<div class="col-xs-7">
		<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
				<span><b>Liste des Services</b></span>
			</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<a href="{{ route('service.create') }}">
					<i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>&nbsp;<b>Service</b>
				</a>
			</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class ="center">Nom</th>
							<th class ="center">Type</th>
							<th class ="center">Chef Service</th>
							<th class ="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
					@foreach($services as $service)
					<tr>
						<td><a href="#" id ={{  $service->id }} onclick="getServiceRoom({{ $service->id }});">{{ $service->nom }}</a></td>
						<td>{{ $service->Type }}</td>
						<td> {{ $service->responsable->Nom_Employe }} {{ $service->responsable->Prenom_Employe }}</td>
						<td class ="center">
							<a href="{{ route('service.show',$service->id) }}" class="btn btn-xs btn-success smalltext">
									<i class="fa fa-hand-o-up fa-xs"></i>	
								</a>
								<a href="{{ route('service.edit', $service->id) }}" class="btn btn-xs btn-info smalltext">
									<i class="ace-icon fa fa-pencil fa-xs"></i>
								</a>
								<a href="/salle/create/{{ $service->id }}" class="btn btn-xs btn-grey smalltext" title="Ajouter une chambre">
										<i class="ace-icon fa fa-plus fa-xs"></i>
								</a>
								<a href="{{ route('service.destroy', $service->id) }}"  data-method="DELETE" data-confirm="Etes Vous Sur ?"class="btn btn-xs btn-danger smalltext" >
									<i class="ace-icon fa fa-trash-o fa-xs"></i>
								</a>
						</td>
					</tr>
					@endforeach
					</tbody>
				</table>
				</div>
			</div>	{{-- widget-body --}}
		</div>
	</div>{{-- col-xs-12 --}}
	<div class ="col-xs-5" id="serviceRooms"> 
	</div>	
</div>
{{-- row --}}
@endsection