@extends('app'){{--@extends('app_chef_ser') --}}
@section('page.script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#meds_table').dataTable({
        			ordering: true,
		        	"language": 
		            	{
		             	   "url": '/localisation/fr_FR.json'
		            }, 
		 });
		$('#dispo_table').dataTable({
       		 	ordering: true,
        		"language": 
      			{
               			 "url": '/localisation/fr_FR.json'
            			}, 
    		});
		$('#reactif_table').dataTable({
        			ordering: true,
        			"language": 
            			{
                			"url": '/localisation/fr_FR.json'
            			}, 
    		});	
    });
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-xs-12">
	<div class="space-6"></div>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="widget-box transparent">
			<div class="widget-header widget-header-large">
				<h3 class="widget-title grey lighter"><i class="ace-icon fa fa-leaf green"></i>	Liste des produits	</h3>
				<div class="widget-toolbar hidden-480">
					<a href="{{ route('demandeproduit.create') }}"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120" style="font-size:18px;"></i>	Demander un produit	</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main padding-24">
					<div class="col-sm-12 widget-container-col" id="widget-container-col-13">
						<div class="widget-box transparent" id="widget-box-13">
							<div class="widget-header">
								<div class="widget-toolbar no-border">
									<ul class="nav nav-tabs" id="myTab2">
										<li class="active"><a data-toggle="tab" href="#home2">Médicaments</a></li>
										<li><a data-toggle="tab" href="#profile2">Dispositifs médicaux</a></li>
										<li><a data-toggle="tab" href="#info2">Réactifs chimiques et dentaires</a></li>
									</ul>
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main padding-12 no-padding-left no-padding-right">
									<div class="tab-content padding-4">
										<div id="home2" class="tab-pane in active">
											<div class="scrollable-horizontal" data-size="800">
												<div>
													<table id="meds_table" class="table table-striped table-bordered">
														<thead>
															<tr>
																<th>Gamme</th>
																<th>Spécialité</th>
																<th>Code Produit</th>
																<th>D.C.I (Dénomination Comune Internationale)</th>
															</tr>
														</thead>
														<tbody>
															@foreach($meds as $med)
																<tr>
																	<td>{{ $med->gamme->nom }}</td>
																	<td>{{ $med->specialite->specialite_produit }}</td>
																	<td  class="center">{{ $med->code_produit }}</td>
																	<td>{{ $med->dci }}</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div id="profile2" class="tab-pane">
											<div class="scrollable" data-size="100" data-position="left">
												<div>
													<table id="dispo_table" class="table table-striped table-bordered">
														<thead>
															<tr>
																<th>Gamme</th>
																<th>Spécialité</th>
																<th>Code Produit</th>
																<th>D.C.I (Dénomination Comune Internationale)</th>
															</tr>
														</thead>
														<tbody>
															@foreach($dispositifs as $dispo)
															<tr>
																<td>{{ $dispo->gamme->nom }}</td>
																<td>{{ $dispo->specialite->specialite_produit }}</td>
																<td class="center">{{ $dispo->code_produit }}</td>
																<td>{{ $dispo->dci }}</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div id="info2" class="tab-pane">
											<div class="scrollable" data-size="100">
												<div>
													<table id="reactif_table" class="table table-striped table-bordered">
														<thead>
															<tr>
																<th>Gamme</th>
																<th>Spécialité</th>
																<th>Code Produit</th>
																<th>D.C.I (Dénomination Comune Internationale)</th>
															</tr>
														</thead>
														<tbody>
															@foreach($reactifs as $react)
															<tr>
																<td>{{ $react->gamme->nom }}</td>
																<td>{{ $react->specialite->specialite_produit }}</td>
																<td class="center">{{ $react->code_produit }}</td>
																<td>{{ $react->dci }}</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div><!-- /.col -->
</div><!-- /.row -->
@endsection