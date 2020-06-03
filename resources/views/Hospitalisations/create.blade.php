@extends('app')
@section('page-script')
@endsection
@section('main-content')
<div class="page-header">
	<h1> Ajouter une Hospitalisation </h1>
</div><!-- /.page-header -->
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-6 col-xs-6">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<th>Patient</th>
				<th>Mode Admission</th>
				<th>Medecin Traitant</th>
				<th>Ordre priorite</th>
				<th>Observation</th>
				<th>Date Entrée</th>
				<th>date Sortie prévue</th>
				<th class ="center"><em class="fa fa-cog"></em></th>
			</thead>
			<tbody>
				@foreach($adms as $adm)

				@endforeach

			</tbody>
		</table>
	</div>
	<div class="col-sm-6 col-xs-6">
		<form class="form-horizontal" role="form" method="POST" action="{{ route('hospitalisation.store') }}">
			{{ csrf_field() }}
			<input type="text" name="id_demande" value="" hidden>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="date">
			 		<strong> Date Hospitalisation :</strong>
				</label>
				<div class="col-sm-9">
					<input class="col-xs-12 col-sm-12 date-picker" id="date" name="date" type="text" placeholder="Date Hospitalisation" data-date-format="yyyy-mm-dd" readonly/>
				</div>				
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="date">
				 	<strong>Date Sortie Prévue :</strong>
			  </label>
				<div class="col-sm-9">
					<input class="col-xs-12 col-sm-12 date-picker" id="dateprevu" name="dateprevu" type="text" placeholder="Date Prévue Pour Sortir" data-date-format="yyyy-mm-dd" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="motif">
					<strong>Motif De L'hospitalisation :</strong>
				</label>
				<div class="col-sm-9">
					<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="" class="col-xs-12 col-sm-12" disabled/>
				</div>
			</div>
			<div class="col-md-offset-3 col-md-9">
				<button class="btn btn-info" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>Enregistrer
				</button>&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset">
					<i class="ace-icon fa fa-undo bigger-110"></i>Annuler
				</button>
			</div>
		</form>
	</div>

</div>
@endsection