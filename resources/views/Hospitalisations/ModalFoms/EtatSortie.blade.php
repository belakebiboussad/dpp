<div id="EtatSortie" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content custom-height-modal">
		  	<div class="modal-header">
		    		<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter un Etat de Sortie</h4>
		  	</div>
		  	<div class="modal-body">
		  		<input type="hidden" id="hospID" value="">
		  		<div class="row"> <div class="col-xs-12"><h4 class="header blue bolder smaller">Etat de Sortie</h4></div></div>
  				<div class="hr hr-dotted"></div>
  				<div style="width:100%;">
				      <div id = "parent">         
				          <ul style=" font-size: 15px;">
			       		@foreach($etatsortie as $etat)
				                 <li style="padding-top: 5px" id="selctetat" name="selctetat" value=""></i>{{ $etat->titre }}</a></li>
				           @endforeach 
				          </ul> 
				     </div>
				</div>
		  	</div>
		  	<div class="modal-footer">
				{{-- <button type="submit" class="btn btn-info btn-sm btn-submit" id ="" data-dismiss="modal"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button> --}}
		  		<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
			</div>
		</div>
	</div>
</div>	  