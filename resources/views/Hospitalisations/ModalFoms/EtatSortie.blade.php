<div id="EtatSortie" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content custom-height-modal">
		  	<div class="modal-header">
		    		<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter un Etat de Sortie</h4>
		  	</div>
		  	<div class="modal-body">
		  		<input type="hidden" id="hospID" value="">
		  		<div class="row"> <div class="col-xs-12"><h4 class="header blue bolder smaller">Etat de Sortie</h4></div></div>
  				<div class="hr hr-dotted"></div><div class="space-12"></div>
  				<div style="width:100%;">
				      <div id = "parent">         
				          <ul style=" font-size: 15px;">
			       		@foreach($Etatsortie as $etat)
				                <a href="#" title="">
				                  <li style="padding-top: 5px" id="selctetat" name="selctetat" value="{{ $patient->id }}"></i>{{ $etat->titre }}</a></li>
				                </a>
				           @endforeach 
				          </ul> 
				     </div>
				</div>
		  	</div>
		  </div>
	</div>
</div>	  