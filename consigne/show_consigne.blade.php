@extends('app_infirm')
@section('main-content')
<div class="row">
	<div class="col-xs-12">
	<a href="{{ URL::previous() }}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>
				Retour a la liste des consignes
			</a>
		<div class="space-6"></div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-large">
					<li class="divider"></li>
					<li>
					<i class="ace-icon fa fa-caret-right blue"></i>
						<strong>consigne</strong>
						<b class="red">{{$consigne->consigne }}</b>
					</li>
					<li>
						<i class="ace-icon fa fa-caret-right blue"></i>
							<strong>Apliquée:</strong>
							<b class="red">{{$consigne->app}}</b>
					</li>
				</ul>
									</div>
								</div><!-- /.col -->		
							</div><!-- /.row -->
							<div class="space"></div>
							<hr>
							@include('flash::message')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection