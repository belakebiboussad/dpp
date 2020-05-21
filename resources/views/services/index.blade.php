@extends('app')
@section('page-script')
<script type="text/javascript">
function getServiceRoom($id)
{
	$.ajax({
           type : 'get',
            url : '{{URL::to('serviceRooms')}}',
              data:{'search':$id},
              success:function(data1,status, xhr){
          	     $('#serviceRooms').html(data1.html);
             	}
         });
}	
</script>

@endsection
@section('main-content')
<div class="page-header">
	<h1>Liste Des Services :</h1>
</div>
<div class="row">
	<div class="col-xs-7">
		<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
				<span><b>Liste Des Services</b></span>
			</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<div class="fa fa-plus-circle bigger-90"></div>
				<a href="{{ route('service.create') }}"> <b>Ajouter Un Service</b></a>
			</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Nom De Service</th>
							<th>Type De Service</th>
							<th>Chef De Service</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach($services as $service)
					<tr>
						<td><a href="#" id ={{  $service->id }} onclick="getServiceRoom({{ $service->id }});">{{ $service->nom }}</a></td>
						<td>{{ $service->Type }}</td>
						<td> {{ $service->responable_id}}</td>
						<td class="">
							<div class="pull-right">
							<div class="hidden-sm hidden-xs btn-group">
								<a href="{{ route('service.show',$service->id) }}" class="btn btn-xs btn-success smalltext">
									<i class="ace-icon fa fa-sign-in bigger-90"></i>
								</a>
								<a href="{{ route('service.edit', $service->id) }}" class="btn btn-xs btn-info smalltext">
									<i class="ace-icon fa fa-pencil bigger-90"></i>
								</a>
								<a href="/salle/create/{{ $service->id }}" class="btn btn-xs btn-grey smalltext" title="Ajouter une chambre">
										<i class="ace-icon fa fa-plus bigger-90"></i>
								</a>
								<a href="{{ route('service.destroy', $service->id) }}"  data-method="DELETE" data-confirm="Etes Vous Sur ?"class="btn btn-xs btn-danger smalltext" >
									<i class="ace-icon fa fa-pencil bigger-90"></i>
								</a>
							</div>
							</div>
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