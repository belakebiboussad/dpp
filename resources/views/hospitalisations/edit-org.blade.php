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
<div class="row">
  <div class="col-xs-12">
	  <form class="form-horizontal" role="form" method="POST" action="{{ route('hospitalisation.update',$hosp->id)}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <input type="text" name="id" value="{{$hosp->id}}" hidden>
      <h4 class="header lighter block blue">Entrée</h4>
      <div class="row">
        <div class="form-group col-xs-4">
        	<label class="col-sm-4 control-label" for="date">Date :</label>
          <div class="col-sm-8">
            <input class="col-xs-12 col-sm-12 date-picker date" type="text" value = "{{ $hosp->date }}" data-date-format="yyyy-mm-dd" readonly="true" disabled />
          </div> 
      	</div>
	      <div class="form-group col-xs-4">
          <label class="col-sm-4 control-label" for="heure_entrée">Heure :</label>
          <div class="col-sm-8">   
             <input id="heurEnt" class="col-xs-12 col-sm-12 timepicker1" type="text" value = "{{ $hosp->heure_entrée }}" disabled/>
	        </div>
      	</div>
      	<div id = "numberofDays" class="form-group col-xs-4">
        	<label class="col-sm-4 control-label">Durée :</label>
         	<div class="col-sm-8">
	          <input class="col-xs-10 col-sm-10 numberDays" type="number"  min="0" max="50" value="0" @if(in_array(Auth::user()->role->id,[5])) disabled @endif/>
	           <label for=""><small>&nbsp;nuit(s)</small></label>
	        </div>  
      	</div>
        </div> <!-- row -->
        <div class="row"> <div class="col-sm-12"><h4 class="header  lighter blue">Sortie prévue</h4></div></div>
     	  <div class="row">
                <div class="form-group col-xs-4">
        	          <label class="col-sm-4 control-label" for="Date_Prevu_Sortie">Date :</label>
        	          <div class="col-sm-8">
        	            <input class="col-xs-10 col-sm-10 date-picker date_end" name="Date_Prevu_Sortie" type="text" value = "{{ $hosp->Date_Prevu_Sortie }}" data-date-format="yyyy-mm-dd" @if(in_array(Auth::user()->role->id,[5])) disabled @endif required/>
        	            <button class="btn btn-sm filelink" onclick="$('.date_end').focus();"><i class="fa fa-calendar"></i></button>            
        	          </div>
	        </div>
		<div class="form-group col-xs-4">
      		        <label class="col-sm-4 control-label" for="Heure_Prevu_Sortie">Heure :</label>
      		        <div class="col-sm-8">   
      		               <input id="heureSortiePrevue" name="Heure_Prevu_Sortie" class="col-xs-10 col-sm-10 timepicker1" type="text" value = "{{ $hosp->Heure_Prevu_Sortie }}" @if(in_array(Auth::user()->role->id,[5])) disabled @endif/>
      			      	<button class="btn btn-sm filelink" onclick="$('#heureSortiePrevue').focus()"><i class="fa fa-clock-o bigger-110"></i></button>	
      			</div>
    	       </div>
        </div>
        <div class="row"><div class="col-sm-12"><h4 class="header  lighter blue">Hospitalisation</h4></div></div>
        <div class="row">
          <div class="form-group col-xs-4">
            <label class="col-sm-5 control-label" for="mode">Mode d'hospitalisation :</label>
            <div class="col-sm-7">
              <select  name="modeHosp_id" class="col-xs-12 col-sm-12" required>
                     <option value="">Selectionnez...</option>
                    @foreach($modesHosp as $mode)
                      <option value="{{ $mode->id }}" @if($hosp->modeHosp_id == $mode->id) selected @endif>{{ $mode->nom}}</option>
                    @endforeach
              </select>
            </div>
          </div>
              <div class="form-group col-xs-4">
                      <label class="col-sm-5 control-label" for="medecin_id">Médecin traitant  :</label>
                      <div class="input-group col-sm-7">
                              <select name="medecin_id" id="medecin_id" class="col-sm-12" @if(!in_array(Auth::user()->role->id,[1,13])) disabled @endif>
                                    <option value="" disabled>Selectionnez...</option>
                                    @foreach( $employes as $empl)
                                    <option value="{{$empl->id}}" @if($empl->id == $hosp->admission->demandeHospitalisation->consultation->medecin->id ) selected @endif>{{$empl->full_name}}</option>
                                      @endforeach
                              </select> 
                     </div>
              </div>
               @if($hosp->patient->hommesConf->count() > 0)
               <div class="form-group col-xs-4">
                      <label class="col-sm-5 control-label" for="garde_id">Garde malade :</label>
                      <div class="input-group col-sm-7">
                        <select name="garde_id" id="garde_id" class="col-sm-12">{{-- @if(Auth::user()->role->id != 5) disabled @endif  --}}
                             <option value="" >Selectionnez le garde malade</option>
                             @foreach( $hosp->patient->hommesConf as $homme)
                              <option value="{{ $homme->id }}" @if($hosp->garde_id ==  $homme->id) selected @endif> {{ $homme->full_name }}</option>
                              @endforeach
                        </select>
                      </div>
               </div>
               @endif
        </div>
        {{-- @if((Auth::user()->role_id == 5))     --}}
        <div class="row">
          <div class="col-sm-12"><h4 class="header  lighter blue">Hébergement</h4></div>
        </div>
        <div class="row form group">
	     <div class="col-xs-4">
	        <label class="col-sm-4 control-label" for="serviceh">Service :</label>
	        <div class="col-sm-8">
	      		<select name="serviceh" class="selectpicker col-xs-12 col-sm-12 serviceHosp" {{ (Auth::user()->role_id != 5) ? 'disabled':''  }}/>
	            <option value="" selected disabled>Selectionnez le service</option>
	            @foreach($services as $service)
	            <option value="{{ $service->id }}" @if($hosp->admission->demandeHospitalisation->bedAffectation->Lit->salle->service->id == $service->id) selected @endif>
	              {{ $service->nom }}
	           </option>
	            @endforeach
	          </select>
	        </div>
	      </div>
	      <div class="col-xs-4">
          <label class="col-sm-4 control-label" for="salle">Salle :</label>
          <div class="col-sm-8">
            <select id="salle" name="salle" class="selectpicker col-xs-12 col-sm-12" {{ (Auth::user()->role_id != 5) ? 'disabled':''  }}>
              <option value="" selected disabled>Selectionnez la salle</option>      
              @foreach($hosp->admission->lit->salle->service->salles as $salle)
              <option value="{{ $salle->id }}" @if($hosp->admission->lit->salle->id == $salle->id) selected @endif >{{ $salle->nom }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-xs-4">
          <label class="col-sm-4 control-label" for="lit">Lit :</label>
          <div class="col-sm-8">
            <select id="lit" name="lit" class="selectpicker col-xs-12 col-sm-12" {{ (Auth::user()->role_id != 5) ? 'disabled':''  }}>
              <option value="" selected disabled>Selectionnez le lit</option>      
              @foreach($hosp->admission->lit->salle->lits as $lit)
              <option value="{{ $lit->id }}" @if($hosp->admission->lit->id == $lit->id) selected @endif >{{ $lit->nom }} </option>
               @endforeach
            </select>
          </div>  
        </div>
      </div><div class="hr hr-dotted"></div>
      <div class="row">
        <div class="col-xs-12 center">
          <button class="btn btn-info btn-xs" type="submit"> <i class="ace-icon fa fa-save"></i>Enregistrer</button>
          &nbsp;<button class="btn btn-warning btn-xs" type="reset"> <i class="ace-icon fa fa-undo"></i>Annuler</button>
        </div>
      </div>
    </form>
	</div>
</div>
@endsection