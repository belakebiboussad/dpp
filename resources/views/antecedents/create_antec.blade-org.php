@extends('app_recep')
@section('main-content')
	<div class="page-header">
		<h1 style="display: inline;"><strong>Ajouter Antécédant Pour :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
		<div class="pull-right">
        </div>
	</div>
	<form class="form-horizontal" action="/atcd/store/{{$patient->id}}" method="POST">
		{{ csrf_field() }}
		<div class="col-xs-6 col-sm-10">
			<div class="widget-box">
				<div class="widget-body">
					<div class="widget-main">
						<div>
							<label for="type_atcd"><strong>Type Antécédant :</strong></label>
							<select class="form-control" id="type_atcd" name="type_atcd" onchange="atcd()" required>
								<option value="">choose...</option>
								<option value="Personnels">Personnels</option>
								<option value="Familiaux">Familiaux</option>
							</select>
						</div>
						<hr/>
						<div id="sous_type" style="display: none;">
							<label for="sous_type_atcd"><strong>Sous_Type Antécédant :</strong></label>
							<select class="form-control" id="sous_type_atcd" name="sous_type_atcd" onselect="atcd()">
								<option value="">choose...</option>
								<option value="Physiologiques">Physiologiques</option>
								<option value="Pathologiques">Pathologiques</option>
							</select>
							<hr/>
						</div>
						
						<div>
							<label for="description"><strong>Date :</strong></label>
							<input type="text" name="dateatcd" class="form-control date-picker" id="id-date-picker-1"  data-date-format="yyyy-mm-dd" />
						</div>
						<hr/>
						<div>
							<label for="description"><strong>Description :</strong></label>
							<textarea class="form-control" id="description" name="description" placeholder="Description de l'antécédant" required></textarea>
						</div>
					</div>
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
		</div>														
	</form>
@endsection