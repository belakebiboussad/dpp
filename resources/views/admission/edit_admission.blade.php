@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	 	$('document').ready(function(){
	    var dateRDV = $('#dateEntree').val();
	    var datefinRDV = 	$('#dateSortie').val();
	    var debut = new Date(dateRDV);
	    var fin = new Date(datefinRDV);
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
	  });
</script>
@endsection
@section('main-content')
<div class="page-header">
			<h1>
				Modifier Un RDV Hospitalisation pour <strong>&laquo;{{$demande->demandeHosp->consultation->patient->Nom}}
				 {{$demande->demandeHosp->consultation->patient->Prenom}}&raquo;</strong>
			</h1>
</div><!-- /.page-header -->
<div class="space-12"></div>
<div class="row">
  <div class="col-xs-12">
    <!-- {{ route('admission.update', $rdv->id) }} -->
    <form class="form-horizontal" id="RDVForm" role="form" method="POST" action="/admission/reporter/{{$rdv->id}}">
      {{ csrf_field() }}
      <!-- <input type="text" name="id_demande" value="{{$demande->id_demande}}" hidden> -->
      <input type="text" name="id" value="{{$rdv->id}}" hidden>
      <div class="page-header">
            <h1>informations concernant l'hospitalisation</h1>
      </div>
      <div class="space-12"></div>
      <div class="form-group row">
        <div class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="service">
            <strong>Service:</strong>
          </label>
          <div class="col-sm-9">
            <input type="text" id="service" name="service" placeholder="nom du service"
                   value="{{ $demande->demandeHosp->Service->nom }}" class="col-xs-10 col-sm-5" disabled/>
          </div>  
        </div>
          <div class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="motif">
            <strong>Specialite :</strong>
          </label>
          <div class="col-sm-9">
            <input type="text" id="motif" name="motifhos" value="{{$demande->demandeHosp->Specialite->nom}}"
                   class="col-xs-10 col-sm-5" disabled/>
          </div>  
        </div>
        <div class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="motif">
            <strong>Mode d'admission:</strong>
          </label>
          <div class="col-sm-9">
            <input  type="text" id="motif" name="motifhos" placeholder="Mode d'admission"
                    value="{{ $demande->modeAdmission }}" class="col-xs-10 col-sm-5" disabled/>
          </div>  
        </div>
      </div><!-- row -->
        <div class="space-12"></div>
      <div class="row form-group">
        <div class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="motif">
            <strong>Medecin Traitant:</strong>
          </label>
          <div class="col-sm-9">
            <input type="text" id="motif" name="motifhos" value="{{$demande->medecin->Nom_Employe}} {{$demande->medecin->Prenom_Employe}}"
                   class="col-xs-10 col-sm-5" disabled/>
          </div>  
        </div>
        <div class="col-xs-4">
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="priorite">
              <strong> Priorité :</strong>
            </label>
            <div class="control-group">
              &nbsp; &nbsp;
              <label>
                <input name="priorite" class="ace" type="radio" value="1" disabled @if($demande->ordre_priorite==1)checked="checked"@endif >
                    <span class="lbl"> 1 </span>
                  </label>&nbsp; &nbsp;
              <label>
                <input name="priorite" class="ace" type="radio" value="2" disabled @if($demande->ordre_priorite==2)checked="checked"@endif>
                  <span class="lbl"> 2 </span>
              </label>&nbsp; &nbsp;
              <label>
                <input name="priorite" class="ace" type="radio" value="3" disabled @if($demande->ordre_priorite==3)checked="checked"@endif>
                <span class="lbl"> 3 </span>
              </label>
            </div>
          </div>
        </div>
        <div class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="motif">
            <strong>observation :</strong>
          </label>
          <div class="col-sm-9">
            <input type="text" id="motif" name="motifhos" value="{{$demande->observation}}" class="col-xs-10 col-sm-5" disabled/>
          </div>  
        </div>
      </div><!-- row -->
      <div class="page-header">
        <h1>Admission</h1>
      </div>
      <div class="space-12"></div>
      <div class="row form-group">
        <div class="col-xs-4">
          <label class="col-sm-4 control-label no-padding-right" for="dateEntree">
            <strong> Date entrée prévue : 
            </strong>
          </label>
          <div class="col-sm-8">
              <input class="col-xs-5 col-sm-5 date-picker" id="dateEntree" name="dateEntree" type="text" 
                   value = "{{ $rdv->date_RDVh }}" data-date-format="yyyy-mm-dd" required/>
              <button class="btn btn-sm filelink" onclick="$('#dateEntree').focus()">
                <i class="fa fa-calendar"></i>
              </button>
          </div>
        </div>
        <div class="col-xs-4">
          <label class="col-sm-4 control-label no-padding-right" for="heure_rdvh" style="padding: 0.9%;">
              <strong> Heure entrée Prévue :</strong>
          </label>
          <div class="input-group col-sm-8" style ="width:35.8%;padding: 0.8%;">  
              <input id="heure_rdvh" name="heure_rdvh" class="form-control timepicker" type="text" 
                     value = "{{ $rdv->heure_RDVh }}" required />
              <span class="input-group-addon">
                <i class="fa fa-clock-o bigger-110"></i>
              </span>           
          </div>
        </div>
        <div id = "numberofDays" class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="">
            <strong> Durée Prévue :</strong>
          </label>
          <div class="col-sm-9">
            <input class="col-xs-5 col-sm-5" id="numberDays" name="" type="number" value="soustraction"
                   min="0" max="50" value="0" required />
            <label for=""><small><strong>&nbsp;nuit(s)</strong></small></label>
          </div>  
        </div>
      </div><!-- row -->
      <div class="space-12"></div>
      <div class="row form-group">
        <div class="col-xs-4">
          <label class="col-sm-4 control-label no-padding-right" for="dateSortie">
            <strong> Date sortie prévue :</strong>
          </label>
            <div class="col-sm-8">
              <input class="col-xs-5 col-sm-5 date-picker" id="dateSortie" name="dateSortie" type="text" 
                value = "{{ $rdv->date_Prevu_Sortie }}" data-date-format="yyyy-mm-dd" required disabled />
              <button class="btn btn-sm"  onclick="$('#dateSortie').focus()" disabled>
                <i class="fa fa-calendar"></i>
               </button>
            </div>
        </div>
        <div class="col-xs-4">
          <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right" for="heureSortiePrevue" style="padding: 0.9%;">
              <strong> Heure sortie Prévue :</strong>
            </label>
            <div class="input-group col-sm-8" style ="width:35.8%;padding: 0.8%;">  
              <input id="heureSortiePrevue" name="heureSortiePrevue" class="form-control timepicker" type="text"
                     value="{{ $rdv->heure_Prevu_Sortie }}" required>
              <span class="input-group-addon">
                <i class="fa fa-clock-o bigger-110"></i>
              </span>           
            </div>
          </div>
        </div>
      </div><!-- row -->
      <div class="space-12"></div>
      <div class="page-header">
        <h1>Hébergement</h1>
      </div>
      <div class="space-12"></div>
      @if(isset($rdv->admission->id_lit))
        <div class="row form group">
        <div class="col-xs-4">
            <label class="col-sm-4 control-label no-padding-right" for="dateSortie">
              <strong> Service :</strong>
            </label>
            <div class="col-sm-8">
              <select id="serviceh" name="serviceh" class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-9"
                      placeholder="selectionnez le service d'hospitalisation"/>
                   <option value="0" selected>selectionnez le service d'hospitalisation</option>
                  @foreach($services as $service)
                  <option value="{{ $service->id }}" @if($rdv->admission->lit->salle->service->id == $service->id) selected @endif>
                      {{ $service->nom }}
                  </option>
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
                <option value="0" selected>selectionnez la salle d'hospitalisation</option>      
                @foreach($rdv->admission->lit->salle->service->salles as $salle)
                <option value="{{ $salle->id }}" @if($rdv->admission->lit->salle->id == $salle->id) selected @endif >
                     {{ $salle->nom }}
                </option>
                @endforeach
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
                <option value="0" selected>selectionnez le lit d'hospitalisation</option>      
                @foreach($rdv->admission->lit->salle->lits as $lit)
                <option value="{{ $lit->id }}" @if($rdv->admission->lit->id == $lit->id) selected @endif >
                   {{ $lit->nom }}
                 </option>
                @endforeach
              </select>
            </div>  
        </div>
      </div><!-- ROW -->
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