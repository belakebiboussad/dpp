<div id="EtatSortie" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content">
	  	<div class="modal-header">
	    		<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Imprimé un Etat de Sortie</h4>
	  	</div>
	  	<div class="modal-body">
	  		<input type="hidden" id="className" value=""><input type="hidden" id="objID" value="">
			<section class="list--wrapper">
			  <h3 class="list-title blue">Sélectionner un document</h3>
			  <div class="hr hr-dotted"></div>
			  <ol class="list" id ="etatsList">
{{--@foreach($etatsortie as $etat)<li><button class="list-link btn btn-group selctetat" value ="{{ $etat->id}}">{{ $etat->nom}}</button> 
<aclass="list-link btn btn-group selctetat" value ="{{ $etat->id}}" target="_blank">{{ $etat->nom}}</a></li><br/>@endforeach--}}
			  </ol>
    	</section>   
	  	</div>
	  	<div class="modal-footer">
	  		<button type="reset" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button>
			</div>
		</div>
	</div>
</div>	  