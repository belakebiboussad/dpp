@extends('app')
@section('page-script')
<script type="text/javascript">
	$('document').ready(function(){
              var debut = new Date($('#dateEntree').val()); // var dateRDV = $('#dateEntree').val();  //var datefinRDV =   $('#dateSortie').val();
              var fin = new Date($('#dateSortiePre').val());
              var diff = new Date(fin - debut);
              $('#numberDays').val(diff/1000/60/60/24);
              $( "#RDVForm" ).submit(function( event ) {  
                       $("#dateSortiePre").prop('disabled', false);
               });
                $('.timepicker').timepicker({
                      timeFormat: 'HH:mm',
                      interval: 15,
                      minTime: '08',
                      maxTime: '17:00pm',
                      defaultTime: '09:00',   
                      startTime: '08:00',
                      dynamic: true,
                      dropdown: true,
                      scrollbar: true
               });  //$("input[type=number]").bind('keyup input', function(){//var datefin = new Date($('#dateEntree').val());//datefin.setDate(debut.getDate() + parseInt($( this).val(), 10));//$("#dateSortiePre").val(moment(datefin).format("YYYY-MM-DD"));// });
	});
</script>
@endsection
@section('main-content')
<div class="page-header">
  <h1 style="display: inline;">Modification du  RDV Hospitalisation du: <strong>&laquo;{{$demande->demandeHosp->consultation->patient->full_name}}&raquo;</strong></h1>
  <div class="pull-right">
    <a href="{{route('rdvHospi.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>liste des RDVs</a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
      <form class="form-horizontal" id="RDVForm" role="form" method="POST" action="{{ route('rdvHospi.update',$rdv->id) }}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <input type="hidden" name="id" id ="id" value="{{$rdv->id}}">
      <input type="hidden" class="demande_id" name="demande_id" value="{{ $demande->demandeHosp->id }}">
      <!-- <input type="hidden" id="affect" value="0"> -->
      <div class="row">
        <div class="col-sm-12"><h4 class="header smaller lighter blue">Informations concernant la demande d'hospitalisation</h4></div>
      </div>
      <div class="profile-user-info">
        <div class="row">
          <div class="col-sm-4 profile-info-row">
            <div class="profile-info-name col-sm-4">Service:</div><div class="profile-info-value col-sm-8"><span>{{ $demande->demandeHosp->Service->nom }}</span></div>
          </div>
          <div class="col-sm-4 profile-info-row">
            <div class="profile-info-name col-sm-4">Spécialité :</div><div class="profile-info-value col-sm-8"><span>{{ $demande->demandeHosp->Specialite->nom }}</span></div>
          </div>
           <div class="col-sm-4 profile-info-row">
            <div class="profile-info-name col-sm-4">Mode admission:</div><div class="profile-info-value col-sm-8">
                      <span class="badge badge-{{ ( $demande->demandeHosp->getModeAdmissionID( $demande->demandeHosp->modeAdmission) == 1)  ? 'success':'primary'  }}">
                                                                         {{ $demande->demandeHosp->modeAdmission }}</span>
            </div>
            </div>
          </div>  
        </div>
        <div class="row">
          <div class="col-sm-4 profile-info-row">
          <div class="profile-info-name col-sm-4">Médecin Traitant :</div><div class="profile-info-value col-sm-8"><span>{{$demande->medecin->full_name}}</span></div>
          </div>
          <div class="col-sm-4 profile-info-row">
          <div class="profile-info-name">Priorité :</div><div class="profile-info-value">
            <span class="label label-sm label-primary">{{ $demande->ordre_priorite }}</span>
          </div>
          </div>
          <div class="col-sm-4 profile-info-row">
          <div class="profile-info-name">Observation :</div><div class="profile-info-value"><span>{{$demande->observation}}</span></div>
          </div>
        </div>
      <div class="row"><div class="col-sm-12"> <h3 class="header smaller lighter blue">Admissions</h3></div></div>
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-6 control-label no-padding-right" for="dateEntree"><strong> Date entrée prévue :</strong></label>
            <div class="input-group col-sm-6 col-xs-6">
              <input id="dateEntree" name="dateEntree" class="form-control date-picker" type="text" value = "{{ $rdv->date }}" data-date-format="yyyy-mm-dd" required />
              <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>  
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-7 control-label no-padding-right no-wrap" for="heure"><strong> Heure entrée prévue :</strong> </label>
            <div class="input-group col-sm-5 col-xs-5">
              <input id="heure" name="heure" class="form-control timepicker1" type="text" value = "{{ $rdv->heure }}" required />
              <span class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></span> 
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-6 control-label no-padding-right" for=""><strong> Durée prévue :</strong> </label>
            <div class="col-sm-6 col-xs-6">    
              <input class="col-xs-8 col-sm-8" id="numberDays" name="numberDays" type="number" value="soustraction" min="0" max="50" value="0" required/>
              <label for=""><small><strong>&nbsp;nuit(s)</strong></small></label>
            </div>
          </div>
        </div>
      </div>
      <div class="space-12"></div>
      <div class="row">
        <div class="col-sm-12"> 
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-6 control-label no-padding-right" for="dateSortiePre"> <strong> Date sortie prévue :</strong>  </label>
            <div class="input-group col-sm-6 col-xs-6">
              <input class="form-control date-picker" id="dateSortiePre" name="dateSortiePre" type="text" value = "{{ $rdv->date_Prevu_Sortie }}" data-date-format="yyyy-mm-dd" required disabled />
              <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i> </span>    
            </div>  
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-7 control-label no-padding-right no-wrap" for="heureSortiePrevue"><strong> Heure sortie prévue :</strong></label>
            <div class="input-group col-sm-5 col-xs-5">
              <input id="heureSortiePrevue" name="heureSortiePrevue" class="form-control timepicker1" type="text" value = "{{ $rdv->heure_Prevu_Sortie }}" required />
              <span class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i> </span> 
            </div>  
          </div>
        </div>
      </div> 
      <div class="row"><div class="col-sm-12">  <h3 class="header smaller lighter blue">Hébergement</h3></div> </div>
      <div class="space-12"></div>
      @if(isset($rdv->bedReservation->id_lit))
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="dateSortie"> <strong> Service:</strong> </label>
            <div class="col-sm-8">
              <select name="serviceh" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12 serviceHosp"/>
                <option value="0" selected>Selectionnez le service d'hospitalisation</option>
                @foreach($services as $service)
                <option value="{{ $service->id }}" @if((isset($rdv->bedReservation->id_lit)) && ($rdv->bedReservation->lit->salle->service->id == $service->id)) selected @endif>
                  {{ $service->nom }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="salle"> <strong>Salle :</strong></label>
            <div class="col-sm-8">
              <select id="salle" name="salle" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12 salle">
                <option value="0" selected>Selectionnez la salle d'hospitalisation</option>      
                @foreach($rdv->bedReservation->lit->salle->service->salles as $salle)
                <option value="{{ $salle->id }}" @if($rdv->bedReservation->lit->salle->id == $salle->id) selected @endif >
                  {{ $salle->nom }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label" for="lit_id"> <strong>Lit :</strong></label>
            <div class="col-sm-8">
              <select id="lit_id" name="lit_id" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12">
                <option value="0" >Selectionnez le lit d'hospitalisation</option>
                <option value="{{ $rdv->bedReservation->id_lit }}" selected>{{ $rdv->bedReservation->lit->nom }} </option>
                @foreach($rdv->bedReservation->lit->salle->lits as $lit)
                  @if($lit->isFree(strtotime($rdv->date),strtotime($rdv->date_Prevu_Sortie))) 
                  <option value="{{ $lit->id }}">{{ $lit->nom }}</option>
                  @endif
                @endforeach
              </select>
            </div> 
          </div>
        </div>
      </div> 
      @else
      <div class="row form group">
        <div class="col-xs-4">
          <label class="col-sm-4 control-label no-padding-right" for="serviceh"><strong> Service :</strong></label>
          <div class="col-sm-8">
            <select  name="serviceh" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12 serviceHosp"/>
              <option value="" selected>Selectionnez le service d'hospitalisation</option>
              @foreach($services as $service)
              <option value="{{ $service->id }}">{{ $service->nom }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="salle"><strong> Salle :</strong></label>
             <div class="col-sm-8">
              <select name="salle" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12 salle" disabled>
                <option value="" selected>Selectionnez la salle d'hospitalisation</option>      
              </select>
            </div>
        </div>
        <div class="col-xs-4">
          <label class="col-sm-3 control-label" for="lit_id"><strong>Lit :</strong></label>
          <div class="col-sm-8">
            <select name="lit_id" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12 lit_id" disabled>
              <option value="" selected disabled>Selectionnez le lit d'hospitalisation</option>      
            </select>
          </div>  
        </div>
      </div><!-- ROW -->
      @endif
      <div class="space-12"></div> <div class="space-12"></div>  <div class="space-12"></div>
      <div class="row">
         <div class="col-xs-3"></div>
          <div class="col-xs-6 center bottom">
            <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
            <a href="/hospitalisation/listeRDVs" class="btn btn-warning" ><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</a>
          </div>
          <div class="col-xs-3"></div>
      </div>
    </form>
  </div>
</div>
@endsection