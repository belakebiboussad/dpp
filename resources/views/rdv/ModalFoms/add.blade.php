<div class="modal fade" id="addRDVModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<div class="modal-content">
       <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal">&times;</button>
    		<h4 class="modal-title">Ajouter un rendez-vous</h4>   
  	</div>
  	<form  id ="addRdv" role="form"> 
	    <div class="modal-body">
       	<input type="hidden" id="date"><input type="hidden" id="fin">
        <input type="hidden" id="fixe"><input type="hidden" id="pat_id">
        @if(Auth::user()->is(15))
			  <div class="panel panel-default">
 			    <div class="panel-heading"> <span>Selectionner une spécialité</span></div>
         	<div class="panel-body">
       	   	<div class="form-group">
		         	<label class="col-form-label blue" for="specialite">Spécialité :</label>  
		          	<select class="form-control specialite" id="specialite" required>
                 	<option value="" selected disabled> Selectionner...</option>
                 	@foreach($specialites as $specialite)
               		<option value="{{ $specialite->id}}">{{  $specialite->nom }}</option>
               		 @endforeach
                </select>
	         	</div>
          </div>
        </div>
        @isset($appointDoc)
        <div class="panel panel-default">
          <div class="panel-heading">
          <i class="ace-icon fa  fa-user-md bigger-110"></i><span>Selectionner une médecin</span></div>
          <div class="panel-body">
            <div class="form-group">
              <label class="col-form-label blue">Médecin :</label>  
                <select class="form-control" id="employ_id" disabled>
                  <option value="" selected="selected">Selectionner...</option>
                </select>
            </div>
          </div>
        </div>
        @endisset
	      @endif
        <div class="panel panel-default" id="patientPanel">
      		<div class="panel-heading"><i class="ace-icon fa fa-user"></i><span> Selectionner un patient</span></div>
        	<div class="panel-body">	
        		<div class="row">
	          	<div class="col-sm-4">
		          	<div class="form-group">
          		  	<label class="col-form-label blue" for="filtre">Filtre :</label> 
          	<select class="form-control" id="filtre" @if(isset($patient->id)|| (Auth::user()->role_id == 2 )) disabled @endif> 
         		        <option value="" selected disabled="">Selectionner...	</option>
	                 		<option value="Nom">Nom</option>
	                  	<option value="Prenom">Prenom</option>
	                  	<option value="IPP">IPP</option>
                  </select>
		          	</div>
	          	</div><div class="col-sm-1"></div>
	          	<div class="col-sm-7">
			          <div class="form-group">
			          	<label class="col-form-label" for="patient">&nbsp; </label>
			              <input type="search"  class="form-control"  id="pat-search" name="q" disabled autocomplete="off"><div id="livesearch" class="list-unstyled"></div>
                </div>
			          	</div>
		          	</div>
		          </div>
		        </div>
	        </div><!-- modal-body -->
	        <div class="modal-footer">
		      	<button  class="btn btn-success btn-xs" type="button" id ="btnSave" data-dismiss="modal" disabled><i class="ace-icon fa fa-save"></i> Enregistrer</button>    
			      <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal" onclick="reset_in();"><i class="fa fa-undo" aria-hidden="true"></i> Annuler</button>
		      </div>
      	</form>
  		</div>
  </div><!-- modal-dialog -->
 </div>
 <script type="text/javascript" charset="utf-8">
  function Fill(pid, name)
  {
    $("#pat_id").val(pid);
    $("#pat-search").val(name);
    $("#livesearch").html('')
    @if(Auth::user()->role_id == 15)
      if(($("#specialite").val()) != null)
        $("#btnSave").attr("disabled", false);
    @else
      $("#btnSave").attr("disabled", false);
    @endif
  }
  function showRdvModal(date,fin,pid = 0,fixe)
  {
    $('#date').val(date); $('#fin').val(fin);  $('#fixe').val(fixe);
    if(pid !== 0)
    {
      $("#pat_id").val(pid);
      if(! ($( "#patientPanel" ).hasClass( "hidden" )))
        $("#patientPanel").addClass("hidden");
    }else
    {
      if( $( "#patientPanel" ).hasClass( "hidden" ))
        $("#patientPanel").removeClass("hidden"); 
    }
    $('#addRDVModal').modal({
      show: 'true'
    }); 
  }
  $(function(){
    $("#pat-search").on("keyup", function() {//patient
        if (!($("#btnSave").is(":disabled")))
        {
          $("#btnSave").prop('disabled',true);
          $('#pat_id').val('');
        }
       getPatient(); 
    });
  $("#specialite" ).change(function() {
    getDoctors($(this).val(), '{{ $appointDoc }}');
    if($(this).val() != '')
    {
      if('{{ $patient->id }}' != '' || ($('#pat_id').val() != ''))
        $("#btnSave").removeAttr("disabled");
    }else
    {
      if($("#filtre").prop('disabled') == true)
        $("#filtre").prop('disabled',false);
    }  
/*if('{{ $patient->id }}' == '' ){if($("#filtre").prop('disabled') == true)
$("#filtre").prop('disabled',false);}else $("#btnSave").removeAttr("disabled");*/ 
  });
  $( "#filtre" ).change(function() {
    resetPatient();
    if($(this).val() != '' && ( $("#pat-search").prop('disabled') == true))
      $("#pat-search").prop('disabled',false);
  });
})
</script>