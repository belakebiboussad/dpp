@extends('app')
@section('main-content')
<?php $patient = $hosp->patient; ?>
<div class="row">@include('patient._patientInfo', $patient)</div>
<page-header><h4>Hospitalisation : suivi(e) du patient</h4></page-header>
<div class="pull-right">
   <a href="{{route('hospitalisation.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Hospitalisations</a>
</div>
<div class="space-12"></div>
<div class="tabbable"  class="user-profile">
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a data-toggle="tab" href="#hospi">Hospitalisation</a></li>
    @if(in_array(Auth::user()->role_id,[1,13,14]) && ($hosp->visites->count()>0))
    <li><a data-toggle="tab" href="#visites">Visites & Contrôles</a></li>
    @endif
    @if(in_array(Auth::user()->role_id,[1,3,5,13,14]))
    <li><a data-toggle="tab" href="#constantes">Surveillance clinique</a></li>
    @endif
  </ul>
  <div class="tab-content no-border padding-24">
    <div id="hospi" class="tab-pane in active">
      <div class="row"><div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><span class="ft16">Hospitalisation</span></div></div>
      <div class="row">
        <div class="col-sm-12">
        <ul class="nav navbar-nav list-inline">
          <li class="list-inline-item" style="width:200px;">
            <i class="ace-icon fa fa-caret-right blue"></i><b>Service :</b>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Service->nom }}
          </li>
          <li class="list-inline-item" style="width:200px;">
            <i class="ace-icon fa fa-caret-right blue"></i><b>Spécialité :</b>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Specialite->nom }}
          </li>
          <li class="list-inline-item" style="width:300px;">
             <i class="ace-icon fa fa-caret-right blue"></i>
            <b>Mode d'admission:</b>&nbsp;&nbsp;
               <span class="badge badge-{{($hosp->admission->demandeHospitalisation->getModeAdmissionID($hosp->admission->demandeHospitalisation->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</span>
            </li>
            <li class="list-inline-item" style="width:300px;">
              <i class="ace-icon fa fa-caret-right blue"></i><b>Médecin Traitant:</b>&nbsp;&nbsp;
            {{ $hosp->medecin->nom }} {{$hosp->medecin->prenom}}    
            </li>
            <li class="list-inline-item" style="width:270px;">
             <i class="ace-icon fa fa-caret-right blue"></i><b>Date d'entrée:</b>&nbsp;&nbsp;{{ $hosp->date }}
            </li>
            <li class="list-inline-item" style="width:270px;"><i class="ace-icon fa fa-caret-right blue">
             </i><b>Date sortie prévue:</b>&nbsp;&nbsp;{{ $hosp->Date_Prevu_Sortie }}
            </li>
        </ul>
        </div>
      </div><div class="space-12"></div>
      <div class="row">
        <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
          <span class="ft16">Hébergement</span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
         <ul class="nav navbar-nav list-inline">
              <li class="list-inline-item" style="width: 300px;" >
                  <i class="ace-icon fa fa-caret-right blue"></i><b>Service :</b>&nbsp;&nbsp;
              {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->service->nom }}
              </li>
              <li class="list-inline-item" style="width: 300px;"><i class="ace-icon fa fa-caret-right"></i><b>Salle :</b> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->nom }}</li>
              <li class="list-inline-item"style="width: 200px;"><i class="ace-icon fa fa-caret-right"></i><b>Lit :</b> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->nom }}</li>
          </ul>
        </div>
      </div>
       @if(isset($hosp->garde_id)) 
      <div class="space-12"></div>
      <div class="row"><div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
      <span class="ft16">Garde malade</span></div></div>
      <div class="row">
        <ul class="nav navbar-nav list-inline">
          <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i><b>Nom & Prénom :</b> {{ $hosp->garde->full_name}}</li>
          <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i><b>Né(e) le :</b> {{ $hosp->garde->date_naiss }}</li>          
          <li>
             <i class="ace-icon fa fa-caret-right blue list-inline-item"></i><b>Âge :</b> <span class="badge badge-info">{{ Jenssegers\Date\Date::parse($hosp->garde->date_naiss)->age }}</span> ans
              </li>
          <li> <i class="ace-icon fa fa-caret-right blue list-inline-item"></i><b>Relation :</b> <span class="badge badge-success">{{ $hosp->garde->lienP }}</li>
                <li><i class="ace-icon fa fa-caret-right blue list-inline-item"></i><b>Téléphone :</b> <span class="badge badge-danger">{{ $hosp->garde->mob }}</li>   
        </ul>
      </div>
      @endif   
    </div> 
    @if(in_array(Auth::user()->role_id,[1,13,14]) && ($hosp->visites->count()>0))
    <div id="visites" class="tab-pane">@include('visite.liste')</div>
    @endif
    @if(in_array(Auth::user()->role_id,[1,3,5,13,14]))
    <div id="constantes" class="tab-pane">@include("hospitalisations.constanteteste")</div>
    @endif
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
  });
  //taille
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
  //pouls
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
//end pouls
//temp
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
});// end temp
// glycemie begin
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
// glycemie end
var ctx = document.getElementById('cholest').getContext('2d');
var choles = [];
var cholestfun = $.ajax({
    url: "/getcholest/{{ $hosp->id }}",
    async : false,
    success: function(result){

        var finalArray = result.map(function (obj) {
            return obj.LDL;
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
});
</script>
@endsection
