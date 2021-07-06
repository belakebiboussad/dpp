@extends('app_inf')
@section('main-content')
<?php $patient = $hosp->patient; ?>
<div class="row">@include('patient._patientInfo', $patient)</div>
@if(in_array(Auth::user()->role_id,[1,14]))
<div class="pull-right">
	 <a href="{{route('hospitalisation.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Hospitalisations</a>
</div>
@endif
<div class="row">
	<div class="col-sm-12"><h4> <strong> Hospitalisation : suivi(e) du patient</strong></h4></div>
</div>
<div class="tabbable"  class="user-profile">
	<ul class="nav nav-tabs padding-18">
		<li class="active"><a data-toggle="tab" href="#hospi"><strong>Hospitalisation</strong></a></li>
		@if(in_array(Auth::user()->role_id,[1,3,14]))
		<li ><a data-toggle="tab" href="#visites"><strong>Visites & Contrôles</strong></a></li>
		@endif
    @if(in_array(Auth::user()->role_id,[1,14]))
		<li ><a data-toggle="tab" href="#prescriptionconst"><strong>Prescription constantes</strong></a></li>
		@endif
		@if(in_array(Auth::user()->role_id,[1,3,14]))
		<li ><a data-toggle="tab" href="#constantes"><strong>Surveillance clinique</strong></a></li>
		@endif
	</ul>
	<div class="tab-content no-border padding-24">
		<div id="hospi" class="tab-pane in active">
			<div class="row">
			<div class="col-sm-12">
				<div class="row"><div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hospitalisation</span></strong></div></div>
				<div class="row">
					<div class="col-sm-12">
					<ul class="list-unstyled spaced">
						<li>
					    	<i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Service->nom }}
						</li>
						<li>
                            <i class="ace-icon fa fa-caret-right blue"></i><strong>Spécialité :</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Specialite->nom }}
						</li>
						<li>
							<i class="ace-icon fa fa-caret-right blue"></i><strong>Mode d'admission:</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->modeAdmission }}
						</li>
						<li>
							<i class="ace-icon fa fa-caret-right blue"></i><strong>Médecin Traitant:</strong>&nbsp;&nbsp;
							{{ $hosp->medecin->nom }}	{{$hosp->medecin->prenom}}		
						</li>
						<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Date d'entrée:</strong>&nbsp;&nbsp;{{ $hosp->Date_entree }}</li>	
						<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Date sortie prévue:</strong>&nbsp;&nbsp;{{ $hosp->Date_Prevu_Sortie }}</li>
					</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="space-12"></div>	
		<div class="row">
			<div class="col-sm-12">
				<div class="row"><div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hébergement</span></strong></div></div>
				<div class="row">
					<div class="col-sm-12">
					     <ul class="list-unstyled spaced" style="flex-grow: 1;">
					          <li style="width: 300px;" >
					           		<i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;
								   	{{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->service->nom }}
					          </li>
					          <li style="width: 300px;"><i class="ace-icon fa fa-caret-right"></i><strong>Salle :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->nom }}</li>
					          <li style="width: 200px;"><i class="ace-icon fa fa-caret-right"></i><strong>Lit :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->nom }}</li>
					      </ul>
					</div>
				</div>
			</div>
		</div>
		@if(in_array(Auth::user()->role_id,[1,3,14]))
    <div class="space-12"></div>
    <div class="row">
			<div class="col-sm-12">
				<div class="row"><div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><strong><span style="font-size:16px;">Liste des prescriptions constantes</span></strong></div></div>
				<div class="row">
					<div class="col-sm-12">
                        <br><br>
					    <table class="table table-striped table-bordered">
                            <thead>
                                <th>Date Prescription</th>
                                <th>Constantes</th>
                                <th>Observation</th>
                            </thead>
                            <tbody>
                                @foreach($hosp->prescreptionconstantes as $prescription)
                                    <tr>
                                        <td>{{ $prescription->date_prescription }}</td>
                                        <td>
                                            @foreach($prescription->constantes as $const)
                                                {{ $const->name }},&nbsp;
                                            @endforeach
                                        </td>
                                        <td>{{ $prescription->observation }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
					</div>
				</div>
			</div>
		</div>
		@endif
		@if(isset($hosp->garde_id))	
		<div class="space-12"></div>		
		<div class="row">
			<div class="col-sm-12">
				<div class="row"><div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><span style="font-size:16px;">Garde malade</span></strong></div></div>
				<div class="row">
					<ul class="list-unstyled spaced">
					  	<li> <i class="ace-icon fa fa-caret-right blue"></i><strong>Nom:</strong> {{ $hosp->garde->nom}}</li>
						<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Prénom:</strong> {{ $hosp->garde->prenom }} </li>
						 <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Né(e) le :</strong> {{ $hosp->garde->date_naiss }}</li>			  	
						<li>
					  		 <i class="ace-icon fa fa-caret-right blue"></i><strong>Âge :</strong> <span class="badge badge-info">{{ Jenssegers\Date\Date::parse($hosp->garde->date_naiss)->age }}</span> ans
						 </li>
					 	<li> <i class="ace-icon fa fa-caret-right blue"></i><strong>Relation :</strong> <span class="badge badge-success">{{ $hosp->garde->lien_par }}</li>
					  	<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Téléphone :</strong> <span class="badge badge-danger">{{ $hosp->garde->mob }}</li>  	
					</ul>
				</div>
			</div>
		</div>
		@endif
		</div>	{{-- tab-pane --}}
		<div id="visites" class="tab-pane in"><div class="row">@include('visite.liste')</div></div>
		<div id="constantes" class="tab-pane">
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-8">
						<div class="widget-box">
							<div class="widget-header">
								<h5 class="widget-title"><strong>Patient : {{ $patient->Nom }} {{ $patient->Prenom }}</strong></h5>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<canvas id="poid" width="400" height="100"></canvas>
									<canvas id="taille" width="400" height="100"></canvas>
									<canvas id="pas" width="400" height="100"></canvas>
									<canvas id="pad" width="400" height="100"></canvas>
									<canvas id="pouls" width="400" height="100"></canvas>
									<canvas id="temp" width="400" height="100"></canvas>
									<canvas id="glycemie" width="400" height="100"></canvas>
									<canvas id="cholest" width="400" height="100"></canvas>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="widget-box">
							<div class="widget-header">
								<h5 class="widget-title"><strong>Nouvelle prise</strong></h5>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<div class="text-center">			
										@if($message = Session::get('succes'))
											<div class="alert alert-success" role="alert">
												{{ $message }}
											</div>
										@endif 
										@if($message = Session::get('error'))
											<div class="alert alert-danger" role="alert">
												{{ $message }}
											</div>
										@endif
									</div>
									<form method="POST" action="/storeconstantes">
									{{ csrf_field() }}
									<input type="text" name="patient_id" id="patient_id" value="{{ $patient->id }}" hidden>
									<input type="text" name="hosp_id" id="hosp_id" value="{{ $hosp->id }}" hidden>
									<div>
										<label for="poids">Poid (KG)</label>
										<input type="number" step="0.01" name="poids" class="form-control" min="2" max="200" placeholder="Entre 2 et 200 (KG)">			
									</div>
									<hr/>
									<div>
										<label for="taille">Taille (CM)</label>
										<input type="number" step="0.01" name="taille" class="form-control" min="40" max="300" placeholder="Entre 40 et 300 (CM)">				
									</div>
									<hr/>
									<div>
										<label for="pas">PAS (mmHg)</label>
										<input type="number" step="0.01" name="pas" class="form-control" min="50" max="250" placeholder="Normal < 130 (mmHg)">				
									</div>
									<hr/>
									<div>
										<label for="pad">PAD (mmHg)</label>
										<input type="number" step="0.01" name="pad" class="form-control" min="10" max="150" placeholder="Normal < 85 (mmHg)">				
									</div>
									<hr/>
									<div>
										<label for="pouls">Pouls (bpm)</label>
										<input type="number" step="0.01" name="pouls" class="form-control" min="0" max="200" placeholder="Optimal entre 50 et 80 (bpm)">				
									</div>
									<hr/>
									<div>
										<label for="temp">Temp (°C)</label>
										<input type="number" step="0.01" name="temp" class="form-control" min="0" max="50" placeholder="Idéal 37 (°C)">				
									</div>
									<hr/>
									<div>
										<label for="glycemie">Glycémie (g/l)</label>
										<input type="number" step="0.01" name="glycemie" class="form-control" min="0" max="7" placeholder="Normale 0.7 et 1.1 (g/l)">				
									</div>
									<hr/>
									<div>
										<label for="cholest">Cholést (g/l)</label>
										<input type="number" step="0.01" name="cholest" class="form-control" min="0" max="7" placeholder="En moyenne entre 1,4 et 2,5 (g/l)">				
									</div>
									<hr/>
								</div>
							</div>
							<div class="form-actions center">
								<button type="submit" class="btn btn-sm btn-success">
									Enregistrer
									<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
								</button>
								</form>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
        <div class="space-12"></div>
        <div id="prescriptionconst" class="tab-pane">
			<div class="row">
			    <div class="col-sm-12">
                    <div class="widget-main padding-6 no-padding-left no-padding-right">
						<div class="space-6"></div>
						<div class="row">
							<form class="form-horizontal" role="form" method="POST" action="/storeprescriptionconstantes">
							{{ csrf_field() }}	
                            <input type="hidden" name="id_hosp" value="{{ $hosp->id }}">								
                            @foreach($consts as $const)
								<div class="col-xs-3">
									<div class="checkbox">
										<label>
											<input name="consts[]" type="checkbox" class="ace" value="{{ $const->id }}" />
											<span class="lbl"> 
											    {{ $const->name }}
											</span>
										</label>
									</div>
								</div>
							@endforeach
                            <div class="col-xs-12">
                                <br><br>
                                <div>
									<label for="form-field-8">Observation</label>

									<textarea class="form-control" id="observation" name="observation" placeholder="Observation"></textarea>
								</div>
                            </div>                           
							<div class="col-md-offset-6 col-md-6">
                                <br><br>
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Valider
								</button>
							</div>
                            </form>
						</div>
					</div>
                </div>
			</div>
		</div>
	</div>	{{-- tab-content --}}
</div>
@endsection
@section('page-script')
<script type="text/javascript">
var ctx = document.getElementById('poid').getContext('2d');
var pd = [];
var days = [];
var poidsfun = $.ajax({
    url: "/getpoids/{{ $hosp->id }}",
    async: false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.poid;
        });

        Array.prototype.push.apply(pd, finalArray);

        return finalArray;
    }
});
var daysfun = $.ajax({
    url: "/getdayspoids/{{ $hosp->id }}",
    async: false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.date_prise;
        });

        Array.prototype.push.apply(days, finalArray);

        return finalArray;
    }
});
var poid = new Chart(ctx, {
    type: 'line',
    data: {
        labels: days,
        datasets: [{
            label: 'Poid (KG)',
            data: pd,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script type="text/javascript">
var ctx = document.getElementById('taille').getContext('2d');
var tail = [];
var taillefun = $.ajax({
    url: "/gettaille/{{ $hosp->id }}",
    async: false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.taille;
        });

        Array.prototype.push.apply(tail, finalArray);

        return finalArray;
    }
});
var taille = new Chart(ctx, {
    type: 'line',
    data: {
        labels: days,
        datasets: [{
            label: 'Taille (CM)',
            data: tail,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script type="text/javascript">
var ctx = document.getElementById('pas').getContext('2d');
var pa = [];
var pasfun = $.ajax({
    url: "/getpas/{{ $hosp->id }}",
    async: false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.pas;
        });

        Array.prototype.push.apply(pa, finalArray);

        return finalArray;
    }
});
var pas = new Chart(ctx, {
    type: 'line',
    data: {
        labels: days,
        datasets: [{
            label: 'PAS (mmHg)',
            data: pa,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script type="text/javascript">
var ctx = document.getElementById('pad').getContext('2d');
var pdd = [];
var padfun = $.ajax({
    url: "/getpad/{{ $hosp->id }}",
    async: false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.pad;
        });

        Array.prototype.push.apply(pdd, finalArray);

        return finalArray;
    }
});
var pad = new Chart(ctx, {
    type: 'line',
    data: {
        labels: days,
        datasets: [{
            label: 'PAD (mmHg)',
            data: pdd,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script type="text/javascript">
var ctx = document.getElementById('pouls').getContext('2d');
var pou = [];
var poulsfun = $.ajax({
    url: "/getpouls/{{ $hosp->id }}",
    async: false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.pouls;
        });

        Array.prototype.push.apply(pou, finalArray);

        return finalArray;
    }
});
var pouls = new Chart(ctx, {
    type: 'line',
    data: {
        labels: days,
        datasets: [{
            label: 'Pouls (bpm)',
            data: pou,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script type="text/javascript">
var ctx = document.getElementById('temp').getContext('2d');
var tem = [];
var tempfun = $.ajax({
    url: "/gettemp/{{ $hosp->id }}",
    async: false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.temp;
        });

        Array.prototype.push.apply(tem, finalArray);

        return finalArray;
    }
});
var temp = new Chart(ctx, {
    type: 'line',
    data: {
        labels: days,
        datasets: [{
            label: 'Temp (°C)',
            data: tem,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script type="text/javascript">
var ctx = document.getElementById('glycemie').getContext('2d');
var glyc = [];
var glycemiefun = $.ajax({
    url: "/getglycemie/{{ $hosp->id }}",
    async: false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.glycemie;
        });

        Array.prototype.push.apply(glyc, finalArray);

        return finalArray;
    }
});
var glycemie = new Chart(ctx, {
    type: 'line',
    data: {
        labels: days,
        datasets: [{
            label: 'Glycémie (g/l)',
            data: glyc,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script type="text/javascript">
var ctx = document.getElementById('cholest').getContext('2d');
var choles = [];
var cholestfun = $.ajax({
    url: "/getcholest/{{ $hosp->id }}",
    async : false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.cholest;
        });

        Array.prototype.push.apply(choles, finalArray);

        return finalArray;
    }
});
var cholest = new Chart(ctx, {
    type: 'line',
    data: {
        labels: days,
        datasets: [{
            label: 'Cholést (mmol/l)',
            data: choles,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection