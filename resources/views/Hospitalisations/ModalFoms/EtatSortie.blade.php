<div id="EtatSortie" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content custom-height-modal">
	  	<div class="modal-header">
	    		<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Générer un document patient</h4>
	  	</div>
	  	<div class="modal-body">
	  		<input type="hidden" id="className" value=""><input type="hidden" id="objID" value="">
				<div class="row"> <div class="col-xs-12"><h4 class="header blue bolder smaller">Sélectionner Le document </h4></div></div>
				<div class="hr hr-dotted"></div>
				<div style="width:100%;">
			    <div id = "parent">  
			     <ol class="rounded-list btn-group btn-group-vertical" role="group">
				  	@foreach($etatsortie as $etat)
				  		<li class="btn-group" role="group" style="padding-top: 5px">{{-- href="docStatePrint/{{$etat->id}}" target="_blank" --}}
				  		<br/>
				  		<button type="button" class="btn btn-primary btn-lg selctetat" value ="{{ $etat->id}}"><strong>&nbsp;&nbsp;{{ $etat->nom}}</strong></button> 
		        	</li>
 	  		  		@endforeach 
				 </ol>
				</div> 
			</div>   
	  	</div>
	  	<div class="modal-footer">
	  		<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
			</div>
		</div>
	</div>
</div>	  