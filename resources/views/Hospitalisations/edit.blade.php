@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	var nowDate = new Date();
  //var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
  //var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
 	//alert(tomorrow);
 	var dEntree = $('#dateEntree').datepicker('getDate'); 
  $('#dateSortie').datepicker({
    startDate:dEntree ,
    minDate: 1, 
	});
 	$('document').ready(function(){
    $('#dateSortie').attr('readonly', true);
		$('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 15,
            minTime: '08',
            maxTime: '17:00pm',  // defaultTime: '09:00',  
            startTime: '08:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
    });
	 	$( "#RDVForm" ).submit(function( event ) {  
  			$("#dateSortie").prop('disabled', false);
  	});
  	$('.filelink' ).click( function( e ) {
                e.preventDefault();  
    });
  	updateDureePrevue();
  	$('#numberDays').on('click keyup', function() {
      var jsDate = $('#dateEntree').datepicker('getDate');
    	jsDate.setDate(jsDate.getDate() + parseInt($('#numberDays').val()));
    	var dateEnd = jsDate.getFullYear() + '-' + (jsDate.getMonth()+1) + '-' + jsDate.getDate();
    	$("#dateSortiePre").datepicker("setDate", dateEnd);    
    });  
	});
	function updateDureePrevue()
	{
		if($("#dateEntree").val() != undefined) {
 				var dEntree = $('#dateEntree').datepicker('getDate');
     		var dSortie = $('#dateSortiePre').datepicker('getDate');
  			var iSecondsDelta = dSortie - dEntree;
  			var iDaysDelta = iSecondsDelta / (24 * 60 * 60 * 1000);
  			if(iDaysDelta < 0)
  			{
  				iDaysDelta = 0;
  				$("#dateSortiePre").datepicker("setDate", dEntree); 
  			}
  			$('#numberDays').val(iDaysDelta );	
		}
			
	}
</script>
@endsection
@section('main-content')
<div class="page-header">
   <?php $patient = $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient; ?>
   @include('patient._patientInfo', $patient)
</div><!-- /.page-header -->
<!-- <div class="space-12"></div> -->
<div class="row">
  <div class="col-xs-12">
	  <form class="form-horizontal" id="editHosp" role="form" method="POST" action="{{ route('hospitalisation.update',$hosp->id)}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <input type="text" name="id" value="{{$hosp->id}}" hidden>
      <div class="page-header">
            <h2>Modifier l'hospitalisation</h2>
      </div>
      <div class="space-12"></div>
      <div class="row form-group ">
        <div class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="service">
            <strong>Service :</strong>
          </label>
          <div class="col-sm-9">
            <input type="text" id="service" name="service" placeholder="nom du service"
              value="{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->nom }}" class="col-xs-10 col-sm-5" readonly/>
          </div>  
        </div>
        <div class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="motif">
            <strong>Specialite :</strong>
          </label>
          <div class="col-sm-9">
            <input type="text" id="motif" name="motifhos" value="{{ $hosp->admission->rdvHosp->demandeHospitalisation->Specialite->nom }}"
                   class="col-xs-10 col-sm-5" readonly/>
          </div>  
        </div>
        <div class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="motif">
            <strong>Mode d'admission:</strong>
          </label>
          <div class="col-sm-9">
            <input  type="text" id="motif" name="motifhos" placeholder="Mode d'admission"
                    value="{{ $hosp->admission->rdvHosp->demandeHospitalisation->modeAdmission }}" class="col-xs-10 col-sm-5" readonly/>
          </div>  
        </div>
      </div>
			<div class="space-12"></div>
      <div class="row form-group">
      	<div class="col-xs-4">
          <label class="col-sm-3 control-label no-padding-right" for="motif">
            <strong>Medecin Traitant:</strong>
          </label>
          <div class="col-sm-9">
            <input type="text" id="motif" name="motifhos" value="{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->Nom_Employe }} {{$hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->Prenom_Employe}}" class="col-xs-10 col-sm-5" readonly/>
          </div>  
        </div>
        <div class="col-xs-4">
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="priorite">
              <strong> Priorité :</strong>
            </label>
            <div class="control-group col-sm-9">
              &nbsp; &nbsp;
              <label>
                <input name="priorite" class="ace" type="radio" value="1" disabled @if( $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->ordre_priorite==1)checked="checked"@endif >
                    <span class="lbl"> 1 </span>
                  </label>&nbsp; &nbsp;
              <label>
                <input name="priorite" class="ace" type="radio" value="2" disabled @if( $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->ordre_priorite==2)checked="checked"@endif>
                  <span class="lbl"> 2 </span>
              </label>&nbsp; &nbsp;
              <label>
                <input name="priorite" class="ace" type="radio" value="3" disabled @if( $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->ordre_priorite==3 )checked="checked"@endif>
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
            <input type="text" id="motif" name="motifhos" value="{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->observation}}" class="col-xs-10 col-sm-5" disabled/>
          </div>  
        </div>	
      </div><!-- row -->
      <div class="page-header">
        <h1>Admission</h1>
      </div>
      <div class="space-12"></div>
			  <div class="row form-group">
      		<div class="col-xs-4">
          	<label class="col-sm-3 control-label no-padding-right" for="dateEntree">
           		<strong> Date d'entrée: </strong>
            </label>
            <div class="col-sm-9">
              <input class="col-xs-5 col-sm-5 date-picker" id="dateEntree" name="dateEntree" type="text" value = "{{ $hosp->Date_entree }}" data-date-format="yyyy-mm-dd" readonly="true" disabled />
              <button class="btn btn-sm filelink" onclick="$('#dateEntree').focus()">
                <i class="fa fa-calendar"></i>
              </button>
          	</div> 
        	</div>
					<div class="col-xs-4">
	          <label class="col-sm-3 control-label no-padding-right" for="heure_rdvh">
	              <strong> Heure d'entrée :</strong>
	          </label>
	          <div class="col-sm-9">   
	              <input id="heurEnt" name="heurEnt" class="col-xs-5 col-sm-5 timepicker" type="text" value = "{{ $hosp->heure_entrée }}" disabled/ >
		      			<button class="btn btn-sm filelink" onclick="$('#dateEntree').focus()">	
		                <i class="fa fa-clock-o bigger-110"></i>
		             </button>
	          </div>
        	</div>
        	<div id = "numberofDays" class="col-xs-4">
          		<label class="col-sm-3 control-label no-padding-right" for="">
           			 <strong> Durée prévue :</strong>
          		</label>
		          <div class="col-sm-9">
		            <input class="col-xs-5 col-sm-5" id="numberDays" name="" type="number"  min="0" max="50" value="0" required/>
		            <label for=""><small><strong>&nbsp;nuit(s)</strong></small></label>
		          </div>  
        	</div>
        </div> <!-- row -->
        <div class="space-12"></div>
     	  <div class="row form-group">
	        <div class="col-xs-4">
	          <label class="col-sm-3 control-label no-padding-right" for="dateSortie">
	            <strong> Date sortie prévue:</strong>
	          </label>
	          <div class="col-sm-9">
	              <input class="col-xs-5 col-sm-5 date-picker" id="dateSortiePre" name="dateSortiePre" type="text" value = "{{ $hosp->Date_Prevu_Sortie }}" data-date-format="yyyy-mm-dd" required  onchange="updateDureePrevue()"/>
	              <button class="btn btn-sm filelink"  onclick="$('#dateSortiePre').focus();" >
	                <i class="fa fa-calendar"></i>
	               </button>
	           </div>
	        </div>
		      <div class="col-xs-4">
		        <label class="col-sm-3 control-label no-padding-right" for="heure_rdvh">
		              <strong> Heure sortie Prévue :</strong>
		          </label>
		          <div class="col-sm-9">   
		              <input id="heureSortiePrevue" name="heureSortiePrevue" class="col-xs-5 col-sm-5 timepicker" type="text" value = "{{ $hosp->Heure_Prevu_Sortie }}"/>
			      			<button class="btn btn-sm filelink" onclick="$('#heureSortiePrevue').focus()">	
			                <i class="fa fa-clock-o bigger-110"></i>
			            </button>
		          </div>
        	</div>
        	<div class="col-xs-4">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="gardeMalade" style="padding: 0.9%;">
						 		<strong>Garde Malade :</strong>
							</label>
							<div class="input-group col-sm-9" style ="width:35.8%;padding: 0.8%;">	
							<select name="" id="">
							 		<option value="0" selected>selectionnez le Garde Malade</option>
							 		@foreach( $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient->hommesConf as $homme)
							 		<option value="{{ $homme->id }}" @if($hosp->garde_id ==  $homme->id) selected @endif> {{ $homme->nom }} {{ $homme->prenom }}</option>
								  @endforeach
							</select>
							</div>
						</div>
					</div>
        </div>
         <div class="space-12"></div>
      <div class="page-header">
        <h1>Hébergement</h1>
      </div>
      @if(isset($hosp->admission->id_lit))
      <div class="row form group">
	      <div class="col-xs-4">
	        <label class="col-sm-3 control-label no-padding-right" for="serviceh">
	          <strong> Service :</strong>
	        </label>
	        <div class="col-sm-9">
	      		<select id="serviceh" name="serviceh" class="selectpicker show-menu-arrow place_holder col-xs-6 col-sm-6" placeholder="selectionnez le service d'hospitalisation" @if(!in_array(Auth::user()->role->id,[5,1])) disabled @endif />
	              <option value="0" selected>selectionnez le service d'hospitalisation</option>
	              @foreach($services as $service)
	              <option value="{{ $service->id }}" @if($hosp->admission->lit->salle->service->id == $service->id) selected @endif>
	                {{ $service->nom }}
	              </option>
	              @endforeach
	          </select>
	        </div>
	      </div>
	       <div class="col-xs-4">
            <label class="col-sm-3 control-label no-padding-right" for="salle">
              <strong> Salle :</strong>
            </label>
            <div class="col-sm-8">
              <select id="salle" name="salle" data-placeholder="selectionnez la salle d'hospitalisation" class="selectpicker show-menu-arrow place_holder col-xs-6 col-sm-6" @if(!in_array(Auth::user()->role->id,[5,1])) disabled @endif>
                <option value="0" selected>selectionnez la salle d'hospitalisation</option>      
                @foreach($hosp->admission->lit->salle->service->salles as $salle)
                <option value="{{ $salle->id }}" @if($hosp->admission->lit->salle->id == $salle->id) selected @endif >
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
              <select id="lit" name="lit" data-placeholder="selectionnez le lit" class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-9" @if(!in_array(Auth::user()->role->id,[5,1])) disabled @endif>
                <option value="0" selected>selectionnez le lit d'hospitalisation</option>      
                @foreach($hosp->admission->lit->salle->lits as $lit)
                <option value="{{ $lit->id }}" @if($hosp->admission->lit->id == $lit->id) selected @endif >
                   {{ $lit->nom }}
                 </option>
                @endforeach
              </select>
            </div>  
        </div>
      </div>
      @endif
        <div class="space-12"></div>
      <div class="space-12"></div>
      <div class="space-12"></div>
      <div class="space-12"></div>
      <div class="row">
          <div class="col-xs-3"></div>
          <div class="col-xs-6 center bottom">
            <button class="btn btn-info btn-xs" type="submit">
              <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
            </button>
          <!--  &nbsp; &nbsp; &nbsp;<button class="btn" type="reset"> <i class="ace-icon fa fa-undo bigger-110"></i>Annuler
            </button> -->
            <a href="/hospitalisation/listeRDVs" class="btn btn-xs btn-warning" >
                <i class="ace-icon fa fa-undo bigger-110"></i>Annuler
            </a>
          </div>
          <div class="col-xs-3"></div>
      </div>
    </form>
	</div>
	
</div>
@endsection