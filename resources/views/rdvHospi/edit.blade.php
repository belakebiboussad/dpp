@extends('app')
@section('page-script')
<script type="text/javascript">
	$('document').ready(function(){
    var debut = new Date($('#dateEntree').val());//var dateRDV = $('#dateEntree').val();//var datefinRDV =$('#dateSortie').val();
    var fin = new Date($('#dateSortiePre').val());
    var diff = new Date(fin - debut);
    $('#numberDays').val(diff/1000/60/60/24);
    $( "#RDVForm" ).submit(function( event ) {  
      $("#dateSortiePre").prop('disabled', false);
    }); //$("input[type=number]").bind('keyup input', function(){//var datefin = new Date($('#dateEntree').val());//datefin.setDate(debut.getDate() + parseInt($( this).val(), 10));//$("#dateSortiePre").val(moment(datefin).format("YYYY-MM-DD"));// });
    $(".numberDays").on('click keyup', function() {
      if( ! isEmpty($('.serviceHosp').val()))
        $(".serviceHosp").prop("selectedIndex", 0).change();
      addDays();
    });
    $(".date").change(function(){
      if( ! isEmpty($('.serviceHosp').val()))
        $(".serviceHosp").prop("selectedIndex", 0).change();
      $('.numberDays').val(0);
      addDays();
    });
	});
</script>
@endsection
@section('main-content')
<div class="page-header">
  <h1>Modification du  Rendez-vous d'hospitalisation du :
    &laquo;{{ $rdv->demandeHospitalisation->consultation->patient->full_name }}&raquo;</h1>
  <div class="pull-right">
    <a href="/listeRDVs" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>liste des RDVs</a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
      <form class="form-horizontal" id="RDVForm" role="form" method="POST" action="{{ route('rdvHospi.update',$rdv->id) }}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <input type="hidden" name="id" id ="id" value="{{$rdv->id}}">
      <input type="hidden" name="demande_id" class="demande_id" value="{{ $rdv->demandeHospitalisation->id }}">
      <input type="hidden" class ="affect" value="0">
      <h4 class="header lighter block blue">Informations concernant la demande d'hospitalisation</h4>
      <div class="profile-user-info">
        <div class="row">
          <div class="col-sm-4 profile-info-row">
            <div class="profile-info-name col-sm-4">Service:</div>
            <div class="profile-info-value col-sm-8"><span>{{ $rdv->demandeHospitalisation->Service->nom }}</span></div>
          </div>
          <div class="col-sm-4 profile-info-row">
            <div class="profile-info-name col-sm-4">Spécialité :</div>
            <div class="profile-info-value col-sm-8"><span>{{ $rdv->demandeHospitalisation->Specialite->nom }}</span></div>
          </div>
           <div class="col-sm-4 profile-info-row">
            <div class="profile-info-name col-sm-4">Mode admission:</div><div class="profile-info-value col-sm-8">
              <span class="badge badge-{{ ( $rdv->demandeHospitalisation->getModeAdmissionID( $rdv->demandeHospitalisation->modeAdmission) == 1)  ? 'success':'primary'  }}">
                  {{ $rdv->demandeHospitalisation->modeAdmission }}</span>
            </div>
            </div>
          </div>  
        </div>
        <div class="row">
          <div class="col-sm-4 profile-info-row">
          <div class="profile-info-name col-sm-4">Médecin Traitant :</div>
          <div class="profile-info-value col-sm-8">
            <span>{{ isset($specialite->dhValid, $rdv->demandeHospitalisation->DemeandeColloque) ? $rdv->demandeHospitalisation->DemeandeColloque->medecin->full_nam: $rdv->demandeHospitalisation->consultation->medecin->full_name}}</span>
          </div>
          </div>
          @isset($specialite->dhValid,$rdv->demandeHospitalisation->DemeandeColloque)
            <div class="col-sm-4 profile-info-row">
            <div class="profile-info-name">Priorité :</div><div class="profile-info-value">
            <span class="label label-sm label-primary">
              {{ $rdv->demandeHospitalisation->DemeandeColloque->ordre_priorite }}</span>
            </div>
          </div>
          <div class="col-sm-4 profile-info-row">
           <div class="profile-info-name">Observation :</div><div class="profile-info-value"><span>{{$rdv->demandeHospitalisation->DemeandeColloque->observation}}</span></div>
          </div>
         @endisset
        </div>
      <h4 class="header lighter block blue">Admissions</h4>
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-6 control-label" for="dateEntree">Date entrée prévue :</label>
            <div class="input-group col-sm-6 col-xs-6">
              <input id="dateEntree" name="dateEntree" class="form-control date-picker date" type="text" value = "{{ $rdv->date }}" data-date-format="yyyy-mm-dd" required />
              <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>  
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-7 control-label" for="heure">Heure entrée prévue :</label>
            <div class="input-group col-sm-5 col-xs-5">
              <input id="heure" name="heure" class="form-control timepicker1" type="text" value = "{{ $rdv->heure }}" required />
              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-6 control-label" for="numberDays">Durée prévue :</label>
            <div class="col-sm-6 col-xs-6">    
              <input class="col-xs-8 col-sm-8 numberDays" id="numberDays" name="numberDays" type="number" value="soustraction" min="0" max="50" value="0" required/>
              <label for=""><small><strong>&nbsp;nuit(s)</strong></small></label>
            </div>
          </div>
        </div>
      </div><div class="space-12"></div>
      <div class="row">
        <div class="col-sm-12"> 
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-6 control-label" for="dateSortiePre">Date sortie prévue :</label>
            <div class="input-group col-sm-6 col-xs-6">
              <input class="form-control date-picker date_end" id="dateSortiePre" name="dateSortiePre" type="text" value = "{{ $rdv->date_Prevu_Sortie }}" data-date-format="yyyy-mm-dd" required disabled />
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>    
            </div>  
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-7 control-label" for="heureSortiePrevue">Heure sortie prévue :</label>
            <div class="input-group col-sm-5 col-xs-5">
              <input id="heureSortiePrevue" name="heureSortiePrevue" class="form-control timepicker1" type="text" value = "{{ $rdv->heure_Prevu_Sortie }}" required />
              <span class="input-group-addon"><i class="fa fa-clock-o"></i> </span> 
            </div>  
          </div>
        </div>
      </div> 
      <h4 class="header lighter block blue">Hébergement</h4>
      <div class="space-12"></div>
      @if(isset($rdv->bedReservation->id_lit))
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label" for="dateSortie">Service :</label>
            <div class="col-sm-8">
              <select name="serviceh" class="selectpicker col-xs-12 serviceHosp"/>
                <option value="" selected>Selectionnez le service</option>
                @foreach($services as $service)
                <option value="{{ $service->id }}" @if((isset($rdv->bedReservation->id_lit)) && ($rdv->bedReservation->lit->salle->service->id == $service->id)) selected @endif>
                  {{ $service->nom }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label" for="salle">Salle :</label>
            <div class="col-sm-8">
              <select name="salle" class="selectpicker col-xs-12 salle">
                <option value="" selected disabled>Selectionnez la salle</option>      
                @foreach($rdv->bedReservation->lit->salle->service->salles as $salle)
                <option value="{{ $salle->id }}" @if($rdv->bedReservation->lit->salle->id == $salle->id) selected @endif >
                  {{ $salle->nom }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label" for="lit_id">Lit :</label>
            <div class="col-sm-8">
              <select name="lit_id" class="selectpicker lit_id col-xs-12">
                <option value="" disabled>Selectionnez le lit</option>
                <option value="{{ $rdv->bedReservation->id_lit }}" selected>{{ $rdv->bedReservation->lit->nom }} </option>
                @foreach($rdv->bedReservation->lit->salle->lits as $lit)
                  {{-- @if($lit->isFree(strtotime($rdv->date),strtotime($rdv->date_Prevu_Sortie)))  --}} {{-- @endif --}}
                  <option value="{{ $lit->id }}">{{ $lit->nom }}</option>
                @endforeach
              </select>
            </div> 
          </div>
        </div>
      </div> 
      @else
      <div class="row form-group">
        <div class="col-xs-4">
          <label class="col-sm-4 control-label no-padding-right" for="serviceh">Service :</label>
          <div class="col-sm-8">
            <select  name="serviceh" class="selectpicker col-xs-12 serviceHosp"/>
              <option value="" selected>Selectionnez le service</option>
              @foreach($services as $service)
              <option value="{{ $service->id }}">{{ $service->nom }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="salle"><strong> Salle :</strong></label>
             <div class="col-sm-8">
              <select name="salle" class="selectpicker col-xs-12 salle" disabled>
                <option value="" selected disabled>Selectionnez la salle</option>      
              </select>
            </div>
        </div>
        <div class="col-xs-4">
          <label class="col-sm-4 control-label" for="lit_id"><strong>Lit :</strong></label>
          <div class="col-sm-8">
            <select name="lit_id" class="selectpicker col-xs-12 lit_id" disabled>
              <option value="" selected>Selectionnez le lit</option>      
            </select>
          </div>
        </div>
      </div><!-- ROW -->
      @endif
      <div class="space-12"></div><div class="hr hr-dotted"></div>
      <div class="row">
        <div class="center bottom">
          <button class="btn btn-info btn-xs" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
          <a href="/listeRDVs" class="btn btn-xs btn-warning" ><i class="ace-icon fa fa-undo"></i>Annuler</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection