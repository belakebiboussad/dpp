@extends('app_recep')
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>Modifier RDV Pour Le Patient :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
</div>
<div class="col-xs-11">
	<form class="form-horizontal" role="form" action="{{route('rdv.update',$rdv->id)}}" method="POST">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="type"><strong> Date RDV : </strong></label>
{{-- {{ $rdv->Date_RDV }} --}}
			<div class="col-sm-9">
				<input class="col-sm-3 date-picker" id="daterdv" type="text" name="daterdv" value="{{ \Carbon\Carbon::parse($rdv->Date_RDV)->format('Y-m-d') }}" data-date-format="yyyy-mm-dd" required/>
			</div>
		</div>
		{{-- <div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="type"><strong> Heure RDV : </strong></label>

			<div class="col-sm-9 bootstrap-timepicker">
				<input id="timepicker1" type="text" name="heurrdv" value="{{ $rdv->Temp_rdv }}" class="col-sm-3" required/>
			</div>
		</div> --}}
		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-save bigger-110"></i>
						Enregistrer
				</button>
			</div>
		</div>
	</form>
</div>
@endsection