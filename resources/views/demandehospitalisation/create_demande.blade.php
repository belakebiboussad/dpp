@extends('app_med')
@section('main-content')
<div class="page-header">
	<h1>Détails Du Consultation Pour : {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Les Informations Du Patient :</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<label class="inline">
						<span class="blue"><strong>Nom Du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Nom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Prénom Du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Prenom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Genre Du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Date Naissance Du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Dat_Naissance }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Age Du Patient :</strong></span>{{-- Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age --}}
						<span class="lbl"> {{ $patient->getAge( ) }} ans</span>
					</label>
				</div>
			</div>
		</div>
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Demande Hospitalisation :</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<form method="POST" action="{{route('demandehosp.store')}}">
						{{ csrf_field() }}
						<input type="text" name="id_consultation" value="{{$consultation->id}}" hidden>
						<div class="control-group">
							<label for="motif">
								<strong> Motif Hospitalisation : </strong>
							</label>
							<br/>
							<input type="text" id="motif" name="motif" placeholder="Motif Hospitalisation"  class="form-control"/>
						</div>
						<br/>
						<div class="control-group">
							<label>
								<strong> Description : </strong>
							</label>
							<br/>
							<textarea id="description" name="description" placeholder="Description" class="form-control"></textarea>
						</div>
						<br/>
						<div class="control-group">
							<label class="control-label bolder">Degrée D'urgence :</label>
							<div class="radio">
								<label>
									<input name="degreeurg" value="Haut" type="radio" class="ace" />
									<span class="lbl"> Haut</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="degreeurg" value="Moyen" type="radio" class="ace" />
									<span class="lbl"> Moyen</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="degreeurg" value="Faible" type="radio" class="ace" />
									<span class="lbl"> Faible</span>
								</label>
							</div>
						</div>
						<br/>
						<div>
							<label for="form-field-select-3">
								<strong>Service :</strong>
							</label>
							<br />
							<select class="chosen-select form-control" id="service" name="service" data-placeholder="Choisir Un Service...">
								<option value="">  </option>
								<option value="Service 1">Service 1</option>
								<option value="Service 2">Service 2</option>
							</select>
						</div>
					</div>	
				</div>
			</div>
			<br/>
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
		</form>
		</div>
	</div>
</div>
@endsection