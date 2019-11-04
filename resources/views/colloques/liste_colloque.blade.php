@extends('app_dele')
@section('main-content')
<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h4 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
				<strong>Liste Des Colloques 
				@if(isset($type)) {{( $type == 1) ? 'Médicaux ' : 'Chirurgicaux' }}   @endif 
				</strong>
			</h4>
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
						<th><h4><strong>colloque de semaine du</strong></h4></th>
						<th><h4><strong>Date du colloque</strong></h4></th>
						<th><h4><strong>Membres</strong></h4></th>
						<th><h4><strong>colloque créer le</strong></h4></th>
						<th><h4><strong>Type colloque</strong></h4></th>
						<th><h4><strong>Etat colloque</strong></h4></th>
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
					@foreach($col["membres"] as $i=>$m)
					<p class="text-primary">{{$col["membres"][$i]}}</p>@endforeach
				</td>
		  	<td>
					<p class="text-primary">{{$col["creation"]}}</p>
				</td>
				<td>
					<p class="text-primary">{{$col["Type"]}}</p>
				</td>
				<td>
				      <p class="text-primary"><h4><span class="label label-sm label-success">{{$col["Etat"]}}</span></h4>
				     @if($col["Etat"]=="en cours") <a href="{{route('colloque.edit',$cl)}}" class="btn btn-xs btn-green"><i class="ace-icon fa fa-edit bigger-120"></i>déroullement de colloque</a> @endif</p>
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