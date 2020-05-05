@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	 	$('document').ready(function(){
	    // var dateRDV = $('#dateEntree').val();  //var datefinRDV =   $('#dateSortie').val();
      var debut = new Date($('#dateEntree').val());
	    var fin = new Date($('#dateSortie').val());
	    var diff = new Date(fin - debut);
	    $('#numberDays').val(diff/1000/60/60/24);
      $( "#RDVForm" ).submit(function( event ) {  
  				$("#dateSortie").prop('disabled', false);
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
      });
      $("input[type=number]").bind('keyup input', function(){
        var datefin = new Date($('#dateEntree').val());
        datefin.setDate(debut.getDate() + parseInt($( this).val(), 10));
        $("#dateSortie").val(moment(datefin).format("YYYY-MM-DD"));
      });
	  });
</script>
@endsection
@section('main-content')<!-- <div class="page-header"></div> --><!-- /.page-header -->
<div class="page-header">
  <h1 style="display: inline;">modification du  RDV Hospitalisation du: <strong>&laquo;{{$demande->demandeHosp->consultation->patient->Nom}}
    {{$demande->demandeHosp->consultation->patient->Prenom}}&raquo;</strong></h1>
  <div class="pull-right">
    <a href="{{route('rdvHospi.index')}}" class="btn btn-white btn-info btn-bold">
      <i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>liste des RDVs
    </a>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <form class="form-horizontal" id="RDVForm" role="form" method="POST" action="/admission/reporter/{{$rdv->id}}"><!-- {{ route('admission.update', $rdv->id) }} -->
      {{ csrf_field() }}
      <input type="text" name="id" value="{{$rdv->id}}" hidden>  <!-- <input type="text" name="id_demande" value="{{$demande->id_demande}}" hidden> -->
      <div class="row">
        <div class="col-sm-12">
            <h3 class="header smaller lighter blue">informations concernant la demande d'hospitalisation</h3>
        </div>
      </div>
      <div class="space-12"></div>
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 col-xs-4 control-label no-padding-right" for="service">
              <strong>Service:</strong>
            </label>
            <div class="col-sm-8 col-xs-8">
               <input type="text" id="service" name="service" value="{{ $demande->demandeHosp->Service->nom }}" class="col-xs-12 col-sm-12" disabled/>
           </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="motif">
              <strong>Specialite :</strong>
            </label>
            <div class="col-sm-8 col-xs-8">
              <input type="text" id="motif" name="motifhos" value="{{ $demande->demandeHosp->Specialite->nom }}" class="col-xs-12 col-sm-12" disabled/>
            </div>  
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label no-padding-right no-wrap" for="motif">
              <strong>Mode admis.:</strong>
            </label>
            <div class="col-sm-8 col-xs-8">
               <input  type="text" id="motif" name="motifhos" value="{{ $demande->demandeHosp->modeAdmission }}" class="col-xs-12 col-sm-12" disabled/>
            </div>
          </div>
        </div>
      </div>
       <div class="space-12"></div>
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 col-xs-4 control-label no-padding-right no-wrap" for="motif">
               <strong>Medecin Trait.:</strong>
            </label>
            <div class="col-sm-8 col-xs-8">
              <input type="text" id="motif" name="motifhos" value="{{$demande->medecin->Nom_Employe}} {{$demande->medecin->Prenom_Employe}}" class="col-xs-12 col-sm-12" disabled/>
            </div>  
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 col-xs-4 control-label no-padding-right" for="priorite">
              <strong> Priorité : </strong>
            </label>
            <div class="col-sm-8 col-xs-8">
              <div class="control-group col-sm-12 col-xs-12">
                <label>
                  <input name="priorite1" class="ace" type="radio" value="1"  @if($demande->ordre_priorite ==1) checked ="checked" @else false @endif disabled >
                  <span class="lbl"> 1 </span>
                </label>&nbsp; &nbsp;
                <label>
                  <input name="priorite1" class="ace" type="radio" value="2"  @if($demande->ordre_priorite ==2) checked @endif disabled>
                  <span class="lbl"> 2 </span>
                </label>&nbsp; &nbsp;
                <label>
                  <input name="priorite1" class="ace" type="radio" value="3"  @if($demande->ordre_priorite==3) checked @endif disabled>
                  <span class="lbl"> 3 </span>
                </label>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 col-xs-4 control-label no-padding-right" for="motif">
              <strong>observation :</strong>
            </label>
            <div class="col-sm-8 col-xs-8">
               <input type="text" id="motif" name="motifhos" value="{{$demande->observation}}" class="col-xs-12 col-sm-12" disabled/>
            </div>
          </div>
        </div>
      </div>
      <div class="space-12"></div>
      <div class="row">
        <div class="col-sm-12">
          <h3 class="header smaller lighter blue">Admissions</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-6 control-label no-padding-right" for="dateEntree">
              <strong> Date entrée prévue :</strong>
            </label>
            <div class="input-group col-sm-6 col-xs-6">
              <div class="input-group col-sm-12">  
                <input id="dateEntree" name="dateEntree" class="form-control date-picker" type="text" value = "{{ $rdv->date_RDVh }}" required />
                <span class="input-group-addon">
                  <i class="fa fa-calendar bigger-110"></i>
                </span>           
              </div>         
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-7 control-label no-padding-right no-wrap" for="heure_rdvh">
              <strong> Heure entrée Prévue :</strong>
            </label>
            <div class="input-group col-sm-5 col-xs-5">
              <input id="heure_rdvh" name="heure_rdvh" class="form-control timepicker" type="text" value = "{{ $rdv->heure_RDVh }}" required />
              <span class="input-group-addon">
                <i class="fa fa-clock-o bigger-110"></i>
              </span>   
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-6 control-label no-padding-right" for="">
              <strong> Durée Prévue :</strong>
            </label>
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
            <label class="col-sm-6 control-label no-padding-right" for="dateSortie">
              <strong> Date sortie prévue :</strong>
            </label>
            <div class="input-group col-sm-6 col-xs-6">
              <input class="form-control date-picker" id="dateSortie" name="dateSortie" type="text" value = "{{ $rdv->date_Prevu_Sortie }}" data-date-format="yyyy-mm-dd" required disabled />
              <span class="input-group-addon">
                <i class="fa fa-calendar bigger-110"></i>
              </span>           
            </div>  
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-7 control-label no-padding-right no-wrap" for="heureSortiePrevue">
              <strong> Heure sortie Prévue :</strong>
            </label>
            <div class="input-group col-sm-5 col-xs-5">
              <input id="heureSortiePrevue" name="heureSortiePrevue" class="form-control timepicker" type="text" value = "{{ $rdv->heure_Prevu_Sortie }}" required />
              <span class="input-group-addon">
                <i class="fa fa-clock-o bigger-110"></i>
              </span>   
            </div>  
          </div>
        </div>
      </div> 
      <div class="row">
        <div class="col-sm-12">
            <h3 class="header smaller lighter blue">Hébergement</h3>
        </div>
      </div>
      <div class="space-12"></div>
      @if(isset($rdv->bedReservation->id_lit))
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="dateSortie">
              <strong> Service :</strong>
            </label>
            <div class="col-sm-8">
              <select id="serviceh" name="serviceh" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12"/>
                <option value="0" selected>selectionnez le service d'hospitalisation</option>
                @foreach($services as $service)
                <option value="{{ $service->id }}" @if((isset($rdv->bedReservation->id_lit)) && ($rdv->bedReservation->lit->salle->service->id == $service->id)) selected @endif>
                  {{ $service->nom }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="salle">
              <strong> Salle :</strong>
            </label>
            <div class="col-sm-8">
              <select id="salle" name="salle" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12">
                <option value="0" selected>selectionnez la salle d'hospitalisation</option>      
                @foreach($rdv->bedReservation->lit->salle->service->salles as $salle)
                <option value="{{ $salle->id }}" @if((isset($rdv->bedReservation->id_lit)) && ($rdv->bedReservation->lit->salle->id == $salle->id)) selected @endif >
                  {{ $salle->nom }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-4 col-xs-4">
            <label class="col-sm-4 control-label" for="lit">
              <strong>Lit :</strong>
            </label>
            <div class="col-sm-8">
              <select id="lit" name="lit" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12">
                <option value="0" selected>selectionnez le lit d'hospitalisation</option>      
                @foreach($rdv->bedReservation->lit->salle->lits as $lit)
                <option value="{{ $lit->id }}" @if((isset($rdv->bedReservation->id_lit)) && ($rdv->bedReservation->lit->id == $lit->id)) selected @endif >
                   {{ $lit->nom }}
                 </option>
                @endforeach
              </select>
            </div> 
          </div>
        </div>
      </div> 
    @else
      <div class="row form group">
        <div class="col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="dateSortie">
              <strong> Service :</strong>
            </label>
            <div class="col-sm-8">
              <select id="serviceh" name="serviceh" class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-9"
                      placeholder="selectionnez le service d'hospitalisation" required/>
                   <option value="" selected>selectionnez le service d'hospitalisation</option>
                  @foreach($services as $service)
                  <option value="{{ $service->id }}">{{ $service->nom }}</option>
                  @endforeach
              </select>
            </div>
        </div>
        <div class="col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="salle">
              <strong> Salle :</strong>
            </label>
            <div class="col-sm-8">
              <select id="salle" name="salle" data-placeholder="selectionnez la salle d'hospitalisation"
                      class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-9">
                <option value="" selected>selectionnez la salle d'hospitalisation</option>      
              </select>
            </div>
        </div>
        <div class="col-xs-4">
          <label class="col-sm-3 control-label" for="heure_rdvh">
            <strong>Lit : 
              </strong>
            </label>
            <div class="col-sm-8">
              <select id="lit" name="lit" data-placeholder="selectionnez le lit" 
                      class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-9">
                <option value="" selected>selectionnez le lit d'hospitalisation</option>      
              </select>
            </div>  
        </div>
      </div><!-- ROW -->
      @endif
      <div class="space-12"></div>
      <div class="space-12"></div>
      <div class="space-12"></div>
      <div class="row">
          <div class="col-xs-3"></div>
          <div class="col-xs-6 center bottom">
            <button class="btn btn-info" type="submit">
              <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
            </button>
          <!--  &nbsp; &nbsp; &nbsp;
            <button class="btn" type="reset">
              <i class="ace-icon fa fa-undo bigger-110"></i>Annuler
            </button> -->
            <a href="/hospitalisation/listeRDVs" class="btn btn-warning" >
                <i class="ace-icon fa fa-undo bigger-110"></i>Annuler
            </a>
          </div>
          <div class="col-xs-3"></div>
      </div>
    </form>
  </div>
</div>
@endsection