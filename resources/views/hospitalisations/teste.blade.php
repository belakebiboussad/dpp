@extends('app')
@section("style")
<style type="text/css" media="screen">

</style>
@endsection
@section('main-content')
<?php $patient = $hosp->patient; ?>
<div class="row">@include('patient._patientInfo', $patient)</div>
<div class="pull-right">
   <a href="{{route('hospitalisation.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Hospitalisations</a>
</div>
<div class="row"><div class="col-sm-12"><h4> <strong> Hospitalisation : suivi(e) du patient</strong></h4></div></div>
<div class="space-12"></div>
<div class="tabbable"  class="user-profile">
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a data-toggle="tab" href="#hospi">Hospitalisation</a></li>
    @if(in_array(Auth::user()->role_id,[1,13,14]))
    <li><a data-toggle="tab" href="#visites">Visites & Contrôles</a></li>
    @endif
    @if(in_array(Auth::user()->role_id,[1,3,13,14]))
    <li><a data-toggle="tab" href="#constantes">Surveillance clinique</a></li>
    @endif
  </ul>
  <div class="tab-content no-border padding-24">
    <div id="hospi" class="tab-pane in active">
      <div class="row"><div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><span class="f-16"><strong>Hospitalisation</strong></span></div></div>
      <div class="row">
        <div class="col-sm-12">
        <ul class="nav navbar-nav list-inline">
          <li class="list-inline-item" style="width:200px;">
            <i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Service->nom }}
          </li>
          <li class="list-inline-item" style="width:200px;">
            <i class="ace-icon fa fa-caret-right blue"></i><strong>Spécialité :</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Specialite->nom }}
          </li>
          <li class="list-inline-item" style="width:300px;">
             <i class="ace-icon fa fa-caret-right blue"></i>
            <strong>Mode d'admission:</strong>&nbsp;&nbsp;
              @switch($hosp->admission->demandeHospitalisation->modeAdmission)
                @case(0)
                  <span class="label label-sm label-primary">Programme</span>
                  @break
                @case(1)
                  <span class="label label-sm label-success">Ambulatoire</span>
                  @break
                @case(2)
                  <span class="label label-sm label-warning">Urgence</span>
                  @break    
              @endswitch
            </li>
            <li class="list-inline-item" style="width:300px;">
              <i class="ace-icon fa fa-caret-right blue"></i><strong>Médecin Traitant:</strong>&nbsp;&nbsp;
            {{ $hosp->medecin->nom }} {{$hosp->medecin->prenom}}    
            </li>
            <li class="list-inline-item" style="width:270px;">
             <i class="ace-icon fa fa-caret-right blue"></i><strong>Date d'entrée:</strong>&nbsp;&nbsp;{{ $hosp->Date_entree }}
            </li>
            <li class="list-inline-item" style="width:270px;"><i class="ace-icon fa fa-caret-right blue">
             </i><strong>Date sortie prévue:</strong>&nbsp;&nbsp;{{ $hosp->Date_Prevu_Sortie }}
            </li>
        </ul>
        </div>
      </div><div class="space-12"></div>
      <div class="row">
        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
          <span class="f-16"><strong>Hébergement</strong></span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
         <ul class="nav navbar-nav list-inline">
              <li class="list-inline-item" style="width: 300px;" >
                  <i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;
              {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->service->nom }}
              </li>
              <li class="list-inline-item" style="width: 300px;"><i class="ace-icon fa fa-caret-right"></i><strong>Salle :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->nom }}</li>
              <li class="list-inline-item"style="width: 200px;"><i class="ace-icon fa fa-caret-right"></i><strong>Lit :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->nom }}</li>
          </ul>
        </div>
      </div>
       @if(isset($hosp->garde_id)) 
      <div class="space-12"></div>
      <div class="row"><div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
      <span class="f-16"><strong>Garde malade</strong></span></div></div>
      <div class="row">
        <ul class="nav navbar-nav list-inline">
          <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Nom & Prénom :</strong> {{ $hosp->garde->full_name}}</li>
          <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Né(e) le :</strong> {{ $hosp->garde->date_naiss }}</li>          
          <li>
             <i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Âge :</strong> <span class="badge badge-info">{{ Jenssegers\Date\Date::parse($hosp->garde->date_naiss)->age }}</span> ans
              </li>
          <li> <i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Relation :</strong> <span class="badge badge-success">{{ $hosp->garde->lienP }}</li>
                <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i><strong>Téléphone :</strong> <span class="badge badge-danger">{{ $hosp->garde->mob }}</li>   
        </ul>
      </div>
      @endif   
    </div> 
    @if(in_array(Auth::user()->role_id,[1,13,14]))
    <div id="visites" class="tab-pane">
      @include('visite.liste')
     </div>
    @endif
    <div id="constantes" class="tab-pane">
      <div class="row">
        <div class="col-sm-8">
          <div class="widget-box">
            <div class="widget-header"><h5 class="widget-title"><strong>Patient : {{ $patient->full_name }}</strong></h5></div>
              <div class="widget-body">
                <div class="widget-main">
                  <canvas id="poids" width="400" height="100"></canvas>
                  <canvas id="taille" width="400" height="100"></canvas>
                  <canvas id="pas" width="400" height="100"></canvas>
                  <canvas id="pad" width="400" height="100"></canvas>
                  <!-- <canvas id="pouls" width="400" height="100"></canvas>
                  <canvas id="temp" width="400" height="100"></canvas>
                  <canvas id="glycemie" width="400" height="100"></canvas>
                  <canvas id="cholest" width="400" height="100"></canvas> -->
                </div>
              </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="widget-box">
            <div class="widget-header"><h5 class="widget-title"><strong>Nouvelle prise</strong></h5></div>
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
                    </hr>
                    <div class="form-actions center">
                      <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
                      </button>
                    </div>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-script')
<script type="text/javascript">
  $( function() {
    var ctx = document.getElementById('poids').getContext('2d');
    var pd = [];
    var days = [];
    var poidsfun = $.ajax({
      url: "/getpoids/{{ $hosp->id }}",
      async: false,
      success: function(result){
          var finalArray = result.map(function (obj) {
              return obj.poids;
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
              return obj.date;
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
  });//taille
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
});
</script>
@endsection
