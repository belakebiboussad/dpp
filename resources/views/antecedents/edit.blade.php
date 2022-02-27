@extends('app')
@section('main-content')
	<div class="page-header"><h1 style="display: inline;"><strong>Modifier antécédent du :</strong> {{ $patient->full_name }}</h1></div>
	<form class="form-horizontal" action="{{route('atcd.update',$atcd->id)}}" method="POST">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="col-xs-12 col-sm-12">
			<div class="widget-box">
				<div class="widget-body">
					<div class="widget-main">
						<div>
							<label for="type_atcd"><strong>Antécédent :</strong></label>
							<select class="form-control" id="type_atcd" name="type_atcd" onchange="atcd()" required>
								<option value="Personnels" @if($atcd->Antecedant == "Personnels") selected @endif>Personnels</option>
								<option value="Familiaux"  @if($atcd->Antecedant == "Familiaux") selected @endif>Familiaux</option>
							</select>
						</div>
						<hr/>
						@if($atcd->Antecedant == "Personnels")
						<div id="sous_type">
							<label for="sous_type_atcd"><strong>Type  antécédent :</strong></label>
							<select class="form-control" id="sous_type_atcd" name="sous_type_atcd" onchange="atcd()">
								<option value="Pathologiques" @if($atcd->typeAntecedant == "0") selected @endif>Pathologiques</option>
								<option value="Physiologiques" @if($atcd->typeAntecedant == "1") selected @endif>Physiologiques</option>
							</select>
							<hr/>
						</div>
						@endif
						<div>
							<label for="description"><strong>Date :</strong></label>
							<input type="text" name="dateatcd" value="{{$atcd->date}}" class="form-control date-picker" id="id-date-picker-1"  data-date-format="yyyy-mm-dd"/>
						</div>
						<hr/>
						<div>
							<label for="description"><strong>Description :</strong></label>
							<textarea class="form-control" id="description" name="description" placeholder="Description de l'antécédant" required>
								{{$atcd->description}}
							</textarea>
						</div>
					</div>
				</div>	
			</div>
			<div style="text-align: center;">
				<button class="btn btn-info" type="submit">	<i class="ace-icon fa fa-check bigger-110"></i>Envoyer</button>&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
			</div>
		</div>														
	</form>
@endsection