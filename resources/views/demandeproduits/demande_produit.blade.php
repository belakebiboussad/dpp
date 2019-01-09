@extends('app_chef_ser')
@section('main-content')
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12 col-sm-5">
			<div class="widget-box">
				<div class="widget-header">
					<h4 class="widget-title">Demande d'un produit pharmaceutique</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<form id="dmdprod" method="POST" action="{{ route('demandeproduit.store') }}">
									{{ csrf_field() }}
									<input type="text" name="id_user" value="{{ Auth::user()->id }}" hidden>
								</form>
								<div>
									<label for="gamme"><b>Gamme</b></label>
									<select class="form-control" id="gamme">
										<option value="">Sélectionner...</option>
										@foreach($gammes as $gamme)
											<option value="{{ $gamme->id }}">{{ $gamme->gamme }}</option>
										@endforeach	
									</select>
								</div>
								<hr/>
								<div>
									<label for="specialite"><b>Spécialité</b></label>
									<select class="form-control" id="specialite">
										<option value="">Sélectionner...</option>	
									</select>
								</div>
								<hr/>
								<div>
									<label for="produit"><b>Produit</b></label>
									<select class="form-control" id="produit">
										<option value="">Sélectionner...</option>
									</select>
								</div>
								<hr/>
								<div>
									<label for="quantite"><b>Quantité</b></label>
									<input type="number" class="form-control" id="quantite" name="quantite">
								</div>
								<hr/>
								<div class="pull right">
									<button id="ajoutercmd" class="btn btn-success">
										Ajouter a la demande
										<i class="ace-icon fa fa-angle-double-right" style="font-size:18px;"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.span -->
		<div class="col-xs-12 col-sm-7">
			<div class="widget-box">
				<div class="widget-header">
					<div class="widget-toolbar">						
						<a id="deletepod">
							<i class="ace-icon fa fa-refresh"></i>
						</a>
					</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<div>
									<form id="demandform" method="POST" action="{{ route('demandeproduit.store') }}">
									{{ csrf_field() }}
									<table id="cmd" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th></th>
												<th>Produit</th>
												<th>Gamme</th>
												<th>Spécialité</th>
												<th>Quantité</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="hr hr8 hr-double hr-dotted"></div>
								<div class="pull right">
									<button id="validerdmd" class="btn btn-primary">
										<i class="ace-icon fa fa-check-square-o" style="font-size:18px;"></i>
										Valider la commande
									</button>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.span -->
	</div>
</div>
@endsection