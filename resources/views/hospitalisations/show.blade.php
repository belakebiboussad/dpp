@extends('app')
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
    @if(in_array(Auth::user()->role_id,[1,13,14]) && ($hosp->visites->count()>0))
    <li><a data-toggle="tab" href="#visites">Visites & Contrôles</a></li>
    @endif
    @if(in_array(Auth::user()->role_id,[1,3,5,13,14]))
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
               <span class="badge badge-{{($hosp->admission->demandeHospitalisation->getModeAdmissionID($hosp->admission->demandeHospitalisation->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</span>
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
    @if(in_array(Auth::user()->role_id,[1,13,14]) && ($hosp->visites->count()>0))
    <div id="visites" class="tab-pane">@include('visite.liste')</div>
    @endif
    @if(in_array(Auth::user()->role_id,[1,3,5,13,14]))
    <div id="constantes" class="tab-pane">@include("hospitalisations.constante")</div>
    @endif
  </div>
</div>
@endsection
@section('page-script')
<script type="text/javascript">
function getConstDatas(hospId,constName)
{
  var constValues1 = [];
  url = "{{ route('getConstData') }}";
  $.ajax({
      url: url,
      data: {    
          "hosp_id":hospId,
          "const_name":constName,
      },
      async: false,
      success: function(result) {
        var finalArray = result.map(function (obj) {
          return obj[constName];
        });
        Array.prototype.push.apply(constValues1, finalArray); //return constValues1;
      },
  });
  return constValues1;
}
$( function() {
    if('{{$specialite->hospConst}}' != "");
    {
      var days = [];
      days = getConstDatas('{{ $hosp->id }}','date')
      $.each({!! $specialite->hospConst !!},function(key,id){
        $.get('/const/'+id+'/edit', function (data) {
          var constValues= [];
          constValues = getConstDatas('{{ $hosp->id }}',data.nom)
          if(constValues.length > 0 )
          {
            var ctx = document.getElementById(data.nom).getContext('2d');
            new Chart(ctx, {
              type: 'line',
              data: {
                  labels: days,
                  datasets: [{
                      label: data.nom+"(" + data.unite + ")",
                      data: constValues,
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
          }
        })
      });
    }
});
</script>
@endsection
