<div  id="mergeModal" class="modal fade" role="dialog" aria-hidden="true"> 
  <div class="modal-dialog modal-ku">
	  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Merger les données des Patients :</h4>
      </div>
      <div class="modal-body">
      	<p class="center">êtes-vous sûr de vouloir merger les deux patients ?</p>
				<p> <span  class="text-danger">mergé les patient est permanent et ne  peut pas  étre refait !!</span></p>
   			<form id="form-merge" role="form" method="POST" action="{{ url('/patient/merge') }}">	
      	  {{ csrf_field() }}
	      	<div id="tablePatientToMerge"></div>
	        <div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-120"></i>Fermer</button>
	        	<button  type="submit" class="btn btn-success"><i class="ace-icon fa fa-check bigger-120"></i>Valider</button>
	      	</div> 	
        </form>
       </div>
    </div>  	{{-- modal-content --}}
  </div>
</div>