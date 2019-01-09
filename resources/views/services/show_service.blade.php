@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Détails Du Service :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">Détails De Service :</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="nom"><strong> Nom Du Service : </strong></label>
							<div class="col-sm-9">
								<strong>{{ $service->nom }}</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection