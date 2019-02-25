@extends('app_infirm')
@section('main-content')
	<div class="page-header">
		<h1 style="display: inline;"><strong>Appliquer consigne</strong></h1>
		<div class="pull-right">
				
		</div>
	</div>
	<form class="form-horizontal" action="{{ route('consigne.update',$consignes->id) }}" method="POST">
		{{ csrf_field() }}
  		{{ method_field('PUT') }}
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right"><strong>Consigne :</strong></label>
			<div class="col-sm-9">
				<input type="text" id="consigne" name="consigne" value="{{ $consignes->consigne }}" class="col-xs-10 col-sm-5" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right"><strong>Appliquée :</strong></label>
			<div class="col-sm-9">
				<input type="text" id="app" name="app" value="{{ $consignes->app }}" class="col-xs-10 col-sm-5" />
			</div>
		</div>
		
		

		<div style="text-align: center;">
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
	</form>
@endsection