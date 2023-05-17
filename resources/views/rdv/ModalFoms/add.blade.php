<div class="modal fade" id="addRDVModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<div class="modal-content">
       <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal">&times;</button>
    		<h4 class="modal-title">Ajouter un rendez-vous</h4>   
  	</div>
    <div class="modal-body">
      <form  id ="addRdv" role="form" class="form-horizontal" action="{{ route('rdv.store') }}" method="POST"> 
      <div class="alert alert-danger print-error-msg" style="display:none">
      <strong>Errors:</strong> <ul></ul></div>
      <div class="alert alert-success print-success-msg" style="display:none"></div>
      <div class="form-group" id="error" aria-live="polite">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
             @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
            </ul>
          </div>
        @endif
      </div>
       	<input type="hidden" id="date" name="date"><input type="hidden" id="fin"  name="fin">
        <input type="hidden" id="fixe" name="fixe"><input type="hidden" id="pid" name="pid">
        <input type="hidden" name="isSec" value="{{ Auth::user()->is(15)}}">
        <input type="hidden" id="medecinRequired" name="medecinRequired" value="">
        @if(Auth::user()->is(15))
			  <div class="panel panel-default">
 			    <div class="panel-heading"> <span>Selectionner une spécialité</span></div>
         	<div class="panel-body">
       	   	<div class="form-group">
		         	<label class="col-form-label blue" for="specialite">Spécialité</label>  
		          	<select class="form-control specialite" id="specialite" name="specialite">
                 	<option value="" selected disabled> Selectionner...</option>
                 	@foreach($specialites as $specialite)
               		<option value="{{ $specialite->id}}">{{  $specialite->nom }}</option>
               		 @endforeach
                </select>
	         	</div>
          </div>
        </div>
        <div class="panel panel-default docPanel">
          <div class="panel-heading">
          <i class="ace-icon fa fa-user-md bigger-110"></i><span>Selectionner une médecin</span></div>
          <div class="panel-body">
            <div class="form-group">
              <label class="col-form-label blue">Médecin</label>  
                <select class="form-control" id="employ_id" name="employ_id">
                  <option value="" selected disabled>Selectionner...</option>
                </select>
            </div>
          </div>
        </div>
	      @endif
        <div class="panel panel-default" id="patientPanel">
      		<div class="panel-heading"><i class="ace-icon fa fa-user"></i><span> Selectionner un patient</span></div>
        	<div class="panel-body">	
        		<div class="row">
	          	<div class="col-sm-4">
		          	<div class="form-group">
          		  	<label class="col-form-label blue" for="filtre">Filtre</label> 
          	<select class="form-control" id="filtre" @if(isset($patient->id)|| (Auth::user()->is(2))) disabled @endif> 
         		        <option value="" selected disabled="">Selectionner...	</option>
	                 		<option value="Nom">Nom</option><option value="Prenom">Prenom</option>
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
            </form>
	        </div><!-- modal-body -->
	        <div class="modal-footer"><!-- data-dismiss="modal" -->
		      	<button  class="btn btn-primary btn-xs" type="button" id ="rdvSaveBtn"><i class="ace-icon fa fa-save"></i> Enregistrer</button>
			      <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal" onclick="reset_in();"><i class="fa fa-undo" aria-hidden="true"></i> Annuler</button>
		      </div>
      	
  		</div>
  </div><!-- modal-dialog -->
 </div>
 <script type="text/javascript" charset="utf-8">
  function Fill(pid, name)
  {
    $("#pid").val(pid);
    $("#pat-search").val(name);
    $("#livesearch").html('')
  }
  function showRdvModal(date,fin,pid = 0,fixe)
  {
    $('#date').val(date); $('#fin').val(fin);  $('#fixe').val(fixe);
    if(pid !== 0)
    {
      $("#pid").val(pid);
      if(! ($( "#patientPanel" ).hasClass( "hidden" )))
        $("#patientPanel").addClass("hidden");
    }else
    {
      if( $( "#patientPanel" ).hasClass( "hidden" ))
        $("#patientPanel").removeClass("hidden"); 
    }
    $('#addRDVModal').modal('toggle'); 
  }
  $(function(){
    $("#pat-search").on("keyup", function() {
        $('#pid').val('');
        getPatient(); 
    });
  $( "#filtre" ).change(function() {
    resetPatient();
    if($(this).val() != '' && ( $("#pat-search").prop('disabled') == true))
      $("#pat-search").prop('disabled',false);
  });
})
</script>