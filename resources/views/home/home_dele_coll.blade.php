@extends('app_dele')
@section('main-content')
<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i><strong>Liste des colloques</strong></h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th>Colloque de la semaine du</th>
							<th>Date du colloque</th>
							<th>Membres du colloque</th>
							<th>Les demandes traitées</th>
						</tr>
					</thead>
					<tbody>
				<?php $colloque= array();
				foreach( $colloques as $col){
					if (!array_key_exists($col->id_colloque,$colloque))
					{
						$colloque[$col->id_colloque]= array("dat"=> $col->date ,"membres"=> array ("$col->nom $col->prenom"),
								"demandes"=>array($col->id=>array(
									"id_dem"=>$col->id ,"date_dem"=>$col->Date_demande ,"patient"=>"$col->Nom $col->Prenom")));
  				}else{
  					if (array_search("$col->nom $col->prenom", $colloque[$col->id_colloque]["membres"])===false)
							$colloque[$col->id_colloque]["membres"][]="$col->nom $col->prenom";
						
							if (!array_key_exists($col->id, $colloque[$col->id_colloque]["demandes"])) {			
								$colloque[$col->id_colloque]["demandes"][$col->id]=array(
									"id_dem"=>$col->id ,"date_dem"=>$col->Date_demande ,"patient"=>"$col->Nom $col->Prenom");
							}
							 
					}
				}
				?>
		 		@foreach( $colloque as $cl=>$col)
				<tr>
					<td><?php $d=$col["dat"].' monday next week';echo(date('d M Y',strtotime($d)-1));?>	</td>
					<td> {{$col["dat"]}}</td>
					<td>
					@foreach($col["membres"] as $i=>$m)
						<p class="text-primary"> {{$col["membres"][$i]}} </p>
					@endforeach
					</td>
					<td>
						@foreach($col["demandes"] as $i=>$d)
							<p class="text-primary">{{$col["demandes"][$i]["patient"]}}&nbsp;&nbsp;<a class="text-success">{{$col["demandes"][$i]["date_dem"]}}</a></p>
						@endforeach
					</td>					
				</tr>
				@endforeach	
			</tbody>
		</table>
		</div>
		</div>
	</div>
</div><!-- /.span -->
@endsection