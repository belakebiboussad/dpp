@extends('app'){{--@extends('app_chef_ser') --}}
@section('page-script')
<script>
$('document').ready(function(){
	$('#medspch_table').dataTable({
		processing: true, //serverSide: true,
	      ordering: true,
	      bInfo : false,
	      searching: false,
	      pageLength: 20,         
	      bLengthChange: false,
	      nowrap:true,
	      "language": {
	                    "url": '/localisation/fr_FR.json'
	      },
	      ajax: '/getmedicamentsPCH',
	       columns: [
	                    {data: 'nom'},
	                    {data: 'code_produit'},
	                    {data: 'specialite'},
	        ]	
	});
	$('#dispo_table').dataTable({
		processing: true, //serverSide: true,
    ordering: true,
    bInfo : false,
    searching: false,
    pageLength: 20,         
    bLengthChange: false,
    nowrap:true,
    "language": {
                  "url": '/localisation/fr_FR.json'
    },
    ajax: '/getdispositifsPCH',
    columns: [
              {data: 'nom'},
              {data: 'code'}
    ]	
	});
	$('#reactifs_table').dataTable({
		processing: true, //serverSide: true,
    ordering: true,
    bInfo : false,
    searching: false,
    pageLength: 20,         
    bLengthChange: false,
    nowrap:true,
    "language": {
                  "url": '/localisation/fr_FR.json'
    },
    ajax: '/getreactifsPCH',
    columns: [
              {data: 'nom'},
              {data: 'code'}
    ]	
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
					<a href="{{ route('demandeproduit.create') }}"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120" style="font-size:18px;"></i>Demander un produit</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main padding-24">
				<div class="col-sm-12 widget-container-col" id="widget-container-col-13">
					<div class="widget-box transparent" id="widget-box-13">
						<div class="widget-header">
							<div class="widget-toolbar no-border">
								<ul class="nav nav-tabs" id="myTab2">
									<li class="active"><a data-toggle="tab" href="#medPCH">Médicaments</a></li>
									<li><a data-toggle="tab" href="#dispositifs">Dispositifs médicaux</a></li>
									<li><a data-toggle="tab" href="#reactifs">Réactifs chimiques et dentaires</a></li>
								</ul>
							</div>
						</div>
					  <div class="widget-body">
						<div class="widget-main padding-12 no-padding-left no-padding-right">
							<div class="tab-content padding-4">
								<div id="medPCH" class="tab-pane in active">
									<div class="scrollable-horizontal" data-size="800">
									<div>
						    		<table id="medspch_table" class="table table-bordered table-hover" width=100%> 
									    <thead>
									      <tr>
				                  <th class="center"><strong>Nom(D.C.I )</strong></th>
				                  <th class="center"><strong>Code</strong></th>
				                  <th class="center"><strong>specialité</strong></th>
				                </tr>
				                </thead>
									  </table>
									</div>
										</div>
									</div>{{-- tabpane --}}
									<div id="dispositifs" class="tab-pane col-sm-12">
											<div class="scrollable" data-size="100" data-position="left">
												<div>
													<table id="dispo_table" class="table table-striped table-bordered col-sm-12">
														<thead>
															<tr>
																<th>Nom</th>
																<th>Code </th>
															</tr>
														</thead>
													</table>
												</div>
											</div>
									</div>{{--tabpne --}}
									<div id="reactifs" class="tab-pane">
										<div class="scrollable" data-size="100">
											<div>
												<table id="reactifs_table" class="table table-striped table-bordered col-sm-12">
													<thead>
														<tr>
															<th>Nom</th>
															<th>Code</th>
														</tr>
													</thead>
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
	</div><!-- col-sm-10 -->
</div>	
</div>
</div>
@endsection