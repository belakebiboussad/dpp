@extends('app_dele')
@section('main-content')

<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
					Liste Des Colloques
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th>colloque de semaine du</th>
							<th>Date du colloque</th>
							<th>Membres</th>
							<th>Les demandes traitées</th>
							<th>colloque créer le</th>
							<th>Type colloque</th>
							<th>Etat colloque</th>
						</tr>
					</thead>
					<tbody>
				<?php $colloque= array();
				    
				     
					foreach( $colloques as $col){
						if (!array_key_exists($col->id_colloque,$colloque))
							{
								$colloque[$col->id_colloque]= array("dat"=> $col->date_colloque ,"creation"=>$col->date_creation,"Type"=>$col->type,"Etat"=>$col->etat_colloque,"membres"=> array ("$col->Nom_Employe $col->Prenom_Employe"),
								"demandes"=>array($col->id=>array(
									"id_dem"=>$col->id ,"date_dem"=>$col->Date_demande ,"patient"=>"$col->Nom $col->Prenom")));

							}

						else
						   {if (array_search("$col->Nom_Employe $col->Prenom_Employe", $colloque[$col->id_colloque]["membres"])===false)
							$colloque[$col->id_colloque]["membres"][]="$col->Nom_Employe $col->Prenom_Employe";
						
							if (!array_key_exists($col->id, $colloque[$col->id_colloque]["demandes"])) {			
								$colloque[$col->id_colloque]["demandes"][$col->id]=array(
									"id_dem"=>$col->id ,"date_dem"=>$col->Date_demande ,"patient"=>"$col->Nom $col->Prenom");
							}
							 
						    	}

							
						}

						
						 ?>
		 				@foreach( $colloque as $cl=>$col)
						<tr>
							<td><?php $d=$col["dat"].' monday next week';
							echo(date('d M Y',strtotime($d)-1));
								?>
							</td>
							<td> {{$col["dat"]}}</td>
							<td>
								@foreach($col["membres"] as $i=>$m)
								<p class="text-primary">{{$col["membres"][$i]}}</p>@endforeach
							</td>
							<td>									@foreach($col["demandes"] as $i=>$d)<p class="text-primary">{{$col["demandes"][$i]["patient"]}}&nbsp;&nbsp;<a class="text-success">{{$col["demandes"][$i]["date_dem"]}}</a></p>@endforeach
								
							</td>
							<td>
								
								<p class="text-primary">{{$col["creation"]}}</p>

							</td>
							<td>
								
								<p class="text-primary">{{$col["Type"]}}</p>
							</td>
							<td>
								<p class="text-primary">{{$col["Etat"]}}
									@if($col["Etat"]=="en cours") <a href="{{route('colloque.edit',$cl)}}" class="btn btn-xs btn-green"><i class="ace-icon fa fa-edit bigger-120"></i>déroullement de colloque</a> @endif</p>
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