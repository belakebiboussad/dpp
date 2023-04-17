<div  id="mergeModal" class="modal fade" role="dialog" aria-hidden="true"> 
  <div class="modal-dialog modal-lg">
	  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Merger les Patients</h4>
      </div>
      <div class="modal-body">
      	<h3 class="center">êtes-vous sûr de vouloir merger les deux patients ?</h3>
				<p><span  class="red">mergé les patient est permanent et ne  peut pas  étre refait !!</span></p><!-- url('/patient/merge') -->
   		<form id="form-merge" role="form" method="POST" action="{{ route('patients.merge') }}">
      	  {{ csrf_field() }}
	      	<div id="tablePatientToMerge"></div>
	        <div class="modal-footer">
            <button  type="submit" class="btn btn-xs btn-success"><i class="ace-icon fa fa-save"></i> Enregistrer</button>
	        	<button type="button" class="btn btn-xs btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i> Annuler</button>
	      	</div> 	
        </form>
       </div>
    </div>
  </div>
</div>