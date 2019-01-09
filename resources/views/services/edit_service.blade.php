@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Modifier Un service :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
				<div class="widget-box" id="widget-box-1">
					<div class="widget-header">
						<h5 class="widget-title">Modifier Un Service :</h5>
					</div>
					<div class="widget-body">
						<div class="widget-main">
							<form class="form-horizontal" role="form" method="POST" action="{{ route('service.update', $service->id) }}">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Nom Du Service : </strong></label>
									<div class="col-sm-9">
										<input type="text" id="nom" name="nom" value="{{ $service->nom }}" placeholder="Nom Du Service" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div>
									<div class="center">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											Submit
										</button>
										&nbsp; &nbsp; &nbsp;
										<button class="btn" type="reset">
											<i class="ace-icon fa fa-undo bigger-110"></i>
											Reset
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
		</div>
	</div>
@endsection