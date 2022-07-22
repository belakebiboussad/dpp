<div id="EtatSortie" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content custom-height-modal">
	  	<div class="modal-header">
	    		<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Générer un document patient</h4>
	  	</div>
	  	<div class="modal-body">
	  		<input type="hidden" id="className" value=""><input type="hidden" id="objID" value="">
			<section class="list--wrapper">
			  <h2 class="list-title blue bolder">Sélectionner un document</h2>
			  <div class="hr hr-dotted"></div>
			  <ol class="list">
				  @foreach($etatsortie as $etat)
			    <li class="">
			      <button class="list-link btn btn-group selctetat" value ="{{ $etat->id}}">{{ $etat->nom}}</button>
			    </li><br/>
			    @endforeach
			  </ol>
    	</section>   
	  	</div>
	  	<div class="modal-footer">
	  		<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close"></i>Fermer</button>
			</div>
		</div>
	</div>
</div>	  