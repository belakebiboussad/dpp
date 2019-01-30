@extends('app')
@section('page-script')
<script type="text/javascript">
function getServiceRoom($id)
{
	alert("dsfsd");
}	
</script>

@endsection
@section('main-content')
<div class="page-header">
	<h1>Liste Des Services :</h1>
</div>
<div class="row">
	<div class="col-xs-6">
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
							<th>Chef De Seervice</th>
							<th>Seervice d'urence</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach($services as $service)
					<tr>
						<td><a href="#" onclick="getServiceRoom();"></a>{{ $service->nom }}</td>
						<td>{{ $service->Type }}</td>
						<td> {{ $service->responable_id}}</td>
						<td> {{ $service->urgence}}</td>
						<td>
							<div class="pull-right">
							<div class="hidden-sm hidden-xs btn-group">
							<a href="/salle/create/{{ $service->id }}" class="btn btn-xs btn-grey">
								<i class="ace-icon fa fa-cube bigger-120"></i>Ajouter Chambre
							</a>
							&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
							<a href="{{ route('service.show',$service->id) }}" class="btn btn-xs btn-success">
								<i class="ace-icon fa fa-sign-in bigger-120"></i>Afficher
							</a>
							&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
							<a href="{{ route('service.edit', $service->id) }}" class="btn btn-xs btn-info">
								<i class="ace-icon fa fa-pencil bigger-120"></i>Modifier
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
	<div class ="col-xs-6"> 
		<div class="servive-block servive-block-grey" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
				<span><b>Liste des chambres</b></span>
			</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Numéro chambre</th>
							<th>nom chambre</th>
							<th>nombre de lits</th>
							<th>Etat</th>
						</tr>
					</thead>
					<tbody id="serviceRoom">

					</tbody>
				</table>
				</div>	{{-- widget-main --}}
			</div>{{-- widget-body --}}
			</div>
	</div>	
</div>
{{-- row --}}
@endsection