@extends('app')
@section('title','Liste de produits')
@section('page.script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#meds_table').dataTable({
    		ordering: true,
	      bInfo : false,
	      searching: false,
	      pageLength: 20,         
	      bLengthChange: false,
	      nowrap:true,
       	"language": 
      	{
        	 "url": '/localisation/fr_FR.json'
        }, 
		 });
		$('#dispo_table').dataTable({
     	 	ordering: true,
     	 	 pageLength: 20,         
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
		<div class="col-sm-10 col-sm-offset-1">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-large">
					<h3 class="widget-title grey lighter"><i class="ace-icon fa fa-leaf green"></i>Base de données de produits pharmaceutique</h3>
				</div>
				<div class="widget-body">
					<div class="widget-main padding-24">
						<div class="col-sm-12 widget-container-col">
							<div class="widget-box transparent">
								<div class="widget-header">
									<div class="widget-toolbar no-border">
										<ul class="nav nav-tabs">
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
																<th class="center">Nom (Dénomination Commune Internationale)</th>
																<th class="center">Spécialité</th>
																<th class="center">Code produit</th>
															</tr>
															</thead>
															<tbody>
																 @foreach($meds as $med)
																<tr>	
																	<td>{{ $med->nom }}</td>
																	<td>{{ $med->specialite->nom }}</td>
																	<td  class="center">{{ $med->code_produit }}</td>
																</tr>
																@endforeach
															</tbody>
															</table>
															{{ $meds->links() }}
															<p>affichage {{$meds->count()}} de {{ $meds->total() }} Médicament(s).</p>
														</div>
													</div>
											</div>
											<div id="profile2" class="tab-pane">
												<div class="scrollable" data-size="100" data-position="left">
													<div>
														<table id="dispo_table" class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th class="center">Code produit</th>
																	<th class="center">Nom(Dénomination Commune Internationale)</th>
																</tr>
															</thead>
															<tbody>
																@foreach($dispositifs as $dispo)
																<tr>
																	<td class="center">{{ $dispo->code }}</td>
																	<td>{{ $dispo->nom }}</td>
																</tr>
																@endforeach
															</tbody>
														</table>
															{{ $meds->links() }}
															<p>affichage {{$dispositifs->count()}} de {{ $dispositifs->total() }} Dispositif(s).</p>
														</div>
												</div>
											</div>
											<div id="info2" class="tab-pane">
													<div class="scrollable" data-size="100">
														<div>
															<table id="reactif_table" class="table table-striped table-bordered">
																<thead>
																	<tr><!-- <th>Spécialité</th> -->
																		<th>Code Produit</th>
																		<th>D.C.I (Dénomination Commune Internationale)</th>
																	</tr>
																</thead>
																<tbody>
																	@foreach($reactifs as $react)
																		<tr>
																			<td class="center">{{ $react->code }}</td>
																			<td>{{ $react->nom}}</td>
																		</tr>
																	@endforeach
																</tbody>
															</table>
															{{ $meds->links() }}
															<p>affichage {{$reactifs->count()}} de {{ $reactifs->total() }} Réactifd(s).</p>
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
</div>
@endsection