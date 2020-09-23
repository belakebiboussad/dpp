@extends('app_phar')
@section('main-content')
<div class="row">
	<div class="col-xs-12">
		<div class="space-6"></div>
		<div class="col-sm-10 col-sm-offset-1">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-large">
					<h3 class="widget-title grey lighter">
						<i class="ace-icon fa fa-leaf green"></i>
		  				Liste des produits
						</h3>
						<div class="widget-toolbar hidden-480">
							<a href="{{ route('demandeproduit.create') }}">
								<i class="ace-icon fa fa-plus"></i>
								Demander un produit
							</a>
						</div>
					</div>
				</div>
		  </div>
</div>
</div>
@endsection