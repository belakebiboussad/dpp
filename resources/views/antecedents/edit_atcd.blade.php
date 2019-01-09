@extends('app_recep')
@section('main-content')
	<div class="page-header">
		<h1 style="display: inline;"><strong>Modifier Antécédant Pour :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
		<div class="pull-right">
        </div>
	</div>
	<form class="form-horizontal" action="{{route('atcd.update',$atcd->id)}}" method="POST">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="col-xs-6 col-sm-10">
			<div class="widget-box">
				<div class="widget-body">
					<div class="widget-main">
						<div>
							<label for="type_atcd"><strong>Type Antécédant :</strong></label>
							<select class="form-control" id="type_atcd" name="type_atcd" onchange="atcd()" required>
								<option value="{{$atcd->Antecedant}}">{{$atcd->Antecedant}}</option>
								<option value="Personnels">Personnels</option>
								<option value="Familiaux">Familiaux</option>
							</select>
						</div>
						<hr/>
						@if($atcd->typeAntecedant != null)
						<div id="sous_type">
							<label for="sous_type_atcd"><strong>Sous_Type Antécédant :</strong></label>
							<select class="form-control" id="sous_type_atcd" name="sous_type_atcd" onchange="atcd()">
								<option value="{{$atcd->typeAntecedant}}">{{$atcd->typeAntecedant}}</option>
								<option value="Physiologiques">Physiologiques</option>
								<option value="Pathologiques">Pathologiques</option>
							</select>
							<hr/>
						</div>
						@else
						<div id="sous_type" style="display: none;">
							<label for="sous_type_atcd"><strong>Sous_Type Antécédant :</strong></label>
							<select class="form-control" id="sous_type_atcd" name="sous_type_atcd" onchange="atcd()">
								<option value="">choose...</option>
								<option value="Physiologiques">Physiologiques</option>
								<option value="Pathologiques">Pathologiques</option>
							</select>
							<hr/>
						</div>
						@endif
						<div>
							<label for="description"><strong>Date :</strong></label>
							<input type="text" name="dateatcd" value="{{$atcd->date}}" class="form-control date-picker" id="id-date-picker-1"  data-date-format="yyyy-mm-dd" />
						</div>
						<hr/>
						<div>
							<label for="description"><strong>Description :</strong></label>
							<textarea class="form-control" id="description" name="description" placeholder="Description de l'antécédant" required>
								{{$atcd->descrioption}}
							</textarea>
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