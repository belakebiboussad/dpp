@extends('app')
@section('page-script')
<script type="text/javascript">
  var nowDate = new Date();
  var dEntree = $('.date').datepicker('getDate'); 
  $(function(){// $('.filelink' ).click( function( e ) { e.preventDefault(); });
    updateDureePrevue();
    $('.numberDays').on('click keyup', function() {
      addDays();
    });
    $(".date_end").change(function(){
      updateDureePrevue();
    })  
  });
</script>
@stop
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
  <div class="row">
    <div class="col-xs-12">
      <form role="form" method="POST" action="{{ route('hospitalisation.update',$hosp->id)}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="id" value="{{$hosp->id}}" >
        <input type="hidden" class="affect" value="1">
<input type="hidden" class="demande_id" value="{{ $hosp->admission->demandeHospitalisation->id }}">
        <h4 class="header lighter block blue">Entrée</h4>
        <div class="row">
          <div class="form-group col-xs-4">
            <label class="col-sm-4 control-label" for="date">Date :</label>
            <div class="input-group col-sm-8">
              <input class="form-control date" type="text" value = "{{ $hosp->date->format('Y-m-d') }}" data-date-format="yyyy-mm-dd" readonly disabled/>
               <span class="input-group-btn"><button class="btn btn-sm disabled" type="button"><i class="ace-icon fa fa-calendar bigger-110"></i></button></span>
            </div> 
          </div>
          <div class="form-group col-xs-4">
            <label class="col-sm-4 control-label" for="HeurEnt">Heure :</label>
            <div class="input-group col-sm-8">   
               <input id="heurEnt" class="form-control timepicker1" type="text" value = "{{ $hosp->HeurEnt }}" disabled/> <span class="input-group-addon fa fa-clock-o"></span> 
            </div>
          </div>
          <div id = "numberofDays" class="form-group col-xs-4">
            <label class="col-sm-4 control-label">Durée :</label>
            <div class="input-group col-sm-8">
              <input class="form-control numberDays input-sm" type="number"  min="0" max="50" value="0" @if(Auth::user()->is(5)) disabled @endif/>
              <span class="input-group-addon"><small>nuit(s)</small></span>
            </div>  
          </div>
        </div> <h4 class="header lighter block blue">Sortie prévue</h4>
        <div class="row">
          <div class="form-group col-xs-4">
            <label class="col-sm-4 control-label" for="Date_Prevu_Sortie">Date :</label>
            <div class="input-group">
<input class="form-control date_end" type="text" name="Date_Prevu_Sortie" value ="{{ $hosp->Date_Prevu_Sortie->format('Y-m-d') }}" data-date-format="yyyy-mm-dd" @if(Auth::user()->is(5)) disabled @endif required/>
              <span class="input-group-btn"><button class="btn btn-sm" type="button" onclick="$('.date_end').focus();">
                <i class="ace-icon fa fa-calendar bigger-110"></i></button>
              </span>
            </div>
          </div>
          <div class="form-group col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label" for="heure">Heure :</label>
            <div class="input-group col-sm-8 col-xs-8">
              <input id="heureSortiePrevue" name="Heure_Prevu_Sortie" class="form-control timepicker1" type="text" value = "{{ $hosp->Heure_Prevu_Sortie }}" @if(Auth::user()->is(5)) disabled @endif />
              <span class="input-group-addon fa fa-clock-o"></span> 
            </div>
           {{-- <button class="btn btn-sm filelink" onclick="$('#heureSortiePrevue').focus()"><i class="fa fa-clock-o bigger-110"></i></button>  --}}
          </div>
        </div>
        <h4 class="header lighter block blue">Hospitalisation</h4>
        <div class="row">
          <div class="form-group col-xs-4">
            <label class="col-sm-4 control-label" for="modeHosp_id">Mode:</label>
            <div class="col-sm-8">
              @can('update-hosp')
              <select  name="modeHosp_id" class="form-control" required>
                     <option value="">Selectionnez...</option>
                    @foreach($modesHosp as $mode)
                      <option value="{{ $mode->id }}" @if($hosp->modeHosp_id == $mode->id) selected @endif>{{ $mode->nom}}</option>
                    @endforeach
              </select>
              @else
              <input type="text" class="form-control" readonly value="{{ $hosp->modeHospi->nom }}"/>
              @endcan
            </div>
          </div>
          <div class="form-group col-xs-4">
            <label class="col-sm-5 control-label" for="medecin_id">Médecin traitant  :</label>
            <div class="input-group col-sm-7">
              @can('update-hosp')
              <select name="medecin_id" id="medecin_id" class="form-control">
                <option value="" disabled>Selectionnez...</option>
                @foreach( $employes as $empl)
                <option value="{{$empl->id}}" @if($empl->id == $hosp->admission->demandeHospitalisation->consultation->medecin->id ) selected @endif>{{$empl->full_name}}</option>
                  @endforeach
              </select> 
              @else
              <input type="text" class="form-control" readonly value="{{ $hosp->medecin->full_name }}"/>
              @endcan
           </div>
          </div>
           @if($hosp->patient->hommesConf->count() > 0)
           <div class="form-group col-xs-4">
            <label class="col-sm-5 control-label" for="garde_id">Garde malade :</label>
            <div class="input-group col-sm-7">
              <select name="garde_id" id="garde_id" class="col-sm-12">
                   <option value="" >Selectionnez le garde malade</option>
                   @foreach( $hosp->patient->hommesConf as $homme)
                    <option value="{{ $homme->id }}" @if($hosp->garde_id ==  $homme->id) selected @endif> {{ $homme->full_name }}</option>
                    @endforeach
              </select>
            </div>
           </div>
           @endif
        </div><h4 class="header lighter block blue">Hébergement</h4>
        <div class="row">
          <div class="form-group col-xs-4">
            <label class="col-sm-4 control-label" for="serviceh">Service :</label>
            <div class="col-sm-8">
              <select name="serviceh" class="selectpicker form-control serviceHosp" {{ !(Auth::user()->is(5)) ? 'disabled':''  }}/>
                <option value="" selected disabled>Selectionnez le service</option>
                @foreach($services as $service)
                <option value="{{ $service->id }}" @if($hosp->admission->demandeHospitalisation->bedAffectation->Lit->salle->service->id == $service->id) selected @endif>
                {{ $service->nom }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-xs-4">
            <label class="col-sm-4 control-label" for="salle">Salle :</label>
            <div class="col-sm-8">
              @can('update-bedAffectation')
              <select id="salle" name="salle" class="selectpicker form-control salle">
                <option value="" disabled>Selectionnez la salle</option>      
                @foreach($hosp->admission->demandeHospitalisation->bedAffectation->Lit->salle->service->salles as $salle)
                <option value="{{ $salle->id }}" @if($hosp->admission->demandeHospitalisation->bedAffectation->Lit->salle_id == $salle->id) selected @endif>{{ $salle->nom }}</option>
                @endforeach
              </select>
              @else
              <input type="text" class="form-control" readonly value="{{ $hosp->admission->demandeHospitalisation->bedAffectation->Lit->salle->nom }}"/>
              @endcan
            </div>
          </div>
          <div class="form-group col-xs-4">
            <label class="col-sm-4 control-label" for="lit">Lit :</label>
            <div class="col-sm-8">
              @can('update-bedAffectation')
              <select id="lit" name="lit" class="form-control selectpicker lit_id">
                <option value="" disabled>Selectionnez le lit</option>
                @foreach($hosp->admission->demandeHospitalisation->bedAffectation->Lit->salle->lits as $lit)
                <option value="{{ $lit->id }}" @if($hosp->admission->demandeHospitalisation->bedAffectation->lit_id == $lit->id) selected @endif>{{ $lit->nom }} </option>
                @endforeach
              </select>
              @else
              <input type="text" class="form-control" readonly value="{{ $hosp->admission->demandeHospitalisation->bedAffectation->Lit->nom }}"/>
              @endcan
            </div>
          </div>
        </div><div class="hr hr-dotted"></div>
        <div class="row">
          <div class="col-xs-12 center">
          <button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
          <button class="btn btn-xs btn-warning" type="reset"> <i class="ace-icon fa fa-undo"></i>Annuler</button>
        </div>
      </div>
      </form>
    </div>
</div>
</div> 
@stop