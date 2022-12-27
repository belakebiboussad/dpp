@extends('app')
@section('page-script')
<script type="text/javascript">
  var nowDate = new Date();
  var dEntree = $('.date').datepicker('getDate'); 
  $(function(){  
    $('.filelink' ).click( function( e ) { e.preventDefault(); });
    updateDureePrevue();
    $('.numberDays').on('click keyup', function() {
      addDays();
    });
    $(".date_end").change(function(){
      updateDureePrevue();
    })  
  });

</script>
@endsection
@section('main-content')
 <?php $patient = $hosp->patient;?>
<div class="row"> @include('patient._patientInfo')</div>
<div class="pull-right">
  <a href="{{route('hospitalisation.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Hospitalisations</a>
</div>
<div class="row"><h4>Modifier l'hospitalisation</h4></div>
<h4 class="header lighter block blue">Admission</h4>
<div class="profile-user-info">
  <div class="row">
    <div class="col-sm-3 profile-info-row">
      <div class="profile-info-name col-sm-6">Service :</div><div class="profile-info-value col-sm-6"><span>{{ $hosp->admission->demandeHospitalisation->Service->nom }}</span></div>
    </div>
    <div class="col-sm-3 profile-info-row">
      <div class="profile-info-name col-sm-6">Spécialité :</div><div class="profile-info-value col-sm-6"><span>{{ $hosp->admission->demandeHospitalisation->Specialite->nom }}</span></div>
    </div>
     <div class="col-sm-3 profile-info-row">
      <div class="profile-info-name col-sm-6 no-padding-right">Mode admission:</div><div class="profile-info-value col-sm-6">
        <span class="badge badge-{{($hosp->admission->demandeHospitalisation->getModeAdmissionID($hosp->admission->demandeHospitalisation->modeAdmission) ==  2)  ? 'warning':'primary' }}">{{ $hosp->admission->demandeHospitalisation->modeAdmission }}</span>
      </div>
    </div>  
  </div>
  @isset($hosp->admission->demandeHospitalisation->Specialite->dhValid)
  <div class="row">
    <div class="col-sm-3 profile-info-row">
      <div class="profile-info-name col-sm-4">Priorité :</div><div class="profile-info-value col-sm-6">
        <span class="badge badge-{{ ($hosp->admission->demandeHospitalisation->DemeandeColloque->ordre_priorite == 3)  ? 'warning':'primary'  }}">
         {{ isset($hosp->admission->demandeHospitalisation->DemeandeColloque) ? $hosp->admission->demandeHospitalisation->DemeandeColloque->ordre_priorite : '' }}
        </span>
      </div>
    </div>
    <div class="col-sm-9 profile-info-row">
      <div class="profile-info-name col-sm-6">Observation :</div><div class="profile-info-value col-sm-6"><span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->observation }}</span></div>
    </div>
  </div>
  @endisset
</div> 
@endsection