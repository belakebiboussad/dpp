@extends('app_dele')
@section('main-content')
<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>
				<strong>Liste des Colloques @if(isset($type)) {{( $type == 0) ? 'Médicaux ' : 'Chirurgicaux' }} @endif 	</strong>
			</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
			  <div class="fa fa-plus-circle"></div><a href="{{ route('colloque.create')}}"><b>Ajouter Colloque</b></a>
			</div>	
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class="center"><h5><strong>colloque de semaine du</strong></h5></th>
						<th class="center"><h5><strong>Date du colloque</strong></h5></th>
						<th class="center"><h5><strong>Membres</strong></h5></th>
						<th class="center"><h5><strong>colloque créer le</strong></h5></th>
						<th class="center"><h5><strong>Type colloque</strong></h5></th>
						<th class="center"><h5><strong>Etat colloque</strong></h5></th>
						<th class="center"><em class="fa fa-cog"></em></th>
					</tr>
				</thead>
			  <tbody>	
				@foreach( $colloques as $cle=>$col)
			  	<tr>
			  		<td><?= date('Y-m-j',strtotime( $col->date .' sunday next week')-1);?></td>		
		   			<td>{{ $col->date }}</td>
		   			<td>
						@foreach($col->membres as $i=>$employe)
							<p class="text-primary">{{ $employe->nom }} {{ $employe->prenom }}</p> 
						@endforeach
					</td>
					<td>{{ $col->date_creation }}</td>
					<td>{{ ($col->type ==0 ) ? 'médicale' : 'chirurgicale' }}</td>
					<td>{{ $col->etat }}</td>
					<td class="center">
							<a href="{{ route('colloque.edit',$col->id)}} " class="btn btn-sm btn-success"><i class="ace-icon fa fa-pencil-square-o bigger-110"></i></a>
							@if($col->etat =="en cours")
				  		<a href="/runcolloque/{{ $col->id }}" class="btn btn-sm btn-green" title="Déroulement"><i class="ace-icon fa fa-cog  bigger-110"></i></a>
				    	<a href="{{ route('colloque.destroy',$col->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-sm btn-danger"><i class="ace-icon fa fa-trash-o bigger-110"></i>
				  	@endif
						</td>
			  	</tr>
			  	@endforeach
		  	</tbody>
			</table>
			</div>
		</div><!-- widget-body -->
	</div><!-- widget-box -->
</div><!-- widget-container-col -->
@endsection