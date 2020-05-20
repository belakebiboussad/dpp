@extends('app_dele')
@section('main-content')
<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
				<strong>Liste Des Colloques 
				@if(isset($type)) {{( $type == 1) ? 'Médicaux ' : 'Chirurgicaux' }}   @endif 
				</strong>
			</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
			        <div class="fa fa-plus-circle"></div>
			          <a href="{{ route('colloque.create')}}"><b>Ajouter Colloque</b></a>
			</div>	
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th><h5><strong>colloque de semaine du</strong></h5></th>
						<th><h5><strong>Date du colloque</strong></h5></th>
						<th><h5><strong>Membres</strong></h5></th>
						<th><h5><strong>colloque créer le</strong></h5></th>
						<th><h5><strong>Type colloque</strong></h5></th>
						<th><h5><strong>Etat colloque</strong></h5></th>
						<th></th>
					</tr>
				</thead>
			<tbody>		
			@foreach( $colloque as $cl=>$col)
			<tr>
				<td><?php $d=$col["dat"].' monday next week';
					echo(date('d M Y',strtotime($d)-1));?>
				</td>
				<td> {{$col["dat"]}}</td>
				<td>
					<ul class="list-inline">
					@foreach($col["membres"] as $i=>$m)
					  <span class="badge badge-primary badge-pill"><li class="list-inline-item">{{ $col["membres"][$i] }}</li></span>
					  <!-- <p class="text-primary">{{$col["membres"][$i]}}</p> --> <!-- <span class="badge badge-primary badge-pill"> {{ $col["membres"][$i] }}</span> --> 
					  @if(!($loop->last))
							<br>
						@endif
					@endforeach
					</ul>
				</td>
		  	<td>
					<p class="text-primary">{{$col["creation"]}}</p>
				</td>
				<td>
					<p class="text-primary">{{$col["Type"]}}</p>
				</td>
				<td>
				  <p class="text-primary"><h4><span class="label label-sm label-success">{{$col["Etat"]}}</span></h4></p>
				</td>
				<td>
					<a href="{{ route('colloque.edit',$cl)}} " class="btn btn-xs btn-success"><i class="ace-icon fa fa-pencil-square-o bigger-110"></i></a>
					@if($col["Etat"]=="en cours")
				  	<a href="/runcolloque/{{$cl}}" class="btn btn-xs btn-green" title="Déroulement">
				   		<i  class="ace-icon fa fa-cog  bigger-110"></i>	<!-- <em class="fa fa-cog"></em> -->
				   	</a>
				  	@endif
				  	<a href="{{ route('colloque.destroy',$cl)}}"></a>
				  	<a href="{{ route('colloque.destroy',$cl) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger"><i class="ace-icon fa fa-trash-o bigger-110"></i>
					</a>
				</td>	
			</tr>
			@endforeach
					</tbody>
				</table>
			</div>
		</div>{{-- widget-body --}}
	</div>{{-- widget-color-blue --}}
</div>{{-- widget-container-col-2 --}}
@endsection