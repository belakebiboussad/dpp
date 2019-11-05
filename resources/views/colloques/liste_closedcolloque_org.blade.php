@extends('app_dele')
@section('main-content')
<div id="" class="col-xs-12"></div>
	
</div><!-- / -->
<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h4 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
				<strong>Liste Des Colloques {{ ($type == 1) ? 'Médicaux ' : 'Chirurgicaux' }}</strong>
				<!-- { -->
			</h4>
			<div class="widget-toolbar widget-toolbar-light no-border"></div>	
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
					  <td>ID</td>
						<th><h4><strong>colloque de semaine du</strong></h4></th>
						<th><h4><strong>Date du colloque</strong></h4></th>
						<th><h4><strong>Membres</strong></h4></th>
						<th><h4><strong>Les demandes validées</strong></h4></th>
						<!-- <th><h4><strong>colloque créer le</strong></h4></th> -->	<!-- <th><h4><strong>Type colloque</strong></h4></th> -->
					
					</tr>
				</thead>
			  <tbody>
			  	@foreach( $colloque as $cle=>$col)
					<tr>
					  <td>{{ $cle }}</td>
						<td><?php $d=$col["dat"].' monday next week';
						echo(date('d M Y',strtotime($d)-1));?>
						</td>
						<td> {{$col["dat"]}}</td>
						<td>
							@foreach($col["membres"] as $i=>$m)
							<p class="text-primary">{{$col["membres"][$i]}}</p>@endforeach
						</td>
						<td>
							@foreach($col["demandes"] as $i=>$d)
								<p class="text-primary">
			       			{{$col["demandes"][$i]["patient"]}}&nbsp;&nbsp;<a class="text-success">{{ $col["demandes"][$i]["date_dem"] }}
			         	</p>
					    @endforeach
						 </td>
				  </tr>
				  @endforeach
		   	</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
@endsection		
